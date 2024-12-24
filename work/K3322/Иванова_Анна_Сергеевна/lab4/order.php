<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'order_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comments = $_POST['comments'];

$stmt = $conn->prepare("INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comments);

if ($stmt->execute()) {
    echo "Ваш заказ успешно добавлен ";
} else {
    echo "Ошибка " . $stmt->error;
}

$stmt->close();
$conn->close();
?>