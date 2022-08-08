<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.1
 */

if ( ! empty( $data['category'] ) ) {
	$blog_permalink = get_category_link( $data['category'] );
} else {
	$blog_page      = get_option( 'page_for_posts' );
	$blog_permalink = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
}

$args = [
	'posts_per_page'      => $data['item_no'],
	'ignore_sticky_posts' => 1,
	'orderby'       => $data['orderby'],
	'order'         => $data['order'],
];

if ( ! empty( $data['category'] ) ) {
	$args['cat'] = $data['category'];
}

if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

if ( $data['exclude'] ) {
	$post_exclude         = explode( ',', $data['exclude'] );
	$args['post__not_in'] = $post_exclude;
}
$query = new WP_Query( $args );

global $wp_query;
$wp_query = null;
$wp_query = $query;
?>
<div class="rt-vc-posts-2">
    <h2 class="rtin-header rtin-post-title"><?php echo esc_html( $data['title'] ); ?></h2>
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$content = RDTheme_Helper::get_current_post_content();
			$content = wp_trim_words( $content, $data['content_limit'] );
			?>
            <div class="rtin-item">
                <div class="rtin-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
                <h3 class="rtin-title rtin-blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
            </div>
		<?php endwhile; ?>
		<?php if ( $data['btn_display'] == 'yes' ): ?>
            <a class="rtin-btn" href="<?php echo esc_url( $blog_permalink ); ?>"><?php echo esc_html( $data['btn_text'] ); ?><i class="fas fa-angle-right"
                                                                                                                                aria-hidden="true"></i></a>
		<?php endif; ?>
	<?php else: ?>
		<?php esc_html_e( 'No posts found', 'eikra-core' ); ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>