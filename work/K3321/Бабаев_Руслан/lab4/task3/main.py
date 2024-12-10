import click
from flask import Flask, render_template, make_response, jsonify
from loguru import logger

app = Flask(__name__)

@app.route('/')
def serve_index():
    """Returns index.html"""
    return render_template('index.html', )


@app.errorhandler(404)
def not_found(error):
    """Обработка ошибки 404"""
    return make_response(jsonify({'error': 'Not found'}), 404)


@click.command()
@click.option('--host', default='127.0.0.1', help='Address for running app (default: 127.0.0.1).')
@click.option('--port', default=8000, help='Port for running app (default: 8000).')
def main(port, host):
    """Start Flask server with given parameters."""
    logger.info(f"Server is running now on {host}:{port}.")
    try:
        app.run(host=host, port=port)
    except KeyboardInterrupt:
        logger.info("Server was stopped.")

if __name__ == '__main__':
    main()
