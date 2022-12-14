<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

$thumb_size = 'rdtheme-size1';

$number  = isset( $data['item_no'] ) ? $data['item_no'] : 9;
$orderby = $data['orderby'];
$order   = $data['sortby'];
$count   = $data['length'];

$args = [
	'post_type'      => 'ac_research',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
];

if ( ! empty( $data['cat'] ) ) {
	$args['tax_query'] = [
		[
			'taxonomy' => 'ac_research_category',
			'field'    => 'term_id',
			'terms'    => $data['cat'],
		],
	];
}

if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

if ( $data['exclude'] ) {
	$post_exclude         = explode( ',', $data['exclude'] );
	$args['post__not_in'] = $post_exclude;
}

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

$args['paged'] = $paged;

$query = new WP_Query( $args );

// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;
?>
<div class="rt-vc-research-1">
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$content = RDTheme_Helper::get_current_post_content();
			$content = wp_trim_words( $content, $count );
			?>
            <div class="rtin-item">
				<?php if ( has_post_thumbnail() ): ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
				<?php endif; ?>
                <h2 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
				<?php if ( $data['btn_display'] == 'yes' ): ?>
                    <a href="<?php the_permalink(); ?>" class="rtin-btn rdtheme-button-7"><?php echo esc_html( $data['buttontext'] ); ?></a>
				<?php endif; ?>
            </div>
		<?php endwhile; ?>
        <div class="col-sm-12 col-xs-12 rt-vc-pagination"><?php RDTheme_Helper::pagination(); ?></div>
	<?php else: ?>
		<?php esc_html_e( 'No Research Found', 'eikra-core' ); ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>