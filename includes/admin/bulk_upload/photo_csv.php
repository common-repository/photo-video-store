<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "catalog_bulkupload" );
?>
<h1><?php echo pvs_word_lang( "CSV photo uploader" )?></h1>


<br>
<div class="form_field">
You have to upload <b>photos.csv</b> file (with comma separator) and images into the folder: <a href="<?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["photopreupload"]);?>photos.csv"><br><b><?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["photopreupload"]);?></b></a>
<br>[<a href="<?php echo(pvs_plugins_url());?>/assets/csv/photos.csv">CSV example</a>]
</div>
<?php
if (file_exists(pvs_upload_dir().$pvs_global_settings["photopreupload"]."photos.csv")) {

$mass=pvs_parcer_csv(pvs_upload_dir().$pvs_global_settings["photopreupload"]."photos.csv");

?>



<form method="post" action="<?php echo(pvs_plugins_admin_url('catalog/index.php'));
?>&action=photo_csv_upload" name="uploadform">
<?php wp_nonce_field( 'pvs-csv-upload' ); ?>


<div class="form_field">
<b>Rows in csv file: [<?php echo(count($mass)-1);?>]</b><br>
<small>(The first row is supposed to be the column's titles)</small>
</div>

<div class="form_field">
<b>Columns:</b><br>
<small>
1) Filename *.jpg (it must be uploaded into <?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["photopreupload"]);?><b>filename.jpg</b> folder)<br>
2) Title<br>
3) Description<br>
4) Keywords ',' - separator<br>
5) Author<br>
6) Categories ',' - separator</small>
</div>








<div class="form_field">
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "upload" )?>">
</div>
</form>

<?php
} else {
?>
<div class="form_field">
Error. It doesn't exist.
</div>
<?php
}
?>

