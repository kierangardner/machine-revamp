<?php
get_header();

$fourofour_page_content = ot_get_option( '404_page_content' );
if ( $fourofour_page_content ) {
	do_action( 'thb_page_content', $fourofour_page_content );
} else {
	?>
	<section class="content404">
		<div class="row full-height-content align-middle">
			<div class="small-12 medium-10 medium-centered large-8 columns text-center">
				<figure></figure>
				<h1><?php esc_html_e( 'Page cannot be found.', 'notio' ); ?></h1>
				<p>
					<?php
					echo wp_kses_post(
						"We are sorry. But the page you're looking for cannot be found. <br>
					You might try searching our site.",
						'notio'
					);
					?>
				</p>
				<div class="small-12 medium-6 medium-centered columns">
					<?php get_search_form(); ?>
				</div>
				<a href="<?php esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Back To Home', 'notio' ); ?></a>
			</div>
		</div>
	</section>
	<?php
}
get_footer();
