<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $preferences = isset($_POST['preferences']) ? $_POST['preferences'] : [];

    // Отправка данных
    echo "<h1>Спасибо за ваш отзыв!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Как вы узнали о нас:</strong> $source</p>";
    echo "<p><strong>Ваши предпочтения:</strong> " . implode(", ", $preferences) . "</p>";
} else {
    echo "Ошибка: форма не была отправлена.";
}
?>