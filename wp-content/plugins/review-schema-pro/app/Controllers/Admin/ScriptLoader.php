<?php

namespace Rtrsp\Controllers\Admin; 

use Rtrsp\Helpers\Functions;

class ScriptLoader {

	private $suffix;
	private $version;
	private $ajaxurl;
	private static $wp_localize_scripts = [];

	function __construct() {

		$this->suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';    
		$this->version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : rtrsp()->version();

		$this->ajaxurl = admin_url( 'admin-ajax.php' ); 

		add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ), 1 ); 
	}  

	function register_script_both_end() { 

		//wp_register_style( 'slick', rtrsp()->get_assets_uri( "vendor/slick-carousel/css/slick{$this->suffix}.css" ), array(), $this->version ); 
	}

	function register_script() {
		$this->register_script_both_end();  
		
		//wp_enqueue_style( 'slick' );   
		
	}  
}
