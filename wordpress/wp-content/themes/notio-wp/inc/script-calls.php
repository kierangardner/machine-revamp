<?php
// De-register Contact Form 7 styles.
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles.
function thb_main_styles() {
	global $post;
	$i                       = 0;
	$self_hosted_fonts       = ot_get_option( 'self_hosted_fonts' );
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	wp_dequeue_style( 'vc_lte_ie9' );
	wp_deregister_style( 'vc_lte_ie9' );

	// Enqueue.
	wp_enqueue_style( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/css/app.css', null, esc_attr( $thb_theme_version ) );

	if ( ! defined( 'THB_DEMO_SITE' ) ) {
		wp_enqueue_style( 'thb-style', get_stylesheet_uri(), null, esc_attr( $thb_theme_version ) );
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), null, esc_attr( $thb_theme_version ) );
	wp_add_inline_style( 'thb-app', thb_selection() );

	if ( $self_hosted_fonts ) {
		foreach ( $self_hosted_fonts as $font ) {
			$i++;
			wp_enqueue_style( 'thb-self-hosted-' . $i, $font['font_url'], null, esc_attr( $thb_theme_version ) );
		}
	}

	if ( $post ) {
		if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_main_styles' );

// Main Scripts.
function register_js() {
	if ( ! is_admin() ) {
		global $post;
		$thb_combined_libraries  = ot_get_option( 'thb_combined_libraries', 'on' );
		$thb_api_key             = ot_get_option( 'map_api_key' );
		$thb_dependency          = array( 'jquery', 'underscore' );
		$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
		$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

		// Register.
		if ( 'on' === $thb_combined_libraries ) {
			wp_enqueue_script( 'thb-vendor', esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor.min.js', array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			$thb_dependency[] = 'thb-vendor';
		} else {
			$thb_js_libraries = array(
				'TweenMax'                  => '_0TweenMax.min.js',
				'TweenMax-DrawSVGPlugin'    => '_1DrawSVGPlugin.js',
				'TweenMax-SplitText'        => '_1SplitText.min.js',
				'TweenMax-ScrollToPlugin'   => '_2ScrollToPlugin.min.js',
				'clipboard'                 => 'clipboard.min.js',
				'imagesloaded'              => 'imagesloaded.pkgd.min.js',
				'isotope'                   => 'isotope.pkgd.min.js',
				'isotope-packery-mode'      => 'packery-mode.pkgd.min.js',
				'jquery-foundation-plugins' => 'jquery.foundation.plugins.js',
				'magnific-popup'            => 'jquery.magnific-popup.min.js',
				'jquery-mousewheel'         => 'jquery.mousewheel.js',
				'panr'                      => 'jquery.panr.js',
				'vide'                      => 'jquery.vide.js',
				'js-cookie'                 => 'js.cookie.js',
				'lazysizes'                 => 'lazysizes.min.js',
				'mobile-detect'             => 'mobile-detect.min.js',
				'odometer'                  => 'odometer.min.js',
				'pace'                      => 'pace.min.js',
				'perfect-scrollbar'         => 'perfect-scrollbar.jquery.min.js',
				'jarallax'                  => 'jarallax-0.min.js',
				'lax'                       => 'lax.min.js',
				'slick'                     => 'slick.min.js',
				'sticky-kit'                => 'sticky-kit.min.js',
				'thb-3dimg'                 => 'thb_3dImg.js',
				'typed'                     => 'typed.min.js',
			);
			foreach ( $thb_js_libraries as $handle => $value ) {
				wp_enqueue_script( $handle, esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor/' . esc_attr( $value ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			}
		}
		wp_enqueue_script( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/js/app.min.js', $thb_dependency, esc_attr( $thb_theme_version ), true );

		// Enqueue.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if ( $post ) {
			if ( has_shortcode( $post->post_content, 'thb_map_parent' ) ) {
				wp_enqueue_script( 'gmapdep', 'https://maps.google.com/maps/api/js?key=' . esc_attr( $thb_api_key ), false, esc_attr( $thb_theme_version ), false );
			}

			if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}

		// Typekit.
		$typekit_id = ot_get_option( 'typekit_id' );
		if ( $typekit_id ) {
			wp_enqueue_script( 'thb-typekit', 'https://use.typekit.net/' . esc_attr( $typekit_id ) . '.js', false, esc_attr( $thb_theme_version ), false );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}

		wp_enqueue_script( 'thb-vendor' );
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'thb-app' );
		wp_localize_script(
			'thb-app',
			'themeajax',
			array(
				'url'      => admin_url( 'admin-ajax.php' ),
				'l10n'     => array(
					'loading' => esc_html__( 'Loading ...', 'notio' ),
					'nomore'  => esc_html__( 'No More Posts', 'notio' ),
					'added'   => esc_html__( 'Added To Cart', 'notio' ),
					'copied'  => esc_html__( 'Copied', 'notio' ),
					// translators: %curr%: index, %total% total
					'of'      => esc_html__( '%curr% of %total%', 'notio' ),
				),
				'settings' => array(
					'shop_product_listing_pagination' => ot_get_option( 'shop_product_listing_pagination', 'style1' ),
					'keyboard_nav'                    => ot_get_option( 'keyboard_nav', 'on' ),
					'is_cart'                         => thb_wc_supported() ? is_cart() : false,
					'is_checkout'                     => thb_wc_supported() ? is_checkout() : false,
				),
				'arrows'   => array(
					'left'   => thb_load_template_part( 'assets/svg/arrows_slim_left.svg' ),
					'right'  => thb_load_template_part( 'assets/svg/arrows_slim_right.svg' ),
					'top'    => thb_load_template_part( 'assets/img/svg/up-arrow.svg' ),
					'bottom' => thb_load_template_part( 'assets/img/svg/down-arrow.svg' ),
				),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'register_js' );

// WooCommerce.
function thb_woocommerce_scripts_styles() {

	if ( ! is_admin() ) {
		if ( thb_wc_supported() ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );

			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_deregister_style( 'yith-wcwl-font-awesome' );

			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-selectBox' );

			wp_dequeue_script( 'vc_woocommerce-add-to-cart-js' );
			if ( ! is_checkout() ) {
				wp_dequeue_script( 'jquery-selectBox' );
				wp_dequeue_style( 'selectWoo' );
				wp_dequeue_script( 'selectWoo' );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_woocommerce_scripts_styles', 98 );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

