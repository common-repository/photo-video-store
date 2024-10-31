<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check captcha
require_once ( PVS_PATH . 'includes/plugins/recaptcha/recaptchalib.php' );
$flag_captcha = pvs_check_captcha();

if ( $flag_captcha ) {
	include( PVS_PATH . 'templates/check_guest_content.php');
	
	header( "location:" . site_url()  . "/checkout/" );
	exit();
} else {
	header( "location:" . site_url()  . "/checkout/?error=captcha" );
	exit();
}
?>