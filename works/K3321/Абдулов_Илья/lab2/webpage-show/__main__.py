import webbrowser
import time

websites = ["google.co.kr", "ya.ru", "itmo.ru", "ydb.tech"]
interval = 2

for website in websites:
    webbrowser.open("https://" + website, new=2)
    time.sleep(interval)
