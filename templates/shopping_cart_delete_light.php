<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

header('Content-Type: application/json');

$id = ( int )$_REQUEST["id"];

$cart_id = pvs_shopping_cart_id();

$sql = "select id from " . PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
$rs->open($sql);
while ( ! $rs->eof ) {
	$sql = "delete from " . PVS_DB_PREFIX . "packages_list where cart_content_id=" . $rs->row["id"];
	$db->execute( $sql );
	
	$rs->movenext();
}

$sql = "delete from " . PVS_DB_PREFIX . "carts_content where publication_id=" .
	$id . " and id_parent=" . $cart_id;
$db->execute( $sql );

include ( "shopping_cart_add_content.php" );
$ajax_result = array( "box_shopping_cart" => $box_shopping_cart,
		"box_shopping_cart_lite" => $box_shopping_cart_lite );

echo (json_encode($ajax_result));
?>