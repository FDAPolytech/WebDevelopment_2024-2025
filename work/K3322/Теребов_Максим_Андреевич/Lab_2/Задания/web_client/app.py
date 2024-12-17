from flask import Flask, render_template, request, jsonify
import threading
import time

app = Flask(__name__)

# Глобальные переменные
urls = ["https://example.com", "https://flask.palletsprojects.com", "https://www.python.org"]
current_url_index = 0
refresh_interval = 5
is_running = True

# Функция для циклического переключения ссылок
def cycle_pages():
    global current_url_index
    while is_running:
        time.sleep(refresh_interval)
        current_url_index = (current_url_index + 1) % len(urls)

# Запуск фонового потока
threading.Thread(target=cycle_pages, daemon=True).start()

@app.route("/")
def index():
    return render_template("combined.html", current_url=urls[current_url_index], urls=urls, interval=refresh_interval)

@app.route("/add_url", methods=["POST"])
def add_url():
    url = request.json.get("url")
    if url and url not in urls:
        urls.append(url)
    return jsonify({"urls": urls})

@app.route("/delete_url", methods=["POST"])
def delete_url():
    url = request.json.get("url")
    if url in urls:
        urls.remove(url)
    return jsonify({"urls": urls})

@app.route("/set_interval", methods=["POST"])
def set_interval():
    global refresh_interval
    interval = request.json.get("interval")
    if isinstance(interval, int) and interval > 0:
        refresh_interval = interval
    return jsonify({"interval": refresh_interval})

@app.route("/get_current_url")
def get_current_url():
    return jsonify({"current_url": urls[current_url_index]})

if __name__ == "__main__":
    app.run(debug=True)
