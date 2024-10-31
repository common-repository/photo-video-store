<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_stockapi" );
?>

<div class="subheader"><?php
echo pvs_word_lang( "overview" )
?></div>
<div class="subheader_text">

<p>
<b>Documentation:</b><br>
<a href="https://developers.adobe.com/">developers.adobe.com</a>
</p>

</div>
<div class="subheader"><?php
echo pvs_word_lang( "settings" )
?></div>
<div class="subheader_text">

	<form method="post">
	<input type="hidden" name="action" value="change_adobe">
	<?php wp_nonce_field( 'pvs-adobe' ); ?>

	
	<div class='admin_field'>
	<span>Adobe Stock API:</span>
	<input type="checkbox" name="adobe_api" value="1" <?php
if ( $pvs_global_settings["adobe_api"] )
{
	echo ( "checked" );
}
?>><br>
	</div>
	
	<div class='admin_field'>
	<span>Client ID:</span>
	<input type="text" name="adobe_id" value="<?php
echo $pvs_global_settings["adobe_id"]
?>" style="width:350px"><br>
	</div>
	
	<div class='admin_field'>
	<span>Client Secret:</span>
	<input type="text" name="adobe_key" value="<?php echo $pvs_global_settings["adobe_key"] ?>" style="width:350px"><br>
	</div>

	
	<div class='admin_field'>
	<span>Adobe Creator ID:</span>
	<input type="text" name="adobe_contributor" value="<?php echo $pvs_global_settings["adobe_contributor"] ?>" style="width:350px"><br>
	</div>
	
	<div class='admin_field'>
	<span><?php
echo pvs_word_lang( "Create internal pages for files" )
?>:</span>
	<input type="checkbox" name="adobe_pages" value="1" <?php
if ( $pvs_global_settings["adobe_pages"] )
{
	echo ( "checked" );
}
?>><br>
	</div>
	
	<div class='admin_field'>
	<span><?php
echo pvs_word_lang( "files" )
?>:</span>
	<input type="checkbox" name="adobe_files" value="1" <?php
if ( $pvs_global_settings["adobe_files"] )
{
	echo ( "checked" );
}
?>><br>
	</div>

	<div class='admin_field'>
	<span><?php
echo pvs_word_lang( "Prints on Demand" )
?>:</span>
	<input type="checkbox" name="adobe_prints" value="1" <?php
if ( $pvs_global_settings["adobe_prints"] )
{
	echo ( "checked" );
}
?>><br>
	</div>
	
	<div class='admin_field'>
	<span><?php
echo pvs_word_lang( "by default" )
?>:</span>
	<select name="adobe_show" style="width:350px">
		<option value="1" <?php
if ( $pvs_global_settings["adobe_show"] == 1 )
{
	echo ( "selected" );
}
?>><?php
echo pvs_word_lang( "files" )
?></option>
		<option value="2" <?php
if ( $pvs_global_settings["adobe_show"] == 2 )
{
	echo ( "selected" );
}
?>><?php
echo pvs_word_lang( "prints" )
?></option>
	</select>
	</div>
	
	<div class='admin_field'>
	<input type="submit" class="button button-primary button-large" value="<?php
echo pvs_word_lang( "save" )
?>">
	</div>

	</form>

</div>
