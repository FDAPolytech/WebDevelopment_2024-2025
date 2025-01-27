<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstName = htmlspecialchars($_POST['first_name'] ?? '');
    $lastName = htmlspecialchars($_POST['last_name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $feedback = htmlspecialchars($_POST['feedback'] ?? '');
    $option = htmlspecialchars($_POST['option'] ?? '');
    $checkboxes = $_POST['checkbox'] ?? [];

    $id = uniqid();

    $data = [
        "id" => $id,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "feedback" => $feedback,
        "option" => $option,
        "checkboxes" => $checkboxes,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    $directory = __DIR__ . "/data";

    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $filePath = $directory . "/{$id}.json";

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Result</title>";
    echo "</head>";

    echo "<body>";
    echo "<h1>Data saved successfully!</h1>";
    echo "<p>Record ID: <strong>{$id}</strong></p>";
    echo "<form action='get_data.php' method='get' target='_self'>";
    echo "    <input type='hidden' name='id' value='{$id}'>";
    echo "    <button type='submit'>Retrieve Data</button>";
    echo "</form>";
    echo "</body>";
    echo "</html>";

} else {

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Error</title>";
    echo "</head>";

    echo "<body>";
    echo "<h1>Error: The request must be a POST method</h1>";
    echo "</body>";
    echo "</html>";
}
?>