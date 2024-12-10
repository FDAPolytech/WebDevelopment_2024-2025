import com.sun.net.httpserver.HttpServer;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpExchange;

import java.io.OutputStream;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.net.InetSocketAddress;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) throws IOException {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Введите порт: ");
        int port = scanner.nextInt();

        HttpServer server = HttpServer.create(new InetSocketAddress(port), 0);
        System.out.println("Сервер запущен на порту " + port);

        server.createContext("/", new HttpHandler() {
            @Override
            public void handle(HttpExchange exchange) throws IOException {
                String method = exchange.getRequestMethod();

                if (method.equalsIgnoreCase("GET")) {
                    String filePath = "/Users/artur/IdeaProjects/task3/src/index.html";
                    byte[] response = Files.readAllBytes(Paths.get(filePath));

                    exchange.sendResponseHeaders(200, response.length);
                    OutputStream os = exchange.getResponseBody();
                    os.write(response);
                    os.close();

                }
            }
        });

        server.start();
    }
}