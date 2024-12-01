<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $gender = htmlspecialchars($_POST['gender']);
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    echo "<h1>Ваши данные:</h1>";
    echo "<p>Имя: $firstName</p>";
    echo "<p>Фамилия: $lastName</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Отзыв: $feedback</p>";
    echo "<p>Ваш выбор: $gender</p>";
    echo "<p>Категории: " . implode(', ', $categories) . "</p>";
}
?>
