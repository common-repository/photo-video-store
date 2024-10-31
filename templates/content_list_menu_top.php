<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

?>
<div class="clearfix" style="padding-bottom:10px;margin-bottom:20px;border-bottom:1px solid #f5f5f5">
	<?php
$search_title = pvs_word_lang( "results" );
$search_description = '';
$search_buttons = '';
if ( $id_parent != 0 ) {
	$sql2 = "select id,title from " . PVS_DB_PREFIX .
		"category where id=" . ( int )$id_parent;
	$dr->open( $sql2 );
	if ( ! $dr->eof ) {
		$translate_results = pvs_translate_category( $dr->row["id"], $dr->row["title"],
			"", "" );
		$search_title = $translate_results["title"];
	}
	
	$sql2 = "select collection_id from " . PVS_DB_PREFIX . "collections_items where category_id=" . ( int )$id_parent;
	$ds->open( $sql2 );
	while ( ! $ds->eof ) {
	
		$sql2 = "select title,description,price from " . PVS_DB_PREFIX . "collections where active = 1 and id=" . ( int ) $ds->row["collection_id"];
		$dr->open( $sql2 );
		if ( ! $dr->eof ) {
			$search_description .= '<p><b>' . pvs_word_lang("Collection") . ': ' . $dr->row["title"] . '</b><br>';
			if ( $dr->row["description"] != '') {
				$search_description .= $dr->row["description"] . '<br>';	
			}
			$search_description .= '<b>' . pvs_word_lang("price") . ':</b> <span class="price">' . pvs_currency( 1 ) . pvs_price_format( $dr->row["price"], 2 ) . '  ' . pvs_currency( 2 ) . '</span></p>';
			$search_description .= '<p><a href="' . site_url() . '/shopping-cart-add-collection/?collection=' . ( int ) $ds->row["collection_id"] . '" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"> </i> ' . pvs_word_lang("add to cart") . '</a></p>';
		}
		
		$ds->movenext();
	}
}
if ( isset( $_REQUEST["collection"] ) ) {
	$sql2 = "select title,description,price from " . PVS_DB_PREFIX . "collections where active = 1 and id=" . ( int ) $_REQUEST["collection"];
	$dr->open( $sql2 );
	if ( ! $dr->eof ) {
		$search_title = pvs_word_lang("Collection") . ': ' . $dr->row["title"];
		$search_description = '<p>' . $dr->row["description"] . '<br><b>' . pvs_word_lang("price") . ':</b> <span class="price">' . pvs_currency( 1 ) . pvs_price_format( $dr->row["price"], 2 ) . '  ' . pvs_currency( 2 ) . '</span></p>';
		$search_description .= '<p><a href="' . site_url() . '/shopping-cart-add-collection/?collection=' . ( int ) $_REQUEST["collection"] . '" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"> </i> ' . pvs_word_lang("add to cart") . '</a></p>';
	}
}
if ( isset( $_REQUEST["lightbox"] ) ) {
	$sql2 = "select title from " . PVS_DB_PREFIX . "lightboxes where id=" . ( int ) $_REQUEST["lightbox"];
	$dr->open( $sql2 );
	if ( ! $dr->eof ) {
		$search_title = pvs_word_lang("Lightbox") . ': ' . $dr->row["title"];
		if (!$pvs_global_settings["printsonly"]) {
			$search_description .= '<p><a href="' . site_url() . '/shopping-cart-add-lightbox/?lightbox=' . ( int ) $_REQUEST["lightbox"] . '" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"> </i> ' . pvs_word_lang("add to cart") . '</a> </p>';
		}
	}
}
?>
	<h1><?php echo $search_title
?> <span id="result_count">(<?php
if ( ! $pvs_global_settings["no_calculation"] ) {
	echo ( $record_count );
} else
{
	echo ( " > " . $pvs_global_settings["no_calculation_result"] );
}
?>)</span>
</h1>
<?php echo($search_description);?>
	<div id="search_header2">
	<div id="search_sort">
		<?php
if ( $stock_remote ) {
	$stockmenu = "<select onChange='location.href=this.value' style='width:130px' class='form-control'>";
	foreach ( $mstocks as $key => $value ) {
		if ( $pvs_global_settings[$key . "_api"] ) {
			$sel = "";
			if ( $key == $stock )
			{
				$sel = "selected";
			}

			if ( isset( $_REQUEST["print_id"] ) and ( int )$_REQUEST["print_id"] > 0 )
			{
				$print_var = '&print_id=' . ( int )$_REQUEST["print_id"];
			} else
			{
				$print_var = "";
			}

			$stockmenu .= "<option value='?stock=" . $key . "&search=" . urlencode( @$_REQUEST["search"] ) .
				$print_var . "' " . $sel . ">" . $value . "</option>";
		}
	}
	$stockmenu .= "</select>";
	echo ( $stockmenu );
} else
{
	echo ( $sortmenu );
}
?>
	</div>
	
	<div id="search_contentmenu">
		<?php
$stock_sort = array();

if ( $stock != "site" ) {
	if ( $stock == 'shutterstock' ) {
		$stock_sort = array(
			"popular",
			"newest",
			"relevance",
			"random" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $value == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $value . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'fotolia' ) {
		$stock_sort = array();
		$stock_sort['relevance'] = pvs_word_lang( "relevance" );
		$stock_sort['price_1'] = pvs_word_lang( "price" );
		$stock_sort['creation'] = pvs_word_lang( "date" );
		$stock_sort['nb_views'] = pvs_word_lang( "most popular" );
		$stock_sort['nb_downloads'] = pvs_word_lang( "most downloaded" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'istockphoto' ) {
		$stock_sort = array();
		$stock_sort['best_match'] = pvs_word_lang( "relevance" );
		$stock_sort['most_popular'] = pvs_word_lang( "most popular" );
		$stock_sort['newest'] = pvs_word_lang( "date" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'depositphotos' ) {
		$stock_sort = array();
		$stock_sort['1'] = pvs_word_lang( "relevance" );
		$stock_sort['4'] = pvs_word_lang( "most downloaded" );
		$stock_sort['5'] = pvs_word_lang( "new" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'bigstockphoto' ) {
		$stock_sort = array();
		$stock_sort['popular'] = pvs_word_lang( "most popular" );
		$stock_sort['relevant'] = pvs_word_lang( "relevance" );
		$stock_sort['new'] = pvs_word_lang( "date" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'rf123' ) {
		$stock_sort = array();
		$stock_sort['random'] = pvs_word_lang( "random" );
		$stock_sort['latest'] = pvs_word_lang( "new" );
		$stock_sort['most_downloaded'] = pvs_word_lang( "most downloaded" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}

	if ( $stock == 'pixabay' ) {
		$stock_sort = array();
		$stock_sort['popular'] = pvs_word_lang( "most popular" );
		$stock_sort['latest'] = pvs_word_lang( "new" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}
	
	if ( $stock == 'adobe' ) {
		$stock_sort = array();
		$stock_sort['relevance'] = pvs_word_lang( "Relevance" );
		$stock_sort['creation'] = pvs_word_lang( "new" );
		$stock_sort['popularity'] = pvs_word_lang( "most popular" );
		$stock_sort['nb_downloads'] = pvs_word_lang( "most downloaded" );
		$stock_sort['undiscovered'] = pvs_word_lang( "Undiscovered" );

		$vars_sort = pvs_build_variables( "sort", "" );
		$sortmenu = "<select onChange='location.href=this.value' style='width:160px' class='form-control'>";

		foreach ( $stock_sort as $key => $value ) {
			$sel = "";
			if ( $key == @$_REQUEST["sort"] )
			{
				$sel = "selected";
			}
			$sortmenu .= "<option value='" . $vars_sort . "&sort=" . $key . "' " . $sel .
				">" . pvs_word_lang( $value ) . "</option>";
		}

		$sortmenu .= "</select>";
		echo ( $sortmenu );
	}
} else
{
	if ( $stock_remote ) {
		echo ( $sortmenu );
	} else {
		echo ( $contentmenu );
	}
}
?>
	</div>

	<div id="search_items"><?php echo $itemsmenu
?></div>
	<?php
$flow_count = 0;
if ( $pvs_global_settings["grid"] ) {
	$flow_count++;
}
if ( $pvs_global_settings["fixed_width"] ) {
	$flow_count++;
}
if ( $pvs_global_settings["fixed_height"] ) {
	$flow_count++;
}

if ( $flow_count > 1 and ( int )@$_REQUEST["print_id"] == 0 ) {
?>
		<div id="search_flow_menu">
			<?php
	if ( $pvs_global_settings["grid"] ) {
?>
	<a href="<?php echo pvs_build_variables( "flow", "" )?>&flow=0"><img src="<?php echo( pvs_plugins_url() ); ?>/assets/images/view0.gif" class='<?php
		if ( $flow == 0 ) {
			echo ( "active" );
		} else {
			echo ( "disabled" );
		}
?>'></a>
	<?php
	}
	if ( $pvs_global_settings["fixed_width"] ) {
?>
	<a href="<?php echo pvs_build_variables( "flow", "" )?>&flow=1"><img src="<?php echo( pvs_plugins_url() ); ?>/assets/images/view1.gif" class='<?php
		if ( $flow == 1 ) {
			echo ( "active" );
		} else {
			echo ( "disabled" );
		}
?>'></a>
	<?php
	}
	if ( $pvs_global_settings["fixed_height"] ) {
?>
	<a href="<?php echo pvs_build_variables( "flow", "" )?>&flow=2"><img src="<?php echo( pvs_plugins_url() ); ?>/assets/images/view2.gif" class='<?php
		if ( $flow == 2 ) {
			echo ( "active" );
		} else {
			echo ( "disabled" );
		}
?>'></a>
	<?php
	}
?>
		</div>
	<?php
}
?>
	
	<?php
if ( $pvs_global_settings["auto_paging"] ) {
?>
		<div id="search_autopaging_menu"><input type="checkbox" name="autopaging" <?php
	if ( $autopaging == 1 ) {
		echo ( "checked" );
	}
?> onClick="location.href='<?php echo pvs_build_variables( "autopaging", "" )?>&autopaging=<?php
	if ( $autopaging == 1 ) {
		echo ( 0 );
	} else {
		echo ( 1 );
	}
?>'">&nbsp;<?php echo pvs_word_lang( "auto" )?></div>
	<?php
}
if ( $pvs_global_settings["left_search"] ) {
?>
		<div id="search_show_menu" style="margin-top:5px"><input type="checkbox" name="showmenu" <?php
	if ( $showmenu == 1 ) {
		echo ( "checked" );
	}
?> onClick="location.href='<?php echo pvs_build_variables( "showmenu", "" )?>&showmenu=<?php
	if ( $showmenu == 1 ) {
		echo ( 0 );
	} else {
		echo ( 1 );
	}
?>'">&nbsp;<?php echo pvs_word_lang( "menu" )?></div>
	<?php
}
?>
	</div>
</div>