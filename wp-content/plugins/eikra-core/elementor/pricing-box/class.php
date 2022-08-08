<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Pricing_Box extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Pricing Box', 'eikra-core' );
        $this->rt_base  = 'rt-pricing-box';
        parent::__construct( $data, $args );
    }

    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => esc_html__( 'General', 'eikra-core' )
            ),
            array(
                'id'    => 'style',
                'label' => esc_html__( 'Layout', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    'style1'   => esc_html__( 'Style 1', 'eikra-core' ),
                    'style2'   => esc_html__( 'Style 2', 'eikra-core'),
                    'style3'   => esc_html__( 'Style 3', 'eikra-core'),
                ),
                'default'   => 'style1',
            ),
            array(
                'id'        => 'title',
                'label'     => esc_html__( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Basic'
            ),
            array(
                'id'        => 'currency',
                'label'     => esc_html__( 'Currency Symbol', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '$',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'id'        => 'price',
                'label'     => esc_html__( 'Price', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '$29',
            ),
            array(
                'id'        => 'unit',
                'label'     => esc_html__( 'Unit', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'mo',
                'description'   => esc_html__('eg. month or year. Keep empty if you don\'t want to show unit', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::TEXTAREA,
                'id'      => 'features',
                'label'   => esc_html__( 'Features', 'eikra-core' ),
                'default' => 'One line per feature',
                'description' => esc_html__( "One line per feature. Put BLANK keyword if you want blank line. eg.<br/>Investment Plan</br>Education Loan</br>Tax Planning</br>BLANK", 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::TEXT,
                'id'      => 'buttontext',
                'label'   => esc_html__( 'Button Text', 'eikra-core' ),
                'default' => 'Buy Now',
            ),
            array(
                'type'  => Controls_Manager::URL,
                'id'    => 'buttonurl',
                'label' => esc_html__( 'Button Link', 'eikra-core' ),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'placeholder' => 'https://your-link.com',
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'featured',
                'label'   => esc_html__( 'Display as Featured', 'eikra-core' ),
                'options' => array(
                    'enable' => esc_html__( 'Enabled', 'eikra-core' ),
                    'disable'  => esc_html__( 'Disabled', 'eikra-core' ),
                ),
                'default' => 'disable',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),
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
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 span',
                    '{{WRAPPER}} .rt-pricing-box2 .rtin-title',
                ),
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'price_typo',
                'label'   => esc_html__( 'Price Style', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-price',
                    '{{WRAPPER}} .rt-pricing-box2 .rtin-price',
                ),
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content Style', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-feature-each',
                    '{{WRAPPER}} .rt-pricing-box2 ul li',
                ),
                 
            ),
            array(
                'id'       => 'content_width',
                'label'    => __( 'Content Width', 'eikra-core' ),
                'type'     => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-feature-each' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rt-pricing-box2 ul' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'mode' => 'section_end',
            ),
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_icon_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Color', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_text_color',
                'label'   => __( 'Box Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-feature-each' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-feature-each' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 ul li' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_hover_text_color',
                'label'   => __( 'Box Hover Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1:hover .rtin-feature-each' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3:hover .rtin-feature-each' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3.rtin-featured .rtin-feature-each' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2:hover ul li' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2' => 'background-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_hover_bg',
                'label'   => __( 'Box Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3.rtin-featured' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2:hover' => 'background-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rtin-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1:hover span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3:hover .rtin-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3.rtin-featured .rtin-title' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_border_color',
                'label'   => __( 'Button Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rtin-btn:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn:hover' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rdtheme-button-6:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-btn:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_bg',
                'label'   => __( 'Price Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-price-table-box1 .rtin-price' => 'background: {{VALUE}}' ),
                'condition'   => array( 'style' => array( 'style1' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_bg_hover',
                'label'   => __( 'Price Hover Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-price-table-box1:hover .rtin-price' => 'background: {{VALUE}}' ),
                'condition'   => array( 'style' => array( 'style1' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_color',
                'label'   => __( 'Price Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1 .rtin-price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-pricing-box2 .rtin-price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-price-table-box3 .rtin-price' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_hover_color',
                'label'   => __( 'Price Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-price-table-box1:hover .rtin-price' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array( 'style1' ) ),
            ),
            array(
                'mode' => 'section_end',
            ),
        );

        return $fields;

    }

    private function validate( $str ){
        $str = trim( $str );
        // replace BLANK keyword
        if ( strtolower( $str ) == 'blank'  ) {
            return '&nbsp;';
        }
        return $str;
    }

    protected function render() {
        $data = $this->get_settings();

        $features = strip_tags( $data['features'] ); // remove tags
        $features = explode( "\n", $features ); // string to array
        $features = array_map( array( $this, 'validate' ),  $features ); // validate

        $data['features'] = $features;

        switch ( $data['style'] ) {
            case 'style3':
                $template = 'view-3';
                break;
            case 'style2':
                $template = 'view-2';
                break;
            default:
                $template = 'view-1';
        }

        return $this->rt_template( $template, $data );
    }

}
