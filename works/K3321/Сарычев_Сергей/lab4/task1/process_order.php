<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$products = implode(", ", $_POST['products']);
$comments = $_POST['comments'];

$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, products, comments)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $last_name, $first_name, $middle_name, $address, $phone, $email, $products, $comments);

if ($stmt->execute()) {
    echo "Заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
