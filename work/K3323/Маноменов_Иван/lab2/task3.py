import webbrowser
import time

pages = [
    "https://isu.itmo.ru",
    "https://my.itmo.tu"
]

interval = int(input("Введите интервал между показами (в секундах) "))

for page in pages:
    print("Открывается сайт " + page)
    webbrowser.open(page) 
    time.sleep(interval)  
