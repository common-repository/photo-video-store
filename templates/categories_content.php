<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}
?>

<br><br>
<div id="category_boxes">
<?php
//Shortcodes
if ( isset( $atts["orderby"] ) and ( $atts["orderby"] == 'title' or $atts["orderby"] == 'date' ) ) {
	$pvs_global_settings["category_sort"] = $atts["orderby"];
}

if ( isset( $atts["view"] ) and ( $atts["view"] == 'grid' or $atts["view"] == 'fixed_width' ) ) {
	$pvs_global_settings["category_view"] = $atts["view"];
}

if ( isset( $atts["query"] ) ) {
	$_REQUEST["search"] = $atts["query"];
}


$sort_by = "priority, title";

if ($pvs_global_settings["category_sort"] == 'title') {
	$sort_by = "title";
}

if ($pvs_global_settings["category_sort"] == 'date') {
	$sort_by = "creation_date desc";
}

if ($pvs_global_settings["category_sort"] == 'priority') {
	$sort_by = "priority, title";
}

$limit = '';
if ( isset( $atts["limit"] ) and  (int)$atts["limit"] > 0 ) {
	$limit = ' limit 0,' . (int)$atts["limit"];
}


if ( @$_REQUEST["search"] == '' ) {
	if ( ( isset( $atts["tree"] ) and  $atts["tree"] == 1) or ! isset ($atts["tree"]) ) {
		$sql = "select id,id_parent,title,priority,published,url,photo,description,location from " . PVS_DB_PREFIX .
			"category where id_parent=" . $category_id .
			" and published=1 and activation_date < " . pvs_get_time() .
			" and (expiration_date > " . pvs_get_time() .
			" or expiration_date = 0) order by " . $sort_by . $limit;
	} else {
		$sql = "select id,id_parent,title, priority, published, url, photo, description,location from " .
		PVS_DB_PREFIX . "category where published=1 and activation_date < " . pvs_get_time() .
		" and (expiration_date > " . pvs_get_time() .
		" or expiration_date = 0) order by " . $sort_by . $limit;	
	}
} else
{
	$sql = "select id,id_parent,title, priority, published, url, photo, description,location from " .
		PVS_DB_PREFIX . "category where (title like '%" . pvs_result( $_REQUEST["search"] ) .
		"%' or keywords like '%" . pvs_result( $_REQUEST["search"] ) .
		"%' or description like '%" . pvs_result( $_REQUEST["search"] ) .
		"%') and  published=1 and activation_date < " . pvs_get_time() .
		" and (expiration_date > " . pvs_get_time() .
		" or expiration_date = 0) order by " . $sort_by . $limit;
}
$rs->open( $sql );
if ( ! $rs->eof ) {
	$n = 0;
	while ( ! $rs->eof ) {

		$count_id = 0;

		$itg = "";
		$nlimit = 0;
		if ( ! $pvs_global_settings["elasticsearch"]) {
			$count_id = pvs_count_files_in_category( $rs->row["id"] );
		}
		$pvs_theme_content[ 'category_id' ] = $rs->row["id"];

		$translate_results = pvs_translate_category( $rs->row["id"], $rs->row["title"], $rs->row["description"], "" );
			
		$category_result = pvs_show_category_preview($rs->row["id"]);
		$pvs_theme_content[ 'category_photo' ] = $category_result["photo"];
		$pvs_theme_content[ 'category_width' ] = $category_result["width"];
		$pvs_theme_content[ 'category_height' ] = $category_result["height"];
		
		if ( $pvs_theme_content[ 'category_height' ] == 0) {
			$pvs_theme_content[ 'category_height' ] = 120;
		}
		
		if ( $pvs_theme_content[ 'category_photo' ] == '') {
			$pvs_theme_content[ 'category_photo' ] = pvs_plugins_url() . '/assets/images/e.gif';
		}
		
		$title = $translate_results["title"];
		if($pvs_global_settings["category_items"] and $count_id != 0 ) {
			$title .= ' (' . $count_id . ')';
		}

		$pvs_theme_content[ 'category_title' ] = $title;

		$sql = "select id from " . PVS_DB_PREFIX . "category where id_parent=" . $rs->row["id"];
		$ds->open( $sql );
		if ( ! $ds->eof ) {
			$pvs_theme_content[ 'category_url' ] = site_url() . "/categories/?id=" . $rs->row["id"];
		} else {
			$pvs_theme_content[ 'category_url' ] = site_url() . $rs->row["url"];
		}

		$description = $translate_results["description"];

		if ( $rs->row["location"] != '' ) {
			$description .= '<br>' . $rs->row["location"];
		}

		$pvs_theme_content[ 'category_description' ] = $description;
		
		if ($n%4 == 0 and $pvs_global_settings["category_view"] == 'grid') {
			echo("</div><div class='row'>");
		}
		
		if ( $pvs_global_settings["category_view"] == 'fixed_width') {
			if ( file_exists ( get_stylesheet_directory(). '/item_category.php' ) ) {
				include( get_stylesheet_directory(). '/item_category.php' );
			} else {
				if ( file_exists ( PVS_PATH . 'templates/item_category.php' ) ) {
					include( PVS_PATH . 'templates/item_category.php' );
				}
			}
		}
		if ( $pvs_global_settings["category_view"] == 'grid') {
			if ( file_exists ( get_stylesheet_directory(). '/item_category_grid.php' ) ) {
				include( get_stylesheet_directory(). '/item_category_grid.php' );
			} else {
				if ( file_exists ( PVS_PATH . 'templates/item_category_grid.php' ) ) {
					include( PVS_PATH . 'templates/item_category_grid.php' );
				}
			}
		}
		$n++;
		$rs->movenext();
	}
	
}
?>
	</div>
	<style>
	.category_box
	{
		width:<?php echo ( $pvs_global_settings["category_preview"] + 20 )?>px;
	}
	</style>
<script src="<?php echo(pvs_plugins_url() . '/assets/js/jquery.masonry.min.js'); ?>"></script>
<script>
<?php
if ($pvs_global_settings["category_view"] == 'fixed_width') {
?>
jQuery('#category_boxes').masonry({
  		itemSelector: '.category_box'
		});
<?php
}
?>		
			jQuery('.home_preview').each(function(){
     		jQuery(this).animate({opacity:'1.0'},1);
   			jQuery(this).mouseover(function(){
     		jQuery(this).stop().animate({opacity:'0.3'},600);
    		});
    		jQuery(this).mouseout(function(){
    		jQuery(this).stop().animate({opacity:'1.0'},300);
    		});
		});
</script>
