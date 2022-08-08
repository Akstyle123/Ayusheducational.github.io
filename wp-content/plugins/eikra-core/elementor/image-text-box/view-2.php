<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$attr = '';

if ( !empty( $data['link']['url'] ) ) {
    $attr  = 'href="' . $data['link']['url'] . '"';
    $attr .= !empty( $data['link']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['link']['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>
<div class="rt-vc-imagetext-2">
    <?php if ( !empty($attr) ): ?>
        <?php if ( !empty($data['image']['id']) ): ?>
            <div class="rtin-img hvr-bounce-to-right">
                <?php echo wp_get_attachment_image( $data['image']['id'], 'full' ); ?>
                <a <?php echo $attr; ?> title="<?php echo esc_attr( $data['title'] ); ?>"><i class="fas fa-link" aria-hidden="true"></i></a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if ( !empty($data['image']['id']) ): ?>
            <div class="rtin-img">
                <?php echo wp_get_attachment_image( $data['image']['id'], 'full' ); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <h3 class="rtin-title">
        <?php if ( !empty($attr) ): ?>
            <a <?php echo  $attr; ?>>
        <?php endif; ?>

        <?php echo esc_html($data['title']); ?>

        <?php if ( !empty($attr) ): ?>
            </a>
        <?php endif; ?>
    </h3>
</div>