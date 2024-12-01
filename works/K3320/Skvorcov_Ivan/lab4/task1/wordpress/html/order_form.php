<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
</head>
<body>
    <h1>Place Your Order</h1>
    <form action="process_order.php" method="POST">
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" required></textarea><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="product">Product:</label><br>
        <select id="product" name="product" required>
            <option value="Product 1">Product 1</option>
            <option value="Product 2">Product 2</option>
            <option value="Product 3">Product 3</option>
        </select><br><br>

        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment"></textarea><br><br>

        <button type="submit">Submit Order</button>
    </form>
</body>
</html>