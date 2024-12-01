<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение данных из формы
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $rating = htmlspecialchars($_POST['rating']);
    $aspects = isset($_POST['aspects']) ? $_POST['aspects'] : [];

    // Отображение полученной информации
    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p><strong>Имя:</strong> $first_name</p>";
    echo "<p><strong>Фамилия:</strong> $last_name</p>";
    echo "<p><strong>Электронная почта:</strong> $email</p>";
    echo "<p><strong>Сообщение:</strong> $feedback</p>";
    echo "<p><strong>Оценка:</strong> $rating</p>";

    if (!empty($aspects)) {
        echo "<p><strong>Важные аспекты:</strong> " . implode(", ", $aspects) . "</p>";
    } else {
        echo "<p><strong>Важные аспекты:</strong> не выбраны</p>";
    }
} else {
    echo "Некорректный метод запроса. Пожалуйста, отправьте форму заново.";
}
?>