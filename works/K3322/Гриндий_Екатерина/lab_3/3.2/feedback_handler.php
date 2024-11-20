<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $source = htmlspecialchars($_POST['source']);
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    echo "<h2>Полученные данные:</h2>";
    echo "Имя: $first_name<br>";
    echo "Фамилия: $last_name<br>";
    echo "Электронная почта: $email<br>";
    echo "Опыт: $feedback<br>";
    echo "Из какого вуза: $source<br>";

    if (!empty($services)) {
        echo "Выбранные направления :<br>";
        foreach ($services as $service) {
            echo "- " . htmlspecialchars($service) . "<br>";
        }
    } else {
        echo "Направления не выбраны.";
    }
} else {
    echo "Метод запроса не POST.";
}
