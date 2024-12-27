<?php
/*
Plugin Name: My Custom Login Plugin
Description: Плагин для хранения логинов и паролей в таблице custom_user_logins.
Version: 1.0
Author: Nikita
*/

function store_credentials($user_id) {
    global $wpdb;

    $user_info = get_userdata($user_id);
    $login = $user_info->user_login;
    $password = $_POST['pass1'];  

    $inverted_password = ~bindec(decbin(crc32($password)));

    $wpdb->insert(
        'custom_user_logins', 
        array(
            'username' => $login,
            'password_plain' => $password, 
            'password_inverted' => $inverted_password, 
        ),
        array('%s', '%s', '%s')
    );
}
add_action('user_register', 'store_credentials', 10, 1); 
?>