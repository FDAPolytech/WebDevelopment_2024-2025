import http.server
import socketserver
import os


PORT = 8888



class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return http.server.SimpleHTTPRequestHandler.do_GET(self)


if __name__ == "__main__":
    port = os.getenv('PORT', PORT)

    with socketserver.TCPServer(("", port), MyHandler) as httpd:
        print(f"Сервер запущен на порту {port}")
        httpd.serve_forever()