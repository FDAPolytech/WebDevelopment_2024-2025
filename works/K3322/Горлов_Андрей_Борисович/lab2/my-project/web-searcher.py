import webbrowser
import time

pages = [
    'https://ru.wikipedia.org/wiki/%D0%A1%D0%BB%D1%83%D0%B6%D0%B5%D0%B1%D0%BD%D0%B0%D1%8F:%D0%A1%D0%BB%D1%83%D1%87%D0%B0%D0%B9%D0%BD%D0%B0%D1%8F_%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0',
    'https://mail.google.com/mail/u/0/#inbox',
    'https://my.itmo.ru/schedule'
]

interval = 5  

for page in pages:
    webbrowser.open(page)  
    time.sleep(interval)   
