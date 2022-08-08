<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$_phone = RDTheme::$options['phone'];
?>
<div class="menu-contact-info">
	<div class="icon">
		<i class="fa fa-phone-alt"></i>
	</div>
	<div class="info">
		<span><?php echo esc_html__('Call Us:', 'eikra') ?></span>
		<a href="tel:<?php echo esc_attr($_phone) ?>"><?php echo esc_html($_phone) ?></a>
	</div>
</div>