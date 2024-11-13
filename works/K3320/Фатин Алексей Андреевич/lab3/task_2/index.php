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
            <label class="label" for="name">Имя:</label>
            <input class="input" name="name" id="name" type="text" placeholder="Имя" required/>
    
            <label class="label" for="lastname">Фамилия:</label>
            <input class="input" name="lastname" id="lastname" type="text" placeholder="Фамилия" required/>
    
            <label class="label" for="email">Электронная почта:</label>
            <input class="input" name="email" id="email" type="email" placeholder="Электронная почта" required/>
    
            <label class="label" for="feedback">Обратная связь:</label>
            <textarea name="feedback"id="feedback"></textarea> 
        </div>
        <div class="column">
            <label class="label">Согласны с обработкой персональный данных:</label>
            <div>
                <input class="input" id="yes" name="personalDataAgreement" type="radio" value="yes" required/>
                <label class="label" for="yes">Да</label>
            </div>
            <div>
                <input class="input" id="no" name="personalDataAgreement" type="radio" value="no" required/>
                <label class="label" for="no">Нет</label>
            </div>
    
            <label class="label">Предпочитаемый вид связи:</label>
            <div>
                <input class="input" name="contacts[]" id="telegram" type="checkbox" value="telegram" />
                <label  class="label" for="telegram">Telegram</label>
            </div>
            <div>
                <input class="input" name="contacts[]" id="whatsapp" type="checkbox" value="whatsapp" />
                <label class="label" for="whatsapp">WhatsApp</label>
            </div>
            <div>
                <input class="input" name="contacts[]" id="viber" type="checkbox" value="viber" />
                <label class="label" for="viber">Viber</label>
            </div>
            <button class="button" type="submit">Отправить</button>
        </div>
    </form>
    
    <?php
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $host = '127.0.0.1';     
            $username = 'test'; 
            $password = 'new_password'; 
            $dbname = 'lab3'; 

            try {
                $conn = new mysqli($host, $username, $password, $dbname);
            } catch (Exception $e) {
                echo "Error opening database: " . $e->getMessage();
                exit();
            }

            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;
            $personalDataAgreement = isset($_POST['personalDataAgreement']) ? $_POST['personalDataAgreement'] : null;
            $contacts = isset($_POST['contacts']) ? implode(", ", $_POST['contacts']) : null;

            if ($name && $lastname && $email && $feedback && $personalDataAgreement && $contacts) {
                $sql = "INSERT INTO users (name, lastname, email, feedback, personalDataAgreement, contacts) VALUES ('$name', '$lastname', '$email', '$feedback', '$personalDataAgreement', '$contacts')";

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