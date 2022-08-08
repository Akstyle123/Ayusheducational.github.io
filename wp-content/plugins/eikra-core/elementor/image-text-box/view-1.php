<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$attr = '';

if ( !empty( $data['link']['url'] ) ) {
    $attr  = 'href="' . $data['link']['url'] . '"';
    $attr .= !empty( $data['link']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['link']['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>
<div class="rt-vc-imagetext">
    <?php if ( !empty($attr) ): ?>
        <a <?php echo  $attr; ?>>
    <?php endif; ?>

        <div class="rtin-item">
            <?php if ( !empty($data['image']['id']) ): ?>
                <div class="rtin-img"><?php echo wp_get_attachment_image( $data['image']['id'], 'full' ); ?></div>
            <?php endif; ?>
            <div class="rtin-overlay">
                <?php if ( !empty($data['title']) ): ?>
                    <div class="rtin-title"><?php echo esc_html( $data['title'] ); ?></div>
                <?php endif; ?>
                <?php if ( !empty($data['subtitle']) ): ?>
                    <div class="rtin-subtitle"><?php echo esc_html( $data['subtitle'] ); ?></div>
                <?php endif; ?>
            </div>
        </div>

    <?php if ( !empty($attr) ): ?>
        </a>
    <?php endif; ?>
</div>