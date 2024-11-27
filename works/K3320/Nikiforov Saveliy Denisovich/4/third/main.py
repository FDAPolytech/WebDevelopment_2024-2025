import http.server
import socketserver
import os
import sys

def start_server(port):
    current_directory = os.getcwd()
    handler = http.server.SimpleHTTPRequestHandler
    handler.directory = current_directory

    with socketserver.TCPServer(("", port), handler) as httpd:
        httpd.serve_forever()

if __name__ == "__main__":
    port = 888
    if len(sys.argv) > 1:
        port = int(sys.argv[1])
    print("serve in %s port" % port)
    start_server(port)