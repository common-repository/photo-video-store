<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "catalog_bulkupload" );

	 function parcer_csv($file_name, $separator=',', $quote='"') {
    // Загружаем файл в память целиком
    $f=fopen($file_name,'r');
    $str=fread($f,filesize($file_name));
    fclose($f);
 
    // Убираем символ возврата каретки
    $str=trim(str_replace("\r",'',$str))."\n";
 
    $parsed=Array();    // Массив всех строк
    $i=0;               // Текущая позиция в файле
    $quote_flag=false;  // Флаг кавычки
    $line=Array();      // Массив данных одной строки
    $varr='';           // Текущее значение
 
    while($i<strlen($str)) {
        // Окончание значения поля
        if (@$str[$i]==$separator and !$quote_flag) {
            $varr=str_replace("\n","\r\n",$varr);
            $line[]=$varr;
            $varr='';
        }
        // Окончание строки
        elseif (@$str[$i]=="\n" and !$quote_flag) {
            $varr=str_replace("\n","\r\n",$varr);
            $line[]=$varr;
            $varr='';
            $parsed[]=$line;
            $line=Array();
        }
        // Начало строки с кавычкой
        elseif (@$str[$i]==$quote and !$quote_flag) {
            $quote_flag=true;
        }
        // Кавычка в строке с кавычкой
        elseif (@$str[$i]==$quote and @$str[($i+1)]==$quote and $quote_flag) {
            $varr.=$str[$i];
            $i++;
        }
        // Конец строки с кавычкой
        elseif (@$str[$i]==$quote and @$str[($i+1)]!=$quote and $quote_flag) {
            $quote_flag=false;
        }
        else {
            $varr.=$str[$i];
        }
        $i++;
    }
    return $parsed;
} 
	
if (file_exists(pvs_upload_dir().$pvs_global_settings["photopreupload"]."photos.csv")) {

$mass=parcer_csv(pvs_upload_dir().$pvs_global_settings["photopreupload"]."photos.csv");

?>



<form method="post" action="<?php echo(pvs_plugins_admin_url('catalog/index.php'));
?>&action=csv_upload" name="uploadform">
<?php wp_nonce_field( 'pvs-csv-upload' ); ?>
<div class="form_field">
You should upload <b><?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["photopreupload"]);?>photos.csv file</b>.
</div>

<div class="form_field">
<b>Rows in csv file: [<?php echo(count($mass)-1);?>]</b><br>
<small>The first line is titles</small>
</div>

<div class="form_field">
<b>Columns:</b><br>
<small>
ID<br>
Title<br>
Description<br>
Keywords
</small>
</div>








<div class="form_field">
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "change" )?>" style="margin-top:20px">
</div>
</form>

<?php
} else {
?>
<div class="form_field">
You should upload <b><?php echo(pvs_upload_dir('baseurl') . $pvs_global_settings["photopreupload"]);?>photos.csv file.</b> It doesn't exist.
</div>
<?php
}
?>

