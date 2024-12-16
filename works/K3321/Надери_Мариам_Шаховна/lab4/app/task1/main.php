<?php
$pdo = new PDO('mysql:host=localhost;dbname=lab4_task1_shop;charset=utf8', 'root', '');

$last_name = htmlspecialchars($_POST['last_name']);
$first_name = htmlspecialchars($_POST['first_name']);
$dad_name = htmlspecialchars($_POST['dad_name']);
$addr = htmlspecialchars($_POST['addr']);
$phone = htmlspecialchars($_POST['phone']);
$mail = htmlspecialchars($_POST['mail']);
$product = htmlspecialchars($_POST['product']);
$comm = htmlspecialchars($_POST['comm']);

$sql = "INSERT INTO orders (last_name, first_name, dad_name, addr, phone, mail, product, comm)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$stmt->execute([$last_name, $first_name, $dad_name, $addr, $phone, $mail, $product, $comm]);

echo "<h1>Ваш заказ принят! Благодарим за покупку!</h1>";
?>