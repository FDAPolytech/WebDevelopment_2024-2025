import http.server
import socketserver
import os

# Устанавливаем порт, на котором будет работать сервер
PORT = 8866

# Указываем путь к файлу index.html (в том же каталоге, где находится server.py)
html_file = "index.html"

# Создаем класс для обработки HTTP-запросов
class MyRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        # Переопределяем метод do_GET, чтобы отдавать файл index.html
        if self.path == "/":
            self.path = html_file
        return super().do_GET()

# Запускаем сервер
handler = MyRequestHandler
httpd = socketserver.TCPServer(("", PORT), handler)

print(f"Сервер работает на http://127.0.0.1:{PORT}/")
httpd.serve_forever()
