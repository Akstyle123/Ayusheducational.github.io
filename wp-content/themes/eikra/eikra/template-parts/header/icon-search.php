<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
<div class="search-box-area">
	<div class="search-box">
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>">
			<a href="#" class="search-close">
                <i class="fas fa-times"></i>
            </a>
			<input type="text" name="s" class="search-text" placeholder="<?php esc_attr_e( 'Search Here...', 'eikra' );?>" required>
			<a href="#" class="search-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5831 0.0288696C4.74765 0.0288696 0 4.76354 0 10.5831C0 16.4027 4.7477 21.1374 10.5831 21.1374C16.4186 21.1374 21.1663 16.4027 21.1663 10.5831C21.1663 4.76354 16.4186 0.0288696 10.5831 0.0288696ZM10.5831 19.4024C5.70418 19.4024 1.73494 15.4459 1.73494 10.5831C1.73494 5.72002 5.70418 1.76376 10.5831 1.76376C15.4621 1.76376 19.4313 5.72002 19.4313 10.5831C19.4314 15.4459 15.4621 19.4024 10.5831 19.4024Z" fill="#676767"/>
                    <path d="M23.7444 22.4886L18.048 16.8211C17.7083 16.4834 17.1591 16.4848 16.8211 16.8243C16.4834 17.1641 16.4848 17.7131 16.8243 18.0512L22.5207 23.7187C22.6902 23.887 22.9111 23.9711 23.1326 23.9711C23.3555 23.9711 23.5782 23.8858 23.7476 23.7155C24.0854 23.3757 24.0839 22.8266 23.7444 22.4886Z" fill="#676767"/>
                </svg>
            </a>
		</form>
	</div>
</div>