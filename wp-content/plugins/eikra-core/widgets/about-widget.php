<?php
/**
 * @author  RadiusTheme
 * @since   2.2
 * @version 2.2
 */

if ( ! class_exists( 'RDTheme_About_Widget' ) ) {
	class RDTheme_About_Widget extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'rdtheme_about', // Base ID
				esc_html__( 'Eikra: About', 'eikra-core' ), // Name
				[
					'description' => esc_html__( 'Eikra: About Widget', 'eikra-core' ),
				] );
		}

		public function widget( $args, $instance ) {
			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', $instance['title'] );

				if ( ! empty( $instance['logo'] ) ) {
					$logo = wp_get_attachment_image_src( $instance['logo'], 'thumbnail' );
					$logo = $logo[0];
					$logo = '<img src="' . $logo . '" alt="' . $title . '">';
				} else {
					$logo = '';
				}

				$title = $args['before_title'] . $logo . $title . $args['after_title'];
				echo wp_kses_post( $title );
			}
			?>
            <p class="rtin-des"><?php if ( ! empty( $instance['description'] ) ) {
					echo wp_kses_post( $instance['description'] );
				} ?></p>
            <ul>
				<?php
				if ( ! empty( $instance['facebook'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li><?php
				}
				if ( ! empty( $instance['twitter'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li><?php
				}
				if ( ! empty( $instance['gplus'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['gplus'] ); ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a></li><?php
				}
				if ( ! empty( $instance['linkedin'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li><?php
				}
				if ( ! empty( $instance['pinterest'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li><?php
				}
				if ( ! empty( $instance['rss'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><i class="fas fa-rss"></i></a></li><?php
				}
				if ( ! empty( $instance['instagram'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li><?php
				}
				if ( ! empty( $instance['youtube'] ) ) {
					?>
                    <li><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li><?php
				}
				?>
            </ul>

			<?php
			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ) {
			$instance                = [];
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['logo']        = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
			$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
			$instance['facebook']    = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
			$instance['twitter']     = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
			$instance['gplus']       = ( ! empty( $new_instance['gplus'] ) ) ? sanitize_text_field( $new_instance['gplus'] ) : '';
			$instance['linkedin']    = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
			$instance['pinterest']   = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
			$instance['rss']         = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
			$instance['instagram']   = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
			$instance['youtube']     = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';

			return $instance;
		}

		public function form( $instance ) {
			$defaults = [
				'title'       => esc_html__( 'EIKRA', 'eikra-core' ),
				'logo'        => '',
				'description' => '',
				'facebook'    => '',
				'twitter'     => '',
				'gplus'       => '',
				'linkedin'    => '',
				'pinterest'   => '',
				'rss'         => '',
				'instagram'   => '',
				'youtube'     => '',
			];
			$instance = wp_parse_args( (array) $instance, $defaults );

			$fields = [
				'title'       => [
					'label' => esc_html__( 'Title', 'eikra-core' ),
					'type'  => 'text',
				],
				'logo'        => [
					'label' => esc_html__( 'Logo', 'eikra-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'Image size should be 40x40 px', 'eikra-core' ),
				],
				'description' => [
					'label' => esc_html__( 'Description', 'eikra-core' ),
					'type'  => 'textarea',
				],
				'facebook'    => [
					'label' => esc_html__( 'Facebook URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'twitter'     => [
					'label' => esc_html__( 'Twitter URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'gplus'       => [
					'label' => esc_html__( 'Google Plus URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'linkedin'    => [
					'label' => esc_html__( 'Linkedin URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'pinterest'   => [
					'label' => esc_html__( 'Pinterest URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'rss'         => [
					'label' => esc_html__( 'Rss Feed URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'instagram'   => [
					'label' => esc_html__( 'Instagram URL', 'eikra-core' ),
					'type'  => 'url',
				],
				'youtube'     => [
					'label' => esc_html__( 'Youtube URL', 'eikra-core' ),
					'type'  => 'url',
				],
			];

			RT_Widget_Fields::display( $fields, $instance, $this );
		}

	}
}