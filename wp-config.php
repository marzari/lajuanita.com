<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lajuanita');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'a-y+e/ 4QHBul]a5*OSYsu6+IDh;B3!wDGPy)x>X{%!vZFlK[eQr,mq%I[+M6&}2');
define('SECURE_AUTH_KEY',  'ZySl$kUM{,v!sB_}_>jC2KW}YTA,0:!1Il=Y<r2:c$y=7^![tc=hlgtuK.6xZdLV');
define('LOGGED_IN_KEY',    '$Tzx|Xca.S-5LD~}G8 Y>[ZUPkl+<t_XC}iRYu5+e[N1TbaL.z7p/o9IzV#~-mE#');
define('NONCE_KEY',        'lsU{jCoF,Wvx>|Z/)i6c+YdT~IF<J12vSo.Sq^}.~_P kO,C?@/9N8!msx/Wm<G=');
define('AUTH_SALT',        'g%[c-7tj.WKF*vU=^|wL~vGx:&a(STU:C:Hsk0q:w)(y7Qnv}zZw3&2NRFW@MElg');
define('SECURE_AUTH_SALT', '4Jstw2T0X^QC`uY{LK`0dz?.fe@4[{%u`[TV7wUH(F9j||gQ]VLrl^cB&$w)Svs1');
define('LOGGED_IN_SALT',   'MweV2%h=?]/?&pW[4N7by7vJMo4jDR,.U_vOVe~pr<^jV&w_l;unT@QVcBln$NqI');
define('NONCE_SALT',       'QR:dR;?>d/C&SqAkxf8,o8d+@sH@SC1WYbBNa,am`u,ul:^)/46hbd}u~{t:+/ 3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'LJ_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
