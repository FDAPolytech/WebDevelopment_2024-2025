import http.server, socketserver, sys

port = int(sys.argv[1]) if len(sys.argv) > 1 else 8080
server = http.server.SimpleHTTPRequestHandler

print(f"Сервер запущен! \nМожете воспользоваться ссылкой http://127.0.0.1:{port}/")
try:
    with socketserver.TCPServer(("", port), server) as httpd:
        httpd.serve_forever()
except KeyboardInterrupt:
    print("\nСервер остановлен! До свидания! =)")

