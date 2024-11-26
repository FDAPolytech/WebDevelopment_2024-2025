<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Lf}p^B~RohMnTzOAI{<Hp}wR[IP11@qCO=a&gRs.?LA#dSO1E`5y<n#22CKKjWha' );
define( 'SECURE_AUTH_KEY',  '}t#qG>s9(OvA{||w(44D3TQ!#nuwPd @J*2[+@KsxU.tbZI[[?}g xMS8Yw1C=1^' );
define( 'LOGGED_IN_KEY',    't=w^[/?dY8(DHZ}AK&LwbP#p~935-bFS8bMy!i81qAV`L-SrT-*md~r]|)Fq0V/U' );
define( 'NONCE_KEY',        '1lG73,$Wpk(=`c6UA6ry?Dc_Np}{=j6~;CEoL5Wg%B0$9MU,/UE53 Cj&kU_s}Jo' );
define( 'AUTH_SALT',        '+*,-3-u8!v(,/v%CA r!z;x>NFe+c.Z-N:8V?EamkwC`KC2N >g(2G{EJ2w0E!b5' );
define( 'SECURE_AUTH_SALT', '~xMZ5y>xk+,f5Bm6lZ<X<6r?P;ure}bJ4?,?y7;%<-M4WH~fE0Pn(~J#;!FJ=SH+' );
define( 'LOGGED_IN_SALT',   'voB+&u<eEK~3],&hhlbd^7W/dy-[.L~XHC/:Noi29ze ,kCK/1m8&9:/%Z+#X!]<' );
define( 'NONCE_SALT',       'eyXiG(okt0N -B_pi32X5tX-9 %WqVe8@ b!1ZD>pQ5IYF0uZiy0yZ.3eZd5Aq=r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
