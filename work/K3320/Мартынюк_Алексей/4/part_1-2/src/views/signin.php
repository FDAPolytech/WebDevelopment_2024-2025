<?php 

require __DIR__ . '/../config.php';
require __DIR__ .'/../data/user.php';

if (is_auth()) {
    header('Location: /search.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header('Location: /signin.php?error=empty_credentials');
        exit;
    }
        
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /signin.php?error=bad_email');
        exit;
    }

    $userRepository = new UserRepository($pdo);

    $user = $userRepository->getByEmail($email);
    if ($user) {
        if (password_verify($password, $user->password_hash)) {
            // persists across different requests from the same user
            $_SESSION['user_id'] = $user->id;
            header('Location: /profile.php');
            exit;
        } else {
            header('Location: /signin.php?error=wrong_password');
            exit;
        }
    }

    // unsuccessful login attempt
    header('Location: /signin.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <?php require __DIR__ . '/partials/navigation.php'; ?>

    <div class="login-container">
    
        <h2>Sign In</h2>

        <!-- TODO: add error messages handling -->
        <form action="/signin.php" method="post">
            <div class="input-box">
                <input type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter your password" name="password" required>
            </div>
            <div class="input-box button">
                <input type="submit" value="Sign In">
            </div>
        </form>

        <h3>Don't have an account? <a href="signup.php">Sign Up</a></h3>
    </div>
</body>
</html>
