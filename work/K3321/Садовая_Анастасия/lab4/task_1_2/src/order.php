<?php

require __DIR__ . '/config.php';

$conn = getDbConn();

if (!isAuth()) {
    header('Location: /signin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $products = implode(", ", $_POST['products']);
    $comment = $_POST['comment'];

    $sql = "INSERT INTO orders (surname, name, patronymic, address, phone, email, products, comment) VALUES ('$surname', '$name', '$patronymic', '$address', '$phone', '$email', '$products', '$comment')";

    $message = null;
    if ($conn->query($sql) === TRUE) {
        $message = "Заказ успешно оформлен";
    } else {
        $message = "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма заказа</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <form action="order.php" method="POST">
        <h2>Создание заказа</h2>

        <div>
            <input type="text" name="surname" placeholder="Фамилия" required>
            <input type="text" name="name" placeholder="Имя" required>
        </div>

        <input type="text" name="patronymic" placeholder="Отчество">

        <input type="text" name="address" placeholder="Адрес доставки" required>

        <input type="tel" name="phone" placeholder="Телефон" required>

        <input type="email" name="email" placeholder="Email" required>

        <select name="products[]" multiple required>
            <option value="" disabled selected>Выберите товар</option>
            <option value="product1">Товар 1</option>
            <option value="product2">Товар 2</option>
            <option value="product3">Товар 3</option>
        </select>

        <textarea name="comment" placeholder="Комментарий по заказу"></textarea>

        <input type="submit" value="Отправить заказ">

        <?php if (isset($message)): ?>
            <?= $message ?>
        <?php endif; ?>
    </form>
</body>
</html>
