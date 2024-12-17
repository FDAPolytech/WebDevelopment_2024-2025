import http.server
import socketserver
import os

# Указываем порт
PORT = 2000

# Создаем обработчик запросов
class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            # Устанавливаем текущий каталог для поиска файла index.html
            self.path = 'index.html'
        return super().do_GET()

# Создаем сервер
Handler = MyHandler
httpd = socketserver.TCPServer(('127.0.0.1', PORT), Handler)

print(f"Сервер запущен на http://127.0.0.1:{PORT}")
httpd.serve_forever()
