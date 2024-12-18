import http.server
import socketserver

PORT = 888

class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()

if __name__ == "__main__":
    try:
        with socketserver.TCPServer(("", PORT), MyHandler) as httpd:
            print(f"Сервер запущен на порту {PORT}")
            httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nСервер остановлен пользователем")
    