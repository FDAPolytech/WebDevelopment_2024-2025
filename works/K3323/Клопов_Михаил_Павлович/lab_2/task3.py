import webbrowser
import time

webpages = ["https://isu.itmo.ru","https://my.itmo.ru"]

def show_webpages(pages, interval):
    for page in pages:
        print("Открываю "+ page)
        webbrowser.open(page)  
        time.sleep(interval)   
            
print("Введите интервал (в секундах): ", end='')
try:
	interval_in_seconds = int(input())  
except Exception:
	print("Интервал по умолчанию 15 секунд ")
	interval_in_seconds = 15  


show_webpages(webpages, interval_in_seconds)

