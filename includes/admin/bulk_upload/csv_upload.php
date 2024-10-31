<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_admin_panel_access( "catalog_bulkupload" );

$swait = false;





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
	


$afiles=parcer_csv(pvs_upload_dir().$pvs_global_settings["photopreupload"]."/photos.csv");




for ( $j = 1; $j < count( $afiles ); $j++ ) {

	$id = (int)$afiles[$j][0];
	$title = addslashes($afiles[$j][1]);
	$description = addslashes($afiles[$j][2]);
	$keywords = addslashes($afiles[$j][3]);
	if ($id > 0) {
		$sql = "update " . PVS_DB_PREFIX . "media set title='" . $title . "',description='" . $description . "',keywords='" . $keywords . "' where id=" . $id;
		$db->execute($sql);
	}
}
?>