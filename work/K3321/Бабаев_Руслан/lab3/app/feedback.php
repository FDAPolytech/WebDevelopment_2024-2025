<?php
header('Content-Type: text/html; charset=UTF-8');
$filename = 'feedback.txt';

$first_name = $last_name = $email = $message = $source = '';
$interests = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Неверный формат электронной почты.";
        include 'feedback.html';
        exit;
    }

    $message = htmlspecialchars($_POST['message']);
    $source = isset($_POST['source']) ? htmlspecialchars($_POST['source']) : '';
    $interests = isset($_POST['interests']) ? $_POST['interests'] : [];

    $feedbackMessage = "Получено следующее сообщение обратной связи:\n\n";
    $feedbackMessage .= "Имя: $first_name\n";
    $feedbackMessage .= "Фамилия: $last_name\n";
    $feedbackMessage .= "Email: $email\n";
    $feedbackMessage .= "Ваше сообщение: $message\n";
    $feedbackMessage .= "Откуда узнали о нас: $source\n";
    $feedbackMessage .= "Ваши интересы:\n";
    foreach ($interests as $interest) {
        $feedbackMessage .= "- $interest\n";
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
