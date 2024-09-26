import webbrowser
import time

# Список веб-страниц
pages = [
	"https://monkeytype.com",
	"https://www.google.com",
	"https://my.itmo.ru",
]

# Интервал между открытием страниц (в секундах)
interval = 5  # 5 секунд

# Функция для открытия страниц по очереди
def open_pages():
    for url in pages:
        print(f"Открываю страницу: {url}")
        webbrowser.open(url)  # Открываем URL в браузере
        time.sleep(interval)   # Ждем интервал перед открытием следующей страницы

if __name__ == "__main__":
    open_pages()