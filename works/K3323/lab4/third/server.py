import http.server
import socketserver

PORT = int(input("Введите порт для запуска веб-сервера: "))

Handler = http.server.SimpleHTTPRequestHandler

with socketserver.TCPServer(("", PORT), Handler) as httpd:
    print(f"Сервер запущен на порту {PORT}")
    httpd.serve_forever()
