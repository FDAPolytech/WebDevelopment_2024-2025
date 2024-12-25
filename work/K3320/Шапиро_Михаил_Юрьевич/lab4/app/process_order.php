<?php
// Настройки подключения к базе данных
$host = 'localhost';
$db = 'shop';
$user = 'root';
$pass = ''; 

// Подключение к базе данных
$conn = new mysqli($host, $user, $pass, $db);

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

// Запись данных в таблицу
$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment)
        VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$phone', '$email', '$product', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Заказ успешно оформлен.";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
