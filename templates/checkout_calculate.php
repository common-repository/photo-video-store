<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}



$items_list = "";
$sql = "select id,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,stock,stock_type,stock_id,stock_url,stock_preview,stock_site_url,print_width,print_height,collection,package from " .
	PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
$dq->open( $sql );
while ( ! $dq->eof ) {
	if ( $items_list != "" ) {
		$items_list .= "<div class='checkout_line'></div>";
	}
	
	if ( (int) $dq->row["package"] == 0 ) {
		if ( (int) $dq->row["collection"] == 0 ) {
			//Download items
			if ( $dq->row["item_id"] > 0 ) {
				$sql = "select id,name,price,id_parent,url,shipped from " . PVS_DB_PREFIX .
					"items where id=" . $dq->row["item_id"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$price = $dr->row["price"];
		
					if ( $dq->row["rights_managed"] != "" )
					{
						$rights_mass = explode( "|", $dq->row["rights_managed"] );
						$price = $rights_mass[0];
					}
		
					$items_list .= "<div class='checkout_list'><a href='" . pvs_item_url( $dr->row["id_parent"] ) .
						"'><b>#" . $dr->row["id_parent"] . " &mdash; " . pvs_word_lang( "file" ) . ": " .
						pvs_word_lang( $dr->row["name"] ) . "</b></a><div style='margin-top:3px'>
				" . $dq->row["quantity"] . " x " . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
						pvs_price_format( $price, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
						"</div></div>";
		
					if ( $dr->row["shipped"] == 1 )
					{
						$weight += $pvs_global_settings["cd_weight"];
						$flag_shipping = true;
						$quantity++;
					}
		
					$taxes_info = array();
					if ( $dr->row["shipped"] != 1 )
					{
						pvs_order_taxes_calculate( $price, false, "order" );
					} else
					{
						pvs_order_taxes_calculate( $price, false, "prints" );
					}
		
					if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
					{
						$product_tax += $taxes_info["total"];
						$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
							": " . pvs_currency( 1, false ) . $taxes_info["total"] . " " . pvs_currency( 2, false ) .
							"</b></small></div>";
					}
					unset( $taxes_info );
		
					$product_subtotal += $price * $dq->row["quantity"];
				}
			}
		
			//Prints items
			if ( $dq->row["prints_id"] > 0 ) {
				if ( ( int )$dq->row["stock"] == 0 )
				{
					if ( $dq->row["printslab"] != 1 )
					{
						$sql = "select id_parent,title,price,itemid,printsid from " . PVS_DB_PREFIX .
							"prints_items where id_parent=" . $dq->row["prints_id"];
						$dr->open( $sql );
						if ( ! $dr->eof )
						{
							$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
								row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
								row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
								$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
								row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
								row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
								$dq->row["option10_id"], $dq->row["option10_value"] );
		
							$sql = "select id,title,server1 from " . PVS_DB_PREFIX .
								"media where id=" . ( int )$dr->row["itemid"];
							$rs->open( $sql );
							if ( ! $rs->eof )
							{
								if ( $pvs_global_settings["prints_previews"] )
								{
									$print_info = pvs_get_print_preview_info( $dr->row["printsid"] );
									if ( $print_info["flag"] )
									{
										$url = pvs_print_url( $dr->row["itemid"], $dr->row["printsid"], $rs->row["title"],
											$print_info["preview"], '' );
									} else
									{
										$url = pvs_item_url( $dr->row["itemid"] );
									}
								} else
								{
									$url = pvs_item_url( $dr->row["itemid"] );
								}
							}
		
							$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" .
								pvs_word_lang( "photo" ) . " #" . $dr->row["itemid"] . ":  " . pvs_word_lang( $dr->
								row["title"] ) . "</b></a></div>
			<span class='gr'>";
		
							for ( $i = 1; $i < 11; $i++ )
							{
								if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
									"" )
								{
									$sql = "select title,property_name from " . PVS_DB_PREFIX .
										"products_options where id=" . $dq->row["option" . $i . "_id"];
									$ds->open( $sql );
									if ( ! $ds->eof )
									{
										if ( $ds->row["property_name"] == 'print_size' )
										{
											$print_width = $dq->row["print_width"];
											$print_height = $dq->row["print_height"];
		
											if ( $print_width > $print_height )
											{
												$print_size = $print_width;
											} else
											{
												$print_size = $print_height;
											}
		
											$property_value = $dq->row["option" . $i . "_value"];
		
											$value_array = explode( "cm", $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) .
													"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
											}
		
											$value_array = explode( 'in', $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
													round( $property_value * $print_height / $print_size ) . '"';
											}
		
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
												". <br>";
										} else
										{
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
												row["option" . $i . "_value"] ) . ". <br>";
										}
									}
								}
							}
		
							$items_list .= "</span>
			<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
								@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
								pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
							$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dr->
								row["printsid"];
							$ds->open( $sql );
							if ( ! $ds->eof )
							{
								$weight += $ds->row["weight"];
								$flag_shipping = true;
							}
							$product_subtotal += $price * $dq->row["quantity"];
							$quantity += $dq->row["quantity"];
		
							$taxes_info = array();
							pvs_order_taxes_calculate( $price, false, "prints" );
		
							if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
							{
								$product_tax += $taxes_info["total"] * $dq->row["quantity"];
								$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
									": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
									row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
							}
							unset( $taxes_info );
						}
					} else
					{
						$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
							"prints where id_parent=" . $dq->row["prints_id"];
						$dr->open( $sql );
						if ( ! $dr->eof )
						{
							$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
								row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
								row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
								$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
								row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
								row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
								$dq->row["option10_id"], $dq->row["option10_value"] );
		
							$gallery_id = 0;
							$sql = "select id_parent from " . PVS_DB_PREFIX . "galleries_photos where id=" .
								$dq->row["publication_id"];
							$dn->open( $sql );
							if ( ! $dn->eof )
							{
								$gallery_id = $dn->row["id_parent"];
							}
		
							$items_list .= "<div class='checkout_list'><div><a href='<?php echo (site_url( ) );?>/printslab_content/?id=" .
								$gallery_id . "'><b>" . pvs_word_lang( "prints lab" ) . " #" . $dq->row["publication_id"] .
								":  " . pvs_word_lang( $dr->row["title"] ) . "</b></a></div>
			<span class='gr'>";
		
							for ( $i = 1; $i < 11; $i++ )
							{
								if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
									"" )
								{
									$sql = "select title,property_name from " . PVS_DB_PREFIX .
										"products_options where id=" . $dq->row["option" . $i . "_id"];
									$ds->open( $sql );
									if ( ! $ds->eof )
									{
										if ( $ds->row["property_name"] == 'print_size' )
										{
											$print_width = $dq->row["print_width"];
											$print_height = $dq->row["print_height"];
		
											if ( $print_width > $print_height )
											{
												$print_size = $print_width;
											} else
											{
												$print_size = $print_height;
											}
		
											$property_value = $dq->row["option" . $i . "_value"];
		
											$value_array = explode( "cm", $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) .
													"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
											}
		
											$value_array = explode( '"', $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
													round( $property_value * $print_height / $print_size ) . '"';
											}
		
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
												". <br>";
										} else
										{
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
												row["option" . $i . "_value"] ) . ". <br>";
										}
									}
								}
							}
		
							$items_list .= "</span>
			<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
								@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
								pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
							$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dq->
								row["prints_id"];
							$ds->open( $sql );
							if ( ! $ds->eof )
							{
								$weight += $ds->row["weight"];
								$flag_shipping = true;
							}
							$product_subtotal += $price * $dq->row["quantity"];
							$quantity += $dq->row["quantity"];
		
							$taxes_info = array();
							pvs_order_taxes_calculate( $price, false, "prints" );
		
							if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
							{
								$product_tax += $taxes_info["total"] * $dq->row["quantity"];
								$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
									": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
									row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
							}
							unset( $taxes_info );
						}
					}
				} else
				{
					//Stock
					$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
						"prints where id_parent=" . $dq->row["prints_id"];
					$dr->open( $sql );
					if ( ! $dr->eof )
					{
						$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
							row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
							row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
							$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
							row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
							row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
							$dq->row["option10_id"], $dq->row["option10_value"] );
		
						$title = @$mstocks[str_replace( "123rf", "rf123", $dq->row["stock_type"] )] .
							" #" . $dq->row["stock_id"];
						$preview = $dq->row["stock_preview"];
						$url = $dq->row["stock_site_url"];
		
						$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title .
							": " . pvs_word_lang( $dr->row["title"] ) . "</b></a></div>
		<span class='gr'>";
		
						for ( $i = 1; $i < 11; $i++ )
						{
							if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
								"" )
							{
								$sql = "select title,property_name from " . PVS_DB_PREFIX .
									"products_options where id=" . $dq->row["option" . $i . "_id"];
								$ds->open( $sql );
								if ( ! $ds->eof )
								{
									if ( $ds->row["property_name"] == 'print_size' )
									{
										$print_width = $dq->row["print_width"];
										$print_height = $dq->row["print_height"];
		
										if ( $print_width > $print_height )
										{
											$print_size = $print_width;
										} else
										{
											$print_size = $print_height;
										}
		
										$property_value = $dq->row["option" . $i . "_value"];
		
										$value_array = explode( "cm", $property_value );
										if ( count( $value_array ) == 2 and $print_size != 0 )
										{
											$property_value = $value_array[0];
											$property_value = round( $property_value * $print_width / $print_size ) .
												"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
										}
		
										$value_array = explode( '"', $property_value );
										if ( count( $value_array ) == 2 and $print_size != 0 )
										{
											$property_value = $value_array[0];
											$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
												round( $property_value * $print_height / $print_size ) . '"';
										}
		
										$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
											". <br>";
									} else
									{
										$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
											row["option" . $i . "_value"] ) . ". <br>";
									}
								}
							}
						}
		
						$items_list .= "</span>
		<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
							@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
							pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
						$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dq->
							row["prints_id"];
						$ds->open( $sql );
						if ( ! $ds->eof )
						{
							$weight += $ds->row["weight"];
							$flag_shipping = true;
						}
						$product_subtotal += $price * $dq->row["quantity"];
						$quantity += $dq->row["quantity"];
		
						$taxes_info = array();
						pvs_order_taxes_calculate( $price, false, "prints" );
		
						if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
						{
							$product_tax += $taxes_info["total"] * $dq->row["quantity"];
							$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
								": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
								row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
						}
						unset( $taxes_info );
					}
				}
			}
		} else {
			//Collection
			$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . $dq->row["collection"];
			$ds->open( $sql );
			if ( ! $ds->eof ) {
				$price = $ds->row["price"];
			
				$title = pvs_word_lang("Collection") . ': ' . $ds->row["title"] . ' (' . pvs_count_files_in_collection($ds->row["id"]) . ')';
				$url = pvs_collection_url( $ds->row["id"], $ds->row["title"] );
				
				$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title . "</b></a></div><div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
					@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
					pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
			
				$product_subtotal += $price * $dq->row["quantity"];
				$quantity += $dq->row["quantity"];
			
				$taxes_info = array();
				pvs_order_taxes_calculate( $price, false, "prints" );
			
				if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
				{
					$product_tax += $taxes_info["total"] * $dq->row["quantity"];
					$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
						": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
						row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
				}
				unset( $taxes_info );
			}
		}
	} else {
		//Package
		$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . $dq->row["package"];
		$ds->open( $sql );
		if ( ! $ds->eof ) {
			$price = $ds->row["price"];
		
			$title = pvs_word_lang("Package") . ': ' . $ds->row["title"];
			$url = pvs_package_url($ds->row["id"], $dq->row["id"]);
			
			$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title . " " . pvs_count_files_in_package($ds->row["id"], $dq->row["id"]) . "</b></a></div><div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
				@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
				pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
			$product_subtotal += $price * $dq->row["quantity"];
			$quantity += $dq->row["quantity"];
		
			$taxes_info = array();
			
			$sql = "select id from " . PVS_DB_PREFIX . "packages_files where print_id > 0 and quantity > 0 and package_id = " . $dq->row["package"];
			$dr->open($sql);
			if ( ! $dr->eof ) {
				$flag_shipping = true;
				pvs_order_taxes_calculate( $price, false, "prints" );
			} else {
				pvs_order_taxes_calculate( $price, false, "order" );
			}
		
			if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
			{
				$product_tax += $taxes_info["total"] * $dq->row["quantity"];
				$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
					": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
					row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
			}
			unset( $taxes_info );
			

		}	
	}
	$dq->movenext();
}

//Discount
$discount_text = "";
if ( isset( $_SESSION["coupon_code"] ) and ( ! $pvs_global_settings["credits"] or
	( $pvs_global_settings["credits"] and $pvs_global_settings["credits_currency"] ) ) ) {
	$discount_info = array();
	pvs_order_discount_calculate( $_SESSION["coupon_code"], $product_subtotal );
	$product_discount = $discount_info["total"];
	$discount_text = $discount_info["text"];
	
	$discount_info = array();
	pvs_order_discount_calculate( $_SESSION["coupon_code"], $product_tax, true );
	$product_tax -= $discount_info["total"];
}


//Shipping
$product_shipping = 0;
$product_shipping_type = 0;

$shipping_list = "";

if ( $flag_shipping ) {
	$sql = "select id,title,shipping_time,methods,methods_calculation,taxes,regions from " .
		PVS_DB_PREFIX . "shipping where activ=1 and weight_min<=" . $weight .
		" and weight_max>=" . $weight . "  order by title";
	$dr->open( $sql );
	while ( ! $dr->eof ) {
		$shipping = 0;

		//Check regions
		$flag_regions = false;
		if ( $dr->row["regions"] == 0 )
		{
			$flag_regions = true;
		} else
		{
			$sql = "select country,state from " . PVS_DB_PREFIX .
				"shipping_regions where id_parent=" . $dr->row["id"] . " and country='" .
				pvs_result( @$_SESSION["shipping_country"] ) . "'";
			$ds->open( $sql );
			while ( ! $ds->eof )
			{
				if ( $ds->row["state"] == "" )
				{
					$flag_regions = true;
				} else
				{
					if ( $ds->row["state"] == @$_SESSION["shipping_state"] )
					{
						$flag_regions = true;
					}
				}
				$ds->movenext();
			}
		}

		//Calculate
		if ( $flag_regions )
		{
			if ( $dr->row["methods"] == "weight" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $weight . " and to_param>=" . $weight .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "quantity" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $quantity . " and to_param>=" . $quantity .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "subtotal" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $product_subtotal . " and to_param>=" . $product_subtotal .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "flatrate" )
			{
				$sql = "select price from " . PVS_DB_PREFIX . "shipping_ranges where id_parent=" .
					$dr->row["id"];
			}

			$ds->open( $sql );
			if ( ! $ds->eof )
			{
				if ( $dr->row["methods_calculation"] == "percent" )
				{
					$shipping = $ds->row["price"] * $product_subtotal / 100;
				}
				if ( $dr->row["methods_calculation"] == "currency" )
				{
					$shipping = $ds->row["price"];
				}
			}

			if ( $dr->row["taxes"] == 1 )
			{
				$word_taxes = " - " . pvs_word_lang( "taxable" );
			} else
			{
				$word_taxes = "";
			}

			$shipping_list .= "<div style='margin-bottom:3px'><input onClick=\"change_total(this.value," .
				$dr->row["id"] . ")\" checked name='shipping_type'  type='radio' value='" . $shipping .
				"'>&nbsp;" . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
				pvs_price_format( $shipping, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
				" &mdash; " . $dr->row["title"] . " (" . $dr->row["shipping_time"] . ")" . $word_taxes .
				"</div>";
			$product_shipping = $shipping;
			$product_shipping_type = $dr->row["id"];
		}
		$dr->movenext();
	}
}

$flag_shipping_taxable = false;

$sql = "select taxes from " . PVS_DB_PREFIX . "shipping where id=" . $product_shipping_type;
$dr->open( $sql );
if ( ! $dr->eof ) {
	if ( $dr->row["taxes"] == 1 ) {
		$flag_shipping_taxable = true;
	}
}
//End. Shipping

//Taxes rates
$taxes_info = array();
if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
	@$_SESSION["checkout_method"] != "credits" ) ) {
	if ( $flag_shipping_taxable ) {
		pvs_order_taxes_calculate( $product_shipping, false, "order" );
		$product_tax += $taxes_info["total"];
	} else {
		pvs_order_taxes_calculate( $product_subtotal, false, "order" );
	}
	$taxes_text = "";
	$taxes_info["total"] = $product_tax;
	$taxes_info["text"] = "";
} else {
	$taxes_info["total"] = 0;
	$taxes_info["included"] = 0;
	$taxes_info["text"] = "";
}

//Count product total
$product_total = $product_subtotal + $product_shipping + $product_tax * $taxes_info["included"] -
	$product_discount;

if ( $product_total < 0 ) {
	$product_total = 0;
}


$_SESSION["product_total"] = $product_total;
$_SESSION["product_subtotal"] = $product_subtotal;
$_SESSION["product_shipping"] = $product_shipping;
$_SESSION["product_shipping_type"] = $product_shipping_type;
$_SESSION["product_tax"] = $product_tax;
$_SESSION["product_discount"] = $product_discount;
$_SESSION["weight"] = $weight;


?>