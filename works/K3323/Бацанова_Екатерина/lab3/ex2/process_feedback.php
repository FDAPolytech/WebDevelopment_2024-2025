<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    echo '<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Feedback Received</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Спасибо за обратную связь!</h1>';
    
    echo "<p><strong>Имя:</strong> $firstName $lastName</p>";
    echo "<p><strong>Фамилия:</strong> $email</p>";
    echo "<p><strong>Отзыв:</strong> $feedback</p>";
    echo "<p><strong>Как вы узнали о нас:</strong> $source</p>";
    
    if (!empty($services)) {
        echo "<p><strong>Интересующие Вас сферы:</strong> " . implode(", ", $services) . "</p>";
    } else {
        echo "<p><strong>Интересующие Вас сферы:</strong>Не выбрано</p>";
    }

    echo '<a href="feedback_form.html" class="submit-btn" 
    style="text-align: center; display: block; width: 50%; margin: 20px auto;">Обратно к форме</a>
        </div>
    </body>
    </html>';
} else {
    echo "<p>Invalid request.</p>";
}
?>

