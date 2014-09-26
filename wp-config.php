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
define('DB_NAME', 'izzfeed_us');

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
define('AUTH_KEY',         ' E_g7lBsf:jshY,c+,n,r44x@xYLDDbF5}?PK/HQ>#E_4bes$l?wspgC8.{F%g)<');
define('SECURE_AUTH_KEY',  'N9g>;|qD~Gg?fqyQYeJ*m$NvVRoEe$R1@t~7{|pSN8d*=r97VeTU?2bflWl[a9mR');
define('LOGGED_IN_KEY',    'R`+|^ksgG^UZUXa{ JS!vAf3n&{Fr}tXlMjZb3RK!Wg$BFg{Wj|?hp{8I]>Yi@n?');
define('NONCE_KEY',        'PR:#SA|(Vm2cQ`]u:*<hVZC.U<dDWq~`wiG2{9J2wZbHr7l[}Aad$Jrtq+3+2IB,');
define('AUTH_SALT',        'W>PExxt{WX#jj2c,hVgDm8eN,!RF? npRi}1X73IDDCL7CuS9@mv|=cA[q/H1U*&');
define('SECURE_AUTH_SALT', '}n3MK|*d0EC8-#Aw[hJ ~PSyQ_~WCN|.ZhLW(78f4!I1Z@)h*]&&JI-1=fs=I}5!');
define('LOGGED_IN_SALT',   '_N:9y2`/|yr!`XS#:+-+?QW]hH`dZC)D.?Q<W(2wo[0~ +9>@7TA*+rb1]TdV:V|');
define('NONCE_SALT',       '22qIg,-8$nzJF.mK07/R+kp{uts@d`QPUYjGN*BhD]R0TC%/~uZ @Ox]+>nYlQi]');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
