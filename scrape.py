import urllib.request
import re

def main():
    url = 'https://www.denimsa.com.tr/koleksiyon'
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        html = urllib.request.urlopen(req).read().decode('utf-8')
        
        # We need to extract the title and the image. 
        # The structure looks roughly like:
        # <li class="..."><div class="..."><img src="(.*?)" ... />...<h5 ...><a href="(.*?)">(.*?)</a></h5>
        
        # Split items by "li class="..." or general blocks
        blocks = re.split(r'<li class="[^"]*product[^"]*">', html)
        
        categories = []
        for block in blocks[1:]: # Skip things before the first product
            img_match = re.search(r'<img[^>]+src="([^"]+)"', block)
            title_match = re.search(r'<h[45][^>]*>\s*<a[^>]+href="([^"]+)"[^>]*>(.*?)</a>\s*</h[45]>', block)
            
            if img_match and title_match:
                img_url = img_match.group(1).strip()
                link_url = title_match.group(1).strip()
                title = title_match.group(2).strip()
                
                # Ensure they are absolute
                if not img_url.startswith('http'):
                    img_url = "https://www.denimsa.com.tr" + ("/" if not img_url.startswith("/") else "") + img_url
                if not link_url.startswith('http'):
                    link_url = "https://www.denimsa.com.tr" + ("/" if not link_url.startswith("/") else "") + link_url
                    
                categories.append({
                    'title': title,
                    'img': img_url,
                    'url': link_url
                })
        
        print(f"Parsed {len(categories)} categories")

        sql = "SET NAMES utf8mb4;\nTRUNCATE TABLE collection_categories;\n"
        for idx, cat in enumerate(categories, 1):
            title = cat['title'].replace("'", "''")
            sql += f"INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, video_url, is_active, order_num) VALUES ('{title}', '{title} (EN)', 'Premium {title} serisi.', 'Premium {title} series.', '{cat['img']}', '{cat['url']}', 1, {idx});\n"
        
        sql += "UPDATE site_settings SET hero_video_url = 'https://www.tempertekstil.com.tr/assets/video/intro.mp4' WHERE id = 1;\n"

        with open('c:/Users/aliko/denimsa/seed.sql', 'w', encoding='utf-8') as f:
            f.write(sql)
            
    except Exception as e:
        print("Scrape error:", e)

if __name__ == '__main__':
    main()
