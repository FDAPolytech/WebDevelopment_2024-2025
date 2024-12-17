<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $feedbackType = htmlspecialchars($_POST['feedback_type']);
    $services = $_POST['services'] ?? [];

    $conn = new mysqli("mysql", "root", "password", "lab3");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (first_name, last_name, email, feedback, feedback_type, services) VALUES (?, ?, ?, ?, ?, ?)");

    $servicesString = implode(", ", $services);
    
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $feedback, $feedbackType, $servicesString);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
