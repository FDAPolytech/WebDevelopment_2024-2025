import os
from http.server import SimpleHTTPRequestHandler
from socketserver import TCPServer

port = 888

html_file = 'index.html'

if not os.path.exists(html_file):
    raise FileNotFoundError(f"Файл {html_file} не найден в текущем каталоге")

class MyHandler(SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            with open(html_file, 'r') as file:
                content = file.read()
            self.send_response(200)
            self.send_header('Content-type', 'text/html')
            self.end_headers()
            self.wfile.write(content.encode('utf-8'))
        else:
            super().do_GET()

with TCPServer(("", port), MyHandler) as httpd:
    print(f"Сервер запущен на http://127.0.0.1:{port}")
    httpd.serve_forever()
