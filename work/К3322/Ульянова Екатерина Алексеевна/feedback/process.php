<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $category = htmlspecialchars($_POST['category']);
    $topics = isset($_POST['topics']) ? $_POST['topics'] : [];

    echo "<h1>Спасибо за ваш отзыв, $first_name</h1>";
} else {
    echo "<h1>Ошибка: Данные не отправлены.</h1>";
}
?>
