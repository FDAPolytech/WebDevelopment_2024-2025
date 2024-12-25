<?php
$servername = "localhost";
$username = "webpageuser";
$password = "password";
$dbname = "webpage";

$conn = new mysqli($servername, $username, $password, $dbname);

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
$comment = $_POST['comment'];

$sql = "INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comment)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comment);

if ($stmt->execute()) {
    echo "Order successfully submitted!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
