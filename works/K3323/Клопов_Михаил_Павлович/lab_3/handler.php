<?php
session_start();
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['mail'];
$desc=$_POST['desc'];
$citizen=$_POST['MyRadio'];
$check=$_POST['MyCheckBox'];
if ($last_name != '' and $first_name != '' and $email != '' )
{
	if ($citizen == "Гражданин России")
	{
		if ($check[0] == "Согласие с условиями лицензионного соглашения" and $check[1] == "Согласие на обработку персональных данных")
		{
		echo 'Успешная регистрация! <br>';
		echo $last_name;
		echo '<br>';
		echo $first_name;
		echo '<br>';
		echo $email;
		echo '<br>';
		echo $desc;
		echo '<br>';
		echo $check[2];
		}
		else {echo "Не получены обязательные согласия";}
	}
	else {echo "К сожалению, регистрация пока доступна только для граждан России";}
}
else {echo "Введены не все данные";}
?>
