<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_stockapi" );

if ( wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-depositphotos' ) ) {
	//Load categories:
	$url = "http://api.depositphotos.com?dp_apikey=" . $pvs_global_settings["depositphotos_id"] .
		"&dp_command=getCategoriesList";
	
	$result = wp_remote_get( $url, array(
		'timeout'     => 10
	) );
	
	if ( ! is_wp_error( $result ) ) {
		$results = json_decode( $result["body"] );
	
		$sql = "delete from " . PVS_DB_PREFIX .
			"category_stock where stock = 'depositphotos'";
		$db->execute( $sql );
	
		foreach ( $results->result as $key => $value )
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"category_stock (id,title,stock) values (" . $key . ",'" . $value .
				"','depositphotos')";
			$db->execute( $sql );
		}
	}
}
?>
