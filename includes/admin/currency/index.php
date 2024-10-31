<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_currency" );
include ( plugin_dir_path( __FILE__ ) . "../includes/header.php" );

//Add
if ( @$_REQUEST["action"] == 'add' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-currency-add' ) )
{
	$sql = "insert into " . PVS_DB_PREFIX .
		"currency (name,code1,code2,activ) values ('" . pvs_result( $_POST["name"] ) .
		"','" . pvs_result( $_POST["code"] ) . "','',0)";
	$db->execute( $sql );
}

//Change
if ( @$_REQUEST["action"] == 'change' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-currency-change' ) )
{
	$sql = "update " . PVS_DB_PREFIX . "currency set activ=0";
	$db->execute( $sql );

	$sql = "update " . PVS_DB_PREFIX . "currency set activ=1 where code1='" .
		pvs_result( $_POST["currency"] ) . "'";
	$db->execute( $sql );
}

//Delete
if ( @$_REQUEST["action"] == 'delete' and wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-currency-delete' . $_GET["id"] ) )
{
	$sql = "delete from " . PVS_DB_PREFIX . "currency where id=" . ( int )$_GET["id"];
	$db->execute( $sql );
}
?>



<button class="btn btn-success toright" data-toggle="modal" data-target="#modal_window"><i class="icon-th-large icon-white fa fa-plus"></i>&nbsp; <?php echo pvs_word_lang( "add" )?></button>


<div class="modal fade" id="modal_window" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <form method="post">
			<input type="hidden" name="action" value="add">
			<?php wp_nonce_field( 'pvs-currency-add' ); ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<?php echo pvs_word_lang( "currency" )?>
      </div>
      <div class="modal-body">
			<div class="form_field">
				<span><b><?php echo pvs_word_lang( "name" )?></b></span>
				<input type="text" name="name" value="" style="width:143px">
			</div>

			<div class="form_field">
				<span><b><?php echo pvs_word_lang( "code" )?></b></span>
				<input type="text" name="code" value="" style="width:60px">
			</div>
      </div>
      <div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="<?php echo pvs_word_lang( "add" )?>">
      </div>
    </div>
  </div>
  </form>
</div>




<h1><?php
echo pvs_word_lang( "currency" )
?></h1>
<br>
<form method="post">
<input type="hidden" name="action" value="change">
<?php wp_nonce_field( 'pvs-currency-change' ); ?>
<table class="wp-list-table widefat fixed striped posts">
<thead>
<tr>
<th><b><?php
echo pvs_word_lang( "name" )
?></b></th>
<th style="width:70%"><b><?php
echo pvs_word_lang( "code" )
?></b></th>
<th></th>
</tr>
</thead>

<?php
$sql = "select * from " . PVS_DB_PREFIX . "currency order by activ desc,name";
$rs->open( $sql );
while ( ! $rs->eof )
{
?>
<tr>

<td><input type="radio" name="currency" value="<?php
	echo $rs->row["code1"]
?>" <?php
	if ( $rs->row["activ"] == 1 )
	{
		echo ( "checked" );
	}
?>> <span class="big"><?php
	echo $rs->row["name"]
?></span></td>
<td><span class="gray"><?php
	echo $rs->row["code1"]
?></span></td>
<td>
<?php
	if ( $rs->row["activ"] != 1 )
	{
?>
<div class="link_delete"><a href="<?php
		echo ( pvs_plugins_admin_url( 'currency/index.php' ) );
?>&action=delete&id=<?php
		echo $rs->row["id"]
?>&_wpnonce=<?php echo wp_create_nonce('pvs-currency-delete' . $rs->row["id"]); ?>" onClick="return confirm('<?php
		echo pvs_word_lang( "delete" )
?>?');"><?php
		echo pvs_word_lang( "delete" )
?></a></div>
<?php
	}
?>
</td>
</tr>
<?php
	$rs->movenext();
}
?>


</table>

<br><p><input type="submit" class="button button-primary button-large" value="<?php echo pvs_word_lang( "save" ) ?>"></p>
</form>









<?php
include ( plugin_dir_path( __FILE__ ) . "../includes/footer.php" );
?>