<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = htmlspecialchars($_POST['first_name'] ?? '');
    $lastName = htmlspecialchars($_POST['last_name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $feedback = htmlspecialchars($_POST['feedback'] ?? '');
    $option = htmlspecialchars($_POST['option'] ?? '');
    $checkboxes = $_POST['checkbox'] ?? [];

    $id = uniqid();

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

    $directory = __DIR__ . "/data";
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $filePath = $directory . "/{$id}.json";
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

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
