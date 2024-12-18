<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $source = htmlspecialchars(trim($_POST['source']));
    $contacts = isset($_POST['contacts']) ? implode(", ", $_POST['contacts']) : '';

    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "lab3";

    $conn = new mysqli($servername, $username, $password, $dbname);
  
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $sql = "INSERT INTO task2 (name, surname, email, message, source, contacts) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $surname, $email, $message, $source, $contacts);

    if ($stmt->execute()) {
        echo "Ваше сообщение отправлено в нашу компанию!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Неверный метод запроса.";
}
?>