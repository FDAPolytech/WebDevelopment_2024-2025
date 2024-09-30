<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Форма заказа товара</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Форма заказа товара</h1>
    <form method="post" action="">
        <label for="fullname">ФИО:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="address">Адрес доставки:</label>
        <input type="text" id="address" name="address" required>

        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="product">Выберите товар:</label>
        <select id="product" name="product">
            <option value="product1">Товар 1</option>
            <option value="product2">Товар 2</option>
            <option value="product3">Товар 3</option>
        </select>

        <label for="comments">Комментарий к заказу:</label>
        <textarea id="comments" name="comments"></textarea>

        <button type="submit">Отправить заказ</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn = new mysqli("localhost", "main_user", "1234", "lab_3_1");

            if($conn->connect_error){
                die("Ошибка: " . $conn->connect_error);
            } 
            
            $fullname = $_POST["fullname"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $product = $_POST["product"];
            $comments = $_POST["comments"];
                
            $sql = "INSERT INTO persons (fullname, address, phone, email, product, comments) VALUES ('$fullname', '$address', '$phone', '$email', '$product', '$comments')";
            
            if($conn->query($sql)){
                header("Location: success.php");
            } else{
                header("Location: error.php");
            }
            
            $conn->close(); 
        }
    ?>
</div>
</body>
</html>
