<?php
	$vars      = $wp_query->query_vars;
	$thb_count = array_key_exists( 'thb_count', $vars ) ? $vars['thb_count'] : false;
	$thb_color = array_key_exists( 'thb_color', $vars ) ? $vars['thb_color'] : false;

	$thb_id    = get_the_ID();
	$image_id  = get_post_thumbnail_id( $thb_id );
	$image_url = wp_get_attachment_image_src( $image_id, 'full' );

	$terms = get_the_terms( $thb_id, 'project-category' );

	$cats = '';
if ( ! empty( $terms ) ) {
	foreach ( $terms as $thb_term ) {
		$cats .= ' thb-cat-' . strtolower( $thb_term->slug ); }
} else {
	$cats = '';
}

	// Listing Type
	$main_listing_type = get_post_meta( $thb_id, 'main_listing_type', true );
	$permalink         = '';
	$link_class[]      = 'portfolio-link';
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
	$link_class[]       = 'thb-video-item';
}

	$link_class[] = $cats;
	$link_class[] = $thb_color;
	$link_class[] = 'type-portfolio';
	$link_class[] = 'portfolio-text-style1';

	// Video Item
if ( $main_listing_type == 'video' ) {
	$main_listing_video = get_post_meta( $thb_id, 'main_listing_video', true );
	$link_class[]       = 'thb-video-item';
}
?>
<a <?php post_class( $link_class ); ?> href="<?php echo esc_url( $permalink ); ?>">
	<span class="thb_count"><?php echo str_pad( $thb_count, 2, '0', STR_PAD_LEFT ); ?></span>
	<h1><?php the_title(); ?></h1>
	<figure>
		<?php if ( $main_listing_type == 'video' ) { ?>
			<div class="thb-portfolio-video" data-vide-bg="mp4: <?php echo esc_url( $main_listing_video ); ?>, poster: <?php echo esc_attr( $image_url[0] ); ?>" data-vide-options="posterType: 'auto', autoplay: false, loop: true, muted: true, position: 50% 50%, resizing: true"></div>
		<?php } ?>
		<?php the_post_thumbnail( 'notio-wide-x2' ); ?>
	</figure>
</a>
