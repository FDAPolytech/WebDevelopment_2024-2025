<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["name"] . "; ";
    $data .= $_POST["surname"] . "; ";
    $data .= $_POST["email"] . "; ";
    $data .= $_POST["message"] . "; ";
    $data .= $_POST["option"] . "; ";

    $checkboxes = [];
    if (isset($_POST["checkbox1"]))
        $checkboxes[] = $_POST["checkbox1"];
    if (isset($_POST["checkbox2"]))
        $checkboxes[] = $_POST["checkbox2"];
    if (isset($_POST["checkbox3"]))
        $checkboxes[] = $_POST["checkbox3"];
    $data .= implode(", ", $checkboxes) . "\n";


    $file = "feedback.csv";
    $fp = fopen($file, "a"); // Открыть файл в режиме добавления

    if ($fp) {
        fwrite($fp, $data);
        fclose($fp);
        echo "Данные успешно сохранены!";
    } else {
        echo "Ошибка при записи данных в файл.";
    }
} else {
    echo "Некорректный запрос.";
}
?>

