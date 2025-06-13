from scraper.extract import extract_reviews
from scraper.transform import transform_reviews
from scraper.config import BASE_URL, SUFFIX, MAX_PAGES, OUTPUT_CSV
import os
import pandas as pd
from datetime import datetime

def save_progress(df, path):
    """Save data with timestamp to prevent overwrites"""
    timestamp = datetime.now().strftime("%Y%m%d_%H%M")
    backup_path = f"{os.path.splitext(path)[0]}_{timestamp}.csv"
    df.to_csv(backup_path, index=False, encoding='utf-8-sig')
    print(f"🔁 Saved backup to: {backup_path}")

def main():
    print("\n" + "="*50)
    print("Uluwatu Sunset Review Scraper")
    print("="*50 + "\n")
    
    start_time = datetime.now()
    print(f"Start time: {start_time.strftime('%Y-%m-%d %H:%M:%S')}")
    
    try:
        # Extract reviews
        print("\nBeginning review extraction...")
        raw_reviews = extract_reviews(BASE_URL, SUFFIX, MAX_PAGES)
        
        if not raw_reviews:
            print("\nNo reviews collected - check error messages above")
            return
        
        # Transform data
        print("\nProcessing collected data...")
        df = transform_reviews(raw_reviews)
        
        # Save results
        os.makedirs(os.path.dirname(OUTPUT_CSV), exist_ok=True)
        df.to_csv(OUTPUT_CSV, index=False, encoding='utf-8-sig')
        save_progress(df, OUTPUT_CSV)
        
        # Calculate statistics
        duration = (datetime.now() - start_time).total_seconds() / 60
        reviews_per_min = len(df) / duration if duration > 0 else 0
        
        # Final report
        print("\n" + "="*50)
        print("Final Report")
        print("="*50)
        print(f"Successfully collected {len(df)} reviews")
        print(f"Duration: {duration:.1f} minutes")
        print(f"Speed: {reviews_per_min:.1f} reviews/minute")
        print(f"Average rating: {df['rating'].mean():.1f}/5")
        print(f"Date range: {df['year'].min()} to {df['year'].max()}")
        print(f"\nMain output: {OUTPUT_CSV}")
        
    except KeyboardInterrupt:
        print("\nScript interrupted by user")
    except Exception as e:
        print(f"\nUnexpected error: {str(e)}")
    finally:
        print("\nScraping session completed")

if __name__ == "__main__":
    main()