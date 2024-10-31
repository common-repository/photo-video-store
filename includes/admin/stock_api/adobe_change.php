<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_stockapi" );

if ( wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-adobe' ) ) {
	$param_settings = array(
		'adobe_id',
		'adobe_key',
		'adobe_contributor',
		'adobe_show' );
	
	for ( $i = 0; $i < count( $param_settings ); $i++ )
	{
		pvs_update_setting($param_settings[$i], pvs_result( $_POST[$param_settings[$i]] ));
	}
	
	pvs_update_setting('adobe_api', ( int )@$_POST['adobe_api']);
	pvs_update_setting('adobe_pages', ( int )@$_POST['adobe_pages']);
	pvs_update_setting('adobe_prints', ( int )@$_POST['adobe_prints']);
	pvs_update_setting('adobe_files', ( int )@$_POST['adobe_files']);
}
?>
