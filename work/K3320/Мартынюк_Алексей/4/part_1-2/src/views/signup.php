<?php 

require __DIR__ . '/../config.php';
require __DIR__ . '/../password-utils.php';
require __DIR__ .'/../data/user.php';

if (is_auth()) {
    header('Location: /search.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name =       $_POST['first_name'];
    $last_name =        $_POST['last_name'];
    $email =            $_POST['email'];
    $password =         $_POST['password'];
    $password_repeat =  $_POST['password_repeat'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        header('Location: /signup.php?error=empty');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /signup.php?error=invalid_email');
        exit;
    }

    if ($password !== $password_repeat) {
        header('Location: /signup.php?error=password_mismatch');
        exit;
    }

    $user = new User();

    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $user->email = $email;

    $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
    // $user->password_hash = stringToBinary($password);
    // $user->password_hash = invertStringBits(stringToBinary($password));

    $userRepository = new UserRepository($pdo);
    if ($userRepository->insert($user)) {
        header('Location: /profile.php?hash=' . $user->password_hash);
        exit;
    } else {
        header('Location: /errors/500.html', true, 500);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title> 
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php require __DIR__ . '/partials/navigation.php'; ?>

    <div class="login-container">
        <h2>Sign Up</h2>

        <!-- TODO: add error messages handling -->
        <form action="/signup.php" method="post">
            <div class="input-box">
                <input type="text" name="first_name" placeholder="Name" required>
                <input type="text" name="last_name" placeholder="Surname" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="password_repeat" placeholder="Password confirmation" required>
            </div>
            <div class="input-box button">
                <input type="submit" value="Register Now">
            </div>
        </form>

        <h3>Already have an account? <a href="signin.php">Sign In</a></h3>
    </div>
</body>
</html>
