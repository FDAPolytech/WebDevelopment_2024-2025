<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = htmlspecialchars($_POST['name']);
		$last_name = htmlspecialchars($_POST['lastname']);
		$email = htmlspecialchars($_POST['email']);
		$msg = htmlspecialchars($_POST['txtarea']);
		$radiobtn = htmlspecialchars($_POST['radiobtn']);
		$checkbtn = isset($_POST['checkbtn']) ? $_POST['checkbtn'] : [];
		echo "<h1>Спасибо! Форма отправлена</h1>";
		echo "<p>Имя:  $name </p>";
		echo "<p>Фамилия:  $last_name </p>";
		echo "<p>Электронная почта:  $email </p>";
		echo "<p>Отзыв:  $msg </p>";
		echo "<p>Размер покупки:  $radiobtn </p>";
		if (!empty($checkbtn)) {
			echo "<p> Купленный товар: " .implode(", ", $checkbtn) . "</p>";} else {
			echo "<p> Купленный товар: не указано";}
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
	$name = htmlspecialchars($_GET['name']);
		$last_name = htmlspecialchars($_GET['lastname']);
		$email = htmlspecialchars($_GET['email']);
		$msg = htmlspecialchars($_GET['txtarea']);
		$radiobtn = htmlspecialchars($_GET['radiobtn']);
		$checkbtn = isset($_GET['checkbtn']) ? $_GET['checkbtn'] : [];
		echo "<h1>Спасибо! Форма отправлена</h1>";
		echo "<p>Имя:  $name </p>";
		echo "<p>Фамилия:  $last_name </p>";
		echo "<p>Электронная почта:  $email </p>";
		echo "<p>Отзыв:  $msg </p>";
		echo "<p>Размер покупки:  $radiobtn </p>";
		if (!empty($checkbtn)) {
			echo "<p> Купленный товар: " .implode(", ", $checkbtn) . "</p>";} else {
			echo "<p> Купленный товар: не указано";}
} else {
	echo "<h1> Ошибка </h1>";
}
?>