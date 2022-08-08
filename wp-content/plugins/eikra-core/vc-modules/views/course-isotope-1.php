<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! empty( $categories ) ) {
	$get_post_ids = [];
	$new_categories   = explode( ',', $categories );
	foreach ( $new_categories as $slug ) {
		$args = [
			'post_type'      => 'lp_course',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'fields'         => 'ids',
			'tax_query'      => [
				[
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => explode( " ", trim($slug) ),
				],
			],
		];

		$new_ids      = get_posts( $args );
		$get_post_ids = array_merge( $get_post_ids, $new_ids );
	}
} else {
	$get_post_ids = [];
	$new_categories   = RDTheme_Helper::eikra_terms( 'course_category', 'slug' );
	foreach ( $new_categories as $slug ) {
		$args = [
			'post_type'      => 'lp_course',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'fields'         => 'ids',
			'tax_query'      => [
				[
					'taxonomy' => 'course_category',
					'field'    => 'slug',
					'terms'    => explode( " ", trim($slug) ),
				],
			],
		];

		$new_ids      = get_posts( $args );
		$get_post_ids = array_merge( $get_post_ids, $new_ids );
	}
}

$args = [
	'post_type'      => 'lp_course',
	'posts_per_page' => - 1,
	'post__in'       => $get_post_ids,
];

$query = new WP_Query( $args );


?>
<div class="rt-vc-course-isotope rt-vc-isotope-container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="rt-vc-isotope-tab isotop-btn">
                <a href="#" data-filter="*" class="current"><?php echo esc_html( $all ); ?></a>
				<?php foreach ( $new_categories as $cat_slug ):
	                $category = get_term_by( 'slug', $cat_slug, 'course_category' );
                    ?>
                    <a href="#" data-filter=".<?php echo esc_attr( trim($cat_slug) ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row rt-vc-isotope-wrapper">
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$terms      = get_the_terms( get_the_ID(), 'course_category' );
				$terms_html = '';
				if ( $terms ) {
					foreach ( $terms as $term ) {
						$terms_html .= ' ' . $term->slug;
					}
				}
				?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12<?php echo esc_attr( $terms_html ); ?>">
					<?php
					if ( RDTheme_Helper::is_LMS() ) {
						if ( $box_style != 1 ) {
							learn_press_get_template( "custom/course-box-{$box_style}.php" );
						} else {
							learn_press_get_template( 'custom/course-box.php' );
						}
					} else {
						get_template_part( 'template-parts/content', 'course-box' );
					}
					?>
                </div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
    </div>
</div>