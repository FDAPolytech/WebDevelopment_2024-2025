import http.server
import socketserver
import os
import argparse

def main():
    parser = argparse.ArgumentParser(description="Запуск веб-сервера для обслуживания index.html.")
    parser.add_argument(
        "-p", "--port",
        type=int,
        default=8000,
        help="Порт, на котором будет работать сервер (по умолчанию: 8000)."
    )
    args = parser.parse_args()

    if not os.path.exists("index.html"):
        print("Файл index.html не найден в текущем каталоге.")
        return

    class CustomHandler(http.server.SimpleHTTPRequestHandler):
        def do_GET(self):
            if self.path == "/" or self.path == "/index.html":
                self.path = "index.html"
            return super().do_GET()

    with socketserver.TCPServer(("", args.port), CustomHandler) as httpd:
        print(f"Сервер запущен на http://127.0.0.1:{args.port}")
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            print("\nСервер остановлен.")

if __name__ == "__main__":
    main()
