import http.server
import socketserver


class MyHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/':
            self.path = 'index.html'
        return super().do_GET()
    
def webSocket (port):
    with socketserver.TCPServer(("", port), MyHandler) as httpd:
        print(f"запущен сервер на порту {port}")
        httpd.serve_forever()

def isValidPort(port):
    return (0 < port < 65535)

def getPort():
    port = -1
    try:
        port = int(input('Введите порт от 0 до 65535: '))
    except ValueError:
        print ('Порт должен быть числом')
    return port
    
 

if __name__ == "__main__":
    port = getPort()
    while(not isValidPort(port)):
        print("Введен неверный порт")
        port = getPort()


    webSocket(port)
        
    