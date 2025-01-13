<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h1>Данные, полученные через POST:</h1>";

    echo "Имя: " . htmlspecialchars($_POST['firstName']) . "<br>";
    echo "Фамилия: " . htmlspecialchars($_POST['lastName']) . "<br>";
    echo "Электронная почта: " . htmlspecialchars($_POST['email']) . "<br>";
    echo "Ваш отзыв: " . htmlspecialchars($_POST['feedback']) . "<br>";

    echo "Выбранная опция: " . htmlspecialchars($_POST['option']) . "<br>";

    echo "Выбранные чекбоксы:<br>";
    if (isset($_POST['checkbox1'])) echo "- " . htmlspecialchars($_POST['checkbox1']) . "<br>";
    if (isset($_POST['checkbox2'])) echo "- " . htmlspecialchars($_POST['checkbox2']) . "<br>";
    if (isset($_POST['checkbox3'])) echo "- " . htmlspecialchars($_POST['checkbox3']) . "<br>";
} else {
    echo "Метод GET не поддерживается для этой формы.";
}
?>
