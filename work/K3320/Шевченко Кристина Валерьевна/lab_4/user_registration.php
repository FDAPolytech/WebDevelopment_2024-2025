<?php
/*
Plugin Name: User Registration
Description: Плагин для регистрации пользователей и хранения логинов и паролей.
Version: 1.0
Author: Ваше имя
*/

function ur_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_registration';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        login VARCHAR(100) NOT NULL,
        password_original VARCHAR(255) NOT NULL,
        password_inverted VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'ur_create_table');

function ur_registration_form() {
    ob_start();
    ?>
    <h1>Регистрация пользователя</h1>
    <form action="" method="POST">
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Зарегистрироваться</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = sanitize_text_field($_POST['login']);
        $password = sanitize_text_field($_POST['password']);
        
        // Инвертируем биты пароля
        

        function invert_bits($password) {
            $inverted = '';
            for ($i = 0; $i < strlen($password); $i++) {
                // Получаем ASCII-код символа
                $ascii = ord($password[$i]);
                // Инвертируем биты с помощью побитового оператора NOT (~)
                $inverted_ascii = ~$ascii;
                // Приводим к 8-битному значению, чтобы избежать переполнения
                $inverted_ascii &= 0xFF;
                // Конвертируем обратно в символ
                $inverted .= chr($inverted_ascii);
            }
            return $inverted;
        }
        $inverted_password = invert_bits($password);
        
        
        

        global $wpdb;
        $table_name = $wpdb->prefix . 'user_registration';

        $wpdb->insert(
            $table_name,
            [
                'login' => $login,
                'password_original' => $password,
                'password_inverted' => $inverted_password
            ]
        );

        echo 'Пользователь успешно зарегистрирован!';
    }
    return ob_get_clean();
}
add_shortcode('ur_registration_form', 'ur_registration_form');
