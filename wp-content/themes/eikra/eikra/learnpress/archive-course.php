<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @see   LP_Template_General::template_header()
 * @since 4.0.0
 *
 */
do_action( 'learn-press/template-header' );

// Layout class
if ( RDTheme::$layout == 'full-width' ) {
	$rdtheme_layout_class = 'col-sm-12 col-12';
} else {
	$rdtheme_layout_class = 'col-sm-12 col-md-8 col-lg-9 col-12';
}
?>

    <div id="primary" class="content-area">
        <div class="container">
            <div class="row">
				<?php
				if ( RDTheme::$layout == 'left-sidebar' ) {
					get_sidebar();
				}
				?>
                <div class="<?php echo esc_attr( $rdtheme_layout_class ); ?>">
                    <main id="main" class="site-main">
						<?php
						/**
						 * LP Hook
						 */
						do_action( 'learn-press/before-main-content' );

						?>

                        <div class="lp-content-area">
                            <header class="learn-press-courses-header">
								<?php do_action( 'lp/template/archive-course/description' ); ?>
                            </header>

							<?php
							/**
							 * LP Hook
							 */
							do_action( 'learn-press/before-courses-loop' );
							if ( version_compare( LEARNPRESS_VERSION, '4', '>=' ) ) {
								LP()->template( 'course' )->begin_courses_loop();
							}

							while ( have_posts() ) :
								the_post();

								learn_press_get_template_part( 'content', 'course' );

							endwhile;

							if ( version_compare( LEARNPRESS_VERSION, '4', '>=' ) ) {
								LP()->template( 'course' )->end_courses_loop();
							}

							/**
							 * @since 3.0.0
							 */
							do_action( 'learn-press/after-courses-loop' );


							/**
							 * LP Hook
							 */
							do_action( 'learn-press/after-main-content' );

							?>
                        </div>
                    </main>
                </div>
				<?php
				if ( RDTheme::$layout == 'right-sidebar' ) {
					get_sidebar();
				}
				?>
            </div>
        </div>
    </div>
<?php
/**
 * @see   LP_Template_General::template_footer()
 * @since 4.0.0
 *
 */
do_action( 'learn-press/template-footer' );