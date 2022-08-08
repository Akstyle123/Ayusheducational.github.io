<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Core\Schemes\Typography;

if ( ! defined('ABSPATH' ) ) exit;

class Instructor_Slider extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ) {
        $this->rt_name  = __( 'Instructor Slider', 'eikra-core' );
        $this->rt_base  = 'rt-instructor-slider';
        $this->item = false;
        parent::__construct( $data, $args );
    }

    private function rt_load_scripts(){
        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-theme-default' );
        wp_enqueue_script( 'owl-carousel' );
    }

    public function rt_fields() {

        $users_dropdown = array();

        if ( RDTheme_Helper::is_LMS() ) {
            $users = get_users( array( 'role' => LP_TEACHER_ROLE, 'number' => -1, 'orderby' => 'display_name','order' => 'ASC','fields' => array( 'ID', 'display_name' ) ) );

            foreach ( $users as $user ) {
                $users_dropdown[$user->ID] = $user->display_name;
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
                    'style4'   => __( 'Style 4', 'eikra-core'),
                ),
                'default'   => 'style1',
            ),
            array(
                'id'        => 'title',
                'label'     => __( 'Section Title', 'eikra-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Our Skilled Instructors',
                'condition'   => array( 'style' => array( 'style1', 'style2', 'style4' ) ),
            ),
            array(
                'id'        => 'item_no',
                'label'     => __( 'Total number of items', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
                'description' => __( 'Write -1 to show all', 'eikra-core' ),
                'condition'   => array( 'style' => array( 'style1', 'style2', 'style4' ) ),
            ),
            array(
                'id'        => 'orderby',
                'label'     => __( 'Order by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $orderby,
                'default'   => $orderby_std,
                'condition'   => array( 'style' => array( 'style1', 'style2', 'style4' ) ),
            ),
            array(
                'id'        => 'orderby_alt',
                'label'     => __( 'Order by', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                    'name'  => __('Name', 'eikra-core'),
                    'custom'    => __('Custom', 'eikra-core'),
                ),
                'default'   => 'name',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'id'        => 'item1',
                'label'     => __( '1st Instructor', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $users_dropdown,
                'default'   => $this->item ? $this->item : '',
                'condition'   => array(
                    'style'         => array( 'style3' ),
                    'orderby_alt'   => array( 'custom' ),
                ),
            ),
            array(
                'id'        => 'item2',
                'label'     => __( '2nd Instructor', 'eikra-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $users_dropdown,
                'default'   => $this->item ? $this->item : '',
                'condition'   => array(
                    'style'         => array( 'style3' ),
                    'orderby_alt'   => array( 'custom' ),
                ),
            ),
            array(
                'id'        => 'limit',
                'label'     => __( 'Content Limit', 'eikra-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 25,
                'description' => __( 'Maximum number of words to display. Default: 25', 'eikra-core' ),
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'designation_display',
                'label'       => esc_html__( 'Designation Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'student_count_display',
                'label'       => esc_html__( 'Student Count Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'btn_display',
                'label'       => esc_html__( 'Button Display', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'no',
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'    => Controls_Manager::TEXT,
                'id'      => 'buttontext',
                'label'   => esc_html__( 'Button Text', 'eikra-core' ),
                'default' => 'BECOME AN INSTRUCTOR',
                'condition'   => array( 'btn_display' => array( 'yes' ) ),
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
                'placeholder' => 'https://your-link.com',
                'condition'   => array( 'btn_display' => array( 'yes' ) ),
            ),
            array(
                'mode'  => 'section_end'
            ),
            // Slider options
            array(
                'mode'        => 'section_start',
                'id'          => 'sec_slider',
                'label'       => esc_html__( 'Slider Options', 'eikra-core' ),
                'condition'   => array( 'style' => array( 'style1', 'style2', 'style4' ) ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_autoplay',
                'label'       => esc_html__( 'Autoplay', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => '',
                'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'eikra-core' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_stop_on_hover',
                'label'       => esc_html__( 'Stop on Hover', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Stop autoplay on mouse hover. Default: On', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'    => Controls_Manager::SELECT2,
                'id'      => 'slider_interval',
                'label'   => esc_html__( 'Autoplay Interval', 'eikra-core' ),
                'options' => array(
                    '5000' => esc_html__( '5 Seconds', 'eikra-core' ),
                    '4000' => esc_html__( '4 Seconds', 'eikra-core' ),
                    '3000' => esc_html__( '3 Seconds', 'eikra-core' ),
                    '2000' => esc_html__( '2 Seconds', 'eikra-core' ),
                    '1000' => esc_html__( '1 Second',  'eikra-core' ),
                ),
                'default' => '5000',
                'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'    => Controls_Manager::NUMBER,
                'id'      => 'slider_autoplay_speed',
                'label'   => esc_html__( 'Autoplay Slide Speed', 'eikra-core' ),
                'default' => 200,
                'description' => esc_html__( 'Slide speed in milliseconds. Default: 200', 'eikra-core' ),
                'condition'   => array( 'slider_autoplay' => 'yes' ),
            ),
            array(
                'type'        => Controls_Manager::SWITCHER,
                'id'          => 'slider_loop',
                'label'       => esc_html__( 'Loop', 'eikra-core' ),
                'label_on'    => esc_html__( 'On', 'eikra-core' ),
                'label_off'   => esc_html__( 'Off', 'eikra-core' ),
                'default'     => 'yes',
                'description' => esc_html__( 'Loop to first item. Default: On', 'eikra-core' ),
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
                'id'    => 'section_title_typo',
                'label'   => esc_html__( 'Section Title', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .owl-custom-nav-title',
                 
                'condition'   => array( 'style' => array('style1', 'style2', 'style4') ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'name_typo',
                'label'   => esc_html__( 'Name', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-title',
                 
                'condition'   => array( 'style' => array('style1', 'style2', 'style4') ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'name_style3_typo',
                'label'   => esc_html__( 'Name', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-name a',
                 
                'condition'   => array( 'style' => array('style3') ),
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'designation_typo',
                'label'   => esc_html__( 'Designation', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-designation',
                 
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'id'    => 'content_typo',
                'label'   => esc_html__( 'Content', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rtin-description',
                 
                'condition'   => array( 'style' => array( 'style2', 'style3' ) ),
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
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-description' => 'width: {{SIZE}}{{UNIT}};',
                ),
                'condition'   => array( 'style' => array( 'style2', 'style3' ) ),
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
                    '{{WRAPPER}} .owl-custom-nav-title' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style1', 'style2', 'style4') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'name_color',
                'label'   => __( 'Name Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-4 .rtin-item .rtin-content .rtin-title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-name a' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'name_hover_color',
                'label'   => __( 'Name Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-4 .rtin-item .rtin-content .rtin-title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-name a:hover' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'designation_color',
                'label'   => __( 'Designation Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-4 .rtin-item .rtin-content .rtin-designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item:hover .rtin-content .rtin-designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-designation' => 'color: {{VALUE}}',
                ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'content_color',
                'label'   => __( 'Content Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-description' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-description' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2', 'style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_bg',
                'label'   => __( 'Social Icon Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style1', 'style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_color',
                'label'   => __( 'Social Icon Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style1', 'style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_bg',
                'label'   => __( 'Social Icon Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a:hover' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style1', 'style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_color',
                'label'   => __( 'Social Icon Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a:hover' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style1', 'style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_border_color',
                'label'   => __( 'Social Icon Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'social_icon_hover_border_color',
                'label'   => __( 'Social Icon Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a:hover' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style2') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'seperator_color',
                'label'   => __( 'Seperator Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-4 .rtin-item .rtin-content:after' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style4') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'student_text_color',
                'label'   => __( 'Student Text Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-meta' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'student_count_color',
                'label'   => __( 'Student Count Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rt-vc-instructor-3 .rtin-item .rtin-meta span' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array( 'style3' ) ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_bg',
                'label'   => __( 'Button Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_color',
                'label'   => __( 'Button Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_border_color',
                'label'   => __( 'Button Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_bg',
                'label'   => __( 'Button Hover Background', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'background: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_color',
                'label'   => __( 'Button Hover Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
            ),
            array(
                'type'    => Controls_Manager::COLOR,
                'id'      => 'button_hover_border_color',
                'label'   => __( 'Button Hover Border Color', 'eikra-core' ),
                'selectors' => array(
                    '{{WRAPPER}} .rtin-btn a:hover' => 'border-color: {{VALUE}}',
                ),
                'condition'   => array( 'style' => array('style3') ),
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

        $owl_data = array(
            'nav'                => false,
            'dots'               => false,
            'autoplay'           => $data['slider_autoplay'] == 'yes' ? true : false,
            'autoplayTimeout'    => $data['slider_interval'],
            'autoplaySpeed'      => $data['slider_autoplay_speed'],
            'autoplayHoverPause' => $data['slider_stop_on_hover'] == 'yes' ? true : false,
            'loop'               => $data['slider_loop'] == 'yes' ? true : false,
            'margin'             => 20,
            'responsive'         => array(
                '0'    => array( 'items' => 2 ),
                '480'  => array( 'items' => 3 ),
                '768'  => array( 'items' => 3 ),
                '992'  => array( 'items' => 4 ),
            )
        );

        switch ( $data['style'] ) {
            case 'style4':
                $template = 'view-4';
                break;
            case 'style3':
                $template = 'view-3';
                break;
            case 'style2':
                $template = 'view-2';
                $owl_data['responsive'] = array(
                    '0'    => array( 'items' => 1 ),
                    '768'  => array( 'items' => 2 ),
                    '992'  => array( 'items' => 3 ),
                );
                break;
            default:
                $template = 'view-1';
                break;
        }

        $data['owl_data'] = json_encode( $owl_data );

        return $this->rt_template( $template, $data );
    }

}
