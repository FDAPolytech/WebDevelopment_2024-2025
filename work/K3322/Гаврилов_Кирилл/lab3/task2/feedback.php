<?php
// Устанавливаем путь к файлу отзывов
$file = 'feedbacks.txt';

// Функция для обработки POST
function PostRequest() {
    global $file;

    // Проверяем, что данные были отправлены
    if (isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['feedback'], $_POST['score'])) {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];
        $score = $_POST['score'];
        $services = isset($_POST['service']) ? implode(', ', $_POST['service']) : 'Не указано';

        $data = "Имя: $name $surname\nEmail: $email\nОценка: $score\nКомментарий: $feedback\nГде нашли нас: $services\n\n";

        file_put_contents($file, $data, FILE_APPEND );

        echo "<h3>Спасибо за ваш отзыв!</h3>";
        echo '<br>';
        echo '<form action="feedback.php" method="get">';
        echo '<input type="submit" value="Посмотреть ответы">';
        echo '</form>';
    } else {
        echo "<h3>Пожалуйста, заполните все поля формы.</h3>";
    }
}

// Функция для обработки GET
function GetRequest() {
    global $file;

    if (file_exists($file)) {
        // Читаем все отзывы из файла
        $feedbacks = file_get_contents($file);
        echo "<h3>Ваши отзывы:</h3>";
        echo "<pre>$feedbacks</pre>";
    } else {
        echo "<h3>Пока нет отзывов.</h3>";
    }
}

// Обработка запросов
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    PostRequest();
} else {
    GetRequest();
}
?>
