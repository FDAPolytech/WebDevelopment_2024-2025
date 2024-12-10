
<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <h1>Введенные данные</h1>

    <?php
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $comment = $_POST["comment"];
        $date = $_POST['date'];
        $sources = isset($_POST['sources']) ? $_POST['sources'] : [];

        echo "Имя: ". $firstname ."<br><br>";
        echo "Фамилия: ". $lastname."<br><br>";
        echo "Электронная почта: ". $email."<br><br>";
        echo "Комментарий: ".$comment."<br><br>";
        echo "Дата мероприятия: ".$date."<br><br>";
        if(!empty($sources)){
            echo "Откуда узнали:<br>";
            foreach($sources as $source){
                echo "<ul><li>".$source."</li></ul>";
            }
        }
        
    ?>
  </body>
</html>

