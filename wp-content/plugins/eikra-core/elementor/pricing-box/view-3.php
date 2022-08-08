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

$currency = $data['currency'];
$unit = $data['unit'];

$price_html  = !empty( $currency ) ? "<span class='price-currency'>$currency</span>": '';
$price_html  .= $data['price'];
$price_html .= !empty( $unit ) ? "<span class='price-unit'>/ $unit</span>": '';

$featured_class = $data['featured'] == 'enable' ? 'rtin-featured' : '' ;

?>
<div class="rt-price-table-box3 <?php echo esc_attr($featured_class); ?>">
    <?php if ( !empty( $data['title'] )): ?>
        <div class="rtin-title"><?php echo esc_html( $data['title'] ); ?></div>
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
