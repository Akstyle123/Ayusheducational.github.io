<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

if ( ! class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

/*-------------------------------------
#. Page Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( [ 'fields' => 'id=>name' ] );
$nav_menus = [ 'default' => __( 'Default', 'eikra-core' ) ] + $nav_menus;
$sidebars  = [ 'default' => __( 'Default', 'eikra-core' ) ] + RDTheme_Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( 'page_settings', __( 'Layout Settings', 'eikra-core' ), [ 'page', 'post', 'ac_research', 'ac_event' ], '', '', 'high', [
	'fields' => [
		'eikra_layout'         => [
			'label'   => __( 'Layout', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default'       => __( 'Default', 'eikra-core' ),
				'full-width'    => __( 'Full Width', 'eikra-core' ),
				'left-sidebar'  => __( 'Left Sidebar', 'eikra-core' ),
				'right-sidebar' => __( 'Right Sidebar', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_sidebar'        => [
			'label'   => __( 'Custom Sidebar', 'eikra-core' ),
			'type'    => 'select',
			'options' => $sidebars,
			'default' => 'default',
		],
		'eikra_page_menu'      => [
			'label'   => __( 'Main Menu', 'eikra-core' ),
			'type'    => 'select',
			'options' => $nav_menus,
			'default' => 'default',
		],
		'eikra_tr_header'      => [
			'label'   => __( 'Transparent Header', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'on'      => __( 'Enabled', 'eikra-core' ),
				'off'     => __( 'Disabled', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_top_bar'        => [
			'label'   => __( 'Top Bar', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'on'      => __( 'Enabled', 'eikra-core' ),
				'off'     => __( 'Disabled', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_top_bar_style'  => [
			'label'   => __( 'Top Bar Layout', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'1'       => __( 'Layout 1', 'eikra-core' ),
				'2'       => __( 'Layout 2', 'eikra-core' ),
				'3'       => __( 'Layout 3', 'eikra-core' ),
				'4'       => __( 'Layout 4', 'eikra-core' ),
				'5'       => __( 'Layout 5', 'eikra-core' ),
				'6'       => __( 'Layout 6', 'eikra-core' ),
				'7'       => __( 'Layout 7', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_header'         => [
			'label'   => __( 'Header Layout', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'1'       => __( 'Layout 1', 'eikra-core' ),
				'2'       => __( 'Layout 2', 'eikra-core' ),
				'3'       => __( 'Layout 3', 'eikra-core' ),
				'4'       => __( 'Layout 4', 'eikra-core' ),
				'5'       => __( 'Layout 5', 'eikra-core' ),
				'6'       => __( 'Layout 6', 'eikra-core' ),
				'7'       => __( 'Layout 7', 'eikra-core' ),
				'8'       => __( 'Layout 8', 'eikra-core' ),
				'9'       => __( 'Layout 9', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_top_padding'    => [
			'label'   => __( 'Content Padding Top', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'0px'     => __( '0px', 'eikra-core' ),
				'10px'    => __( '10px', 'eikra-core' ),
				'20px'    => __( '20px', 'eikra-core' ),
				'30px'    => __( '30px', 'eikra-core' ),
				'40px'    => __( '40px', 'eikra-core' ),
				'50px'    => __( '50px', 'eikra-core' ),
				'60px'    => __( '60px', 'eikra-core' ),
				'70px'    => __( '70px', 'eikra-core' ),
				'80px'    => __( '80px', 'eikra-core' ),
				'90px'    => __( '90px', 'eikra-core' ),
				'100px'   => __( '100px', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_bottom_padding' => [
			'label'   => __( 'Content Padding Bottom', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'0px'     => __( '0px', 'eikra-core' ),
				'10px'    => __( '10px', 'eikra-core' ),
				'20px'    => __( '20px', 'eikra-core' ),
				'30px'    => __( '30px', 'eikra-core' ),
				'40px'    => __( '40px', 'eikra-core' ),
				'50px'    => __( '50px', 'eikra-core' ),
				'60px'    => __( '60px', 'eikra-core' ),
				'70px'    => __( '70px', 'eikra-core' ),
				'80px'    => __( '80px', 'eikra-core' ),
				'90px'    => __( '90px', 'eikra-core' ),
				'100px'   => __( '100px', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_banner'         => [
			'label'   => __( 'Banner', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'on'      => __( 'Enable', 'eikra-core' ),
				'off'     => __( 'Disable', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_breadcrumb'     => [
			'label'   => __( 'Breadcrumb', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'on'      => __( 'Enable', 'eikra-core' ),
				'off'     => __( 'Disable', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_banner_type'    => [
			'label'   => __( 'Banner Background Type', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'bgimg'   => __( 'Background Image', 'eikra-core' ),
				'bgcolor' => __( 'Background Color', 'eikra-core' ),
			],
			'default' => 'default',
		],
		'eikra_banner_bgimg'   => [
			'label' => __( 'Banner Background Image', 'eikra-core' ),
			'type'  => 'image',
			'desc'  => __( 'If not selected, default will be used', 'eikra-core' ),
		],
		'eikra_banner_bgcolor' => [
			'label' => __( 'Banner Background Color', 'eikra-core' ),
			'type'  => 'color_picker',
			'desc'  => __( 'If not selected, default will be used', 'eikra-core' ),
		],
		'eikra_footer'         => [
			'label'   => __( 'Footer Layout', 'eikra-core' ),
			'type'    => 'select',
			'options' => [
				'default' => __( 'Default', 'eikra-core' ),
				'1'       => __( 'Layout 1', 'eikra-core' ),
				'2'       => __( 'Layout 2', 'eikra-core' ),
			],
			'default' => 'default',
		],
	],
] );

/////////////////
// Testimonial //
/////////////////
$Postmeta->add_meta_box( 'testimonial_info',
	__( 'Testimonial Information', 'eikra-core' ), [ 'ac_testimonial' ], '', '', 'high', [
		'fields' => [
			'ac_testimonial_designation' => [
				'label'   => __( 'Designation', 'eikra-core' ),
				'type'    => 'text',
				'default' => '',
			],
		],
	]
);

/////////////////
//	 Event 	   //
/////////////////
$time_picker_format = ( RDTheme::$options['event_time_format'] == '12' ) ? 'time_picker' : 'time_picker_24';
$Postmeta->add_meta_box( 'event_info',
	__( 'Event Information', 'eikra-core' ), [ 'ac_event' ], '', '', 'high', [
		'fields' => [
			'ac_event_start_date'  => [
				'label'   => __( 'Start Date', 'eikra-core' ),
				'type'    => 'date_picker',
				'default' => '',
			],
			'ac_event_start_time'  => [
				'label'   => __( 'Start Time', 'eikra-core' ),
				'type'    => $time_picker_format,
				'default' => '',
			],
			'ac_event_end_date'    => [
				'label'   => __( 'End Date', 'eikra-core' ),
				'type'    => 'date_picker',
				'default' => '',
			],
			'ac_event_end_time'    => [
				'label'   => __( 'End Time', 'eikra-core' ),
				'type'    => $time_picker_format,
				'default' => '',
			],
			'ac_event_participant' => [
				'label'   => __( 'Nubmer of Participants', 'eikra-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'ac_event_location'    => [
				'label'   => __( 'Location', 'eikra-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'ac_event_map'         => [
				'label'   => __( 'Google Map', 'eikra-core' ),
				'type'    => 'textarea_html',
				'default' => '',
				'desc'    => sprintf( __( 'To create your own google map, follow the steps below:<br/>Step 1: Visit %s<br/>Step 2: Search for a location using the search bar of the top-left corner<br/>Step 3: After you find the location, click on the "Share" icon from the left panel<br/>Step 4: A popup will come up. From there go to the "Embed map" tab. You will find your Google Map code. Copy and paste this code in here',
					'eikra-core' ), '<a href="https://www.google.com/maps" target="_blank">https://www.google.com/maps</a>' ),
			],
			'ac_event_link'        => [
				'label'   => __( 'Website', 'eikra-core' ),
				'type'    => 'text',
				'default' => '',
			],
		],
	]
);

$event_socials = [
	'facebook'  => [
		'label' => __( 'Facebook', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-facebook-f',
	],
	'twitter'   => [
		'label' => __( 'Twitter', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-twitter',
	],
	'linkedin'  => [
		'label' => __( 'Linkedin', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-linkedin-in',
	],
	'gplus'     => [
		'label' => __( 'Google Plus', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-google-plus-g',
	],
	'youtube'   => [
		'label' => __( 'Youtube', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-youtube',
	],
	'pinterest' => [
		'label' => __( 'Pinterest', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-pinterest-p',
	],
	'instagram' => [
		'label' => __( 'Instagram', 'eikra-core' ),
		'type'  => 'text',
		'icon'  => 'fab fa-instagram',
	],
];

$event_socials          = apply_filters( 'event_socials', $event_socials );
RDTheme::$event_socials = $event_socials;

$Postmeta->add_meta_box( 'event_socials', __( 'Event Socials', 'eikra-core' ), [ 'ac_event' ], '', '', 'high', [
		'fields' => [
			'ac_event_socials_header' => [
				'label' => __( 'Socials', 'eikra-core' ),
				'type'  => 'header',
				'desc'  => __( "Put your Event's Social links here", 'eikra-core' ),
			],
			'ac_event_socials'        => [
				'type'  => 'group',
				'value' => $event_socials,
			],
		],
	]
);

/*-------------------------------------
#. Instructors
---------------------------------------*/
if ( ! RDTheme_Helper::is_LMS() ) {
	$Postmeta->add_meta_box( 'instructor_settings', __( 'Instructor Settings', 'eikra-core' ), [ 'lp_instructor' ], '', '', 'high', [
		'fields' => [
			'ac_instructor_designation'    => [
				'label' => __( 'Designation', 'eikra-core' ),
				'type'  => 'text',
			],
			'ac_instructor_socials_header' => [
				'label' => __( 'Socials', 'eikra-core' ),
				'type'  => 'header',
				'desc'  => __( 'Put your social links here', 'eikra-core' ),
			],
			'ac_instructor_socials'        => [
				'type'  => 'group',
				'value' => RDTheme_Helper::instructor_socials(),
			],
		],
	] );
}
