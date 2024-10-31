<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

if ( ! wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-orders-add' ) ) {	
	exit();
}

if ( ! is_user_logged_in() ) {	
	if ( $pvs_global_settings["no_cart"] ) {
		//Guest login
		include('check_guest_content.php');
	} else {
		exit();
	}
}


//Orders total
$product_subtotal = 0;
$product_shipping = 0;
$product_tax = 0;
$product_discount = 0;
$product_total = 0;
$weight = 0;
$quantity = 0;
$flag_shipping = false;

$cart_id = pvs_shopping_cart_id();

include("checkout_calculate.php");



unset( $_SESSION["checkout_steps"] );

//Credits balance
$credits = pvs_credits_balance();

//Check if a buyer has credits
if ( $pvs_global_settings["credits"] and $product_total > $credits ) {
	if ( ! $pvs_global_settings["credits_currency"] or ( $pvs_global_settings["credits_currency"] and
		@$_SESSION["checkout_method"] == "credits" ) ) {
		header( "location:" . site_url() . "/credits/" );
		exit();
	}
}

//Add a new order
$product_tax_info = array();
$order_id = pvs_order_add( $product_subtotal, $product_discount, $product_total, $product_shipping, $product_tax, $product_shipping_type, $weight );

//Use a coupon
if ( isset( $_SESSION["coupon_code"] ) ) {
	pvs_coupons_delete( $_SESSION["coupon_code"] );
	unset($_SESSION["coupon_code"]);
}

//Order is purchased by prepaid credits
if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and @$_SESSION["checkout_method"] == "currency" ) ) {

} else {
	if (  ! $pvs_global_settings["no_cart"]  and $product_total <= $credits  ) {
		pvs_order_approve( $order_id );
		pvs_commission_add( $order_id );
		pvs_credits_delete( $product_total, $order_id );
		pvs_coupons_add( pvs_get_user_login () );
		pvs_send_notification( 'neworder_to_user', $order_id );
		pvs_send_notification( 'neworder_to_admin', $order_id );
	}
}

$yandex_payments = "";
if ( isset( $_POST["yandex_payments"] ) ) {
	$yandex_payments = "&yandex_payments=" . pvs_result( $_POST["yandex_payments"] );
}

$telephone = "";
if ( isset( $_POST["telephone"] ) ) {
	$telephone = "&telephone=" . pvs_result( $_POST["telephone"] );
}

$moneyua_method = "";
if ( isset( $_POST["moneyua_method"] ) ) {
	$moneyua_method = "&moneyua_method=" . pvs_result( $_POST["moneyua_method"] );
}

$targetpay_banks = "";
if ( isset( $_POST["bank"] ) ) {
	$targetpay_banks = "&targetpay_banks=" . pvs_result( $_POST["bank"] );
}

//Order with total = 0
if ( $product_total == 0 ) {
	pvs_order_approve( $order_id );
	pvs_commission_add( $order_id );
	pvs_coupons_add( pvs_get_user_login () );
	pvs_send_notification( 'neworder_to_user', $order_id );
	pvs_send_notification( 'neworder_to_admin', $order_id );
	if ( ! $pvs_global_settings["printsonly"] ) {
		header( "location:" . site_url() . "/profile-downloads/" );
	} else {
		header( "location:" . site_url() . "/orders/" );
	}
	exit();
}


if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
	@$_SESSION["checkout_method"] == "currency" ) or  $pvs_global_settings["no_cart"] ) {
	
	//Redirect for the payment
	unset( $_SESSION["checkout_method"] );
	header( "location:" . site_url() . "/payment-process/?order_id=" . $order_id . "&payment=" .
		pvs_result( $_POST["payment"] ) . "&tip=order" . $telephone . $moneyua_method .
		$yandex_payments . $targetpay_banks );
} else {
	//Order is purchased by prepaid credits
	unset( $_SESSION["checkout_method"] );

	if ( ! $pvs_global_settings["printsonly"] ) {
		header( "location:" . site_url() . "/profile-downloads/" );
	} else {
		header( "location:" . site_url() . "/orders/" );
	}
}

?>