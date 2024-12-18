<?php

require __DIR__ . '/config.php';

$conn = getDbConn();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE login='$login'";
    $res = $conn->query($sql);

    $row = $res->fetch_assoc();

    $errMessage = null;

    if ($row) {
        switch ($row['password_method']) {
        case 'plain':
            if ($row['password'] === stringToBinary('password')) {
                auth($login);
                header('Location: /order.php');
                exit;
            }
            break;
        case 'inverted':
            if ($row['password'] == invertStringBits('password')) {
                auth($login);
                header('Location: /order.php');
                exit;
            }
            break;           
        }

        $errMessage = "bad login or password";
    } else {
        $errMessage = "bad login";
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма авторизации</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    

    <form action="signin.php" method="POST">
        <h2>Авторизация пользователя</h2>

        <div>
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
        </div>

        <input type="submit" value="Войти">

        <a href="./signup.php">Зарегистрироваться</a>

        <?php if (isset($errMessage)): ?>
            <?= $errMessage ?>
        <?php endif; ?>
    </form>
</body>
</html>
