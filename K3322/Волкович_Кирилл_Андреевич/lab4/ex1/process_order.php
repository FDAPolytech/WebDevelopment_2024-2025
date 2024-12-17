<?php
$host = 'localhost';
$dbname = 'online_shop';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

$stmt = $conn->prepare("INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $last_name, $first_name, $middle_name, $address, $phone, $email, $product, $comment);

if ($stmt->execute()) {
    echo "Заказ оформлен!";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
