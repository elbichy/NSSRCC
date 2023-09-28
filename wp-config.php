<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "nscdcgov_wp_rfddp" );

/** Database username */
define( 'DB_USER', "nscdcgov_wp_19foj" );

/** Database password */
define( 'DB_PASSWORD', "?%1ME*P4q1@%pR?8" );

/** Database hostname */
define( 'DB_HOST', "localhost:3306" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'JjD0a+m)s_7Hij-|?6,6=j#y,+P@LpZdwY~6(ei+%&yKSS+=M*|[u.@RgM_+gm=M' );
define( 'SECURE_AUTH_KEY',  '`fUx`2bnX:-=8M~w-dhg_4x{gi^Aat|Rk)=Hw^mGpFF:K}LY(]-nL[W0j8]{q _(' );
define( 'LOGGED_IN_KEY',    'flv7wh0]p,8p7J0IW,32YqF:eYZc}o6G>E;r?=?HRF~SuXI5#5|uiYI0?p*q}s^Z' );
define( 'NONCE_KEY',        'X:C:Jc%XL+`.&!|*Eb>*>uu]j)wkX1eg^fpLl RD)~cC7PdiyqPIYH:*Kk[H,nU_' );
define( 'AUTH_SALT',        '&jUae@<Z8 a5^yx[bwXr20fe4iJ/$59$V>-c9}=;D_!6J{`@][,hd8-I&klIDhtK' );
define( 'SECURE_AUTH_SALT', '(F=*l<cY^f+~kn,>Zo.HPL7_ha3DCK~w6T+Med^Z<t]T*1%}5>z}mh%?(*TDQhbb' );
define( 'LOGGED_IN_SALT',   ' F}N V3X ruVz;OYJ;Q1Z1iXoquk+/VQh+a_N/(iU3VMA{Tl?A<UF#r2/ZK0c[Hs' );
define( 'NONCE_SALT',       'aXyIAKIpb7Km2xC18&;;}<W;&4+tVvs$e~y!Xo~,W <AYVPJO$8fxJZsLN4S_8-4' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Zy9CHRV1u_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'DUPLICATOR_AUTH_KEY', '~UVzvIT.T[;:;:/!z1Y)IX)8>m~z/K91;}p@0k3a}f-Fr9bO/-`8;sKeUczMUntT' );
define( 'WP_PLUGIN_DIR', '/home/nscdcgov/public_html/nssrcc/wp-content/plugins' );
define( 'WPMU_PLUGIN_DIR', '/home/nscdcgov/public_html/nssrcc/wp-content/mu-plugins' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
