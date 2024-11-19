<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <title>Task2</title>

    <style>
        html {
            background-color: #9BC1BC;
            box-sizing: border-box;

            > * {
                margin: 0;
                padding: 0;
            }
        }

        body {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Roboto", sans-serif;
        }

        .form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: row nowrap;
            gap: 50px;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 50px 50px;
        }

        .label {
            font-weight: 400;
            font-size: 20px;
        }

        .input {
            font-weight: 400;
            font-size: 20px;
        }

        .column {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        .button {
            font-family: "Roboto", sans-serif;
            font-size: 20px;
            background: #fff;
            border: 1px solid black;
            border-radius: 10px;
            padding: 5px 10px;
            cursor: pointer;
            transition: transform .3s ease-in-out;
        }

        .button:hover {
            transform: scale(1.1);
        }

        .message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #2E282A;
            color: #B098A4;
            padding: 20px 20px;
            border-radius: 15px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <form class="form" method="post">
        <div class="column">
            <label class="label" for="lastname">Фамилия:</label>
            <input class="input" name="lastname" id="lastname" type="text" placeholder="Фамилия" required/>
            
            <label class="label" for="name">Имя:</label>
            <input class="input" name="name" id="name" type="text" placeholder="Имя" required/>

            <label class="label" for="patronymic">Отчество:</label>
            <input class="input" name="patronymic" id="patronymic" type="text" placeholder="Отчество" required/>
    
            <label class="label" for="address">Адрес:</label>
            <input class="input" name="address" id="address" type="text" placeholder="Адрес" required/>

            <label class="label" for="phone">Телефон:</label>
            <input class="input" name="phone" id="phone" type="tel" placeholder="Телефон" required/>
    
            <label class="label" for="email">Электронная почта:</label>
            <input class="input" name="email" id="email" type="email" placeholder="Электронная почта" required/>
    
           
        </div>
        <div class="column">
            <label class="label" for="comment">Комментарий к заказу:</label>
            <textarea name="comment"id="comment"></textarea> 

            <label class="label" for="product">Выберите кофе:</label>
            <select id="product" name="product">
                <option value="ethopia">Кофе из Эфиопии</option>
                <option value="brazil">Кофе из Бразилии</option>
            </select>
           
            <button class="button" type="submit">Купить</button>
        </div>
    </form>
    
    <?php
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $host = '127.0.0.1';     
            $username = 'lab4'; 
            $password = '123456'; 
            $dbname = 'lab4'; 

            try {
                $conn = new mysqli($host, $username, $password, $dbname);
            } catch (Exception $e) {
                echo "Error opening database: " . $e->getMessage();
                exit();
            }

            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $comment = isset($_POST['comment']) ? $_POST['comment'] : null;
            $product = isset($_POST['product']) ? $_POST['product'] : null;

            if ($lastname && $name && $patronymic && $address && $phone && $email && $comment && $product) {
                $sql = "INSERT INTO orders (lastname, name, patronymic, address, phone, email, product, comment) VALUES ('$lastname', '$name', '$patronymic', '$address', '$phone', '$email', '$product', '$comment')";

                if($conn->query($sql)) {
                    $message = "Данные сохранены успешно";
                } else {
                    $message = "Произошла ошибка";
                }
                $conn->close(); 
                
            }
        }
    ?>
     <?php if ($message): ?>
        <div class="message">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
</body>
</html>