<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

$thumb_size = 'rdtheme-size3';

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

$col_lg = isset( $data['col_lg'] ) ? $data['col_lg'] : 4;
$col_md = isset( $data['col_md'] ) ? $data['col_md'] : 4;
$col_sm = isset( $data['col_sm'] ) ? $data['col_sm'] : 6;
$col_xs = isset( $data['col_xs'] ) ? $data['col_xs'] : 12;

$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;
?>
<div class="rt-vc-research-3">
	<?php if ( have_posts() ): ?>
        <div class="row auto-clear">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				} elseif ( ! empty( RDTheme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
				} else {
					$thumbnail = '<img width="360" height="260" src="' . RDTHEME_IMG_URL . 'noimage_360x260.jpg" alt="' . get_the_title() . '">';
				}
				$content = RDTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $count );
				?>
                <div class="<?php echo esc_attr( $col_class ); ?>">
                    <div class="rtin-item">
                        <div class="rtin-holder">
                            <a href="<?php the_permalink(); ?>"><?php echo $thumbnail; ?></a>
                            <h2 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?><i class="fas fa-angle-right" aria-hidden="true"></i></a></h2>
                        </div>
                        <p class=rtin-content><?php echo wp_kses_post( $content ); ?></p>
                    </div>
                </div>
			<?php endwhile; ?>
            <div class="col-sm-12 col-xs-12 mt30"><?php RDTheme_Helper::pagination(); ?></div>
        </div>
	<?php else: ?>
		<?php esc_html_e( 'No Research Found', 'eikra-core' ); ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>