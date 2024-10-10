<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "order_db"; 

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Подготовка и привязка
$stmt = $conn->prepare("INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comment);

// Получение данных из формы
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// Выполнение запроса
if ($stmt->execute()) {
    echo "Новый заказ успешно создан";
} else {
    echo "Ошибка: " . $stmt->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
