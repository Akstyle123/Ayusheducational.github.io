<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$thumb_size = 'rdtheme-size8';

$args = array(
    'post_type'      => 'ac_testimonial',
    'posts_per_page' => $data['item_no'],
    'orderby' => $data['orderby'],
    'order'   => $data['sortby'],
);

if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'ac_testimonial_category',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;

?>

<div class="rt-vc-testimonial">
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] ); ?>">
        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ) : the_post();?>
                <?php
                $id = get_the_ID();
                $designation = get_post_meta( $id, 'ac_testimonial_designation', true );
                $content = get_the_content();
                ?>
                <div class="rt-item">
                    <div class="rt-item-img">
                        <?php
                        if ( has_post_thumbnail() ){
                            the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-circle' )  );
                        }
                        ?>
                    </div>
                    <div class="rt-item-content-holder">
                        <h3 class="rt-item-title testimonial-title"><?php the_title(); ?></h3>
                        <?php if( !empty( $designation ) ): ?>
                            <span class="rt-item-designation testimonial-designation"><?php echo esc_html( $designation ); ?></span>
                        <?php endif; ?>
                        <p class="rt-item-content testimonial-content"><?php echo esc_html( $content ); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else:?>
            <?php esc_html_e( 'No Testimonial Found' , 'eikra-core' ); ?>
        <?php endif; ?>
        <?php wp_reset_query();?>
    </div>
</div>
