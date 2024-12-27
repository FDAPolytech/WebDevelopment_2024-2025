import http.server
import socketserver
import os

# Функция запуска сервера
def run_server(port):
    # Текущая директория, где находится исполняемый файл
    directory = os.getcwd()
    os.chdir(directory)

    # Настройка обработчика для сервера
    handler = http.server.SimpleHTTPRequestHandler

    # Запуск сервера на указанном порту
    with socketserver.TCPServer(("", port), handler) as httpd:
        print(f"Сервер запущен на порту {port}. Откройте в браузере: http://127.0.0.1:{port}/")
        print(f"Содержимое файла index.html будет обслуживаться из директории: {directory}")
        httpd.serve_forever()

# Основная программа
if __name__ == "__main__":
    try:
        # Пользователь вводит порт для запуска сервера
        port = int(input("Введите порт для запуска сервера (например, 8888): "))
        run_server(port)
    except ValueError:
        print("Ошибка: Порт должен быть целым числом.")
    except KeyboardInterrupt:
        print("\nСервер остановлен.")
