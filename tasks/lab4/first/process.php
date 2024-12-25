<?php
$servername = "MySQL-8.2";
$username = "root";
$password = "";
$dbname = "orders";

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comments = $_POST['comments'];

// SQL-запрос
$sql = "INSERT INTO orders(last_name, first_name, patronymic, address, phone, email, product, comments) VALUES ('$last_name', '$first_name', '$patronymic', '$address', '$phone', '$email', '$product', '$comments')";

if (mysqli_query($conn, $sql)) {
    echo "Order submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Закрытие соединения
mysqli_close($conn);
?>
