import webbrowser
import time

def show_webpages(pages, interval):
    for page in pages:
        print(f"Открываю: {page}")
        webbrowser.open(page)  
        time.sleep(interval)   

if __name__ == "__main__":
    webpages = [
        "https://gulpjs.com/docs/en/getting-started/quick-start/",
        "https://my.itmo.ru",
        "https://github.com/MartinAbdrakhmanov/WebDevelopment_2024-2025/tree/lab_2"
    ]
    
    interval_in_seconds = 5  

    show_webpages(webpages, interval_in_seconds)
