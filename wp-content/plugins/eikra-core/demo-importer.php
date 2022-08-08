<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.2
 */

require_once EIKRA_CORE_BASE_DIR . 'demo-users/user-importer.php';

add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', 'eikra_importer_add_action_links' );
add_filter( 'rt_demo_installer_warning', 'eikra_importer_warning' );
add_filter( 'fw:ext:backups-demo:demos', 'eikra_importer_backups_demos' );
add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', 'eikra_importer_after_demo_install' );

function eikra_importer_add_action_links( $links ) {
	$mylinks = [
		'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">' . __( 'Install Demo Contents', 'eikra-core' ) . '</a>',
	];

	return array_merge( $links, $mylinks );
}

function eikra_importer_warning( $links ) {
	$html
		  = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
	$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'eikra-core' );
	$html .= '</div>';
	$html .= '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
	$html .= __( 'Import your desired demo contents between WPBakery and Elementor page builder. Please, install and activate plugin before import demo.', 'eikra-core' );
	$html .= '</div>';

	return $html;
}

function eikra_importer_backups_demos( $demos ) {
	$demos_array = [
		'demo1'       => [
			'title'        => __( 'Home 1 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/',
		],
		'demo2'       => [
			'title'        => __( 'Home 2 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2/',
		],
		'demo3'       => [
			'title'        => __( 'Home 3 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3/',
		],
		'demo4'       => [
			'title'        => __( 'Home 4 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4/',
		],
		'demo5'       => [
			'title'        => __( 'Home 5 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5/',
		],
		'demo6'       => [
			'title'        => __( 'Home 6 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6/',
		],
		'demo13'      => [
			'title'        => __( 'Home 7 (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7/',
		],
		'demo7'       => [
			'title'        => __( 'Home 1 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-1-onepage/',
		],
		'demo8'       => [
			'title'        => __( 'Home 2 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2-onepage/',
		],
		'demo9'       => [
			'title'        => __( 'Home 3 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3-onepage/',
		],
		'demo10'      => [
			'title'        => __( 'Home 4 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4-onepage/',
		],
		'demo11'      => [
			'title'        => __( 'Home 5 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5-onepage/',
		],
		'demo12'      => [
			'title'        => __( 'Home 6 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6-onepage/',
		],
		'demo14'      => [
			'title'        => __( 'Home 7 Onepage (WPBakery)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7-onepage/',
		],
		'elementor1'  => [
			'title'        => esc_html__( 'Home 1 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/',
		],
		'elementor2'  => [
			'title'        => esc_html__( 'Home 2 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-2/',
		],
		'elementor3'  => [
			'title'        => esc_html__( 'Home 3 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-3/',
		],
		'elementor4'  => [
			'title'        => esc_html__( 'Home 4 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-4/',
		],
		'elementor5'  => [
			'title'        => esc_html__( 'Home 5 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-5/',
		],
		'elementor6'  => [
			'title'        => esc_html__( 'Home 6 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-6/',
		],
		'elementor7'  => [
			'title'        => esc_html__( 'Home 7 (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-7/',
		],
		'elementor8'  => [
			'title'        => esc_html__( 'Home 1 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-1-onepage/',
		],
		'elementor9'  => [
			'title'        => esc_html__( 'Home 2 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-2-onepage/',
		],
		'elementor10' => [
			'title'        => esc_html__( 'Home 3 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-3-onepage/',
		],
		'elementor11' => [
			'title'        => esc_html__( 'Home 4 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-4-onepage/',
		],
		'elementor12' => [
			'title'        => esc_html__( 'Home 5 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-5-onepage/',
		],
		'elementor13' => [
			'title'        => esc_html__( 'Home 6 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-6-onepage/',
		],
		'elementor14' => [
			'title'        => esc_html__( 'Home 7 Onepage (Elementor)', 'eikra-core' ),
			'screenshot'   => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-7-onepage/',
		],
	];

	$download_url = 'http://demo.radiustheme.com/wordpress/demo-content/eikra/';

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', [
			'url'     => $download_url,
			'file_id' => $id,
		] );
		$demo->set_title( $data['title'] );
		$demo->set_screenshot( $data['screenshot'] );
		$demo->set_preview_link( $data['preview_link'] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}

// Run after demo install
function eikra_importer_after_demo_install( $collection ) {
	// Update front page id
	$demos = [
		'demo1'       => 54,
		'demo2'       => 1096,
		'demo3'       => 1135,
		'demo4'       => 1205,
		'demo5'       => 1284,
		'demo6'       => 1273,
		'demo7'       => 1734,
		'demo8'       => 1537,
		'demo9'       => 1555,
		'demo10'      => 1537,
		'demo11'      => 1588,
		'demo12'      => 1601,
		'demo13'      => 1612,
		'demo14'      => 1802,
		'elementor1'  => 2001,
		'elementor2'  => 2054,
		'elementor3'  => 2006,
		'elementor4'  => 2033,
		'elementor5'  => 2058,
		'elementor6'  => 2075,
		'elementor7'  => 2083,
		'elementor8'  => 2182,
		'elementor9'  => 2171,
		'elemento10'  => 2164,
		'elementor11' => 2148,
		'elementor12' => 2141,
		'elementor13' => 2132,
		'elementor14' => 2113,
	];

	$data = $collection->to_array();

	foreach ( $data['tasks'] as $task ) {
		if ( $task['id'] == 'demo:demo-download' ) {
			$demo_id = $task['args']['demo_id'];
			$page_id = $demos[ $demo_id ];
			update_option( 'page_on_front', $page_id );
			flush_rewrite_rules();
			break;
		}
	}

	// Update contact form 7 email
	$cf7ids = [ 7, 1749 ];
	foreach ( $cf7ids as $cf7id ) {
		$mail              = get_post_meta( $cf7id, '_mail', true );
		$mail['recipient'] = get_option( 'admin_email' );
		if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
			$pattern        = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
			$replacement    = '<' . WPCF7_ContactFormTemplate::from_email() . '>';
			$mail['sender'] = preg_replace( $pattern, $replacement, $mail['sender'] );
		}
		update_post_meta( $cf7id, '_mail', $mail );
	}

	// Update post author id
	global $wpdb;
	$id = get_current_user_id();
	if ( $id && $id != 1 ) {
		$query = "UPDATE $wpdb->posts SET post_author = $id";
		$wpdb->query( $query );
	}

	// Import Users
	new Eikra_Core_Demo_User_Import();
}