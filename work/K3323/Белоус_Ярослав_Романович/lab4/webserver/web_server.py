import http.server
import socketserver
import os
import sys

def start_server(port):
    current_directory = os.path.dirname(os.path.abspath(__file__))
    os.chdir(current_directory)

    handler = http.server.SimpleHTTPRequestHandler

    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Serving at http://127.0.0.1:{port}/")
        try:
            httpd.serve_forever()
        except KeyboardInterrupt:
            print("\nServer stopped.")
            httpd.server_close()

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python web_server.py <port>")
        sys.exit(1)

    try:
        port = int(sys.argv[1])
        start_server(port)
    except ValueError:
        print("Error: Port must be an integer.")
        sys.exit(1)
