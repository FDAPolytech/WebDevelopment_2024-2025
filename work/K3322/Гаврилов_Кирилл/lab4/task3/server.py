import http.server
import socketserver
import os
import sys

PORT = 888

class HTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        try:
            return http.server.SimpleHTTPRequestHandler.do_GET(self)
        except FileNotFoundError:
            self.send_error(404, "File Not Found")


if not os.path.exists("index.html"):
    print("Error: index.html не найден в текущем каталоге!")
    sys.exit(1)

path = HTTPRequestHandler
with socketserver.TCPServer(("", PORT), path) as httpd:
    print(f"Сервер запущен на порту {PORT}")
    print(f"Откройте в браузере: http://127.0.0.1:{PORT}/")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nСервер остановлен.")
        httpd.shutdown()