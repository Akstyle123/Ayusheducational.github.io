<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$rdtheme_socials = RDTheme_Helper::socials();
?>

<div id="tophead">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex align-items-center">
                <div class="tophead-contact">
                    <ul>
						<?php if ( RDTheme::$options['address'] ): ?>
                            <li>
                                <i class="fas fa-map"></i>
								<?php echo esc_html( RDTheme::$options['address'] ); ?>
                            </li>
						<?php endif; ?>

						<?php if ( RDTheme::$options['email'] ): ?>
                            <li>
                                <i class="far fa-envelope"></i>
                                <a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] ); ?>">
									<?php echo esc_html( RDTheme::$options['email'] ); ?>
                                </a>
                            </li>
						<?php endif; ?>

						<?php if ( RDTheme::$options['phone'] ): ?>
                            <li>
                                <i class="fas fa-phone-alt" aria-hidden="true"></i><a
                                        href="tel:<?php echo esc_attr( RDTheme::$options['phone'] ); ?>"><?php echo esc_html( RDTheme::$options['phone'] ); ?></a>
                            </li>
						<?php endif; ?>
                    </ul>
                </div>
                <div class="tophead-right ml-auto">

	                <?php $user_login_label = is_user_logged_in() ? 'My Profile' : 'Login / Register'; ?>
                    <div class="login-btn">
                        <a href="<?php echo esc_url( wp_login_url() ) ?>">
                            <i class="fa fa-user"></i>
			                <?php echo esc_html__( $user_login_label, 'eikra' ) ?>
                        </a>
                    </div>


                    <div class="topbar-social">
						<?php if ( $rdtheme_socials ): ?>
                            <ul class="header-social">
								<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
                                    <li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] ); ?>"><i
                                                    class="<?php echo esc_attr( $rdtheme_social['icon'] ); ?>"></i></a></li>
								<?php endforeach; ?>
                            </ul>
						<?php endif; ?>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>