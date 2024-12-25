<?php
// Подключаемся к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные из формы
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$delivery_address = $_POST['delivery_address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// Подготавливаем запрос на вставку данных в базу
$sql = "INSERT INTO orders (surname, name, patronymic, delivery_address, phone, email, product, comment)
        VALUES ('$surname', '$name', '$patronymic', '$delivery_address', '$phone', '$email', '$product', '$comment')";

// Выполняем запрос
if ($conn->query($sql) === TRUE) {
    echo "Заказ успешно оформлен!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрываем соединение
$conn->close();
?>
