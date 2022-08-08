<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Campus_Gallery extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Gallery', 'eikra-core' );
        $this->rt_base  = 'rt-campus-gallery';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_style( 'magnific-popup' );
        wp_enqueue_script( 'magnific-popup' );
        wp_enqueue_script( 'isotope-pkgd' );
    }

    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'        => 'all',
                'label'     => __( 'All Items Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'     => 'All',
            ),
            array(
                'mode'  => 'section_end'
            ),

            // Style Tab

            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Typography', 'eikra-core' ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'button_typo',
                'label'   => esc_html__( 'Button', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .isotop-btn a',
                 
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
                'id'      => 'button_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a' => 'color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_border_color',
                'label'   => __( 'Button Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a' => 'border-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a:hover' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .isotop-btn .current' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a:hover' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .isotop-btn .current' => 'color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_border_color',
                'label'   => __( 'Button Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .isotop-btn a:hover' => 'border-color: {{VALUE}} !important',
                    '{{WRAPPER}} .isotop-btn .current' => 'border-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'item_hover_overlay',
                'label'   => __( 'Overlay Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-gallery-1 .rt-gallery-wrapper .rt-gallery-box:before' => 'background: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'zoom_icon_bg',
                'label'   => __( 'Zoom Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-gallery-1 .rt-gallery-wrapper .rt-gallery-box .rt-gallery-content a' => 'background-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'zoom_icon_color',
                'label'   => __( 'Zoom Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-gallery-1 .rt-gallery-wrapper .rt-gallery-box .rt-gallery-content a i' => 'color: {{VALUE}} !important',
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

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
