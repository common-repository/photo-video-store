<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$id = ( int )$_REQUEST["id"];

$cart_id = pvs_shopping_cart_id();

$sql = "delete from " . PVS_DB_PREFIX . "carts_content where id=" . $id . " and id_parent=" . $cart_id;
$db->execute( $sql );

$sql = "delete from " . PVS_DB_PREFIX . "packages_list where cart_content_id=" . $id;
$db->execute( $sql );

include ( "shopping_cart_content.php" );

?>