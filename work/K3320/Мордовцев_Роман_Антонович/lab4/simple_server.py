import http.server
import socketserver

PORT = 888  # Задайте нужный порт

# Обработчик для возврата index.html
class CustomHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return http.server.SimpleHTTPRequestHandler.do_GET(self)

# Запуск сервера
with socketserver.TCPServer(("", PORT), CustomHandler) as httpd:
    print(f"Сервер запущен на порту {PORT}")
    print("Откройте в браузере: http://127.0.0.1:888/")
    httpd.serve_forever()
