<?php
// Подключение к базе данных
$servername = "db"; // Имя хоста в Docker Compose
$username = "exampleuser";
$password = "examplepass";
$database = "exampledb";

$conn = new mysqli($servername, $username, $password, $database);

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
    echo "Order successfully submitted!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>