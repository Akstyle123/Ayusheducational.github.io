<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$attr = $btn = '';

if ( !empty( $data['buttonurl']['url'] ) ) {
    $attr  = 'href="' . $data['buttonurl']['url'] . '"';
    $attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( !empty( $data['buttontext'] ) ) {
    $btn = '<a class="rtin-btn" ' . $attr . '>' . $data['buttontext'] . '</a>';
}

$price_html  = $data['price'];
$unit = $data['unit'];
$price_html .= !empty( $unit ) ? "<br/><div class='price-unit'>/ $unit</div>": '';

?>
<div class="rt-price-table-box1">
    <?php if ( !empty( $data['title'] )): ?>
        <span><?php echo esc_html( $data['title'] ); ?></span>
    <?php endif; ?>
    <div class="rtin-price"><?php echo wp_kses_post( $price_html ); ?></div>
    <div class="rtin-features">
        <?php foreach ( $data['features'] as $feature ): ?>
            <div class="rtin-feature-each"><?php echo esc_html( $feature ); ?></div>
        <?php endforeach; ?>
    </div>
    <?php if ( $btn ): ?>
        <?php echo wp_kses_post( $btn ); ?>
    <?php endif; ?>
</div>
