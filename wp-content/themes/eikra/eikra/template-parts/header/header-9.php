<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = RDTheme_Helper::nav_menu_args();

// Logo
$rdtheme_dark_logo  = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark.svg' : RDTheme::$options['logo']['url'];
$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light.svg' : RDTheme::$options['logo_light']['url'];

$rdtheme_logo_width = (int) RDTheme::$options['logo_width'];
$rdtheme_menu_width = 12 - $rdtheme_logo_width;
$rdtheme_logo_class = "col-sm-{$rdtheme_logo_width} col-xs-12";
$rdtheme_menu_class = "col-sm-{$rdtheme_menu_width} col-xs-12";

?>
<div class="container masthead-container">
    <div class="row menu-flex-wrapper">

        <!--site logo-->
        <div class="site-logo-section">
            <div class="site-branding">
                <a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $rdtheme_dark_logo ); ?>"
                                                                                           alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
                <a class="light-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $rdtheme_light_logo ); ?>"
                                                                                            alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
            </div>

            <div class="search-box search-form">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" name="s" class="search-text" placeholder="<?php esc_attr_e( 'Search...', 'eikra' ); ?>" required>
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

			<?php get_template_part( 'template-parts/header/header', 'category' ); ?>

        </div>
        <!--end site logo-->

        <!--site menu -->
        <div class="site-menu-section">
            <div id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( $nav_menu_args ); ?>
            </div>
        </div>

        <div class="header-icon-area">
		    <?php
		    if ( RDTheme::$options['cart_icon'] && class_exists( 'WC_Widget_Cart' ) ) {
			    get_template_part( 'template-parts/header/icon', 'cart' );
		    }

		    if ( RDTheme::$options['search_icon'] ) {
			    get_template_part( 'template-parts/header/icon', 'search' );
		    }
		    ?>
        </div>
        <!--end site menu -->

    </div>
</div>