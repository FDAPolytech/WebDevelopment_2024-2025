import http.server
import socketserver
import os

# Порт, на котором будет работать сервер
PORT = 8888


# Определение обработчика запросов
class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        # Если запрашивается корень, возвращаем содержимое index.html
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()


# Создание и запуск сервера
def run(server_class=http.server.HTTPServer, handler_class=MyHandler):
    server_address = ('', PORT)
    httpd = server_class(server_address, handler_class)
    print(f'Serving on port {PORT}...')
    httpd.serve_forever()


if __name__ == "__main__":
    # Проверяем, существует ли файл index.html
    if not os.path.isfile('index.html'):
        print('Файл index.html не найден!')
    else:
        run()
