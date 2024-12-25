<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $emotions = $_POST['emotions'];
    $purchased = $_POST['purchased'];
    $comments = $_POST['comments'];

    $content = "ФИО: $fullname\n";
    $content .= "Email: $email\n";
    $content .= "Впечатления: $emotions\n";
    $content .= "Купленные товары: ";
    foreach ($purchased as $product) {
        $content .= "$product, ";
    }
    $content = rtrim($content, ", ");
    $content .= "\nКомментарий:\n$comments\n\n";

    $date = date("d.m.Y H:i:s");
    $content .= "Дата отправки: $date\n";

    // Запись в файл
    $filename = "feedback_" . date("Ymd_His") . ".txt";
    $file = fopen($filename, "w");
    fwrite($file, $content);
    fclose($file);

    echo "<script>alert('Спасибо! Ваша обратная связь принята и записана в файл.'); window.location.href='feedback.html';</script>";
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") { include 'feedback.html';}
?>