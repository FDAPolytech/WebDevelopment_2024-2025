from webbrowser import open_new_tab
from time import sleep

def show_webpages(urls, interval):
 for url in urls:
  open_new_tab(url)
  sleep(interval)



# Получение URL-адресов и интервала от пользователя
urls_input = input("Введите адреса web-страниц, разделяя их запятой: ")
urls = urls_input.split(", ")
interval_input = input("Введите интервал показа в секундах: ")
interval = int(interval_input)

# Запуск показа web-страниц
show_webpages(urls, interval)

