<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$course_category = get_terms( 'course_category', 'orderby=count&hide_empty=0' );
$count_cat       = count( $course_category );
if ( empty( $course_category ) && ! is_array( $course_category ) && ! $count_cat ) {
	return;
}
?>

<div class="top-menu-category">
    <div id="site-navigation" class="main-navigation">
        <nav>
            <ul class="menu">
                <li class="menu-item menu-item-has-children">
                    <a href="#">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="4" height="4" fill="black"/>
                            <rect y="18" width="4" height="4" fill="black"/>
                            <rect y="9" width="4" height="4" fill="black"/>
                            <rect x="9" width="4" height="4" fill="black"/>
                            <rect x="9" y="18" width="4" height="4" fill="black"/>
                            <rect x="9" y="9" width="4" height="4" fill="black"/>
                            <rect x="18" width="4" height="4" fill="black"/>
                            <rect x="18" y="18" width="4" height="4" fill="black"/>
                            <rect x="18" y="9" width="4" height="4" fill="black"/>
                        </svg>
						<?php echo esc_html( 'Category', 'eikra' ) ?>
                    </a>

                    <ul class="sub-menu <?php echo esc_attr( $count_cat > 12 ? 'has-many-items' : '' ) ?>">
						<?php foreach ( $course_category as $term ) :
							$term_link = get_term_link( $term );
							?>
                            <li>
                                <a href="<?php echo esc_url( $term_link ) ?>"><?php echo esc_html( $term->name ) ?></a>
                            </li>
						<?php endforeach; ?>

                    </ul>

                </li>
            </ul>
        </nav>
    </div>
</div>
