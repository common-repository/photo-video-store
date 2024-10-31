<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_admin_panel_access( "catalog_bulkupload" );

$swait = false;

$photo_formats = array();
$sql = "select id,photo_type from " . PVS_DB_PREFIX .
	"photos_formats where enabled=1 and photo_type<>'jpg' order by id";
$dr->open( $sql );
while ( ! $dr->eof ) {
	$photo_formats[$dr->row["id"]] = $dr->row["photo_type"];
	$dr->movenext();
}

$afiles=pvs_parcer_csv(pvs_upload_dir().$pvs_global_settings["photopreupload"]."/photos.csv");

for ( $j = 1; $j < count( $afiles ); $j++ ) {

	$csv_path = @$afiles[$j][0];
	
	if ( $csv_path{0} == '/') {
		$csv_path = substr($csv_path,1);
	}
	
	$parts = explode("/", $csv_path);
	
	$csv_filename = $parts[ count($parts)-1 ];
	$csv_title = @$afiles[$j][1];
	$csv_description = @$afiles[$j][2];
	$csv_keywords = @$afiles[$j][3];
	$csv_author = @$afiles[$j][4];
	$csv_categories = @$afiles[$j][5];

	$photo = "";

	if ( file_exists ( pvs_upload_dir().$pvs_global_settings["photopreupload"]."/" . $csv_path ) ) {
		$title = pvs_result( $csv_title );
		if ( $title == "" )
		{
			$ttl = explode( ".", $csv_filename );
			$title = str_replace( "_", "", $ttl[0] );
		}

		$pub_vars = array();
		$pub_vars["title"] = $csv_title;
		$pub_vars["description"] = pvs_result( $csv_description );
		$pub_vars["keywords"] = pvs_result( $csv_keywords );
		//$pub_vars["userid"]=pvs_user_login_to_id($csv_author);
		$pub_vars["userid"] = 0;
		$pub_vars["published"] = 1;
		$pub_vars["viewed"] = 0;
		$pub_vars["data"] = pvs_get_time();
		$pub_vars["author"] = pvs_result( $csv_author );
		$pub_vars["content_type"] = $pvs_global_settings["content_type"];
		$pub_vars["downloaded"] = 0;
		$pub_vars["model"] = 0;
		$pub_vars["examination"] = 0;
		$pub_vars["server1"] = $site_server_activ;
		$pub_vars["free"] = 0;

		$pub_vars["google_x"] = 0;
		$pub_vars["google_y"] = 0;
		$pub_vars["editorial"] = 0;
		$pub_vars["adult"] = 0;

		//Add a new photo to the database
		$id = pvs_publication_media_add(1);

		$folder = $id;

		$photo = $pvs_global_settings["photopreupload"] . $csv_path;

		//create thumbs and watermark
		if ( $photo != "" and preg_match( "/.jpg$|.jpeg$/i", $photo ) and ! file_exists ( pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb1.jpg" ) and ! $pvs_global_settings["upload_previews"] ) {
			pvs_photo_resize( pvs_upload_dir() . $photo, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb1.jpg", 1 );

			pvs_photo_resize( pvs_upload_dir() . $photo, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb2.jpg", 2 );

			pvs_publication_watermark_add( $id, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb2.jpg" );

			if ( $pvs_global_settings["prints"] and $pvs_global_settings["prints_previews"] and $pvs_global_settings["prints_previews_thumb"] and $pvs_global_settings["prints_previews_width"] > $pvs_global_settings["thumb_width2"] ) {
				pvs_photo_resize( pvs_upload_dir() . $photo, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb_print.jpg", 3 );
				pvs_publication_watermark_add( $id, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/thumb_print.jpg" );
			}
		}

		//Other formats
		$filename = pvs_get_file_info( $csv_filename, "filename" );
		foreach ( $photo_formats as $key => $value ) {
			$filecopy = "";

			if ( $value == "tiff" ) {
				if ( file_exists( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" . $filename . ".tif" ) ) {
					copy( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" . $filename .
						".tif", pvs_upload_dir() . $site_servers[$site_server_activ] .
						"/" . $folder . "/" . $filename . ".tif" );
					$filecopy = $filename . ".tif";
				}
				if ( file_exists( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" .
					$filename . ".tiff" ) )
				{
					copy( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" . $filename .
						".tiff", pvs_upload_dir() . $site_servers[$site_server_activ] .
						"/" . $folder . "/" . $filename . ".tiff" );
					$filecopy = $filename . ".tiff";
				}
			} else
			{
				if ( file_exists( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" .
					$filename . "." . $value ) )
				{
					copy( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" . $filename .
						"." . $value, pvs_upload_dir() . $site_servers[$site_server_activ] .
						"/" . $folder . "/" . $filename . "." . $value );
					$filecopy = $filename . "." . $value;
				}
			}

			if ( $filecopy != "" )
			{
				$sql = "update " . PVS_DB_PREFIX . "media set url_" . $value . "='" .
					pvs_result( $filecopy ) . "' where id=" . $id;
				$db->execute( $sql );
			}

			if ( $filecopy != "" )
			{
				//@unlink( pvs_upload_dir() . $pvs_global_settings["photopreupload"] . "/" . $filecopy );
			}
		}

		//create different dimensions
		if ( $photo != "" ) {
			copy( pvs_upload_dir() . $photo, pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/" . $csv_filename );
			$file = $csv_filename;

			$sql = "update " . PVS_DB_PREFIX . "media set url_jpg='" . pvs_result( $csv_filename ) . "' where id=" . $id;
			$db->execute( $sql );

			//Create photo sizes
			pvs_publication_photo_sizes_add( $id, $file, true );

			//Google coordinates
			$exif_info = @exif_read_data( pvs_upload_dir() . $site_servers[$site_server_activ] . "/" . $folder . "/" . $csv_filename, 0, true );
			if ( isset( $exif_info["GPS"]["GPSLongitude"] ) and isset( $exif_info["GPS"]['GPSLongitudeRef'] ) and
				isset( $exif_info["GPS"]["GPSLatitude"] ) and isset( $exif_info["GPS"]['GPSLatitudeRef'] ) )
			{
				$lon = pvs_getGps( $exif_info["GPS"]["GPSLongitude"], $exif_info["GPS"]['GPSLongitudeRef'] );
				$lat = pvs_getGps( $exif_info["GPS"]["GPSLatitude"], $exif_info["GPS"]['GPSLatitudeRef'] );

				$sql = "update " . PVS_DB_PREFIX . "media set google_x=" . $lat . ",google_y=" .
					$lon . " where id=" . $id;
				$db->execute( $sql );
			}
		}

		//Prints
		if ( $pvs_global_settings["prints"] )
		{
			pvs_publication_prints_add( $id, true );
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

		if ( $photo != "" )
		{
			//@unlink( pvs_upload_dir() . $photo );
		}
	}
}

if ($j > 0) {
	$_REQUEST["items"] = $j;
}
?>