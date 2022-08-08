<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered',     array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		add_action( 'elementor/editor/after_enqueue_styles',    array( $this, 'editor_style' ) );
	}

	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom{content: url('.$img.');width: 28px;}' );
        wp_add_inline_style( 'elementor-editor', '.elementor-panel .select2-container {min-width: 100px !important; min-height: 30px !important;}' );
	}

	public function init() {
		require_once __DIR__ . '/base.php';

		// Widgets -- dirname=>classname /@dev
		$widgets = array(
			'title'             => 'Title',
			'info-box'          => 'Info_Box',
			'testimonial'       => 'Testimonial',
			'blog-post'         => 'Blog_Post',
			'pricing-box'       => 'Pricing_Box',
			'counter'           => 'Counter',
			'countdown'         => 'Countdown',
			'logo-slider'       => 'Logo_Slider',
			'cta'               => 'CTA',
			'image-text-box'    => 'Image_Text_Box',
			'video'             => 'Video',
			'contact'           => 'Contact_Info',
            'gallery'           => 'Campus_Gallery',
            'research'          => 'Research',
            'event'             => 'Event',
            'event-countdown'   => 'Event_Countdown',
            'text-with-title'   => 'Text_With_Title',
            'text-with-button'  => 'Text_With_Button',
		);

        if ( class_exists( 'LearnPress' ) ) {
            $widgets += array(
                'course-grid'       => 'Course_Grid',
                'course-slider'     => 'Course_Slider',
                'course-isotope'    => 'Course_Isotope',
                'course-featured'   => 'Course_Featured',
                'course-search'     => 'Course_Search',
                'instructor-slider' => 'Instructor_Slider',
                'instructor-grid'   => 'Instructor_Grid',
            );
        }

        if ( class_exists( 'WooCommerce' ) ) {
            $widgets += array(
                'product-slider'    => 'Product_Slider',
            );
        }

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;
			
			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname );
		}
}

	public function widget_categoty( $class ) {
		$id         = EIKRA_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = array(
			'title' => __( 'RadiusTheme Elements', 'eikra-core' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
}

new Custom_Widget_Init();