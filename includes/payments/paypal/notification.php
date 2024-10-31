<?php

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) )

{

	exit;

}

if ( $pvs_global_settings["paypal_active"] ) {

	if ( $pvs_global_settings["paypal_ipn"] ) {

		$postdata = "";

		$validate_ipn = array('cmd' => '_notify-validate');

		

		foreach ( $_POST as $key => $value ) {

			$postdata .= $key . "=" . urlencode( $value ) . "&";

			$validate_ipn[ $key ] = urlencode( $value );

		}



		$postdata .= "cmd=_notify-validate";




$curl = curl_init( 'https://ipnpb.paypal.com/cgi-bin/webscr' );
			curl_setopt( $curl, CURLOPT_POST, 1 );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $postdata );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 1 );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 2 );
			curl_setopt( $curl, CURLOPT_FORBID_REUSE, 1 );
			curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Connection: Close' ) );
			$response = curl_exec( $curl );
			curl_close( $curl );
            



		//Recurring subscriptions

		 if ($response == 'VERIFIED') {

			if ( $_REQUEST["txn_type"] == "subscr_signup" )

			{

				$sql = "update " . PVS_DB_PREFIX . "subscription_list set subscr_id='" .

					pvs_result( $_REQUEST["subscr_id"] ) . "' where id_parent=" . ( int )$_REQUEST["item_number"];

				$db->execute( $sql );

				exit();

			}



			if ( $_REQUEST["txn_type"] == "subscr_payment" and $_REQUEST["payment_status"] ==

				"Completed" )

			{

				$sql = "select * from " . PVS_DB_PREFIX . "subscription_list where id_parent=" . ( int )

					$_REQUEST["item_number"];

				$ds->open( $sql );

				if ( ! $ds->eof )

				{

					if ( $ds->row["payments"] == 0 )

					{

						pvs_subscription_approve( $_REQUEST["item_number"] );

						pvs_send_notification( 'subscription_to_user', $_REQUEST["item_number"] );

						pvs_send_notification( 'subscription_to_admin', $_REQUEST["item_number"] );

					} else

					{

						$sql = "select days from " . PVS_DB_PREFIX . "subscription where id_parent=" . $ds->

							row["subscription"];

						$rs->open( $sql );

						if ( ! $rs->eof )

						{

							if ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),

								date( "Y" ) ) - $ds->row["recurring_data"] > 23 * 3600 )

							{

								$sql = "update " . PVS_DB_PREFIX .

									"subscription_list set bandwidth=0,data2=data2+" . ( 3600 * 24 * $rs->row["days"] ) .

									",payments=payments+1,recurring_data=" . pvs_get_time( date( "H" ), date( "i" ),

									date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) . " where id_parent=" . ( int )

									$_REQUEST["item_number"];

								$db->execute( $sql );

							}

						}

					}

				}



				exit();

			}

		}



		//Items

		if ($response == 'VERIFIED' and $_REQUEST["payment_status"] == "Completed" and ( $_REQUEST["txn_type"] ==

			"web_accept" or $_REQUEST["txn_type"] == "cart" or $_REQUEST["txn_type"] ==

			"send_money" ) ) {

			$transaction_id = pvs_transaction_add( "paypal", @$_REQUEST["txn_id"], $_REQUEST["product_type"], $_REQUEST["item_number"] );



			if ( $_REQUEST["product_type"] == "credits" and ! pvs_is_order_approved( $_REQUEST["item_number"], 'credits' ) )

			{

				pvs_credits_approve( $_REQUEST["item_number"], $transaction_id );

				pvs_send_notification( 'credits_to_user', $_REQUEST["item_number"] );

				pvs_send_notification( 'credits_to_admin', $_REQUEST["item_number"] );

			}



			if ( $_REQUEST["product_type"] == "subscription" and ! pvs_is_order_approved( $_REQUEST["item_number"], 'subscription' ) )

			{

				pvs_subscription_approve( $_REQUEST["item_number"] );

				pvs_send_notification( 'subscription_to_user', $_REQUEST["item_number"] );

				pvs_send_notification( 'subscription_to_admin', $_REQUEST["item_number"] );

			}



			if ( $_REQUEST["product_type"] == "order" and ! pvs_is_order_approved( $_REQUEST["item_number"], 'order' ) )

			{

				pvs_order_approve( $_REQUEST["item_number"] );

				pvs_commission_add( $_REQUEST["item_number"] );



				pvs_coupons_add( pvs_order_user( $_REQUEST["item_number"] ) );

				pvs_send_notification( 'neworder_to_user', $_REQUEST["item_number"] );

				pvs_send_notification( 'neworder_to_admin', $_REQUEST["item_number"] );

			}

			

			if ( $_REQUEST["product_type"] == "media" )

			{

				$sql = "select ID, user_login from " . $table_prefix . "users where user_email='" . pvs_result( $_POST['payer_email'] ) . "'";

				$rs->open( $sql );

				if ( $rs->eof ) {

					$login = pvs_result($_POST['payer_email']);

					$password = pvs_create_password();

			

					//Add new user

					$params["login"] = $login;

					$params["password"] = $password;

					$params["name"] = pvs_result( @$_POST['first_name'] );

					$params["country"] = pvs_result( @$_POST['address_country'] );

					$params["telephone"] = '';

					$params["address"] = pvs_result( @$_POST['address_street'] );

					$params["email"] = $login;

					$params["ip"] = pvs_result( $_SERVER["REMOTE_ADDR"] );

					$params["accessdenied"] = 0;

					$params["lastname"] =  pvs_result( @$_POST['last_name'] );

					$params["city"] = pvs_result( @$_POST['address_city'] );

					$params["state"] = pvs_result( @$_POST['address_state'] );

					$params["zipcode"] = pvs_result( @$_POST['address_zip'] );

					$params["category"] = $pvs_global_settings["userstatus"];

					$params["website"] = '';

					$params["utype"] = 'buyer';

					$params["company"] = '';

					$params["newsletter"] = 0;

					$params["examination"] = 1;

					$params["authorization"] = 'site';

					$params["aff_commission_buyer"] = ( int )$pvs_global_settings["buyer_commission"];

					$params["aff_commission_seller"] = ( int )$pvs_global_settings["seller_commission"];

					$params["aff_visits"] = 0;

					$params["aff_signups"] = 0;

					$params["aff_referal"] = 0;

					$params["business"] = 0;

					$params["vat"] = '';

					$params["payout_limit"] = ( int )$pvs_global_settings["payout_limit"];

					$params["avatar"] = '';

					$params["description"] = '';

					$params["downloads"] = 0;

					$params["downloads_date"] = 0;

					$params["country_checked"] = 0;

					$params["country_checked_date"] = 0;

					$params["vat_checked"] = 0;

					$params["vat_checked_date"] = 0;

					$params["rating"] = 0;

			

					$user_id = pvs_add_user( $params );

					$_POST["guest_email"] = $login;

					pvs_send_notification( 'signup_guest', $login, $password);

					pvs_send_notification( 'signup_to_admin', $user_id );

					pvs_coupons_add( $login, "New Signup" );

					

					//Authorization

					pvs_user_authorization( $user_id );

				} else {

					//Authorization

					pvs_user_authorization( $rs->row["ID"] );

				}

				

				$sql = "select id_parent,name,price from " . PVS_DB_PREFIX . "items where id=" . (int)$_REQUEST["item_number"];

				$dr->open( $sql );

				if ( ! $dr->eof ) {

					$params["publication_id"] = $dr->row["id_parent"];

				}

				

				$rights_managed = 0;

				$sql = "select rights_managed from " . PVS_DB_PREFIX . "media where id=" . $params["publication_id"];

				$ds->open( $sql );

				if ( ! $ds->eof ) {

					if ( $ds->row["rights_managed"] > 0 ) {

						exit();

					}

				}

				

				$params["item_id"] = (int)$_REQUEST["item_number"];

				$params["prints_id"] = 0;

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





				pvs_order_approve( $order_id );

				pvs_commission_add( $order_id );



				pvs_coupons_add( pvs_order_user( $order_id ) );

				pvs_send_notification( 'neworder_to_user', $order_id );

				pvs_send_notification( 'neworder_to_admin', $order_id );	

			}

		}

	}

}

?>