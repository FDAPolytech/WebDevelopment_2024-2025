<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $comments = htmlspecialchars(trim($_POST['comments']));
    $quality = htmlspecialchars(trim($_POST['quality']));
    $refer = htmlspecialchars(trim($_POST['refer']));

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'feedback';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, lastname, email, comments, quality, refer) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $name, $lastname, $email, $comments, $quality, $refer);

    if ($stmt->execute()) {
        echo "Done!";
    } else {
        echo "Error" . $stmt->error;
    }

    $stmt->close();
    $conn->close();

}else{
    echo "Wrong method!";
}

?>

