<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$user_lightbox ="";
if ( is_user_logged_in() ) {
	$user_lightbox = ' or id in (select id_parent from ' . PVS_DB_PREFIX .
	'lightboxes_admin where user=' . get_current_user_id() . ') ';
}

$sql2 = "select id from " . PVS_DB_PREFIX . "lightboxes where (catalog = 1 " . $user_lightbox . ") and id=" . ( int )  $_REQUEST["lightbox"];
$dr->open( $sql2 );
if ( ! $dr->eof ) {
	$sql = "select item from " . PVS_DB_PREFIX . "lightboxes_files where id_parent=" . ( int )$_REQUEST["lightbox"];
	$dd->open($sql);
	while (! $dd->eof) {

		if ( ! pvs_is_rights_managed($dd->row["item"]) ) {
			$id = 0;
			$sql = "select id from " . PVS_DB_PREFIX . "items where id_parent=" . $dd->row["item"] . " and price>0 order by price";
			$ds->open( $sql );
			if ( ! $ds->eof ) {
				$id = $ds->row["id"];
			}
		
			$params["item_id"] = $id;
			$params["prints_id"] = 0;
			
			$params["publication_id"] = $dd->row["item"];
			$params["quantity"] = 1;
			
			for ( $i = 1; $i < 11; $i++ ) {
				$params["option" . $i . "_id"] = 0;
				$params["option" . $i . "_value"] = "";
			}
		}
		
		pvs_shopping_cart_add( $params );
		$dd->movenext();
	}
}

header( "location:" . site_url() . "/cart/" );
?>