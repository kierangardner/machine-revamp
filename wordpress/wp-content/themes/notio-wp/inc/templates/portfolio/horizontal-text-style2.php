<?php
	$thb_id           = get_the_ID();
	$main_color_title = get_post_meta( $thb_id, 'main_color_title', true );

	$meta = get_the_term_list( $thb_id, 'project-category', '', ', ', '' );
	$meta = wp_strip_all_tags( $meta );

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

	$link_class[] = $main_color_title;
	$link_class[] = 'columns';
	$link_class[] = 'type-portfolio';
	$link_class[] = $cats;
	$link_class[] = 'portfolio-text-style-2';
?>
<div class="small-12 columns">
	<a <?php post_class( $link_class ); ?> href="<?php echo esc_url( $permalink ); ?>">
		<h1><?php the_title(); ?></h1>
		<aside class="thb-categories"><span><?php echo esc_html( $meta ); ?></span></aside>
	</a>
</div>
