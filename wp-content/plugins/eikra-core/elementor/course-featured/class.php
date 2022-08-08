<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Course_Featured extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Featured Courses', 'eikra-core' );
        $this->rt_base  = 'rt-course-featured';
        parent::__construct( $data, $args );
    }

    public function rt_fields() {

        $terms = get_terms( array('taxonomy' => 'course_category' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'eikra-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $args = array(
            'post_type'           => 'lp_course',
            'posts_per_page'      => -1,
            'suppress_filters'    => false,
            'ignore_sticky_posts' => 1,
            'orderby'             => 'title',
            'order'               => 'ASC',
            'post_status'         => 'publish'
        );

        $posts = get_posts( $args );
        $posts_dropdown = array();
        foreach ( $posts as $post ) {
            $posts_dropdown[$post->ID] = $post->post_title;
        }

        $fields = array(
            array(
                'mode'  => 'section_start',
                'id'    => 'section_general',
                'label' => __( 'General', 'eikra-core' )
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Section Title', 'eikra-core' ),
                'type'      =>  Controls_Manager::TEXT,
                'default'   => 'Featured Course',
            ),
            array(
                'id'        => 'item',
                'label'     => __( 'Post', 'eikra-core' ),
                'type'      =>  Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => $posts_dropdown,
                'default'   => ''
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
                'selector' => '{{WRAPPER}} .rtin-content .rtin-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-content .rtin-description',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'price_typo',
                'label'   => esc_html__( 'Price Style', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins',
                ),
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'author_typo',
                'label'   => esc_html__( 'Author Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-author',
                 
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
                'id'      => 'section_title_color',
                'label'   => __( 'Section Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-sec-title' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_color',
                'label'   => __( 'Title Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'title_hover_color',
                'label'   => __( 'Title Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'author_icon_color',
                'label'   => __( 'Author Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-author i' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'author_text_color',
                'label'   => __( 'Author Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-author a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-description' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_text_color',
                'label'   => __( 'Price Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'price_bg_color',
                'label'   => __( 'Price Background Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-thumbnail .rtin-price' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rtin-meta .rtin-price ins' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'overlay_bg',
                'label'   => __( 'Overlay Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .rt-course-box .rtin-thumbnail::before' => 'background-color: {{VALUE}} !important',
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
