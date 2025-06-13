from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException, WebDriverException
from bs4 import BeautifulSoup
from .config import (
    REQUEST_TIMEOUT,
    RETRY_ATTEMPTS,
    MIN_DELAY,
    MAX_DELAY,
    PAGE_LOAD_TIMEOUT,
    SCRAPINGBEE_API_KEY,)
import time
import random
import re
import warnings
import platform
import requests


def fetch_page_with_scrapingbee(url):
    response = requests.get(
        "https://app.scrapingbee.com/api/v1/",
        params={
            "api_key": SCRAPINGBEE_API_KEY,
            "url": url,
            "render_js": "true",  
        },
        timeout=REQUEST_TIMEOUT,
    )
    if response.status_code == 200:
        return response.text
    else:
        raise Exception(f"ScrapingBee Error {response.status_code}: {response.text[:200]}")
    

warnings.filterwarnings("ignore")

def setup_driver():
    options = Options()
    

    options.add_argument("--disable-gpu")
    options.add_argument("--no-sandbox")
    options.add_argument("--disable-dev-shm-usage")
    options.add_argument("--disable-extensions")
    options.add_argument("--disable-infobars")
    options.add_argument("--disable-notifications")
    options.add_argument("--disable-blink-features=AutomationControlled")
    options.add_experimental_option('excludeSwitches', ['enable-automation', 'enable-logging'])
    options.add_experimental_option('useAutomationExtension', False)
    

    if platform.system() == 'Windows':
        options.add_argument("--disable-software-rasterizer")

    options.add_argument("user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36")
    options.add_argument("--headless")
    options.add_argument("--disable-webgl")
    options.add_argument("--disable-3d-apis")
    
    driver = webdriver.Chrome(options=options)
    driver.set_page_load_timeout(REQUEST_TIMEOUT)
    return driver

def extract_reviews(base_url, suffix, max_pages):
    all_reviews = []
    successful_pages = 0
    
    try:
        for page in range(max_pages):
            url = f"{base_url}-or{page*10}{suffix}" if page > 0 else f"{base_url}{suffix}"
            print(f"\nPage {page + 1}/{max_pages} | Total Reviews: {len(all_reviews)}")
            
            for attempt in range(RETRY_ATTEMPTS):
                try:
                    delay = random.uniform(MIN_DELAY, MAX_DELAY)
                    print(f"Delay: {delay:.1f}s | Attempt {attempt + 1}/{RETRY_ATTEMPTS}")
                    time.sleep(delay)

                    html = fetch_page_with_scrapingbee(url)
                    soup = BeautifulSoup(html, 'html.parser')
                    reviews = parse_reviews(soup)

                    if reviews:
                        all_reviews.extend(reviews)
                        successful_pages += 1
                        print(f"Success: {len(reviews)} new reviews")
                        break

                except Exception as e:
                    print(f"Attempt failed: {str(e)[:100]}...")
                    if attempt == RETRY_ATTEMPTS - 1:
                        print("⏭Max retries reached, moving to next page")

            if len(all_reviews) >= 300:
                print(f"\nTarget reached: {len(all_reviews)} reviews")
                break

    except KeyboardInterrupt:
        print("\nUser interrupted the scraping process")
    except Exception as e:
        print(f"\nFatal error: {str(e)}")

    return all_reviews

def parse_reviews(soup):
    reviews = []
    review_containers = soup.find_all('div', {'data-automation': 'reviewCard'})
    
    for container in review_containers:
        try:

            user = "Anonymous"
            user_selectors = [
                'span.biGQs._P.fiohW.fOtGX a.BMQDV',
                'a.BMQDV._F.Gv.wSSLS.SwZTJ',
                'a.BMQDV'
            ]
            for selector in user_selectors:
                user_element = container.select_one(selector)
                if user_element and (user_text := user_element.text.strip()):
                    user = user_text
                    break
            

            rating = "0"
            rating_elements = [
                container.find('svg', {'aria-labelledby': True}),
                container.find('div', class_='ui_bubble_rating'),
                container.find('span', class_='ui_bubble_rating')
            ]
            for element in rating_elements:
                if element and (title := getattr(element.find('title'), 'text', None)):
                    if 'bubble' in title.lower() or 'star' in title.lower():
                        rating = title.split()[0]
                        break
            

            review_text = ""
            review_selectors = [
                'span.yCeTE',
                'div.fIrGe._T.bgMZj',
                'div.biGQs._P.pZUbB.KxBGd span.yCeTE',
                'div.prw_rup.prw_reviews_text_summary_hsx'
            ]
            for selector in review_selectors:
                element = container.select_one(selector)
                if element and (text := element.text.strip()):
                    review_text = text.replace('\n', ' ').strip()
                    break
            

            date = "Unknown date"
            date_elements = [
                container.find('div', class_='RpeCd'),
                container.find('span', class_='ratingDate')
            ]
            for element in date_elements:
                if element and (date_text := element.text.strip()):
                    date = date_text
                    break
            
            year_match = re.search(r'(20\d{2})', date)
            year = year_match.group(1) if year_match else "Unknown"
            
            reviews.append({
                'user': user,
                'rating': rating,
                'review': review_text,
                'date': date,
                'year': year
            })
            
        except Exception as e:
            print(f"⚠️ Review parsing error: {str(e)[:100]}...")
            continue
    
    return reviews