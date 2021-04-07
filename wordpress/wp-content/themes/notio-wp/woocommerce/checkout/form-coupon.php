<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'notio' ) );
$info_message .= ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'notio' ) . '</a>';

//wc_print_notice( $info_message, 'notice' );
?>

<div class="checkout-coupon">
	<div class="row align-center">
		<div class="small-12 medium-7 large-5 text-center columns">
			<div class="thb-checkout-coupon">
				<?php esc_html_e("Have a coupon?", 'notio' ); ?> <a class="showcoupon"><?php esc_html_e("Click here to enter your code", 'notio' ); ?></a>
			</div>
			<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
				<div class="coupon">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'notio' ); ?>" id="coupon_code" value="" />
					<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'notio' ); ?>"><?php esc_html_e( 'Apply coupon', 'notio' ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>