<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Event extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'Event', 'eikra-core' );
		$this->rt_base = 'rt-event';
		parent::__construct( $data, $args );
	}


	public function rt_fields() {
		$terms             = get_terms( [ 'taxonomy' => 'ac_event_category' ] );
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
				'condition'   => [ 'layout' => [ 'list' ] ],
			],
			[
				'id'      => 'layout',
				'label'   => __( 'Style', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'list' => __( 'List', 'eikra-core' ),
					'grid' => __( 'Grid', 'eikra-core' ),
					'box'  => __( 'Box', 'eikra-core' ),
				],
				'default' => 'list',
			],
			[
				'id'      => 'type',
				'label'   => __( 'Event Type', 'eikra-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'all'      => __( 'All Event', 'eikra-core' ),
					'upcoming' => __( 'Upcoming Events', 'eikra-core' ),
				],
				'default' => 'all',
			],

			[
				'id'        => 'orderby',
				'label'     => __( 'Order By', 'eikra-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'date'          => esc_html__( 'Date', 'eikra-core' ),
					'ID'            => esc_html__( 'Order by post ID', 'eikra-core' ),
					'author'        => esc_html__( 'Author', 'eikra-core' ),
					'title'         => esc_html__( 'Title', 'eikra-core' ),
					'modified'      => esc_html__( 'Last modified date', 'eikra-core' ),
					'parent'        => esc_html__( 'Post parent ID', 'eikra-core' ),
					'comment_count' => esc_html__( 'Number of comments', 'eikra-core' ),
					'menu_order'    => esc_html__( 'Menu order', 'eikra-core' ),
					'meta_value'    => esc_html__( 'Event Date', 'eikra-core' ),
					'rand'          => esc_html__( 'Random order', 'eikra-core' ),
				],
				'default'   => 'date',
				'condition' => [ 'type' => [ 'all' ] ],
			],
			[
				'id'        => 'meta_key',
				'label'     => __( 'Order By Meta Value', 'eikra-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'rt_event_start_date' => esc_html__( 'Event Start Date', 'eikra-core' ),
					'rt_event_end_date'   => esc_html__( 'Event End Date', 'eikra-core' ),
				],
				'default'   => 'rt_event_start_date',
				'condition' => [ 'orderby' => [ 'meta_value' ], 'type' => [ 'all' ] ],
			],
			[
				'id'        => 'order',
				'label'     => __( 'Sort Order', 'eikra-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'ASC'  => esc_html__( 'ASC', 'eikra-core' ),
					'DESC' => esc_html__( 'DESC', 'eikra-core' ),
				],
				'default'   => 'ASC',
				'condition' => [ 'type' => [ 'all' ] ],
			],

			[
				'id'        => 'cat',
				'label'     => __( 'Categories', 'eikra-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $category_dropdown,
				'default'   => '0',
				'condition' => [ 'layout' => [ 'list' ] ],
			],
			[
				'id'          => 'item_no',
				'label'       => __( 'Total number of items', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 2,
				'description' => __( 'Write -1 to show all', 'eikra-core' ),
				'condition'   => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'id'          => 'grid_item_no',
				'label'       => __( 'Number of items per page', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 4,
				'description' => __( 'Write -1 to show all', 'eikra-core' ),
				'condition'   => [ 'layout' => [ 'grid' ] ],
			],
			[
				'id'          => 'length',
				'label'       => __( 'Excerpt Length', 'eikra-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 35,
				'description' => __( 'Maximum number of words', 'eikra-core' ),
				'condition'   => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'type'         => Controls_Manager::SWITCHER,
				'id'           => 'pagination',
				'label'        => esc_html__( 'Pagination Display', 'eikra-core' ),
				'label_on'     => esc_html__( 'On', 'eikra-core' ),
				'label_off'    => esc_html__( 'Off', 'eikra-core' ),
				'default'      => 'no',
				'return_value' => 'yes',
			],
			[
				'id'        => 'pagi_text_align',
				'label'     => __( 'Alignment', 'plugin-domain' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'left'   => __( 'Left', 'eikra-core' ),
					'center' => __( 'Center', 'eikra-core' ),
					'right'  => __( 'Right', 'eikra-core' ),

				],
				'default'   => 'center',
				'toggle'    => true,
				'condition' => [ 'pagination' => [ 'yes' ] ],
				'selectors' => [
					'{{WRAPPER}} .rt-event-block-wrapper .pagination-area' => 'text-align: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::SWITCHER,
				'id'        => 'btn_display',
				'label'     => esc_html__( 'Button Display', 'eikra-core' ),
				'label_on'  => esc_html__( 'On', 'eikra-core' ),
				'label_off' => esc_html__( 'Off', 'eikra-core' ),
				'default'   => 'yes',
				'condition' => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'type'      => Controls_Manager::TEXT,
				'id'        => 'btn_text',
				'label'     => esc_html__( 'Button Text', 'eikra-core' ),
				'default'   => 'All Events',
				'condition' => [
					'layout'      => [ 'list', 'box' ],
					'btn_display' => [ 'yes' ],
				],
			],
			[
				'type'        => Controls_Manager::URL,
				'id'          => 'buttonurl',
				'label'       => esc_html__( 'Button Link', 'eikra-core' ),
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
				'placeholder' => 'https://your-link.com',
				'condition'   => [
					'layout'      => [ 'list' ],
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
				'label' => __( 'General', 'eikra-core' ),
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'title_typo',
				'label'    => esc_html__( 'Title', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rt-vc-title-left',

				'condition' => [
					'layout' => [ 'list' ],
				],
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'event_title_typo',
				'label'    => esc_html__( 'Event Title', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-right h3',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'content_typo',
				'label'    => esc_html__( 'Content', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-content',

				'condition' => [ 'layout' => [ 'grid', 'list' ] ],
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
				'condition'  => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'time_typo',
				'label'    => esc_html__( 'Time', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-time',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'location_typo',
				'label'    => esc_html__( 'Location', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-location',

			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'date_typo',
				'label'    => esc_html__( 'Date', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-calender h3',

				'condition' => [
					'layout' => [ 'list', 'grid' ],
				],
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'year_typo',
				'label'    => esc_html__( 'Year', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-calender span',

				'condition' => [
					'layout' => [ 'list', 'grid' ],
				],
			],
			[
				'mode'     => 'group',
				'type'     => Group_Control_Typography::get_type(),
				'id'       => 'date_year_typo',
				'label'    => esc_html__( 'Date', 'eikra-core' ),
				'selector' => '{{WRAPPER}} .rtin-calender h3',

				'condition' => [
					'layout' => [ 'box' ],
				],
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
					'{{WRAPPER}} .rt-vc-title-left' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'list' ],
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'event_title_color',
				'label'     => __( 'Event Title Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'event_title_hover_color',
				'label'     => __( 'Event title Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'content_color',
				'label'     => __( 'Content Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'list', 'grid' ],
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'time_color',
				'label'     => __( 'Time Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-time' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'location_color',
				'label'     => __( 'Location Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-location' => 'color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'box_bg',
				'label'     => __( 'Box Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-item' => 'background-color: {{VALUE}}',
				],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_bg',
				'label'     => __( 'Pagination Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'grid' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_color',
				'label'     => __( 'Pagination Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'color: {{VALUE}}',
				],
				'condition' => [ 'layout' => [ 'grid' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_hover_bg',
				'label'     => __( 'Pagination Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'grid' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'pagination_hover_color',
				'label'     => __( 'Pagination Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'color: {{VALUE}}',
				],
				'condition' => [ 'layout' => [ 'grid' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_bg',
				'label'     => __( 'Button Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_color',
				'label'     => __( 'Button Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a' => 'color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_hover_bg',
				'label'     => __( 'Button Hover Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a:hover' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_hover_color',
				'label'     => __( 'Button Hover Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a:hover' => 'color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'list', 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_border_color',
				'label'     => __( 'Button Border Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a' => 'border-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'button_hovr_border_color',
				'label'     => __( 'Button Hover Border Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-btn a:hover' => 'border-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'box' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'calender_top_bg',
				'label'     => __( 'Calendar Top Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-calender' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'calender_top_color',
				'label'     => __( 'Calendar Top Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-calender h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtin-calender p'  => 'color: {{VALUE}}',
				],
				'condition' => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'calender_bottom_bg',
				'label'     => __( 'Calendar Bottom Background', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-calender span' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'type'      => Controls_Manager::COLOR,
				'id'        => 'calender_bottom_color',
				'label'     => __( 'Calendar Bottom Color', 'eikra-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-calender span' => 'color: {{VALUE}} !important',
				],
				'condition' => [ 'layout' => [ 'grid', 'list' ] ],
			],
			[
				'mode' => 'section_end',
			],
		];

		return $fields;
	}

	public function get_events_args( $data ) {
		$_paged = is_front_page() ? "page" : "paged";
		$paged  = get_query_var( $_paged ) ? absint( get_query_var( $_paged ) ) : 1;

		$args = [
			'post_type'      => 'ac_event',
			'posts_per_page' => $data['layout'] == 'grid' ? $data['grid_item_no'] : $data['item_no'],
			'post_status'    => 'publish',
			'paged'          => $paged,
		];

		if ( 'upcoming' == $data['type'] ) {
			$event_time = date( 'Y-m-d' );
			$args       = wp_parse_args(
				[
					'meta_query' => [
						'relation' => 'OR',
						[
							'key'     => 'rt_event_start_date',
							'value'   => $event_time,
							'compare' => '>=',
							'type'    => 'DATE',
						],
						[
							'key'     => 'rt_event_end_date',
							'value'   => $event_time,
							'compare' => '>=',
							'type'    => 'DATE',
						],
					],
					'meta_key'   => 'rt_event_start_date',
					'orderby'    => 'meta_value',
					'meta_type'  => 'DATE',
					'order'      => 'ASC',
				],
				$args
			);
		}

		if ( 'all' == $data['type'] && ( $data['orderby'] || $data['order'] ) ) {
			$args = wp_parse_args(
				[
					'orderby' => $data['orderby'],
					'order'   => $data['order'],
				],
				$args
			);

			if ( $data['orderby'] == 'meta_value' && $data['meta_key'] ) {
				$args = wp_parse_args(
					[
						'meta_key'  => $data['meta_key'],
						'meta_type' => 'DATE',
					],
					$args
				);
			}
		}

		if ( ! empty( $data['cat'] ) ) {
			$args = wp_parse_args(
				[
					'tax_query' => [
						[
							'taxonomy' => 'ac_event_category',
							'field'    => 'term_id',
							'terms'    => $data['cat'],
						],
					],
				],
				$args
			);
		}

		return $args;
	}
	
	protected function render() {
		$data               = $this->get_settings();
		$data['event_args'] = $this->get_events_args( $data );

		switch ( $data['layout'] ) {
			case 'grid':
				$template = 'view-3';
				break;
			case 'box':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
		}

		$this->rt_template( $template, $data );
	}

}
