<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Text_With_Button extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Text with Button', 'eikra-core' );
        $this->rt_base  = 'rt-text-with-buton';
        parent::__construct( $data, $args );
    }

    public function rt_fields() {

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
                    'light'   => __( 'Light Background', 'eikra-core' ),
                    'dark'   => __( 'Dark Background', 'eikra-core'),
                ),
                'default'   => 'light',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Lorem Ipsum'
            ),
            array(
                'type'    => Controls_Manager::TEXTAREA,
                'id'      => 'content',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'default' => esc_html__('Lorem Ipsum has been the industrys standard dummy text ever since printer took a galley. Rimply dummy text of the printing and typesetting industry', 'eikra-core' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'btn_display',
                'label'       => esc_html__( 'Button Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Show or Hide Button. Default: On', 'eikra-core' ),
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'btn_text',
                'label'       => esc_html__( 'Button Text', 'eikra-core' ),
                'default' 	  => esc_html__('Read More', 'eikra-core' ),
                'condition'   => array( 'btn_display' => array( 'yes' ) ),
            ),
            array(
                'type'        => Controls_Manager::URL,
                'id'          => 'btn_url',
                'label'       => esc_html__( 'Button URL', 'eikra-core' ),
                'placeholder' => 'https://your-link.com',
                'condition'   => array( 'btn_display' => array( 'yes' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),
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
                'selector' => '{{WRAPPER}} .rt-vc-text-button .rtin-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-vc-text-button .rtin-subtitle',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'btn_typo',
                'label'   => esc_html__( 'Button', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-btn a',
                 
                'condition'   => array( 'btn_display' => array( 'yes' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),
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
                'selectors' => array( '{{WRAPPER}} .rt-vc-text-button .rtin-title' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-text-button .rtin-subtitle' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'btn_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'btn_border_color',
                'label'   => __( 'Button Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'btn_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'btn_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_border_color',
                'label'   => __( 'Button Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'btn_display'    => array( 'yes' ),
                ),
            ),
            array(
                'mode' => 'section_end',
            ),
        );

        return $fields;

    }

    protected function render() {
        $data = $this->get_settings();

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
