<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
//Check access
pvs_admin_panel_access( "orders_carts" );

$sql = "select id from " . PVS_DB_PREFIX . "carts";
$rs->open( $sql );
while ( ! $rs->eof ) {
	if ( isset( $_POST["sel" . $rs->row["id"]] ) ) {
		$sql = "delete from " . PVS_DB_PREFIX . "carts where id=" . $rs->row["id"];
		$db->execute( $sql );
		
		$sql = "select id from " . PVS_DB_PREFIX . "carts_content where id_parent=" . $rs->row["id"];
		$ds->open($sql);
		while ( ! $ds->eof ) {
			$sql = "delete from " . PVS_DB_PREFIX . "packages_list where cart_content_id=" . $ds->row["id"];
			$db->execute( $sql );
			
			$ds->movenext();
		}

		$sql = "delete from " . PVS_DB_PREFIX . "carts_content where id_parent=" . $rs->
			row["id"];
		$db->execute( $sql );
	}
	$rs->movenext();
}

?>
