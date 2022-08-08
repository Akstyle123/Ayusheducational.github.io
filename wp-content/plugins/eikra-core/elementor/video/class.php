<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Video extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Video', 'eikra-core' );
        $this->rt_base  = 'rt-video';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_style( 'magnific-popup' );
        wp_enqueue_script( 'magnific-popup' );
    }

    public function rt_fields() {

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'    => 'layout',
                'label' => __( 'Layout', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    'full'   => __( 'Full-Screen', 'eikra-core' ),
                    'half'   => __( 'Half-Screen', 'eikra-core'),
                ),
                'default'   => 'full',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Video Tour'
            ),
            array(
                'id'        => 'content',
                'label'     => __( 'Content', 'eikra-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'condition' => array(
                    'layout'    => array( 'full' ),
                ),
            ),
            array(
                'type'  => Controls_Manager::URL,
                'id'    => 'videourl',
                'label' => esc_html__( 'Video Link', 'eikra-core' ),
                'default' => [
                    'url' => '',
                ],
                'placeholder' => __('https://example.com', 'eikra-core'),
            ),
            array(
                'type'    => Controls_Manager::ICON,
                'id'      => 'icon',
                'label'   => __( 'Video Icon', 'eikra-core' ),
                'default' => 'fas fa-play',
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
                'selector' => '{{WRAPPER}} .rt-video-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'subtitle_typo',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-content',
                 
                'condition' => array(
                    'layout'    => array( 'full' ),
                ),
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
                'selectors' => array( '{{WRAPPER}} .rt-video-title' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'subtitle_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rtin-content' => 'color: {{VALUE}}' ),
                'condition' => array(
                    'layout'    => array( 'full' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_bg',
                'label'   => __( 'Icon Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn' => 'background-color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_border_color',
                'label'   => __( 'Icon Border Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn' => 'border-color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_color',
                'label'   => __( 'Icon Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_bg',
                'label'   => __( 'Icon Hover Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn:hover' => 'background-color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_border_color',
                'label'   => __( 'Icon Hover Border Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn:hover' => 'border-color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_color',
                'label'   => __( 'Icon Hover Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-video .rtin-item .rtin-btn:hover' => 'color: {{VALUE}}' ),
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

        switch ( $data['layout'] ) {
            case 'half':
                $template = 'view-2';
                break;
            default:
                $template = 'view-1';
                break;
        }

        return $this->rt_template( $template, $data );
    }

}
