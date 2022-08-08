<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Course_Isotope extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Course Isotope', 'eikra-core' );
		$this->rt_base = 'rt-course-isotope';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts() {
		wp_enqueue_style( 'course-review' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_script( 'isotope-pkgd' );
	}

	public function render_query( $query, $clsss, $style ) {
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ' . $clsss . '">';
				if ( RDTheme_Helper::is_LMS() ) {
					if ( $style != 1 ) {
						learn_press_get_template( "custom/course-box-{$style}.php" );
					} else {
						learn_press_get_template( 'custom/course-box.php' );
					}
				} else {
					get_template_part( 'template-parts/content', 'course-box' );
				}
				echo '</div>';
			}
		}
		wp_reset_query();
	}

	public function rt_fields() {
		$fields = [
			[
				'mode'  => 'section_start',
				'id'    => 'section_general',
				'label' => __( 'General', 'eikra-core' ),
			],
			[
				'id'      => 'style',
				'label'   => __( 'Navigation Style', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'style1' => __( 'Style 1 (Category Navigation)', 'eikra-core' ),
					'style2' => __( 'Style 2', 'eikra-core' ),
				],
				'default' => 'style1',
			],
			[
				'id'      => 'box_style',
				'label'   => __( 'Style', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => __( 'Style 1', 'eikra-core' ),
					'2' => __( 'Style 2', 'eikra-core' ),
					'3' => __( 'Style 3', 'eikra-core' ),
				],
				'default' => '1',
			],
			[
				'id'          => 'limit',
				'label'       => __( 'Course Limit', 'eikra-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '8',
				'description' => __( 'Enter course limit for each tab', 'eikra-core' ),
			],
			[
				'id'          => 'category',
				'label'       => __( 'Choose Category', 'eikra-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->rt_get_taxonomy( 'course_category' ),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [ 'style' => [ 'style1' ] ],
			],
			[
				'type'      => Controls_Manager::SWITCHER,
				'id'        => 'button_all_display',
				'label'     => esc_html__( 'Show All Tab', 'eikra-core' ),
				'label_on'  => esc_html__( 'On', 'eikra-core' ),
				'label_off' => esc_html__( 'Off', 'eikra-core' ),
				'default'   => 'yes',
				'condition' => [ 'style' => [ 'style1' ] ],
			],

			[
				'type'      => Controls_Manager::SWITCHER,
				'id'        => 'button_display',
				'label'     => esc_html__( 'Button Visibility', 'eikra-core' ),
				'label_on'  => esc_html__( 'On', 'eikra-core' ),
				'label_off' => esc_html__( 'Off', 'eikra-core' ),
				'default'   => 'yes',
				'condition' => [ 'style' => [ 'style2' ] ],
			],


			[
				'mode' => 'section_end',
			],

			// Style Tab

			[
				'mode'  => 'section_start',
				'id'    => 'sec_general_style',
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'General', 'eikra-core' ),
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => esc_html__( 'Title Style', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-content .rtin-title',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'content_typo',
				'label'    => esc_html__( 'Content Style', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-content .rtin-description',

				'condition' => [ 'style' => [ '1', '2', '3' ] ],
			],
			[
				'mode'      => 'group',
				'type'      => Group_Control_Typography::get_type(),
				'id'        => 'price_typo',
				'label'     => esc_html__( 'Price Style', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-thumbnail .rtin-price',
					'{{WRAPPER}} .rtin-meta .rtin-price ins',
				],

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'author_typo',
				'label'    => esc_html__( 'Author Style', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-author',

			],
			[
				'mode' => 'section_end',
			],

			[
				'mode'  => 'section_start',
				'id'    => 'sec_style',
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'Color', 'eikra-core' ),
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_color',
				'label'     => __( 'Title Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_hover_color',
				'label'     => __( 'Title Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'author_icon_color',
				'label'     => __( 'Author Icon Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-author i' => 'color: {{VALUE}}',
				],
				'condition' => [ 'box_style' => [ '1' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'author_text_color',
				'label'     => __( 'Author Text Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-author a' => 'color: {{VALUE}}',
				],
				'condition' => [ 'box_style' => [ '1', '2' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'content_color',
				'label'     => __( 'Content Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-description' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'price_text_color',
				'label'     => __( 'Price Text Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-meta .rtin-price ins'  => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'price_bg_color',
				'label'     => __( 'Price Background Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'background: {{VALUE}}',
					'{{WRAPPER}} .rtin-meta .rtin-price ins'  => 'background: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'rating_color',
				'label'     => __( 'Rating Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .review-stars-rated .review-stars.filled' => 'color: {{VALUE}}',
					'{{WRAPPER}}  .review-stars-rated .review-stars.empty'  => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'others_icon_color',
				'label'     => __( 'Others Icon Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .rtin-meta .rtin-enrolled'                => 'color: {{VALUE}}',
					'{{WRAPPER}}  .rtin-meta span'                          => 'color: {{VALUE}}',
					'{{WRAPPER}}  .rtin-meta i'                             => 'color: {{VALUE}}',
					'{{WRAPPER}}  .rtin-meta .rt-wishlist-icon span:before' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'navigation_bg',
				'label'     => __( 'Navigation Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .entry-content .isotop-btn a' => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'arrow_color',
				'label'     => __( 'Navigation Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .entry-content .isotop-btn a' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'navigation_hover_bg',
				'label'     => __( 'Navigation Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .entry-content .isotop-btn a:hover'  => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .entry-content .isotop-btn .current' => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'navigation_hover_color',
				'label'     => __( 'Navigation Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .entry-content .isotop-btn a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .isotop-btn .current' => 'color: {{VALUE}}',
				],
			],
			[
				'mode' => 'section_end',
			],
		];

		return $fields;
	}

	private function rt_isotope_query( $data ) {
		// Post type
		if ( ! empty( $data['category'] ) && is_array( $data['category'] ) ) {
			$get_post_ids = [];
			foreach ( $data['category'] as $cat ) {
				$args = [
					'post_type'      => 'lp_course',
					'post_status'    => 'publish',
					'posts_per_page' => $data['limit'],
					'fields'         => 'ids',
					'tax_query'      => [
						[
							'taxonomy' => 'course_category',
							'field'    => 'slug',
							'terms'    => explode( " ", $cat ),
						],
					],
				];

				$new_ids      = get_posts( $args );
				$get_post_ids = array_merge( $get_post_ids, $new_ids );
			}
		} else {
			$all_taxonomy = $this->rt_get_taxonomy( 'course_category' );
			$get_post_ids = [];
			foreach ( $all_taxonomy as $cat => $slug ) {
				$args = [
					'post_type'      => 'lp_course',
					'post_status'    => 'publish',
					'posts_per_page' => $data['limit'],
					'fields'         => 'ids',
					'tax_query'      => [
						[
							'taxonomy' => 'course_category',
							'field'    => 'slug',
							'terms'    => explode( " ", $slug ),
						],
					],
				];

				$new_ids      = get_posts( $args );
				$get_post_ids = array_merge( $get_post_ids, $new_ids );
			}
		}

		return $get_post_ids;
	}

	protected function render() {
		$data = $this->get_settings();

		$this->rt_load_scripts();


		switch ( $data['style'] ) {
			case 'style2':
				$template = 'view-2';
				break;
			default:
				$data['post_ids'] = $this->rt_isotope_query( $data );
				if ( ! $data['category'] ) {
					$data['category'] = array_keys( $this->rt_get_taxonomy( 'course_category' ) );
				}
				$template = 'view-1';
				break;
		}

		return $this->rt_template( $template, $data );
	}

}
