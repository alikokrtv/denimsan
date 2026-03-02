import sys
import subprocess

try:
    import pypdf
except ImportError:
    subprocess.check_call([sys.executable, "-m", "pip", "install", "pypdf"])
    import pypdf

try:
    reader = pypdf.PdfReader(r'C:\Users\aliko\SİTE\DENIMSAN INT .pdf')
    text = ""
    for page in reader.pages:
        extracted = page.extract_text()
        if extracted:
            text += extracted + "\n"
    print(text)
except Exception as e:
    print("Error:", e)
