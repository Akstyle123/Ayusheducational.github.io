<?php
/**
 * @author  RadiusTheme
 * @since   2.1
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Eikra_Core_Demo_Importer_OCDI {

	public function __construct() {
		add_filter( 'pt-ocdi/import_files', array( $this, 'demo_config' ) );
		add_filter( 'pt-ocdi/after_import', array( $this, 'after_import' ) );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
        add_filter( 'pt-ocdi/plugin_intro_text', array($this, 'eikra_one_click_importer_notice') );
	}

	public function demo_config() {

		$demos_array = array(
			'demo1' => array(
				'title' => __( 'Home 1 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 1', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo2' => array(
				'title' => __( 'Home 2 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 2', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo3' => array(
				'title' => __( 'Home 3 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 3', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo4' => array(
				'title' => __( 'Home 4 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 4', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo5' => array(
				'title' => __( 'Home 5 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 5', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo6' => array(
				'title' => __( 'Home 6 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 6', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo13' => array(
				'title' => __( 'Home 7 (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 7', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo7' => array(
				'title' => __( 'Home 1 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 1 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-1-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo8' => array(
				'title' => __( 'Home 2 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 2 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo9' => array(
				'title' => __( 'Home 3 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 3 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo10' => array(
				'title' => __( 'Home 4 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 4 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo11' => array(
				'title' => __( 'Home 5 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 5 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo12' => array(
				'title' => __( 'Home 6 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 6 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
			'demo14' => array(
				'title' => __( 'Home 7 Onepage (WPBakery)', 'eikra-core' ),
				'page'  => __( 'Home 7 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7-onepage/',
                'categories'    	=> 'WPBakery Page Builder',
			),
            'demo21' => array(
                'title' => __( 'Home 1 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 1', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo22' => array(
                'title' => __( 'Home 2 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 2', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-2/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo23' => array(
                'title' => __( 'Home 3 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 3', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-3/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo24' => array(
                'title' => __( 'Home 4 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 4', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-4/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo25' => array(
                'title' => __( 'Home 5 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 5', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-5/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo26' => array(
                'title' => __( 'Home 6 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 6', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-6/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo27' => array(
                'title' => __( 'Home 7 (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 7', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-7/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo28' => array(
                'title' => __( 'Home 1 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 1 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-1-onepage',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo29' => array(
                'title' => __( 'Home 2 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 2 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-2-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo30' => array(
                'title' => __( 'Home 3 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 3 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-3-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo31' => array(
                'title' => __( 'Home 4 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 4 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-4-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo32' => array(
                'title' => __( 'Home 5 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 5 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-5-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo33' => array(
                'title' => __( 'Home 6 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 6 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-6-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
            'demo34' => array(
                'title' => __( 'Home 7 Onepage (Elementor)', 'eikra-core' ),
                'page'  => __( 'Home 7 (Onepage)', 'eikra-core' ),
                'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
                'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra-elementor/home-7-onepage/',
                'categories'    	=> 'Elementor Page Builder',
            ),
		);

		$config = array();
		$vc_path  = trailingslashit( get_template_directory() ) . 'sample-data/visualcomposer/';
		$elementor_path  = trailingslashit( get_template_directory() ) . 'sample-data/elementor/';
		$redux_option = 'eikra';

		foreach ( $demos_array as $key => $demo ) {
		    $path = ( $demo['categories'] == 'Elementor Page Builder' ) ? $elementor_path : $vc_path;
			$config[] = array(
				'import_file_id'               => $key,
                'categories'                   => array($demo['categories']),
				'import_page_name'             => $demo['page'],
				'import_file_name'             => $demo['title'],
				'local_import_file'            => $path . 'contents.xml',
				'local_import_widget_file'     => $path . 'widgets.wie',
				'local_import_customizer_file' => $path . 'customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => $path . 'options.json',
						'option_name' => $redux_option,
					),
				),
				'import_preview_image_url'   => $demo['screenshot'],
				'preview_url'                => $demo['preview_link'],
			);
		}

		return $config;
	}

	public function after_import( $selected_import ) {
		$this->assign_menu( $selected_import['import_file_id'] );
		$this->assign_frontpage( $selected_import );
		$this->update_contact_form_email();
		$this->update_bcn_options();
	}

	private function assign_menu( $demo ) {
		if ( $demo == 'demo7' or $demo == 'demo28' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 1', 'nav_menu' );
		}
		elseif( $demo == 'demo8' or $demo == 'demo29' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 2', 'nav_menu' );
		}
		elseif( $demo == 'demo9' or $demo == 'demo30' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 3', 'nav_menu' );
		}
		elseif( $demo == 'demo10' or $demo == 'demo31' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 4', 'nav_menu' );
		}
		elseif( $demo == 'demo11' or $demo == 'demo32' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 5', 'nav_menu' );
		}
		elseif( $demo == 'demo12' or $demo == 'demo33' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 6', 'nav_menu' );
		}
		elseif( $demo == 'demo14' or $demo == 'demo34' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 7', 'nav_menu' );
		}
		else {
			$primary  = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		}

		$topright = get_term_by( 'name', 'Featured Links', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'primary'  => $primary->term_id,
			'topright' => $topright->term_id,
		));
	}

	private function assign_frontpage( $selected_import ) {
		$blog_page  = get_page_by_title( 'News' );
		$front_page = get_page_by_title( $selected_import['import_page_name'] );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front',  $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );
	}

	private function update_contact_form_email() {
		$form1 = get_page_by_title( 'Contact', OBJECT, 'wpcf7_contact_form' );
		$form2 = get_page_by_title( 'Request a Quote', OBJECT, 'wpcf7_contact_form' );

		$forms = array( $form1, $form2 );
		foreach ( $forms as $form ) {
			if ( !$form ) {
				continue;
			}
			$cf7id = $form->ID;
			$mail  = get_post_meta( $cf7id, '_mail', true );
			$mail['recipient'] = get_option( 'admin_email' );
			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			update_post_meta( $cf7id, '_mail', $mail );		
		}
	}

	private function update_bcn_options() {
		$options = get_option( 'bcn_options' );

		$shop     = get_page_by_title( 'Shop' );
		$course   = get_page_by_title( 'Courses' );
		$research = get_page_by_title( 'Research' );
		$event    = get_page_by_title( 'Events' );

		if ( $shop ) {
			$options['apost_product_root'] = $shop->ID;
		}

		if ( $course ) {
			$options['apost_lp_course_root'] = $course->ID;
		}

		if ( $research ) {
			$options['apost_ac_research_root'] = $research->ID;
		}

		if ( $event ) {
			$options['apost_ac_event_root'] = $event->ID;
		}

		update_option( 'bcn_options', $options );
	}

    function eikra_one_click_importer_notice( $html ) {
        $html .= '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
        $html .= __( 'Import your desired demo contents between WPBakery and Elementor page builder. Please, install and activate plugin before import demo.', 'eikra-core');
        $html .= '</div>';
        return $html;
    }

}

new Eikra_Core_Demo_Importer_OCDI;