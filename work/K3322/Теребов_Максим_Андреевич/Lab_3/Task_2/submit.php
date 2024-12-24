<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "GET") {
    // Определяем источник данных
    $data = ($_SERVER["REQUEST_METHOD"] === "POST") ? $_POST : $_GET;

    // Получение данных с защитой
    $firstname = htmlspecialchars($data['firstname'] ?? '');
    $lastname = htmlspecialchars($data['lastname'] ?? '');
    $email = htmlspecialchars($data['email'] ?? '');
    $feedback = htmlspecialchars($data['feedback'] ?? '');
    $category = htmlspecialchars($data['category'] ?? '');
    $preferences = isset($data['preferences']) ? $data['preferences'] : [];

    // Вывод данных
    echo "<h1>Ваши данные ({$_SERVER["REQUEST_METHOD"]}):</h1>";
    echo "Имя: $firstname<br>";
    echo "Фамилия: $lastname<br>";
    echo "Электронная почта: $email<br>";
    echo "Сообщение: $feedback<br>";
    echo "Категория: $category<br>";
    echo "Предпочтения: " . (empty($preferences) ? "Нет" : implode(", ", $preferences)) . "<br>";
} else {
    echo "<h1>Неизвестный метод</h1>";
}
?>