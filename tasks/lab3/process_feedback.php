<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $interests = isset($_POST['interests']) ? $_POST['interests'] : [];

    echo "<h1>Спасибо за вашу обратную связь (POST)!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Как вы узнали о нас:</strong> $source</p>";

    if (!empty($interests)) {
        echo "<p><strong>Ваши интересы:</strong> " . implode(", ", $interests) . "</p>";
    } else {
        echo "<p><strong>Ваши интересы:</strong> Нет выбора.</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $first_name = htmlspecialchars($_GET['first_name']);
    $last_name = htmlspecialchars($_GET['last_name']);
    $email = htmlspecialchars($_GET['email']);
    $feedback = htmlspecialchars($_GET['feedback']);
    $source = htmlspecialchars($_GET['source']);
    $interests = isset($_GET['interests']) ? $_GET['interests'] : [];

    echo "<h1>Спасибо за вашу обратную связь (GET)!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Как вы узнали о нас:</strong> $source</p>";

    if (!empty($interests)) {
        echo "<p><strong>Ваши интересы:</strong> " . implode(", ", $interests) . "</p>";
    } else {
        echo "<p><strong>Ваши интересы:</strong> Нет выбора.</p>";
    }
} else {
    echo "<h1>Ошибка!</h1>";
    echo "<p>Форма не была отправлена корректно.</p>";
}
?>