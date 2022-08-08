<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Countdown extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Countdown', 'eikra-core' );
        $this->rt_base  = 'rt-countdown';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_script( 'js-countdown' );
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
                'id'        => 'title1',
                'label'     => __( 'Title 1', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
            ),
            array(
                'id'        => 'title2',
                'label'     => __( 'Title 2', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
            ),
            array(
                'id'        => 'date_time',
                'label'     => __( 'Date & Time', 'eikra-core' ),
                'type'      => Controls_Manager::DATE_TIME,
                'description'   => __('Set date and time', 'eikra-core'),
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
                'id'    => 'title1_typo',
                'label'   => esc_html__( 'Title 1', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-countdown .rtin-title1',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'title2_typo',
                'label'   => esc_html__( 'Title 2', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-countdown .rtin-title2',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'number_typo',
                'label'   => esc_html__( 'Number', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-countdown .rt-date .rtin-count',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'text_typo',
                'label'   => esc_html__( 'Text', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-countdown .rt-date .rtin-text',
                 
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
                'id'      => 'title1_color',
                'label'   => __( 'Title 1 Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-countdown .rtin-title1' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title2_color',
                'label'   => __( 'Title 2 Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-countdown .rtin-title2' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'count_color',
                'label'   => __( 'Number Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-countdown .rt-date .rtin-count' => 'color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_border_color',
                'label'   => __( 'Box Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-countdown .rt-date > div' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'text_color',
                'label'   => __( 'Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-countdown .rt-date .rtin-text' => 'color: {{VALUE}} !important',
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
