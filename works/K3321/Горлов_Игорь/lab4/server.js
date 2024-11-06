const http = require('http');
const fs = require('fs');
const path = require('path');

// Функция для запуска сервера на указанном порту
function startServer (port) {
    const server = http.createServer((req, res) => {
        if (req.url === '/') {
            // Путь к файлу index.html
            const filePath = path.join(__dirname, 'index.html');

            // Чтение файла index.html
            fs.readFile(filePath, (err, data) => {
                if (err) {
                    res.writeHead(500, { 'Content-Type': 'text/plain' });
                    res.end('500 Internal Server Error');
                } else {
                    // Отправка содержимого файла index.html
                    res.writeHead(200, { 'Content-Type': 'text/html' });
                    res.end(data);
                }
            });
        } else {
            // Если запрос не на корневой URL
            res.writeHead(404, { 'Content-Type': 'text/plain' });
            res.end('404 Not Found');
        }
    });

    // Запуск сервера на указанном порту
    server.listen(port, () => {
        console.log(`Server is running on http://127.0.0.1:${port}`);
    });
}

// Ввод порта от пользователя через командную строку
const port = process.argv[2] || 3000; // По умолчанию порт 3000
startServer(port);
