<?php
	$thb_id       = get_the_ID();
	$vars         = $wp_query->query_vars;
	$thb_color    = array_key_exists( 'thb_color', $vars ) ? $vars['thb_color'] : false;
	$link_class[] = 'portfolio-text-style3';
	$link_class[] = $thb_color;
	$link_class[] = 'type-portfolio';

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

?>
<a <?php post_class( $link_class ); ?> href="<?php echo esc_url( $permalink ); ?>">
	<h2><?php the_title(); ?></h2>
</a>
