<?php
 
// An AWS ELB friendly config file.
 
/** Detect if SSL is used. This is required since we are
terminating SSL either on CloudFront or on ELB */
if (($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] == 'https') OR ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{$_SERVER['HTTPS']='on';}
 
/** The name of the database for WordPress */
define('DB_NAME', '##yourDBname##');

/** MySQL database username */
define('DB_USER', '##youDBusername##');

/** MySQL database password */
define('DB_PASSWORD', '##yourDBpasswd##');

/** MySQL hostname */
define('DB_HOST', '##yourauroracluster.us-west-2.rds.amazonaws.com##');
 
/** Database Charset to use in creating database tables. */ define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
 
/**#@+
 * Authentication Unique Keys and Salts.
 * Change these to different unique phrases!
 */
define('AUTH_KEY',$_SERVER["SECURE_AUTH_KEY"]);
define('SECURE_AUTH_KEY',$_SERVER["AUTH_KEY"]);
define('LOGGED_IN_KEY',$_SERVER["LOGGED_IN_KEY"]);
define('NONCE_KEY',$_SERVER["NONCE_KEY"]);
define('AUTH_SALT',$_SERVER["AUTH_SALT"]);
define('SECURE_AUTH_SALT', $_SERVER["SECURE_AUTH_SALT"]);
define('LOGGED_IN_SALT', $_SERVER["LOGGED_IN_SALT"]);
define('NONCE_SALT', $_SERVER["NONCE_SALT"]);
 
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
/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

/* That's all, stop editing! Happy blogging. */
 
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');
 
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');