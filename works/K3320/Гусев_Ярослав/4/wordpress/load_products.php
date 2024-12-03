<?php
$servername = "db";
$username = "wordpress";
$password = "my_wordpress_db_password";
$dbname = "wordpress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, price FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<label for="product_' . $row['id'] . '">' . htmlspecialchars($row['name']) . ' ($' . htmlspecialchars($row['price']) . '):</label>';
        echo '<input type="number" id="product_' . $row['id'] . '" name="products[' . $row['id'] . ']" min="0" value="0" placeholder="Quantity">';
        echo '</div>';
    }
} else {
    echo "<p>No products available.</p>";
}

$conn->close();
?>