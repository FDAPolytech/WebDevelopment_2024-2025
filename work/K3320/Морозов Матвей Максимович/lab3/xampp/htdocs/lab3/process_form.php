<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $query_type = $_POST['query_type'];
    $newsletter = isset($_POST['newsletter']) ? 'Yes' : 'No';
    $updates = isset($_POST['updates']) ? 'Yes' : 'No';
    $offers = isset($_POST['offers']) ? 'Yes' : 'No';

    // Выводим данные
    echo "<h2>Ваша информация:</h2>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Тип запроса:</strong> $query_type</p>";
    echo "<p><strong>Подписка на новости:</strong> $newsletter</p>";
    echo "<p><strong>Получать обновления:</strong> $updates</p>";
    echo "<p><strong>Получать предложения:</strong> $offers</p>";
} else {
    echo "Форма не была отправлена.";
}
?>
