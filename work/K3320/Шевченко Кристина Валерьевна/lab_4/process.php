<?php
// Настройки подключения к базе данных
$host = 'localhost'; // Хост
$dbname = 'orders'; // Имя базы данных
$username = 'root'; // Имя пользователя MySQL
$password = ''; // Пароль MySQL (по умолчанию пустой)

// Подключение к базе данных
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверка, что данные отправлены через POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Подготовка и выполнение SQL-запроса
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, comment)
                               VALUES (:last_name, :first_name, :middle_name, :address, :phone, :email, :comment)");
        $stmt->execute([
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':address' => $address,
            ':phone' => $phone,
            ':email' => $email,
            ':comment' => $comment
        ]);

        echo "Данные успешно сохранены!";
    } catch (PDOException $e) {
        echo "Ошибка при сохранении данных: " . $e->getMessage();
    }
} else {
    echo "Неверный метод отправки данных.";
}
?>
