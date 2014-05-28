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
define('DB_NAME', 'riverridgepal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'M@g1c1091');

/** MySQL hostname */
define('DB_HOST', 'ReicheGroupFree.c1gmutcmidsi.us-east-1.rds.amazonaws.com');

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
define('AUTH_KEY',         'QuIf|:{f-pbF7i!iAf}%/mDnCs8R%%IQUbf@7`Nh,Vpa-<_|/4?p,_|BswK/I!%I');
define('SECURE_AUTH_KEY',  'H3G^6@6>H$+tdGLvo}r0(;=%9t]P&g]90j^vg;7y9}$zCw&Dv>!_(ZSvDs2.-,uc');
define('LOGGED_IN_KEY',    '2;h6hUf-_>$d41?V<ypbLEu&KHq_AY/Zl0:@cb$%->m<yRh5-,C/Go+dN>lGy|??');
define('NONCE_KEY',        'x`:czHktErg<Tf}|[;KC:|<%_nSYq|<UD-Y=P)Oqt|Xf8d1n@-1GN};UE9-m6-.t');
define('AUTH_SALT',        'm0F:-~XJwB|IX0|pqZstW28g[yBUY|F 5:5F0%Yeaw/JFC2~*aJc@B(goO|OOp+j');
define('SECURE_AUTH_SALT', 'j3|]D;a=7M^BV}5N11d*1g,Rg|&^jECk(CR8ENSr`e$$Pr=`wf<}FnP)4gfkqGuN');
define('LOGGED_IN_SALT',   'hK2irD1Crz;TlM4a$6b?<+MZxEs*v|zZ:e732b[}9|vnh+_vo-mlcK-48ulCU;|T');
define('NONCE_SALT',       '4,(=Y|K4*o|Q!{CrHuaqh|Eud^&}1.-h,LE8i>~:YR$fdl0,db?|>q+e,b2PyWib');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

