<?php
// Проверяем, каким методом (GET или POST) отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    $method = $_SERVER["REQUEST_METHOD"]; // Сохраняем текущий метод
    $data = $method == "POST" ? $_POST : $_GET; // В зависимости от метода, получаем данные из $_POST или $_GET

    // Безопасно обрабатываем полученные данные
    $first_name = htmlspecialchars($data["first_name"] ?? '');
    $last_name = htmlspecialchars($data["last_name"] ?? '');
    $email = htmlspecialchars($data["email"] ?? '');
    $feedback = htmlspecialchars($data["feedback"] ?? '');
    $option = htmlspecialchars($data["option"] ?? '');
    $checkboxes = isset($data["checkbox"]) ? $data["checkbox"] : [];

    // Генерируем HTML-ответ
    echo "<h1>Полученные данные ({$method}):</h1>";
    echo "<p>Имя: $first_name</p>";
    echo "<p>Фамилия: $last_name</p>";
    echo "<p>Электронная почта: $email</p>";
    echo "<p>Сообщение: $feedback</p>";
    echo "<p>Выбранный вариант: $option</p>";

    echo "<p>Выбранные чекбоксы:</p>";
    echo "<ul>";
    foreach ($checkboxes as $checkbox) {
        echo "<li>" . htmlspecialchars($checkbox) . "</li>";
    }
    echo "</ul>";
}
?>
