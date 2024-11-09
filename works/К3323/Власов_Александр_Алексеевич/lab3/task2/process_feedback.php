<?php
session_start();

$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$email = htmlspecialchars($_POST['email']);
$feedback = htmlspecialchars($_POST['feedback']);
$contact_type = htmlspecialchars($_POST['contact_type']);
$topics = isset($_POST['topics']) ? $_POST['topics'] : [];

$_SESSION['feedback_data'] = [
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'feedback' => $feedback,
    'contact_type' => $contact_type,
    'topics' => $topics
];

header("Location: thank_you.php");
exit();
?>
