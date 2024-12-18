<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = htmlspecialchars($_GET['name']);
    $email = htmlspecialchars($_GET['email']);

    echo "<h1>Полученные данные</h1>";
    echo "<p><strong>Имя:</strong> " . $name . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
} else {
    echo "Данные не были отправлены.";
}
?>
