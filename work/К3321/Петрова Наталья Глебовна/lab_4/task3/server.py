import http.server
import socketserver
from urllib.parse import urlparse

# Адрес и порт сервера
ADDRESS = '127.0.0.1'
PORT = 8080

def main():
    # Создаем обработчик запросов
    handler = http.server.SimpleHTTPRequestHandler

    # Запускаем TCP-сервер
    with socketserver.TCPServer((ADDRESS, PORT), handler) as httpd:
        print(f'Сервер запущен на {urlparse(f"http://{ADDRESS}:{PORT}").geturl()}')
        
        try:
            httpd.serve_forever()  # Бесконечный цикл обработки запросов
        except KeyboardInterrupt:
            print('Сервер остановлен.')

if __name__ == '__main__':
    main()