<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}
?>

<div id="lightboxes_boxes"  class="row">
<?php


if ( isset( $atts["view"] ) and ( $atts["view"] == 'grid' or $atts["view"] == 'fixed_width' ) ) {
	$pvs_global_settings["category_view"] = $atts["view"];
}

if ( isset( $atts["query"] ) ) {
	$_REQUEST["search"] = $atts["query"];
}

$limit = '';
if ( isset( $atts["limit"] ) and  (int)$atts["limit"] > 0 ) {
	$limit = ' limit 0,' . (int)$atts["limit"];
}

$user_lightbox ="";
if (is_user_logged_in()) {
	$user_lightbox = ' or id in (select id_parent from ' . PVS_DB_PREFIX .
	'lightboxes_admin where user=' . ( int )get_current_user_id() . ') ';
}

if ( @$_REQUEST["search"] == '' ) {
		$sql = "select id, title, description from " . PVS_DB_PREFIX . "lightboxes where (catalog = 1 " . $user_lightbox . ") order by title" . $limit;
} else
{
		$sql = "select id, title, description from " . PVS_DB_PREFIX . "lightboxes where title like '%" . pvs_result( $_REQUEST["search"] ) .
		"%' and (catalog = 1 " . $user_lightbox . ") order by title" . $limit;
}
$rs->open( $sql );
if ( ! $rs->eof ) {
	$n = 0;
	while ( ! $rs->eof ) {
		$lightbox_result = pvs_show_lightbox_preview($rs->row["id"]);

		$pvs_theme_content[ 'category_title' ] = $rs->row["title"] . ' (' . pvs_count_files_in_lightbox($rs->row["id"]) . ')';

		$pvs_theme_content[ 'category_url' ] = pvs_lightbox_url( $rs->row["id"], $rs->row["title"] );

		$pvs_theme_content[ 'category_photo' ] = $lightbox_result["photo"];

		$description = '';
		
		if ( $rs->row["description"] != '' ) {
			$description .= $rs->row["description"] . '<br>';
		}

		$pvs_theme_content[ 'category_description' ] = $description;
		$pvs_theme_content[ 'category_width' ] = $lightbox_result["width"];
		$pvs_theme_content[ 'category_height' ] = $lightbox_result["height"];
		
		if ( $pvs_theme_content[ 'category_height' ] == 0) {
			$pvs_theme_content[ 'category_height' ] = 120;
		}
		
		if ( $pvs_theme_content[ 'category_photo' ] == '') {
			$pvs_theme_content[ 'category_photo' ] = pvs_plugins_url() . '/assets/images/e.gif';
		}
		
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
jQuery('#lightboxes_boxes').masonry({
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
