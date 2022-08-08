<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Testimonial extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Testimonial', 'eikra-core' );
        $this->rt_base  = 'rt-testimonial';
        parent::__construct( $data, $args );
    }

    private function rt_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
    }

    public function rt_fields() {

        $terms = get_terms( array('taxonomy' => 'ac_testimonial_category' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'eikra-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $orderby = array(
            'date'          => __( 'Date (Recents comes first)', 'eikra-core' ),
            'title'         =>  __( 'Title', 'eikra-core' ),
            'menu_order'    => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ),
        );

        $sortby = array(
            'ASC'       => __( 'Ascending', 'eikra-core' ),
            'DESC'      =>  __( 'Descending', 'eikra-core' ),
        );

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'    => 'style',
                'label' => __( 'Style', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    'style1'   => __( 'Style 1', 'eikra-core' ),
                    'style2'   => __( 'Style 2 (Requires Dark Background)', 'eikra-core'),
                    'style3'   => __( 'Style 3', 'eikra-core'),
                ),
                'default'   => 'style1',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Lorem Ipsum',
                'condition'   => array( 'style' => array( 'style2' ) ),
            ),
            array(
                'id'        => 'item_no',
                'label'     => __( 'Total number of items', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'description' => __( 'Write -1 to show all', 'eikra-core' ),
            ),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
                'id'        => 'orderby',
                'label'     => __( 'Order by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $orderby,
                'default'   => 'date',
            ),
            array(
                'id'        => 'sortby',
                'label'     => __( 'Sort by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $sortby,
                'default'   => 'DESC',
            ),
            array(
                'id'       => 'border_radius',
                'label'    => __( 'Thumbnail Radius', 'eikra-core' ),
                'type'     => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-vc-testimonial .rt-item .rt-item-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => array( 'style' => array( 'style1' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Slider options

            array(
                'mode'        => 'section_start',
                'id'          => 'sec_slider',
                'label'       => esc_html__( 'Slider Options', 'eikra-core' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_autoplay',
                'label'       => esc_html__( 'Autoplay', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => '',
                'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'eikra-core' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_stop_on_hover',
                'label'       => esc_html__( 'Stop on Hover', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Stop autoplay on mouse hover. Default: On', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'slider_interval',
                'label'   => esc_html__( 'Autoplay Interval', 'eikra-core' ),
                'options' => array(
                    '5000' => esc_html__( '5 Seconds', 'eikra-core' ),
                    '4000' => esc_html__( '4 Seconds', 'eikra-core' ),
                    '3000' => esc_html__( '3 Seconds', 'eikra-core' ),
                    '2000' => esc_html__( '2 Seconds', 'eikra-core' ),
                    '1000' => esc_html__( '1 Second',  'eikra-core' ),
                ),
                'default' => '5000',
                'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'    => Controls_Manager::NUMBER,
                'id'      => 'slider_autoplay_speed',
                'label'   => esc_html__( 'Autoplay Slide Speed', 'eikra-core' ),
                'default' => 200,
                'description' => esc_html__( 'Slide speed in milliseconds. Default: 200', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_loop',
                'label'       => esc_html__( 'Loop', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Loop to first item. Default: On', 'eikra-core' ),
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Typography

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_typography_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Typography', 'eikra-core' ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'title_typo',
                'label'   => esc_html__( 'Title', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-section-title',
                 
                'condition'   => array( 'style' => 'style2' ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'name_typo',
                'label'   => esc_html__( 'Name', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .testimonial-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'designation_typo',
                'label'   => esc_html__( 'Designation', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .testimonial-designation',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .testimonial-content',
                 
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Color

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_color_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Color', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-testimonial-2 .rtin-section-title' => 'color: {{VALUE}}' ),
                'condition'   => array( 'style' => 'style2' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'name_color',
                'label'   => __( 'Nmae Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .testimonial-title' => 'color: {{VALUE}} !important' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'designation_color',
                'label'   => __( 'Designation Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .testimonial-designation' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .testimonial-content' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'blockquote_color',
                'label'   => __( 'Blockquote Icon Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-testimonial-3 .rtin-item .rtin-content-area:before' => 'color: {{VALUE}}' ),
                'condition'   => array( 'style' => 'style3' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-testimonial .rt-item .rt-item-content' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-testimonial .rt-item .rt-item-content:after' => 'border-color: transparent transparent {{VALUE}} {{VALUE}}',
                ),
                'condition'   => array( 'style' => 'style1' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'dot_bg',
                'label'   => __( 'Navigation Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'dot_active_bg',
                'label'   => __( 'Active Navigation Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .owl-theme .owl-dots .owl-dot span:hover' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'dot_border_color',
                'label'   => __( 'Navigation Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => 'style2' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'dot_active_border_color',
                'label'   => __( 'Active Navigation Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => 'style2' ),
            ),
            array(
                'mode' => 'section_end',
            ),
        );

        return $fields;

    }

    protected function render() {
        $data = $this->get_settings();

        $this->rt_load_scripts();

        $owl_data = array(
            'nav'                => false,
            'dots'               => true,
            'autoplay'           => $data['slider_autoplay'] == 'yes' ? true : false,
            'autoplayTimeout'    => $data['slider_interval'],
            'autoplaySpeed'      => $data['slider_autoplay_speed'],
            'autoplayHoverPause' => $data['slider_stop_on_hover'] == 'yes' ? true : false,
            'loop'               => $data['slider_loop'] == 'yes' ? true : false,
            'margin'             => 30,
            'responsive'         => array(
                '0'    => array( 'items' => 1 ),
                '480'  => array( 'items' => 2 ),
            )
        );

        $template = 'view';

        switch ( $data['style'] ) {
            case 'style3':
                $owl_data['margin'] = 50;
                $owl_data['responsive'] = array(
                    '0'   => array( 'items' => 1 ),
                    '768' => array( 'items' => 2 )
                );
                $template = 'view-3';
                break;
            case 'style2':
                $owl_data['responsive'] = array( '0' => array( 'items' => 1 ) );
                $template = 'view-2';
                break;
            default:
                $template = 'view-1';
        }

        $data['owl_data'] = json_encode( $owl_data );

        return $this->rt_template( $template, $data );
    }

}
