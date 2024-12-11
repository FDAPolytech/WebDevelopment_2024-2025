<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    // Получаем ID из GET-запроса
    $id = htmlspecialchars($_GET['id']);
    $filePath = __DIR__ . "/data/{$id}.json";

    if (file_exists($filePath)) {
        // Читаем данные из файла
        $data = json_decode(file_get_contents($filePath), true);

        // Выводим данные
        echo "<!DOCTYPE html>";
        echo "<html lang='ru'>";
        echo "<head><meta charset='UTF-8'><title>Полученные данные</title></head>";
        echo "<body>";
        echo "<h1>Данные с идентификатором: {$id}</h1>";
        echo "<p><strong>Имя:</strong> " . htmlspecialchars($data['first_name']) . "</p>";
        echo "<p><strong>Фамилия:</strong> " . htmlspecialchars($data['last_name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($data['email']) . "</p>";
        echo "<p><strong>Сообщение:</strong> " . htmlspecialchars($data['feedback']) . "</p>";
        echo "<p><strong>Выбранный вариант:</strong> " . htmlspecialchars($data['option']) . "</p>";
        echo "<p><strong>Выбранные чекбоксы:</strong></p><ul>";
        foreach ($data['checkboxes'] as $checkbox) {
            echo "<li>" . htmlspecialchars($checkbox) . "</li>";
        }
        echo "</ul>";
        echo "<p><strong>Время отправки:</strong> " . htmlspecialchars($data['timestamp']) . "</p>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "<h1>Ошибка: данные с ID {$id} не найдены</h1>";
    }
} else {
    echo "<h1>Ошибка: запрос должен содержать параметр ID</h1>";
}
?>
