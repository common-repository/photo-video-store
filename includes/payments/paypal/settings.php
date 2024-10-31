<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
//Check access
pvs_admin_panel_access( "settings_payments" );

if ( @$_REQUEST["action"] == 'change' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-paypal' ) )
{
	pvs_update_setting('paypal_account', pvs_result( $_POST["account"] ));
	pvs_update_setting('paypal_active', (int) @ $_POST["active"] );
	pvs_update_setting('paypal_ipn', (int) @ $_POST["ipn"] );
	pvs_update_setting('paypal_direct', (int) @ $_POST["paypal_direct"] );
	
	//Update settings
	pvs_get_settings();
}
?>

<p>Please login on <a href="http://www.paypal.com/">www.paypal.com</a> as merchant</p>
<p>Enable <b>"Instant Payment Notification"</p>


<p>Set <b>Notify URL:</b><br> <?php echo (site_url( ) );?>/payment-notification/?payment=paypal</p>



<form method="post">
<input type="hidden" name="d" value="<?php echo($_GET["d"]);?>">
<input type="hidden" name="action" value="change">
<?php wp_nonce_field( 'pvs-paypal' ); ?>
<div class='admin_field'>
<span><?php echo pvs_word_lang( "account" )?>:</span>
<input type='text' name='account'  style="width:400px" value="<?php echo $pvs_global_settings["paypal_account"] ?>">
</div>


<div class='admin_field'>
<span><?php echo pvs_word_lang( "enable" )?>:</span>
<input type='checkbox' name='active' value="1" <?php
	if ( $pvs_global_settings["paypal_active"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>

<div class='admin_field'>
<span><?php echo pvs_word_lang( "allow ipn" )?>:</span>
<input type='checkbox' name='ipn' value="1" <?php
	if ( $pvs_global_settings["paypal_ipn"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>

<div class='admin_field'>
<span><?php echo pvs_word_lang( "Direct Paypal payment without shopping cart (Only for Royalty-free digital files)" )?>:</span>
<input type='checkbox' name='paypal_direct' value="1" <?php
	if ( $pvs_global_settings["paypal_direct"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>

<div class='admin_field'>
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "save" )?>">
</div>
</form>