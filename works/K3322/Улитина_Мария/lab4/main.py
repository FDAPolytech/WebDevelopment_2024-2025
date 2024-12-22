import http.server
import socketserver

PORT = 1250


class RequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()


Handler = RequestHandler
httpd = socketserver.TCPServer(('127.0.0.1', PORT), Handler)
print(f"Сервер запущен на порте {PORT}")
httpd.serve_forever()
