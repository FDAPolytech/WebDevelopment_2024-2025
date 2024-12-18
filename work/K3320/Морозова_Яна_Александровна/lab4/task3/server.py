import http.server
import socketserver
import os
import argparse

# Создаем аргументы командной строки
parser = argparse.ArgumentParser(description="Веб-сервер")
parser.add_argument("--port", type=int, default=8000, help="Порт, на котором будет работать сервер")
args = parser.parse_args()

# Путь к каталогу, где расположен скрипт
current_directory = os.path.dirname(os.path.abspath(__file__))

# Настраиваем HTTP-обработчик
class CustomHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":
            self.path = "index.html"
        return http.server.SimpleHTTPRequestHandler.do_GET(self)

os.chdir(current_directory)

# Создаем и запускаем сервер
with socketserver.TCPServer(("", args.port), CustomHTTPRequestHandler) as httpd:
    print(f"Сервер запущен на порту {args.port}. Откройте в браузере: http://127.0.0.1:{args.port}/")
    httpd.serve_forever()