<?php

class VOTE_Admin {
	
	public function __construct() {

		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );
		
		add_filter( "plugin_action_links_cust-vote-manager/index.php", array( $this, 'add_settings_link' ) );
	}
	
	function vote_plugin_activation_action(){
		$defaults = array(
				'voting_end_date' => '',
				'articles_published_in' => '',
		);
		update_option( 'cust_vote_manager', $defaults );
	}
	
	public function register_settings() {
		register_setting( 'cust_vote_manager', 'cust_vote_manager', array($this, 'sanitize_settings') );
	}

	public function sanitize_settings( $settings ) {
		$settings['voting_end_date'] = trim( strip_tags( $settings['voting_end_date'] ) );
		$settings['articles_published_in'] = trim( strip_tags( $settings['articles_published_in'] ) );
		return $settings;
	}

	public function add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=cust-vote-manager">'. __('Settings') . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	public function add_menu_item() {
		add_options_page( 'Vote Settings', 'Vote Settings', 'manage_options', 'cust-vote-manager', array( $this, 'show_settings_page' ) );
	}

	public function show_settings_page() {
		$opts = $this->cvm_get_options();
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		include CUST_VOTE_DIR . 'settings.php';
	}

	function cvm_get_options(){	
		static $options;

		if( ! $options ) {
			$defaults = array(
				'voting_end_date' => "",
				'articles_published_in' => "",
			);

			$db_option = get_option( 'cust_vote_manager', array());
			if( ! $db_option ) {
				update_option( 'cust_vote_manager', $defaults );
			}
			
			$options = wp_parse_args( $db_option, $defaults );
		}
		return $options;
	}
}