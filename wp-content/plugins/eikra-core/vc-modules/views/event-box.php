<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$query = new WP_query( $event_args );
?>
<div class="rt-vc-event-box">
	<?php if ( $query->have_posts() ): ?>
		<div class="row auto-clear">
			<?php while ( $query->have_posts() ): $query->the_post() ?>
				<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = RDTheme_Helper::filter_content( $content );
				$content = wp_trim_words( $content, $content_limit );
				$location = get_post_meta( $id, 'location', true );

				$start_date = get_post_meta( $id, 'ac_event_start_date', true );
				$end_date = get_post_meta( $id, 'ac_event_end_date', true );
				$start_time = get_post_meta( $id, 'ac_event_start_time', true );
				$end_time = get_post_meta( $id, 'ac_event_end_time', true );

				$time      = date_i18n( get_option( 'date_format' ), strtotime( $start_date ) );
				?>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="rtin-item media clearfix">
						<div class="rtin-left media-left media-middle pull-left">
							<?php if ( has_post_thumbnail( $id ) ): ?>
								<div class="rtin-thumb"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="rtin-right media-body media-middle">
							<h3 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
							<div class="rtin-meta">
								<?php if ( $location ): ?>
									<div class="rtin-location"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><?php echo esc_html( $location ); ?></div>
								<?php endif; ?>
								<div class="rtin-time"><i class="fas fa-calendar" aria-hidden="true"></i><?php echo esc_html( $time ); ?></div>
							</div>
							<div class="rtin-btn">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo esc_html_e( 'Details', 'eikra-core' ); ?>
                                    <i class="fas fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </div>
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
		<div class="rtin-item"><?php esc_html_e( 'No Events Available', 'eikra-core' )?></div>
	<?php endif; ?>
	<?php wp_reset_query();?>
</div>