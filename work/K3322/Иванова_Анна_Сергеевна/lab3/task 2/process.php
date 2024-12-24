<?php
function processData($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h1>Спасибо за сообщение! (Использован метод POST)</h1>";
    $name = processData($_POST["name"] ?? "");
    $surname = processData($_POST["surname"] ?? "");
    $email = processData($_POST["email"] ?? "");
    $feedback = processData($_POST["feedback"] ?? "");
    $source = processData($_POST["source"] ?? "");
    $services = $_POST["services"] ?? [];
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo "<h1>Спасибо за сообщение! (Использован метод GET)</h1>";
    $name = processData($_GET["name"] ?? "");
    $surname = processData($_GET["surname"] ?? "");
    $email = processData($_GET["email"] ?? "");
    $feedback = processData($_GET["feedback"] ?? "");
    $source = processData($_GET["source"] ?? "");
    $services = $_GET["services"] ?? [];

} else {
    echo "<h1>Ошибка</h1>";
    echo "<p>Метод запроса не поддерживается.</p>";
    exit;
}

echo "<p><strong>Ваше имя:</strong> $name</p>";
echo "<p><strong>Ваша фамилия</strong> $surname</p>";
echo "<p><strong>Ваш email</strong> $email</p>";

?>