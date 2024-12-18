import http.server
import socketserver
import os

def run_server(port):
    
    handler = http.server.SimpleHTTPRequestHandler
    
    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Server running at http://127.0.0.1:{port}")
        
        httpd.serve_forever()

if __name__ == "__main__":
    port = 888  
    
    if os.path.exists("index.html"):
        run_server(port)
    else:
        print("Error: index.html not found in the current directory.")
