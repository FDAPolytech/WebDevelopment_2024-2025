import http.server
import socketserver
import os

def run_server(port):
    # Определяем адрес и порт
    handler = http.server.SimpleHTTPRequestHandler
    # Создаём сервер с указанным портом
    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Server running at http://127.0.0.1:{port}")
        # Запуск сервера
        httpd.serve_forever()

if __name__ == "__main__":
    port = 888  # Например, 888
    # Убедитесь, что файл index.html находится в том же каталоге
    if os.path.exists("index.html"):
        run_server(port)
    else:
        print("Error: index.html not found in the current directory.")
