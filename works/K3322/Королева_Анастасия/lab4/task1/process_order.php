<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $host = 'localhost';
    $dbname = 'orders_db';
    $username = 'root';
    $password = 'root';

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        echo 'Errno: '.$mysqli->connect_errno;
        echo '<br>';
        echo 'Error: '.$mysqli->connect_error;
        exit();
    }

    // Сбор данных из формы
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $comment = $_POST['comment'];

    // Вставка данных в таблицу
    $sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, product, comment) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo "Ошибка подготовки запроса: " . $mysqli->error;
        exit();
    }

    $stmt->bind_param(
        'ssssssss', // Тип данных - все строки
        $last_name, 
        $first_name, 
        $middle_name, 
        $address, 
        $phone, 
        $email, 
        $product, 
        $comment
    );

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Форма успешно отправлена!";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    // Закрытие запроса и соединения
    $stmt->close();
    $mysqli->close();
} else {
    echo "Ошибка";
}
?>
