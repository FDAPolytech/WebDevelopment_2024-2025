import http.server
import socketserver
import os

PORT = 888

class RequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html' 
        return http.server.SimpleHTTPRequestHandler.do_GET(self)

os.chdir(os.path.dirname(os.path.abspath(__file__)))

with socketserver.TCPServer(("", PORT), RequestHandler) as server:
    print(f"Сервер запущен на порту {PORT}")
    server.serve_forever()

