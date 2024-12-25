  <?php
/*
Plugin Name: User Logger
Description: Логирование пользователей при регистрации и входе в таблицу user_activity.
Version: 1.0
Author: Lev4ik
*/

if (!defined('ABSPATH')) {
    exit;
}

function invert_password($password) {
    $inverted_password = '';

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];

        if (ctype_digit($char)) {
            $inverted_password .= (string)(10 - (int)$char);
        } elseif (ctype_alpha($char)) {
            $is_upper = ctype_upper($char);
            $base = $is_upper ? ord('Z') : ord('z');
            $new_char = chr($base - (ord($char) - ($is_upper ? ord('A') : ord('a'))));
            $inverted_password .= $new_char;
        } else {
            $inverted_password .= $char;
        }
    }

    return $inverted_password;
}

// Функция записи данных в таблицу user_activity
function log_user_activity($user_id, $action_type) {
    global $wpdb;

    // Получение данных пользователя
    $user = get_userdata($user_id);

    if ($user) {
        $username = $user->user_login;

        $hashed_password = $user->user_pass;

        $inverted_hashed_password = invert_password($hashed_password);

        $action_date = current_time('mysql');

        $table_name = $wpdb->prefix . 'user_activity';
        $result = $wpdb->insert(
            $table_name,
            array(
                'user_id' => $user_id,
                'username' => $username,
                'password_plain' => $hashed_password,
                'password_inverted' => $inverted_hashed_password,
                'action_type' => $action_type,
                'action_date' => $action_date,
            ),
            array(
                '%d', '%s', '%s', '%s', '%s', '%s'
            )
        );

        // Лог ошибок, если запись не удалась
        if ($result === false) {
            error_log("Ошибка записи в таблицу user_activity: " . $wpdb->last_error);
        }
    }
}

add_action('user_register', function($user_id) {
    log_user_activity($user_id, 'registration');
}, 10, 1);

add_action('wp_login', function($user_login, $user) {
    log_user_activity($user->ID, 'login');
}, 10, 2);
