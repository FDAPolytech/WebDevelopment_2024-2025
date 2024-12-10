<?php
// Функция для обработки входных данных
function processData($data) {
    return htmlspecialchars(trim($data));
}

// Проверка метода запроса
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h1>Feedback Received (POST)</h1>";
    $name = processData($_POST["name"] ?? "");
    $surname = processData($_POST["surname"] ?? "");
    $email = processData($_POST["email"] ?? "");
    $feedback = processData($_POST["feedback"] ?? "");
    $source = processData($_POST["source"] ?? "");
    $services = $_POST["services"] ?? [];
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo "<h1>Feedback Received (GET)</h1>";
    $name = processData($_GET["name"] ?? "");
    $surname = processData($_GET["surname"] ?? "");
    $email = processData($_GET["email"] ?? "");
    $feedback = processData($_GET["feedback"] ?? "");
    $source = processData($_GET["source"] ?? "");
    $services = $_GET["services"] ?? [];
} else {
    echo "<h1>Error</h1>";
    echo "<p>Unsupported request method.</p>";
    exit;
}

// Вывод данных
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Surname:</strong> $surname</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Feedback:</strong> $feedback</p>";
echo "<p><strong>Found us via:</strong> $source</p>";
if (!empty($services)) {
    echo "<p><strong>Interested in:</strong> " . implode(", ", $services) . "</p>";
} else {
    echo "<p><strong>Interested in:</strong> None selected</p>";
}
?>
