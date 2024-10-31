<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

?>
<div class="page_internal">
<h1><?php echo pvs_word_lang( "checkout" )?></h1>


<?php
if ( ! is_user_logged_in() and ! $pvs_global_settings["no_cart"] ) {
	include ( "login_content.php" );
} else
{
	include ( "checkout_content.php" );
}
?>


</div>
