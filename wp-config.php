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
define('DB_NAME', 'wp_support');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'C>K8D2u4L{i#|&cV&RB3ZJ5YTXuTza#|(LE*L+(uX0+F++Riz2Nr)6~A9?K9ke#h');
define('SECURE_AUTH_KEY',  ';~>Dv]6ik#Ami8Y^Xtzn+@9cv3lF+CJzUKjFXyR>uT9(2fc9r8+Df$ItK Izhiw{');
define('LOGGED_IN_KEY',    '+bpW(xtOc}r;#G6wnEx[!M6D1,(->&5itxp$Eyf_:(<=H$cZm{IZ([+$:[5H}L4,');
define('NONCE_KEY',        'L9kQTM=VJ)fmkXBNvqa!}!gO4^w2:).upuaa!D>]ofz..qAAejj7{FN&F}(%UF28');
define('AUTH_SALT',        '~l=G iz^K*J2uR[RJce(eSTGNtS+SBl8_61(j`5c{eFJbhwpRH|*1[B(MiSk7z>w');
define('SECURE_AUTH_SALT', 'mc)5gv6K|7s;i.sHbwt#A{~b0oHO,p{g{2F5kKL,JH%PAutt U(dA^oNal4n@d-C');
define('LOGGED_IN_SALT',   'Pmk=$|OtzQ:(bR2UUlA;Uu%3N;R::RoJ|_{_{q-hy{cYE!P<|=a9QOm4ljFY@VM0');
define('NONCE_SALT',       'shu,By-OC{W:RBf+%FMUKwOVj!|#=-AQttGmeJQ&F=?NdMU(!A#!h&c~4QiLPMW0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
