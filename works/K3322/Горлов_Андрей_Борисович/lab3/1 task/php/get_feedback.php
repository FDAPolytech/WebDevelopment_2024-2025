<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-запрос для выборки всех данных из таблицы feedback
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    // Сохранение данных в массив
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Вывод данных в формате JSON
header('Content-Type: application/json');
echo json_encode($data);

// Закрытие соединения
$conn->close();
?>
