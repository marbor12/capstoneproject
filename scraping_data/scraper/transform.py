import pandas as pd

def transform_reviews(reviews):
    df = pd.DataFrame(reviews)

    df['rating'] = pd.to_numeric(df['rating'], errors='coerce').fillna(0)
    

    df['review'] = df['review'].str.replace('\n', ' ').str.strip()
    
    return df[['user', 'rating', 'review', 'date', 'year']]  