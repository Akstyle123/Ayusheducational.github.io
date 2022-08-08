<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Blog_Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Blog Post', 'eikra-core' );
		$this->rt_base = 'rt-blog-post';
		parent::__construct( $data, $args );
	}

	public function rt_fields() {
		$terms             = get_terms( [ 'taxonomy' => 'category' ] );
		$category_dropdown = [ '0' => __( 'All Categories', 'eikra-core' ) ];
		foreach ( $terms as $category ) {
			$category_dropdown[ $category->term_id ] = $category->name;
		}

		$fields = [
			[
				'mode'  => 'section_start',
				'id'    => 'section_general',
				'label' => __( 'General', 'eikra-core' ),
			],
			[
				'id'          => 'title',
				'label'       => __( 'Title', 'eikra-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			],

			[
				'id'      => 'layout',
				'label'   => __( 'Layout', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'style1' => __( 'Layout 1', 'eikra-core' ),
					'style2' => __( 'Layout 2', 'eikra-core' ),
				],
				'default' => 'style1',
			],

			[
				'id'      => 'category',
				'label'   => __( 'Category', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $category_dropdown,
				'default' => '0',
			],

			[
				'id'          => 'item_no',
				'label'       => __( 'Total number of items', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 3,
				'description' => __( 'Write -1 to show all', 'eikra-core' ),
			],
			[
				'id'          => 'content_limit',
				'label'       => __( 'Content Limit', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 13,
				"description" => __( "Maximum number of words to display. Default: 13", 'eikra-core' ),
			],

			[
				'id'          => 'offset',
				'label'       => __( 'Post Offset', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'number of post to displace or pass over. The offset parameter is ignored when total item => -1 (show all posts) is used.', 'eikra-core' ),
			],
			[
				'id'          => 'exclude',
				'label'       => __( 'Exclude Post', 'eikra-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs you would like to hide separated by comma. E.g: 37, 39, 40', 'eikra-core' ),
			],


			[
				'id'      => 'orderby',
				'label'   => __( 'Order By', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date' => esc_html__('Date', 'eikra-core'),
					'ID' => esc_html__('Order by post ID', 'eikra-core'),
					'author' => esc_html__('Author', 'eikra-core'),
					'title' => esc_html__('Title', 'eikra-core'),
					'modified' => esc_html__('Last modified date', 'eikra-core'),
					'parent' => esc_html__('Post parent ID', 'eikra-core'),
					'comment_count' => esc_html__('Number of comments', 'eikra-core'),
					'menu_order' => esc_html__('Menu order', 'eikra-core'),
					'meta_value_num' => esc_html__('Meta value number', 'eikra-core'),
					'rand' => esc_html__('Random order', 'eikra-core'),
				],
				'default' => 'date',
			],

			[
				'id'      => 'order',
				'label'   => __( 'Sort Order', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__('ASC', 'eikra-core'),
					'DESC' => esc_html__('DESC', 'eikra-core'),
				],
				'default' => 'DESC',
			],

			[
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'btn_display',
				'label'       => esc_html__( 'Button Display', 'eikra-core' ),
				'label_on'    => esc_html__( 'On', 'eikra-core' ),
				'label_off'   => esc_html__( 'Off', 'eikra-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Button. Default: Off', 'eikra-core' ),
			],
			[
				'type'      => Controls_Manager::TEXT,
				'id'        => 'btn_text',
				'label'     => esc_html__( 'Button Text', 'eikra-core' ),
				'default'   => 'Read More',
				'condition' => [
					'btn_display' => [ 'yes' ],
				],
			],

			[
				'mode' => 'section_end',
			],

			// Style Tab

			[
				'mode'  => 'section_start',
				'id'    => 'sec_general_style',
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'Typography', 'eikra-core' ),
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'section_title_typo',
				'label'    => esc_html__( 'Section Title', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-post-title',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => esc_html__( 'Post Title', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-blog-post-title',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'content_typo',
				'label'    => esc_html__( 'Content', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-content',

			],
			[
				'id'         => 'content_width',
				'label'      => __( 'Content Width', 'eikra-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .rtin-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'date_typo',
				'label'    => esc_html__( 'Date', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-item .rtin-date',

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
				'id'        => 'section_title_color',
				'label'     => __( 'Section Title Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-post-title' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_color',
				'label'     => __( 'Title Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-content-area h3 a'                 => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-vc-posts-2 .rtin-item .rtin-title a' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_hover_color',
				'label'     => __( 'Title Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-content-area h3 a:hover'                 => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-vc-posts-2 .rtin-item .rtin-title a:hover' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'content_color',
				'label'     => __( 'Content Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-content' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'date_color',
				'label'     => __( 'Date Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-content-area .rtin-date'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-vc-posts-2 .rtin-item .rtin-date' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'box_bg',
				'label'     => __( 'Box Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-vc-posts-2'          => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-vc-posts .rtin-item' => 'background-color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_bg',
				'label'     => __( 'Button Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .rtin-btn'   => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_color',
				'label'     => __( 'Button Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rtin-btn'   => 'color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_hover_bg',
				'label'     => __( 'Button Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a:hover' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .rtin-btn:hover'   => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_hover_color',
				'label'     => __( 'Button Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rtin-btn:hover'   => 'color: {{VALUE}} !important',
				],
			],
			[
				'mode' => 'section_end',
			],

		];

		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		switch ( $data['layout'] ) {
			case 'style2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
		}

		return $this->rt_template( $template, $data );
	}

}
