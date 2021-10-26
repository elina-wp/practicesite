<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7VpabgwKXhmJSa/FFIwIZMigkqbMNNGdEwaLyfwHKTZ3fQ3bSs7Qxz7vH1Cv0vwGwC46k9jDEAD+E3VmsZkp1Q==');
define('SECURE_AUTH_KEY',  'zat58PdU1XhMWnw+iDmiNyLi0Qq1akqrTkX9vUEyB2PDW5wn5gA8ad5wNUK4RlaC4Cfe09K1NQkTNBNzE5caYQ==');
define('LOGGED_IN_KEY',    '9iWqCbNwiAD6HLDg6I71sTvP5yz/+iJVOCTAa2BbMDChw3KPEk8nLVVZAH0GhzuAZHYGjgbGqU3NyJU9drX8ow==');
define('NONCE_KEY',        'kGTLtYLnkL1HfyW4SFlMXO90LZpqiKPt8A4tyb1YNEzrjhiwZu0NDtm/LlTPEQbce4Ql2wjB/M6OAdbzeAhrIQ==');
define('AUTH_SALT',        'gTlGfLKrmyJ7yO0Z2jB/eAtP8ci/s4ieyWK8m2KA86M6VGBadpGIIr2Yf4VC+6LCKYemu2aF2kJpoR2JdaQ8ew==');
define('SECURE_AUTH_SALT', 'dR4WwKF4fJINEQlOEp6+talfCtqbxxky0gzsPPD/+C0j0IVpQMKKtT80X+hAZr8vK/tEodYlZxAdWxpDQlPfMQ==');
define('LOGGED_IN_SALT',   '+FlmHWL3Y/1S/kE/H1f/CRvJN1lHHqoXnGc3R8UOk4JoJ2UtGA66G8YrtHLNKf/d6e1swh7qAnbjXTdXirsEvA==');
define('NONCE_SALT',       'gPAGpqOEXSs0h+P0blo7uB19B2ZP+6Txxqta3HFlb6Mxx3AvmGYKR1IU+r2KAn2XuehF/m6razQaA9cfVxqHpA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_DEBUG', true );



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
