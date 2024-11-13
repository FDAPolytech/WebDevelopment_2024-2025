<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasK_1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$products = $_POST['products'];
$comment = $_POST['comment'];

try {
  $conn->begin_transaction();

  $sql = "INSERT INTO customers (name, lastname, patronymic, address, phone, email) 
          VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssss", $name, $lastname, $patronymic, $address, $phone, $email);
  $stmt->execute();

  // Get the last inserted customer ID
  $customer_id = $conn->insert_id;

  // Insert into customer_products table for each selected product
  foreach ($products as $product_id) {
      $sql = "INSERT INTO customer_products (customer_id, product_id) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $customer_id, $product_id);
      $stmt->execute();
  }

  $conn->commit();
  $stmt->close();
  echo "Data saved successfully";
}
catch (Exception $e) {
  $conn->rollback();
  echo "Transaction failed: " . $e->getMessage();
}
finally {
  $conn->close();
}

?>