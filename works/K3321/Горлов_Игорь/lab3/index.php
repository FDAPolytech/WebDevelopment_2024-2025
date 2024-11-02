<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат</title>
</head>
<body>

<h1>Обратная связь</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $likes = isset($_POST['likes']) ? $_POST['likes'] : [];

    echo "<h1>Спасибо за ваш отзыв!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Как вы узнали о нас:</strong> $source</p>";
    echo "<p><strong>Что вам нравится:</strong> " . implode(", ", $likes) . "</p>";
} else {
    echo "<p>Ошибка: форма не отправлена.</p>";
}
?>
<br>

<a href="index.html">Вернуться к форме</a>
</body>
</html>


