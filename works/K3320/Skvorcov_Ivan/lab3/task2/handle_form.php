<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    // Выводим данные для демонстрации
    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Обратная связь:</strong> $feedback</p>";
    echo "<p><strong>Источник:</strong> $source</p>";
    echo "<p><strong>Интересующие услуги:</strong> " . implode(", ", $services) . "</p>";
} else {
    echo "Форма должна быть отправлена методом POST.";
}
?>