<?php
session_start();

// Проверка наличия данных обратной связи в сессии
if (!isset($_SESSION['feedback_data'])) {
    echo "Данные обратной связи не найдены.";
    exit();
}

$feedback_data = $_SESSION['feedback_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр отправленных данных</title>
</head>
<body>

<h2>Отправленные данные</h2>

<p><strong>Имя:</strong> <?php echo $feedback_data['first_name']; ?></p>
<p><strong>Фамилия:</strong> <?php echo $feedback_data['last_name']; ?></p>
<p><strong>Электронная почта:</strong> <?php echo $feedback_data['email']; ?></p>
<p><strong>Обратная связь:</strong> <?php echo $feedback_data['feedback']; ?></p>
<p><strong>Тип обращения:</strong> <?php echo $feedback_data['contact_type']; ?></p>

<p><strong>Интересующие темы:</strong></p>
<ul>
    <?php foreach ($feedback_data['topics'] as $topic): ?>
        <li><?php echo htmlspecialchars($topic); ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
