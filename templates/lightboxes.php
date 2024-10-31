<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}
?>
<br>
<div class="row">
	<div class="col-md-8">
		<h1>
		<?php echo(pvs_word_lang( "lightboxes" )); ?>
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
include( "lightboxes_content.php" );
?>