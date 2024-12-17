import org.junit.jupiter.api.*;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import java.time.Duration;

class SaleorE2ETests {

    private static WebDriver driver;
    private static WebDriverWait wait;

    @BeforeAll
    static void setup() {
        System.setProperty("webdriver.chrome.driver", "path/to/chromedriver");
        driver = new ChromeDriver();
        wait = new WebDriverWait(driver, Duration.ofSeconds(10));
    }

    @AfterAll
    static void teardown() {
        if (driver != null) {
            driver.quit();
        }
    }

    @Test
    @DisplayName("User Login Test")
    void testUserLogin() {
        driver.get("https://demo.saleor.io/");

        // Navigate to login page
        WebElement loginButton = wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("a[href='/account/login']")));
        loginButton.click();

        // Enter login credentials
        WebElement emailField = wait.until(ExpectedConditions.presenceOfElementLocated(By.id("id_email")));
        emailField.sendKeys("user@example.com");

        WebElement passwordField = driver.findElement(By.id("id_password"));
        passwordField.sendKeys("password123");

        WebElement submitButton = driver.findElement(By.cssSelector("button[type='submit']"));
        submitButton.click();

        // Assert user is logged in
        WebElement accountMenu = wait.until(ExpectedConditions.presenceOfElementLocated(By.cssSelector("a[href='/account']")));
        Assertions.assertTrue(accountMenu.isDisplayed(), "User should be logged in.");
    }

    @Test
    @DisplayName("Add Product to Cart and Checkout")
    void testAddToCartAndCheckout() {
        driver.get("https://demo.saleor.io/");

        // Select a product from homepage
        WebElement product = wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("a[href*='/product']")));
        product.click();

        // Add product to cart
        WebElement addToCartButton = wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("button[data-testid='add-to-cart-button']")));
        addToCartButton.click();

        // Go to cart
        WebElement cartButton = wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("a[href='/cart']")));
        cartButton.click();

        // Proceed to checkout
        WebElement checkoutButton = wait.until(ExpectedConditions.elementToBeClickable(By.cssSelector("a[href='/checkout']")));
        checkoutButton.click();

        // Assert checkout page is displayed
        WebElement checkoutHeader = wait.until(ExpectedConditions.presenceOfElementLocated(By.cssSelector("h1")));
        Assertions.assertEquals("Checkout", checkoutHeader.getText(), "Should navigate to checkout page.");
    }
}