<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "users_info"; 

$conn = new mysqli($servername, $username, $password, $dbname);


$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

$sql = "INSERT INTO users (surname, name, patronymic, address, phone, email, product, comment) VALUES ('$surname', '$name', '$patronymic', '$address', '$phone', '$email', '$product', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Order submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
