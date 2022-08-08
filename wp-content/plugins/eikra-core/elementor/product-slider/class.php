<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Product_Slider extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Product Slider', 'eikra-core' );
        $this->rt_base  = 'rt-woo-product-slider';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
    }

    public function rt_fields() {

        $terms = get_terms( array('taxonomy' => 'product_cat' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'eikra-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $column = array(
            '1' => __('1 Column', 'eikra-core'),
            '2' => __('2 Column', 'eikra-core'),
            '3' => __('3 Column', 'eikra-core'),
            '4' => __('4 Column', 'eikra-core'),
            '5' => __('5 Column', 'eikra-core'),
            '6' => __('6 Column', 'eikra-core'),
        );

        $fields = array(

            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'type'    => Controls_Manager::TEXT,
                'id'      => 'title',
                'label'   => esc_html__( 'Title', 'eikra-core' ),
                'default' => 'Our Publications',
            ),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
                'id'            => 'item_no',
                'label'         => __( 'Total number of items', 'eikra-core' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 5,
                'description'   => __( 'Write -1 to show all', 'eikra-core' ),
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Grid Column

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_grid',
                'label'   => __( 'Grid Column', 'eikra-core' ),
            ),
            array(
                'id'        => 'col_lg',
                'label'     => __( 'Columns ( Desktops > 1199px )', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $column,
                'default'   => '4',
            ),
            array(
                'id'        => 'col_md',
                'label'     => __( 'Columns ( Desktops > 991px )', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $column,
                'default'   => '3',
            ),
            array(
                'id'        => 'col_sm',
                'label'     => __( 'Columns ( Tablets > 767px )', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $column,
                'default'   => '3',
            ),
            array(
                'id'        => 'col_xs',
                'label'     => __( 'Columns ( Phones < 768px )', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $column,
                'default'   => '2',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'col_mobile',
                'label'   => __( 'Small Phones: < 480px', 'eikra-core' ),
                'options' => $column,
                'default' => '1',
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
                'default'     => 'yes',
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
                'mode'      => 'section_start',
                'id'        => 'sec_general_style',
                'tab'       => Controls_Manager::TAB_STYLE,
                'label'     => __( 'Typography', 'eikra-core' ),
            ),
            array (
                'mode'      => 'group',
                'type'      => Group_Control_Typography::get_type(),
                'id'        => 'section_title_typo',
                'label'     => esc_html__( 'Section Title', 'eikra-core' ),
                'selector'  => '{{WRAPPER}} .owl-custom-nav-title',
            ),
            array (
                'mode'      => 'group',
                'type'      => Group_Control_Typography::get_type(),
                'id'        => 'title_typo',
                'label'     => esc_html__( 'Product Title', 'eikra-core' ),
                'selector'  => '{{WRAPPER}} ul.products li.product h3 a',
            ),
            array (
                'mode'      => 'group',
                'type'      => Group_Control_Typography::get_type(),
                'id'        => 'price_typo',
                'label'     => esc_html__( 'Price', 'eikra-core' ),
                'selector'  => '{{WRAPPER}} ul.products li.product .price',
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
                'id'      => 'section_title_color',
                'label'   => __( 'Section Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .owl-custom-nav-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.products li.product h3 a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.products li.product h3 a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'rating_color',
                'label'   => __( 'Rating Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .star-rating' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_color',
                'label'   => __( 'Price Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce ul.products li.product .price' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_bg',
                'label'   => __( 'Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_color',
                'label'   => __( 'Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_border_color',
                'label'   => __( 'Icon Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_bg',
                'label'   => __( 'Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a:hover' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_color',
                'label'   => __( 'Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_border_color',
                'label'   => __( 'Icon Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .woocommerce .product-thumb-area .product-info ul li a:hover' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_bg',
                'label'   => __( 'Arrow Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-next' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_color',
                'label'   => __( 'Arrow Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-next' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_hover_bg',
                'label'   => __( 'Arrow Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev:hover' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-next:hover' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'arrow_hover_color',
                'label'   => __( 'Arrow Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-owl-nav-1 .section-title .owl-custom-nav .owl-next:hover' => 'color: {{VALUE}}',
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

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
