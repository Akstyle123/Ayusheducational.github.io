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
    $btn = '<a class="rtin-btn rdtheme-button-6" ' . $attr . '>' . $data['buttontext'] . '</a>';
}

$price_html  = $data['price'];
$unit = $data['unit'];
$price_html .= !empty( $unit ) ? "<span>/$unit</span>": '';

?>
<div class="hvr-float-shadow">
    <div class="rt-pricing-box2">
        <?php if ( !empty( $data['title'] )): ?>
            <div class="rtin-title"><?php echo esc_html( $data['title'] ); ?></div>
        <?php endif; ?>
        <div class="rtin-price"><?php echo wp_kses_post( $price_html ); ?></div>
        <ul>
            <?php foreach ( $data['features'] as $feature ): ?>
                <li><?php echo esc_html( $feature ); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php if ( $btn ): ?>
            <?php echo wp_kses_post( $btn ); ?>
        <?php endif; ?>
    </div>
</div>
