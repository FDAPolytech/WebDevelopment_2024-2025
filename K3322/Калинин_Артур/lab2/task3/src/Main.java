import java.awt.Desktop;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        List<String> pages = new ArrayList<>();

        System.out.println("Вводите адреса страниц или нажмите Enter для завершения: ");
        String page = scanner.nextLine();
        while (!page.isEmpty()){
            pages.add(page);
            page = scanner.nextLine();
        }

        System.out.print("Введите интервал между показами в секундах: ");
        int seconds = scanner.nextInt() * 1000;

        openPages(pages, seconds);
    }

    public static void openPages(List<String> pages, int intervalMillis) {

        Desktop desktop = Desktop.getDesktop();

        for (String page : pages) {
            try {
                desktop.browse(new URI(page));
                System.out.println("Открыта страница: " + page);

                Thread.sleep(intervalMillis);
            } catch (IOException | URISyntaxException | InterruptedException e) {
                System.out.println("Не удалось открыть страницу: " + page);
            }
        }
    }
}
