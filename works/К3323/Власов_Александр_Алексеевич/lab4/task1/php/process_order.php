<?php
// Параметры подключения к базе данных
$host = 'mysql';
$db = 'shop';
$user = 'shopuser';
$pass = 'shoppassword';

// Подключение к базе данных
$conn = new mysqli($host, $user, $pass, $db);

// Проверка подключения
if ($conn->connect_error) {
    die('Ошибка подключения: ' . $conn->connect_error);
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

// Защита от SQL-инъекций
$last_name = $conn->real_escape_string($last_name);
$first_name = $conn->real_escape_string($first_name);
$middle_name = $conn->real_escape_string($middle_name);
$address = $conn->real_escape_string($address);
$phone = $conn->real_escape_string($phone);
$email = $conn->real_escape_string($email);
$product = $conn->real_escape_string($product);
$comment = $conn->real_escape_string($comment);

// SQL-запрос на вставку данных
$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment)
        VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$phone', '$email', '$product', '$comment')";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
