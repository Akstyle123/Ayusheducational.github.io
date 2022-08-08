<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$rdtheme_socials = RDTheme_Helper::socials();

?>
<div class="rt-vc-contact-1">
    <ul class="rtin-item">
        <?php if( !empty( $data['address'] ) ): ?>
            <li>
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                <h3><?php esc_html_e( 'Address', 'eikra-core' ); ?></h3>
                <p class="contact-content"><?php echo wp_kses_post( $data['address'] ); ?></p>
            </li>
        <?php endif; ?>
        <?php if( !empty( $data['email'] ) ): ?>
            <li>
                <i class="far fa-envelope" aria-hidden="true"></i>
                <h3><?php esc_html_e( 'E-mail', 'eikra-core' ); ?></h3>
                <p class="contact-content"><?php echo esc_html( $data['email'] ); ?></p>
            </li>
        <?php endif; ?>
        <?php if( !empty( $data['phone'] ) ): ?>
            <li>
                <i class="fas fa-phone-alt" aria-hidden="true"></i>
                <h3><?php esc_html_e( 'Phone', 'eikra-core' ); ?></h3>
                <p class="contact-content"><?php echo esc_html( $data['phone'] ); ?></p>
            </li>
        <?php endif; ?>
        <?php if( $data['social_display'] == 'yes' && !empty( $rdtheme_socials ) ): ?>
            <li>
                <h3><?php esc_html_e( 'Find Us On', 'eikra-core' ); ?></h3>
                <ul class="contact-social">
                    <?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
                        <li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] ); ?>"><i class="<?php echo esc_attr( $rdtheme_social['icon'] ); ?>"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>