<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'rdtheme-size5';

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

<div class="rt-vc-posts">
    <h2 class="rt-vc-title-left rtin-post-title"><?php echo esc_html( $data['title'] ); ?></h2>
	<?php if ( have_posts() ): ?>
        <div class="rtin-item">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$content = RDTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['content_limit'] );
				?>
                <div class="media media-list">
                    <div class="media-left rtin-img">
                        <a href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( $thumb_size );
							} else {
								if ( ! empty( RDTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
								} else {
									echo '<img class="media-object wp-post-image" src="' . RDTHEME_IMG_URL . 'noimage_150x100.jpg" alt="' . get_the_title() . '">';
								}
							}
							?>
                        </a>
                    </div>
                    <div class="media-body rtin-content-area">
                        <h3 class="rtin-blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="rtin-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
                        <p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
                    </div>
                </div>
			<?php endwhile; ?>
        </div>
		<?php if ( $data['btn_display'] == 'yes' ): ?>
            <div class="rtin-btn">
                <a href="<?php echo esc_url( $blog_permalink ); ?>" class="rdtheme-button-6"><?php echo esc_html( $data['btn_text'] ); ?></a>
            </div>
		<?php endif; ?>
	<?php else: ?>
		<?php esc_html_e( 'No posts found', 'eikra-core' ); ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>
