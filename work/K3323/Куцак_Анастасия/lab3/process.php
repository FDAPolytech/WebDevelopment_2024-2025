<?php
// Получаем данные из формы
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// Подключаемся к базе данных
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "orders";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment) 
        VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$phone', '$email', '$product', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
