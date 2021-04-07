<?php function thb_selection() {
	$thb_id = get_queried_object_id();
	ob_start();
	?>
/* Typography */
	<?php if ( $primary_type = ot_get_option( 'primary_type' ) ) { ?>
h1,h2,h3,h4,h5,h6,
blockquote p,
.thb-portfolio-filter .filters,
.thb-portfolio .type-portfolio.hover-style5 .thb-categories {
		<?php thb_typeoutput( $primary_type, false, 'Work Sans' ); ?>
}
<?php } ?>
	<?php if ( $text_color = ot_get_option( 'text_color' ) ) { ?>
body {
	color: <?php echo esc_attr( $text_color ); ?>
}
<?php } ?>
	<?php if ( $secondary_type = ot_get_option( 'secondary_type' ) ) { ?>
body {
		<?php thb_typeoutput( $secondary_type, false, 'Karla' ); ?>
}
<?php } ?>
	<?php if ( $h1_type = ot_get_option( 'h1_type' ) ) { ?>
h1,
.h1 {
		<?php thb_typeoutput( $h1_type ); ?>
}
<?php } ?>
	<?php if ( $h2_type = ot_get_option( 'h2_type' ) ) { ?>
h2 {
		<?php thb_typeoutput( $h2_type ); ?>
}
<?php } ?>
	<?php if ( $h3_type = ot_get_option( 'h3_type' ) ) { ?>
h3 {
		<?php thb_typeoutput( $h3_type ); ?>
}
<?php } ?>
	<?php if ( $h4_type = ot_get_option( 'h4_type' ) ) { ?>
h4 {
		<?php thb_typeoutput( $h4_type ); ?>
}
<?php } ?>
	<?php if ( $h5_type = ot_get_option( 'h5_type' ) ) { ?>
h5 {
		<?php thb_typeoutput( $h5_type ); ?>
}
<?php } ?>
	<?php if ( $h6_type = ot_get_option( 'h6_type' ) ) { ?>
h6 {
		<?php thb_typeoutput( $h6_type ); ?>
}
<?php } ?>
	<?php if ( $body_type = ot_get_option( 'body_type' ) ) { ?>
body p {
		<?php thb_typeoutput( $body_type ); ?>
}
<?php } ?>
	<?php if ( $footer_type = ot_get_option( 'footer_type' ) ) { ?>
.footer p,
.footer .widget p,
.footer .widget ul li {
		<?php thb_typeoutput( $footer_type ); ?>
}
<?php } ?>
	<?php if ( $fullmenu_type = ot_get_option( 'fullmenu_type' ) ) { ?>
#full-menu .sf-menu > li > a {
		<?php thb_typeoutput( $fullmenu_type ); ?>
}
<?php } ?>
	<?php if ( $submenu_type = ot_get_option( 'submenu_type' ) ) { ?>
#full-menu .sub-menu li a {
		<?php thb_typeoutput( $submenu_type ); ?>
}
<?php } ?>
	<?php if ( $subfootermenu_type = ot_get_option( 'subfootermenu_type' ) ) { ?>
.subfooter .thb-subfooter-menu li a {
		<?php thb_typeoutput( $subfootermenu_type ); ?>
}
<?php } ?>
	<?php if ( $button_type = ot_get_option( 'button_type' ) ) { ?>
input[type="submit"],
submit,
.button,
.btn,
.btn-block,
.btn-text,
.vc_btn3 {
		<?php thb_typeoutput( $button_type ); ?>
}
<?php } ?>
	<?php if ( $em_type = ot_get_option( 'em_type' ) ) { ?>
em {
		<?php thb_typeoutput( $em_type ); ?>
}
	<?php } ?>
	<?php if ( $label_type = ot_get_option( 'label_type' ) ) { ?>
label {
		<?php thb_typeoutput( $label_type ); ?>
}
	<?php } ?>
	<?php if ( $menu_type = ot_get_option( 'menu_type' ) ) { ?>
#full-menu .sf-menu>li>a,
.mobile-menu a {
		<?php thb_typeoutput( $menu_type ); ?>
}
<?php } ?>

	<?php if ( $footer_widget_title_type = ot_get_option( 'footer_widget_title_type' ) ) { ?>
.footer .widget h6 {
		<?php thb_typeoutput( $footer_widget_title_type ); ?>
}
<?php } ?>

	<?php if ( $shop_product_title = ot_get_option( 'shop_product_title' ) ) { ?>
.products .product h3 {
		<?php thb_typeoutput( $shop_product_title ); ?>
}
<?php } ?>
	<?php if ( $shop_product_detail_title = ot_get_option( 'shop_product_detail_title' ) ) { ?>
.product-page .product-information h1.product_title {
		<?php thb_typeoutput( $shop_product_detail_title ); ?>
}
<?php } ?>
	<?php if ( $shop_product_detail_excerpt = ot_get_option( 'shop_product_detail_excerpt' ) ) { ?>
.thb-product-detail .product-information .woocommerce-product-details__short-description,
.thb-product-detail .product-information .woocommerce-product-details__short-description p {
		<?php thb_typeoutput( $shop_product_detail_excerpt ); ?>
}
<?php } ?>

/* Header */
	<?php if ( $logo_height = ot_get_option( 'logo_height' ) ) { ?>
.header .logolink .logoimg {
	max-height: <?php thb_measurementoutput( $logo_height ); ?>;
}
.header .logolink .logoimg[src$=".svg"] {
	max-height: 100%;
	height: <?php thb_measurementoutput( $logo_height ); ?>;
}
<?php } ?>

	<?php if ( $logo_mobile_height = ot_get_option( 'logo_mobile_height' ) ) { ?>
@media screen and (max-width: 40.0625em) {
	.header .logolink .logoimg {
		max-height: <?php thb_measurementoutput( $logo_mobile_height ); ?>;
	}
	.header .logolink .logoimg[src$=".svg"] {
		max-height: 100%;
		height: <?php thb_measurementoutput( $logo_mobile_height ); ?>;
	}
}
<?php } ?>
	<?php if ( $header_height = ot_get_option( 'header_height' ) ) { ?>
.header {
	height: <?php thb_measurementoutput( $header_height ); ?>;
}
.header-margin, #searchpopup, #mobile-menu, #side-cart, #wrapper [role="main"], .pace, .share_container {
	margin-top: <?php thb_measurementoutput( $header_height ); ?>;
}
<?php } ?>

	<?php if ( $header_mobile_height = ot_get_option( 'header_mobile_height' ) ) { ?>
@media screen and (max-width: 40.0625em) {
	.header {
		height: <?php thb_measurementoutput( $header_mobile_height ); ?>;
	}
	.header-margin, #searchpopup, #mobile-menu, #side-cart, #wrapper [role="main"], .pace, .share_container {
		margin-top: <?php thb_measurementoutput( $header_mobile_height ); ?>;
	}
}
<?php } ?>
	<?php if ( $menu_margin = ot_get_option( 'menu_margin' ) ) { ?>
#full-menu .sf-menu>li+li {
	margin-left: <?php thb_measurementoutput( $menu_margin ); ?>
}
#full-menu+a {
	margin-left: <?php thb_measurementoutput( $menu_margin ); ?>
}
<?php } ?>
/* Colors */
	<?php if ( $accent_color = ot_get_option( 'accent_color' ) ) { ?>
.underline-link:after, .products .product .product_after_title .button:after, .wpb_text_column a:after, .widget.widget_price_filter .price_slider .ui-slider-handle, .btn.style5, .button.style5, input[type=submit].style5, .btn.style6, .button.style6, input[type=submit].style6, .btn.accent, .btn#place_order, .btn.checkout-button, .button.accent, .button#place_order, .button.checkout-button, input[type=submit].accent, input[type=submit]#place_order, input[type=submit].checkout-button,.products .product .product_after_title .button:after, .woocommerce-tabs .tabs li a:after, .woocommerce-MyAccount-navigation ul li:hover a, .woocommerce-MyAccount-navigation ul li.is-active a, .thb-client-row.has-border.thb-opacity.with-accent .thb-client:hover, .product-page .product-information .single_add_to_cart_button:hover {
	border-color: <?php echo esc_attr( $accent_color ); ?>;
}
.woocommerce-MyAccount-navigation ul li:hover + li a, .woocommerce-MyAccount-navigation ul li.is-active + li a {
	border-top-color: <?php echo esc_attr( $accent_color ); ?>;
}
a:hover, #full-menu .sf-menu > li.current-menu-item > a, #full-menu .sf-menu > li.sfHover > a, #full-menu .sf-menu > li > a:hover, .header_full_menu_submenu_color_style2 #full-menu .sub-menu a:hover, #full-menu .sub-menu li a:hover, .footer.style1 .social-links a.email:hover, .post .post-title a:hover, .widget.widget_recent_entries ul li .url, .widget.widget_recent_comments ul li .url, .widget.woocommerce.widget_layered_nav ul li .count, .widget.widget_price_filter .price_slider_amount .button, .widget.widget_price_filter .price_slider_amount .button:hover, .pagination .page-numbers.current, .btn.style3:before, .button.style3:before, input[type=submit].style3:before, .btn.style5:hover, .button.style5:hover, input[type=submit].style5:hover, .mobile-menu > li.current-menu-item > a, .mobile-menu > li.sfHover > a, .mobile-menu > li > a:hover, .mobile-menu > li > a.active, .mobile-menu .sub-menu li a:hover, .authorpage .author-content .square-icon:hover, .authorpage .author-content .square-icon.email:hover, #comments .commentlist .comment .reply, #comments .commentlist .comment .reply a, .thb-portfolio-filter.style1 .filters li a:hover, .thb-portfolio-filter.style1 .filters li a.active, .products .product .product_after_title .button, .product-page .product-information .price,.product-page .product-information .reset_variations, .product-page .product-information .product_meta > span a, .woocommerce-tabs .tabs li a:hover, .woocommerce-tabs .tabs li.active a, .woocommerce-info a:not(.button), .email:hover, .thb-iconbox.type3 > span, .thb_twitter_container.style1 .thb_tweet a,
.columns.thb-light-column .btn-text.style3:hover,
.columns.thb-light-column .btn-text.style4:hover,
.has-thb-accent-color,
.wp-block-button .wp-block-button__link.has-thb-accent-color  {
	color: <?php echo esc_attr( $accent_color ); ?>;
}
.post.blog-style7 .post-gallery, .widget.widget_price_filter .price_slider .ui-slider-range, .btn.style5, .button.style5, input[type=submit].style5, .btn.style6, .button.style6, input[type=submit].style6, .btn.accent, .btn#place_order, .btn.checkout-button, .button.accent, .button#place_order, .button.checkout-button, input[type=submit].accent, input[type=submit]#place_order, input[type=submit].checkout-button, .content404 figure, .style2 .mobile-menu > li > a:before, .thb-portfolio.thb-text-style2 .type-portfolio:hover, .thb-portfolio-filter.style2 .filters li a:before, .woocommerce-MyAccount-navigation ul li:hover a, .woocommerce-MyAccount-navigation ul li.is-active a, .email.boxed-icon:hover, .email.boxed-icon.fill, .email.boxed-icon.white-fill:hover, .thb-iconbox.type2 > span, .thb-client-row.thb-opacity.with-accent .thb-client:hover, .product-page .product-information .single_add_to_cart_button:hover, .btn.style3:before, .button.style3:before, input[type=submit].style3:before, .btn-text.style3 .circle-btn, .has-thb-accent-background-color,
.wp-block-button .wp-block-button__link.has-thb-accent-background-color {
	background-color: <?php echo esc_attr( $accent_color ); ?>;
}
.mobile-menu li.menu-item-has-children > a:hover .menu_icon,
.btn-text.style4 .arrow svg:first-child {
	fill: <?php echo esc_attr( $accent_color ); ?>;
}
.thb-counter figure svg path,
.thb-counter figure svg circle,
.thb-counter figure svg rect,
.thb-counter figure svg ellipse {
	stroke: <?php echo esc_attr( $accent_color ); ?>;
}
.button.checkout-button:hover,
input[type=submit]#place_order:hover,
.btn.accent:hover,
.btn.style6:hover, .button.style6:hover, input[type=submit].style6:hover {
	background-color: <?php echo thb_adjustColorLightenDarken( $accent_color, 10 ); ?>;
	border-color: <?php echo thb_adjustColorLightenDarken( $accent_color, 10 ); ?>;
}
.thb-portfolio .type-portfolio.hover-style10 .portfolio-link:after {
	background-image: -moz-linear-gradient(<?php echo esc_attr( $accent_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
	background-image: -webkit-linear-gradient(<?php echo esc_attr( $accent_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
	background-image: linear-gradient(<?php echo esc_attr( $accent_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
}
<?php } ?>

	<?php if ( $fullmenu_color = ot_get_option( 'fullmenu_color' ) ) { ?>
		<?php thb_linkcoloroutput( $fullmenu_color, '#full-menu .sf-menu > li >' ); ?>
<?php } ?>

	<?php if ( $submenu_color = ot_get_option( 'submenu_color' ) ) { ?>
		<?php thb_linkcoloroutput( $submenu_color, '#full-menu .sub-menu li' ); ?>
<?php } ?>

	<?php if ( $mobilemenu_color = ot_get_option( 'mobilemenu_color' ) ) { ?>
		<?php thb_linkcoloroutput( $mobilemenu_color, '.mobile-menu > li > ' ); ?>
<?php } ?>

	<?php if ( $mobilesubmenu_color = ot_get_option( 'mobilesubmenu_color' ) ) { ?>
		<?php thb_linkcoloroutput( $mobilesubmenu_color, '.mobile-menu .sub-menu li ' ); ?>
<?php } ?>

	<?php if ( $footerlink_color = ot_get_option( 'footerlink_color' ) ) { ?>
		<?php thb_linkcoloroutput( $footerlink_color, '.footer.style2' ); ?>
		<?php thb_linkcoloroutput( $footerlink_color, '.footer.style1 .social-links' ); ?>
<?php } ?>

	<?php if ( $footer_simple_color = ot_get_option( 'footer_simple_color' ) ) { ?>
		<?php thb_linkcoloroutput( $footer_simple_color, '.footer.style1 .social-links' ); ?>
<?php } ?>

	<?php if ( $subfootermenu_color = ot_get_option( 'subfootermenu_color' ) ) { ?>
		<?php thb_linkcoloroutput( $subfootermenu_color, '.subfooter .thb-subfooter-menu li' ); ?>
		<?php thb_linkcoloroutput( $subfootermenu_color, '.subfooter.dark .thb-subfooter-menu li' ); ?>
<?php } ?>

/* Backgrounds */
	<?php if ( $preloader_bg = ot_get_option( 'preloader_bg' ) ) { ?>
.pace {
		<?php thb_bgoutput( $preloader_bg ); ?>
}
<?php } ?>
	<?php if ( $header_bg = ot_get_option( 'header_bg' ) ) { ?>
.header {
		<?php thb_bgoutput( $header_bg ); ?>
}
<?php } ?>

	<?php if ( $bar_bg = ot_get_option( 'bar_bg' ) ) { ?>
.bar-side {
		<?php thb_bgoutput( $bar_bg ); ?>
}
<?php } ?>

	<?php if ( $nav_bg = ot_get_option( 'nav_bg' ) ) { ?>
.portfolio_nav {
		<?php thb_bgoutput( $nav_bg ); ?>
}
<?php } ?>

	<?php if ( $footer_bg = ot_get_option( 'footer_bg' ) ) { ?>
.footer {
		<?php thb_bgoutput( $footer_bg ); ?>
}
<?php } ?>
	<?php if ( $subfooter_bg = ot_get_option( 'subfooter_bg' ) ) { ?>
.subfooter {
		<?php thb_bgoutput( $subfooter_bg ); ?>
}
<?php } ?>
	<?php if ( $subfooter_logo_height = ot_get_option( 'subfooter_logo_height' ) ) { ?>
.subfooter .footer-logo-holder .logoimg {
	max-height: <?php thb_measurementoutput( $subfooter_logo_height ); ?>;
}
<?php } ?>
/* Page Settings */
	<?php
	$page_bg = get_post_meta( $thb_id, 'page_bg', true );
	if ( $page_bg !== '' ) {
		?>
		body.page-id-<?php echo esc_attr( $thb_id ); ?> #wrapper [role="main"] {
			<?php thb_bgoutput( $page_bg ); ?>
		}
		<?php
	}
	?>

/* Portfolio Settings */
	<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type'      => 'portfolio',
		'no_found_rows'  => true,
	);

	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) :
		while ( $posts->have_posts() ) :
			$posts->the_post();
			$portfolio_id = get_the_ID();
			$main_color   = get_post_meta( $portfolio_id, 'main_color', true );
			$page_bg      = get_post_meta( $portfolio_id, 'page_bg', true );

			if ( $main_color !== '' ) {
				?>
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.portfolio-style1:not(.hover-style6) .portfolio-link,
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.portfolio-text-style-2:hover,
			#qp-portfolio-<?php echo esc_attr( $portfolio_id ); ?>:hover .qp-content,
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.portfolio-style2.style2-hover-style2 .thb-placeholder.second {
				background: <?php echo esc_attr( $main_color ); ?>;
			}
			/* Hover Style 10 */
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.hover-style10 .portfolio-link:after {
				background-image: -moz-linear-gradient(<?php echo esc_attr( $main_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
				background-image: -webkit-linear-gradient(<?php echo esc_attr( $main_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
				background-image: linear-gradient(<?php echo esc_attr( $main_color ); ?>,rgba(0,0,0,0) 30%,rgba(0,0,0,0));
			}
			/* Hover Style 7 */
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.portfolio-style1.hover-style7 .portfolio-link {
				background: transparent;
			}
			.thb-portfolio .post-<?php echo esc_attr( $portfolio_id ); ?>.type-portfolio.portfolio-style1.hover-style7 .thb-placeholder:before {
				background: <?php echo esc_attr( $main_color ); ?>;
			}
				<?php
			}
			if ( $page_bg !== '' ) {
				?>
			body.postid-<?php echo esc_attr( $portfolio_id ); ?> #wrapper [role="main"] {
				<?php thb_bgoutput( $page_bg ); ?>
			}
				<?php
			}
	endwhile;
endif;
	wp_reset_postdata();
	?>

/* Footer */
	<?php if ( $footer_padding = ot_get_option( 'footer_padding' ) ) { ?>
.footer.style2 {
		<?php thb_spacingoutput( $footer_padding, false, 'padding' ); ?>
}
<?php } ?>
	<?php if ( $subfooter_padding = ot_get_option( 'subfooter_padding' ) ) { ?>
.subfooter {
		<?php thb_spacingoutput( $subfooter_padding, false, 'padding' ); ?>
}
<?php } ?>
/* Extra CSS */
	<?php echo ot_get_option( 'extra_css' ); ?>
	<?php
	$out = ob_get_clean();
	// Remove comments
	$out = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
	// Remove space after colons
	$out = str_replace( ': ', ':', $out );
	// Remove whitespace
	$out = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $out );

	return $out;
}
