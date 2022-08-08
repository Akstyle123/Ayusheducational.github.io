<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light-2.svg' : RDTheme::$options['logo_light']['url'];
$rdtheme_socials    = RDTheme_Helper::socials();

?>
<footer class="site-footer-wrap">
	<?php if ( RDTheme_Helper::has_footer() ): ?>
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
					<?php dynamic_sidebar( 'footer-layout-2' ); ?>
                </div>
            </div>
        </div>
	<?php endif; ?>

	<?php if ( $rdtheme_socials ): ?>
        <div class="footer-social-wrapper">
            <div class="social-icon">
				<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
                    <a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] ); ?>">
                        <i class="<?php echo esc_attr( $rdtheme_social['icon'] ); ?>"></i>
                    </a>
				<?php endforeach; ?>
            </div>
        </div>
	<?php endif; ?>

	<?php if ( RDTheme::$options['copyright_area'] || $rdtheme_light_logo ): ?>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 footer-bottom-inner">
                        <a class="footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( $rdtheme_light_logo ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>">
                        </a>

                        <div class="footer-copyright-text"><?php echo wp_kses_post( RDTheme::$options['copyright_text'] ); ?></div>
                    </div>

                </div>
            </div>
        </div>
	<?php endif; ?>
</footer>