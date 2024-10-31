<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}


//Check access
pvs_admin_panel_access( "catalog_catalog" );
include ( plugin_dir_path( __FILE__ ) . "../includes/header.php" );


//Photo delete
if ( @$_REQUEST["action"] == 'photo_delete'  and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-photo-delete' ) )
{
	include ( "photo_delete.php" );
}

//Delete
if ( @$_REQUEST["action"] == 'delete' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-delete' . $_GET["id"] ) )
{
	include ( "delete.php" );
}

//Add
if ( @$_REQUEST["action"] == 'add' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-catalog-add' ) )
{
	include ( "add.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Filter change
if ( @$_REQUEST["action"] == 'filter_change' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-filter-change' ) )
{
	include ( "filter_change.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk photo upload
if ( @$_REQUEST["action"] == 'photo_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-photo-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/photo_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk photo java upload
if ( @$_REQUEST["action"] == 'photo_java_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-photo-java-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/photo_java_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk photo csv upload
if ( @$_REQUEST["action"] == 'photo_csv_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-csv-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/photo_csv_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk video csv upload
if ( @$_REQUEST["action"] == 'video_csv_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-csv-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/video_csv_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk audio csv upload
if ( @$_REQUEST["action"] == 'audio_csv_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-csv-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/audio_csv_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk vector csv upload
if ( @$_REQUEST["action"] == 'vector_csv_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-csv-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/vector_csv_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk video upload
if ( @$_REQUEST["action"] == 'video_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-video-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/video_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk audio upload
if ( @$_REQUEST["action"] == 'audio_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-audio-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/audio_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}

//Bulk vector upload
if ( @$_REQUEST["action"] == 'vector_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-vector-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/vector_upload.php" );
	//Redirect to clear $_POST
	echo( "<script>pvs_redirect('" . pvs_plugins_admin_url( 'catalog/index.php' ) . "');</script>" );
}


//Photo Dropzone preupload
if ( @$_REQUEST["action"] == 'photo_dropzone_process' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-photo-dropzone-process' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/photo_dropzone_process.php" );
}


//Photo Dropzone upload
if ( @$_REQUEST["action"] == 'photo_dropzone_upload' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-photo-dropzone-upload' ) )
{
	include ( PVS_PATH . "includes/admin/bulk_upload/photo_dropzone_upload.php" );
}

if ( @$_REQUEST["action"] == 'edit' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-catalog-edit' ) )
{
	include ( PVS_PATH . "includes/admin/categories/edit.php" );
}

//Content
if ( @$_REQUEST["action"] == 'content' )
{
	include ( "content.php" );
} else if (@$_REQUEST["action"] == 'filter') {
	include ( "filter.php" );
} else if ((isset($_REQUEST["formaction"]) and $_REQUEST["formaction"] != 'delete_publication') and @$_REQUEST["step"] != 2) {
	
} else {

?>

<?php
if ( $pvs_global_settings["allow_vector"] ) {
?>
<a class="btn btn-success toright" href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&type=vector"><i class="icon-picture icon-white fa fa-leaf"></i>&nbsp; <?php echo pvs_word_lang( "upload vector" )?></a>
<?php
}

if ( $pvs_global_settings["allow_audio"] ) {
?>
<a class="btn btn-success toright" href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&type=audio"><i class="icon-music icon-white fa fa-music"></i>&nbsp; <?php echo pvs_word_lang( "upload audio" )?></a>
<?php
}

if ( $pvs_global_settings["allow_video"] ) {
?>
<a class="btn btn-success toright" href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&type=video"><i class="icon-film icon-white fa fa-film"></i>&nbsp; <?php echo pvs_word_lang( "upload video" )?></a>
<?php
}

if ( $pvs_global_settings["allow_photo"] ) {
?>
<a class="btn btn-success toright" href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&type=photo"><i class="icon-camera icon-white fa fa-photo"></i>&nbsp; <?php echo pvs_word_lang( "upload photo" )?></a>
<?php
}
?>

<h1><?php echo pvs_word_lang( "catalog" )?>:</h1>

<script>

function bulk_action(value) {
document.getElementById("formaction").value=value;

document.getElementById("adminform").submit();
}


</script>


<?php
//Catalog view
$view = "grid";

if ( isset( $_COOKIE["view_setting"] ) ) {
	$view = pvs_result( $_COOKIE["view_setting"] );
}

if ( isset( $_REQUEST["view"] ) ) {
	$view = pvs_result( $_REQUEST["view"] );
}



//Get Search
$search = "";
if ( isset( $_REQUEST["search"] ) ) {
	$search = pvs_result( $_REQUEST["search"] );
}

//Get Search type
$search_type = "";
if ( isset( $_REQUEST["search_type"] ) ) {
	$search_type = pvs_result( $_REQUEST["search_type"] );
}

//Get category ID
$category_id = 0;
if ( isset( $_REQUEST["category_id"] ) ) {
	$category_id = ( int )$_REQUEST["category_id"];
}

//Get type
$type = "all";
if ( isset( $_REQUEST["type"] ) ) {
	$type = pvs_result( $_REQUEST["type"] );
}

//Get pub_type
$pub_type = "all";
if ( isset( $_REQUEST["pub_type"] ) ) {
	$pub_type = pvs_result( $_REQUEST["pub_type"] );
}

//Get pub_ctype
$pub_ctype = "all";
if ( isset( $_REQUEST["pub_ctype"] ) ) {
	$pub_ctype = pvs_result( $_REQUEST["pub_ctype"] );
}

//Get filter
$filter = "all";
if ( isset( $_REQUEST["filter"] ) ) {
	$filter = pvs_result( $_REQUEST["filter"] );
}

//Items
$items = 30;
if ( isset( $_REQUEST["items"] ) ) {
	$items = ( int )$_REQUEST["items"];
}

//Search variable
$var_search = "search=" . $search . "&search_type=" . $search_type .
	"&category_id=" . $category_id . "&type=" . $type . "&items=" . $items .
	"&pub_type=" . $pub_type . "&pub_ctype=" . $pub_ctype . "&filter=" . $filter;

//Sort by title
$atitle = 0;
if ( isset( $_GET["atitle"] ) ) {
	$atitle = ( int )$_GET["atitle"];
}

//Sort by date
$adate = 0;
if ( isset( $_GET["adate"] ) ) {
	$adate = ( int )$_GET["adate"];
}

//Sort by downloads
$adownloads = 0;
if ( isset( $_GET["adownloads"] ) ) {
	$adownloads = ( int )$_GET["adownloads"];
}

//Sort by viewed
$aviewed = 0;
if ( isset( $_GET["aviewed"] ) ) {
	$aviewed = ( int )$_GET["aviewed"];
}

//Sort by ID
$aid = 0;
if ( isset( $_GET["aid"] ) ) {
	$aid = ( int )$_GET["aid"];
}

//Sort by default
if ( $atitle == 0 and $adate == 0 and $adownloads == 0 and $aviewed == 0 and $aid ==
	0 ) {
	$adate = 2;
}

//Add sort variable
$com = "";

if ( $atitle != 0 ) {
	$var_sort = "&atitle=" . $atitle;
	if ( $atitle == 1 ) {
		$com = " order by title ";
	}
	if ( $atitle == 2 ) {
		$com = " order by title desc ";
	}
}

if ( $adate != 0 ) {
	$var_sort = "&adate=" . $adate;
	if ( $adate == 1 ) {
		$com = " order by data ";
	}
	if ( $adate == 2 ) {
		$com = " order by data desc ";
	}
}

if ( $aviewed != 0 ) {
	$var_sort = "&aviewed=" . $aviewed;
	if ( $aviewed == 1 ) {
		$com = " order by viewed ";
	}
	if ( $aviewed == 2 ) {
		$com = " order by viewed desc ";
	}
}

if ( $adownloads != 0 ) {
	$var_sort = "&adownloads=" . $adownloads;
	if ( $adownloads == 1 ) {
		$com = " order by downloaded ";
	}
	if ( $adownloads == 2 ) {
		$com = " order by downloaded desc ";
	}
}

if ( $aid != 0 ) {
	$var_sort = "&aid=" . $aid;
	if ( $aid == 1 ) {
		$com = " order by id ";
	}
	if ( $aid == 2 ) {
		$com = " order by id desc ";
	}
}

//Types
$mass_types = array();
if ( $pvs_global_settings["allow_photo"] ) {
	$mass_types[] = "photo";
}
if ( $pvs_global_settings["allow_video"] ) {
	$mass_types[] = "video";
}
if ( $pvs_global_settings["allow_audio"] ) {
	$mass_types[] = "audio";
}
if ( $pvs_global_settings["allow_vector"] ) {
	$mass_types[] = "vector";
}

//Items on the page
$items_mass = array(
	10,
	20,
	30,
	50,
	75,
	100 );

//Search parameter
$com2 = "";

if ( $search != "" ) {
	if ( $search_type == "title" ) {
		$com2 .= " and (title like '%" . $search . "%' or description like '%" . $search .
			"%' or keywords like '%" . $search . "%') ";
	}
	if ( $search_type == "id" ) {
		$com2 .= " and id=" . ( int )$search . " ";
	}
	if ( $search_type == "author" ) {
		$com2 .= " and author = '" . $search . "' ";
	}
	if ( $search_type == "lightbox" ) {
		$lightbox_id = 0;
		$sql = "select id from " . PVS_DB_PREFIX . "lightboxes where title='" . $search .
			"'";
		$dr->open( $sql );
		if ( ! $dr->eof ) {
			$lightbox_id = $dr->row["id"];
		}

		$com2 .= " and (id in (select item from " . PVS_DB_PREFIX .
			"lightboxes_files where id_parent=" . $lightbox_id . ")) ";
	}
	if ( $search_type == "collection" ) {
		$sql = "select id,types from " . PVS_DB_PREFIX . "collections where title='" . $search . "'";
		$dr->open( $sql );
		if ( ! $dr->eof ) {
			if ($dr->row["types"] == 0) {
				$com2 .= " and (id in ( select publication_id from " . PVS_DB_PREFIX . "category_items where category_id  in (select category_id from " . PVS_DB_PREFIX . "collections_items where collection_id=" . $dr->row["id"] . "))) ";			
			} else {
				$com2 .= " and (id in (select publication_id from " . PVS_DB_PREFIX . "collections_items where collection_id=" . $dr->row["id"] . ")) ";			
			}
		}
	}
}

if ( $category_id != 0 ) {
	$com2 .= " and (id in (select publication_id from " . PVS_DB_PREFIX .
		"category_items where category_id=" . $category_id . ")) ";
}

if ( $pub_type == "featured" ) {
	$com2 .= " and (featured=1) ";
}

$sql_editorial = "";
if ( $pub_type == "editorial" ) {
	$sql_editorial .= " and (editorial=1) ";
}
if ( $pub_type == "free" ) {
	$com2 .= " and (free=1) ";
}
if ( $pub_type == "adult" ) {
	$com2 .= " and (adult=1) ";
}
if ( $pub_type == "exclusive" ) {
	$com2 .= " and (exclusive=1) ";
}
if ( $pub_type == "contacts" ) {
	$com2 .= " and (contacts=1) ";
}
if ( $pub_type == "exclusive_sold" ) {
	$com2 .= " and (exclusive=1 and published=-1) ";
}
if ( $pub_type == "approved" ) {
	$com2 .= " and (published=1) ";
}
if ( $pub_type == "pending" ) {
	$com2 .= " and (published=0) ";
}
if ( $pub_type == "declined" ) {
	$com2 .= " and (published=-1 and exclusive<>1) ";
}

if ( $pub_ctype != "all" ) {
	$com2 .= " and (content_type='" . $pub_ctype . "') ";
}

if ( $filter == "yes" ) {
	$sql = "select words from " . PVS_DB_PREFIX . "content_filter";
	$ds->open( $sql );
	if ( ! $ds->eof ) {
		$words = explode( ",", $ds->row["words"] );
		$words_sql = "";
		for ( $i = 0; $i < count( $words ); $i++ ) {
			if ( $words_sql != "" )
			{
				$words_sql .= " or ";
			}
			if ( trim( $words[$i] ) != "" )
			{
				$words_sql .= " title like '%" . trim( $words[$i] ) .
					"%' or description like '%" . trim( $words[$i] ) . "%' or keywords  like '%" .
					trim( $words[$i] ) . "%' ";
			}
		}
		if ( $words_sql != "" ) {
			$com2 .= " and (" . $words_sql . ") ";
		}
	}
}

//Item's quantity
$kolvo = $items;

//Pages quantity
$kolvo2 = PVS_PAGE_NUMBER;

//Page number
if ( ! isset( $_GET["str"] ) ) {
	$str = 1;
} else
{
	$str = ( int )$_GET["str"];
}

$n = 0;


$media_type = "";

if ( $type == "photo" ) {
	$media_type = " and media_id = 1 ";
}
if ( $type == "video" ) {
	$media_type = " and media_id = 2 ";
}
if ( $type == "audio" ) {
	$media_type = " and media_id = 3 ";
}
if ( $type == "vector" ) {
	$media_type = " and media_id = 4 ";
}

$sql = "select id, media_id, title ,data ,published,description,viewed,keywords,rating,downloaded,free,featured,author,server1,url,content_type,exclusive from " .
	PVS_DB_PREFIX . "media where id>0 " . $com2 . $sql_editorial.$media_type;

$sql .= $com;
if ( ! $pvs_global_settings["no_calculation"] ) {
	if ( ! $pvs_global_settings["elasticsearch"] ) {
		$rs->open( $sql );
		$record_count = $rs->rc;
	}
} else
{
	$record_count = $pvs_global_settings["no_calculation_total"];
}

$flag_show_end = true;
if ( $pvs_global_settings["no_calculation"] ) {
	$flag_show_end = false;
}

//limit
$lm = " limit " . ( $kolvo * ( $str - 1 ) ) . "," . $kolvo;

$sql .= $lm;

$sql_db = $sql;

?>
<div id="catalog_menu">


<form method="post" action="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>" style="margin:0px">
<div class="toleft">
<span><?php echo pvs_word_lang( "search" )?>:</span>
<input type="text" name="search" style="width:200px;display:inline" class="form-control" value="<?php echo $search
?>" onClick="this.value=''">
<select name="search_type" style="width:120px;display:inline" class="form-control">
<option value="id" <?php
if ( $search_type == "id" ) {
	echo ( "selected" );
}
?>>ID</option>
<option value="title" <?php
if ( $search_type == "title" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "title" )?></option>
<option value="author" <?php
if ( $search_type == "author" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "author" )?></option>

<?php
if ( ! $pvs_global_settings["elasticsearch"] ) {
?>

	<option value="lightbox" <?php
	if ( $search_type == "lightbox" ) {
		echo ( "selected" );
	}
	?>><?php echo pvs_word_lang( "lightboxes" )?></option>
	<option value="collection" <?php
	if ( $search_type == "collection" ) {
		echo ( "selected" );
	}
	?>><?php echo pvs_word_lang( "Collections" )?></option>

<?php
}
?>


</select>
</div>




<div class="toleft">
<span><?php echo pvs_word_lang( "category" )?>:</span>
<select name="category_id" style="width:240px" class="ft">
<option value="0"><?php echo pvs_word_lang( "all" )?></option>
<?php
$itg = "";
$nlimit = 0;
pvs_build_menu_admin( 0, $category_id, 2, 0 );
echo ( $itg );
?>

</select>
</div>

<div class="toleft">
<span><?php echo pvs_word_lang( "content" )?>:</span>
<select name="type" style="width:100px" class="ft">
<option value="all"><?php echo pvs_word_lang( "all" )?></option>
<?php
for ( $i = 0; $i < count( $mass_types ); $i++ ) {
	$sel = "";
	if ( $type == $mass_types[$i] ) {
		$sel = "selected";
	}
?>
<option value="<?php echo $mass_types[$i] ?>" <?php echo $sel
?>><?php echo pvs_word_lang( $mass_types[$i] )?></option>
<?php
}
?>

</select>
</div>




<div class="toleft">
<span><?php echo pvs_word_lang( "type" )?>:</span>
<select name="pub_type" style="width:170px" class="ft">
<option value="all"><?php echo pvs_word_lang( "all" )?></option>
<option value="free" <?php
if ( $pub_type == "free" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "free" )?></option>
<option value="featured" <?php
if ( $pub_type == "featured" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "featured" )?></option>
<option value="editorial" <?php
if ( $pub_type == "editorial" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "editorial" )?></option>
<?php
if ( $pvs_global_settings["adult_content"] ) {
?>
	<option value="adult" <?php
	if ( $pub_type == "adult" ) {
		echo ( "selected" );
	}
?>><?php echo pvs_word_lang( "adult content" )?></option>
	<?php
}

if ( $pvs_global_settings["exclusive_price"] ) {
?>
	<option value="exclusive" <?php
	if ( $pub_type == "exclusive" ) {
		echo ( "selected" );
	}
?>><?php echo pvs_word_lang( "exclusive price" )?></option>
	<option value="exclusive_sold" <?php
	if ( $pub_type == "exclusive_sold" ) {
		echo ( "selected" );
	}
?>><?php echo pvs_word_lang( "exclusive price" )?> - <?php echo pvs_word_lang( "sold" )?></option>
	<?php
}

if ( $pvs_global_settings["contacts_price"] ) {
?>
	<option value="contacts" <?php
	if ( $pub_type == "contacts" ) {
		echo ( "selected" );
	}
?>><?php echo pvs_word_lang( "contact us to get the price" )?></option>
	<?php
}
?>
<option value="approved" <?php
if ( $pub_type == "approved" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "approved" )?></option>
<option value="pending" <?php
if ( $pub_type == "pending" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "pending" )?></option>
<option value="declined" <?php
if ( $pub_type == "declined" ) {
	echo ( "selected" );
}
?>><?php echo pvs_word_lang( "declined" )?></option>
</select>
</div>


<div class="toleft">
<span><?php echo pvs_word_lang( "content type" )?>:</span>
<select name="pub_ctype" style="width:120px" class="ft">
<option value="all"><?php echo pvs_word_lang( "all" )?></option>
<?php
$sql = "select name from " . PVS_DB_PREFIX . "content_type order by priority";
$ds->open( $sql );
while ( ! $ds->eof ) {
	$sel = "";
	if ( $pub_ctype == $ds->row["name"] ) {
		$sel = "selected";
	}
?>
	<option value="<?php echo $ds->row["name"] ?>" <?php echo $sel
?>><?php echo $ds->row["name"] ?></option>
	<?php
	$ds->movenext();
}
?>
</select>
</div>


<?php
if ( ! $pvs_global_settings["elasticsearch"] ) {
?>
	<div class="toleft">
	<span><a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
	?>&action=filter"><?php echo pvs_word_lang( "filter" )?></a>:</span>
	<select name="filter" style="width:70px" class="ft">
	<option value="no" <?php
	if ( $filter == "no" ) {
		echo ( "selected" );
	}
	?>><?php echo pvs_word_lang( "no" )?></option>
	<option value="yes" <?php
	if ( $filter == "yes" ) {
		echo ( "selected" );
	}
	?>><?php echo pvs_word_lang( "yes" )?></option>
	</select>
	</div>
<?php
}
?>

<div class="toleft">
<span><?php echo pvs_word_lang( "item" )?>:</span>
<select name="items" style="width:70px" class="ft">
<?php
for ( $i = 0; $i < count( $items_mass ); $i++ ) {
	$sel = "";
	if ( $items_mass[$i] == $items ) {
		$sel = "selected";
	}
?>
<option value="<?php echo $items_mass[$i] ?>" <?php echo $sel
?>><?php echo $items_mass[$i] ?></option>
<?php
}
?>

</select>
</div>

<div class="toleft">
<span>&nbsp;</span>
<input type="submit" class="btn btn-danger" value="<?php echo pvs_word_lang( "search" )?>">
</div>

<div class="toleft_clear"></div>
</form>
</div>



<?php
if ( ! $pvs_global_settings["elasticsearch"] ) {
	include ( "content_db.php" );
} else {
	include ( "content_elastic.php" );
}


}
include ( plugin_dir_path( __FILE__ ) . "../includes/footer.php" );
?>