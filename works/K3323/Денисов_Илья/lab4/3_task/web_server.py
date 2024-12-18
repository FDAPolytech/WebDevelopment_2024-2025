from http.server import BaseHTTPRequestHandler, HTTPServer
import os

class CustomHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":
            # Путь к index.html
            file_path = os.path.join(os.getcwd(), "index.html")
            
            # Если файл существует, прочитаем его
            if os.path.exists(file_path):
                with open(file_path, "r", encoding="utf-8") as file:
                    content = file.read()
                
                # Добавляем номер порта к HTML
                content += f"<p>Сервер работает на порту: {self.server.server_port}</p>"
                
                # Отправка ответа
                self.send_response(200)
                self.send_header("Content-type", "text/html; charset=utf-8")
                self.end_headers()
                self.wfile.write(content.encode("utf-8"))
            else:
                # Если файл не найден, возвращаем 404
                self.send_error(404, "Файл index.html не найден.")
        else:
            # Обработка других маршрутов
            self.send_error(404, "Страница не найдена.")
    
def run_server(port):
    server_address = ("", port)
    httpd = HTTPServer(server_address, CustomHandler)
    print(f"Сервер запущен на порту {port}. Доступен по адресу http://127.0.0.1:{port}/")
    print("Нажмите Ctrl+C для остановки сервера.")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nСервер остановлен.")
        httpd.server_close()

if __name__ == "__main__":
    port = int(input("Введите порт для запуска сервера (например, 888): "))
    run_server(port)

