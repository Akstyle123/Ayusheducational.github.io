<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Instructor_Grid extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Instructor Grid', 'eikra-core' );
        $this->rt_base  = 'rt-instructor-grid';
        parent::__construct( $data, $args );
    }

    public function rt_fields() {

        $users_dropdown = array();

        if ( RDTheme_Helper::is_LMS() ) {
            $users = get_users( array( 'role' => LP_TEACHER_ROLE, 'number' => -1, 'orderby' => 'display_name','order' => 'ASC','fields' => array( 'ID', 'display_name' ) ) );

            foreach ( $users as $user ) {
                $users_dropdown[$user->display_name] = $user->ID;
            }

            if ( !empty( $users[0] ) ) {
                $this->item = $users[0]->ID;
            }

            $orderby = array(
                'display_name' => __( 'Name', 'eikra-core' ),
                'id_asc' => __( 'ID (Ascending)', 'eikra-core' ),
                'id_dsc' => __( 'ID (Descending)', 'eikra-core' ),
                'custom_order' => __( 'Custom Order', 'eikra-core' ),
            );
            $orderby_std = 'id_dsc';
        }
        else {
            $args = array(
                'post_type'           => 'lp_instructor',
                'posts_per_page'      => -1,
                'suppress_filters'    => false,
                'ignore_sticky_posts' => 1,
                'orderby'             => 'title',
                'order'               => 'ASC',
                'post_status'         => 'publish'
            );

            $posts = get_posts( $args );
            foreach ( $posts as $post ) {
                $users_dropdown[$post->ID] = $post->post_title;
            }

            if ( !empty( $posts[0] ) ) {
                $this->item = $posts[0]->ID;
            }

            $orderby = array(
                'date'  => __( 'Date (Recents comes first)', 'eikra-core' ),
                'title' =>  __( 'Title', 'eikra-core' ),
                'menu_order' => __( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ),
            );
            $orderby_std = 'date';

            $terms = get_terms( array('taxonomy' => 'instructor_category' ) );
            $category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
            foreach ( $terms as $category ) {
                $category_dropdown[$category->name] = $category->term_id;
            }
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
                    'style1'   => __( 'Style 1', 'eikra-core' ),
                    'style2'   => __( 'Style 2', 'eikra-core'),
                    'style3'   => __( 'Style 3', 'eikra-core'),
                ),
                'default'   => 'style1',
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
                'default'   => $orderby_std,
                'condition'   => array( 'style' => array( 'style1', 'style2' ) ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'pagination',
                'label'       => esc_html__( 'Pagination Display', 'eikra-core' ),
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
                'id'    => 'name_typo',
                'label'   => esc_html__( 'Name Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-title',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'designation_typo',
                'label'   => esc_html__( 'Designation Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-designation',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content Style', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-description',
                'condition'   => array( 'style' => array('style2') ),
                 
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
                'selectors' => array(
                    '{{WRAPPER}} .rtin-description' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'condition'   => array( 'style' => array('style2') ),
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
                'id'      => 'name_color',
                'label'   => __( 'Name Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'name_hover_color',
                'label'   => __( 'Name Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-title a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'designation_color',
                'label'   => __( 'Designation Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-designation' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_bg',
                'label'   => __( 'Social Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_color',
                'label'   => __( 'Social Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_bg',
                'label'   => __( 'Social Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a:hover' => 'background: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_color',
                'label'   => __( 'Social Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_border_color',
                'label'   => __( 'Social Icon Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_border_color',
                'label'   => __( 'Social Icon Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-social li a:hover' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-description' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'box_bg',
                'label'   => __( 'Box Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-5 .rtin-item' => 'background-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
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

    public function alter_query_orderby( $class ){
        global $wpdb;
        $class->query_orderby = "ORDER BY {$wpdb->usermeta}.meta_value+0 ASC";
    }

    public function user_custom_ordering(){
        add_action( 'pre_user_query', array( $this, 'alter_query_orderby' ) );
    }

    protected function render() {
        $data = $this->get_settings();

        switch ( $data['style'] ) {
            case 'style3':
                $template = 'view-3';
                break;
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
