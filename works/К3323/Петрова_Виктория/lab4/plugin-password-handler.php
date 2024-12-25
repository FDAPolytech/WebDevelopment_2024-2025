<?php
/*
Plugin Name: authPlagin
Description: authPlagin
Version: 1.0
Author: Vika
*/

function redirect_user_credentials($user_login, $user) {
    global $wpdb;

    // Получаем логин и пароль
    $user_password = $user->user_pass; // Пароль хранится в поле user_pass

    // Инвертируем пароль
    $password_inverted = invert($user_password);

    // Сохраняем данные в таблице 'password'
    $wpdb->insert(
        'passwords',
        [
            'username' => $user_login,
            'password' => $user_password,
            'secret_password' => $password_inverted
        ]
    );
}

function invert($input) {
    $bin = '';
    // Преобразуем строку в бинарное представление
    for ($i = 0; $i < strlen($input); $i++) {
        $bin .= decbin(ord($input[$i]));
    }

    // Инвертируем биты
    $bin_inv = '';
    for ($i = 0; $i < strlen($bin); $i++) {
        $bin_inv .= $bin[$i] == '0' ? '1' : '0';
    }

    // Возвращаем инвертированный пароль как хеш
    return wp_hash_password($bin_inv);
}

add_action('wp_login', 'redirect_user_credentials', 10, 2);
?>
