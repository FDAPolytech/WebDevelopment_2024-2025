<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "lab4_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

$sql = "INSERT INTO orders (first_name, last_name, middle_name, address, phone, email, product, comment) 
        VALUES ('$first_name', '$last_name', '$middle_name', '$address', '$phone', '$email', '$product', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Спасибо за заказ</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                background-color: #f4f8fb;
            }
            h1 {
                color: #4a4a4a;
                font-size: 2rem;
                text-align: center;
                margin-bottom: 20px;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                font-size: 1rem;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
            .btn:hover {
                background-color: #45a049;
                transform: scale(1.05);
            }
            .btn:active {
                transform: scale(0.95);
            }
        </style>
    </head>
    <body>
        <h1>Спасибо за заказ, $first_name!</h1>
        <a href='index.html' class='btn'>Вернуться к форме</a>
    </body>
    </html>";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
