<?php
/**
 * Plugin Name: plagin_for_saving_login_and_password
 * Description: В таблице будут сохранены две версии пароля: в исходном и инвертированном виде
 * Version: 1.0
 * Author: Екатерина
 */

function create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'auth_logs';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        username varchar(60) NOT NULL,
        hashed_password varchar(255) NOT NULL,
        inverted_hash varchar(255) NOT NULL,
        time_of_auth TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_table');

function log_auth($user_login, $user) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'auth_logs';
    $hashed_password = $user->user_pass;
    $binary_hash = unpack('H*', $hashed_password)[1];
    $inverted_binary = strrev($binary_hash);
    $wpdb->insert(
        $table_name,
        [
            'username' => $user_login,
            'hashed_password' => $hashed_password,
            'inverted_hash' => $inverted_binary
        ]
    );
}
add_action('wp_login', 'log_auth', 10, 2);


