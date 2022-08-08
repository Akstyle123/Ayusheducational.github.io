<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Image_Text_Box extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Image Text Box', 'eikra-core' );
        $this->rt_base  = 'rt-image-text-box';
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
                    'style1'   => __( 'Style 1', 'eikra-core' ),
                    'style2'   => __( 'Style 2', 'eikra-core'),
                ),
                'default'   => 'style1',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Design'
            ),
            array(
                'id'        => 'subtitle',
                'label'     => __( 'Subtitle', 'eikra-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'condition' => array(
                    'style'    => array( 'style1' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::MEDIA,
                'id'      => 'image',
                'label'   => __( 'Image', 'eikra-core' ),
                'description' => __( 'Recommended image size<br/>Style-1: 380x150 px<br/>Style-2:350x350 px.', 'eikra-core' ),
            ),
            array(
                'type'  => Controls_Manager::URL,
                'id'    => 'link',
                'label' => esc_html__( 'Link (Optional)', 'eikra-core' ),
                'default' => [
                    'url' => '',
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
                'selector' => '{{WRAPPER}} .rtin-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'subtitle_typo',
                'label'   => esc_html__( 'Subtitle', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-subtitle',
                 
                'condition' => array(
                    'style'    => array( 'style1' ),
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
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-imagetext .rtin-item:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-imagetext-2 .rtin-img:before' => 'background-color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}' ),
                'selectors' => array( '{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}' ),
                'condition' => array(
                    'style'    => array( 'style2' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'subtitle_color',
                'label'   => __( 'Subtitle Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rtin-subtitle' => 'color: {{VALUE}}' ),
                'condition' => array(
                    'style'    => array( 'style1' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_border_color',
                'label'   => __( 'Icon Border Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-imagetext-2 .rtin-img a' => 'border-color: {{VALUE}}' ),
                'condition' => array(
                    'style'    => array( 'style2' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'icon_color',
                'label'   => __( 'Icon Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} .rt-vc-imagetext-2 .rtin-img a' => 'color: {{VALUE}}' ),
                'condition' => array(
                    'style'    => array( 'style2' ),
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

        switch ( $data['style'] ) {
            case 'style2':
                $template = 'view-2';
                break;
            default:
                $template = 'view-1';
                break;
        }

        return $this->rt_template( $template, $data );
    }

}
