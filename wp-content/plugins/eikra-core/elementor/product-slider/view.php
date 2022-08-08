<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $data['item_no'],
);

if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}
$query = new WP_Query( $args );

if ( !is_woocommerce() ){
    echo '<div class="woocommerce">';
}
?>
    <div class="rt-vc-products owl-wrap rt-owl-nav-1 related products">
        <div class="section-title clearfix">
            <?php if (!empty($data['title'])): ?>
                <h2 class="owl-custom-nav-title"><?php echo esc_html( $data['title'] ); ?></h2>
            <?php endif; ?>
            <div class="owl-custom-nav">
                <div class="owl-prev"><i class="fas fa-angle-left"></i></div><div class="owl-next"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
        <?php if ( $query->have_posts() ) : ?>
            <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] ); ?>">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <ul class="products"><?php wc_get_template_part( 'content', 'product' ); ?></ul>
                <?php endwhile;?>
            </div>
        <?php endif;?>
        <?php wp_reset_query();?>
    </div>
<?php
if ( !is_woocommerce() ){
    echo '</div>';
}