import os
import sys
from http.server import SimpleHTTPRequestHandler, HTTPServer

class CustomHTTPRequestHandler(SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":
            self.path = "index.html"
        return super().do_GET()

def run_server(port):
    # Получаем текущую директорию, чтобы сервер знал, где искать файлы
    os.chdir(os.path.dirname(os.path.abspath(__file__)))
    handler = CustomHTTPRequestHandler
    with HTTPServer(("127.0.0.1", port), handler) as server:
        print(f"Сервер запущен на порту {port}. Нажмите Ctrl+C для остановки.")
        try:
            server.serve_forever()
        except KeyboardInterrupt:
            print("\nСервер остановлен.")
            server.server_close()

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Использование: python server.py <порт>")
        sys.exit(1)

    try:
        port = int(sys.argv[1])
        if not (1 <= port <= 65535):
            raise ValueError("Неверный порт. Укажите значение в диапазоне 1-65535.")
    except ValueError as e:
        print(f"Ошибка: {e}")
        sys.exit(1)

    run_server(port)