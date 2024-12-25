<?php
// Подключаемся к базе данных
$servername = "localhost";
$username = "root";  // Используем "root", если нет пароля
$password = "";      // Пустой пароль по умолчанию
$dbname = "lab4_2_db"; // Замените на имя вашей базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем логин и пароль из формы
$login = $_POST['login'];
$password = $_POST['password'];

// Функция для инвертирования битов пароля
function invert_bits($str) {
    $inverted = '';
    // Проходим по каждому символу пароля
    for ($i = 0; $i < strlen($str); $i++) {
        // Получаем ASCII код символа
        $ascii = ord($str[$i]);
        // Инвертируем биты символа
        $inverted_char = chr(~$ascii & 0xFF); // Инвертируем биты и ограничиваем 8 битами
        $inverted .= $inverted_char;
    }
    return $inverted;
}

// Инвертируем биты пароля
$inverted_password = invert_bits($password);

// Подготавливаем SQL-запрос для вставки данных в таблицу
$sql = "INSERT INTO user_passwords (login, password, inverted_password) 
        VALUES ('$login', '$password', '$inverted_password')";

// Выполняем запрос
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно добавлены!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрываем соединение с базой данных
$conn->close();
?>
