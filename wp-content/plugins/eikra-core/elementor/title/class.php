<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Section Title', 'eikra-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'eikra-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => __( 'Style', 'eikra-core' ),
				'options' => array(
					'style1' => __( 'Style 1', 'eikra-core' ),
					'style2' => __( 'Style 2', 'eikra-core' ),
					'style3' => __( 'Style 3', 'eikra-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => __( 'Title', 'eikra-core' ),
				'default' => 'Lorem Ipsum',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'subtitle',
				'label'   => __( 'Subtitle', 'eikra-core' ),
				'default' => 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry',
			),
			array(
				'mode' => 'section_end',
			),

			// Style Tab
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general_style',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'General', 'eikra-core' ),
            ),
            array(
                'id'       => 'content_width',
                'label'    => __( 'Subtitle Width', 'eikra-core' ),
                'type'     => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
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
                'selectors' => array(
                    '{{WRAPPER}} .rtin-subtitle' => 'max-width: {{SIZE}}{{UNIT}};',
                ),
            ),
            array(
                'id'            => 'subtitle_margin',
                'label'         => __( 'Subtitle Margin', 'eikra-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rtin-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            array(
                'id'        => 'title_align',
                'label'     => __( 'Alignment', 'eikra-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'  => [
                        'title'     => __( 'Left', 'eikra-core' ),
                        'icon'      => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title'     => __( 'Center', 'eikra-core' ),
                        'icon'      => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title'     => __( 'Right', 'eikra-core' ),
                        'icon'      => 'fas fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ),
            array(
                'mode' => 'section_end',
            ),
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_typography',
                'tab'     => Controls_Manager::TAB_STYLE,
                'label'   => __( 'Typography', 'eikra-core' ),
            ),
            array(
                'mode'     => 'group',
                'type'     => \Elementor\Group_Control_Typography::get_type(),
                'id'       => 'title_typo',
                'label'    => __( 'Title', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-vc-title h2',
            ),
            array(
                'mode'     => 'group',
                'type'     => \Elementor\Group_Control_Typography::get_type(),
                'id'       => 'subtitle_typo',
                'label'    => __( 'Subtitle', 'eikra-core' ),
                'selector' => '{{WRAPPER}} .rt-vc-title .rtin-subtitle',
            ),
            array(
                'mode' => 'section_end',
            ),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'tab'     => Controls_Manager::TAB_STYLE,
				'label'   => __( 'Style', 'eikra-core' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => __( 'Title Color', 'eikra-core' ),
				'selectors' => array( '{{WRAPPER}} .rt-vc-title h2' => 'color: {{VALUE}}' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => __( 'Subtitle Color', 'eikra-core' ),
				'selectors' => array( '{{WRAPPER}} .rt-vc-title .rtin-subtitle' => 'color: {{VALUE}}' ),
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