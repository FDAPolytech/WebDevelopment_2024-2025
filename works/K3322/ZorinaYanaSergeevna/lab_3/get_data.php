<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {

    $id = htmlspecialchars($_GET['id']);

    $filePath = __DIR__ . "/data/{$id}.json";

    if (file_exists($filePath)) {

        $data = json_decode(file_get_contents($filePath), true);
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Retrieved Data</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Data for ID: {$id}</h1>";
        echo "<p><strong>First Name:</strong> " . htmlspecialchars($data['first_name']) . "</p>";
        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($data['last_name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($data['email']) . "</p>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($data['feedback']) . "</p>";
        echo "<p><strong>Selected Option:</strong> " . htmlspecialchars($data['option']) . "</p>";

        if (!empty($data['checkboxes'])) {

            echo "<p><strong>Selected Checkboxes:</strong></p><ul>";

            foreach ($data['checkboxes'] as $checkbox) {

                echo "<li>" . htmlspecialchars($checkbox) . "</li>";
            }

            echo "</ul>";

        } else {

            echo "<p><strong>Selected Checkboxes:</strong> None</p>";
        }

        echo "<p><strong>Submission Time:</strong> " . htmlspecialchars($data['timestamp']) . "</p>";
        echo "</body>";
        echo "</html>";

    } else {

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>Error</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Error: Data with ID {$id} not found</h1>";
        echo "</body>";
        echo "</html>";
    }

} else {

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Error</title>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Error: The request must include the ID parameter</h1>";
    echo "</body>";
    echo "</html>";
}
?>
