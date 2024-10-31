<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
//Check access
pvs_admin_panel_access( "orders_orders" );


$sql = "update " . PVS_DB_PREFIX . "downloads set tlimit=0,data=" . ( pvs_get_time
	() +
	3600 * 24 * $pvs_global_settings["download_expiration"] ) . " where  id=" . ( int )
	$_REQUEST["download_id"];
$db->execute( $sql );

?>