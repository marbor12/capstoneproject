import random
from scraper.config import PROXY_LIST

current_proxy_index = 0

def get_proxy(remove_failed=False):
    global current_proxy_index
    
    if not PROXY_LIST:
        return None
    
    if remove_failed and len(PROXY_LIST) > 1:
        PROXY_LIST.pop(current_proxy_index)
    
    current_proxy_index = (current_proxy_index + 1) % len(PROXY_LIST)
    return PROXY_LIST[current_proxy_index]