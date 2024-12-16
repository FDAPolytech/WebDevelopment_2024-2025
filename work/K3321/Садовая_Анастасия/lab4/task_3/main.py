#!/usr/bin/env python3

import os
import http.server

class SimpleHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    pass

def run(server_class=http.server.HTTPServer, handler_class=SimpleHTTPRequestHandler):
    port = int(os.getenv("PORT", 8000))
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f"Serving on port {port}")
    httpd.serve_forever()

if __name__ == "__main__":
    run()
