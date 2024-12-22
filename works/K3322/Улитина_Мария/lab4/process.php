<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root"; // Укажите ваше имя пользователя
$password = ""; // Укажите ваш пароль
$dbname = "order";   // Укажите название вашей базы данных

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Устанавливаем режим ошибок PDO на исключения
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $delivery_address = $_POST['delivery_address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $product_id = $_POST['product_id'];
    $comment = $_POST['comment'];

    // SQL-запрос для вставки данных в таблицу orders
    $sql = "INSERT INTO `order` (Last_name, First_name, Middle_name, Address, Phone, Email, Product_id, Comment)
            VALUES (:last_name, :first_name, :middle_name, :delivery_address, :phone_number, :email, :product_id, :comment)";

    // Подготовка и выполнение запроса
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':middle_name', $middle_name);
    $stmt->bindParam(':delivery_address', $delivery_address);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':comment', $comment);

    if ($stmt->execute()) {
        echo "Заказ успешно оформлен!";
    } else {
        echo "Произошла ошибка при оформлении заказа.";
    }
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?>
