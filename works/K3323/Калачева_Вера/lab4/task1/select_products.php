<?php
$conn = mysqli_connect("lab4_task1.local", "root", "", "4_lab");

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получаем список товаров из таблицы products
$sql = "SELECT id, product FROM products";
$result = mysqli_query($conn, $sql);

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
mysqli_close($conn);

echo json_encode($products);
?>