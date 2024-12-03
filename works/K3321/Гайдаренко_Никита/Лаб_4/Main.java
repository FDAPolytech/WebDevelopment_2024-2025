import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.nio.file.Files;
import java.nio.file.Paths;

class Main {
    public static void main(String[] args) throws IOException {
        // Создаем сервер на порту 8080
        HttpServer server = HttpServer.create(new InetSocketAddress(888), 0);

        // Добавляем обработчик для маршрута "/"
        server.createContext("/", new HttpHandler() {
            @Override
            public void handle(HttpExchange exchange) throws IOException {
                String filePath = "C:\\Users\\Никита\\IdeaProjects\\simpleProject\\src\\index.html";
                byte[] response;

                // Проверяем, существует ли файл
                if (Files.exists(Paths.get(filePath))) {
                    response = Files.readAllBytes(Paths.get(filePath));
                    exchange.getResponseHeaders().add("Content-Type", "text/html");
                    exchange.sendResponseHeaders(200, response.length);
                } else {
                    String notFound = "404 Not Found: File " + filePath + " does not exist.";
                    response = notFound.getBytes();
                    exchange.sendResponseHeaders(404, response.length);
                }

                // Отправляем ответ
                OutputStream os = exchange.getResponseBody();
                os.write(response);
                os.close();
            }
        });

        // Запускаем сервер
        server.setExecutor(null);
        server.start();
        System.out.println("Server started");
    }

}
