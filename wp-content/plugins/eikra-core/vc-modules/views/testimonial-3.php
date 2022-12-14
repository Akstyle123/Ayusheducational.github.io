<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$thumb_size = 'rdtheme-size8';
$args = array(
	'post_type'      => 'ac_testimonial',
	'posts_per_page' => $slider_item_number,
	'orderby' => $orderby,
	'order'   => $order,
);

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'ac_testimonial_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;

$title_style       = $name_color ? "color:{$name_color};" : '';
$designation_style = $designation_color ? "color:{$designation_color};" : '';
$content_style     = $content_color ? "color:{$content_color};" : '';
?>
<div class="rt-vc-testimonial-3">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ) : the_post();?>
				<?php
				$id = get_the_ID();
				$designation = get_post_meta( $id, 'ac_testimonial_designation', true );
				$content = get_the_content();
				?>
				<div class="rtin-item media">
					<div class="pull-left rtin-img">
						<?php
						if ( has_post_thumbnail() ){
							the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-circle' )  );
						}
						?>
					</div>
					<div class="media-body rtin-content-area">
						<h3 class="rtin-title" style="<?php echo esc_attr( $title_style );?>"><?php the_title(); ?></h3>
						<?php if( !empty( $designation ) ): ?>
							<div class="rtin-designation" style="<?php echo esc_attr( $designation_style );?>"><?php echo esc_html( $designation ); ?></div>
						<?php endif; ?>
						<p class="rtin-content" style="<?php echo esc_attr( $content_style ); ?>"><?php echo esc_html( $content ); ?></p>
					</div>
				</div>
			<?php endwhile; ?>
		<?php else:?>
			<?php esc_html_e( 'No Testimonial Found' , 'eikra-core' ); ?>
		<?php endif; ?>
		<?php wp_reset_query();?>
	</div>
</div>