<?php
header('Content-Type: text/html; charset=UTF-8');
$filename = 'feedback.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $opinion = htmlspecialchars($_POST['opinion']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Неверный формат электронной почты.";
        exit;
    }

    $visit_frequency = isset($_POST['visit_frequency']) ? $_POST['visit_frequency'] : '';
    $experiences = isset($_POST['experience']) ? $_POST['experience'] : [];

    $feedbackMessage = "Получено следующее сообщение обратной связи:\n\n";
    $feedbackMessage .= "Имя: $name\n";
    $feedbackMessage .= "Фамилия: $surname\n";
    $feedbackMessage .= "Email: $email\n";
    $feedbackMessage .= "Ваше мнение о сайте: $opinion\n";
    $feedbackMessage .= "Частота посещения: $visit_frequency\n";
    $feedbackMessage .= "Опыт использования:\n";
    foreach ($experiences as $exp) {
        $feedbackMessage .= "- $exp\n";
    }

    if (file_put_contents($filename, $feedbackMessage . "\n\n------------------------\n", FILE_APPEND) === false) {
        echo "Ошибка при сохранении отзыва. Пожалуйста, попробуйте позже.";
        exit;
    }

    echo "Спасибо за ваш отзыв!";
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include 'feedback.html';
}
?>