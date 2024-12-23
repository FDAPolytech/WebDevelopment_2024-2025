<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $genres = isset($_POST['genres']) ? implode(", ", $_POST['genres']) : "Не выбрано";
    $feedback = $_POST['feedback'];

    // Форматируем строку для сохранения
    $data = "Имя: $firstName\nФамилия: $lastName\nЭлектронная почта: $email\nОценка: $rating\nЛюбимые жанры: $genres\nКомментарий: $feedback\n---\n";

    // Сохраняем данные в файл
    $file = fopen("feedback_data.txt", "a"); // Открываем файл для добавления данных
    if ($file) {
        fwrite($file, $data);
        fclose($file);
        echo "Ваши данные успешно отправлены. Спасибо за обратную связь!";
    } else {
        echo "Ошибка при сохранении данных.";
    }
} else {
    echo "Неверный метод отправки данных.";
}
?>
