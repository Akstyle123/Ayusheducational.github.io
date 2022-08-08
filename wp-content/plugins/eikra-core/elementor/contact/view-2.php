<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$rdtheme_socials = RDTheme_Helper::socials();

?>
<div class="rt-vc-contact-2">
    <ul class="rtin-item">
        <?php if( !empty( $data['address'] ) ): ?>
            <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                <span class="contact-content"><?php echo wp_kses_post( $data['address'] ); ?></span>
            </li>
        <?php endif; ?>
        <?php if( !empty( $data['email'] ) ): ?>
            <li><i class="far fa-envelope" aria-hidden="true"></i>
                <span class="contact-content"><?php echo esc_html( $data['email'] ); ?></span>
            </li>
        <?php endif; ?>
        <?php if( !empty( $data['phone'] ) ): ?>
            <li><i class="fas fa-phone-alt" aria-hidden="true"></i>
                <span class="contact-content"><?php echo esc_html( $data['phone'] ); ?></span>
            </li>
        <?php endif; ?>
        <?php if( $data['social_display'] == 'yes' && !empty( $rdtheme_socials ) ): ?>
            <li class="rtin-social-wrap">
                <ul class="rtin-social">
                    <?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
                        <li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] );?>"><i class="<?php echo esc_attr( $rdtheme_social['icon'] );?>"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>