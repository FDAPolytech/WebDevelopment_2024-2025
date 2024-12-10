<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));

    $skill = isset($_POST['skill']) ? htmlspecialchars($_POST['skill']) : '';
    $interests = isset($_POST['interests']) ? $_POST['interests'] : [];
    $interestsList = implode(", ", $interests);

    $refer = htmlspecialchars(trim($_POST['refer']));
    $comments = htmlspecialchars(trim($_POST['comments']));

    echo $name

    if (!empty($name) && !empty($email) && !empty($skill) && !empty($refer)) {
        $to = $email;
        $subject = "Ответы на форму от $name";
        $body = "Имя: $name\nEmail: $email\nРезультат обучения: $skill\nПонравилось: $interestsList\n
        Узнали: $refer\nКомментарий:\n$comments";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Ваше сообщение было отправлено!";
        } else {
            echo "К сожалению, произошла ошибка при отправке сообщения.";
        }
    } else {
        echo "Пожалуйста, заполните все поля.";
    }
} else {
    echo "Некорректный запрос.";
}
?>