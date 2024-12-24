<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO orders (lastname, firstname, middlename, address, phone, email, product, comment) 
            VALUES ('$lastname', '$firstname', '$middlename', '$address', '$phone', '$email', '$product', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "Order submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
