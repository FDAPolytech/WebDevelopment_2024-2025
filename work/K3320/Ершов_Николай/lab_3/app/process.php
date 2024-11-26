<?php
// process.php

// Проверяем метод запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы методом POST
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : 'Не указано';
    $topics = isset($_POST['topics']) ? $_POST['topics'] : [];

    // Отображение полученных данных
    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p><strong>Имя:</strong> $firstname</p>";
    echo "<p><strong>Фамилия:</strong> $lastname</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Пол:</strong> $gender</p>";
    echo "<p><strong>Интересующие темы:</strong> " . implode(', ', $topics) . "</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Получение данных из формы методом GET
    $firstname = isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : '';
    $lastname = isset($_GET['lastname']) ? htmlspecialchars($_GET['lastname']) : '';
    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
    $feedback = isset($_GET['feedback']) ? htmlspecialchars($_GET['feedback']) : '';
    $gender = isset($_GET['gender']) ? htmlspecialchars($_GET['gender']) : 'Не указано';
    $topics = isset($_GET['topics']) ? $_GET['topics'] : [];

    // Отображение полученных данных
    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p><strong>Имя:</strong> $firstname</p>";
    echo "<p><strong>Фамилия:</strong> $lastname</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Пол:</strong> $gender</p>";
    echo "<p><strong>Интересующие темы:</strong> " . implode(', ', $topics) . "</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
} else {
    echo "Некорректный метод запроса.";
}
?>
