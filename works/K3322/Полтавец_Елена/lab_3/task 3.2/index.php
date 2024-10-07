<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Форма заказа товара</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Форма обратной связи</h1>
    <form method="post" action="">
        <label for="fullname">ФИО:</label><br>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="phone">Телефон:</label><br>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label>Выберите оказанную услугу:</label><br>
        <input type="radio" id="category1" name="category" value="category1">
        <label for="category1">Услуга 1</label><br>
        <input type="radio" id="category2" name="category" value="category2">
        <label for="category2">Услуга 2</label><br>

        <label>Отметьте, если описание соответствует оказанной услуге:</label><br>
        <input type="checkbox" id="descr1" name="descr[]" value="descr1">
        <label for="descr1">Описание 1</label><br>
        <input type="checkbox" id="descr2" name="descr[]" value="descr2">
        <label for="descr2">Описание 2</label><br>
        <input type="checkbox" id="descr3" name="descr[]" value="descr3">
        <label for="descr3">Описание 3</label><br>

        <label for="comments">Комментарий:</label><br>
        <textarea id="comments" name="comments"></textarea><br>

        <button type="submit">Отправить форму</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $conn = new mysqli("localhost", "root", "root", "lab_web");

            if($conn->connect_error){
                die("Ошибка: " . $conn->connect_error);
            } 
            
            $fullname = $_POST["fullname"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $category = $_POST["category"];
            $descr = implode(', ', $_POST['descr']);
            $comments = $_POST["comments"];
                
            $sql = "INSERT INTO persons (fullname, phone, email, category, description, comments) VALUES ('$fullname', '$phone', '$email', '$category', '$descr', '$comments')";
            
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

