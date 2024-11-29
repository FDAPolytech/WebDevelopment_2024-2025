<?php
$name = htmlspecialchars($_POST['name']);
$surname= htmlspecialchars($_POST['surname']);
$email = htmlspecialchars($_POST['email']);
$expirience_1= htmlspecialchars($_POST['expirience_1']);
$expirience = htmlspecialchars($_POST['expirience']);
$good = isset($_POST['good']) ? $_POST['good'] : [];
$bad = isset($_POST['bad']) ? $_POST['bad'] : [];
$change = isset($_POST['change']) ? $_POST['change'] : [];

echo "<p>Ваше имя: $name</p>";
echo "<p>Ваша фамилия: $surname</p>";
echo "<p>Ваш email: $email</p>";
echo "<p>Ваша оценка обслуживания: $expirience_1</p>";
echo "<p>Ваше оценка впечатлений: $expirience</p>";
if (!empty($good)) {
    echo '<p>Вы выбрали следующие пункты:</p>';
    foreach ($good as $item) {
        echo "<li>$item</li>";
    }
} else {
    echo 'Не был выберан ни один пункт.';
}

if (!empty($bad)) {
    echo '<p>Вы выбрали следующие пункты:</p>';
    foreach ($bad as $item) {
        echo "<li>$item</li>";
    }
} else {
    echo 'Не был выберан ни один пункт.';
}

if (!empty($change)) {
    echo '<p>Вы выбрали следующие пункты:</p>';
    foreach ($change as $item) {
        echo "<li>$item</li>";
    }
} else {
    echo 'Не был выберан ни один пункт.';
}

?>