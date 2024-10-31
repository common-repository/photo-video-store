<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

header('Content-Type: application/json');

$id = ( int )$_REQUEST["id"];

if ( is_user_logged_in() ) {


	//Show images
	$size_result = pvs_define_thumb_size( $id );
	$lightbox_image = $size_result["thumb"];
	$lightbox_width = $size_result["width"];
	$lightbox_height = $size_result["height"];
	//End. Show images

	//Show select
	$lightbox_list = "";
	$sql = "select id_parent from " . PVS_DB_PREFIX . "lightboxes_admin where user=" . ( int )
		get_current_user_id();
	$rs->open( $sql );
	while ( ! $rs->eof ) {
		$sql = "select title from " . PVS_DB_PREFIX . "lightboxes where id=" . $rs->row["id_parent"] .
			" order by title";
		$ds->open( $sql );
		if ( ! $ds->eof ) {
			$sel = "";
			$sql = "select id_parent from " . PVS_DB_PREFIX . "lightboxes_files where item=" .
				$id . " and id_parent=" . $rs->row["id_parent"];
			$dr->open( $sql );
			if ( ! $dr->eof )
			{
				$sel = "checked";
			}

			$lightbox_list .= "<div style='margin-top:5px'><input type='checkbox' id='chk" .
				$rs->row["id_parent"] . "' name='chk" . $rs->row["id_parent"] . "' " . $sel .
				">&nbsp;" . $ds->row["title"] . "</div>";
		}
		$rs->movenext();
	}
	$lightbox_list .= "<div style='margin-top:5px'><input type='checkbox' id='new_lightbox' name='new_lightbox'>&nbsp;<input type='text' value='" .
		pvs_word_lang( "new" ) . "' id='new' name='new' style='width:100px' onClick=\"this.value=''\"></div>";

	$lightbox = '<form id="lightbox_form" style="margin:0px" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float:right">&times;</button>
		<h4 class="modal-title">
			' . pvs_word_lang("lightboxes") . '
		</h4>
  	</div>
		
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-3 col-md-3">
					<img src="' . $lightbox_image . '"  style="max-width:120px">
			</div>
			<div class="col-lg-9 col-md-9">
					<h5>' . pvs_word_lang("Select a lightbox") . ':</h5>
				' . $lightbox_list . '
			</div>
		</div>
  	</div>
  	<div class="modal-footer">
		<input type="hidden" name="publication" value="' . $id . '">
		<input type="button" value="' . pvs_word_lang("Save") . '" class="lightbox_button" onClick="pvs_lightbox_add(\'' . site_url() . '\')">
	</div>
	</form>';

	$ajax_result = array( "authorization" => 1, "lightbox_message" => $lightbox );
} else
{
	$ajax_result = array( "authorization" => 0, "lightbox_message" =>
			pvs_word_lang( "You should login to use the option" ) );
}

echo (json_encode($ajax_result));
?>