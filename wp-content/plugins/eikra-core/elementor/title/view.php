<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
<div class="rt-vc-title <?php echo esc_attr( $data['style'] ); ?>" style="text-align: <?php echo esc_attr($data['title_align']); ?>">
    <div>
        <?php if( !empty( $data['title'] ) ): ?>
            <h2><?php echo esc_html( $data['title'] ); ?></h2>
        <?php endif;?>
        <?php if( !empty( $data['subtitle'] ) ): ?>
            <p class="rtin-subtitle"><?php echo wp_kses_post( $data['subtitle'] ); ?></p>
        <?php endif;?>
    </div>
</div>