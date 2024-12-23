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
define( 'DB_NAME', 'testsite_db' );

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
define( 'AUTH_KEY',         '!7`JxL[,z[d$mJ].PoOt!-ZA|[/d8C[vgf](11ELA~q%#QNE6(pZ M4;M=G-$L-x' );
define( 'SECURE_AUTH_KEY',  'tTjNMgbaCiUSZ}R+[qn^UW 4Q[[desGI1h5%t@VK)d%dUv&K&BWU*g@%k[++|YJ%' );
define( 'LOGGED_IN_KEY',    'Ema#|`Z~!dI%8m 3@l]gS%[$^ZuK0_f[Oly_VOQ`2NOP`i[9cmn[^%70!b<*mw^N' );
define( 'NONCE_KEY',        '@c9<_*1V*SWEH1|e4K$|)90T}#]Y5Iid!l)0>M:ho;FF7,pv#UF~.^qct*BXdC$`' );
define( 'AUTH_SALT',        ';E)HT=<{O#wD!Ng1.D7|v)LC/SmsJbH_.rQ?*dgqdqaj3 _dG_1A5W5=ks1K;H2j' );
define( 'SECURE_AUTH_SALT', 'Hn#o=MKDK7[kql8` *_JXfvl<WJ`x9s4IDZVoA`Bu73[ENHEvbHR/,5lzZc_DHXT' );
define( 'LOGGED_IN_SALT',   '%R%GFWe|f4/Vy;)S*|Elu[=)0/@IF[MVn@*6:}SEG:S-*4Kn=.)3+`ioe%?ZkQ?P' );
define( 'NONCE_SALT',       'z3fwPrV5o] @Xyb;&&2l2zLAEee$Rr[gJH<W3:]$?^%h:%e$Tp^qxB)5@VQ2[E`z' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
