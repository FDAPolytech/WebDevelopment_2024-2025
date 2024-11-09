<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);

    echo "<h2>Thank you for your feedback, $first_name $last_name!</h2>";
    echo "<p>For users from $location a gift is sent to your email: $email.</p>";
} else {
    echo "Invalid request method.";
}
?>