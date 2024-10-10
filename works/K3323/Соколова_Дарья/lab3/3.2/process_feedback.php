<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "feedback_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$gender = $_POST['gender'];
$options = implode(", ", $_POST['options']);

$sql = "INSERT INTO feedback (first_name, last_name, email, feedback, gender, options) VALUES ('$firstName', '$lastName', '$email', '$feedback', '$gender', '$options')";

if ($conn->query($sql) === TRUE) {
    echo "Обратная связь принята!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

