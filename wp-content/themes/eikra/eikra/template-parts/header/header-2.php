<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = RDTheme_Helper::nav_menu_args();
// Logo
$rdtheme_dark_logo = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark-2.svg' : RDTheme::$options['logo']['url'];
$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light-2.svg' : RDTheme::$options['logo_light']['url'];

?>
<div class="container masthead-container">
    <div class="row align-items-center">
        <div class="site-branding mr-auto">
            <a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_dark_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
            <a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_light_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
        </div>
        <div id="site-navigation" class="main-navigation">
		    <?php wp_nav_menu( $nav_menu_args );?>
        </div>
	    <?php get_template_part( 'template-parts/header/icon', 'area' );?>
    </div>

	<div class="clear"></div>
</div>