
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $age = htmlspecialchars($_POST['age']);
    $fav_choc = htmlspecialchars($_POST['fav_choc']);
    $radio = htmlspecialchars($_POST['radio']);
    $type_choc = isset($_POST['type_choc']) ? $_POST['type_choc'] : [];

    echo "<h1>Thanks for your feedback!</h1>";
    echo "<p>First name: $first_name</p>";
    echo "<p>Last name: $last_name</p>";
    echo "<p>Age: $age</p>";
    echo "<p>Favorite chocolate: $fav_choc</p>";
    echo "<p>Like or not chocolate: $radio</p>";

    if (!empty($type_choc)) {
      echo "<p> You prefer: " .implode(", ", $type_choc) . "</p>";} else {
      echo "<p> You didn't choose chocolate which you prefer";}
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$first_name = htmlspecialchars($_GET['first_name']);
    $last_name = htmlspecialchars($_GET['last_name']);
    $age = htmlspecialchars($_GET['age']);
    $fav_choc = htmlspecialchars($_GET['fav_choc']);
    $radio = htmlspecialchars($_GET['radio']);
    $type_choc = isset($_GET['type_choc']) ? $_GET['type_choc'] : [];

    echo "<h1>Thanks for your feedback!</h1>";
    echo "<p>First name: $first_name</p>";
    echo "<p>Last name: $last_name</p>";
    echo "<p>Age: $age</p>";
    echo "<p>Favorite chocolate: $fav_choc</p>";
    echo "<p>Like or not chocolate: $radio</p>";

    if (!empty($type_choc)) {
      echo "<p> You prefer: " .implode(", ", $type_choc) . "</p>";} else {
      echo "<p> You didn't choose chocolate which you prefer";}
} else {
    echo "<p>Error</p>";
}
?>
