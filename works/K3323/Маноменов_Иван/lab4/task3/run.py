from http.server import BaseHTTPRequestHandler, HTTPServer
import os


class SimpleHTTPRequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        file_path = os.path.join(os.getcwd(), 'index.html')

        #if os.path.exists(file_path):
        self.send_response(200)
        self.send_header('Content-type', 'text/html; charset=utf-8')
        self.end_headers()

        with open(file_path, 'rb') as file:
            self.wfile.write(file.read())
        # else:
        #     self.send_response(404)
        #     self.end_headers()
        #     self.wfile.write(b"404 Not Found")


def run(server_class=HTTPServer, handler_class=SimpleHTTPRequestHandler):
    port = int(input("Введите порт для запуска сервера: "))
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f"Запуск сервера на порту {port}...")
    httpd.serve_forever()


if __name__ == "__main__":
    run()
