	</div><!-- End role["main"] -->
	<?php
	if ( 'off' !== ot_get_option( 'footer' ) ) {
		get_template_part( 'inc/templates/footer/' . ot_get_option( 'footer_style', 'style1' ) );
	}
	?>
	<!-- Start Mobile Menu -->
	<?php get_template_part( 'inc/templates/header/mobile_menu' ); ?>
	<!-- End Mobile Menu -->

	<!-- Start Quick Cart -->
	<?php do_action( 'thb_side_cart' ); ?>
	<!-- End Quick Cart -->
</div> <!-- End #wrapper -->
<?php

	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>
