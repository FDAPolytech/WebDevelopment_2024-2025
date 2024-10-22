<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обратная связь</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Данные обратной связи</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $feedback = htmlspecialchars($_POST['feedback']);
        $category = htmlspecialchars($_POST['category']);
        $services = isset($_POST['services']) ? $_POST['services'] : [];

        echo "<h2>Ваши данные:</h2>";
        echo "<p><strong>Имя:</strong> " . $first_name . "</p>";
        echo "<p><strong>Фамилия:</strong> " . $last_name . "</p>";
        echo "<p><strong>Электронная почта:</strong> " . $email . "</p>";
        echo "<p><strong>Категория:</strong> " . $category . "</p>";
        echo "<p><strong>Обратная связь:</strong> " . $feedback . "</p>";
        echo "<p><strong>Выбранные услуги:</strong> " . implode(", ", $services) . "</p>";
    } else {
        echo "<p>Форма не была отправлена корректно.</p>";
    }
    ?>

    <br>
    <a href="index.html">Вернуться к форме</a>
</body>
</html>
