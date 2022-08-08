<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$rdtheme_socials  = RDTheme_Helper::socials();
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

					<?php if ( RDTheme::$options['header_btn_txt'] && RDTheme::$options['header_btn_url'] ): ?>
                        <a class="topbar-btn" href="<?php echo RDTheme::$options['header_btn_url']; ?>">
							<?php echo RDTheme::$options['header_btn_txt']; ?>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
					<?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>