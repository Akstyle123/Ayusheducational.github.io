<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Logo
$nav_menu_args      = RDTheme_Helper::nav_menu_args();
$rdtheme_dark_logo  = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark.svg' : RDTheme::$options['logo']['url'];

?>
<div id="mobile-menu-sticky-placeholder"></div>
<div class="rt-header-menu mean-container mobile-offscreen-menu header-icon-round" id="meanmenu">
    <div class="mean-bar">
        <div class="mobile-logo">
            <div class="site-branding">
                <a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $rdtheme_dark_logo ); ?>"
                                                                                           alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
            </div>
        </div>

        <div class="header-icon-area">
            <ul class="header-btn">
				<?php if ( RDTheme::$options['search_icon'] ) : ?>
                    <li>
						<?php get_template_part( 'template-parts/header/icon', 'search' ); ?>
                    </li>
				<?php endif; ?>

				<?php if ( RDTheme::$options['cart_icon'] && class_exists( 'WC_Widget_Cart' ) ) : ?>
                    <li>
						<?php get_template_part( 'template-parts/header/icon', 'cart' ); ?>
                    </li>
				<?php endif; ?>

                <li class="offcanvar_bar button" style="order: 99">
                    <span class="sidebarBtn ">
                    <span class="fa fa-bars">
                    </span>
                </span>
                </li>
            </ul>
        </div>

    </div>

    <div class="rt-slide-nav">
        <div class="offscreen-navigation">
			<?php
			if ( '9' == RDTheme::$header_style ) {
				get_template_part( 'template-parts/header/header', 'category' );
			}
			wp_nav_menu(
				[
					'theme_location' => 'primary',
					'container'      => 'nav',
				]
			);
			?>
        </div>
    </div>
</div>
