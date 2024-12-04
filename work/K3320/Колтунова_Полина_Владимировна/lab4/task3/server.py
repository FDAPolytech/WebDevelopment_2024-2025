import http.server 
import socketserver
import argparse
import os

parser = argparse.ArgumentParser(description="Простой веб-сервер на Python")
parser.add_argument(
    "-p", "--port", type=int, default=8080, help="Порт, на котором будет работать сервер"
)
args = parser.parse_args()

class CustomHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":  
            self.path = "index.html"  
        return super().do_GET()

if not os.path.exists("index.html"):
    print("Файл index.html не найден в текущем каталоге.")
    exit(1)

with socketserver.TCPServer(("", args.port), CustomHTTPRequestHandler) as httpd:
    print(f"Сервер запущен на порту {args.port}. Перейдите по адресу http://127.0.0.1:{args.port}/")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nСервер остановлен.")
        httpd.shutdown()
