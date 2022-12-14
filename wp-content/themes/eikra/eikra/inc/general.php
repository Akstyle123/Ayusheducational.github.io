<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.8
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

add_action( 'after_setup_theme', 'rdtheme_setup' );
if ( ! function_exists( 'rdtheme_setup' ) ) {
	function rdtheme_setup() {
		// Language
		load_theme_textdomain( 'eikra', RDTHEME_BASE_DIR . 'languages' );

		// Theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'wp-block-styles' );


		// Course ordering support
		add_post_type_support( 'lp_course', 'page-attributes' );

		// Image sizes
		add_image_size( 'rdtheme-size1', 1200, 600, true ); // Single page thumbnail
		add_image_size( 'rdtheme-size2', 410, 260, true );  // Blog 2, Course Box, Gallery 1, Research 2
		add_image_size( 'rdtheme-size3', 360, 260, true );  // Gallery Small, Research 3
		add_image_size( 'rdtheme-size6', 800, 725, true );  // Gallery Large
		add_image_size( 'rdtheme-size8', 92, 92, true );    // Testimonial
		add_image_size( 'rdtheme-size5', 150, 100, true );  // Post List

		add_image_size( 'rdtheme-size4', 80, 62, true );    // widget sidebar thumbnail 2

		if ( ! RDTheme_Helper::is_LMS() ) {
			add_image_size( 'rdtheme-size9', 360, 370, true );
		}

		// Register menus
		register_nav_menus( [
			'primary'  => esc_html__( 'Primary', 'eikra' ),
			'topright' => esc_html__( 'Header Right', 'eikra' ),
		] );
	}
}

// Register Sidebars
add_action( 'widgets_init', 'rdtheme_register_sidebars' );
if ( ! function_exists( 'rdtheme_register_sidebars' ) ) {
	function rdtheme_register_sidebars() {
		$footer_widget_titles = [
			'1' => esc_html__( 'Footer 1', 'eikra' ),
			'2' => esc_html__( 'Footer 2', 'eikra' ),
			'3' => esc_html__( 'Footer 3', 'eikra' ),
			'4' => esc_html__( 'Footer 4', 'eikra' ),
		];

		register_sidebar( [
			'name'          => esc_html__( 'Sidebar', 'eikra' ),
			'id'            => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s single-sidebar padding-bottom1">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => esc_html__( 'Top Bar 5 - Left', 'eikra' ),
			'id'            => 'top5-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="hidden">',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => esc_html__( 'Top Bar 5 - Right', 'eikra' ),
			'id'            => 'top5-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="hidden">',
			'after_title'   => '</h3>',
		] );

		for ( $i = 1; $i <= RDTheme::$options['footer_column']; $i ++ ) {
			register_sidebar( [
				'name'          => $footer_widget_titles[ $i ],
				'id'            => 'footer-' . $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			] );
		}

		register_sidebar( [
			'name'          => esc_html__( 'Footer Layout 2 Sidebar', 'eikra' ),
			'id'            => 'footer-layout-2',
			'before_widget' => '<div id="%1$s" class="widget col-lg-3 col-md-6 col-12 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
			'description'   => esc_html__( 'This widget has used for Footer layout 2 Sidebar. Please add ', 'eikra' ),
		] );

		register_sidebar( [
			'name'          => esc_html__( 'Sidebar - LearnPress Single Course', 'eikra' ),
			'id'            => 'sidebar-single-course',
			'before_widget' => '<div id="%1$s" class="widget %2$s single-sidebar padding-bottom1">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		] );
	}
}

// Pingback
add_action( 'wp_head', 'rdtheme_pingback' );
function rdtheme_pingback() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

// Add body class
add_filter( 'body_class', 'rdtheme_body_classes' );
if ( ! function_exists( 'rdtheme_body_classes' ) ) {
	function rdtheme_body_classes( $classes ) {

		$eikra_theme = wp_get_theme();
		$classes[]   = $eikra_theme->Name . '-version-' . $eikra_theme->Version;

		// Header
		$classes[] = 'header-style-' . RDTheme::$header_style;
		$classes[] = 'footer-style-' . RDTheme::$footer_style;

		if ( RDTheme::$top_bar == 1 || RDTheme::$top_bar == 'on' ) {
			$classes[] = 'has-topbar topbar-style-' . RDTheme::$top_bar_style;
		}

		if ( RDTheme::$tr_header == 1 || RDTheme::$tr_header == 'on' ) {
			$classes[] = 'trheader';
		}

		// Sidebar
		$classes[] = ( RDTheme::$layout == 'full-width' ) ? 'no-sidebar' : 'has-sidebar';

		// LearnPress
		if ( isset( $_COOKIE["lpcourseview"] ) && $_COOKIE["lpcourseview"] == 'list' ) {
			$classes[] = 'rt-course-list-view';
		} else {
			$classes[] = 'rt-course-grid-view';
		}
		if ( function_exists( 'learn_press_is_courses' ) ) {
			if ( learn_press_is_courses() ) {
				$classes[] = 'rt-lp-grey-bg';
			}
		}

		if ( is_singular( 'lp_course' ) && RDTheme_Helper::is_LMS() ) {
			$classes[] = "rt-single-course-layout-" . RDTheme::$layout;
		}

		// WooCommerce
		if ( isset( $_COOKIE["shopview"] ) && $_COOKIE["shopview"] == 'list' ) {
			$classes[] = 'product-list-view';
		} else {
			$classes[] = 'product-grid-view';
		}

		return $classes;
	}
}

// Footer Html
add_action( 'wp_footer', 'rdtheme_footer_html', 1 );
if ( ! function_exists( 'rdtheme_footer_html' ) ) {
	function rdtheme_footer_html() {
		// Back-to-top link
		if ( RDTheme::$options['back_to_top'] ) {
			echo '<a href="#" class="scrollToTop"><i class="fas fa-arrow-up"></i></a>';
		}
	}
}

// Course archive post per page limit(non-lms)
add_action( 'pre_get_posts', 'rdtheme_course_item_per_page' );
if ( ! function_exists( 'rdtheme_course_item_per_page' ) ) {
	function rdtheme_course_item_per_page( $query ) {
		if ( is_admin() || ! $query->is_main_query() || RDTheme_Helper::is_LMS() ) {
			return;
		}

		if ( is_post_type_archive( 'lp_course' ) ) {
			$query->set( 'posts_per_page', apply_filters( 'course_per_page', 9 ) );

			return;
		}
	}
}

/*---------------------------------------------------------
#. Learnpress Template file
-----------------------------------------------------------*/
add_filter( 'learn_press_template_path', 'rdtheme_lp_template_path', 999 );
function rdtheme_lp_template_path( $template ) {
	if ( RDTheme_Helper::lp_is_v2() ) {
		return 'learnpress-v2';
	}

	return $template;
}

/*---------------------------------------------------------
#. Login/Registration Handling - LP and TML integration
-----------------------------------------------------------*/
if ( RDTheme_Helper::is_LMS() && class_exists( 'Theme_My_Login' ) ) {
	add_filter( 'login_redirect', 'rdtheme_lp_login_redirect', 20, 3 ); // After login, redirect to lp-profile page

	// TML new version compatibility
	if ( defined( 'THEME_MY_LOGIN_VERSION' ) ) {
		add_filter( 'template_include', 'rdtheme_lp_to_tml_redirect', 25 ); // Redirection handling
	} // TML old version compatibility
	else {
		add_filter( 'template_include', 'rdtheme_lp_to_tml_redirect_old_v', 20, 3 ); // Redirection handling
		add_filter( 'tml_action_template_message', 'rdtheme_tml_register_msg_old_v', 10, 2 ); // Hide tml register title msg
	}
}


function rdtheme_lp_login_redirect( $redirect_to, $request, $user ) {
	if ( $redirect_to == admin_url() ) {
		$redirect_to = learn_press_get_page_link( 'profile' );
	}

	return $redirect_to;
}

function rdtheme_lp_to_tml_redirect( $template ) {
	// For logged in user, redirect to lp-profile page
	if ( is_user_logged_in() && tml_is_action() ) {
		wp_redirect( learn_press_get_page_link( 'profile' ) );
		die();
	} // For guest, load tml-login page instead of lp-profile
	elseif ( learn_press_is_profile() && ! is_user_logged_in() ) {
		$profile = LP_Profile::instance();
		// check if own or other's profile page
		if ( $profile->is_guest() ) {
			$login_page = tml_get_action_url( 'login' );
			wp_redirect( $login_page );
			die();
		}
	}

	return $template;
}

function rdtheme_lp_to_tml_redirect_old_v( $template ) {
	// For logged in user, redirect to lp-profile page
	if ( is_user_logged_in() && Theme_My_Login::is_tml_page() ) {
		wp_redirect( learn_press_get_page_link( 'profile' ) );
		die();
	} // For guest, load tml-login page instead of lp-profile
	elseif ( learn_press_is_profile() && ! is_user_logged_in() ) {
		$profile = LP_Profile::instance();
		// check if own or other's profile page
		if ( $profile->is_guest() ) {
			$redirect = '';
			if ( ! empty( $_REQUEST['redirect_to'] ) ) {
				$redirect = $_REQUEST['redirect_to'];
			}

			$login_page_id     = Theme_My_Login::get_page_id( 'login' );
			$login_page_status = get_post_status( $login_page_id );

			// check if login page isn't in trash by user's mistake
			if ( $login_page_status == 'publish' ) {
				wp_redirect( wp_login_url( $redirect ) );
				die();
			}
		}
	}

	return $template;
}

function rdtheme_tml_register_msg_old_v( $message, $action ) {
	if ( $action == 'register' ) {
		$message = '';
	}

	return $message;
}

/*---------------------------------------------------------
#. LayerSlider and YITH compatibility fix
-----------------------------------------------------------*/
add_action( 'current_screen', 'rdtheme_remove_yith_script_from_ls' );
function rdtheme_remove_yith_script_from_ls() {
	if ( ! is_admin() ) {
		return;
	}

	if ( ! class_exists( 'YIT_Assets' ) ) {
		return;
	}

	$ls_screens = [
		'toplevel_page_layerslider',
		'layerslider-wp_page_layerslider-options',
		'layerslider-wp_page_layerslider-addons',
	];

	$current_screen = get_current_screen();

	if ( in_array( $current_screen->id, $ls_screens ) ) {
		remove_action( 'admin_enqueue_scripts', [ YIT_Assets::instance(), 'register_styles_and_scripts' ] );
		remove_action( 'admin_notices', 'yith_plugin_fw_promo_notices', 15 );
	}
}


/*---------------------------------------------------------
#. Event date migration
-----------------------------------------------------------*/

add_action( 'save_post', 'rt_save_metaboxes', 9999 );

function rt_save_metaboxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return $post_id;
	}
	if ( get_post_type( $post_id ) != 'ac_event' ) {
		return $post_id;
	}
	$start_date = get_post_meta( $post_id, 'ac_event_start_date', true );
	$end_date   = get_post_meta( $post_id, 'ac_event_end_date', true );
	if ( $start_date ) {
		update_post_meta( $post_id, 'rt_event_start_date', date( 'Ymd', strtotime( $start_date ) ) );
	}
	if ( $end_date ) {
		update_post_meta( $post_id, 'rt_event_end_date', date( 'Ymd', strtotime( $start_date ) ) );
	}
}

$is_migrate = get_option( 'is_rt_event_date_migrated', 'no' );
if ( 'no' == $is_migrate ) {
	add_action( 'template_redirect', 'rt_event_data_migration' );
}

function rt_event_data_migration() {
	$args      = [
		'post_type'      => 'ac_event',
		'posts_per_page' => - 1,
		'post_status'    => 'any',
	];
	$the_query = new WP_Query( $args );

	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$post_id    = get_the_ID();
		$start_date = get_post_meta( $post_id, 'ac_event_start_date', true );
		$end_date   = get_post_meta( $post_id, 'ac_event_end_date', true );

		if ( $start_date ) {
			update_post_meta( $post_id, 'rt_event_start_date', date( 'Ymd', strtotime( $start_date ) ) );
		}
		if ( $end_date ) {
			update_post_meta( $post_id, 'rt_event_end_date', date( 'Ymd', strtotime( $end_date ) ) );
		}

	endwhile;
	update_option( 'is_rt_event_date_migrated', 'yes' );
}

//LearnPress tab translation issues::
add_filter( 'learn-press/course-tabs', function ( $tabs ) {
	$course                      = learn_press_get_course();
	$tabs['overview']['title']   = esc_html__( 'Overview', 'eikra' );
	$tabs['curriculum']['title'] = esc_html__( 'Curriculum', 'eikra' );
	$tabs['instructor']['title'] = esc_html__( 'Instructor', 'eikra' );
	if ( $course->get_faqs() ) {
		$tabs['faqs']['title'] = esc_html__( 'FAQs', 'eikra' );
	}
	if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) {
		$tabs['reviews']['title'] = esc_html__( 'Reviews', 'eikra' );
	}

	return $tabs;

} );

//Elementor Header Footer Support
//==============================================

if ( ! function_exists( 'eikra_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function eikra_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'eikra_register_elementor_locations' );
		if ( apply_filters( 'eikra_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'eikra_register_elementor_locations' );