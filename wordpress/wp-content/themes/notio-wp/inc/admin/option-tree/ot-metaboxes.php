<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'thb_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function thb_custom_meta_boxes() {

	/**
	 * Create a custom meta boxes array that we pass to
	 * the OptionTree Meta Box API Class.
	 */

	$post_meta_box_sidebar_gallery = array(
		'id'       => 'meta_box_sidebar_gallery',
		'title'    => 'Gallery',
		'pages'    => array( 'post' ),
		'context'  => 'side',
		'priority' => 'low',
		'fields'   => array(
			array(
				'id'        => 'pp_gallery_slider',
				'type'      => 'gallery',
				'post_type' => 'post',
			),
		),
	);
	$portfolio_metabox             = array(
		'id'       => 'portfolio_metaboxes',
		'title'    => 'Portfolio Settings',
		'pages'    => apply_filters( 'thb_portfolio_metabox_pages', array( 'portfolio' ) ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'    => 'tab0',
				'label' => esc_html__( 'Header Settings', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label' => esc_html__( 'Transparent Header', 'notio' ),
				'id'    => 'transparent_header',
				'type'  => 'on_off',
				'desc'  => esc_html__( 'If enabled, content will be below the header.', 'notio' ),
				'std'   => 'off',
			),
			array(
				'label'     => esc_html__( 'Main Header Color', 'notio' ),
				'id'        => 'header_color',
				'type'      => 'radio-image',
				'desc'      => esc_html__( 'Overrides the main header color of the theme. Changes the logo and menu colors', 'notio' ),
				'std'       => 'dark-header',
				'condition' => 'transparent_header:is(on)',
			),
			array(
				'id'    => 'tab1',
				'label' => esc_html__( 'Listing Settings', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label' => esc_html__( 'Main Color', 'notio' ),
				'id'    => 'main_color',
				'type'  => 'colorpicker_opacity',
				'desc'  => esc_html__( 'Used for hover colors and certain sliders', 'notio' ),
			),
			array(
				'label' => esc_html__( 'Main Title Color', 'notio' ),
				'id'    => 'main_color_title',
				'type'  => 'radio-image',
				'desc'  => esc_html__( 'Used for hover colors and certain sliders. Also used for overall colors in Full Screen template.', 'notio' ),
				'std'   => 'dark-title',
			),
			array(
				'label' => esc_html__( 'Hover Image', 'notio' ),
				'id'    => 'main_hover_image',
				'type'  => 'upload',
				'class' => 'ot-upload-attachment-id',
				'desc'  => esc_html__( 'This is used when the hover style is set to "Show Hover Image" inside VC element settings', 'notio' ),
			),
			array(
				'label' => esc_html__( 'Custom Masonry Size', 'notio' ),
				'id'    => 'masonry_size',
				'type'  => 'radio-image',
				'desc'  => esc_html__( 'This changes the size of the masonry when Portfolio Masonry element is being used and Custom layout is selected. ', 'notio' ),
				'std'   => 'small',
			),
			array(
				'label'   => esc_html__( 'Listing Type', 'notio' ),
				'id'      => 'main_listing_type',
				'type'    => 'radio',
				'desc'    => esc_html__( 'By default, portfolio image links to the portfolio page.', 'notio' ),
				'choices' => array(
					array(
						'label' => esc_html__( 'Regular', 'notio' ),
						'value' => 'regular',
					),
					array(
						'label' => esc_html__( 'Lightbox - Image', 'notio' ),
						'value' => 'lightbox',
					),
					array(
						'label' => esc_html__( 'Lightbox - Video', 'notio' ),
						'value' => 'lightbox-video',
					),
					array(
						'label' => esc_html__( 'Link', 'notio' ),
						'value' => 'link',
					),
					array(
						'label' => esc_html__( 'Video (Background)', 'notio' ),
						'value' => 'video',
					),
				),
				'std'     => 'regular',
			),
			array(
				'label'     => esc_html__( 'Enter Link', 'notio' ),
				'id'        => 'main_listing_link',
				'type'      => 'text',
				'desc'      => esc_html__( 'Enter the url of the page you want the portfolio item to link to or Video URL if "Lightbox Video" is selected', 'notio' ),
				'operator'  => 'or',
				'condition' => 'main_listing_type:is(link),main_listing_type:is(lightbox-video)',
			),
			array(
				'label'     => esc_html__( 'Set Video URL', 'notio' ),
				'id'        => 'main_listing_video',
				'type'      => 'upload',
				'desc'      => esc_html__( 'You can set the video for this portfolio here. Only MP4 extension is allowed.', 'notio' ),
				'condition' => 'main_listing_type:is(video)',
			),
			array(
				'id'    => 'tab2',
				'label' => esc_html__( 'General Settings', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label' => esc_html__( 'Portfolio Background', 'notio' ),
				'id'    => 'page_bg',
				'type'  => 'background',
				'desc'  => esc_html__( 'Background settings for this portfolio', 'notio' ),
			),
			array(
				'id'    => 'tab3',
				'label' => esc_html__( 'Attributes', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label'    => esc_html__( 'Add Custom Attributes', 'notio' ),
				'id'       => 'attributes',
				'type'     => 'list-item',
				'settings' => array(
					array(
						'label' => esc_html__( 'Value', 'notio' ),
						'id'    => 'client_custom_value',
						'type'  => 'text',
						'desc'  => esc_html__( 'The value of the attribute', 'notio' ),
					),
					array(
						'label' => esc_html__( 'Link', 'notio' ),
						'id'    => 'client_custom_link',
						'type'  => 'text',
						'desc'  => esc_html__( 'If you want to link this attribute to a website.', 'notio' ),
					),
				),
			),
		),
	);
	$page_metabox                  = array(
		'id'       => 'post_metaboxes_combined',
		'title'    => 'Page Settings',
		'pages'    => apply_filters( 'thb_page_metabox_pages', array( 'page' ) ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'id'    => 'tab0',
				'label' => esc_html__( 'Header Settings', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label' => esc_html__( 'Transparent Header', 'notio' ),
				'id'    => 'transparent_header',
				'type'  => 'on_off',
				'desc'  => esc_html__( 'If enabled, content will be below the header.', 'notio' ),
				'std'   => 'off',
			),
			array(
				'label'     => esc_html__( 'Main Header Color', 'notio' ),
				'id'        => 'header_color',
				'type'      => 'radio-image',
				'desc'      => esc_html__( 'Overrides the main header color of the theme. Changes the logo and menu colors', 'notio' ),
				'std'       => 'dark-header',
				'condition' => 'transparent_header:is(on)',
			),
			array(
				'id'    => 'tab1',
				'label' => esc_html__( 'Page Settings', 'notio' ),
				'type'  => 'tab',
			),
			array(
				'label' => esc_html__( 'Page Background', 'notio' ),
				'id'    => 'page_bg',
				'type'  => 'background',
				'desc'  => esc_html__( 'Background settings for this page', 'notio' ),
			),
		),
	);

	/**
	 * Register our meta boxes using the
	 * ot_register_meta_box() function.
	 */
	ot_register_meta_box( $page_metabox );
	ot_register_meta_box( $portfolio_metabox );
}
