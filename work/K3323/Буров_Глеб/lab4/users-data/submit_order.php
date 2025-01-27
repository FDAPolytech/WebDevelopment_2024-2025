<?php
// Настройки подключения к базе данных
$host = 'localhost'; // хост
$db = 'lab4'; // имя вашей базы данных
$user = 'root'; // имя пользователя базы данных
$pass = ''; // пароль пользователя базы данных

// Подключение к базе данных
$conn = new mysqli($host, $user, $pass, $db);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

// Подготовленный запрос для вставки данных
$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $last_name, $first_name, $middle_name, $address, $phone, $email, $product, $comment);

// Выполнение запроса и проверка результата
if ($stmt->execute()) {
    echo "Данные успешно сохранены!";
} else {
    echo "Ошибка: " . $stmt->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>