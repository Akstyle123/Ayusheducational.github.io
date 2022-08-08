<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$icon_class = isset($data['icon_style']) ? $data['icon_style'] : 'rounded';

?>

<div class="media rt-info-box <?php echo esc_html( $data['layout'] ); ?>">
    <?php if ($data['icon_type'] == 'image'): ?>
        <div class="img-holder">
            <?php echo wp_get_attachment_image( $data['image']['id'], 'full' ); ?>
        </div>
    <?php else: ?>
        <div class="rtin-icon <?php echo esc_html($icon_class); ?>">
            <i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i>
        </div>
    <?php endif; ?>
    <div class="media-body">
        <h3 class="media-heading info-box-title"><?php echo esc_html( $data['title'] ); ?></h3>
        <?php if ( $data['layout'] != 'layout4'): ?>
            <p class="mb0 info-box-subtitle"><?php echo wp_kses_post( $data['description'] ); ?></p>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
