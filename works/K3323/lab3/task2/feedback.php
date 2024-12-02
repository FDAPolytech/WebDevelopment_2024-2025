<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    $method = $_SERVER["REQUEST_METHOD"];
    $data = $method == "POST" ? $_POST : $_GET;

    $first_name = htmlspecialchars($data["first_name"] ?? '');
    $last_name = htmlspecialchars($data["last_name"] ?? '');
    $email = htmlspecialchars($data["email"] ?? '');
    $feedback = htmlspecialchars($data["feedback"] ?? '');
    $option = htmlspecialchars($data["option"] ?? '');
    $checkboxes = isset($data["checkbox"]) ? $data["checkbox"] : [];

    echo "<h1>Полученные данные ({$method}):</h1>";
    echo "<p>Имя: $first_name</p>";
    echo "<p>Фамилия: $last_name</p>";
    echo "<p>Электронная почта: $email</p>";
    echo "<p>Обратная связь: $feedback</p>";
    echo "<p>Выбранный вариант: $option</p>";
    echo "<p>Выбранные чекбоксы:</p>";
    echo "<ul>";
    foreach ($checkboxes as $checkbox) {
        echo "<li>" . htmlspecialchars($checkbox) . "</li>";
    }
    echo "</ul>";
}
?>

