from flask import Flask, render_template, request, redirect, url_for, jsonify
import time

app = Flask(__name__)

@app.route('/', methods=['GET'])
def index():
    return render_template('weblab2.3.html')

@app.route('/display', methods=['POST'])
def display():
    urls = request.form['urls'].split(',')
    time_interval = int(request.form['time'])

    for url in urls:
        # Экспортируйте или обрабатывайте URL в реальном времени (например, использовать библиотеку requests)
        print(f"Переключение на {url.strip()}")  # Замените это на код, который отображает или вызывает URL
        time.sleep(time_interval)  # Задержка для переключения

    return redirect(url_for('weblab2.3')) # Вернуться на главную страницу после завершения

if __name__ == '__main__':
    app.run(debug=True)
