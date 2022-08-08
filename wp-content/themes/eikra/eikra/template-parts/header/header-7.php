<?php
/**
 * @author  RadiusTheme
 * @since   3.0
 * @version 3.0
 */

$rdtheme_socials = RDTheme_Helper::socials();
$nav_menu_args   = RDTheme_Helper::nav_menu_args();

// Logo
$rdtheme_dark_logo = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark.svg' : RDTheme::$options['logo']['url'];
$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light.svg' : RDTheme::$options['logo_light']['url'];

$rdtheme_logo_width = (int) RDTheme::$options['logo_width'];
$rdtheme_menu_width = 12 - $rdtheme_logo_width;
$rdtheme_logo_class = "col-sm-{$rdtheme_logo_width} col-xs-12";
$rdtheme_menu_class = "col-sm-{$rdtheme_menu_width} col-xs-12";
?>
<div class="masthead-container">
	<div class="header-firstrow clearfix">
		<ul class="header-contact">
			<?php if ( RDTheme::$options['phone'] ): ?>
				<li>
					<i class="fas fa-phone-alt" aria-hidden="true"></i><a href="tel:<?php echo esc_attr( RDTheme::$options['phone'] );?>"><?php echo esc_html( RDTheme::$options['phone'] );?></a>
				</li>
			<?php endif; ?>
			<?php if ( RDTheme::$options['email'] ): ?>
				<li>
					<i class="fas fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] );?>"><?php echo esc_html( RDTheme::$options['email'] );?></a>
				</li>
			<?php endif; ?>
		</ul>
		<?php if ( $rdtheme_socials ): ?>
			<ul class="header-social">
				<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
					<li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] );?>"><i class="<?php echo esc_attr( $rdtheme_social['icon'] );?>"></i></a></li>
				<?php endforeach; ?>					
			</ul>						
		<?php endif; ?>
	</div>
	<hr class="menu-sep" />
	<div class="row align-items-center">
		<div class="<?php echo esc_attr( $rdtheme_logo_class );?>">
			<div class="site-branding">
				<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_dark_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
				<a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_light_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
			</div>
		</div>
		<div class="<?php echo esc_attr( $rdtheme_menu_class );?>">
			<?php if ( RDTheme::$options['header_btn_txt'] && RDTheme::$options['header_btn_url'] ): ?>
				<a class="header-menu-btn" href="<?php echo RDTheme::$options['header_btn_url'];?>"><?php echo RDTheme::$options['header_btn_txt'];?></a>
			<?php endif; ?>
			<?php get_template_part( 'template-parts/header/icon', 'area' );?>
			<div id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( $nav_menu_args );?>
			</div>
		</div>
	</div>
</div>