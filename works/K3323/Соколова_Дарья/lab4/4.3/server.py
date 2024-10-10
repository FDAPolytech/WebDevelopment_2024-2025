import http.server
import socketserver

PORT = 888

class MyRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()

def run(server_class=http.server.HTTPServer, handler_class=MyRequestHandler):
    with socketserver.TCPServer(("", PORT), handler_class) as httpd:
        print(f"Сервер запущен на http://127.0.0.1:{PORT}")
        httpd.serve_forever()

if __name__ == "__main__":
    run()
