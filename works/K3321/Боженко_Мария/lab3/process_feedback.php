<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$first_name = htmlspecialchars(trim($_POST['first_name']));
		$last_name = htmlspecialchars(trim($_POST['last_name']));
		$email = htmlspecialchars(trim($_POST['email']));
		$feedback = htmlspecialchars(trim($_POST['feedback']));
		$topic = htmlspecialchars(trim($_POST['topic']));
		
		$sources = isset($_POST['source']) ? implode(", ", $_POST['source']) : 'Нет источников';
		
		$file = 'example.txt';
		$data = "Имя: " . $first_name . "\nФамилия: " . $last_name . "\nEmail: " . $email . 
		"\nСообщение: " . $feedback . "\nТема: " . $topic . "\nИсточники: " . $sources . "\n";

		$result = file_put_contents($file, $data, FILE_APPEND);

		// Проверяем результат
		if ($result !== false) {
			echo "Данные успешно записаны в файл.";
		} else {
			echo "Произошла ошибка при записи в файл.";
		}
	}
?>

