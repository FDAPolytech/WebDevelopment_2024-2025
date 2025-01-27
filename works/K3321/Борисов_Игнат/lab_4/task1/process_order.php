<?php
$host = 'localhost';
$dbname = 'shop';
$username = 'root';
$password = 'root';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comment = $_POST['comment'];

$sql = "INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comment)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comment);

if ($stmt->execute()) {
    $orderId = $stmt->insert_id;

    $query = "SELECT * FROM orders WHERE id = ?";
    $stmt_select = $conn->prepare($query);
    $stmt_select->bind_param("i", $orderId);
    $stmt_select->execute();

    $result = $stmt_select->get_result();
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo "<h1>Заказ успешно добавлен!</h1>";
        echo "<p><strong>ID заказа:</strong> " . $order['id'] . "</p>";
        echo "<p><strong>Фамилия:</strong> " . htmlspecialchars($order['surname']) . "</p>";
        echo "<p><strong>Имя:</strong> " . htmlspecialchars($order['name']) . "</p>";
        echo "<p><strong>Отчество:</strong> " . htmlspecialchars($order['patronymic']) . "</p>";
        echo "<p><strong>Адрес доставки:</strong> " . htmlspecialchars($order['address']) . "</p>";
        echo "<p><strong>Телефон:</strong> " . htmlspecialchars($order['phone']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($order['email']) . "</p>";
        echo "<p><strong>Товар:</strong> " . htmlspecialchars($order['product']) . "</p>";
        echo "<p><strong>Комментарий:</strong> " . htmlspecialchars($order['comment']) . "</p>";
        echo "<p><strong>Дата заказа:</strong> " . $order['created_at'] . "</p>";
    } else {
        echo "Ошибка: данные о заказе не найдены.";
    }
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
