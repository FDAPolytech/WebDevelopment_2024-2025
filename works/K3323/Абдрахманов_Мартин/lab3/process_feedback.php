<?php
session_start(); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $feedback = htmlspecialchars($_POST['feedback']);
    $satisfaction = htmlspecialchars($_POST['satisfaction']);
    $updates = isset($_POST['updates']) ? $_POST['updates'] : [];


    $updatesList = implode(", ", $updates);

    $_SESSION['feedback'] = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'feedback' => $feedback,
        'satisfaction' => $satisfaction,
        'updates' => $updatesList,
    ];

    echo "<h2>Thank you for your feedback, $firstName!</h2>";
    echo "<p>Your feedback has been submitted.</p>";
    echo "<a href='process_feedback.php?action=view'>View Submitted Feedback</a>"; 
} elseif (isset($_GET['action']) && $_GET['action'] === 'view') {
    if (isset($_SESSION['feedback'])) {
        $feedback = $_SESSION['feedback'];
        echo "<h2>Your Submitted Feedback:</h2>";
        echo "<p><strong>First Name:</strong> {$feedback['firstName']}</p>";
        echo "<p><strong>Last Name:</strong> {$feedback['lastName']}</p>";
        echo "<p><strong>Email:</strong> {$feedback['email']}</p>";
        echo "<p><strong>Feedback:</strong> {$feedback['feedback']}</p>";
        echo "<p><strong>Satisfaction:</strong> " . ($feedback['satisfaction'] === 'yes' ? 'Yes' : 'No') . "</p>";
        echo "<p><strong>Updates:</strong> {$feedback['updates']}</p>";
    } else {
        echo "<p>No feedback found.</p>";
    }
} else {
    echo "<p>No data submitted.</p>";
}
?>
