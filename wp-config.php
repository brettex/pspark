<?php
<<<<<<< HEAD
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
=======

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
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
<<<<<<< HEAD
define('DB_NAME', 'db594151885');

/** MySQL database username */
define('DB_USER', 'dbo594151885');

/** MySQL database password */
define('DB_PASSWORD', 'Wurlitzer77*');

/** MySQL hostname */
define('DB_HOST', 'db594151885.db.1and1.com');
=======
#mysql://baaaa762f19ada:7fcdd5bc@us-cdbr-iron-east-02.cleardb.net/heroku_3311071c3bb72f4?reconnect=true
define('DB_NAME', 'heroku_3311071c3bb72f4');

/** MySQL database username */
define('DB_USER', 'baaaa762f19ada');

/** MySQL database password */
define('DB_PASSWORD', '7fcdd5bc');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-iron-east-02.cleardb.net');
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

<<<<<<< HEAD

=======
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
<<<<<<< HEAD
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');
=======
define('AUTH_KEY',         'b#`?_(kf p!W:N9.L59#{!sjD6LxHF~H-<$,<!kB]SG1,z>i^_yJxw]TB4zz9*AW');
define('SECURE_AUTH_KEY',  '*1,lSl-Fu)-,m!B<&cghie9t.o*_kW<$}m`^9sH?(C<42O7A-@]VbxHFs(E^~(Pz');
define('LOGGED_IN_KEY',    'GgU4/C+.&Om}VZ.v0m_5?:8M1h4kI &3s@tcuAuWJ2&$TqCb&>yQl`KFEtWP4>x(');
define('NONCE_KEY',        'X|O8IYYihQ}/U@|W2f+>;JxmJI9H)Ir|prf6T$~I=;+7OQv);n,!|:XAPo3wjAA:');
define('AUTH_SALT',        '7qps(v]9/U95l%sc:<1G$O@K=fH5`-)F&:CO=J2X{e#c<N8P._~&BRlYDd*<j~$5');
define('SECURE_AUTH_SALT', 'L._]+?6-SfpRFM8bWy=,?D/%=raY:T%!0DEo<-Mc%E=+i/llK.bK!Q0D:ulB7`?`');
define('LOGGED_IN_SALT',   'd!mwOKA&gH&9{`ma=bZ;8[f8}(FTx8XKEZzI2r9*cWN{0+w-nb+4SaIT|>>P9uO&');
define('NONCE_SALT',       '6?nH/EC_4~&&B@z5do$$R4VdH?Y{[w fK6$w^B2?N%dr4,v/$YHCs+1QowFP}8@K');
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
<<<<<<< HEAD
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
=======
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988
 */
$table_prefix  = 'wp_';

/**
<<<<<<< HEAD
=======
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
<<<<<<< HEAD
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

=======
 */
define('WP_DEBUG', false);

define( 'UPLOADS', 'wp-content' . '/uploads' ); 

>>>>>>> 785ceb192c1a72fd8055c4e4be826688d6322988
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
