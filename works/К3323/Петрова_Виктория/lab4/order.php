<?php
// Подключение к базе данных
$host = "localhost";
$username = "root";
$password = "";
$database = "market_db";

$conn = new mysqli($host, $username, $password, $database);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $product = $conn->real_escape_string($_POST['product']);
    $comments = $conn->real_escape_string($_POST['comments']);

    // SQL-запрос на вставку данных
    $sql = "INSERT INTO market (fullname, address, phone, email, product, comments)
            VALUES ('$fullname', '$address', '$phone', '$email', '$product', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Заказ успешно оформлен!'); window.location.href='index.html';</script>";
    } else {
        echo "Ошибка: " . $conn->error;
    }
}

$conn->close();
?>
