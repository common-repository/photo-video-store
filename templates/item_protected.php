<h2><?php echo(pvs_word_lang("password protected"));?></h2>

<form method="post" action="<?php echo( $_SERVER['REQUEST_URI'] );?>">
<input type="password" name="password" value="" style="width:140px;" class="form-control"><br><input class="btn btn-success isubmit" type="submit" value="<?php echo(pvs_word_lang("check"));?>">
<input type="hidden" name="id_parent" value="<?php echo(get_query_var('pvs_id'));?>">
<input type="hidden" name="type" value="<?php echo( $type );?>">
</form>