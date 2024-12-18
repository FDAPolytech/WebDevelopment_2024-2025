<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Получение данных из формы
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $middlename = htmlspecialchars(trim($_POST['middlename']));
    $address = htmlspecialchars(trim($_POST['address']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $comments = htmlspecialchars(trim($_POST['comments']));
    $product = htmlspecialchars(trim($_POST['product']));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab4";

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Подготовка SQL-запроса
    $sql = "INSERT INTO task1 (lastname, firstname, middlename, address, phone, email, comments, product) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Связывание параметров - 8 строк (s для всех строк)
    $stmt->bind_param("ssssssss", $lastname, $firstname, $middlename, $address, $phone, $email, $comments, $product);

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Ваш заказ успешно оформлен!";
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