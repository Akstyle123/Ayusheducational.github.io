<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$icon_class = isset($data['icon_style']) ? $data['icon_style'] : 'rounded';

?>

<div class="rt-vc-infobox-6 rtin-align-center">
    <div class="rtin-item">
        <div class="rtin-left">
            <div class="rtin-icon">
                <?php if ( $data['icon_type'] == 'image' ): ?>
                    <?php echo wp_get_attachment_image( $data['image']['id'], 'thumbnail', true );?>
                <?php else: ?>
                    <i class="<?php echo esc_attr( $data['icon'] ); ?>" aria-hidden="true"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="rtin-right">
            <?php if (!empty($data['title'])): ?>
                <div class="rtin-title info-box-title"><?php echo esc_html( $data['title'] ); ?></div>
            <?php endif; ?>
            <?php if (!empty($data['description'])): ?>
                <div class="rtin-subtitle info-box-subtitle"><?php echo esc_html( $data['description'] ); ?></div>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
</div>