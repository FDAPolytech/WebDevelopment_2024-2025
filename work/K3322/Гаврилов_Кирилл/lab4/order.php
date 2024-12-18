<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "orders";

    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit();
    }
    $firstname = $_POST['firstname'];
    $lastname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $fathername = $_POST['fathername'];
    $product = isset($_POST['product']) ? $_POST['product'] : null;
    $add = $_POST['add'];

    $sql = "INSERT INTO orders (firstname, lastname, email, phone, `address`, fathername, product, `add`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $phone, $address, $fathername, $product, $add);

    if ($stmt->execute()) {
        echo "Данные успешно добавлены в базу данных";
    } else {
        echo "Ошибка при добавлении данных: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

}