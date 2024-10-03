from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

if __name__ == '__main__':
    port = int(input('Which port do you want to use?\n'))
    app.run(host="127.0.0.1", port=port)