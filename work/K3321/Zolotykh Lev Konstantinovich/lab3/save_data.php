<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем данные из формы
    $firstName = htmlspecialchars($_POST['first_name'] ?? '');
    $lastName = htmlspecialchars($_POST['last_name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $feedback = htmlspecialchars($_POST['feedback'] ?? '');
    $option = htmlspecialchars($_POST['option'] ?? '');
    $checkboxes = $_POST['checkbox'] ?? [];

    // Генерируем уникальный ID
    $id = uniqid();

    // Формируем данные для записи
    $data = [
        "id" => $id,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "feedback" => $feedback,
        "option" => $option,
        "checkboxes" => $checkboxes,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    // Сохраняем данные в файл
    $filePath = __DIR__ . "/data/{$id}.json";
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Выводим страницу с ID и кнопкой получения данных
    echo "<!DOCTYPE html>";
    echo "<html lang='ru'>";
    echo "<head><meta charset='UTF-8'><title>Результат</title></head>";
    echo "<body>";
    echo "<h1>Данные успешно сохранены!</h1>";
    echo "<p>Идентификатор записи: <strong>{$id}</strong></p>";
    echo "<form action='get_data.php' method='get' target='_self'>";
    echo "    <input type='hidden' name='id' value='{$id}'>";
    echo "    <button type='submit'>Получить данные</button>";
    echo "</form>";
    echo "</body>";
    echo "</html>";
} else {
    echo "<h1>Ошибка: запрос должен быть методом POST</h1>";
}
?>
