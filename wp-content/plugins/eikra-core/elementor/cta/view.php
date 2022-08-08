<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.2
 */

if( !empty( $data['image']['id'] ) ){
    $thumbnail = wp_get_attachment_image( $data['image']['id'], 'full', '', array( 'class' => 'img-responsive' ) );
}
else {
    $thumbnail = '<img class="media-object wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_819X330.jpg" alt="">';
}

$attr = $btn = '';

if ( !empty( $data['buttonurl']['url'] ) ) {
    $attr  .= 'href="' . $data['buttonurl']['url'] . '"';
    $attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( !empty( $data['buttontext'] ) ) {
    $btn .= '<a class="rtin-btn" ' . $attr . '>' . $data['buttontext'] . '</a>';
}

?>
<div class="rt-vc-cta">
    <div class="rtin-left">
        <?php echo wp_kses_post( $thumbnail ); ?>
    </div>
    <div class="rtin-right">
        <?php if ( ! empty( $data['title'] ) ): ?>
            <h2><?php echo esc_html( $data['title'] ); ?></h2>
        <?php endif; ?>
        <?php if ( $btn ): ?>
            <?php echo wp_kses_post( $btn ); ?>
        <?php endif; ?>
    </div>
</div>