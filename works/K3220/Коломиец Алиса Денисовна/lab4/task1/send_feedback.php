<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Получение данных из формы
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $name = htmlspecialchars(trim($_POST['name']));
    $patronymic = htmlspecialchars(trim($_POST['patronymic']));
    $address = htmlspecialchars(trim($_POST['address']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $comment = htmlspecialchars(trim($_POST['comment']));
    $product = htmlspecialchars(trim($_POST['product']));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "order-form";

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Подготовка SQL-запроса
    $sql = "INSERT INTO orders (lastname, name, patronymic, address, phone, mail, comment, product) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Связывание параметров - 8 строк (s для всех строк)
    $stmt->bind_param("ssssssss", $lastname, $name, $patronymic, $address, $phone, $mail, $comment, $product);

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Сообщение успешно отправлено!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();
} else {
    echo "Неверный метод запроса.";
}
?>
