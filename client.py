import webbrowser
import time

urls = [
    "https://moodle.itmo.ru/mod/resource/view.php?id=7020",
    "https://www.google.com",
    "https://www.github.com"
]

interval = 5  # Интервал между страницами в секундах

for url in urls:
    webbrowser.open(url)
    time.sleep(interval)
