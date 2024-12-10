<?php
$file = 'feedback.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $feedback = $_POST['feedback'] ?? '';
    $typeOfParty = $_POST['typeOfParty'] ?? '';
    $services = $_POST['services'] ?? [];
    if (!is_array($services)) {
        $services = [$services];
    }
    $servicesCount = count($services);

    $data = "Имя: $firstName\n";
    $data .= "Фамилия: $lastName\n";
    $data .= "Электронная почта: $email\n";
    $data .= "Обратная связь: $feedback\n";
    $data .= "Тип праздника: $typeOfParty\n";
    $data .= "Выбранные услуги ($servicesCount): " . implode(', ', $services) . "\n";
    $data .= "--------------------------\n";

    file_put_contents($file, $data, FILE_APPEND);

    header('Location: ?thankyou=1');
    exit;
}

if (isset($_GET['thankyou'])) {
    echo "<h1>Спасибо за вашу заявку!</h1>";
    echo "<button onclick=\"window.location.href='?view=1'\">Посмотреть все заявки</button>";
    exit;
}

if (isset($_GET['view'])) {
    echo "<h1>Ваши заявки:</h1>";
    echo "<pre>";
    if (file_exists($file)) {
        echo htmlspecialchars(file_get_contents($file));
    } else {
        echo "Нет данных.";
    }
    echo "</pre>";
    exit;
}
