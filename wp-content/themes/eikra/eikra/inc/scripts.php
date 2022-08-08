<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.8
 */

use Elementor\Plugin;

add_action( 'wp_enqueue_scripts', 'rdtheme_register_scripts', 12 );
if ( ! function_exists( 'rdtheme_register_scripts' ) ) {
	function rdtheme_register_scripts() {
		/* Deregister */
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'yith-wcwl-font-awesome' );

		/* CSS */
		// Owl carousel
		wp_register_style( 'owl-carousel', RDTHEME_CSS_URL . 'owl.carousel.min.css', [], EIKRA_VERSION );
		wp_register_style( 'owl-theme-default', RDTHEME_CSS_URL . 'owl.theme.default.min.css', [], EIKRA_VERSION );
		// magnific popup
		wp_register_style( 'magnific-popup', RDTheme_Helper::maybe_rtl( 'magnific-popup.min.css' ), [], EIKRA_VERSION );

		/* JS */
		// owl.carousel.min
		wp_register_script( 'owl-carousel', RDTHEME_JS_URL . 'owl.carousel.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// Countdown
		wp_register_script( 'js-countdown', RDTHEME_JS_URL . 'jquery.countdown.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// magnific popup
		wp_register_script( 'magnific-popup', RDTHEME_JS_URL . 'jquery.magnific-popup.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// counterup
		wp_register_script( 'waypoints', RDTHEME_JS_URL . 'waypoints.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		wp_register_script( 'counterup', RDTHEME_JS_URL . 'jquery.counterup.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// isotope
		wp_register_script( 'isotope-pkgd', RDTHEME_JS_URL . 'isotope.pkgd.min.js', [ 'jquery' ], EIKRA_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'rdtheme_enqueue_scripts', 15 );
if ( ! function_exists( 'rdtheme_enqueue_scripts' ) ) {
	function rdtheme_enqueue_scripts() {
		/*CSS*/
		// Google fonts
		wp_enqueue_style( 'eikra-gfonts', RDTheme_Helper::fonts_url(), [], EIKRA_VERSION );
		// Bootstrap
		wp_enqueue_style( 'bootstrap', RDTheme_Helper::maybe_rtl( 'bootstrap.min.css' ), [], EIKRA_VERSION );
		// Font-awesome
		wp_enqueue_style( 'font-awesome', RDTHEME_CSS_URL . 'font-awesome.min.css', [], EIKRA_VERSION );
		// Defaults
		wp_enqueue_style( 'eikra-default', RDTheme_Helper::maybe_rtl( 'default.css' ), [], EIKRA_VERSION );
		// Style
		wp_enqueue_style( 'eikra-style', RDTheme_Helper::maybe_rtl( 'style.css' ), [], EIKRA_VERSION );
		// Template Style
		wp_add_inline_style( 'eikra-style', rdtheme_template_style() );
		// Elementor
		elementor_scripts();
		// LearnPress
		rdtheme_lp_scripts();
		// VC modules
		wp_enqueue_style( 'eikra-vc', RDTheme_Helper::maybe_rtl( 'vc.css' ), [], EIKRA_VERSION );

		/*JS*/
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		// bootstrap js
		wp_enqueue_script( 'bootstrap', RDTHEME_JS_URL . 'bootstrap.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// Nav smooth scroll
		wp_enqueue_script( 'jquery-nav', RDTHEME_JS_URL . 'jquery.nav.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// Cookie js
		wp_enqueue_script( 'js-cookie', RDTHEME_JS_URL . 'js.cookie.min.js', [ 'jquery' ], EIKRA_VERSION, true );
		// Main js
		wp_enqueue_script( 'eikra-main', RDTHEME_JS_URL . 'main.js', [ 'jquery' ], EIKRA_VERSION, true );

		// Single event Countdown
		if ( is_singular( 'ac_event' ) ) {
			wp_enqueue_script( 'js-countdown' );
		}

		// Localization
		$vc_rtl = 'no';
		if ( defined( 'WPB_VC_VERSION' ) && is_rtl() ) {
			$vc_rtl = version_compare( WPB_VC_VERSION, '5.0', '<' ) ? 'yes' : 'no';
		}

		$rdtheme_localize_data = [
			'ajaxurl'           => admin_url( 'admin-ajax.php' ),
			'hasAdminBar'       => is_admin_bar_showing() ? 1 : 0,
			'headerStyle'       => RDTheme::$header_style,
			'stickyMenu'        => RDTheme::$options['sticky_menu'],
			'primaryColor'      => RDTheme::$options['primary_color'],
			'seconderyColor'    => RDTheme::$options['secondery_color'],
			'day'               => esc_html__( 'Day', 'eikra' ),
			'hour'              => esc_html__( 'Hour', 'eikra' ),
			'minute'            => esc_html__( 'Minute', 'eikra' ),
			'second'            => esc_html__( 'Second', 'eikra' ),
			'extraOffset'       => RDTheme::$options['sticky_menu'] ? 70 : 0,
			'extraOffsetMobile' => RDTheme::$options['sticky_menu'] ? 52 : 0,
			'rtl'               => is_rtl() ? 'yes' : 'no', //@rtl
			'vcRtl'             => $vc_rtl, //@rtl
		];

		wp_localize_script( 'eikra-main', 'EikraObj', $rdtheme_localize_data );
	}
}

add_action( 'wp_enqueue_scripts', 'rdtheme_high_priority_scripts', 1500 );
if ( ! function_exists( 'rdtheme_high_priority_scripts' ) ) {
	function rdtheme_high_priority_scripts() {
		// LearnPress
		wp_enqueue_style( 'eikra-learnpress', RDTheme_Helper::maybe_rtl( 'learnpress.css' ), [], EIKRA_VERSION );

		// RTL
		if ( is_rtl() ) {
			wp_enqueue_style( 'eikra-rtl', RDTHEME_CSS_URL . 'rtl.css', [], EIKRA_VERSION );
		}

		// Dynamic style
		ob_start();
		RDTheme_Helper::includes( 'dynamic-style.php' );
		RDTheme_Helper::includes( 'dynamic-style-vc.php' );

		if ( RDTheme_Helper::is_LMS() ) {
			RDTheme_Helper::includes( 'dynamic-style-lp.php' );
		}

		$dynamic_css = ob_get_clean();
		$dynamic_css = RDTheme_Helper::minified_css( $dynamic_css );
		wp_register_style( 'eikra-dynamic', false );
		wp_enqueue_style( 'eikra-dynamic' );
		wp_add_inline_style( 'eikra-dynamic', $dynamic_css );
	}
}

// Head Script
add_action( 'wp_head', 'rdtheme_head', 1 );
if ( ! function_exists( 'rdtheme_head' ) ) {
	function rdtheme_head() {
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}
}

// Admin Scripts
add_action( 'admin_enqueue_scripts', 'eikra_admin_scripts', 12 );
function eikra_admin_scripts() {
	wp_enqueue_style( 'eikra-admin', RDTHEME_CSS_URL . 'admin.css', [], EIKRA_VERSION );
}

// Gutenberg
add_action( 'enqueue_block_editor_assets', 'eikra_gutenberg_scripts' );
function eikra_gutenberg_scripts() {
	wp_enqueue_style( 'eikra-gfonts', RDTheme_Helper::fonts_url(), [], EIKRA_VERSION );
	wp_enqueue_style( 'eikra-gutenberg', RDTheme_Helper::maybe_rtl( 'gutenberg.css' ), [], EIKRA_VERSION );
	ob_start();
	include RDTHEME_INC_DIR . 'dynamic-style-gutenberg.php';
	$dynamic_css = ob_get_clean();
	$css         = eikra_add_prefix_to_css( $dynamic_css, '.wp-block.editor-block-list__block' );
	$css         = str_replace( 'gtnbg_root', '', $css );
	wp_add_inline_style( 'eikra-gutenberg', $css );
}

function eikra_add_prefix_to_css( $css, $prefix ) {
	$parts = explode( '}', $css );
	foreach ( $parts as &$part ) {
		if ( empty( $part ) ) {
			continue;
		}

		$firstPart = substr( $part, 0, strpos( $part, '{' ) + 1 );
		$lastPart  = substr( $part, strpos( $part, '{' ) + 2 );
		$subParts  = explode( ',', $firstPart );
		foreach ( $subParts as &$subPart ) {
			$subPart = str_replace( "\n", '', $subPart );
			$subPart = $prefix . ' ' . trim( $subPart );
		}

		$part = implode( ', ', $subParts ) . $lastPart;
	}

	$prefixedCSS = implode( "}\n", $parts );

	return $prefixedCSS;
}

function rdtheme_template_style() {
	ob_start();
	?>
    .entry-banner {
	<?php if ( RDTheme::$bgtype == 'bgcolor' ): ?>
        background-color: <?php echo esc_html( RDTheme::$bgcolor ); ?>;
	<?php else: ?>
        background: url(<?php echo esc_url( RDTheme::$bgimg ); ?>) no-repeat scroll center center / cover;
	<?php endif; ?>
    }
    .content-area {
    padding-top: <?php echo esc_html( RDTheme::$padding_top ); ?>px;
    padding-bottom: <?php echo esc_html( RDTheme::$padding_bottom ); ?>px;
    }
	<?php
	if ( RDTheme_Helper::is_LMS() ) {
		if ( ! empty( RDTheme::$options['preloader_image']['url'] ) ) {
			$preloader_img = RDTheme::$options['preloader_image']['url'];
		} else {
			$preloader_img = RDTHEME_IMG_URL . 'preloader.gif';
		}
		?>
        #learn-press-block-content span {
        background-image: url("<?php echo esc_html( $preloader_img ); ?>");
        }
		<?php
	}

	// Hide price
	if ( RDTheme::$options['course_price_hide'] ) {
		?>
        .rt-course-box .rtin-thumbnail .rtin-price,
        .rt-course-box-2 .rtin-meta .rtin-price,
        .rt-course-box-3 .rtin-thumbnail .rtin-price {
        display: none;
        }
		<?php
	}

	return ob_get_clean();
}

function rdtheme_lp_scripts() {
	if ( ! class_exists( 'LearnPress' ) ) {
		return;
	}

	// Review addon
	if ( class_exists( 'LP_Addon_Course_Review' ) && defined( 'LP_ADDON_COURSE_REVIEW_URL' ) ) {
		wp_register_style( 'course-review', LP_ADDON_COURSE_REVIEW_URL . '/assets/css/course-review.css' );
	}

	if ( learn_press_is_course_archive() || learn_press_is_profile() ) {
		wp_enqueue_style( 'course-review' );
		wp_enqueue_style( 'dashicons' );
	}
}


// Profile page compatibility fix with WC Yith Quickview plugin
add_action( 'wp_footer', 'rdtheme_lp_profile_yith_quickview_bugfix' );
function rdtheme_lp_profile_yith_quickview_bugfix() {
	if ( ! class_exists( 'LearnPress' ) ) {
		return;
	}
	if ( learn_press_is_profile() ) {
		wp_dequeue_script( 'wc-single-product' );
	}
}

function elementor_scripts() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}
	if ( Plugin::$instance->preview->is_preview_mode() ) {
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'owl-theme-default' );
		wp_enqueue_style( 'course-review' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'magnific-popup' );

		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_script( 'isotope-pkgd' );
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'counterup' );
		wp_enqueue_script( 'js-countdown' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'isotope-pkgd' );
	}
}