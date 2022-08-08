<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Contact_Info extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Contact Info', 'eikra-core' );
        $this->rt_base  = 'rt-contact-info';
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
                'id'        => 'address',
                'label'     => __( 'Address', 'eikra-core' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => 'PO Box 1212, California, US',
            ),
            array(
                'id'        => 'email',
                'label'     => __( 'Email', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'example@example.com'
            ),
            array(
                'id'        => 'phone',
                'label'     => __( 'Phone', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'social_display',
                'label'       => esc_html__( 'Social Icon Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Show or Hide Social Icon. Default: On', 'eikra-core' ),
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
                'id'    => 'contact_title_typo',
                'label'   => esc_html__( 'Contact Title', 'eikra-core' ),
                'selector' => '{{WRAPPER}} ul.rtin-item > li > h3',
                 
                'condition' => array(
                    'style'    => array( 'style1' ),
                ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'contact_typo',
                'label'   => esc_html__( 'Contact', 'eikra-core' ),
                'selector' => '{{WRAPPER}} ul.rtin-item > li > .contact-content',
                 
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
                'id'      => 'contact_title_color',
                'label'   => __( 'Contact Title Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} ul.rtin-item > li > h3' => 'color: {{VALUE}}' ),
                'condition' => array(
                    'style'    => array( 'style1' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'contact_border_color',
                'label'   => __( 'Border Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} ul.rtin-item>li' => 'border-color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'contact_color',
                'label'   => __( 'Contact Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li > .contact-content' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'contact_icon_color',
                'label'   => __( 'Contact Icon Color', 'eikra-core' ),
                'selectors' => array( '{{WRAPPER}} ul.rtin-item > li > i' => 'color: {{VALUE}}' ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_bg',
                'label'   => __( 'Social Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_border_color',
                'label'   => __( 'Social Icon Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_color',
                'label'   => __( 'Social Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_bg',
                'label'   => __( 'Social Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a:hover' => 'background-color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_border_color',
                'label'   => __( 'Social Icon Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a:hover' => 'border-color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_color',
                'label'   => __( 'Social Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} ul.rtin-item > li .contact-social li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} ul.rtin-item > li.rtin-social-wrap .rtin-social li a:hover' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'social_display'    => array( 'yes' ),
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
