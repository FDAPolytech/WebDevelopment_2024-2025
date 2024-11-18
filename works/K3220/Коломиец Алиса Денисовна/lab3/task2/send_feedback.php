<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $feedback = htmlspecialchars(trim($_POST['feedback']));
    $source = htmlspecialchars(trim($_POST['source']));
    $contacts = isset($_POST['contacts']) ? implode(", ", $_POST['contacts']) : '';

    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "feedback";

    $conn = new mysqli($servername, $username, $password, $dbname);
  
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, lastname, mail, feedback, source, contacts) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $lastname, $mail, $feedback, $source, $contacts);

    if ($stmt->execute()) {
        echo "Сообщение успешно отправлено!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Неверный метод запроса.";
}
?>
