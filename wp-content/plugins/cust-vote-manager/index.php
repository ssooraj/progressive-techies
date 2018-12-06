<?php
/*
 * Plugin Name: Vote Manager
 * Plugin URI:
 * Description: Vote articles
 * Author: Babu K A
 * Version: 1.0
 * Author URI:
 */

if (! defined ( 'CUST_VOTE_DIR' ))
    define ( 'CUST_VOTE_DIR', plugin_dir_path( __FILE__ ) );

if (! defined ( 'CUST_VOTE_URL' ))
    define ( 'CUST_VOTE_URL', plugins_url ( '/' , __FILE__ ) );

require CUST_VOTE_DIR . 'vote-public.php';
new VOTE_Public();

if( is_admin() ) {
   require CUST_VOTE_DIR . 'vote-admin.php';
   new VOTE_Admin();
}


register_activation_hook(__FILE__, array('VOTE_Admin','vote_plugin_activation_action'));

add_action( 'plugins_loaded', 'cvm_update_db' );

function cvm_update_db(){
	$default = get_option('cust_vote_manager');
	update_option('cust_vote_manager',$default);
}