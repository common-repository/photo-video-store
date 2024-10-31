<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_content_types" );
include ( plugin_dir_path( __FILE__ ) . "../includes/header.php" );

//Change
if ( @$_REQUEST["action"] == 'change' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-content-change' )  )
{
	include ( "change.php" );
}

//Add
if ( @$_REQUEST["action"] == 'add' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-content-add' ) )
{
	include ( "add.php" );
}

//Delete
if ( @$_REQUEST["action"] == 'delete2' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-content-delete2' )  )
{
	include ( "delete2.php" );
}

//Delete
if ( @$_REQUEST["action"] == 'delete' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-content-delete' )  )
{
	include ( "delete.php" );
} else
{
?>
	
	
	
	

	
	
	
	<button class="btn btn-success toright" data-toggle="modal" data-target="#modal_window"><i class="icon-th-large icon-white fa fa-plus"></i>&nbsp; <?php echo pvs_word_lang( "add" )?></button>


<div class="modal fade" id="modal_window" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
	<form method="post">
	<input type="hidden" name="action" value="add">
	<?php wp_nonce_field( 'pvs-content-add' ); ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo pvs_word_lang( "content type" )?></h4>
      </div>
      <div class="modal-body">
        <div class="form_field">
		<span><b><?php echo pvs_word_lang( "title" )?>:</b></span><input name="title" type="text" style="width:250px">
		</div>
		
		<div class="form_field">
		<span><b><?php echo pvs_word_lang( "priority" )?>:</b></span><input name="priority" type="text" style="width:60px" value="1">
		</div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "add" )?>">
      </div>
    </div>
  </div>
  </form>
</div>
	
	
	
	
	<h1><?php
	echo pvs_word_lang( "content type" )
?>:</h1>
	
	
	<p>To set a <a href="<?php
	echo ( pvs_plugins_admin_url( 'subscription/index.php' ) );
?>"><b>Subscription plan</b></a> you should define Content Types first. This is a method to divide all files into several global categories. For example: Premium files, usual files and etc.</p>
	
	<p>The content type <b>by default</b> is <b><?php
	echo $pvs_global_settings["content_type"]
?></b>. You can change it in <a href="<?php
	echo ( pvs_plugins_admin_url( 'settings/index.php' ) );
?>">Site settings</a></p>
	
	<p>You are able to bulk change a content type for the publications here: <a href="<?php
	echo ( pvs_plugins_admin_url( 'categories/index.php' ) );
?>">Categories -> Select action</a> and <a href="<?php
	echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>">Catalog -> Select action</a></p>
	
	
	<br>
	
	<?php
	$sql = "select id_parent,priority,name from " . PVS_DB_PREFIX .
		"content_type order by priority";
	$rs->open( $sql );
	if ( ! $rs->eof )
	{
?>
		<form method="post">
		<input type="hidden" name="action" value="change">
		<?php wp_nonce_field( 'pvs-content-change' ); ?>
		<table class="wp-list-table widefat fixed striped posts">
		<thead>
		<tr>
		<th><b><?php
		echo pvs_word_lang( "priority" )
?>:</b></th>
		<th style="width:70%"><b><?php
		echo pvs_word_lang( "title" )
?>:</b></th>
		<th><b><?php
		echo pvs_word_lang( "files" )
?>:</b></th>
		<th><b><?php
		echo pvs_word_lang( "delete" )
?></b></th>
		</tr>
		</thead>
		<?php
		while ( ! $rs->eof )
		{
			//Count files.
			$count_types = 0;

			$sql = "select count(id) as count_types from " . PVS_DB_PREFIX .
				"media where content_type='" . $rs->row["name"] . "' group by content_type";
			$ds->open( $sql );
			if ( ! $ds->eof )
			{
				$count_types += $ds->row["count_types"];
			}
?>
			<tr valign="top">
			<td align="center"><input name="priority<?php
			echo $rs->row["id_parent"]
?>" type="text" style="width:40px" value="<?php
			echo $rs->row["priority"]
?>"></td>
			<td><input name="title<?php
			echo $rs->row["id_parent"]
?>" type="text" style="width:250px" value="<?php
			echo $rs->row["name"]
?>"></td>
			<td><div class="link_file"><a href="<?php
			echo ( pvs_plugins_admin_url( 'catalog/index.php' ) );
?>&pub_ctype=<?php
			echo $rs->row["name"]
?>"><?php
			echo $count_types
?></a></div></td>
			<td>
			<div class="link_delete"><a href='<?php
			echo ( pvs_plugins_admin_url( 'content_types/index.php' ) );
?>&action=delete&id=<?php
			echo $rs->row["id_parent"]
?>&_wpnonce=<?php echo wp_create_nonce('pvs-content-delete'); ?>'><?php
			echo pvs_word_lang( "delete" )
?></a></div>
			</td>
			</tr>
			<?php
			$rs->movenext();
		}
?>
		</table>
		<br>
		<p><input type="submit" class="btn btn-primary" value="<?php
		echo pvs_word_lang( "save" )
?>"></p>
		</form><br>
	<?php
	}
}
?>





<?php
include ( plugin_dir_path( __FILE__ ) . "../includes/footer.php" );
?>