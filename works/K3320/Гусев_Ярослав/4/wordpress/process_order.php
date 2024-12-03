<?php
$servername = "db";
$username = "wordpress";
$password = "my_wordpress_db_password";
$dbname = "wordpress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$delivery_address = $_POST['delivery_address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$products = $_POST['products'];

$order_sql = "INSERT INTO orders (last_name, first_name, middle_name, delivery_address, phone, email, comment) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("sssssss", $last_name, $first_name, $middle_name, $delivery_address, $phone, $email, $comment);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

$order_product_sql = "INSERT INTO orders_products (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($order_product_sql);

foreach ($products as $product_id => $quantity) {
    if ($quantity > 0) {
        $price_result = $conn->query("SELECT price FROM products WHERE id = $product_id");
        $product = $price_result->fetch_assoc();
        $price = $product['price'];

        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }
}
$stmt->close();

$conn->close();

echo "Order submitted successfully!";
?>