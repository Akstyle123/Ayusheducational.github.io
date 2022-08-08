<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>

<div class="rt-vc-counter">
    <div class="rtin-left">
        <div class="rtin-counter"><span class="rtin-counter-num" data-num="<?php echo esc_html( $data['counter_no'] ); ?>" data-rtSpeed="<?php echo esc_html( $data['counter_speed'] ); ?>" data-rtSteps="<?php echo esc_html( $data['counter_steps'] ); ?>"><?php echo esc_html( $data['counter_no'] ); ?></span></div>
    </div>
    <div class="rtin-right">
        <div class="rtin-title"><?php echo esc_html( $data['title'] ); ?></div>
    </div>
    <div class="clear"></div>
</div>