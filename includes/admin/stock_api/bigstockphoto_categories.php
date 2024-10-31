<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_stockapi" );

if ( wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-bigstockphoto' ) ) {
	//Load categories:
	$url = "api.bigstockphoto.com/2/" . $pvs_global_settings["bigstockphoto_id"] .
		"/categories/";
	
	$result = wp_remote_get( $url, array(
		'timeout'     => 10
	) );
	
	if ( ! is_wp_error( $result ) ) {
		$results = json_decode( $result["body"] );
	
		$sql = "delete from " . PVS_DB_PREFIX .
			"category_stock where stock = 'bigstockphoto'";
		$db->execute( $sql );
	
		foreach ( $results->data as $key => $value )
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"category_stock (id,title,stock) values (0,'" . $value->name .
				"','bigstockphoto')";
			$db->execute( $sql );
		}
	}
}
?>
