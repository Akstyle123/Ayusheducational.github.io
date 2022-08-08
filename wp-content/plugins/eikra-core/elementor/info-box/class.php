<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Info_Box extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Info Box', 'eikra-core' );
        $this->rt_base  = 'rt-info-box';
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
                'id'    => 'layout',
                'label' => __( 'Layout', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    'layout2'   => __( 'Layout 1', 'eikra-core' ),
                    'layout3'   => __( 'Layout 2', 'eikra-core'),
                    'layout4'   => __( 'Layout 3', 'eikra-core'),
                    'layout5'   => __( 'Layout 4', 'eikra-core'),
                    'layout6'   => __( 'Layout 5', 'eikra-core'),
                ),
                'default'   => 'layout2',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Lorem Ipsum'
            ),
            array(
                'id'        => 'description',
                'label'     => __( 'Description', 'eikra-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'condition'   => array( 'layout' => array( 'layout2', 'layout3', 'layout5', 'layout6' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),
            array(
                'mode'  => 'section_start',
                'id'    => 'section_icon',
                'label' => __( 'Icon', 'eikra-core'),
            ),
            array(
                'id'    => 'icon_type',
                'label' => __( 'Icon Type', 'eikra-core' ),
                'type'  =>  Controls_Manager::SELECT,
                'options'   => array(
                    'icon'  => __( 'Icon', 'eikra-core' ),
                    'image' => __( 'Custom Image', 'eikra-core'),
                ),
                'default'   => 'icon',
            ),
            array(
                'type'    => Controls_Manager::ICON,
                'id'      => 'icon',
                'label'   => __( 'Icon', 'eikra-core' ),
                'default' => 'fas fa-rocket',
                'condition'   => array( 'icon_type' => array( 'icon' ) ),
            ),
            array(
                'type'    => Controls_Manager::SELECT,
                'id'      => 'icon_style',
                'label'   => __( 'Icon Style', 'eikra-core' ),
                'options'   => array(
                    'rounded'  => __( 'Rounded', 'eikra-core' ),
                    'sqare' => __( 'Square', 'eikra-core'),
                ),
                'default'   => 'rounded',
                'condition' => array(
                    'layout'    => array( 'layout1', 'layout2', 'layout3', 'layout4' ),
                    'icon_type' => array( 'icon' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::MEDIA,
                'id'      => 'image',
                'label'   => __( 'Image', 'eikra-core' ),
                'condition'   => array( 'icon_type' => array( 'image' ) ),
                'description' => __( 'Recommended image size is 160x160 px.<br/>You can upload SVG format as well, to get SVG images click here: <a target="_blank" href="https://www.flaticon.com/">flaticon.com</a>', 'eikra-core' ),
            ),
            array(
                'mode'  => 'section_end'
            ),
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
                'selector' => '{{WRAPPER}} .info-box-title',
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .info-box-subtitle',
                'condition'   => array( 'layout' => array( 'layout2', 'layout3', 'layout5', 'layout6' ) ),
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
                    '{{WRAPPER}} .rt-info-box' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'id'      => 'icon_padding',
                'label' => __( 'Icon Padding', 'eikra-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rtin-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'   => array( 'layout' => array( 'layout3' ) ),
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
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-info-box' => 'background-color: {{VALUE}}' ),
                'condition'   => array( 'layout' => array( 'layout4', 'layout5' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_hover_bg',
                'label'   => __( 'Box Hover Background', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-info-box:hover' => 'background-color: {{VALUE}}' ),
                'condition'   => array( 'layout' => array( 'layout4', 'layout5' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box .media-heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box:hover .media-heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-infobox-6:hover .rtin-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rtin-subtitle' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'layout' => array( 'layout2', 'layout3', 'layout5', 'layout6' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_bg',
                'label'   => __( 'Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box .rtin-icon i' => 'background-color: {{VALUE}}',
                ),
                'condition'   => array( 'layout' => array( 'layout3', 'layout4' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_color',
                'label'   => __( 'Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box .rtin-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rtin-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-info-box.layout5 .rtin-icon svg' => 'fill: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_bg',
                'label'   => __( 'Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box:hover .rtin-icon i' => 'background-color: {{VALUE}}',
                ),
                'condition'   => array( 'layout' => array( 'layout3', 'layout4' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_hover_color',
                'label'   => __( 'Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-info-box:hover .rtin-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-infobox-6:hover .rtin-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-info-box.layout5 .rtin-icon svg' => 'fill: {{VALUE}}',
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

        if ($data['layout'] == 'layout6') {
            $template = 'view-2';
        } else {
            $template = 'view-1';
        }

        return $this->rt_template( $template, $data );
    }

}
