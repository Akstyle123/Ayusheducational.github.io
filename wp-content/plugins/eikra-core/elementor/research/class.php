<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Research extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Research', 'eikra-core' );
		$this->rt_base = 'rt-research';
		parent::__construct( $data, $args );
	}

	public function rt_fields() {
		$terms             = get_terms( [ 'taxonomy' => 'ac_research_category' ] );
		$category_dropdown = [ '0' => __( 'All Categories', 'eikra-core' ) ];
		foreach ( $terms as $category ) {
			$category_dropdown[ $category->term_id ] = $category->name;
		}

		$orderby = [
			'date'       => __( 'Date (Recents comes first)', 'eikra-core' ),
			'title'      => __( 'Title', 'eikra-core' ),
			'menu_order' => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ),
		];

		$sortby = [
			'ASC'  => __( 'Ascending', 'eikra-core' ),
			'DESC' => __( 'Descending', 'eikra-core' ),
		];

		$column = [
			'3'  => __( '4 Column', 'eikra-core' ),
			'4'  => __( '3 Column', 'eikra-core' ),
			'6'  => __( '2 Column', 'eikra-core' ),
			'12' => __( '1 Column', 'eikra-core' ),
		];

		$fields = [
			[
				'mode'  => 'section_start',
				'id'    => 'section_general',
				'label' => __( 'General', 'eikra-core' ),
			],
			[
				'id'      => 'style',
				'label'   => __( 'Style', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'layout1' => __( 'Style 1', 'eikra-core' ),
					'layout2' => __( 'Style 2', 'eikra-core' ),
					'layout3' => __( 'Style 3', 'eikra-core' ),
				],
				'default' => 'layout1',
			],
			[
				'id'          => 'item_no',
				'label'       => __( 'Items Per Page', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 9,
				'description' => __( 'Write -1 to show all', 'eikra-core' ),
			],
			[
				'id'      => 'cat',
				'label'   => __( 'Categories', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $category_dropdown,
				'default' => '0',
			],
			[
				'id'      => 'orderby',
				'label'   => __( 'Order by', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $orderby,
				'default' => 'date',
			],
			[
				'id'      => 'sortby',
				'label'   => __( 'Sort by', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $sortby,
				'default' => 'DESC',
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
				'description' => __( 'Enter the post IDs you would like to hide separated by comma. E.g: 97, 87, 90', 'eikra-core' ),
			],
			[
				'id'          => 'length',
				'label'       => __( 'Excerpt Length', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 35,
				'description' => __( 'Maximum number of words', 'eikra-core' ),
			],
			[
				'type'      => Controls_Manager::SWITCHER,
				'id'        => 'btn_display',
				'label'     => esc_html__( 'Button Display', 'eikra-core' ),
				'label_on'  => esc_html__( 'On', 'eikra-core' ),
				'label_off' => esc_html__( 'Off', 'eikra-core' ),
				'default'   => 'no',
				'condition' => [ 'style' => [ 'layout1' ] ],
			],
			[
				'type'      => Controls_Manager::TEXT,
				'id'        => 'buttontext',
				'label'     => esc_html__( 'Button Text', 'eikra-core' ),
				'default'   => 'Read More',
				'condition' => [ 'btn_display' => [ 'yes' ] ],
			],
			[
				'mode' => 'section_end',
			],

			// Grid Column

			[
				'mode'      => 'section_start',
				'id'        => 'sec_grid',
				'label'     => __( 'Grid Column', 'eikra-core' ),
				'condition' => [ 'style' => [ 'layout2', 'layout3' ] ],
			],
			[
				'id'      => 'col_lg',
				'label'   => __( 'Columns ( Desktops > 1199px )', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $column,
				'default' => '4',
			],
			[
				'id'      => 'col_md',
				'label'   => __( 'Columns ( Desktops > 991px )', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $column,
				'default' => '4',
			],
			[
				'id'      => 'col_sm',
				'label'   => __( 'Columns ( Tablets > 767px )', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $column,
				'default' => '6',
			],
			[
				'id'      => 'col_xs',
				'label'   => __( 'Columns ( Phones < 768px )', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $column,
				'default' => '12',
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
				'label'    => esc_html__( 'Title', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-title a',
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'content_typo',
				'label'    => esc_html__( 'Content', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-content',
			],
			[
				'mode'      => 'group',
				'type'      => Group_Control_Typography::get_type(),
				'id'        => 'btn_typo',
				'label'     => esc_html__( 'Button', 'eikra-core' ),
				'selector'  => '{{WRAPPER}} .rtin-btn',
				'condition' => [ 'style' => [ 'layout1' ] ],
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
				'id'        => 'title_bg',
				'label'     => __( 'Title Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a' => 'background: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout3' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'title_hover_bg',
				'label'     => __( 'Title Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a:hover' => 'background: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout3' ] ],
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
				'id'        => 'btn_bg',
				'label'     => __( 'Button Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn' => 'background: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout1' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'btn_color',
				'label'     => __( 'Social Icon Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn' => 'color: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout1' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'btn_hover_bg',
				'label'     => __( 'Button Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn:hover' => 'background: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout1' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'btn_hover_color',
				'label'     => __( 'Button Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn:hover' => 'color: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout1' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'seperator_color',
				'label'     => __( 'Bottom Line Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title::after' => 'background: {{VALUE}}',
				],
				'condition' => [ 'style' => [ 'layout1', 'layout2' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_bg',
				'label'     => __( 'Pagination Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .pagination-area ul li a' => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_color',
				'label'     => __( 'Pagination Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .pagination-area ul li a' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_hover_bg',
				'label'     => __( 'Pagination Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .pagination-area ul li a:hover'  => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}}  .pagination-area ul li.active a' => 'background-color: {{VALUE}} !important',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_hover_color',
				'label'     => __( 'Pagination Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}}  .pagination-area ul li a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}}  .pagination-area ul li.active a' => 'color: {{VALUE}}',
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

		switch ( $data['style'] ) {
			case 'layout3':
				$template = 'view-3';
				break;
			case 'layout2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
		}

		return $this->rt_template( $template, $data );
	}

}
