<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$query = new WP_query( $data['event_args'] );

?>
<div class="rt-vc-event-box rt-event-block-wrapper">
	<?php if ( $query->have_posts() ): ?>
        <div class="row auto-clear">
				<?php while ( $query->have_posts() ): $query->the_post(); ?>
					<?php
					$id         = get_the_ID();
					$start_date = get_post_meta( $id, 'ac_event_start_date', true );
					$time      = date_i18n( get_option( 'date_format' ), strtotime( $start_date) );
					$location   = get_post_meta( $id, 'location', true );
					?>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="rtin-item media clearfix">
                            <div class="rtin-left media-left media-middle pull-left">
								<?php if ( has_post_thumbnail( $id ) ): ?>
                                    <div class="rtin-thumb"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></div>
								<?php endif; ?>
                            </div>
                            <div class="rtin-right media-body media-middle">
                                <h3 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="rtin-meta">
									<?php if ( $location ): ?>
                                        <div class="rtin-location"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><?php echo esc_html( $location ); ?></div>
									<?php endif; ?>
                                    <div class="rtin-time"><i class="fas fa-calendar" aria-hidden="true"></i><?php echo esc_html( $time ); ?></div>
                                </div>
								<?php if ( $data['btn_display'] == 'yes' ): ?>
                                    <div class="rtin-btn">
                                        <a href="<?php the_permalink(); ?>"><?php echo esc_html( $data['btn_text'] ); ?>
                                            <i class="fas fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
                <?php if( $data['pagination'] == 'yes' ): ?>
                    <div class="col-sm-12 col-xs-12 mt30"><?php echo RDTheme_Helper::list_posts_pagination( $query ); ?></div>
                <?php endif; ?>
        </div>
	<?php else: ?>
        <div class="rtin-item"><?php esc_html_e( 'No Events Available', 'eikra-core' ) ?></div>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>