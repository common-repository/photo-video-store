<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_stockapi" );

if ( wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-fotolia' ) ) {
	$auth = base64_encode( $pvs_global_settings["fotolia_id"] . ":" );
	
	//Load categories:
	$url = 'http://api.fotolia.com/Rest/1/search/getCategories1';
	
	$headers = array(
		'Authorization' => 'Basic ' . $auth,
		'Accept'        => 'application/json',
		'Content-Type'  => 'application/json; charset=UTF-8',
		'Host'          => 'api.fotolia.com'
	);
	
	
	$result = wp_remote_get( $url, array(
		'headers'     => $headers,
		'timeout'     => 10
	) );
	
	
	if ( ! is_wp_error( $result ) ) {
		$results = json_decode( $result["body"] );
	
		$sql = "delete from " . PVS_DB_PREFIX . "category_stock where stock = 'fotolia'";
		$db->execute( $sql );
	
		foreach ( $results as $key => $value )
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"category_stock (id,title,stock) values (" . $value->id . ",'" . $value->name .
				"','fotolia')";
			$db->execute( $sql );
		}
	}
}
?>
