import http.server
import socketserver
import os

def run_server(port):
    """
    Запускает веб-сервер, обслуживающий текущий каталог.
    :param port: Порт, на котором будет работать сервер.
    """
    # Проверяем, существует ли index.html
    if not os.path.exists("index.html"):
        print("Файл 'index.html' не найден в текущем каталоге.")
        return

    # Класс для обработки HTTP-запросов
    class CustomHandler(http.server.SimpleHTTPRequestHandler):
        def do_GET(self):
            if self.path == '/':  # Если запрос корня сайта
                self.path = 'index.html'
            return super().do_GET()

    # Запуск сервера
    try:
        with socketserver.TCPServer(("", port), CustomHandler) as httpd:
            print(f"Сервер запущен на http://127.0.0.1:{port}")
            httpd.serve_forever()
    except OSError as e:
        print(f"Ошибка: {e}")

if __name__ == "__main__":
    try:
        # Запрашиваем порт у пользователя
        port = int(input("Введите порт для запуска сервера (например, 888): "))
        run_server(port)
    except ValueError:
        print("Введите корректный номер порта.")
    except KeyboardInterrupt:
        print("\nСервер остановлен.")
