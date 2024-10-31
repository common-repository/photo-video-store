<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}


//Check access
pvs_admin_panel_access( "catalog_catalog" );


?>

<div class="row">
	<div class="col-md-2">
		<div class="input-group" style="margin-top:18px">
		  <div class="input-group-btn">
			<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&view=table&str=<?php echo ( $str . "&" . $var_search . $var_sort );
?>" class="btn btn-<?php
if ( $view == 'table' ) {
	echo ( 'primary' );
} else
{
	echo ( 'default' );
}
?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
			<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&view=grid&str=<?php echo ( $str . "&" . $var_search . $var_sort );
?>" class="btn btn-<?php
if ( $view == 'grid' ) {
	echo ( 'primary' );
} else
{
	echo ( 'default' );
}
?>"><i class="fa fa-th" aria-hidden="true"></i></a>
		  </div>
		</div>
	</div>
	<div class="col-md-10">
		<div style="float:right;">
			<?php echo ( pvs_paging( $record_count, $str, $kolvo, $kolvo2, pvs_plugins_admin_url( 'catalog/index.php' ), "&" . $var_search .
	$var_sort, false, $flag_show_end ) );
?>
		</div>
	</div>
</div>

<script>
function publications_select_all() {
    if(jQuery("#form_selector").prop("checked"))
   	{
        jQuery("input:checkbox").attr("checked",true);
    }
    else
    {
        jQuery("input:checkbox").attr("checked",false);
    }
}
</script>


<?php
$rs->open( $sql_db );
if ( ! $rs->eof ) {
?>

<form method="post" action="<?php echo ( pvs_plugins_admin_url( 'catalog/index.php' ) ); ?>" style="margin:0px"  id="adminform" name="adminform">
<input type="hidden" name="action" value="edit">
<?php wp_nonce_field( 'pvs-catalog-edit' ); ?>
<?php
	if ( $view == 'table' ) {
?>
	<br><table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
	<th width="5%"><input type="checkbox"  id="form_selector" value="1" onClick="publications_select_all();"></th>
	<th width="5%" class="hidden-phone hidden-tablet">
	<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&<?php echo $var_search
?>&aid=<?php
		if ( $aid == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
?>&view=table">ID</a> <?php
		if ( $aid == 1 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
?><?php
		if ( $aid == 2 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
?>
	</th>
	<th width="15%"><?php echo pvs_word_lang( "image" )?></th>
	<th width="10%" class="hidden-phone hidden-tablet">
	
	
	<?php echo pvs_word_lang( "title" )?>
	
	</th>
	
	<th class="hidden-phone hidden-tablet">
	<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&<?php echo $var_search
?>&adate=<?php
		if ( $adate == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
?>&view=table"><?php echo pvs_word_lang( "date" )?></a> <?php
		if ( $adate == 1 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
?><?php
		if ( $adate == 2 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
?>
	
	</th>
	<th class="hidden-phone hidden-tablet">
	
	<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&<?php echo $var_search
?>&aviewed=<?php
		if ( $aviewed == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
?>&view=table"><?php echo pvs_word_lang( "viewed" )?></a> <?php
		if ( $aviewed == 1 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
?><?php
		if ( $aviewed == 2 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
?>
	
	</th>
	<th class="hidden-phone hidden-tablet">
	
	<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&<?php echo $var_search
?>&adownloads=<?php
		if ( $adownloads == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
?>&view=table"><?php echo pvs_word_lang( "downloads" )?></a> <?php
		if ( $adownloads == 1 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
?><?php
		if ( $adownloads == 2 ) {
?><img src="<?php
			echo pvs_plugins_url()?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
?>
	
	</th>
	<th class="hidden-phone hidden-tablet"><?php echo pvs_word_lang( "type" )?></th>
	<th class="hidden-phone hidden-tablet"><?php echo pvs_word_lang( "author" )?></th>
	<th></th>
	<th></th>
	<th></th>
	</tr>
	</thead>
	<?php
		while ( ! $rs->eof ) {
?>
		<tr valign="top">
		<td><input type="checkbox" name="sel<?php
			echo $rs->row["id"] ?>" id="sel<?php
			echo $rs->row["id"] ?>"></td>
		<td class="hidden-phone hidden-tablet"><?php
			echo $rs->row["id"] ?></td>
		<td class='preview_img'><?php
			//Define preview
			$generated = "";

			if ( pvs_media_type ($rs->row["media_id"]) == 'photo' )
			{
				$item_img = pvs_show_preview( $rs->row["id"], "photo", 1, 1, $rs->row["server1"],
					$rs->row["id"] );
				$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "photo", $rs->row["server1"],
					"", "" );
			}
			if ( pvs_media_type ($rs->row["media_id"]) == 'video' )
			{
				if ( $pvs_global_settings["ffmpeg_cron"] )
				{
					$sql = "select data1 from " . PVS_DB_PREFIX . "ffmpeg_cron where id=" . $rs->
						row["id"] . " and data2=0";
					$ds->open( $sql );
					if ( ! $ds->eof )
					{
						$generated = pvs_word_lang( "Previews are being created. Queue number is" );

						$queue = 1;
						$sql = "select count(id) as queue_count from " . PVS_DB_PREFIX .
							"ffmpeg_cron where data1<" . $ds->row["data1"] . " and data2=0";
						$dr->open( $sql );
						if ( ! $dr->eof )
						{
							$queue = $dr->row["queue_count"];
						}

						$generated .= " <b>" . $queue . "</b>";
					}
				}

				$item_img = pvs_show_preview( $rs->row["id"], "video", 1, 1, $rs->row["server1"],
					$rs->row["id"] );
				$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "video", $rs->row["server1"],
					"", "" );
			}
			if ( pvs_media_type ($rs->row["media_id"]) == 'audio' )
			{
				$item_img = pvs_show_preview( $rs->row["id"], "audio", 1, 1, $rs->row["server1"],
					$rs->row["id"] );
				$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "audio", $rs->row["server1"],
					"", "" );
			}
			if ( pvs_media_type ($rs->row["media_id"]) == 'vector' )
			{
				$item_img = pvs_show_preview( $rs->row["id"], "vector", 1, 1, $rs->row["server1"],
					$rs->row["id"] );
				$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "vector", $rs->row["server1"],
					"", "" );
			}
?>
		<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
			echo $rs->row["id"] ?>"><img src="<?php
			echo $item_img
?>" border="0" <?php
			echo $hoverbox_results["hover"] ?>></a>
		</td>
		<td class="hidden-phone hidden-tablet"><div class="link_file"><a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
			echo $rs->row["id"] ?>"><?php
			echo $rs->row["title"] ?></a></div><small><?php
			echo $generated
?></small></td>
		<td class="hidden-phone hidden-tablet gray"><?php
			echo date( date_format, $rs->row["data"] )?></div></td>
		<td class="hidden-phone hidden-tablet"><?php
			echo $rs->row["viewed"] ?></td>
		<td class="hidden-phone hidden-tablet"><a href="<?php echo(pvs_plugins_admin_url('downloads/index.php'));?>&search=<?php
			echo $rs->row["id"] ?>&search_type=file"><?php
			echo $rs->row["downloaded"] ?></a></td>
		<td class="hidden-phone hidden-tablet">
		<?php
			echo ( pvs_word_lang( pvs_media_type ($rs->row["media_id"]) ) );
		?>
		</td>
		
		<td class="hidden-phone hidden-tablet"><div class="link_user"><a href="<?php
	echo ( pvs_plugins_admin_url( 'customers/index.php' ) );
?>&action=content&id=<?php
			echo pvs_user_login_to_id( $rs->row["author"] )?>"><?php
			echo $rs->row["author"] ?></a></div></td>
		<td>
			<?php
			if ( $rs->row["published"] == 1 )
			{
?>
				<div class="link_preview"><a href="<?php
				echo pvs_item_url( $rs->row["id"], $rs->row["url"] )?>"><?php
				echo pvs_word_lang( "preview" )?></a></div>
			<?php
			}
			if ( $rs->row["published"] == 0 )
			{
?>
				<span class="label label-important"><?php
				echo pvs_word_lang( "pending" )?></span>
			<?php
			}
			if ( $rs->row["published"] == -1 and $rs->row["exclusive"] == 0 )
			{
?>
				<span class="label label-inverse"><?php
				echo pvs_word_lang( "declined" )?></span>
			<?php
			}
			if ( $rs->row["published"] == -1 and $rs->row["exclusive"] == 1 )
			{
?>
				<span class="label label-success"><?php
				echo pvs_word_lang( "sold" )?></span>
			<?php
			}
?>
		</td>
		<td><div class="link_edit"><a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
			echo $rs->row["id"] ?>"><?php
			echo pvs_word_lang( "edit" )?></a></div></td>
		<td><div class="link_delete"><a href="<?php echo(pvs_plugins_admin_url('catalog/index.php'));?>&action=delete&id=<?php
			echo $rs->row["id"] ?>&<?php
			echo $var_search . $var_sort
?>&_wpnonce=<?php echo wp_create_nonce('pvs-delete' . $rs->row["id"]); ?>"  onClick="return confirm('<?php
			echo pvs_word_lang( "delete" )?>?');"><?php
			echo pvs_word_lang( "delete" )?></a></div></td>
		</tr>
		<?php
			$n++;
			$rs->movenext();
		}
?>
	</table>
	<?php
	} else {
		if ( ! $rs->eof ) {
?>
		<div style="margin:10px 0px 10px 0px"><input type="checkbox"  id="form_selector" value="1" onClick="publications_select_all();"> <?php echo(pvs_word_lang("Select all"));
?></div><div class="row">
		<?php
			while ( ! $rs->eof )
			{
?>
			<div class="col-md-3" style="height:300px">
				<?php
				//Define preview
				$icon = "";

				if ( pvs_media_type ($rs->row["media_id"]) == 'photo' )
				{
					$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "photo", $rs->row["server1"],
						"", "" );
					$icon = '<i class="icon-camera icon-white fa fa-photo"></i>';
				}
				if ( pvs_media_type ($rs->row["media_id"]) == 'video' )
				{
					$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "video", $rs->row["server1"],
						"", "" );
					$icon = '<i class="icon-film icon-white fa fa-film"></i>';
				}
				if ( pvs_media_type ($rs->row["media_id"]) == 'audio' )
				{
					$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "audio", $rs->row["server1"],
						"", "" );
					$icon = '<i class="icon-music icon-white fa fa-music"></i>';
				}
				if ( pvs_media_type ($rs->row["media_id"]) == 'vector' )
				{
					$hoverbox_results = pvs_get_hoverbox( $rs->row["id"], "vector", $rs->row["server1"],
						"", "" );
					$icon = '<i class="icon-picture icon-white fa fa-leaf"></i>';
				}

?>
				
				<div style="background:url('<?php
				echo $hoverbox_results["flow_image"] ?>');background-size:cover;background-repeat:no-repeat;background-position:center center;height:200px;cursor:pointer" onClick="location.href='<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
				echo $rs->row["id"] ?>'" <?php
				echo $hoverbox_results["hover"] ?>>
				</div>
				<div class="catalog_id"><input type="checkbox" name="sel<?php
			echo $rs->row["id"] ?>" id="sel<?php
			echo $rs->row["id"] ?>"> <?php
				echo $icon . ' ' . $rs->row["id"] ?></div>
				<div class="catalog_title"><a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
				echo $rs->row["id"] ?>"><?php
				echo substr($rs->row["title"], 0, 45) ?></a></div>
				<div class="catalog_grid">
					<?php
				if ( $rs->row["published"] == 1 )
				{
?>
						<a href="<?php
					echo pvs_item_url( $rs->row["id"], $rs->row["url"] )?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
					<?php
				}
				if ( $rs->row["published"] == 0 )
				{
?>
						<span class="label label-danger"><?php
					echo pvs_word_lang( "pending" )?></span>
					<?php
				}
				if ( $rs->row["published"] == -1 and $rs->row["exclusive"] == 0 )
				{
?>
						<span class="label label-warning"><?php
					echo pvs_word_lang( "declined" )?></span>
					<?php
				}
				if ( $rs->row["published"] == -1 and $rs->row["exclusive"] == 1 )
				{
?>
						<span class="label label-success"><?php
					echo pvs_word_lang( "sold" )?></span>
					<?php
				}
?>
					<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=content&id=<?php
				echo $rs->row["id"] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
					<a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&action=delete&id=<?php
				echo $rs->row["id"] ?>&<?php
				echo $var_search . $var_sort
?>&_wpnonce=<?php echo wp_create_nonce('pvs-delete' . $rs->row["id"]); ?>"  onClick="return confirm('<?php
				echo pvs_word_lang( "delete" )?>?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
				</div>
			</div>
			<?php
				$n++;

				if ( $n % 4 == 0 )
				{
					echo ( "</div>	<div class='row'>" );
				}

				$rs->movenext();
			}
?>
		</div>
		<?php
		}
	}
?>


<div style="padding-top:30px;float:right"><?php echo ( pvs_paging( $record_count, $str, $kolvo, $kolvo2,pvs_plugins_admin_url( 'catalog/index.php' ), "&" . $var_search .
		$var_sort, false, $flag_show_end ) );
?></div>






<div id="button_bottom_static">
		<div id="button_bottom_layout"></div>
		<div id="button_bottom">


<div id="actions">
	<input type="hidden" name="formaction" id="formaction" value="delete_publication">
	<input type="submit" class="btn btn-danger" onClick="return confirm('<?php echo pvs_word_lang( "delete" )?>?');" value="<?php echo pvs_word_lang( "delete" )?>" >&nbsp;&nbsp;<?php echo pvs_word_lang( "or" )?>&nbsp;&nbsp;<div class="btn-group dropup">
    <a class="btn btn-primary" href="#"><?php echo pvs_word_lang( "select action" )?></a>
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
    <ul class="dropdown-menu">
    		<li><a href="javascript:bulk_action('change_publication');"><i class="icon-edit"></i> <?php echo pvs_word_lang( "edit" )?></a></li>
    		
    		<li><a href="javascript:bulk_action('bulk_change_publication');"><i class="icon-tasks"></i> <?php echo pvs_word_lang( "Bulk change titles, keywords, description" )?></a></li>
    		
    		<li><a href="javascript:bulk_action('bulk_keywords_publication');"><i class="icon-tags"></i> <?php echo pvs_word_lang( "Bulk add/remove keywords" )?></a></li>
			
			<?php
	if ( $pvs_global_settings["allow_photo"] ) {
?>
				<li><a href="javascript:bulk_action('thumbs_publication');"><i class="icon-refresh"></i> <?php echo pvs_word_lang( "regenerate thumbs" )?></a></li>
			<?php
	}
?>
			
			<li><a href="javascript:bulk_action('content_publication');"><i class="icon-th"></i> <?php echo pvs_word_lang( "change content type" )?></a></li>
			
			<li><a href="javascript:bulk_action('move_publication');"><i class="icon-share-alt"></i> <?php echo pvs_word_lang( "move to category" )?></a></li>
			<li><a href="javascript:bulk_action('move_collection');"><i class="icon-share-alt"></i> <?php echo pvs_word_lang( "Assign to collection" )?></a></li>
			
			<li><a href="javascript:bulk_action('regenerate_urls');"><i class="icon-repeat"></i> <?php echo pvs_word_lang( "regenerate urls" )?></a></li>
			
			
			<li><a href="javascript:bulk_action('free_publication');"><i class="icon-download-alt"></i> <?php echo pvs_word_lang( "change files to free/paid" )?></a></li>
			
			<li><a href="javascript:bulk_action('featured_publication');"><i class="icon-thumbs-up"></i> <?php echo pvs_word_lang( "change files to featured" )?></a></li>
			
			<?php
	if ( $pvs_global_settings["allow_photo"] ) {
?>
				<li><a href="javascript:bulk_action('editorial_publication');"><i class="icon-picture"></i> <?php echo pvs_word_lang( "change photos to editorial" )?></a></li>
			<?php
	}
?>
			
			<?php
	if ( $pvs_global_settings["adult_content"] ) {
?>
				<li><a href="javascript:bulk_action('adult_publication');"><i class="icon-user"></i> <?php echo pvs_word_lang( "change files to adult" )?></a></li>
			<?php
	}
?>
			
			<?php
	if ( $pvs_global_settings["exclusive_price"] ) {
?>
				<li><a href="javascript:bulk_action('exclusive_publication');"><i class="icon-gift"></i> <?php echo pvs_word_lang( "change files to exclusive" )?></a></li>
			<?php
	}
?>
			
			<?php
	if ( $pvs_global_settings["contacts_price"] ) {
?>
				<li><a href="javascript:bulk_action('contacts_publication');"><i class="icon-envelope"></i> <?php echo pvs_word_lang( "change files to 'contact us to get the price'" )?></a></li>
			<?php
	}
?>
			
			<li><a href="javascript:bulk_action('approve_publication');"><i class="icon-ok"></i> <?php echo pvs_word_lang( "approve" )?>/<?php echo pvs_word_lang( "decline" )?></a></li>
			
			<?php
	if ( $pvs_global_settings["rights_managed"] ) {
?>
				<li><a href="javascript:bulk_action('rights_managed');"><i class="icon-list-alt"></i> <?php echo pvs_word_lang( "change rights-managed price" )?></a></li>
			<?php
	}
?>
    </ul>
    </div>
	
	
</div>


		</div>
	</div>

</form>

<?php
} else
{
	echo ( "<p><b>" . pvs_word_lang( "not found" ) . "</b></p>" );
}
?>