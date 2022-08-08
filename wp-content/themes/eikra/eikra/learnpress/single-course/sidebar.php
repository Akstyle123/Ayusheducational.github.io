<?php
/**
 * Template for displaying course sidebar.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hide sidebar if there is no content
 */
if ( ! is_active_sidebar( 'course-sidebar' ) && ! LP()->template( 'course' )->has_sidebar() ) {
	return;
}
if ( RDTheme::$layout == 'full-width' ) {
	return;
}
?>

<aside class="course-summary-sidebar">
    <div class="sidebar-widget-area">
		<?php
		if ( RDTheme::$sidebar !== 'sidebar' && is_active_sidebar( RDTheme::$sidebar ) ) {
            echo "<div class='custom-single-course-sidebar'>";
			    dynamic_sidebar( RDTheme::$sidebar );
            echo "<div>";

		} else {
			learn_press_get_template( 'custom/content-course-sidebar.php' );
        }
		?>
    </div>
</aside>
