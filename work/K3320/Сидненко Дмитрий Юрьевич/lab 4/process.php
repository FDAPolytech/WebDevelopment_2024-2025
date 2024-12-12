<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'shop_db';
$username = 'root';
$password = ''; // Укажите ваш пароль, если есть

$conn = new mysqli($host, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// SQL-запрос для вставки данных
$sql = "INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comment) 
        VALUES ('$surname', '$name', '$patronymic', '$address', '$phone', '$email', '$product', '$comment')";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Ваш заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
