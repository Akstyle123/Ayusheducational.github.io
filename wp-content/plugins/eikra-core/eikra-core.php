<?php
/*
Plugin Name: Eikra Core
Plugin URI: http://radiustheme.com
Description: Eikra Core Plugin for Eikra Theme
Version: 3.4.4
Author: Radius Theme
Author URI: http://radiustheme.com
*/

define( 'EIKRA_CORE', true );
define( 'EIKRA_CORE_VERSION', '3.4.2' );
define( 'EIKRA_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'EIKRA_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'EIKRA_CORE_THEME_PREFIX',  'eikra' );

// Text Domain
add_action( 'plugins_loaded', 'eikra_core_load_textdomain' );
if ( !function_exists( 'eikra_core_load_textdomain' ) ) {
	function eikra_core_load_textdomain() {
		load_plugin_textdomain( 'eikra-core' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}

// Includes
add_action( 'after_setup_theme', 'eikra_core_includes', 4 );
if ( !function_exists( 'eikra_core_includes' ) ) {
	function eikra_core_includes(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}

		// Widgets
		require_once EIKRA_CORE_BASE_DIR . 'widgets/init.php';

		// Demo Importer settings
		require_once EIKRA_CORE_BASE_DIR . 'demo-importer.php';
		require_once EIKRA_CORE_BASE_DIR . 'demo-importer-ocdi.php';
	}
}

// Post types
add_action( 'after_setup_theme', 'eikra_core_post_types', 15 );
if ( !function_exists( 'eikra_core_post_types' ) ) {
	function eikra_core_post_types(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once EIKRA_CORE_BASE_DIR . 'post-types.php';
		require_once EIKRA_CORE_BASE_DIR . 'post-meta.php';
	}
}

// Include Elementor
add_action('elementor/loaded', function () {
    require_once EIKRA_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
});

// Visual composer
add_action( 'after_setup_theme', 'eikra_core_vc_modules', 20 );
if ( !function_exists( 'eikra_core_vc_modules' ) ) {
	function eikra_core_vc_modules(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'WPB_VC_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}

		$modules = array( 'inc/abstruct', 'title', 'info-box', 'image-text-box', 'text-with-title', 'text-with-button', 'cta', 'posts', 'research', 'event', 'course-search', 'course-slider', 'course-grid', 'course-featured', 'course-isotope', 'instructor-slider', 'instructor-grid', 'counter', 'testimonial', 'event-countdown', 'countdown', 'logo-slider', 'product-slider', 'pricing-box' , 'gallery', 'video', 'contact' );
		$modules = apply_filters( 'eikra_vc_addons_list', $modules );

		foreach ( $modules as $module ) {
			$template_name = "/vc-modules/{$module}.php";
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = EIKRA_CORE_BASE_DIR . 'vc-modules/' . $module. '.php';
			}
			require_once $file;
		}
	}
}

// Menu Query String Support
add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {
	$menu_query_string_key = get_post_meta($item_id, 'rt_menu_query_string_key', true);
	$menu_query_string = get_post_meta($item_id, 'rt_menu_query_string', true);
	?>
	<div class="menu-query-string description-wide">
		<p class="description description-thin">
			<label for="rt-menu-query-string-key-<?php echo $item_id; ?>" >
				<?php _e('Query String Key', 'eikra-core'); ?><br>
				<input type="text"
				       id="rt-menu-query-string-key-<?php echo $item_id; ?>"
				       name="rt-menu-query-string-key[<?php echo $item_id; ?>]"
				       value="<?php echo esc_html($menu_query_string_key); ?>"
				/>
			</label>
		</p>
		<p class="description description-thin">
			<label for="rt-menu-query-string-<?php echo $item_id; ?>" >
				<?php _e('Query String Value', 'eikra-core'); ?><br>
				<input type="text"
				       id="rt-menu-query-string-<?php echo $item_id; ?>"
				       name="rt-menu-query-string[<?php echo $item_id; ?>]"
				       value="<?php echo esc_html($menu_query_string); ?>"
				/>
			</label>
		</p>
	</div>
	<?php

}, 10, 2);

add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_db_id) {
	$query_string_key = isset($_POST['rt-menu-query-string-key'][$menu_item_db_id]) ? $_POST['rt-menu-query-string-key'][$menu_item_db_id] : '';
	$query_string_value = isset($_POST['rt-menu-query-string'][$menu_item_db_id]) ? $_POST['rt-menu-query-string'][$menu_item_db_id] : '';
	update_post_meta($menu_item_db_id, 'rt_menu_query_string_key', $query_string_key);
	update_post_meta($menu_item_db_id, 'rt_menu_query_string', $query_string_value);
}, 10, 2);


add_filter( 'wp_get_nav_menu_items', function( $items, $menu = '', $args ) {
	foreach( $items as $item ) {
		$menu_query_string_key = get_post_meta($item->ID, 'rt_menu_query_string_key', true);
		$menu_query_string = get_post_meta($item->ID, 'rt_menu_query_string', true);
		if ( $menu_query_string )  {
			$item->url = add_query_arg( $menu_query_string_key, $menu_query_string, $item->url );
		}
	}
	return $items;
}, 11, 3 );
// .End Menu Query String Support

// Plugin Hooks
require_once EIKRA_CORE_BASE_DIR . 'plugin-hooks.php';