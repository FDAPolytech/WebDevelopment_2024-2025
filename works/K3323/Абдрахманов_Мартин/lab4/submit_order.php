<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lab4db"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];


$sql = "INSERT INTO form_data (surname, name, patronymic, address, phone, email, product, comment) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comment);

if ($stmt->execute()) {
    echo "Заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
