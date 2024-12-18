<?php
// Параметры подключения к БД
$host = 'localhost';
$dbname = 'lab4_task1';
$username = 'root';
$password = '';

try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'] ?? null;
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $comment = $_POST['comment'] ?? null;

    // SQL-запрос для вставки данных
    $sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment)
            VALUES (:last_name, :first_name, :middle_name, :address, :phone, :email, :product, :comment)";

    $stmt = $pdo->prepare($sql);

    // Связывание параметров
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':middle_name', $middle_name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':comment', $comment);

    // Выполнение запроса
    $stmt->execute();

    echo "Заказ успешно оформлен!";
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
