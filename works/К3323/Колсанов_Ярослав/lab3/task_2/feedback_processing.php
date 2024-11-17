<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $course_rating = htmlspecialchars($_POST['course_rating']);
    $suggestions = htmlspecialchars($_POST['suggestions']);
    $topics = isset($_POST['topics']) ? $_POST['topics'] : [];

    echo "<h1>Спасибо за вашу обратную связь (POST)!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Оценка курса:</strong> $course_rating</p>";
    echo "<p><strong>Пожелания и предложения:</strong> $suggestions</p>";
    
    if (!empty($topics)) {
        echo "<p><strong>Интересующие темы:</strong> " . implode(", ", $topics) . "</p>";
    } else {
        echo "<p><strong>Интересующие темы:</strong> Не выбрано.</p>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $first_name = htmlspecialchars($_GET['first_name']);
    $last_name = htmlspecialchars($_GET['last_name']);
    $email = htmlspecialchars($_GET['email']);
    $course_rating = htmlspecialchars($_GET['course_rating']);
    $suggestions = htmlspecialchars($_GET['suggestions']);
    $topics = isset($_GET['topics']) ? $_GET['topics'] : [];

    echo "<h1>Спасибо за вашу обратную связь (GET)!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Оценка курса:</strong> $course_rating</p>";
    echo "<p><strong>Пожелания и предложения:</strong> $suggestions</p>";

    if (!empty($topics)) {
        echo "<p><strong>Интересующие темы:</strong> " . implode(", ", $topics) . "</p>";
    } else {
        echo "<p><strong>Интересующие темы:</strong> Не выбрано.</p>";
    }
} else {
    echo "<h1>Ошибка!</h1>";
    echo "<p>Форма не была отправлена корректно.</p>";
}
?>

