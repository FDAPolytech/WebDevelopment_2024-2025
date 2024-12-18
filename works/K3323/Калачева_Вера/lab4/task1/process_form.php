<?php
// Подключение к базе данных
$conn = mysqli_connect("lab4_task1.local", "root", "", "4_lab");

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получаем данные из формы
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'] ?? '';
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$comment = $_POST['comment'] ?? '';
$products = $_POST['products'];

$user_sql = "INSERT INTO users (last_name, first_name, middle_name, phone, email)
              VALUES (?, ?, ?, ?, ?)";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("sssss", $last_name, $first_name, $middle_name, $phone, $email);

if ($user_stmt->execute()) {
    $user_id = $conn->insert_id;

    // Вставляем данные о заказе в таблицу orders
    $order_sql = "INSERT INTO orders (user_id, comment, address) VALUES (?, ?, ?)";
    $order_stmt = $conn->prepare($order_sql);
    $order_stmt->bind_param("iss", $user_id, $comment, $address);

    if ($order_stmt->execute()) {
        $order_id = $conn->insert_id;

        // Вставляем выбранные продукты в таблицу order_items
        foreach ($products as $product_id) {
            $item_sql = "INSERT INTO order_products (order_id, product_id) VALUES (?, ?)";
            $item_stmt = $conn->prepare($item_sql);
            $item_stmt->bind_param("ii", $order_id, $product_id);

            if (!$item_stmt->execute()) {
                echo "Ошибка при добавлении товара с ID $product_id в заказ<br>";
            }
        }

        echo "Заказ успешно создан!<br>";
        echo "ID клиента: $user_id<br>";
        echo "ID заказа: $order_id<br>";
        echo "Выбранные товары:<br>";
        foreach ($products as $product_id) {
            echo "- Товар с ID: $product_id<br>";
        }
    } else {
        echo "Ошибка при создании заказа<br>";
    }
} else {
    echo "Ошибка при добавлении клиента<br>";
}

// Закрываем соединение с базой данных
$conn->close();
?>