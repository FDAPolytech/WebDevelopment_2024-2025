<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'orders';
    $username = 'root';
    $password = '';

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        echo 'Errno: '.$mysqli->connect_errno;
        exit();
    }

    $first_name = $_POST['first-name'];
    $second_name = $_POST['second-name'];
    $third_name = $_POST['third-name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $comment = $_POST['feedback'];

    $sql = "INSERT INTO user_order (first_name, second_name, third_name, address, phone, email, product, comment) 
            VALUES ('$first_name', '$second_name', '$third_name', '$address', '$phone', '$email', '$product', '$comment')";

    

    if ($mysqli->query($sql)) {
        echo "Форма успешно отправлена!";
    } else {
        echo "Ошибка!";
    }

    $mysqli->close();
} else {
    echo "Ошибка";
}
?>