<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( ! class_exists( 'RDTheme_VC_Event' ) ) {
	class RDTheme_VC_Event extends RDTheme_VC_Modules {

		public function __construct() {
			$this->name      = __( "Eikra: Events", 'eikra-core' );
			$this->base      = 'eikra-vc-event';
			$this->translate = [
				'title'       => __( "Upcoming Events", 'eikra-core' ),
				'button_text' => __( "VIEW ALL", 'eikra-core' ),
			];
			parent::__construct();
		}

		public function fields() {
			$terms             = get_terms( [ 'taxonomy' => 'ac_event_category' ] );
			$category_dropdown = [ __( 'All Categories', 'eikra-core' ) => '0' ];
			foreach ( $terms as $category ) {
				$category_dropdown[ $category->name ] = $category->term_id;
			}

			$fields = [

				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Layout", 'eikra-core' ),
					"param_name" => "layout",
					'value'      => [
						__( "List", 'eikra-core' ) => 'list',
						__( "Grid", 'eikra-core' ) => 'grid',
						__( "Box", 'eikra-core' )  => 'box',
					],
				],

				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value"      => $this->translate['title'],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'list' ],
					],
				],

				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Total number of items", 'eikra-core' ),
					"param_name"  => "number",
					"value"       => '2',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
					'dependency'  => [
						'element' => 'layout',
						'value'   => [ 'list', 'box' ],
					],
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Number of items per page", 'eikra-core' ),
					"param_name"  => "grid_item_number",
					"value"       => '4',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
					'dependency'  => [
						'element' => 'layout',
						'value'   => [ 'grid' ],
					],
				],

				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Categories", 'eikra-core' ),
					"param_name" => "cat",
					'value'      => $category_dropdown,
				],

				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Event Type", 'eikra-core' ),
					"param_name" => "type",
					"value"      => [
						__( 'Upcoming Events', 'eikra-core' ) => 'upcoming',
						__( 'All Events', 'eikra-core' )      => 'all',
					],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Order by', 'eikra-core' ),
					"holder"      => "div",
					"class"       => "",
					'param_name'  => 'orderby',
					'value'       => [
						esc_html__( 'Date', 'eikra-core' )               => 'date',
						esc_html__( 'Event Start Date', 'eikra-core' )   => 'rt_event_start_date',
						esc_html__( 'Event End Date', 'eikra-core' )     => 'rt_event_end_date',
						esc_html__( 'Order by post ID', 'eikra-core' )   => 'ID',
						esc_html__( 'Author', 'eikra-core' )             => 'author',
						esc_html__( 'Title', 'eikra-core' )              => 'title',
						esc_html__( 'Last modified date', 'eikra-core' ) => 'modified',
						esc_html__( 'Post parent ID', 'eikra-core' )     => 'parent',
						esc_html__( 'Number of comments', 'eikra-core' ) => 'comment_count',
						esc_html__( 'Menu order', 'eikra-core' )         => 'menu_order',
						esc_html__( 'Meta value', 'eikra-core' )         => 'meta_value',
						esc_html__( 'Meta value number', 'eikra-core' )  => 'meta_value_num',
						esc_html__( 'Random order', 'eikra-core' )       => 'rand',
					],
					'admin_label' => true,
					'std'         => 'date',
					'dependency'  => [
						'element' => 'type',
						'value'   => [ 'all' ],
					],
					'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'eikra-core' ),
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Sort order', 'eikra-core' ),
					'param_name'  => 'order',
					'value'       => [
						esc_html__( 'ASC', 'eikra-core' )  => 'ASC',
						esc_html__( 'DESC', 'eikra-core' ) => 'DESC',
					],
					'admin_label' => true,
					'std'         => 'DESC',
					'description' => esc_html__( 'You can change default order, Default is DESC', 'eikra-core' ),
					'dependency'  => [
						'element' => 'type',
						'value'   => [ 'all' ],
					],
				],

				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Content Limit", 'eikra-core' ),
					"param_name"  => "content_limit",
					"value"       => '35',
					"description" => __( "Maximum number of words to display. Default: 35", 'eikra-core' ),
					'dependency'  => [
						'element' => 'layout',
						'value'   => [ 'grid', 'list' ],
					],
				],

				[
					"type"       => "colorpicker",
					"class"      => "",
					"heading"    => __( "Background Color", "eikra-core" ),
					"param_name" => "bg_color",
					"value"      => '#ffffff',
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'list' ],
					],
				],

				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Button Display", 'eikra-core' ),
					"param_name" => "button_display",
					"value"      => [
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'list' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Button Text", 'eikra-core' ),
					"param_name" => "button_text",
					"value"      => $this->translate['button_text'],
					'dependency' => [
						'element' => 'button_display',
						'value'   => [ 'true' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Button URL", 'eikra-core' ),
					"param_name" => "button_url",
					"value"      => '',
					'dependency' => [
						'element' => 'button_display',
						'value'   => [ 'true' ],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Pagination Visibility", 'eikra-core' ),
					"param_name" => "pagination",
					"value"      => [
						__( "Enabled", "eikra-core" )  => 'enable',
						__( "Disabled", "eikra-core" ) => 'disable',
					],
					'std'        => 'disable',
				],
			];

			return $fields;
		}

		public function get_events_args( $data ) {
			$_paged = is_front_page() ? "page" : "paged";
			$paged  = get_query_var( $_paged ) ? absint( get_query_var( $_paged ) ) : 1;

			$args = [
				'post_type'      => 'ac_event',
				'posts_per_page' => $data['layout'] == 'grid' ? $data['grid_item_number'] : $data['number'],
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
				if ( 'rt_event_start_date' == $data['orderby'] || 'rt_event_end_date' == $data['orderby'] ) {
					$event_date_meta_key = ( 'rt_event_start_date' == $data['orderby'] ) ? 'rt_event_start_date' : 'rt_event_end_date';
					$args                = wp_parse_args(
						[
							'meta_key'  => $event_date_meta_key,
							'orderby'   => 'meta_value',
							'meta_type' => 'DATE',
							'order'     => $data['order'],
						],
						$args
					);
				} elseif ( $data['orderby'] == 'meta_value' && $data['meta_key'] ) {
					$args = wp_parse_args(
						[
							'meta_key' => $data['meta_key'],
							'orderby'  => 'meta_value',
							//							'meta_type'  => 'DATE',
							'order'    => $data['order'],
						],
						$args
					);
				} else {
					$args = wp_parse_args(
						[
							'orderby' => $data['orderby'],
							'order'   => $data['order'],
						],
						$args
					);
				}


				//				if ( $data['orderby'] == 'meta_value' && $data['meta_key'] ) {
				//					$args = wp_parse_args(
				//						[
				//							'meta_key'  => $data['meta_key'],
				//							'meta_type' => 'DATE',
				//						],
				//						$args
				//					);
				//				}
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


		public function shortcode( $atts, $content = '' ) {
			$args = shortcode_atts( [
				                        'layout'           => 'list',
				                        'title'            => $this->translate['title'],
				                        'type'             => 'upcoming',
				                        'orderby'          => 'date',
				                        'order'            => 'DESC',
				                        'cat'              => '',
				                        'number'           => '2',
				                        'grid_item_number' => '4',
				                        'content_limit'    => '35',
				                        'bg_color'         => '#ffffff',
				                        'button_display'   => 'true',
				                        'button_text'      => $this->translate['button_text'],
				                        'button_url'       => '',
				                        'pagination'       => 'disable',
			                        ],
			                        $atts );

			extract( $args );

			$event_args = $this->get_events_args( $args );

			$content_limit = intval( $content_limit );
			$number        = intval( $number );

			if ( $args['layout'] == 'grid' ) {
				$template = 'event-grid';
			} elseif ( $args['layout'] == 'box' ) {
				$template = 'event-box';
			} else {
				$template = 'event-list';
			}

			return $this->template( $template, get_defined_vars() );
		}

	}
}

new RDTheme_VC_Event;