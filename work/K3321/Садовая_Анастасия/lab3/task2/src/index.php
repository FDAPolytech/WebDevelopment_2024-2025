<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $surname = isset($_POST['surname']) ? $_POST['surname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    echo '<script type="text/javascript">alert("Получены ответы через post от: ' . $name . ' ' . $surname . ' ' . $email . '");</script>';

    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = isset($_GET['name']) ? $_GET['name'] : null;
    $surname = isset($_GET['surname']) ? $_GET['surname'] : null;
    $email = isset($_GET['email']) ? $_GET['email'] : null;
    echo '<script type="text/javascript">alert("Получены ответы через get от: ' . $name . ' ' . $surname . ' ' . $email . '");</script>';

} {
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel='stylesheet' href='/css/styles.css'>
</head>
<body>

    <div>
        <form action="/index.php" method="post">
            <div>
                <label for="name">Введите имя</label>
                <input class="input-block" type="text" id="name" name = "name" placeholder="Иван" required>
            </div>
            <div>
                <label for="surname">Введите фамилию</label>
                <input class="input-block" type="text" id="surname" name = "surname" placeholder="Иванов" required>
            </div>
            <div>
                <label for="email">Введите email</label>
                <input class="input-block" type="email" id="email" name = "email" placeholder="your@email.com" required>
            </div>
            <h2>Заполните представленную форму:<h2>

            <div>
                <legend>Вопрос 1</legend>
                <input type="checkbox" id="q1" name="q1" value="yes">
                <label for="q1"> да </label>
                
                <legend>Вопрос 2</legend>
                <input type="checkbox" id="q2" name="q2" value="yes">
                <label for="q2"> да </label>
                <legend>Вопрос 3</legend>
                <input type="checkbox" id="q3" name="q3" value="yes">
                <label for="q3"> да </label>

            </div>
            <div>
                <legend>Вопрос 4</legend>
                <input type="radio" id="v1" name="question4" value="Вариант 1">
                <label for="v4"> Вариант 1 </label>
                <input type="radio" id="v2" name="question4" value="Вариант 2">
                <label for="v5"> Вариант 2 </label>
                <input type="radio" id="v3" name="question4" value="Вариант 3">
                <label for="v6"> Вариант 3 </label>

            </div>
            <div>
                <legend>Вопрос 5</legend>
                <input type="radio" id="v1" name="question5" value="Вариант 1">
                <label for="v4"> Вариант 1 </label>
                <input type="radio" id="v2" name="question5" value="Вариант 2">
                <label for="v5"> Вариант 2 </label>

            </div>
            <div>
                <button class="btn" type="submit">Отправить форму</button>
            </div>
        </form>
    </div>
    
</body>
</html>




