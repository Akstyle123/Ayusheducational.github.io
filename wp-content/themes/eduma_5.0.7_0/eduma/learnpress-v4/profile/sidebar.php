<?php
/**
 * Template for displaying sidebar in user profile.
 *
 * @author ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
 
<aside id="profile-sidebar">
	<div class="wrapper-profile-header wrap-fullwidth">
		<div class="lp-content-area lp-profile-content-area">
				<?php do_action( 'learn-press/user-profile-account' ); ?>
		</div>
	</div>
	<?php do_action( 'learn-press/user-profile-tabs' ); ?>

</aside>
