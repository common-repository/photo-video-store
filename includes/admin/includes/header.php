<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
/*
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo (pvs_plugins_url());?>/includes/admin/includes/css/style.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=<?php echo (@$pvs_global_settings["google_api"])?>"></script>
<script src="<?php echo (pvs_plugins_url());?>/assets/js/gmap_picker/jquery-gmaps-latlon-picker.js"></script>
<script src="<?php echo (pvs_plugins_url());?>/assets/js/mustache.min.js"></script>
<script src="<?php echo (pvs_plugins_url());?>/assets/js/scripts.js"></script>
<?php
*/
?>
<script>      
site_lang = '<?php
$sql = "select name from " . PVS_DB_PREFIX . "languages where activ=1";
$rs->open( $sql );
if ( ! $rs->eof ) {
	echo ( $lang_symbol[$rs->row["name"]] );
}
?>';
site_lang_name = {};
site_lang_name2 = {};
site_lang_symbol= {};
<?php
$sql = "select name,activ from " . PVS_DB_PREFIX .
	"languages where display=1 order by name";
$dd->open( $sql );
while ( ! $dd->eof )
{
?>
	site_lang_name["<?php
	echo ( $lang_symbol[$dd->row["name"]] );
?>"] = "<?php
	echo ( $dd->row["name"] );
?>";
	<?php
	$lng3 = strtolower( $dd->row["name"] );
	if ( $lng3 == "chinese traditional" or $lng3 == "chinese simplified" )
	{
		$lng3 = "chinese";
	}
	if ( $lng3 == "afrikaans formal" or $lng3 == "afrikaans informal" )
	{
		$lng3 = "afrikaans";
	}
?>
	site_lang_name2["<?php
	echo ( $lang_symbol[$dd->row["name"]] );
?>"] = "<?php
	echo ( $lng3 );
?>";
	site_lang_symbol["<?php
	echo ( $dd->row["name"] );
?>"] = "<?php
	echo ( $lang_symbol[$dd->row["name"]] );
?>";
	<?php
	$dd->movenext();
}
?>

function pvs_deselect_row(value,value_id) 
{
	jQuery("."+value+value_id).css("display","none");
	
	jQuery.ajax({
		type:'POST',
		url:ajaxurl,
		data:'action=pvs_deselect_row&property=' + value + '&id=' + value_id,
		success:function(data){
			
		}
	});
}


function pvs_redirect(value)
{
	location.href = value;
}
</script>
<div class="wrap">
