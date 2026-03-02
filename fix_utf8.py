import os

def fix_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Known corrupted representations
    replacements = {
        'HakkÄ±mÄ±zda': 'Hakkımızda',
        'Ä°letiÅŸim': 'İletişim',
        'KeÅŸfet': 'Keşfet',
        'Mesaj GÃ¶nder': 'Mesaj Gönder',
        'AdÄ±nÄ±z SoyadÄ±nÄ±z': 'Adınız Soyadınız',
        'MesajÄ±nÄ±z': 'Mesajınız',
        'TÃ¼m haklarÄ± saklÄ±dÄ±r.': 'Tüm hakları saklıdır.',
        'YÃ¼ksek Kaliteli Ãœretim': 'Yüksek Kaliteli Üretim',
        'baÅŸarÄ±yla gÃ¶nderildi. TeÅŸekkÃ¼r ederiz.': 'başarıyla gönderildi. Teşekkür ederiz.',
        'Bir hata oluÅŸtu, lÃ¼tfen daha sonra tekrar deneyin.': 'Bir hata oluştu, lütfen daha sonra tekrar deneyin.',
        'MenÃ¼': 'Menü',
        'Ä±': 'ı', 'Ä°': 'İ', 'ÅŸ': 'ş', 'Åž': 'Ş', 'Ã§': 'ç', 'Ã‡': 'Ç', 
        'Ã¼': 'ü', 'Ãœ': 'Ü', 'Ã¶': 'ö', 'Ã–': 'Ö', 'ÄŸ': 'ğ', 'Äž': 'Ğ'
    }

    for bad, good in replacements.items():
        content = content.replace(bad, good)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

base_dir = r"c:\Users\aliko\denimsa"
fix_file(os.path.join(base_dir, "includes", "functions.php"))
fix_file(os.path.join(base_dir, "includes", "footer.php"))
fix_file(os.path.join(base_dir, "index.php"))
print("Done fixing UTF-8")
