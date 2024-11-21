<?php
// Проверка отправки формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $rating = htmlspecialchars($_POST['rating']);
    $preferences = isset($_POST['preferences']) ? $_POST['preferences'] : [];

    // Вывод полученной информации
    echo "<h2>Спасибо за ваш отзыв, $first_name!</h2>";
    echo "<p>Электронная почта: $email</p>";
    echo "<p>Ваш отзыв: $feedback</p>";
    echo "<p>Ваша оценка: $rating</p>";
    echo "<p>Ваши предпочтения: " . implode(", ", $preferences) . "</p>";
} else {
    echo "<p>Форма не была отправлена.</p>";
}
?>