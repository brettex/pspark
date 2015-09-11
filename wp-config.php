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
define('DB_NAME', 'db446873817');

/** MySQL database username */
define('DB_USER', 'dbo446873817');

/** MySQL database password */
define('DB_PASSWORD', 'Wurlitzer77');

/** MySQL hostname */
define('DB_HOST', 'db446873817.db.1and1.com');

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
define('AUTH_KEY',         'b#`?_(kf p!W:N9.L59#{!sjD6LxHF~H-<$,<!kB]SG1,z>i^_yJxw]TB4zz9*AW');
define('SECURE_AUTH_KEY',  '*1,lSl-Fu)-,m!B<&cghie9t.o*_kW<$}m`^9sH?(C<42O7A-@]VbxHFs(E^~(Pz');
define('LOGGED_IN_KEY',    'GgU4/C+.&Om}VZ.v0m_5?:8M1h4kI &3s@tcuAuWJ2&$TqCb&>yQl`KFEtWP4>x(');
define('NONCE_KEY',        'X|O8IYYihQ}/U@|W2f+>;JxmJI9H)Ir|prf6T$~I=;+7OQv);n,!|:XAPo3wjAA:');
define('AUTH_SALT',        '7qps(v]9/U95l%sc:<1G$O@K=fH5`-)F&:CO=J2X{e#c<N8P._~&BRlYDd*<j~$5');
define('SECURE_AUTH_SALT', 'L._]+?6-SfpRFM8bWy=,?D/%=raY:T%!0DEo<-Mc%E=+i/llK.bK!Q0D:ulB7`?`');
define('LOGGED_IN_SALT',   'd!mwOKA&gH&9{`ma=bZ;8[f8}(FTx8XKEZzI2r9*cWN{0+w-nb+4SaIT|>>P9uO&');
define('NONCE_SALT',       '6?nH/EC_4~&&B@z5do$$R4VdH?Y{[w fK6$w^B2?N%dr4,v/$YHCs+1QowFP}8@K');

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

define( 'UPLOADS', 'wp-content' . '/uploads' ); 

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
