<?php
// Данные для подключения к базе данных
$servername = "localhost";
$username = "root"; // стандартный пользователь XAMPP
$password = ""; // по умолчанию у root-пользователя нет пароля
$dbname = "feedback";

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$contactPreference = $_POST['contactPreference'];
$topics = isset($_POST['topics']) ? implode(', ', $_POST['topics']) : 'None';

// SQL-запрос для вставки данных
$sql = "INSERT INTO feedback (first_name, last_name, email, feedback, contact_preference, topics)
VALUES ('$firstName', '$lastName', '$email', '$feedback', '$contactPreference', '$topics')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения
$conn->close();
?>
