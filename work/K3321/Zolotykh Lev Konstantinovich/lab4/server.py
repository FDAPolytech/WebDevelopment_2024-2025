import http.server
import socketserver
import os

def run_server(port):
    # Получаем текущий каталог
    current_dir = os.path.dirname(os.path.abspath(__file__))
    
    # Создаем обработчик запросов
    handler = http.server.SimpleHTTPRequestHandler
    handler.directory = current_dir  # Устанавливаем каталог для обслуживания файлов

    # Устанавливаем порт
    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Сервер запущен на http://127.0.0.1:{port}/")
        httpd.serve_forever()

if __name__ == "__main__":
    # Указываем порт, который можно изменить
    port = 888  # Можно изменить на любой другой порт
    run_server(port)
