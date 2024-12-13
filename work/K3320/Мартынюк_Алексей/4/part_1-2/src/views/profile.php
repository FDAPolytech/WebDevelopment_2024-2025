<?php

require __DIR__ . '/../config.php';
require __DIR__ .'/../data/user.php';
require __DIR__ .'/../data/order.php';

if (!is_auth()) {
    header('Location: /signin.php');
    exit;
}

$userRepository = new UserRepository($pdo);
$user = $userRepository->getById($_SESSION['user_id']);

$orderRepository = new OrderRepository($pdo);
$orders = $orderRepository->getByUserID($_SESSION['user_id']);

$productRepository = new ProductRepository($pdo);

$products = [];
foreach ($orders as $order) {
    $products = array_merge($products, $productRepository->getByOrderId($order->id));
}

$products = array_unique($products, SORT_REGULAR);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php require __DIR__ . '/partials/navigation.php'; ?>

    <div class="profile">
        <p>Name: <?= $user->first_name . ' ' . $user->last_name ?></p>
        <p>Email: <?= $user->email ?></p>
        <p>Previously ordered:</p>
    </div>

    <?php require __DIR__ . '/partials/products.php'; ?>
 
</body>
</html>
