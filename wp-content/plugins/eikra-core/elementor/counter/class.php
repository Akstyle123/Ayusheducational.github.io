<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Counter extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Counter', 'eikra-core' );
        $this->rt_base  = 'rt-counter';
        parent::__construct( $data, $args );
    }

    private function rt_load_scripts(){
        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'counterup' );
    }

    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'PROFESSIONAL TEACHER',
            ),
            array(
                'id'        => 'counter_no',
                'label'     => __( 'Counter Number', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 50,
            ),
            array(
                'id'        => 'counter_speed',
                'label'     => __( 'Counter Speed', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
            ),
            array(
                'id'        => 'counter_steps',
                'label'     => __( 'Counter Steps', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 10,
            ),
            array(
                'id'       => 'counter_width',
                'label'    => __( 'Width', 'eikra-core' ),
                'type'     => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
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
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-counter' => 'max-width: {{SIZE}}{{UNIT}};',
                ),
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
                'mode'      => 'group',
                'type'      => Group_Control_Typography::get_type(),
                'id'        => 'title_typo',
                'label'     => esc_html__( 'Title Style', 'eikra-core' ),
                'selector'  => '{{WRAPPER}} .rtin-title',
            ),
            array (
                'mode'      => 'group',
                'type'      => Group_Control_Typography::get_type(),
                'id'        => 'counter_typo',
                'label'     => esc_html__( 'Counter Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-counter',
                 
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
                    '{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'counter_color',
                'label'   => __( 'Counter Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-counter' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'seperator_color',
                'label'   => __( 'Line Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-counter .rtin-left .rtin-counter' => 'border-bottom-color: {{VALUE}}',
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
