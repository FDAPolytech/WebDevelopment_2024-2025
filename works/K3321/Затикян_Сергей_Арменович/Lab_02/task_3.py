import webbrowser
import time

urls = [
    "https://www.google.com",
    "https://www.wikipedia.org",
    "https://www.github.com",
    "https://www.python.org",
    "https://www.stackoverflow.com"
]

interval = 15

for url in urls:
    print(f"Открывается страница: {url}")
    webbrowser.open(url)  
    time.sleep(interval)  
