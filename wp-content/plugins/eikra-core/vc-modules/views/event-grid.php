<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

$query = new WP_query( $event_args );
?>
<div class="rt-vc-event rt-vc-event-grid rt-event-block-wrapper">
	<?php if ( $query->have_posts() ): ?>
    <div class="row auto-clear">
		<?php while ( $query->have_posts() ): $query->the_post() ?>
		<?php
		$id = get_the_ID();
		$content = get_the_content();
		$content = RDTheme_Helper::filter_content( $content );
		$content = wp_trim_words( $content, $content_limit );

		$start_date = get_post_meta( $id, 'ac_event_start_date', true );
		$end_date = get_post_meta( $id, 'ac_event_end_date', true );
		$start_time = get_post_meta( $id, 'ac_event_start_time', true );
		$end_time = get_post_meta( $id, 'ac_event_end_time', true );
		$location = get_post_meta( $id, 'location', true );

		$date = date_i18n( "d-M-Y", strtotime( $start_date ) );
		$date = explode( "-", $date );
		$date_dormat = get_option( 'date_format' );

		$event_time = "<span class='time-range'>";
		$event_time .= $start_time ? "<span>{$start_time}</span>" : null;
		$event_time .= $end_time ? "<span>{$end_time}</span>" : null;
		$event_time .= "</span>";
		if ( $start_date != $end_date ) {
			$event_time .= "({$end_date})";
		}
		?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="media rtin-item">
                <div class="media-left rtin-calender-holder">
                    <div class="rtin-calender">
                        <h3><?php echo esc_html( $date[0] ); ?></h3>
                        <p><?php echo esc_html( $date[1] ); ?></p>
                        <span><?php echo esc_html( $date[2] ); ?></span>
                    </div>
                </div>
                <div class="media-body rtin-right">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
                    <ul>
                        <li class="rtin-time">
	                        <?php
	                        echo wp_kses( $event_time, [
		                        'span' => [ 'class' => [] ],
	                        ] );
	                        ?>
                        </li>
						<?php if ( $location ): ?>
                            <li class="rtin-location"><?php echo esc_html( $location ); ?></li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endwhile;?>
	    <?php if ( $pagination == 'enable' ): ?>
            <div class="col-sm-12 col-xs-12 mt30"><?php echo RDTheme_Helper::list_posts_pagination( $query ); ?></div>
	    <?php endif; ?>

	    <?php if ( $button_display == 'true' ): ?>
            <div class="rtin-btn col-sm-12 col-xs-12">
                <a href="<?php echo esc_url( $button_url ); ?>" class="rdtheme-button-6"><?php echo esc_html( $button_text ); ?></a>
            </div>
	    <?php endif; ?>
    </div>
    <?php else: ?>
    <div class="media rtin-item"><?php esc_html_e( 'No Events Available', 'eikra-core' ) ?></div>
    <?php endif; ?>
	<?php wp_reset_query();?>
</div>