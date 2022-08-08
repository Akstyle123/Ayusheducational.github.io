<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Course_Search extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Course Search', 'eikra-core' );
        $this->rt_base  = 'rt-course-search';
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
                'id'    => 'title',
                'label' => __( 'Search Title', 'eikra-core' ),
                'type'  =>  Controls_Manager::TEXTAREA,
                'default'   => 'Find Your Preferred Courses',
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
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'title_typo',
                'label'   => esc_html__( 'Title Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-title',
                 
            ),
            array(
                'id'       => 'box_width',
                'label'    => __( 'Box Width', 'eikra-core' ),
                'type'     => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 980,
                        'step' => 10,
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
                    '{{WRAPPER}} .rt-vc-course-search .form-group' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
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
                'id'      => 'search_icon_color',
                'label'   => __( 'Search Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-submit-btn-wrap .rtin-submit-btn' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'search_icon_bg',
                'label'   => __( 'Search Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-submit-btn-wrap .rtin-submit-btn' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'search_icon_hover_color',
                'label'   => __( 'Search Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-submit-btn-wrap .rtin-submit-btn:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'search_icon_hover_bg',
                'label'   => __( 'Search Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-submit-btn-wrap .rtin-submit-btn:hover' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'input_box_bg',
                'label'   => __( 'Input Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group .input-group-addon' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .input-group-addon .rtin-searchtext' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'seperator_color',
                'label'   => __( 'Seperator Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-dropdown .rtin-sep' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'text_color',
                'label'   => __( 'Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-dropdown button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .input-group-addon.rtin-dropdown .dropdown-menu a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .input-group-addon .rtin-searchtext' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'text_hover_color',
                'label'   => __( 'Text Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .input-group-addon.rtin-dropdown .dropdown-menu a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_border_color',
                'label'   => __( 'Box Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-course-search .form-group' => 'border-color: {{VALUE}}',
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

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
