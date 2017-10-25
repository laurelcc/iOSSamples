<?php
/* --------------------------------------------------------------------------

	Plugin Name: MahaCodes
	Plugin URI: http://thememaha.com
	Description: ThemeMaha Shortcode.
	Version: 1.5
	Author: ThemeMaha
	Author URI: http://thememaha.com

	A ThemeMaha Framework - Copyright (c) 2014
	Please be extremely cautions editing this file!

    - Shortcodes - Mark 1

 ---------------------------------------------------------------------------*/

	
class Maha_Shortcodes {
	
	function __construct() {
		
		define('MAHA_S_URI', plugin_dir_url( __FILE__ ));
		define('MAHA_S_DIR', plugin_dir_path( __FILE__ ));
		require_once( MAHA_S_DIR . 'maha-shortcodes-ui.php' );
		require_once( MAHA_S_DIR . 'maha-shortcodes-o.php' );
		
  		add_action( 'init', array(&$this,'init') );
		add_action( 'admin_init', array(&$this, 'admin_init'));
		add_action( 'init', array(&$this,'maha_shortcode_o') );

		load_plugin_textdomain( 'MAHA_PLUGIN', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
		
	}


	function init() {
		if( ! is_admin() ){
			wp_enqueue_script( 'maha-tabs-toggles', MAHA_S_URI . 'js/maha-tabs-toggles.js', 'jquery', '1.0', true );
		}

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

		if ( get_user_option('rich_editing') == 'true') {
			add_action( 'media_buttons', array(&$this, 'maha_add_button'),100);
		}
	}  

	function maha_shortcode_o() {
		if( ! is_admin() ){
			wp_enqueue_style( 'maha-shortcodes-o', MAHA_S_URI . 'css/maha-shortcodes-o.css');
		}
	}
	
  	/* --------------------------------------------------------------------------
	 * [maha_add_button - Init Shortcodes Button]
	 ---------------------------------------------------------------------------*/
	function maha_add_button() {
		echo "<a class='button button-primary maha-shortcodes' href='javascript:;'> Maha Shortcodes</a>";
	}
	
	
	/* --------------------------------------------------------------------------
	 * [admin_init - Init Shortcodes Maha Scripts]
	 ---------------------------------------------------------------------------*/
	function admin_init(){
		
		wp_enqueue_style( 'ui-shortcodes-maha', MAHA_S_URI . 'css/admin-ui-shortcodes.css', 'style', '1.0', 'all' );
		
		wp_enqueue_script('magnify-js', MAHA_S_URI . 'js/magnific-popup.js', 'jquery', '1.1.1', true);
		wp_enqueue_script('shortcodes-generator', MAHA_S_URI . '/js/shortcodes-generator.js','jquery','1.0', TRUE);
		wp_enqueue_script('shortcodes-init', MAHA_S_URI . 'js/shortcodes-init.js', 'jquery', '1.0', true);
		wp_enqueue_script('maha-column', MAHA_S_URI . 'js/maha-column.js', 'jquery', '1.0', true);
		
		wp_localize_script( 'jquery', 'Maha_Shortcodes', array('plugin_url' => MAHA_S_URI ) );
		
	}
	
}
$Maha_Shortcodes = new Maha_Shortcodes;