<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$surname = $_POST['surname'];
$firstname = $_POST['firstname'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product_id = $_POST['product_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO orders (surname, firstname, patronymic, address, phone, email, product_id, comment)
        VALUES ('$surname', '$firstname', '$patronymic', '$address', '$phone', '$email', '$product_id', '$comment')";

if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение заказа</title>
    <link rel="stylesheet" href="php_style.css">
</head>
<body>
    <div class="container">
        <h2>Спасибо за ваш заказ!</h2>
        <p>Ваш заказ успешно оформлен. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
        <p>Номер вашего заказа: <strong><?php echo $order_id; ?></strong></p>
        <p>Если у вас есть дополнительные вопросы, пожалуйста, свяжитесь с нашей службой поддержки.</p>
        <a href="form.html" class="btn-back">Вернуться на главную</a>
    </div>
</body>
</html>
