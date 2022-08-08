<?php
/**
 * Template for displaying rating stars.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/rating-stars.php.
 *
 * @author  ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.6
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( is_woocommerce() || is_admin() ) return;

$percent = ( ! isset( $rated ) ) ? 0 : min( 100, ( round( $rated * 2 ) / 2 ) * 20 );
$title   = sprintf( __( '%s out of 5 stars', 'learnpress-course-review' ), round( $rated, 2 ) );

?>
<div class="review-stars-rated" title="<?php echo esc_attr( $title ); ?>">
	<?php for ( $i = 1; $i <= 5; $i ++ ) {
		$p = ( $i * 20 );
		$r = max( $p <= $percent ? 100 : ( $percent - ( $i - 1 ) * 20 ) * 5, 0 );

		?>
        <div class="review-star">
            <i class="far fa-star"></i>
            <i class="fas fa-star" style="width:<?php echo $r; ?>%;"></i>
        </div>
	<?php } ?>
</div>