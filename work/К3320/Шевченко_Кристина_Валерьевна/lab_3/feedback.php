<?php
// Проверяем, что данные отправлены методом POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получаем данные из формы
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : 'Не указано';
    $topics = isset($_POST['topics']) ? $_POST['topics'] : [];
    $message = htmlspecialchars($_POST['message']);

    // Вывод данных на экран (эмуляция обработки)
    echo "<h1>Данные формы обратной связи</h1>";
    echo "<p><strong>Имя:</strong> $name</p>";
    echo "<p><strong>Фамилия:</strong> $surname</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Пол:</strong> $gender</p>";

    echo "<p><strong>Темы обратной связи:</strong></p>";
    if (!empty($topics)) {
        echo "<ul>";
        foreach ($topics as $topic) {
            echo "<li>" . htmlspecialchars($topic) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Темы не выбраны.</p>";
    }

    echo "<p><strong>Сообщение:</strong></p>";
    echo "<p>$message</p>";
} else {
    echo "<p>Данные формы не были отправлены.</p>";
}
?>
