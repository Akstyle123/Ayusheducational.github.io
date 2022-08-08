<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Course_Slider extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Course Slider', 'eikra-core' );
        $this->rt_base  = 'rt-course-slider';
        parent::__construct( $data, $args );
    }

    private function rt_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_style( 'course-review' );
        wp_enqueue_style( 'dashicons' );
    }

    public function rt_fields() {

        $terms = get_terms( array('taxonomy' => 'course_category' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'eikra-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $orderby = array(
            'date'          => __( 'Date (Recents comes first)', 'eikra-core' ),
            'title'         =>  __( 'Title', 'eikra-core' ),
            'menu_order'    => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ),
        );

        if ( RDTheme_Helper::is_LMS() ) {
            $orderby['popularity'] = __( 'Popularity (Based on enrolled students)', 'eikra-core' );
        }

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Section Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Course Slider',
            ),
            array(
                'id'    => 'style',
                'label' => __( 'Style', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    '1'   => __( 'Style 1', 'eikra-core' ),
                    '2'   => __( 'Style 2', 'eikra-core'),
                    '3'   => __( 'Style 3', 'eikra-core'),
                    '4'   => __( 'Style 4', 'eikra-core'),
                ),
                'default'   => '1',
            ),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
                'id'        => 'item_no',
                'label'     => __( 'Total number of items', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
                'description' => __( 'Write -1 to show all', 'eikra-core' ),
                'condition'   => array( 'style' => array( 'style1', 'style2', 'style4' ) ),
            ),
            array(
                'id'        => 'orderby',
                'label'     => __( 'Order by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $orderby,
                'default'   => 'date',
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Responsive Columns

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_responsive',
                'label'   => __( 'Number of Responsive Columns', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_lg',
                'label'   => __( 'Desktops: > 1199px', 'eikra-core' ),
                'options' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '4',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_md',
                'label'   => __( 'Desktops: > 991px', 'eikra-core' ),
                'options' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '3',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_sm',
                'label'   => __( 'Tablets: > 767px', 'eikra-core' ),
                'options' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '2',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_xs',
                'label'   => __( 'Phones: < 768px', 'eikra-core' ),
                'options' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '2',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_mobile',
                'label'   => __( 'Small Phones: < 480px', 'eikra-core' ),
                'options' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '1',
            ),
            array(
                'mode' => 'section_end',
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

            // Style Tab

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'General', 'eikra-core' ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'title_typo',
                'label'   => esc_html__( 'Title Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-content .rtin-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-content .rtin-description',
                 
                'condition'   => array( 'style' => array('1', '2', '3') ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'price_typo',
                'label'   => esc_html__( 'Price Style', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins',
                ),
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'author_typo',
                'label'   => esc_html__( 'Author Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-author',
                 
            ),
            array(
                'mode' => 'section_end',
            ),

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Color', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'author_icon_color',
                'label'   => __( 'Author Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-author i' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'author_text_color',
                'label'   => __( 'Author Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-author a' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1', '2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-description' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1', '2', '3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_text_color',
                'label'   => __( 'Price Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_bg_color',
                'label'   => __( 'Price Background Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1', '2', '3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'rating_color',
                'label'   => __( 'Rating Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .review-stars-rated .review-stars.filled' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .review-stars-rated .review-stars.empty' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'others_icon_color',
                'label'   => __( 'Others Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .rtin-meta .rtin-enrolled' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta span' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta i' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta .rt-wishlist-icon span:before' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_bg',
                'label'   => __( 'Arrow Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .owl-custom-nav > div' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_color',
                'label'   => __( 'Arrow Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .owl-custom-nav > div' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_hover_bg',
                'label'   => __( 'Arrow Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .owl-custom-nav > div:hover' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_hover_color',
                'label'   => __( 'Arrow Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .owl-custom-nav > div:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'mode'  => 'section_end'
            ),
        );

        return $fields;

    }

    protected function render() {
        $data = $this->get_settings();

        $this->rt_load_scripts();

        $owl_data = array(
            'nav'                => false,
            'dots'               => false,
            'autoplay'           => $data['slider_autoplay'] == 'yes' ? true : false,
            'autoplayTimeout'    => $data['slider_interval'],
            'autoplaySpeed'      => $data['slider_autoplay_speed'],
            'autoplayHoverPause' => $data['slider_stop_on_hover'] == 'yes' ? true : false,
            'loop'               => $data['slider_loop'] == 'yes' ? true : false,
            'margin'             => 20,
            'responsive'         => array(
                '0'    => array( 'items' => intval($data['col_mobile']) ),
                '480'  => array( 'items' => intval($data['col_xs']) ),
                '768'  => array( 'items' => intval($data['col_sm']) ),
                '992'  => array( 'items' => intval($data['col_md']) ),
                '1200' => array( 'items' => intval($data['col_lg']) ),
            )
        );

        $data['owl_data'] = json_encode( $owl_data );

//        if ( RDTheme_Helper::is_LMS() && $data['orderby'] == 'popularity' ) {
//            $orderby = 'date';
//        }

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
