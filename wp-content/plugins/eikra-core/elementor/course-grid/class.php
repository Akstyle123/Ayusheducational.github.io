<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Course_Grid extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Course Grid', 'eikra-core' );
        $this->rt_base  = 'rt-course-grid';
        parent::__construct( $data, $args );
    }

    public function rt_load_scripts(){
        wp_enqueue_style( 'course-review' );
        wp_enqueue_style( 'dashicons' );
    }

    public function rt_fields() {

        $terms = get_terms( array('taxonomy' => 'course_category' ) );
        $category_dropdown = array( '0' => __( 'All Categories', 'eikra-core' ) );
        foreach ( $terms as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }

        $orderby = array(
            'date'          => __( 'Date (Recents comes first)', 'eikra-core' ),
            'title'         =>  __( 'Title', 'eikra-core' ),
            'menu_order'    => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ),
        );

        if ( RDTheme_Helper::is_LMS() ) {
            $orderby['popularity'] = __( 'Popularity (Based on enrolled students)', 'eikra-core' );
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
                    '1'   => __( 'Style 1', 'eikra-core' ),
                    '2'   => __( 'Style 2', 'eikra-core'),
                    '3'   => __( 'Style 3', 'eikra-core'),
                    '4'   => __( 'Style 4', 'eikra-core'),
                ),
                'default'   => '1',
            ),
            array(
                'id'        => 'cat',
                'label'     => __( 'Categories', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $category_dropdown,
                'default'   => '0',
            ),
            array(
                'id'        => 'item_no',
                'label'     => __( 'Items Per Page', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 8,
                'description' => __( 'Write -1 to show all', 'eikra-core' ),
            ),
            array(
                'id'        => 'orderby',
                'label'     => __( 'Order by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $orderby,
                'default'   => 'date',
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'pagination',
                'label'       => esc_html__( 'Pagination', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
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
                 
                'condition'   => array( 'style' => array('1', '2', '3') ),
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
                'condition'   => array( 'style' => array('1') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'author_text_color',
                'label'   => __( 'Author Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-author a' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1', '2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-description' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('1', '2', '3') ),
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
                'condition'   => array( 'style' => array('1', '2', '3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'rating_color',
                'label'   => __( 'Rating Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .review-stars-rated .review-stars.filled' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .review-stars-rated .review-stars.empty' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'others_icon_color',
                'label'   => __( 'Others Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .rtin-meta .rtin-enrolled' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta span' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta i' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .rtin-meta .rt-wishlist-icon span:before' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'pagination_bg',
                'label'   => __( 'Pagination Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .pagination-area ul li a' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'pagination_color',
                'label'   => __( 'Pagination Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .pagination-area ul li a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'pagination_hover_bg',
                'label'   => __( 'Pagination Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .pagination-area ul li a:hover' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}}  .pagination-area ul li.active a' => 'background-color: {{VALUE}} !important',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'pagination_hover_color',
                'label'   => __( 'Pagination Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}}  .pagination-area ul li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .pagination-area ul li.active a' => 'color: {{VALUE}}',
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

//        if ( RDTheme_Helper::is_LMS() && $data['orderby'] == 'popularity' ) {
//            $orderby = 'date';
//        }

        $template = 'view';

        return $this->rt_template( $template, $data );
    }

}
