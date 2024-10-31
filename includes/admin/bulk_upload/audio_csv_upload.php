<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_admin_panel_access( "catalog_bulkupload" );

$swait = false;

$ids = array();

$sql = "select id_parent from " . PVS_DB_PREFIX .
	"audio_types order by priority";
$ds->open( $sql );
while ( ! $ds->eof ) {
	$ids[] = $ds->row["id_parent"];
	$ds->movenext();
}



$afiles=pvs_parcer_csv(pvs_upload_dir().$pvs_global_settings["audiopreupload"]."/audio.csv");

for ( $j = 1; $j < count( $afiles ); $j++ ) {

	$csv_path = @$afiles[$j][0];
	
	if ( $csv_path{0} == '/') {
		$csv_path = substr($csv_path,1);
	}
	
	$parts = explode("/", $csv_path);
	
	$csv_filename = $parts[ count($parts)-1 ];
	
	$csv_photo_preview = @$afiles[$j][1];
	if ( $csv_photo_preview{0} == '/') {
		$csv_photo_preview = substr($csv_photo_preview,1);
	}
	
	$csv_audio_preview = @$afiles[$j][2];
	if ( $csv_audio_preview{0} == '/') {
		$csv_audio_preview = substr($csv_audio_preview,1);
	}
	
	$csv_title = @$afiles[$j][3];
	$csv_description = @$afiles[$j][4];
	$csv_keywords = @$afiles[$j][5];
	$csv_author = @$afiles[$j][6];
	$csv_categories = @$afiles[$j][7];
	
	
	if ( file_exists ( pvs_upload_dir().$pvs_global_settings["audiopreupload"]."/" . $csv_path ) ) {
		
		$audio = "";
	
		$title = $csv_title;
		if ( $title == "" ) {
			$title = "audio" . $j;
		}
		
		$pub_vars = array();
		$pub_vars["title"] = $title;
		$pub_vars["description"] = $csv_description;
		$pub_vars["keywords"] = $csv_keywords;
		//$pub_vars["userid"]=pvs_user_login_to_id($csv_author);
		$pub_vars["userid"] = 0;
		$pub_vars["published"] = 1;
		$pub_vars["viewed"] = 0;
		$pub_vars["data"] = pvs_get_time();
		$pub_vars["author"] = $csv_author;
		$pub_vars["content_type"] = $pvs_global_settings["content_type"];
		$pub_vars["downloaded"] = 0;
		$pub_vars["model"] = 0;
		$pub_vars["examination"] = 0;
		$pub_vars["server1"] = $site_server_activ;
		$pub_vars["free"] = 0;
	
		$pub_vars["duration"] = 0;
		$pub_vars["format"] = '';
		$pub_vars["ratio"] = '';
		$pub_vars["rendering"] = '';
		$pub_vars["frames"] = '';
		$pub_vars["holder"] = '';
		$pub_vars["usa"] = '';
	
		$pub_vars["google_x"] = 0;
		$pub_vars["google_y"] = 0;
		$pub_vars["adult"] = 0;
	
		//Add a new audio to the database
		$id = pvs_publication_media_add(3);
	
		$folder = $id;
	
		$previewaudio = $pvs_global_settings["audiopreupload"] . $csv_audio_preview;
		$previewphoto = $pvs_global_settings["audiopreupload"] . $csv_photo_preview;
	
		//copy file
		$sql = "select * from " . PVS_DB_PREFIX . "audio_types order by priority";
		$ds->open( $sql );
		while ( ! $ds->eof )
		{
			if ( $ds->row["shipped"] != 1 )
			{
				$uphoto = explode( ",", str_replace( " ", "", $ds->row["types"] ) );
					
				$file_name = pvs_get_file_info( $csv_filename, "filename" );
				$file_extention = pvs_get_file_info( $csv_filename, "extention" );
				
				$flag = false;
				
				for ( $k = 0; $k < count( $uphoto ); $k++ )
				{
					if ( strtolower( $uphoto[$k] ) == strtolower( $file_extention ) )
					{
						$flag = true;
					}
				}
				
				if ( $flag )
				{
					$audio = $pvs_global_settings["audiopreupload"] . $csv_path;
					copy( pvs_upload_dir() . $audio, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/" . $csv_filename );
	
					$file = $csv_filename;
	
					$sql = "insert into " . PVS_DB_PREFIX .
						"items (id_parent,name,url,price,priority,shipped,price_id) values (" . $id .
						",'" . $ds->row["title"] . "','" . pvs_result( $file ) . "'," . floatval( $ds->
						row["price"] ) . "," . $ds->row["priority"] . ",0," . $ds->row["id_parent"] .
						")";
					$db->execute( $sql );
					
					//Synchronize related prices
					if ( $ds->row["thesame"] > 0 )
					{
						$sql = "select * from " . PVS_DB_PREFIX . "audio_types where id_parent<>" . $ds->
							row["id_parent"] . " and thesame=" . $ds->row["thesame"] . " order by priority";
						$dr->open( $sql );
						while ( ! $dr->eof )
						{
							$sql = "select id,id_parent,url,name,price from " . PVS_DB_PREFIX .
								"items where id_parent=" . $id . " and price_id=" . $dr->row["id_parent"];
							$dd->open( $sql );
							if ( $dd->eof )
							{
								$sql = "insert into " . PVS_DB_PREFIX .
									"items (id_parent,name,url,price,priority,shipped,price_id) values (" . $id .
									",'" . $ds->row["title"] . "','" . pvs_result( $file ) .
									"'," .floatval( $dr->row["price"] ) . "," . $dr->
									row["priority"] . ",0," . $dr->row["id_parent"] . ")";
								$db->execute( $sql );
							}		
							$dr->movenext();
						}
					}
					//End. Synchronize related prices
				}
			}
	
			$ds->movenext();
		}

		//audio preview
		if ( file_exists ( pvs_upload_dir().$pvs_global_settings["audiopreupload"]."/" . $csv_audio_preview ) ) {
			$vp = $site_servers[$site_server_activ] . "/" . $folder . "/thumb.mp3";
			copy( pvs_upload_dir() . $previewaudio, pvs_upload_dir() . $vp );
		}

		//Photo preview
		if ( file_exists ( pvs_upload_dir().$pvs_global_settings["audiopreupload"]."/" . $csv_photo_preview ) ) {
			$vp = $site_servers[$site_server_activ] . "/" . $folder . "/thumb.jpg";
			$vp_big = $site_servers[$site_server_activ] . "/" . $folder . "/thumb100.jpg";

			pvs_photo_resize( pvs_upload_dir() . $previewphoto, pvs_upload_dir() . $vp, 1 );
			pvs_photo_resize( pvs_upload_dir() . $previewphoto, pvs_upload_dir() . $vp_big, 2 );
		}
		
		//Categories
		$categories = explode (",",$csv_categories);
		for ( $i = 0; $i < count( $categories ); $i++ ) {

			$category = trim($categories[$i]);
			$category_id = 0;
		
			$sql="select id from " . PVS_DB_PREFIX . "category where title='".$category."'";
			$ds->open($sql);
			if(!$ds->eof)
			{
				$category_id = $ds->row["id"];
			}
			else 
			{
				$_POST["upload"]=1;
				$_POST["published"]=1;
				$_POST["priority"]=0;
				$_POST["featured"]=0;
				$_POST["id_parent"]=0;
				$_POST["title"]=$category;
				$_POST["description"]="";
				$_POST["keywords"]="";
				$_FILES["photo"]["type"]="";
				$_FILES["photo"]["name"]="";
				$_FILES["photo"]['size']="";
				$_FILES["photo"]['tmp_name']="";
				$_POST["password"]="";
				pvs_add_update_category(0,0,0,0);
				
				$sql="select id from " . PVS_DB_PREFIX .
					"category where title='".$category."'";
				$dr->open($sql);
				if(!$dr->eof)
				{
					$category_id = $dr->row["id"];
				}			
			}
			
			if($category_id != 0)
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"category_items (category_id,publication_id) values (" . $category_id .
					"," . $id . ")";
				$db->execute( $sql );		
			}
		}		
		
		//Elasticsearch
		if ( $pvs_global_settings["elasticsearch"] and $pvs_global_settings["elasticsearch_automatic"]) {
			pvs_elastic_add( $id );
		}
	}
}

if ($j > 0) {
	$_REQUEST["items"] = $j;
}
?>