import java.awt.Desktop;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.println("Введите адреса web-страниц, разделяя их запятой: ");
        String urlsInput = scanner.nextLine();
        String[] urls = urlsInput.split(",\\s*");

        System.out.println("Введите интервал показа в секундах: ");
        int interval = scanner.nextInt() * 1000;

        for (String url : urls) {
            try {
                if (Desktop.isDesktopSupported()) {
                    Desktop desktop = Desktop.getDesktop();
                    desktop.browse(new URI(url));
                } else {
                    System.out.println("Desktop API не поддерживается на этом устройстве.");
                }

                Thread.sleep(interval);
            } catch (IOException | URISyntaxException | InterruptedException e) {
                System.out.println("Произошла ошибка при открытии URL: " + url);
                e.printStackTrace();
            }
        }

        scanner.close();
    }
}
