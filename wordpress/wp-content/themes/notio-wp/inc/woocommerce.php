<?php
if ( ! thb_wc_supported() ) {
	return;
}

/* Out of Stock Check */
function thb_out_of_stock() {
	global $post;
	$id     = $post->ID;
	$status = get_post_meta( $id, '_stock_status', true );

	if ( 'outofstock' === $status ) {
		return true;
	} else {
		return false;
	}
}

/* Side Cart */
function thb_side_cart() {
	?>
	<nav id="side-cart">
		<div class="spacer"></div>
		<div class="cart-container">
			<header class="item">
				<h6><?php esc_html_e( 'SHOPPING BAG', 'notio' ); ?></h6>
				<a href="#" class="panel-close">
					<?php get_template_part( 'assets/svg/arrows_remove.svg' ); ?>
				</a>
			</header>
			<?php
			if ( class_exists( 'WC_Widget_Cart' ) ) {
				the_widget(
					'WC_Widget_Cart',
					array(
						'title' => false,
					)
				);
			}
			?>
		</div>
	</nav>
	<?php
}
add_action( 'thb_side_cart', 'thb_side_cart' );

/* Header Cart */
function thb_quick_cart() {
	?>
	<a class="quick_cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'notio' ); ?>">
		<?php get_template_part( 'assets/img/cart.svg' ); ?>
		<span class="float_count"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
	</a>
	<?php
}
add_action( 'thb_quick_cart', 'thb_quick_cart', 3 );

/* Product Categories Array */
function thb_productCategories() {
	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => '0',
	);

	$product_categories = get_terms( 'product_cat', $args );
	$out                = array();
	if ( $product_categories ) {
		foreach ( $product_categories as $product_category ) {
			$out[ $product_category->name ] = $product_category->slug;
		}
	}
	return $out;
}

/* Product Badges */
function thb_product_badge() {
	global $post, $product;
	if ( thb_out_of_stock() ) {
		echo '<span class="badge out-of-stock">' . esc_html__( 'Out of Stock', 'notio' ) . '</span>';
	} elseif ( $product->is_on_sale() ) {
		echo apply_filters( 'woocommerce_sale_flash', '<span class="badge onsale">' . esc_html__( 'Sale', 'notio' ) . '</span>', $post, $product );
	} else {
		$postdate      = get_the_time( 'Y-m-d' );          // Post date
		$postdatestamp = strtotime( $postdate );            // Timestamped post date
		$newness       = ot_get_option( 'shop_newness', 7 );
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . esc_html__( 'Just Arrived', 'notio' ) . '</span>';
		}
	}
}
add_action( 'thb_product_badge', 'thb_product_badge', 3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update( $fragments ) {
	ob_start();
	?>
		<span class="float_count"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
	<?php
	$fragments['.float_count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update' );


/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );


/* Product Page - Remove Breadcrumbs */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'thb_woocommerce_product_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price' );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );

add_action( 'thb_before_shop_loop_breadcrumb', 'woocommerce_breadcrumb', 30 );

/* Cart Page - Move Cross Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

/* Checkout */
function thb_woocommerce_checkout_before_customer_details() {
		echo '<div class="row"><div class="small-12 large-7 columns">';
}
add_action(
	'woocommerce_checkout_before_customer_details',
	'thb_woocommerce_checkout_before_customer_details',
	5
);
function thb_woocommerce_checkout_after_customer_details() {
		echo '</div><div class="small-12 large-5 columns">';
}
add_action(
	'woocommerce_checkout_after_customer_details',
	'thb_woocommerce_checkout_after_customer_details',
	30
);
function thb_woocommerce_checkout_after_order_review() {
	echo '</div></div>';
}
add_action(
	'woocommerce_checkout_after_order_review',
	'thb_woocommerce_checkout_after_order_review',
	30
);

/* Review Tab */
function thb_review_setup() {
	if ( 'on' !== ot_get_option( 'review_tab', 'on' ) ) {
		function thb_remove_reviews_tab( $tabs ) {
			unset( $tabs['reviews'] );
			return $tabs;
		}
		add_filter( 'woocommerce_product_tabs', 'thb_remove_reviews_tab', 98 );
	}
}
add_action( 'after_setup_theme', 'thb_review_setup' );

/* Product Page - Catalog Mode */
function thb_catalog_setup() {
	$catalog_mode = ot_get_option( 'shop_catalog_mode', 'off' );
	if ( 'on' === $catalog_mode ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
}
add_action( 'after_setup_theme', 'thb_catalog_setup' );

/* Category Text */
function thb_before_subcategory_title() {
	echo '<div>';
}
add_action( 'woocommerce_before_subcategory_title', 'thb_before_subcategory_title', 15 );
function thb_subcategory_title() {
	echo '<span>' . esc_html__( 'Explore Now', 'notio' ) . '</span>';
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'thb_subcategory_title', 15 );
function thb_after_subcategory_title() {
	echo '</div>';
}
add_action( 'woocommerce_after_subcategory_title', 'thb_after_subcategory_title', 15 );
function thb_subcategory_count_html( $markup, $category ) {
	return '<mark class="count">' . $category->count . '</mark>';
}
add_filter( 'woocommerce_subcategory_count_html', 'thb_subcategory_count_html', 10, 2 );

/* Change Category Thumbnail Size */
function thb_template_loop_category_link_open( $category ) {
	$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}
	echo '<a href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '" style="background-image:url(' . esc_url( $image ) . ' )">';
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
add_action( 'woocommerce_before_subcategory', 'thb_template_loop_category_link_open', 10 );

/* Plugin Page Ajax Add to Cart */
function thb_woocommerce_single_product() {
	if ( 'off' === ot_get_option( 'shop_product_ajax_addtocart', 'on' ) ) {
		return;
	}

	function thb_ajax_add_to_cart_redirect_template() {
		$thb_ajax = filter_input( INPUT_GET, 'thb-ajax-add-to-cart', FILTER_VALIDATE_BOOLEAN );

		if ( $thb_ajax ) {
			wc_get_template( 'ajax/add-to-cart-fragments.php' );
			exit;
		}
	}
	add_action( 'wp', 'thb_ajax_add_to_cart_redirect_template', 1000 );
	function thb_woocommerce_after_add_to_cart_button() {
		global $product;
		?>
			<input type="hidden" name="action" value="wc_prod_ajax_to_cart" />
		<?php
		// Make sure we have the add-to-cart avaiable as button name doesn't submit via ajax.
		if ( $product->is_type( 'simple' ) ) {
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
			<?php
		}
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'thb_woocommerce_after_add_to_cart_button' );
	function thb_woocommerce_display_site_notice() {
		?>
		<div class="thb_prod_ajax_to_cart_notices"></div>
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'thb_woocommerce_display_site_notice', 10 );
}
add_action( 'before_woocommerce_init', 'thb_woocommerce_single_product' );

// Product Category Classes.
function thb_add_product_cat_classes( $classes ) {

	$classes[] = 'columns';

	return $classes;
}
add_filter( 'product_cat_class', 'thb_add_product_cat_classes' );
