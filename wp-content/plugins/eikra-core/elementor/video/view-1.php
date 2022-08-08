<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="rt-vc-video">
    <div class="rtin-item">
        <?php if ( ! empty($data['title']) ): ?>
            <h2 class="rtin-title rt-video-title"><?php echo esc_html( $data['title'] );?></h2>
        <?php endif; ?>
        <?php if ( ! empty($data['content']) ): ?>
            <p class="rtin-content"><?php echo wp_kses_post( $data['content'] );?></p>
        <?php endif; ?>
        <?php if ( ! empty($data['videourl']['url']) ): ?>
            <a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $data['videourl']['url'] ); ?>"><i class="<?php echo esc_attr( $data['icon'] ); ?>" aria-hidden="true"></i></a>
        <?php endif; ?>
    </div>
</div>