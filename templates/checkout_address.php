<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

if ( preg_match('/billing/', $_REQUEST['key']) or preg_match('/shipping/', $_REQUEST['key']) or preg_match('/thesame/', $_REQUEST['key']) or preg_match('/guest_email/', $_REQUEST['key']) ) {
	$_SESSION[$_REQUEST['key']] = $_REQUEST['value'];
	
	if ( @$_REQUEST["thesame"] == 1 ) {
		$_SESSION[str_replace("billing","shipping",$_REQUEST['key'])] = $_REQUEST['value'];
	}
	
	if ($_REQUEST['key'] == 'thesame1') {
		$_SESSION["shipping_thesame"] = 1;
	}
	
	if ($_REQUEST['key'] == 'thesame2') {
		$_SESSION["shipping_thesame"] = 0;
	}
}
?>