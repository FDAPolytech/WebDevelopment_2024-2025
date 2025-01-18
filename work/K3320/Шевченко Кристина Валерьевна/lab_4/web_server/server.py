from flask import Flask, send_from_directory, abort, request
import argparse
import os
import logging

app = Flask(__name__)

# Указываем директорию для сервировки файлов
base_dir = os.path.dirname(os.path.abspath(__file__))

# Настройка логирования
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(message)s')

@app.route('/')
def serve_index():
    # Возвращаем содержимое index.html
    return send_from_directory(base_dir, 'index.html')

@app.errorhandler(404)
def page_not_found(e):
    # Логируем ошибку 404
    logging.warning(f"404 Error: {request.url}")
    return "<h1>404 Not Found</h1><p>The page you requested could not be found.</p>", 404

if __name__ == '__main__':
    # Аргументы командной строки для указания порта
    parser = argparse.ArgumentParser(description="Run a simple web server.")
    parser.add_argument('--port', type=int, default=5000, help='Port to run the server on')
    args = parser.parse_args()

    # Запускаем сервер
    logging.info(f"Starting server on port {args.port}")
    app.run(host='127.0.0.1', port=args.port)
