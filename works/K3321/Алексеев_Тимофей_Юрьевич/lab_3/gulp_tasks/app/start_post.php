<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['first-name'];
    $surname = $_POST['second-name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $experience = $_POST['experience'];
    $points = count(isset($_POST['point']) ? $_POST['point'] : []);

    $data = "Имя: $name\nФамилия: $surname\nEmail: $email\nОбратная связь: $feedback\nОбщая оценка: $experience\nВыбрано аспектов: $points/4\n\n";

    file_put_contents('data.txt', $data, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обработанная обратная связь</title>
    <style> pre { font-family: 'Times New Roman', serif; font-size: 16px; } </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $fileContent = file_get_contents('data.txt');
        echo '<h1>Ваш отзыв:</h1>';
        echo "<pre>$fileContent</pre>";
    } else {
        echo '<h1>Спасибо за ваш отзыв!</h1>';
        echo '<br>';
        echo '<form action="start_post.php" method="get">';
        echo '<input type="submit" value="Посмотреть ответы">';
        echo '</form>';
    }
    ?>
</body>
</html>
