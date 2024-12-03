<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Order Form</title>
</head>
<body>
    <h1>Place Your Order</h1>
    <form action="process_order.php" method="POST">
        <h2>Customer Information</h2>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name"><br><br>

        <label for="address">Delivery Address:</label>
        <textarea id="address" name="delivery_address" required></textarea><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <h2>Products</h2>
        <p>Select products and specify quantity:</p>

        <div id="products">
            <?php include 'load_products.php'; ?>
        </div>

        <br>
        <label for="comment">Order Comments:</label>
        <textarea id="comment" name="comment"></textarea><br><br>

        <button type="submit">Submit Order</button>
    </form>
</body>
</html>