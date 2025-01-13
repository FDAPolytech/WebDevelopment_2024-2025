import webbrowser
import time

urls = [
    "https://github.com/amkutsak/Web-Lab2",
    "https://ya.ru",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Zunge_raus.JPG/400px-Zunge_raus.JPG"
]

interval = 5  # Интервал в секундах

for url in urls:
    webbrowser.open(url)
    time.sleep(interval)
