<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
    'post_type'      => 'lp_course',
    'posts_per_page' => $data['item_no'],
    'ignore_sticky_posts' => 1,
);

$orderby = $data['orderby'];

switch ( $orderby ) {
    case 'date':
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
        break;
    case 'title':
        $args['orderby'] = 'title';
        $args['order']   = 'ASC';
        break;
    case 'menu_order':
        $args['orderby'] = 'menu_order';
        $args['order']   = 'ASC';
        break;
    case 'popularity':
        $args['meta_key'] = '_lp_students';
        $args['orderby'] = 'meta_value_num';
        $args['order']   = 'DESC';
        break;
    default:
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
        break;
}

if ( !empty( $data['cat'] ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'course_category',
            'field' => 'term_id',
            'terms' => $data['cat'],
        )
    );
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;

$style = isset( $data['style'] ) ? $data['style'] : '1';

?>

<div class="rt-vc-course-slider owl-wrap rt-owl-nav-1 style-<?php echo esc_attr( $style );?>">
    <div class="section-title clearfix">
        <h2 class="owl-custom-nav-title"><?php echo esc_html( $data['title'] );?></h2>
        <div class="owl-custom-nav">
            <div class="owl-prev"><i class="fas fa-angle-left"></i></div><div class="owl-next"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] ); ?>">
        <?php if ( have_posts() ) :?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                if ( RDTheme_Helper::is_LMS() ) {
                    if ( $style != 1 ) {
                        learn_press_get_template( "custom/course-box-{$style}.php" );
                    }
                    else {
                        learn_press_get_template( 'custom/course-box.php' );
                    }
                }
                else {
                    get_template_part( 'template-parts/content', 'course-box' );
                }
                ?>
            <?php endwhile;?>
        <?php endif;?>
        <?php wp_reset_query();?>
    </div>
</div>

