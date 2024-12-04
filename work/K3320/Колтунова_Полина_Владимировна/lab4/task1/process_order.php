<?php
// Настройки подключения к БД
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders_db";

// Подключение к БД
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'] ?? '';
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Проверка и обработка данных поля "products" (если это массив, преобразуем в строку)
$product = is_array($_POST['products']) ? implode(",", $_POST['products']) : $_POST['products'];

// Обработка комментариев
$comments = $_POST['comments'] ?? '';

// SQL-запрос для вставки данных
$sql = "INSERT INTO orders (lastname, firstname, middlename, address, phone, email, products, comments)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Подготовка SQL-запроса
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $conn->error);
}

// Привязка параметров
$stmt->bind_param("ssssssss", $lastName, $firstName, $middleName, $address, $phone, $email, $product, $comments);

// Выполнение запроса
if ($stmt->execute()) {
    echo "Order successfully placed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>
