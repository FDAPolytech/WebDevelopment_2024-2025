<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $feedback = $_POST['feedback'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $interests = $_POST['interests'] ?? [];

    echo "<h1>Спасибо за вашу обратную связь!</h1>";
    echo "Имя: $first_name<br>";
    echo "Фамилия: $last_name<br>";
    echo "Email: $email<br>";
    echo "Пол: $gender<br>";
    echo "Интересы: " . implode(", ", $interests) . "<br>";
    echo "Сообщение: $feedback<br>";
}
?>
