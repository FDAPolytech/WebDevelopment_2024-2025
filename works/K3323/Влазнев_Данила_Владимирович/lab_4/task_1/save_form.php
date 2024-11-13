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

  $sql_customer = "INSERT INTO customers (name, lastname, patronymic, address, phone, email) 
          VALUES (?, ?, ?, ?, ?, ?)";
  $stmt_customer = $conn->prepare($sql_customer);
  $stmt_customer->bind_param("ssssss", $name, $lastname, $patronymic, $address, $phone, $email);
  $stmt_customer->execute();

  // Get the last inserted customer ID
  $customer_id = $conn->insert_id;

  $sql_product = "INSERT INTO customer_products (customer_id, product_id, comment) VALUES (?, ?, ?)";
  $stmt_product = $conn->prepare($sql_product);
  foreach ($products as $product_id) {
      $stmt_product->bind_param("iis", $customer_id, $product_id, $comment);
      $stmt_product->execute();
  }

  $conn->commit();
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