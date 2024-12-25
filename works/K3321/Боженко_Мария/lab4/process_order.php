<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "task4_1_db";
	
	// создание соединения
	$connection = new mysqli($servername, $username, $password, $dbname, 3307);
	
	// проверка соединения
	if ($connection->connect_error) {
		die("Ошибка подключения: " . $connection->connect_error);
	}
	
	// получение данных из формы
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$surname = $_POST['surname'];
		$name = $_POST['name'];
		$patronymic = $_POST['patronymic'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$product = $_POST['product'];
		$comment = $_POST['comment'];
	
		// подготовка и выполнение sql запроса
		$stmt = $connection->prepare("INSERT INTO orders (surname, name, patronymic, address, phone, email, product, comment) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssss", $surname, $name, $patronymic, $address, $phone, $email, $product, $comment);
	
		if ($stmt->execute()) {
			echo "Заказ успешно оформлен!";
		} else {
			echo "Ошибка: " . $stmt->error;
		}

		// Закрываем соединение
		$stmt->close();
	}
	$connection->close();

?>