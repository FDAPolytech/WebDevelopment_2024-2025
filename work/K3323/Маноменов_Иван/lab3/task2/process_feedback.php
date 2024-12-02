<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$message = $_POST['message'];
$grade = $_POST['grade'];
$options = isset($_POST['options']) ? implode(", ", $_POST['options']) : 'Нет дополнительных опций';


echo "<h2>Спасибо за ваш отзыв!</h2>";
echo "<p><strong>Имя:</strong> " . htmlspecialchars($first_name) . "</p>";
echo "<p><strong>Фамилия:</strong> " . htmlspecialchars($last_name) . "</p>";
echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
echo "<p><strong>Сообщение:</strong> " . nl2br(htmlspecialchars($message)) . "</p>";
echo "<p><strong>Оценка работы сервиса:</strong> " . htmlspecialchars($grade) . "</p>";
echo "<p><strong>Дополнительные опции:</strong> " . htmlspecialchars($options) . "</p>";
?>
