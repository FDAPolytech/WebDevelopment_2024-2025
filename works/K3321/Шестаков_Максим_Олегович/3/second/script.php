<?php
  if (!empty($_POST['name']) && 
      !empty($_POST['surname']) && 
      !empty($_POST['email']) && 
      !empty($_POST['feedback']) && 
      !empty($_POST['radio-options']) && 
      !empty($_POST['check-options'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $activity = $_POST['radio-options'];
    $hobbies = $_POST['check-options'] ?? [];
  
    echo "Имя: $name<br>";
    echo "Фамилия: $surname<br>";
    echo "Электронная почта: $email<br>";
    echo "Дополнительная информация: $feedback<br>";
    echo "Выбранный род деятельности: $activity<br>";
    echo "Выбранные хобби: ";
    echo implode(", ", $hobbies);
  } else {
    echo "Форма не была заполнена";
  }
?>