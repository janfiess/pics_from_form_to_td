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
define( 'DB_NAME', 'zimalofo_wp1' );

/** Database username */
define( 'DB_USER', 'zimalofo_wp1' );

/** Database password */
define( 'DB_PASSWORD', 'rpwfeXRPuF9' );

/** Database hostname */
define( 'DB_HOST', 'zimalofo.mysql.db.internal' );

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
define( 'AUTH_KEY',         'x)z2q9B<=)QNeRYe1QGYz1aI}~[ P6ptF=W317$5grRteCV^d)kl=](t><vzqdlz' );
define( 'SECURE_AUTH_KEY',  '!3ta>^i/lkfLjQV{Jv=@Cos8]229v x8=o_Cl|D(2iMZhG`FlN2*Qc6!2h[J}t7V' );
define( 'LOGGED_IN_KEY',    '~Xrb&/oC3djcfcsH%4x,QZ{P4.O7YVt:!uezMw8PYMDB{Qt2QH[[#GP?sGK2iSw}' );
define( 'NONCE_KEY',        'o<@KaJXMW)1Juw&M8=Aq=Y65G&]^vXrnK>s%A7_v6]|w4,-mB&{*.KM{~R])=(LN' );
define( 'AUTH_SALT',        'SwL7MS,Z!;}>I2DvDd7e(l,|+(;8OO_cMGg^Gx>pNwayOQht^nUK2Q~}en=RhYUZ' );
define( 'SECURE_AUTH_SALT', 'MGfG(b +HcF;OYO2fWJVDiY<t=$fv,Z1_D =i;3.3Mu#duJM`bo@6ptBJ:OY&|X-' );
define( 'LOGGED_IN_SALT',   '$3N|2<oE{D[%*^,QlRL&_SHI9_Wk#z1Chvx^6wfJ(Zr%sQ1n8V3Oq8X3UcZRtlzQ' );
define( 'NONCE_SALT',       'En3qQpfAaE+@6V`:A&$D35CcjEnfI)p6;/47Q%S!Fs `^_?!7JZOk8n&?COH{}ww' );

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
