<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "catalog_bulkupload" );
?>
<h1><?php echo pvs_word_lang( "CSV video uploader" )?></h1>
<br>
<div class="form_field">
You have to upload <b>videos.csv</b> file (with comma separator) and videos into the folder: <a href="<?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["videopreupload"]);?>videos.csv"><br><b><?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["videopreupload"]);?></b></a>
<br>[<a href="<?php echo(pvs_plugins_url());?>/assets/csv/videos.csv">CSV example</a>]
</div>
<?php
if (file_exists(pvs_upload_dir().$pvs_global_settings["videopreupload"]."videos.csv")) {

$mass=pvs_parcer_csv(pvs_upload_dir().$pvs_global_settings["videopreupload"]."videos.csv");

?>



<form method="post" action="<?php echo(pvs_plugins_admin_url('catalog/index.php'));
?>&action=video_csv_upload" name="uploadform">
<?php wp_nonce_field( 'pvs-csv-upload' ); ?>


<div class="form_field">
<b>Rows in csv file: [<?php echo(count($mass)-1);?>]</b><br>
<small>(The first row is supposed to be the column's titles)</small>
</div>

<div class="form_field">
<b>Columns:</b><br>
<small>
1) Video file for sale (it must be uploaded into <?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["videopreupload"]);?><b>video.avi</b> folder)<br>
2) Photo *.jpg preview<br>
3) Video *.mp4 preview<br>
4) Title<br>
5) Description<br>
6) Keywords ',' - separator<br>
7) Author<br>
8) Categories ',' - separator</small>
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

