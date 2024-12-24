import http.server
import socketserver
import os

# Создаем обработчик для сервера
class CustomHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":
            self.path = "index.html"
        return super().do_GET()


# Запрос порта у пользователя
port = int(input("Введите номер порта для запуска сервера: "))


# Запускаем сервер
with socketserver.TCPServer(("", port), CustomHTTPRequestHandler) as httpd:
    print(f"Сервер запущен на порту {port}. Откройте в браузере: http://127.0.0.1:{port}/")
    httpd.serve_forever()
