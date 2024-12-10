<?php
// Данные для подключения к базе данных
$host = 'localhost';
$dbname = 'lab4_db';
$username = 'root';
$password = '';

// Подключение к MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// SQL-запрос на вставку данных
$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Подготовка и выполнение запроса
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $last_name, $first_name, $middle_name, $address, $phone, $email, $product, $comment);

if ($stmt->execute()) {
    echo "Заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $stmt->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
