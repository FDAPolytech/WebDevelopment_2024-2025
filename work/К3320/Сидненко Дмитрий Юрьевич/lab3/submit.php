<?php
// Проверяем, какой метод используется (GET или POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST;
} else {
    $method = $_GET;
}

// Получение данных из формы
$name = $method['name'] ?? '';
$surname = $method['surname'] ?? '';
$email = $method['email'] ?? '';
$feedback = $method['feedback'] ?? '';
$source = $method['source'] ?? '';
$services = $method['services'] ?? [];

// Проверяем обязательные поля
if (empty($name) || empty($surname) || empty($email) || empty($feedback) || empty($source)) {
    echo "<h1>Ошибка!</h1><p>Пожалуйста, заполните все обязательные поля.</p>";
    exit;
}

// Вывод данных
echo "<h1>Спасибо за обратную связь!</h1>";
echo "<p><b>Имя:</b> $name</p>";
echo "<p><b>Фамилия:</b> $surname</p>";
echo "<p><b>Электронная почта:</b> $email</p>";
echo "<p><b>Ваш отзыв:</b> $feedback</p>";
echo "<p><b>Как узнали:</b> $source</p>";

// Обрабатываем чекбоксы
if (!empty($services)) {
    echo "<p><b>Интересующие услуги:</b> " . implode(', ', $services) . "</p>";
} else {
    echo "<p><b>Интересующие услуги:</b> Не выбрано</p>";
}
?>
