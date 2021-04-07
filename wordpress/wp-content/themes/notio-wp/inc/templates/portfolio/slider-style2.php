<?php
	$thb_id = get_the_ID();

	$vars             = $wp_query->query_vars;
	$thb_button_hide  = array_key_exists( 'thb_button_hide', $vars ) ? $vars['thb_button_hide'] : false;
	$thb_button_style = array_key_exists( 'thb_button_style', $vars ) ? $vars['thb_button_style'] : 'style1';

	$image_id  = get_post_thumbnail_id( $thb_id );
	$image_url = wp_get_attachment_image_src( $image_id, 'full' );

	$main_color_title = get_post_meta( $thb_id, 'main_color_title', true );

	$categories = get_the_term_list( $thb_id, 'project-category', '', ', ', '' );
if ( $categories !== '' && ! empty( $categories ) ) {
	$categories = wp_strip_all_tags( $categories );
}

	$terms = get_the_terms( $thb_id, 'project-category' );
	$cats  = '';
if ( ! empty( $terms ) ) {
	foreach ( $terms as $thb_term ) {
		$cats .= ' thb-cat-' . strtolower( $thb_term->slug ); }
} else {
	$cats = '';
}

	$class[] = 'light-title';
	$class[] = 'text-center';
	$class[] = 'portfolio-slide';
	$class[] = $cats;
	$class[] = 'slider-style2';
	$class[] = 'type-portfolio';

	// Listing Type
	$main_listing_type = get_post_meta( $thb_id, 'main_listing_type', true );
	$permalink         = '';
	$link_class[]      = 'btn white';
	$link_class[]      = $thb_button_style;
if ( $main_listing_type == 'lightbox' ) {
	$permalink    = $image_url[0];
	$link_class[] = 'mfp-image';
} elseif ( $main_listing_type == 'link' ) {
	$permalink = get_post_meta( $thb_id, 'main_listing_link', true );
} elseif ( $main_listing_type == 'lightbox-video' ) {
	$permalink    = get_post_meta( $thb_id, 'main_listing_link', true );
	$link_class[] = 'mfp-video';
} else {
	$permalink = get_the_permalink();
}

	// Video Item
if ( $main_listing_type == 'video' ) {
	$main_listing_video = get_post_meta( $thb_id, 'main_listing_video', true );
	$class[]            = 'thb-video-slide';
}
?>
<div <?php post_class( $class ); ?> id="portfolio-<?php the_ID(); ?>" data-title="<?php the_title_attribute(); ?>">
	<div class="portfolio-holder full-height-content">
		<?php if ( $main_listing_type == 'video' ) { ?>
			<div class="thb-portfolio-video" data-vide-bg="mp4: <?php echo esc_url( $main_listing_video ); ?>, poster: <?php echo esc_attr( $image_url[0] ); ?>" data-vide-options="posterType: 'auto', autoplay: false, loop: true, muted: true, position: 50% 50%, resizing: true"></div>
		<?php } ?>
		<div class="thb-placeholder">
			<div class="thb-placeholder-inner">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		</div>
		<div class="portfolio-link">
			<div class="row max_width align-middle">
				<div class="small-12 columns">
				<h1><span><?php the_title(); ?></span></h1>
				<aside class="thb-categories"><span><?php echo esc_html( $categories ); ?></span></aside>
				<?php if ( $thb_button_hide !== '1' ) { ?>
				<a href="<?php echo esc_url( $permalink ); ?>" title="<?php esc_html_e( 'View Project', 'notio' ); ?>" class="<?php echo esc_attr( implode( ' ', $link_class ) ); ?>"><?php esc_html_e( 'View Project', 'notio' ); ?></a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
