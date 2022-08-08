<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class CTA extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Call to Action', 'eikra-core' );
        $this->rt_base  = 'rt-cta';
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
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Join 29,12,093 Students.'
            ),
            array(
                'type'    => Controls_Manager::MEDIA,
                'id'      => 'image',
                'label'   => __( 'Image', 'eikra-core' ),
                'description' => __( 'Recommended image size is 819x300 px.', 'eikra-core' ),
            ),
            array(
                'type'    => Controls_Manager::TEXT,
                'id'      => 'buttontext',
                'label'   => esc_html__( 'Button Text', 'eikra-core' ),
                'default' => 'Join Now',
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
                'placeholder' => __('https://example.com', 'eikra-core'),
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
                'selector' => '{{WRAPPER}} .rt-vc-cta .rtin-right h2',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'btn_typo',
                'label'   => esc_html__( 'Button', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-btn',
                 
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
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-right' => 'background-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-cta .rtin-right h2' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_border_color',
                'label'   => __( 'Button Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn' => 'border-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn:hover' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_border_color',
                'label'   => __( 'Button Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn:hover' => 'border-color: {{VALUE}}',
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
