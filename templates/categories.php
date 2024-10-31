<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$category_id = 0;
if ( isset( $_GET["id"] ) ) {
	$category_id = ( int )$_GET["id"];
}

?>
<br>
<div class="row">
	<div class="col-md-8">
		<h1><?php echo pvs_word_lang( "categories" )?> 	
		<?php
if ( $category_id != 0 ) {
	$sql = "select id,title from " . PVS_DB_PREFIX . "category where id=" . $category_id;
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$translate_results = pvs_translate_category( $rs->row["id"], $rs->row["title"],
			"", "" );
		echo ( " &mdash; " . $translate_results["title"] );
	}
}
?>
		</h1>
	</div>
	<div class="col-md-4">	
		<form  method="GET" style="margin-top:5px">
			<div class="input-group">
			  <input type="text" placeholder="<?php echo ( pvs_word_lang( "search" ) );?>..."  class="form-control" autocomplete="off" name="search" />	
			  <span class="input-group-btn">
	<button class="btn btn-primary" style="margin-top:0px;"><i class="fa fa-search"></i></button>
			  </span>
			</div>	
		</form>
	</div>
</div>

<?php
include( "categories_content.php" );
?>
