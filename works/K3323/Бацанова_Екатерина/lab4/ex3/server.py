import http.server
import socketserver
import os

def get_port():
    while True:
        try:
            port = int(input("Введите порт для запуска сервера: "))
            if 1 <= port <= 65535:
                return port
            else:
                print("Порт должен быть в диапазоне от 1 до 65535.")
        except ValueError:
            print("Пожалуйста, введите корректное число.")


class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()

def run_server(port):
    os.chdir(os.path.dirname(__file__))
    handler = MyHandler
    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Сервер запущен на http://127.0.0.1:{port}/")
        httpd.serve_forever()

if __name__ == "__main__":
    port = get_port()
    run_server(port)

