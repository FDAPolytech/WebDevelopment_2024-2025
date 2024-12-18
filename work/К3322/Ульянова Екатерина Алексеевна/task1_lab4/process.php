<?php
$host = 'localhost';
$dbname = 'orders_db';
$username = 'root';
$password = 'root';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronimic = $_POST['patronimic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comments = $_POST['comments'];

$sql = "INSERT INTO orders (surname, name, patronimic, address, phone, email, product, comments) 
        VALUES (:surname, :name, :patronimic, :address, :phone, :email, :product, :comments)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ':surname' => $surname,
        ':name' => $name,
        ':patronimic' => $patronimic,
        ':address' => $address,
        ':phone' => $phone,
        ':email' => $email,
        ':product' => $product,
        ':comments' => $comments,
    ]);
    echo "Заказ успешно сохранен!";
} catch (PDOException $e) {
    die("Ошибка выполнения запроса: " . $e->getMessage());
}
?>
