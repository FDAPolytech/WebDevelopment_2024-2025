import http.server
import socketserver
import os


class MyRequestHandler(http.server.SimpleHTTPRequestHandler):

    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()


def run(server_class=http.server.HTTPServer, handler_class=MyRequestHandler, port=8888):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f'Serving on port {port}...')
    httpd.serve_forever()


if __name__ == "__main__":
    port = 8888
    run(port=port)
