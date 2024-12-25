
<?php
// Подключение к базе данных
$host = 'localhost';
$db = 'orders_db';
$user = 'root'; // по умолчанию
$pass = 'root'; // по умолчанию для MAMP
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение данных из формы
$last_name = htmlspecialchars($_POST['last_name']);
$first_name = htmlspecialchars($_POST['first_name']);
$middle_name = htmlspecialchars($_POST['middle_name']);
$address = htmlspecialchars($_POST['address']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$items = implode(', ', $_POST['items']);
$comments = htmlspecialchars($_POST['comments']);

// Вставка данных в таблицу
$sql = "INSERT INTO orders (last_name, first_name, middle_name, address, phone, email, items, comments)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$last_name, $first_name, $middle_name, $address, $phone, $email, $items, $comments]);
    echo "<h1>Ваш заказ успешно принят!</h1>";
} catch (\PDOException $e) {
    die("Ошибка записи данных: " . $e->getMessage());
}
?>
