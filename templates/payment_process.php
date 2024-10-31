<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$payment_type = preg_replace( '/[^a-z0-9]/i', "", @$_REQUEST["payment"] );

if ( ! isset ($pvs_payments[$payment_type]) )
{
	exit();
}




$sent = false;
$product_id = 0;
$product_name = "Test";
$product_type = "order";
$product_total = "0.00";

//Credits
if ( @$_REQUEST["tip"] == "credits" and is_user_logged_in() ) {
	$sql = "select * from " . PVS_DB_PREFIX . "credits where id_parent=" . ( int )$_REQUEST["credits"];
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$taxes_info = array();
		$product_id = pvs_credits_add( $rs->row["id_parent"] );
		$product_name = $rs->row["title"];
		$sql = "select total from " . PVS_DB_PREFIX . "credits_list where id_parent=" .
			$product_id;
		$ds->open( $sql );
		if ( ! $ds->eof )
		{
			$product_total = $ds->row["total"];
		}
		$product_type = "credits";
		$sent = true;

	}
}

//Orders
if ( @$_REQUEST["tip"] == "order" and isset( $_REQUEST["order_id"] ) and is_user_logged_in() ) {
	$sql = "select * from " . PVS_DB_PREFIX . "orders where id=" . ( int )$_REQUEST["order_id"];
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$product_id = $rs->row["id"];
		$product_name = "Order #" . $rs->row["id"];
		$product_total = $rs->row["total"];
		$product_type = "order";
		$sent = true;
	}
}

//Subscription
if ( @$_REQUEST["tip"] == "subscription" and is_user_logged_in() ) {
	$sql = "select * from " . PVS_DB_PREFIX . "subscription where id_parent=" . ( int )
		$_REQUEST["subscription"];
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$taxes_info = array();
		$product_id = pvs_subscription_add( $rs->row["id_parent"] );
		$product_name = $rs->row["title"] . " - " . pvs_user_id_to_login( get_current_user_id());
		$sql = "select total,data1,data2 from " . PVS_DB_PREFIX .
			"subscription_list where id_parent=" . $product_id;
		$ds->open( $sql );
		if ( ! $ds->eof )
		{
			$product_total = $ds->row["total"];
			if ($ds->row["data1"] != $ds->row["data2"]) {
				$recurring = $rs->row["recurring"];
				$recurring_days = $rs->row["days"];
			} else {
				$recurring = 0;
			}
		}
		$product_type = "subscription";
		$sent = true;
	}
}

//Direct paypal payment
if ( $pvs_global_settings["paypal_direct"] and isset($_REQUEST["item_id"]) and isset($_REQUEST["publication_id"]) ) {	
	$sql = "select price from " . PVS_DB_PREFIX . "items where id=" . (int)$_REQUEST["item_id"];
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		if ( is_user_logged_in() ) {
		
			$rights_managed = 0;
			$sql = "select rights_managed from " . PVS_DB_PREFIX . "media where id=" . (int)$_REQUEST["publication_id"];
			$ds->open( $sql );
			if ( ! $ds->eof ) {
				if ( $ds->row["rights_managed"] > 0 ) {
					exit();	
				}
			}
			
			$params["item_id"] = (int)$_REQUEST["item_id"];
			$params["prints_id"] = 0;
			
			$params["publication_id"] = (int)$_REQUEST["publication_id"];
			$params["quantity"] = 1;
			
			for ( $i = 1; $i < 11; $i++ ) {
				$params["option" . $i . "_id"] = 0;
				$params["option" . $i . "_value"] = "";
			}
			
			pvs_shopping_cart_add( $params );
			
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
			
			//Add a new order
			$product_tax_info = array();
			$order_id = pvs_order_add( $product_subtotal, $product_discount, $product_total, $product_shipping, $product_tax, $product_shipping_type, $weight );

			$product_id = $order_id;
			$product_name = "Order #" . $order_id;
			$product_total = $product_total;
			$product_type = "order";
			$sent = true;
			
		} else {
			$product_id = (int)$_REQUEST["item_id"];
			$product_name = "Media #" . (int)$_REQUEST["publication_id"];
			$product_total = $rs->row["price"];
			$product_type = "media";
			$sent = true;
		}
	} else {
		exit();
	}
}

//Total = 0
if ( $product_total == 0 and is_user_logged_in() ) {
	if ( $product_type == "credits" and ! pvs_is_order_approved( $product_id, 'credits' ) ) {
		pvs_credits_approve( $product_id, "" );
		pvs_send_notification( 'credits_to_user', $product_id );
		pvs_send_notification( 'credits_to_admin', $product_id );
	}

	if ( $product_type == "subscription" and ! pvs_is_order_approved( $product_id, 'subscription' ) ) {
		pvs_subscription_approve( $product_id );
		pvs_send_notification( 'subscription_to_user', $product_id );
		pvs_send_notification( 'subscription_to_admin', $product_id );
	}

	if ( $product_type == "order" and ! pvs_is_order_approved( $product_id, 'order' ) ) {
		pvs_order_approve( $product_id );
		pvs_commission_add( $product_id );

		pvs_coupons_add( pvs_order_user( $product_id ) );
		pvs_send_notification( 'neworder_to_user', $product_id );
		pvs_send_notification( 'neworder_to_admin', $product_id );
	}

	header( "location:" .site_url() . "/payment-success/" );
	exit();
}



if ( $payment_type != "cheque" ) {
	if ( $sent == true)
	{
		include ( PVS_PATH. "includes/payments/" . $payment_type . "/payment.php" );
	}
} else {
	pvs_transaction_add( "cheque", '', $product_type, $product_id );

	if ( $product_type == "credits" )
	{
		pvs_send_notification( 'credits_to_admin', $product_id );
	}

	if ( $product_type == "subscription" )
	{
		pvs_send_notification( 'subscription_to_admin', $product_id );
	}

	if ( $product_type == "order" )
	{
		pvs_send_notification( 'neworder_to_admin', $product_id );
	}
	header( "location:" . site_url() . "/payment-page/?payment=cheque&product_id=" . $product_id . "&product_type=" . $product_type . "&print=1" );
	exit();
}
?>