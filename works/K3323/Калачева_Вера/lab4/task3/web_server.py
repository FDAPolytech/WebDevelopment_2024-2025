from http.server import HTTPServer, SimpleHTTPRequestHandler
import sys

# Получаем номер порта из аргументов командной строки
port = int(sys.argv[1]) if len(sys.argv) > 1 else 8000

class RequestHandler(SimpleHTTPRequestHandler):
    def __init__(self, *args, directory=None, **kwargs):
        super().__init__(*args, directory=directory, **kwargs)

    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()

# Создаем HTTP-сервер
server_address = ('', port)
httpd = HTTPServer(server_address, RequestHandler)

# Запускаем сервер
if __name__=="__main__":
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("Server stopped")