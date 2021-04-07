<?php

function thb_filter_radio_images( $array, $field_id ) {
	if ( $field_id === 'header_style' ) {
		$array = array(
			array(
				'value' => 'style1',
				'label' => esc_html__( 'Style 1', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style1.png',
			),
			array(
				'value' => 'style2',
				'label' => esc_html__( 'Style 2', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style2.png',
			),
			array(
				'value' => 'style3',
				'label' => esc_html__( 'Style 3', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style3.png',
			),
		);
	}
	if ( $field_id === 'blog_style' ) {
		$array = array(
			array(
				'value' => 'style1',
				'label' => esc_html__( 'Style 1', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style1.jpg',
			),
			array(
				'value' => 'style2',
				'label' => esc_html__( 'Style 2', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style2.jpg',
			),
			array(
				'value' => 'style3',
				'label' => esc_html__( 'Style 3', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style3.jpg',
			),
			array(
				'value' => 'style4',
				'label' => esc_html__( 'Style 4', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style4.jpg',
			),
			array(
				'value' => 'style5',
				'label' => esc_html__( 'Style 5', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style5.jpg',
			),
			array(
				'value' => 'style6',
				'label' => esc_html__( 'Style 6', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style6.jpg',
			),
			array(
				'value' => 'style7',
				'label' => esc_html__( 'Style 7', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style7.jpg',
			),
			array(
				'value' => 'style8',
				'label' => esc_html__( 'Style 8', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/blog_styles/style8.jpg',
			),
		);
	}
	if ( in_array( $field_id, array( 'footer_color', 'subfooter_color' ) ) ) {
		$array = array(
			array(
				'value' => 'light',
				'label' => esc_html__( 'Light - White Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png',
			),
			array(
				'value' => 'dark',
				'label' => esc_html__( 'Dark - Black Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png',
			),
		);
	}
	if ( in_array( $field_id, array( 'header_color' ) ) ) {
		$array = array(
			array(
				'value' => 'light-header',
				'label' => esc_html__( 'Light - White Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png',
			),
			array(
				'value' => 'dark-header',
				'label' => esc_html__( 'Dark - Black Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png',
			),
		);
	}
	if ( in_array( $field_id, array( 'header_full_menu_submenu_color' ) ) ) {
		$array = array(
			array(
				'value' => 'style1',
				'label' => esc_html__( 'Light - White Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png',
			),
			array(
				'value' => 'style2',
				'label' => esc_html__( 'Dark - Black Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png',
			),
		);
	}
	if ( in_array( $field_id, array( 'main_color_title' ) ) ) {
		$array = array(
			array(
				'value' => 'light-title',
				'label' => esc_html__( 'Light - White Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png',
			),
			array(
				'value' => 'dark-title',
				'label' => esc_html__( 'Dark - Black Background', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png',
			),
		);
	}
	if ( $field_id === 'footer_columns' ) {
		$array = array(
			array(
				'value' => 'fourcolumns',
				'label' => esc_html__( 'Four Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/four-columns.png',
			),
			array(
				'value' => 'threecolumns',
				'label' => esc_html__( 'Three Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/three-columns.png',
			),
			array(
				'value' => 'twocolumns',
				'label' => esc_html__( 'Two Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/two-columns.png',
			),
			array(
				'value' => 'doubleleft',
				'label' => esc_html__( 'Double Left Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleleft-columns.png',
			),
			array(
				'value' => 'doubleright',
				'label' => esc_html__( 'Double Right Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleright-columns.png',
			),
			array(
				'value' => 'fivecolumns',
				'label' => esc_html__( 'Five Columns', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/five-columns.png',
			),
			array(
				'value' => 'onecolumns',
				'label' => esc_html__( 'Single Column', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/one-columns.png',
			),

		);
	}
	if ( $field_id === 'subfooter_style' ) {
		$array = array(
			array(
				'value' => 'style1',
				'label' => esc_html__( 'Style 1', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/subfooter/style1.png',
			),
			array(
				'value' => 'style2',
				'label' => esc_html__( 'Style 2', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/subfooter/style2.png',
			),
		);
	}
	if ( $field_id === 'masonry_size' ) {
		$array = array(
			array(
				'value' => 'large',
				'label' => esc_html__( 'large', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/masonry/large.png',
			),
			array(
				'value' => 'small',
				'label' => esc_html__( 'small', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/masonry/small.png',
			),
			array(
				'value' => 'wide',
				'label' => esc_html__( 'wide', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/masonry/wide.png',
			),
			array(
				'value' => 'tall',
				'label' => esc_html__( 'tall', 'notio' ),
				'src'   => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/masonry/tall.png',
			),
		);
	}
	return $array;

}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_social_links_settings( $id ) {

	$settings = array(
		array(
			'label'   => esc_html__( 'Social Network', 'notio' ),
			'id'      => 'social_network',
			'type'    => 'select',
			'desc'    => esc_html__( 'Select your social network', 'notio' ),
			'choices' => array(
				array(
					'label' => esc_html__( 'Facebook', 'notio' ),
					'value' => 'facebook',
				),
				array(
					'label' => esc_html__( 'Twitter', 'notio' ),
					'value' => 'twitter',
				),
				array(
					'label' => esc_html__( 'Behance', 'notio' ),
					'value' => 'behance',
				),
				array(
					'label' => esc_html__( 'Pinterest', 'notio' ),
					'value' => 'pinterest',
				),
				array(
					'label' => esc_html__( 'Linkedin', 'notio' ),
					'value' => 'linkedin',
				),
				array(
					'label' => esc_html__( 'Instagram', 'notio' ),
					'value' => 'instagram',
				),
				array(
					'label' => esc_html__( 'Flickr', 'notio' ),
					'value' => 'flickr',
				),
				array(
					'label' => esc_html__( 'VK', 'notio' ),
					'value' => 'vk',
				),
				array(
					'label' => esc_html__( 'Tumblr', 'notio' ),
					'value' => 'tumblr',
				),
				array(
					'label' => esc_html__( 'Spotify', 'notio' ),
					'value' => 'spotify',
				),
				array(
					'label' => esc_html__( 'Youtube', 'notio' ),
					'value' => 'youtube',
				),
				array(
					'label' => esc_html__( 'Vimeo', 'notio' ),
					'value' => 'vimeo',
				),
				array(
					'label' => esc_html__( 'Dribbble', 'notio' ),
					'value' => 'dribbble',
				),
				array(
					'label' => esc_html__( '500px', 'notio' ),
					'value' => '500px',
				),
				array(
					'label' => esc_html__( 'Sound Cloud', 'notio' ),
					'value' => 'soundcloud',
				),
				array(
					'label' => esc_html__( 'Band Camp', 'notio' ),
					'value' => 'bandcamp',
				),
				array(
					'label' => esc_html__( 'Xing', 'notio' ),
					'value' => 'xing',
				),
				array(
					'label' => esc_html__( 'Github', 'notio' ),
					'value' => 'github',
				),
				array(
					'label' => esc_html__( 'CodePen', 'notio' ),
					'value' => 'codepen',
				),
				array(
					'label' => esc_html__( 'Foursquare', 'notio' ),
					'value' => 'foursquare',
				),
			),
		),
		array(
			'id'    => 'href',
			'label' => 'Link',
			'desc'  => sprintf( esc_html__( 'Enter a link to the profile or page on the social website. Remember to add the %s part to the front of the link.', 'notio' ), '<code>http://</code>' ),
			'type'  => 'text',
		),
	);

	return $settings;

}
add_filter( 'ot_social_links_settings', 'thb_social_links_settings' );

function thb_filter_options_name() {
	return __( '<a href="http://fuelthemes.net">Fuel Themes</a>', 'notio' );
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );

function thb_filter_admin_name() {
	return Thb_Theme_Admin::$thb_theme_name . esc_html__( ' Theme Options', 'notio' );
}
add_filter( 'ot_theme_options_page_title', 'thb_filter_admin_name', 10, 2 );

function thb_filter_upload_name() {
	return esc_html__( 'Send to Theme Options', 'notio' );
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_ot_recognized_font_families( $array, $field_id ) {
	$array['helveticaneue'] = "'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif";
	ot_fetch_google_fonts( true, false );
	$ot_google_fonts = wp_list_pluck( get_theme_mod( 'ot_google_fonts', array() ), 'family' );
	$array           = array_merge( $array, $ot_google_fonts );

	if ( ot_get_option( 'typekit_id' ) ) {
		$typekit_fonts = trim( ot_get_option( 'typekit_fonts' ), ' ' );
		$typekit_fonts = explode( ',', $typekit_fonts );

		$array = array_merge( $array, $typekit_fonts );
	}
	$self_hosted_names = array();
	if ( ot_get_option( 'self_hosted_fonts' ) ) {
		$self_hosted_fonts = ot_get_option( 'self_hosted_fonts' );

		foreach ( $self_hosted_fonts as $font ) {
			$self_hosted_names[] = $font['font_name'];
		}

		$array = array_merge( $array, $self_hosted_names );
	}

	foreach ( $array as $font => $value ) {
		$thb_font_array[ $value ] = $value;
	}
	return $thb_font_array;
}
add_filter( 'ot_recognized_font_families', 'thb_filter_ot_recognized_font_families', 10, 2 );

function thb_filter_typography_fields( $array, $field_id ) {

	if ( in_array( $field_id, array( 'primary_type', 'secondary_type', 'button_type', 'menu_type' ), true ) ) {
		$array = array( 'font-family' );
	} elseif ( in_array( $field_id, array( 'em_type', 'label_type' ), true ) ) {
		$array = array( 'font-family', 'font-style', 'font-weight' );
	} elseif ( in_array( $field_id, array( 'h1_type', 'h2_type', 'h3_type', 'h4_type', 'h5_type', 'h6_type' ), true ) ) {
		$array = array( 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
	} elseif ( in_array( $field_id, array( 'body_type' ), true ) ) {
		$array = array( 'font-color', 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
	} elseif ( in_array( $field_id, array( 'fullmenu_type', 'submenu_type', 'subfootermenu_type', 'shop_product_title', 'shop_product_detail_title', 'shop_product_detail_excerpt' ), true ) ) {
		$array = array( 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
	}
	return $array;

}
add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields', 10, 2 );

function thb_filter_ot_recognized_link_color_fields( $array, $field_id ) {
	$array = array(
		'link'  => esc_html_x( 'Standard', 'color picker', 'notio' ),
		'hover' => esc_html_x( 'Hover', 'color picker', 'notio' ),
	);
	return $array;
}
add_filter( 'ot_recognized_link_color_fields', 'thb_filter_ot_recognized_link_color_fields', 10, 2 );

function thb_filter_spacing_fields( $array, $field_id ) {

	if ( in_array( $field_id, array( 'footer_padding', 'subfooter_padding' ) ) ) {
		$array = array( 'top', 'bottom' );
	}
	return $array;

}
add_filter( 'ot_recognized_spacing_fields', 'thb_filter_spacing_fields', 10, 2 );

function thb_clear_font_cache() {
	$clear = filter_input( INPUT_GET, 'thb_clear_font_cache', FILTER_VALIDATE_BOOLEAN );
	if ( $clear && current_user_can( 'manage_options' ) ) {
		delete_transient( 'ot_google_fonts_cache' );
	}
}
add_action( 'admin_init', 'thb_clear_font_cache' );
