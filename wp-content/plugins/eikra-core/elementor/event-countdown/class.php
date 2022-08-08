<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Event_Countdown extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Event Countdown', 'eikra-core' );
        $this->rt_base  = 'rt-event-countdown';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_script( 'js-countdown' );
    }

    public function rt_fields() {

        $args = array(
            'post_type'           => 'ac_event',
            'posts_per_page'      => -1,
            'suppress_filters'    => false,
            'ignore_sticky_posts' => 1,
        );

        $posts_array = get_posts( $args );

        if( !empty( $posts_array ) ){
            foreach ( $posts_array as $post ) {
                $post_dropdown[$post->ID] = $post->post_title;
            }
            $this->event_id = $posts_array[0]->ID;
        }
        else {
            $post_dropdown = $this->event_id = '';
        }

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
                'id'    => 'event_id',
                'label' => __( 'Event', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => $post_dropdown,
                'default'   => $this->event_id,
            ),
            array(
                'id'        => 'title_type',
                'label'     => __( 'Title Type', 'eikra-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'options'   => array(
                    'event'     => __( 'Same as Event', 'eikra-core' ),
                    'custom'    => __( 'Custom Title', 'eikra-core'),
                ),
                'default'   => 'event',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Custom Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'condition'   => array( 'title_type' => array( 'custom') ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'btn_display',
                'label'       => esc_html__( 'Button Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
            ),
            array(
                'type'        => Controls_Manager::TEXT,
                'id'          => 'btn_text',
                'label'       => esc_html__( 'Button Text', 'eikra-core' ),
                'default'     => 'JOIN WITH US',
                'condition'   => array(
                    'btn_display'   => array( 'yes'),
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
                'label'   => __( 'Typography', 'eikra-core' ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'title_typo',
                'label'   => esc_html__( 'Title', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-content h2',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'date_typo',
                'label'   => esc_html__( 'Date', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-content h3',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'button_typo',
                'label'   => esc_html__( 'Button', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-content a',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'number_typo',
                'label'   => esc_html__( 'Number', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-event-countdown .rt-date .rtin-count',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'text_typo',
                'label'   => esc_html__( 'Text', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-text',
                 
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
                    '{{WRAPPER}} .rt-event-countdown .rt-content h2' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'date_color',
                'label'   => __( 'Date Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-event-countdown .rt-content h3' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'count_color',
                'label'   => __( 'Number Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-count' => 'color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'dot_color',
                'label'   => __( 'Colon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .countdown-colon' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'text_color',
                'label'   => __( 'Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-text' => 'color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rdtheme-button-6' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rdtheme-button-5' => 'background-color: {{VALUE}}',
                ),
                'condition'   => array( 'btn_display' => array('yes') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rdtheme-button-6' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rdtheme-button-5' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'btn_display' => array('yes') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rdtheme-button-6:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rdtheme-button-5:hover' => 'background-color: {{VALUE}}',
                ),
                'condition'   => array( 'btn_display' => array('yes') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rdtheme-button-6:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rdtheme-button-5:hover' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'btn_display' => array('yes') ),
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
