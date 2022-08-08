<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="rt-vc-video rt-light">
    <?php if ( ! empty($data['title']) ): ?>
        <h2 class="rt-vc-title-left rt-video-title"><?php echo esc_html( $data['title'] );?></h2>
    <?php endif; ?>
    <div class="rtin-item">
        <?php if ( ! empty($data['videourl']['url']) ): ?>
            <a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $data['videourl']['url'] ); ?>"><i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i></a>
        <?php endif; ?>
    </div>
</div>