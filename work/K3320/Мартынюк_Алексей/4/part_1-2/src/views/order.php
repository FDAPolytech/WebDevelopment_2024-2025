<?php

require __DIR__ . '/../config.php';
require __DIR__ .'/../data/user.php';
require __DIR__ .'/../data/order.php';

if (!is_auth()) {
    header('Location: /signin.php');
    exit;
}

$userRepository = new UserRepository($pdo);
$orderRepository = new OrderRepository($pdo);
$productRepository = new ProductRepository($pdo);

$user = $userRepository->getById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order = new Order();
    $order->user_id = $_SESSION['user_id'];
    $order->address_id = $_POST["address"];
    $order->status = "progress";
    $order->comment = $_POST["comment"];

    $items = [];
    foreach ($_SESSION["cart"] as $product_id => $count) {
        $item = new OrderItems();
        $item->product_id = $product_id;
        $item->amount = $count;
        $item->price_per_unit = $productRepository->getById($product_id)->price;
        $items[] = $item;
    }

    $orderRepository->insert($order, $items);

    header('Location: /search.php');
    exit;
}

$orders = $orderRepository->getByUserID($_SESSION['user_id']);

$products = [];
$productsTotal = 0;
$productsTotalPrice = 0;
foreach ($_SESSION["cart"] as $product_id => $count) {
    $products[] = $productRepository->getById($product_id);
    $productsTotal += $count;
    $productsTotalPrice += $count * $productRepository->getById($product_id)->price;
}

$addresses = $userRepository->getAdressesById($_SESSION["user_id"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php require __DIR__ . '/partials/navigation.php'; ?>

    <div id="order-form">
        <form method="post" action="/order.php">
            <h2>Order Form</h2><br>

            <h3>Total Items: <?= $productsTotal ?></h3>
            <h3>Total Price: <?= $productsTotalPrice ?> rub.</h3>

            <div class="input-box">
                <input type="text" id="phone-number" name="phone-number" placeholder="Phone Number" required><br><br>
            </div>

            <div class="input-box">
                <select id="address" name="address" onchange="toggleNewAddressInput(this.value)" placeholder="Select Address">
                    <option value="new">Create New Address</option>
                    <?php foreach ($addresses as $address): ?>
                        <option value="<?php echo $address->id; ?>"><?php echo $address->address . ', ' . $address->postcode; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
            </div>

            <div class="input-box" id="new-address-container">
                <input type="text" id="new-address" name="new-address" placeholder="New Address"><br><br>
            </div>

            <div class="input-box">
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Comment"></textarea><br><br>
            </div>

            <div class="input-box">
                <input type="submit" value="Place Order">
            </div>
        </form>
    </div>  

    <script>
        function toggleNewAddressInput(selectedValue) {
            const newAddressContainer = document.getElementById('new-address-container');
            if (selectedValue !== 'new') {
                newAddressContainer.style.display = 'none';
            } else {
                newAddressContainer.style.display = 'block';
            }
        }
    </script>
</body>
</html>
