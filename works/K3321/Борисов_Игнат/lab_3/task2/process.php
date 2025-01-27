<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $feedback = htmlspecialchars($_POST["feedback"]);
    $category = htmlspecialchars($_POST["category"]);
    $options = isset($_POST["options"]) ? $_POST["options"] : [];

    echo "<h1>Спасибо за обратную связь!</h1>";
    echo "<p>Имя: $first_name</p>";
    echo "<p>Фамилия: $last_name</p>";
    echo "<p>Электронная почта: $email</p>";
    echo "<p>Ваш отзыв: $feedback</p>";
    echo "<p>Категория: $category</p>";
    
    if (!empty($options)) {
        echo "<p>Вы выбрали следующие параметры:</p><ul>";
        foreach ($options as $option) {
            echo "<li>" . htmlspecialchars($option) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Вы не выбрали дополнительные параметры.</p>";
    }
} else {
    echo "<h1>Ошибка: данные должны быть отправлены методом POST.</h1>";
}
?>
