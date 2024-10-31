<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "catalog_bulkupload" );

if ( isset( $_GET["d"] ) ) {
	$d = ( int )$_GET["d"];
} else
{
	$d = 1;
}

if ( @$_REQUEST["action"] == 'image' )
{
	include("image.php");
}

if ( @$_REQUEST["action"] == 'photo_upload' )
{
	include("photo_upload.php");
}

include ( plugin_dir_path( __FILE__ ) . "../includes/header.php" );
?>

<script>
function change_group(value)
{
	jQuery(".group_settings").css("display","none");
	jQuery(".group_"+value).css("display","block");
	jQuery(".menu_settings").removeClass('nav-tab-active');
	jQuery(".menu_settings_"+value).addClass('nav-tab-active');
}

jQuery(document).ready(function() {
	change_group('files');
});
</script>


<div class="btn-group toright" style="padding-right:50px">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><?php echo pvs_word_lang( "Select uploader" )?> <span class="caret"></span></button>
  <ul class="dropdown-menu" role="menu">
  	<?php
  	if ( $pvs_global_settings["allow_photo"] ) {
  	?>
    	<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=1"><?php echo pvs_word_lang( "ftp photo uploader" )?></a></li>
    	<?php
  		if ( PVS_LICENSE != 'Free' ) {
  		?>
    		<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=6"><?php echo pvs_word_lang( "CSV photo uploader" )?></a></li>
    	<?php
    	}
    	?>
    	<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=10"><?php echo pvs_word_lang( "Dropzone photo uploader" )?></a></li>
    	<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=5"><?php echo pvs_word_lang( "java photo uploader" )?></a></li>
    	<li class="divider"></li>
    	<?php
    }

  	if ( $pvs_global_settings["allow_video"] ) {
  	?>
    	<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=2"><?php echo pvs_word_lang( "ftp video uploader" )?></a></li>
    	<?php
  		if ( PVS_LICENSE != 'Free' ) {
  		?>
    		<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=7"><?php echo pvs_word_lang( "CSV video uploader" )?></a></li>
    	<?php
    	}
    	?>
    	<li class="divider"></li>
    	<?php
    }

  	if ( $pvs_global_settings["allow_audio"] ) {
  	?>
    	<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=3"><?php echo pvs_word_lang( "ftp audio uploader" )?></a></li>
    	<?php
  		if ( PVS_LICENSE != 'Free' ) {
  		?>
    		<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=8"><?php echo pvs_word_lang( "CSV audio uploader" )?></a></li>
    	<?php
    	}
    	?>
    	<li class="divider"></li>
    	<?php
    }

  	if ( $pvs_global_settings["allow_vector"] ) {
  	?>
   		<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=4"><?php echo pvs_word_lang( "ftp vector uploader" )?></a></li>
    	<?php
  		if ( PVS_LICENSE != 'Free' ) {
  		?>
    		<li><a href="<?php echo(pvs_plugins_admin_url('bulk_upload/index.php'));?>&d=9"><?php echo pvs_word_lang( "CSV vector uploader" )?></a></li>
    	<?php
    	}
    }
    ?>
  </ul>
</div>


<link rel="stylesheet" href="<?php echo ( pvs_plugins_url() );
?>/assets/js/treeview/jquery.treeview.css" />
<script src="<?php echo ( pvs_plugins_url() );
?>/assets/js/treeview/jquery.cookie.js"></script>
<script src="<?php echo ( pvs_plugins_url() );
?>/assets/js/treeview/jquery.treeview.js"></script>

<script>
jQuery(document).ready(function(){
	jQuery("#categories_tree_menu").treeview({
		collapsed: false,
		persist: "cookie",
		cookieId: "treeview-black"
	});
});
</script>


<?php

if ( isset( $_GET["str"] ) ) {
	$str = ( int )$_GET["str"];
} else
{
	$str = 1;
}

if ( $d == 1 ) {
	include ( "photo.php" );
}

if ( $d == 5 ) {
	include ( "photo_java.php" );
}

if ( $d == 6 ) {
	include ( "photo_csv.php" );
}

if ( $d == 2 ) {
	include ( "video.php" );
}

if ( $d == 7 ) {
	include ( "video_csv.php" );
}

if ( $d == 3 ) {
	include ( "audio.php" );
}

if ( $d == 8 ) {
	include ( "audio_csv.php" );
}

if ( $d == 4 ) {
	include ( "vector.php" );
}

if ( $d == 9 ) {
	include ( "vector_csv.php" );
}

if ( $d == 10 ) {
	include ( "photo_dropzone.php" );
}

include ( plugin_dir_path( __FILE__ ) . "../includes/footer.php" );
?>