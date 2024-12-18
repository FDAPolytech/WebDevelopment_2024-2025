<?php

session_start();

function getDbConn() {
    $conn = new mysqli("mysql", "root", "password", "lab4");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function auth($login) {
    $_SESSION['user'] = $login;
}

function isAuth(): bool {
    return isset($_SESSION['user']);
}

function invertStringBits($string) {
    return invertBits(stringToBinary($string));
}

function invertBits($binaryString) {
    $inverted = '';
    for ($i = 0; $i < strlen($binaryString); $i++) {
        $inverted .= ($binaryString[$i] === '0') ? '1' : '0';
    }
    return $inverted;
}

function stringToBinary($string) {
    $binaryString = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $binaryChar = decbin(ord($string[$i]));
        $binaryString .= str_pad($binaryChar, 8, '0', STR_PAD_LEFT);
    }
    return trim($binaryString);
}

