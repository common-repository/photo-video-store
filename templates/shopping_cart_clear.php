<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$cart_id = pvs_shopping_cart_id();

$sql = "select id from " . PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
$rs->open($sql);
while ( ! $rs->eof ) {
	$sql = "delete from " . PVS_DB_PREFIX . "packages_list where cart_content_id=" . $rs->row["id"];
	$db->execute( $sql );
	
	$rs->movenext();
}

$sql = "delete from " . PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
$db->execute( $sql );

include ( "shopping_cart_content.php" );
?>
