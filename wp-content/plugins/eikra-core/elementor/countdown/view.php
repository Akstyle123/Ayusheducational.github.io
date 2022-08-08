<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$countdown_time = '';

if (!empty($data['date_time'])) {
    $countdown_time  = strtotime( $data['date_time'] );
    $countdown_time  = date('Y/m/d H:i:s', $countdown_time);
}

?>
<div class="rt-countdown elementwidth elwidth-450 rtin-<?php echo esc_attr( $data['style'] ); ?>">
    <?php if (!empty($data['title1'])): ?>
        <h3 class="rtin-title1"><?php echo esc_html( $data['title1'] ); ?></h3>
    <?php endif; ?>
    <?php if (!empty($data['title2'])): ?>
        <h3 class="rtin-title2"><?php echo esc_html( $data['title2'] ); ?></h3>
    <?php endif; ?>
    <?php if (!empty($countdown_time)): ?>
        <div class="rt-date clearfix" data-time="<?php echo esc_attr( $countdown_time ); ?>"></div>
    <?php endif; ?>
</div>