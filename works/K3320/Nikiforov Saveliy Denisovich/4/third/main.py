import http.server
import socketserver
import os

def start_server(port):
    current_directory = os.getcwd()
    handler = http.server.SimpleHTTPRequestHandler
    handler.directory = current_directory

    with socketserver.TCPServer(("", port), handler) as httpd:
        httpd.serve_forever()

if __name__ == "__main__":
    port = 1111
    start_server(port)