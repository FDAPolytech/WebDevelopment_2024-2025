<?php
// Проверяем метод запроса
if ($_SERVER["REQUEST_METHOD"] === "GET" || $_SERVER["REQUEST_METHOD"] === "POST") {
    // Определяем, откуда поступили данные
    $data = ($_SERVER["REQUEST_METHOD"] === "POST") ? $_POST : $_GET;

    // Получение данных из формы
    $first_name = htmlspecialchars($data["first_name"] ?? "Не указано");
    $last_name = htmlspecialchars($data["last_name"] ?? "Не указано");
    $email = htmlspecialchars($data["email"] ?? "Не указано");
    $feedback = htmlspecialchars($data["feedback"] ?? "Не указано");
    $capy_beaver = htmlspecialchars($data["capy_beaver"] ?? "Не указан");
    $interests = isset($data["interests"]) ? $data["interests"] : [];

    // Вывод данных
    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Сообщение:</strong> $feedback</p>";
    echo "<p><strong>Капибара или бобёр:</strong> $capy_beaver</p>";

    if (!empty($interests)) {
        echo "<p><strong>Ваши интересы:</strong> " . implode(", ", $interests) . "</p>";
    } else {
        echo "<p><strong>Ваши интересы:</strong> Не указаны</p>";
    }

    echo "<p><strong>Метод отправки:</strong> " . $_SERVER["REQUEST_METHOD"] . "</p>";
} else {
    echo "<h1>Ошибка!</h1>";
    echo "<p>Неверный метод запроса.</p>";
}
?>
