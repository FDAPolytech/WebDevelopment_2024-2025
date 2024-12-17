<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $adress = htmlspecialchars(trim($_POST['adress']));
    $comment = htmlspecialchars(trim($_POST['comment']));
    $product = htmlspecialchars(trim($_POST['product']));

    echo "Wrong method!";

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'lab4';

    echo "Wrong method!";

    $conn = new mysqli($servername, $username, $password, $dbname);

    echo "Wrong method!";

    if($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    echo "Wrong method!";

    $sql = "INSERT INTO orders (name, lastname, email, adress, comment, product) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $lastname, $email, $adress, $comment, $product);

    echo "Wrong method!";


    if ($stmt->execute()) {
        echo "Done!";
    } else {
        echo "Error" . $stmt->error;
    }

    echo "Wrong method!";


    $stmt->close();
    $conn->close();

}else{
    echo "Wrong method!";
}

?>

