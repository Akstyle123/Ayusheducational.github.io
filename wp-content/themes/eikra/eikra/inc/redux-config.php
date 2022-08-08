<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.5
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

$opt_name = "eikra";

$theme = wp_get_theme();
$args  = [
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'disable_tracking'     => true,
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'submenu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Eikra Options', 'eikra' ),
	'page_title'           => esc_html__( 'Eikra Options', 'eikra' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	//'google_api_key'       => 'AIzaSyC2GwbfJvi-WnYpScCPBGIUyFZF97LI0xs',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-menu',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	'forced_dev_mode_off'  => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => 'eikra-options',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => true,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',
	// Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
];

$args = apply_filters( 'rdtheme_redux_args', $args );

Redux::setArgs( $opt_name, $args );

// Fields
Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'General', 'eikra' ),
		'id'      => 'general_section',
		'heading' => '',
		'icon'    => 'el el-network',
		'fields'  => [
			[
				'id'          => 'primary_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Primary Color', 'eikra' ),
				'default'     => '#002147',
			],
			[
				'id'          => 'secondery_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Secondery/Hover Color', 'eikra' ),
				'default'     => '#fdc800',
			],
			[
				'id'      => 'preloader',
				'type'    => 'switch',
				'title'   => esc_html__( 'Preloader', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'       => 'preloader_image',
				'type'     => 'media',
				'title'    => esc_html__( 'Preloader Image', 'eikra' ),
				'subtitle' => esc_html__( 'Please upload your choice of preloader image. Transparent GIF format is recommended', 'eikra' ),
				'default'  => [
					'url' => RDTHEME_IMG_URL . 'preloader.gif',
				],
				'required' => [ 'preloader', 'equals', true ],
			],
			[
				'id'      => 'back_to_top',
				'type'    => 'switch',
				'title'   => esc_html__( 'Back to Top Arrow', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'       => 'no_preview_image',
				'type'     => 'media',
				'title'    => esc_html__( 'Alternative Preview Image', 'eikra' ),
				'subtitle' => esc_html__( 'This image will be used as preview image in some archive pages if no featured image exists', 'eikra' ),
				'default'  => [
					'url' => RDTHEME_IMG_URL . 'noimage.jpg',
				],
			],
			[
				'id'       => 'research_slug',
				'type'     => 'text',
				'title'    => esc_html__( 'Research Slug', 'eikra' ),
				'subtitle' => esc_html__( 'Will be used as slug in Research breadcrumb', 'eikra' ),
				'default'  => 'research',
			],
			[
				'id'       => 'event_slug',
				'type'     => 'text',
				'title'    => esc_html__( 'Event Slug', 'eikra' ),
				'subtitle' => esc_html__( 'Will be used as slug in Event breadcrumb', 'eikra' ),
				'default'  => 'event',
			],
			[
				'id'      => 'event_time_format',
				'type'    => 'radio',
				'title'   => __( 'Event Time Format', 'eikra' ),
				'options' => [
					'24' => __( '24-hour', 'eikra' ),
					'12' => __( '12-hour', 'eikra' ),
				],
				'default' => '24',
			],
			[
				'id'       => 'course_slug',
				'type'     => 'text',
				'class'    => RDTheme_Helper::is_LMS() ? 'hide' : '',
				'title'    => esc_html__( 'Course Slug', 'eikra' ),
				'subtitle' => esc_html__( 'Will be used as slug in Course breadcrumb', 'eikra' ),
				'default'  => 'courses',
			],
			[
				'id'       => 'instructor_slug',
				'type'     => 'text',
				'class'    => RDTheme_Helper::is_LMS() ? 'hide' : '',
				'title'    => esc_html__( 'Instructor Slug', 'eikra' ),
				'subtitle' => esc_html__( 'Will be used as slug in Instructor breadcrumb', 'eikra' ),
				'default'  => 'instructor',
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Contact & Socials', 'eikra' ),
		'id'      => 'socials_section',
		'heading' => '',
		'desc'    => esc_html__( 'In case you want to hide any field, just keep that field empty', 'eikra' ),
		'icon'    => 'el el-twitter',
		'fields'  => [
			[
				'id'      => 'phone',
				'type'    => 'text',
				'title'   => esc_html__( 'Phone', 'eikra' ),
				'default' => '(+123) 2390 7000',
			],
			[
				'id'       => 'email',
				'type'     => 'text',
				'title'    => esc_html__( 'Email', 'eikra' ),
				'validate' => 'email',
				'default'  => 'info@example.com',
			],
			[
				'id'      => 'address',
				'type'    => 'textarea',
				'title'   => esc_html__( 'Address', 'eikra' ),
				'default' => '0123 Alaskan Way, Seattle, WA',
			],
			[
				'id'      => 'social_facebook',
				'type'    => 'text',
				'title'   => esc_html__( 'Facebook', 'eikra' ),
				'default' => '#',
			],
			[
				'id'      => 'social_twitter',
				'type'    => 'text',
				'title'   => esc_html__( 'Twitter', 'eikra' ),
				'default' => '#',
			],
			[
				'id'      => 'social_gplus',
				'type'    => 'text',
				'title'   => esc_html__( 'Google Plus', 'eikra' ),
				'default' => '',
			],
			[
				'id'      => 'social_linkedin',
				'type'    => 'text',
				'title'   => esc_html__( 'Linkedin', 'eikra' ),
				'default' => '#',
			],
			[
				'id'      => 'social_youtube',
				'type'    => 'text',
				'title'   => esc_html__( 'Youtube', 'eikra' ),
				'default' => '',
			],
			[
				'id'      => 'social_pinterest',
				'type'    => 'text',
				'title'   => esc_html__( 'Pinterest', 'eikra' ),
				'default' => '#',
			],
			[
				'id'      => 'social_instagram',
				'type'    => 'text',
				'title'   => esc_html__( 'Instagram', 'eikra' ),
				'default' => '#',
			],
			[
				'id'      => 'social_skype',
				'type'    => 'text',
				'title'   => esc_html__( 'Skype', 'eikra' ),
				'default' => '',
			],
			[
				'id'      => 'social_rss',
				'type'    => 'text',
				'title'   => esc_html__( 'RSS', 'eikra' ),
				'default' => '',
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Header', 'eikra' ),
		'id'      => 'header_section',
		'heading' => '',
		'icon'    => 'el el-caret-up',
		'fields'  => [
			[
				'id'      => 'logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Main Logo', 'eikra' ),
				'default' => [
					'url' => RDTHEME_IMG_URL . 'logo-dark.svg',
				],
			],
			[
				'id'       => 'logo_light',
				'type'     => 'media',
				'title'    => esc_html__( 'Light Logo', 'eikra' ),
				'default'  => [
					'url' => RDTHEME_IMG_URL . 'logo-light.svg',
				],
				'subtitle' => esc_html__( 'Used when Transparent Header is enabled', 'eikra' ),
			],

			[
				'id'       => 'logo_width',
				'type'     => 'select',
				'title'    => esc_html__( 'Logo Area Width', 'eikra' ),
				'subtitle' => __( "Width is defined by the number of bootstrap columns. Please note, navigation menu width will be decreased with the increase of logo width<br/>Note: Not applicable for Header 5",
					'eikra' ),
				'options'  => [
					'1' => esc_html__( '1 Column', 'eikra' ),
					'2' => esc_html__( '2 Column', 'eikra' ),
					'3' => esc_html__( '3 Column', 'eikra' ),
					'4' => esc_html__( '4 Column', 'eikra' ),
				],
				'default'  => '2',
			],

			[
				'id'       => 'logo_strict_width',
				'type'     => 'text',
				'validate' => 'numeric',
				'title'    => esc_html__( 'Logo Width', 'eikra' ),
				'subtitle' => esc_html__( 'You may use logo width. It will be applied on logo strictly', 'eikra' ),
			],

			[
				'id'       => 'logo_strict_height',
				'type'     => 'text',
				'validate' => 'numeric',
				'title'    => esc_html__( 'Logo Height', 'eikra' ),
				'subtitle' => esc_html__( 'You may use logo Height. It will be applied on logo strictly', 'eikra' ),
			],

			[
				'id'       => 'sticky_menu',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sticky Header', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => true,
				'subtitle' => esc_html__( 'Show header when scroll down', 'eikra' ),
			],
			[
				'id'       => 'tr_header',
				'type'     => 'switch',
				'title'    => esc_html__( 'Transparent Header', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => false,
				'subtitle' => esc_html__( 'You have to enable Banner or Slider in page to make it work properly. You can override this settings in individual pages', 'eikra' ),
			],
			[
				'id'       => 'top_bar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Top Bar', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => true,
				'subtitle' => esc_html__( 'You can override this settings in individual pages', 'eikra' ),
			],
			[
				'id'       => 'top_bar_style',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Top Bar Layout', 'eikra' ),
				'default'  => '4',
				'options'  => [
					'4' => [
						'title' => '<b>' . esc_html__( 'Layout 1', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'top4.jpg',
					],
					'1' => [
						'title' => '<b>' . esc_html__( 'Layout 2', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'top1.jpg',
					],
					'2' => [
						'title' => '<b>' . esc_html__( 'Layout 3', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'top2.jpg',
					],
					'3' => [
						'title' => '<b>' . esc_html__( 'Layout 4', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'top3.jpg',
					],
					'5' => [
						'title' => '<b>' . esc_html__( 'Layout 5', 'eikra' ),
						'img'   => RDTHEME_IMG_URL . 'top5.jpg',
					],
					'6' => [
						'title' => '<b>' . esc_html__( 'Layout 6', 'eikra' ),
						'img'   => RDTHEME_IMG_URL . 'top6.jpg',
					],
					'7' => [
						'title' => '<b>' . esc_html__( 'Layout 7', 'eikra' ) . '</b> - You need to set it up from widget area',
						'img'   => RDTHEME_IMG_URL . 'top7.jpg',
					],
				],
				'subtitle' => esc_html__( 'You can override this settings in individual pages', 'eikra' ),
				'required' => [ 'top_bar', '=', true ],
			],
			[
				'id'          => 'top_bar_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Top Bar Background Color', 'eikra' ),
				'default'     => '#002147',
				'required'    => [ 'top_bar', '=', true ],
			],
			[
				'id'          => 'top_bar_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Top Bar Text Color', 'eikra' ),
				'default'     => '#c2d1e2',
				'required'    => [ 'top_bar', '=', true ],
			],
			[
				'id'          => 'top_bar_icon_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Top Bar Icon Color', 'eikra' ),
				'default'     => '#fdc800',
				'required'    => [ 'top_bar', '=', true ],
			],
			[
				'id'          => 'top_bar_color_tr',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Transparent Top Bar Text Color', 'eikra' ),
				'subtitle'    => esc_html__( 'Applied when Transparent Header is enabled', 'eikra' ),
				'default'     => '#d0d6dd',
				'required'    => [ 'top_bar', '=', true ],
			],
			[
				'id'       => 'header_style',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Header Layout', 'eikra' ),
				'default'  => '1',
				'options'  => [
					'1' => [
						'title' => '<b>' . esc_html__( 'Layout 1', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-1.jpg',
					],
					'6' => [
						'title' => '<b>' . esc_html__( 'Layout 2', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-6.jpg',
					],
					'2' => [
						'title' => '<b>' . esc_html__( 'Layout 3', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-2.jpg',
					],
					'3' => [
						'title' => '<b>' . esc_html__( 'Layout 4', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-3.jpg',
					],
					'4' => [
						'title' => '<b>' . esc_html__( 'Layout 5', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-4.jpg',
					],
					'5' => [
						'title' => '<b>' . esc_html__( 'Layout 6', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-5.jpg',
					],
					'7' => [
						'title' => '<b>' . esc_html__( 'Layout 7', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-7.jpg',
					],
					'8' => [
						'title' => '<b>' . esc_html__( 'Layout 8', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-8.jpg',
					],
					'9' => [
						'title' => '<b>' . esc_html__( 'Layout 9', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'header-9.jpg',
					],
				],
				'subtitle' => esc_html__( 'You can override this settings in individual pages', 'eikra' ),
			],
			[
				'id'       => 'header_btn_txt',
				'type'     => 'text',
				'title'    => esc_html__( 'Header Button Text', 'eikra' ),
				'subtitle' => esc_html__( 'Applicable depending on Topbar/Header Layout', 'eikra' ),
				'default'  => esc_html__( 'Apply Now', 'eikra' ),
			],
			[
				'id'       => 'header_btn_url',
				'type'     => 'text',
				'title'    => esc_html__( 'Header Button URL', 'eikra' ),
				'subtitle' => esc_html__( 'Applicable depending on Topbar/Header Layout', 'eikra' ),
				'default'  => '#',
			],
			[
				'id'      => 'search_icon',
				'type'    => 'switch',
				'title'   => esc_html__( 'Search Icon', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'cart_icon',
				'type'    => 'switch',
				'title'   => esc_html__( 'Cart Icon', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'vertical_menu_icon',
				'type'    => 'switch',
				'title'   => esc_html__( 'Vertical Menu Icon', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'       => 'menu_contact_us',
				'type'     => 'switch',
				'title'    => esc_html__( 'Contact Us', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => true,
				'required' => [ 'header_style', 'equals', '8' ],
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Main Menu', 'eikra' ),
		'id'      => 'menu_section',
		'heading' => '',
		'icon'    => 'el el-book',
		'fields'  => [
			[
				'id'     => 'section-mainmenu',
				'type'   => 'section',
				'title'  => esc_html__( 'Main Menu Items', 'eikra' ),
				'indent' => true,
			],
			[
				'id'             => 'menu_typo',
				'type'           => 'typography',
				'title'          => esc_html__( 'Menu Font', 'eikra' ),
				'google'         => true,
				'subsets'        => false,
				'text-align'     => false,
				'color'          => false,
				'text-transform' => true,
				'default'        => [
					'font-family'    => 'Roboto',
					'google'         => true,
					'font-size'      => '15px',
					'font-weight'    => '500',
					'line-height'    => '24px',
					'text-transform' => 'uppercase',
				],
			],
			[
				'id'          => 'menu_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Menu Color', 'eikra' ),
				'default'     => '#002147',
				'required'    => [ 'header_style', '!=', '6' ],
			],
			[
				'id'          => 'menu_color_alt',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Menu Color', 'eikra' ),
				'default'     => '#ffffff',
				'required'    => [ 'header_style', '=', '6' ],
			],
			[
				'id'          => 'menu_color_tr',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Transparent Menu Color', 'eikra' ),
				'subtitle'    => esc_html__( 'Applied when Transparent Header is enabled', 'eikra' ),
				'default'     => '#fff',
			],
			[
				'id'          => 'menu_hover_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Menu Hover Color', 'eikra' ),
				'default'     => '#fdc800',
			],
			[
				'id'     => 'section-submenu',
				'type'   => 'section',
				'title'  => esc_html__( 'Sub Menu Items', 'eikra' ),
				'indent' => true,
			],
			[
				'id'             => 'submenu_typo',
				'type'           => 'typography',
				'title'          => esc_html__( 'Submenu Font', 'eikra' ),
				'google'         => true,
				'subsets'        => false,
				'text-align'     => false,
				'color'          => false,
				'text-transform' => true,
				'default'        => [
					'font-family'    => 'Roboto',
					'google'         => true,
					'font-size'      => '14px',
					'font-weight'    => '400',
					'line-height'    => '21px',
					'text-transform' => 'uppercase',
				],
			],
			[
				'id'          => 'submenu_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Submenu Color', 'eikra' ),
				'default'     => '#d9dee4',
			],
			[
				'id'          => 'submenu_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Submenu Background Color', 'eikra' ),
				'default'     => '#002147',
			],
			[
				'id'          => 'submenu_hover_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Submenu Hover Color', 'eikra' ),
				'default'     => '#FDC800',
			],
			[
				'id'          => 'submenu_hover_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Submenu Hover Background Color', 'eikra' ),
				'default'     => '#1A3B61',
			],
			[
				'id'     => 'section-resmenu',
				'type'   => 'section',
				'title'  => esc_html__( 'Mobile Menu', 'eikra' ),
				'indent' => true,
			],
			[
				'id'       => 'resmenu_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Screen width in which mobile menu activated', 'eikra' ),
				'subtitle' => esc_html__( 'Recommended value is: 992', 'eikra' ),
				'default'  => 992,
				'min'      => 0,
				'step'     => 1,
				'max'      => 2000,
			],
			[
				'id'             => 'resmenu_typo',
				'type'           => 'typography',
				'title'          => esc_html__( 'Mobile Menu Font', 'eikra' ),
				'google'         => true,
				'subsets'        => false,
				'text-align'     => false,
				'color'          => false,
				'text-transform' => true,
				'default'        => [
					'font-family'    => 'Roboto',
					'google'         => true,
					'font-size'      => '14px',
					'font-weight'    => '400',
					'line-height'    => '21px',
					'text-transform' => 'uppercase',
				],
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Banner', 'eikra' ),
		'id'      => 'banner_section',
		'heading' => '',
		'icon'    => 'el el-flag',
		'fields'  => [
			[
				'id'          => 'banner_heading_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Banner Heading Color', 'eikra' ),
				'default'     => '#ffffff',
			],
			[
				'id'          => 'breadcrumb_link_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Breadcrumb Link Color', 'eikra' ),
				'default'     => '#fdc800',
			],
			[
				'id'          => 'breadcrumb_link_hover_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Breadcrumb Link Hover Color', 'eikra' ),
				'default'     => '#ffffff',
			],
			[
				'id'          => 'breadcrumb_active_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Active Breadcrumb Color', 'eikra' ),
				'default'     => '#ffffff',
			],
			[
				'id'          => 'breadcrumb_seperator_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Breadcrumb Seperator Color', 'eikra' ),
				'default'     => '#ffffff',
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Footer', 'eikra' ),
		'id'      => 'footer_section',
		'heading' => '',
		'icon'    => 'el el-caret-down',
		'fields'  => [
			[
				'id'       => 'footer_style',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Footer Layout', 'eikra' ),
				'default'  => '1',
				'options'  => [
					'1' => [
						'title' => '<b>' . esc_html__( 'Layout 1', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'footer-1.jpg',
					],
					'2' => [
						'title' => '<b>' . esc_html__( 'Layout 2', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'footer-2.jpg',
					],
				],
				'subtitle' => esc_html__( 'You can override this settings in individual pages', 'eikra' ),
			],

			[
				'id'     => 'section-footer-area',
				'type'   => 'section',
				'title'  => esc_html__( 'Footer Area', 'eikra' ),
				'indent' => true,
			],
			[
				'id'      => 'footer_area',
				'type'    => 'switch',
				'title'   => esc_html__( 'Display Footer Area', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'       => 'footer_column',
				'type'     => 'select',
				'title'    => esc_html__( 'Number of Columns', 'eikra' ),
				'options'  => [
					'1' => esc_html__( '1 Column', 'eikra' ),
					'2' => esc_html__( '2 Columns', 'eikra' ),
					'3' => esc_html__( '3 Columns', 'eikra' ),
					'4' => esc_html__( '4 Columns', 'eikra' ),
				],
				'default'  => '4',
				'required' => [ 'footer_area', 'equals', true ],
			],
			[
				'id'          => 'footer_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Background Color', 'eikra' ),
				'default'     => '#002147',
				'required'    => [ 'footer_area', 'equals', true ],
			],
			[
				'id'          => 'footer_title_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Title Text Color', 'eikra' ),
				'default'     => '#ffffff',
				'required'    => [ 'footer_area', 'equals', true ],
			],
			[
				'id'          => 'footer_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Text Color', 'eikra' ),
				'default'     => '#bdc4cd',
				'required'    => [ 'footer_area', 'equals', true ],
			],
			[
				'id'          => 'footer_link_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Link Color', 'eikra' ),
				'default'     => '#bdc4cd',
				'required'    => [ 'footer_area', 'equals', true ],
			],
			[
				'id'          => 'footer_link_hover_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Link Hover Color', 'eikra' ),
				'default'     => '#fdc800',
				'required'    => [ 'footer_area', 'equals', true ],
			],
			[
				'id'     => 'section-copyright-area',
				'type'   => 'section',
				'title'  => esc_html__( 'Copyright Area', 'eikra' ),
				'indent' => true,
			],
			[
				'id'      => 'copyright_area',
				'type'    => 'switch',
				'title'   => esc_html__( 'Display Copyright Area', 'eikra' ),
				'on'      => esc_html__( 'Enabled', 'eikra' ),
				'off'     => esc_html__( 'Disabled', 'eikra' ),
				'default' => true,
			],
			[
				'id'       => 'payment_icons',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Payment Icons', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => false,
				'required' => [ 'copyright_area', 'equals', true ],
			],
			[
				'id'       => 'payment_img',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Payment Icons Gallery', 'eikra' ),
				'required' => [ 'payment_icons', 'equals', true ],
			],
			[
				'id'          => 'copyright_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Copyright Background Color', 'eikra' ),
				'default'     => '#001a39',
				'required'    => [ 'copyright_area', 'equals', true ],
			],
			[
				'id'          => 'copyright_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Copyright Text Color', 'eikra' ),
				'default'     => '#909da4',
				'required'    => [ 'copyright_area', 'equals', true ],
			],
			[
				'id'       => 'copyright_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Copyright Text', 'eikra' ),
				'default'  => '&copy; Copyright Eikra 2021. by  <a target="_blank" href="' . RDTHEME_AUTHOR_URI . '">RadiusTheme</a>',
				'required' => [ 'copyright_area', 'equals', true ],
			],
		],
	]
);

Redux::setSection( $opt_name,
	[
		'title'  => esc_html__( 'Typography', 'eikra' ),
		'id'     => 'typo_section',
		'icon'   => 'el el-text-width',
		'fields' => [
			[
				'id'          => 'typo_body',
				'type'        => 'typography',
				'title'       => esc_html__( 'Body', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '15px',
					'font-weight' => '400',
					'line-height' => '26px',
				],
			],
			[
				'id'          => 'typo_h1',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h1', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '40px',
					'font-weight' => '500',
					'line-height' => '44px',
				],
			],
			[
				'id'          => 'typo_h2',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h2', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '28px',
					'font-weight' => '500',
					'line-height' => '31px',
				],
			],
			[
				'id'          => 'typo_h3',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h3', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '20px',
					'font-weight' => '500',
					'line-height' => '26px',
				],
			],
			[
				'id'          => 'typo_h4',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h4', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '16px',
					'font-weight' => '500',
					'line-height' => '18px',
				],
			],
			[
				'id'          => 'typo_h5',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h5', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '14px',
					'font-weight' => '500',
					'line-height' => '16px',
				],
			],
			[
				'id'          => 'typo_h6',
				'type'        => 'typography',
				'title'       => esc_html__( 'Header h6', 'eikra' ),
				'google'      => true,
				'subsets'     => false,
				'text-align'  => false,
				'font-weight' => false,
				'color'       => false,
				'default'     => [
					'font-family' => 'Roboto',
					'google'      => true,
					'font-size'   => '12px',
					'font-weight' => '500',
					'line-height' => '14px',
				],
			],
		],
	]
);

// Generate Common post type fields
function rdtheme_redux_post_type_fields( $prefix ) {

	return [

		[
			'id'      => $prefix . '_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Layout', 'eikra' ),
			'options' => [

				'left-sidebar'  => [
					'alt'   => esc_html__( 'Left Sidebar', 'eikra' ),
					'title' => esc_html__( 'Left Sidebar', 'eikra' ),
					'img'   => RDTHEME_IMG_URL . 'left-sidebar.png',
				],
				'full-width'    => [
					'alt'   => esc_html__( 'Full Width', 'eikra' ),
					'title' => esc_html__( 'Fullwidth', 'eikra' ),
					'img'   => RDTHEME_IMG_URL . 'fullwidth.png',
				],
				'right-sidebar' => [
					'alt'   => esc_html__( 'Right Sidebar', 'eikra' ),
					'title' => esc_html__( 'Right Sidebar', 'eikra' ),
					'img'   => RDTHEME_IMG_URL . 'right-sidebar.png',
				],
			],
			'default' => 'right-sidebar',
		],

		[
			'id'       => $prefix . '_sidebar',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar', 'eikra' ),
			'options'  => RDTheme_Helper::custom_sidebar_fields(),
			'default'  => 'sidebar',
			'required' => [ $prefix . '_layout', '!=', 'full-width' ],
		],
		[
			'id'       => $prefix . '_padding_top',
			'type'     => 'text',
			'title'    => esc_html__( 'Content Padding Top', 'eikra' ),
			'validate' => 'numeric',
			'default'  => '100',
		],
		[
			'id'       => $prefix . '_padding_bottom',
			'type'     => 'text',
			'title'    => esc_html__( 'Content Padding Bottom', 'eikra' ),
			'validate' => 'numeric',
			'default'  => '100',
		],
		[
			'id'      => $prefix . '_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Banner', 'eikra' ),
			'on'      => esc_html__( 'Enabled', 'eikra' ),
			'off'     => esc_html__( 'Disabled', 'eikra' ),
			'default' => true,
		],
		[
			'id'       => $prefix . '_breadcrumb',
			'type'     => 'switch',
			'title'    => esc_html__( 'Breadcrumb', 'eikra' ),
			'on'       => esc_html__( 'Enabled', 'eikra' ),
			'off'      => esc_html__( 'Disabled', 'eikra' ),
			'default'  => true,
			'required' => [ $prefix . '_banner', 'equals', true ],
		],
		[
			'id'       => $prefix . '_bgtype',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Banner Background Type', 'eikra' ),
			'options'  => [
				'bgimg'   => esc_html__( 'Background Image', 'eikra' ),
				'bgcolor' => esc_html__( 'Background Color', 'eikra' ),
			],
			'default'  => 'bgimg',
			'required' => [ $prefix . '_banner', 'equals', true ],
		],
		[
			'id'       => $prefix . '_bgimg',
			'type'     => 'media',
			'title'    => esc_html__( 'Banner Background Image', 'eikra' ),
			'default'  => [
				'url' => RDTHEME_IMG_URL . 'banner.jpg',
			],
			'required' => [ $prefix . '_bgtype', 'equals', 'bgimg' ],
		],
		[
			'id'          => $prefix . '_bgcolor',
			'type'        => 'color',
			'title'       => esc_html__( 'Banner Background Color', 'eikra' ),
			'validate'    => 'color',
			'transparent' => false,
			'default'     => '#606060',
			'required'    => [ $prefix . '_bgtype', 'equals', 'bgcolor' ],
		],
	];
}

Redux::setSection( $opt_name,
	[
		'title' => esc_html__( 'Layout Defaults', 'eikra' ),
		'id'    => 'layout_defaults',
		'icon'  => 'el el-th',
	]
);

// Page
$rdtheme_page_fields               = rdtheme_redux_post_type_fields( 'page' );
$rdtheme_page_fields[0]['default'] = 'full-width';
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Page', 'eikra' ),
		'id'         => 'pages_section',
		'subsection' => true,
		'fields'     => $rdtheme_page_fields,
	]
);

//Post Archive
$rdtheme_post_archive_fields = rdtheme_redux_post_type_fields( 'blog' );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Blog / Archive', 'eikra' ),
		'id'         => 'blog_section',
		'subsection' => true,
		'fields'     => $rdtheme_post_archive_fields,
	]
);

// Single Post
$rdtheme_single_post_fields = rdtheme_redux_post_type_fields( 'single_post' );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Post Single', 'eikra' ),
		'id'         => 'single_post_section',
		'subsection' => true,
		'fields'     => $rdtheme_single_post_fields,
	]
);

// Course Archive
$rdtheme_course_field1 = [
	'id'      => 'course_style',
	'type'    => 'button_set',
	'title'   => esc_html__( 'Style', 'eikra' ),
	'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
	'options' => [
		'1' => esc_html__( 'Style 1', 'eikra' ),
		'2' => esc_html__( 'Style 2', 'eikra' ),
		'3' => esc_html__( 'Style 3', 'eikra' ),
		'4' => esc_html__( 'Style 4', 'eikra' ),
	],
	'default' => '1',
];
$rdtheme_course_fields = rdtheme_redux_post_type_fields( 'course_archive' );
// if ( RDTheme_Helper::is_LMS() ) {
// 	unset( $rdtheme_course_fields[1] );
// }
array_unshift( $rdtheme_course_fields, $rdtheme_course_field1 );

Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Course Archive', 'eikra' ),
		'id'         => 'course_archive_section',
		'subsection' => true,
		'fields'     => $rdtheme_course_fields,
	]
);

// Course Single
$rdtheme_single_course_fields = rdtheme_redux_post_type_fields( 'single_course' );
// if ( RDTheme_Helper::is_LMS() ) {
// 	unset( $rdtheme_single_course_fields[1] );
// }
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Single Course', 'eikra' ),
		'id'         => 'single_course_section',
		'subsection' => true,
		'fields'     => $rdtheme_single_course_fields,
	]
);

// Instructor Single
$rdtheme_single_instructor_fields = rdtheme_redux_post_type_fields( 'instructor' );
unset( $rdtheme_single_instructor_fields[0] );
unset( $rdtheme_single_instructor_fields[1] );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Single Instructor', 'eikra' ),
		'id'         => 'single_instructor_section',
		'subsection' => true,
		'fields'     => $rdtheme_single_instructor_fields,
	]
);

// Research Single
$rdtheme_research_fields = rdtheme_redux_post_type_fields( 'research' );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Single Research', 'eikra' ),
		'id'         => 'single_research_section',
		'subsection' => true,
		'fields'     => $rdtheme_research_fields,
	]
);

// Event Single
$event_fields = rdtheme_redux_post_type_fields( 'event' );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Single Event', 'eikra' ),
		'id'         => 'single_event_section',
		'subsection' => true,
		'fields'     => $event_fields,
	]
);

// Search
$rdtheme_search_fields = rdtheme_redux_post_type_fields( 'search' );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Search Layout', 'eikra' ),
		'id'         => 'search_section',
		'subsection' => true,
		'fields'     => $rdtheme_search_fields,
	]
);

// Error 404 Layout
$rdtheme_error_fields = rdtheme_redux_post_type_fields( 'error' );
unset( $rdtheme_error_fields[0] );
Redux::setSection( $opt_name,
	[
		'title'      => esc_html__( 'Error 404 Layout', 'eikra' ),
		'id'         => 'error_section',
		'subsection' => true,
		'fields'     => $rdtheme_error_fields,
	]
);

if ( class_exists( 'WooCommerce' ) ) {
	// Woocommerce Shop Archive
	$rdtheme_shop_archive_fields = rdtheme_redux_post_type_fields( 'shop' );
	Redux::setSection( $opt_name,
		[
			'title'      => esc_html__( 'Shop Archive', 'eikra' ),
			'id'         => 'shop_section',
			'subsection' => true,
			'fields'     => $rdtheme_shop_archive_fields,
		]
	);

	// Woocommerce Product
	$rdtheme_product_fields = rdtheme_redux_post_type_fields( 'product' );
	Redux::setSection( $opt_name,
		[
			'title'      => esc_html__( 'Product Single', 'eikra' ),
			'id'         => 'product_section',
			'subsection' => true,
			'fields'     => $rdtheme_product_fields,
		]
	);
}

// Blog Settings
Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Blog Settings', 'eikra' ),
		'id'      => 'blog_settings_section',
		'icon'    => 'el el-tags',
		'heading' => '',
		'fields'  => [
			[
				'id'      => 'blog_style',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Blog/Archive Layout', 'eikra' ),
				'default' => 'style1',
				'options' => [
					'style1' => [
						'title' => '<b>' . esc_html__( 'Layout 1', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'blog1.png',
					],
					'style2' => [
						'title' => '<b>' . esc_html__( 'Layout 2', 'eikra' ) . '</b>',
						'img'   => RDTHEME_IMG_URL . 'blog2.png',
					],
				],
			],
			[
				'id'      => 'blog_date',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Date', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'blog_author_name',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Author Name', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'blog_cats',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Categories', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'blog_comment_num',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Comment Number', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
		],
	]
);

// Post Settings
Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Post Settings', 'eikra' ),
		'id'      => 'post_settings_section',
		'icon'    => 'el el-file-edit',
		'heading' => '',
		'fields'  => [
			[
				'id'      => 'post_date',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Post Date', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'post_author_name',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Author Name', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'post_cats',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Categories', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'post_comment_num',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Comment Number', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'post_tags',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Tags', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
		],
	]
);

// Course Settings
Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Course Settings', 'eikra' ),
		'id'      => 'course_settings_section',
		'icon'    => 'el el-file-edit',
		'heading' => '',
		'fields'  => [
			[
				'id'       => 'course_price_hide',
				'type'     => 'switch',
				'class'    => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'    => esc_html__( 'Sitewide Hide Price', 'eikra' ),
				'on'       => esc_html__( 'Enabled', 'eikra' ),
				'off'      => esc_html__( 'Disabled', 'eikra' ),
				'default'  => false,
				'subtitle' => esc_html__( 'If enabled then hide prices from everywhere', 'eikra' ),
			],
			[
				'id'      => 'course_meta',
				'type'    => 'checkbox',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Information', 'eikra' ),
				'options' => [
					'ins' => esc_html__( 'Instructor', 'eikra' ),
					'lec' => esc_html__( 'Lectures', 'eikra' ),
					'qz'  => esc_html__( 'Quizzes', 'eikra' ),
					'stu' => esc_html__( 'Students', 'eikra' ),
					'dur' => esc_html__( 'Duration', 'eikra' ),
				],
				'default' => [
					'ins' => '1',
					'lec' => '1',
					'qz'  => '1',
					'stu' => '1',
					'dur' => '1',
				],
			],
			[
				'id'      => 'course_cats',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Categories', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_tags',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Tags', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_curriculum',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Curriculum Tab', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_instructor',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Instructor Tab', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_review',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Review Tab', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_related',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Related Courses', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_sidebar',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Sidebar', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],

			[
				'id'       => 'course_details_section',
				'type'     => 'section',
				'title'    => __( 'Course Details Sidebar Options', 'eikra' ),
				'subtitle' => __( 'These settings will apply for course details page.', 'eikra' ),
				'indent'   => false,
			],

			[
				'id'       => 'course_progress',
				'type'     => 'switch',
				'class'    => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'    => esc_html__( 'Show Progress Box', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'default'  => true,
				'subtitle' => esc_html__( 'Available for enrolled users', 'eikra' ),
			],
			[
				'id'      => 'course_price',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Price Box', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],
			[
				'id'      => 'course_rating',
				'type'    => 'switch',
				'class'   => RDTheme_Helper::is_LMS() ? '' : 'hide',
				'title'   => esc_html__( 'Show Rating Box', 'eikra' ),
				'on'      => esc_html__( 'On', 'eikra' ),
				'off'     => esc_html__( 'Off', 'eikra' ),
				'default' => true,
			],

			[
				'id'       => 'course_archive_section',
				'type'     => 'section',
				'title'    => __( 'Course Archive Options', 'eikra' ),
				'subtitle' => __( 'These settings will apply to all global courses.', 'eikra' ),
				'indent'   => false,
			],

			[
				'id'       => 'course_archive_cat_filter',
				'type'     => 'switch',
				'title'    => esc_html__( 'Category Filter Search', 'eikra' ),
				'on'       => esc_html__( 'Enable', 'eikra' ),
				'off'      => esc_html__( 'Disable', 'eikra' ),
				'subtitle' => __( 'You may enable or disable category search filter options from archive search ', 'eikra' ),
				'default'  => true,
			],

			[
				'id'       => 'course_archive_instructor_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Courses Instructor Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => __( 'You may show or hide course instructor for all global course.', 'eikra' ),
				'default'  => true,
			],

			[
				'id'       => 'course_archive_footer_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Courses Footer Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => __( 'You may show or hide course footer section from all global course. Include: ( Enroll count, Review, Wishlist )', 'eikra' ),
				'default'  => true,
			],

			[
				'id'     => 'course_archive_footer_section',
				'type'   => 'section',
				'indent' => true,
			],

			[
				'id'       => 'course_archive_wishlist_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Wishlist Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => esc_html__( 'You may show or hide course footer wishlist', 'eikra' ),
				'default'  => true,
				'required' => [ 'course_archive_footer_visibility', '=', true ],
			],

			[
				'id'       => 'course_archive_enroll_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enroll Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => esc_html__( 'You may show or hide course footer enroll', 'eikra' ),
				'default'  => true,
				'required' => [ 'course_archive_footer_visibility', '=', true ],
			],

			[
				'id'       => 'course_archive_review_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Review Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => esc_html__( 'You may show or hide course footer enroll', 'eikra' ),
				'default'  => true,
				'required' => [ 'course_archive_footer_visibility', '=', true ],
			],

			[
				'id'       => 'course_archive_price_visibility',
				'type'     => 'switch',
				'title'    => esc_html__( 'Price Visibility', 'eikra' ),
				'on'       => esc_html__( 'On', 'eikra' ),
				'off'      => esc_html__( 'Off', 'eikra' ),
				'subtitle' => esc_html__( 'You may show or hide course footer price', 'eikra' ),
				'default'  => true,
				'required' => [ 'course_archive_footer_visibility', '=', true ],
			],


		],
	]
);

// Error
$rdtheme_fields2 = [
	[
		'id'      => 'error_title',
		'type'    => 'text',
		'title'   => esc_html__( 'Page Title', 'eikra' ),
		'default' => esc_html__( 'Error 404', 'eikra' ),
	],
	[
		'id'          => 'error_bodybg',
		'type'        => 'color',
		'transparent' => false,
		'title'       => esc_html__( 'Body Background Color', 'eikra' ),
		'default'     => '#FDC800',
	],
	[
		'id'      => 'error_bodybanner',
		'type'    => 'media',
		'title'   => esc_html__( 'Body Banner', 'eikra' ),
		'default' => [
			'url' => RDTHEME_IMG_URL . '404.png',
		],
	],
	[
		'id'      => 'error_text1',
		'type'    => 'text',
		'title'   => esc_html__( 'Body Text 1', 'eikra' ),
		'default' => esc_html__( 'Page not Found', 'eikra' ),
	],
	[
		'id'      => 'error_text2',
		'type'    => 'text',
		'title'   => esc_html__( 'Body Text 2', 'eikra' ),
		'default' => esc_html__( 'The page you are looking is not available or has been removed. Try going to Home Page by using the button below.', 'eikra' ),
	],
	[
		'id'          => 'error_text1_color',
		'type'        => 'color',
		'transparent' => false,
		'title'       => esc_html__( 'Body Text 1 Color', 'eikra' ),
		'default'     => '#000000',
	],
	[
		'id'          => 'error_text2_color',
		'type'        => 'color',
		'transparent' => false,
		'title'       => esc_html__( 'Body Text 2 Color', 'eikra' ),
		'default'     => '#634e00',
	],
	[
		'id'      => 'error_buttontext',
		'type'    => 'text',
		'title'   => esc_html__( 'Button Text', 'eikra' ),
		'default' => esc_html__( 'Go to Home Page', 'eikra' ),
	],
];
Redux::setSection( $opt_name,
	[
		'title'   => esc_html__( 'Error Page Settings', 'eikra' ),
		'id'      => 'error_srttings_section',
		'heading' => '',
		'icon'    => 'el el-error-alt',
		'fields'  => $rdtheme_fields2,
	]
);

if ( class_exists( 'WooCommerce' ) ) {
	// Woocommerce Settings
	Redux::setSection( $opt_name,
		[
			'title'   => esc_html__( 'WooCommerce', 'eikra' ),
			'id'      => 'woo_Settings_section',
			'heading' => '',
			'icon'    => 'el el-shopping-cart',
			'fields'  => [
				[
					'id'     => 'wc_sec_general',
					'type'   => 'section',
					'title'  => esc_html__( 'General', 'eikra' ),
					'indent' => true,
				],
				[
					'id'      => 'wc_num_product',
					'type'    => 'text',
					'title'   => esc_html__( 'Number of Products Per Page', 'eikra' ),
					'default' => '9',
				],
				[
					'id'      => 'wc_wishlist_icon',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Add to Wishlist Icon', 'eikra' ),
					'on'      => esc_html__( 'Enabled', 'eikra' ),
					'off'     => esc_html__( 'Disabled', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_quickview_icon',
					'type'    => 'switch',
					'title'   => esc_html__( 'Product Quickview Icon', 'eikra' ),
					'on'      => esc_html__( 'Enabled', 'eikra' ),
					'off'     => esc_html__( 'Disabled', 'eikra' ),
					'default' => true,
				],
				[
					'id'     => 'wc_sec_product',
					'type'   => 'section',
					'title'  => esc_html__( 'Product Single Page', 'eikra' ),
					'indent' => true,
				],
				[
					'id'      => 'wc_show_excerpt',
					'type'    => 'switch',
					'title'   => esc_html__( "Show excerpt when short description doesn't exist", 'eikra' ),
					'on'      => esc_html__( 'Enabled', 'eikra' ),
					'off'     => esc_html__( 'Disabled', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_cats',
					'type'    => 'switch',
					'title'   => esc_html__( 'Categories', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_tags',
					'type'    => 'switch',
					'title'   => esc_html__( 'Tags', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_related',
					'type'    => 'switch',
					'title'   => esc_html__( 'Related Products', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_description',
					'type'    => 'switch',
					'title'   => esc_html__( 'Description Tab', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_reviews',
					'type'    => 'switch',
					'title'   => esc_html__( 'Reviews Tab', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'      => 'wc_additional_info',
					'type'    => 'switch',
					'title'   => esc_html__( 'Additional Information Tab', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
				[
					'id'     => 'wc_sec_cart',
					'type'   => 'section',
					'title'  => esc_html__( 'Cart Page', 'eikra' ),
					'indent' => true,
				],
				[
					'id'      => 'wc_cross_sell',
					'type'    => 'switch',
					'title'   => esc_html__( 'Cross Sell Products', 'eikra' ),
					'on'      => esc_html__( 'Show', 'eikra' ),
					'off'     => esc_html__( 'Hide', 'eikra' ),
					'default' => true,
				],
			],
		]
	);
}


// -> END Fields