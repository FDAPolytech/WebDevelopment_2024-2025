<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $topic = htmlspecialchars($_POST['topic']);
    $preferences = isset($_POST['preferences']) ? $_POST['preferences'] : [];

    // Формирование текста ответа
    $response = "Получена новая обратная связь:\n\n";
    $response .= "Имя: $firstName\n";
    $response .= "Фамилия: $lastName\n";
    $response .= "Электронная почта: $email\n";
    $response .= "Сообщение: $feedback\n";
    $response .= "Тема сообщения: $topic\n";

    if (!empty($preferences)) {
        $response .= "Предпочтения: " . implode(", ", $preferences) . "\n";
    } else {
        $response .= "Предпочтения: не указаны\n";
    }

    file_put_contents('feedback.txt', $response, FILE_APPEND);

    echo "Спасибо за ваш отзыв!";
} else {
    echo "Ошибка: форма отправлена некорректно.";
}
?>
