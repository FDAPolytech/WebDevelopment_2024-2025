<?php

session_start();

$dsn = 'mysql:host=mysql;dbname=lab4';
$username = 'root';
$password = 'password';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

function is_auth(): bool {
    return isset($_SESSION['user_id']);
}