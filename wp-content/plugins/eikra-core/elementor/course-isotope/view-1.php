<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


$args = [
	'post_type'      => 'lp_course',
	'posts_per_page' => - 1,
	'post__in'       => $data['post_ids'],
];

$query = new WP_Query( $args );

?>
<div class="rt-vc-course-isotope rt-vc-isotope-container">


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="rt-vc-isotope-tab isotop-btn">
				<?php if ( $data['button_all_display'] == 'yes' ) : ?>
                    <a href="#" data-filter="*" class="current"><?php esc_html_e( 'All', 'eikra-core' ); ?></a>
				<?php endif; ?>
				<?php
                $count = 1;
                foreach ( $data['category'] as $cat_slug ):
	                $active_class = '';
	                if ( $data['button_all_display'] != 'yes' && $count == 1){
	                    $active_class = 'current';
                    }
					$category = get_term_by( 'slug', $cat_slug, 'course_category' ); ?>
                    <a href="#" class="<?php echo esc_attr($active_class) ?>" data-filter=".<?php echo esc_attr( $cat_slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php $count++;
				endforeach; ?>
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
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 <?php echo esc_attr( $terms_html ); ?>">
					<?php
					if ( RDTheme_Helper::is_LMS() ) {
						if ( $data['box_style'] != 1 ) {
							learn_press_get_template( "custom/course-box-{$data['box_style']}.php" );
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
<?php
    if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    ?>
    <script>jQuery('.rt-vc-isotope-wrapper').isotope();</script>
<?php
}