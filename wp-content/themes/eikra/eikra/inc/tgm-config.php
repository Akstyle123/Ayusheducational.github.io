<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.8.1
 */

add_action( 'tgmpa_register', 'rdtheme_register_required_plugins' );
function rdtheme_register_required_plugins() {
	$plugins = [
		// Bundled
		[
			'name'         => 'Eikra Core',
			'slug'         => 'eikra-core',
			'source'       => 'eikra-core.zip',
			'required'     => true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '3.4.4',
		],
		[
			'name'         => 'RT Framework',
			'slug'         => 'rt-framework',
			'source'       => 'rt-framework.zip',
			'required'     => true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '2.8',
		],
		[
			'name'         => 'RT Demo Importer',
			'slug'         => 'rt-demo-importer',
			'source'       => 'rt-demo-importer.zip',
			'required'     => true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '4.3.1',
		],
		[
			'name'         => 'WPBakery Page Builder',
			'slug'         => 'js_composer',
			'source'       => 'js_composer.zip',
			'required'     => false,
			'external_url' => 'http://vc.wpbakery.com',
			'version'      => '6.9.0',
		],
		[
			'name'         => 'LayerSlider WP',
			'slug'         => 'LayerSlider',
			'source'       => 'LayerSlider.zip',
			'required'     => false,
			'external_url' => 'https://layerslider.kreaturamedia.com',
			'version'      => '7.2.4',
		],
		[
			'name'     => 'Review Schema Pro',
			'slug'     => 'review-schema-pro',
			'source'   => 'review-schema-pro.zip',
			'required' => false,
			'version'  => '1.0.2',
		],

		// Repository
		[
			'name'     => 'Redux Framework',
			'slug'     => 'redux-framework',
			'required' => true,
		],
		[
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		],
		[
			'name'     => 'LearnPress - WordPress LMS Plugin',
			'slug'     => 'learnpress',
			'required' => true,
		],
		[
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => false,
		],
		[
			'name'     => 'LearnPress - Course Review',
			'slug'     => 'learnpress-course-review',
			'required' => false,
		],
		[
			'name'     => 'LearnPress Courses Wishlist',
			'slug'     => 'learnpress-wishlist',
			'required' => false,
		],
		[
			'name'     => 'Theme My Login',
			'slug'     => 'theme-my-login',
			'required' => false,
		],
		[
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		],
		[
			'name'     => 'Video Conferencing with Zoom',
			'slug'     => 'video-conferencing-with-zoom-api',
			'required' => false,
		],
//		[
//			'name'     => 'WP Retina 2x',
//			'slug'     => 'wp-retina-2x',
//			'required' => false,
//		],
//		[
//			'name'     => 'Meks Simple Flickr Widget',
//			'slug'     => 'meks-simple-flickr-widget',
//			'required' => false,
//		],
//		[
//			'name'     => 'Smash Balloon Social Photo Feed',
//			'slug'     => 'instagram-feed',
//			'required' => false,
//		],
		[
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		],
		[
			'name'     => 'YITH WooCommerce Quick View',
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => false,
		],
		[
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		],
		[
			'name'     => 'Review Schema Free',
			'slug'     => 'review-schema',
			'required' => false,
		],
		[
			'name'     => 'MC4WP: Mailchimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
		],
	];

	$config = [
		'id'           => 'eikra',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => RDTHEME_PLUGINS_DIR,     // Default absolute path to bundled plugins.
		'menu'         => 'eikra-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	];

	tgmpa( $plugins, $config );
}