<?php function thb_blog_posts() {
	check_ajax_referer( 'thb_blog_ajax', 'security' );
	$page       = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );
	$thb_i      = filter_input( INPUT_POST, 'thb_i', FILTER_VALIDATE_INT );
	$ppp        = get_option( 'posts_per_page' );
	$blog_style = ot_get_option( 'blog_style', 'style3' );

	$args = array(
		'posts_per_page' => $ppp,
		'paged'          => $page,
		'post_status'    => 'publish',
	);

	$more_query = new WP_Query( $args );

	add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );
	if ( $more_query->have_posts() ) :
		while ( $more_query->have_posts() ) :
			$more_query->the_post();
			$thb_i++;
			set_query_var( 'thb_i', $thb_i );
			get_template_part( 'inc/templates/blogbit/' . $blog_style );
	endwhile;
endif;
	wp_die();
}
add_action( 'wp_ajax_nopriv_thb_blog_ajax', 'thb_blog_posts' );
add_action( 'wp_ajax_thb_blog_ajax', 'thb_blog_posts' );

function thb_load_more() {
	check_ajax_referer( 'thb_ajax', 'security' );
	$i              = filter_input( INPUT_POST, 'i', FILTER_VALIDATE_INT );
	$columns        = filter_input( INPUT_POST, 'columns', FILTER_SANITIZE_STRING );
	$aspect         = filter_input( INPUT_POST, 'aspect', FILTER_VALIDATE_BOOLEAN );
	$style          = filter_input( INPUT_POST, 'style', FILTER_SANITIZE_STRING );
	$masonry_layout = filter_input( INPUT_POST, 'layout', FILTER_SANITIZE_STRING );
	$thb_masonry    = filter_input( INPUT_POST, 'thb_masonry', FILTER_SANITIZE_STRING );
	$thb_size       = filter_input( INPUT_POST, 'thb_size', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
	$grid_type      = filter_input( INPUT_POST, 'grid_type', FILTER_VALIDATE_INT );
	$loop           = filter_input( INPUT_POST, 'loop', FILTER_SANITIZE_STRING );
	$page           = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );
	$hover_style    = filter_input( INPUT_POST, 'hover_style', FILTER_SANITIZE_STRING );
	$title_position = filter_input( INPUT_POST, 'title_position', FILTER_SANITIZE_STRING );
	$loop          .= '|paged:' . $page;

	$source_data   = VcLoopSettings::parseData( $loop );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts         = $query_builder->build();
	$posts         = $posts[1];
	$is_custom     = 'style1' === $style && 'custom' === $masonry_layout;
	add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );

	if ( $posts->have_posts() ) :
		while ( $posts->have_posts() ) :
			$posts->the_post();
			$i++;
			$columns = $aspect ? $columns : $columns . ' padding-1';
			$size    = ( 'style1' === $style && $masonry_layout ) ? thb_get_portfolio_size( $masonry_layout, $i, 0 ) : $thb_size;

			$thb_masonry = $aspect ? $aspect : $thb_masonry;
			set_query_var( 'thb_masonry', $thb_masonry );
			if ( $is_custom ) {
				set_query_var( 'thb_grid_type', $grid_type );
				set_query_var( 'thb_masonry', 'custom' );
			}
			set_query_var( 'thb_size', $size );
			set_query_var( 'thb_hover_style', $hover_style );
			set_query_var( 'thb_title_position', $title_position );
			get_template_part( 'inc/templates/portfolio/' . $style );
	endwhile;
endif;
	wp_die();
}
add_action( 'wp_ajax_nopriv_thb_ajax', 'thb_load_more' );
add_action( 'wp_ajax_thb_ajax', 'thb_load_more' );
