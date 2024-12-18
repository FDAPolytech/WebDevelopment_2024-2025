<?php

require __DIR__ . '/config.php';

$conn = getDbConn();

$errMessage = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $method = $_POST['method'] ?? '';

    switch ($method) {
        case 'plain':
            $password = stringToBinary($password);
            $sql = "INSERT INTO users (login, password, password_method) VALUES ('$login', '$password', 'plain')";
            break;

        case 'inverted':
            $inverted_password = invertStringBits($password);
            $sql = "INSERT INTO users (login, password, password_method) VALUES ('$login', '$inverted_password', 'inverted')";
            break;

        default:
            $errMessage = "bad method";
            break;
    }

    if ($conn->query($sql) !== true) {
        $errMessage = $conn->error;
    } else {
        auth($login);
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <form action="signup.php" method="POST">
        
        <h2>Регистрация нового пользователя</h2>

        <div>
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
        </div>

        <select name="method" required>
            <option value="">Выберите метод сохранения пароля</option>
            <option value="plain">Сохранить в исходном виде</option>
            <option value="inverted">Инвертировать биты пароля</option>
        </select>

        <input type="submit" value="Создать учетную запись">
        
        <a href="./signin.php" id>Вернуться к авторизации</a>

        <?php if (isset($errMessage)): ?>
            <?= $errMessage ?>
        <?php endif; ?>
    </form>
</body>
</html>
