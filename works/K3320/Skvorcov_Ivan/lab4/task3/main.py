from http.server import HTTPServer, BaseHTTPRequestHandler
import os

# Создаем класс обработчика запросов
class RequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        # Проверка, запрашивается ли корневая страница
        if self.path == '/':
            try:
                # Открываем и читаем содержимое файла index.html
                with open("index.html", "r") as file:
                    content = file.read()
                
                # Отправляем статус 200 OK и заголовки
                self.send_response(200)
                self.send_header("Content-type", "text/html")
                self.end_headers()

                # Отправляем содержимое файла
                self.wfile.write(content.encode('utf-8'))
            except FileNotFoundError:
                # Если файл не найден, возвращаем ошибку 404
                self.send_response(404)
                self.end_headers()
                self.wfile.write(b"404 Not Found")
        else:
            # Обрабатываем другие запросы (например, ошибки 404)
            self.send_response(404)
            self.end_headers()
            self.wfile.write(b"404 Not Found")

# Функция для запуска сервера
def run_server(port=8888):
    server_address = ('', port)
    httpd = HTTPServer(server_address, RequestHandler)
    print(f"Сервер запущен на http://127.0.0.1:{port}")
    httpd.serve_forever()

# Запуск сервера на указанном порту
if __name__ == "__main__":
    port = int(input("Введите порт для запуска сервера (например, 8888): "))
    run_server(port)