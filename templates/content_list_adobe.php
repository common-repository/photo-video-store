<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

$flag_empty = false;
$search_content = "";

if ( $flow == 1 ) {
	if ( @$prints_flag and $pvs_global_settings["adobe_prints"] ) {
		$template_file = PVS_PATH . "includes/prints/" . $prints_preview . "_small.php";
	} else {
		if ( file_exists ( get_stylesheet_directory(). '/item_list_flow.php' ) ) {
			$template_file = get_stylesheet_directory() . "/item_list_flow.php";
		} else {
			if ( file_exists ( PVS_PATH . 'templates/item_list_flow.php' ) ) {
				$template_file = PVS_PATH . "templates/item_list_flow.php";
			}
		}
	}
} elseif ( $flow == 2 ) {
	if ( file_exists ( get_stylesheet_directory(). '/item_list_flow2.php' ) ) {
		$template_file = get_stylesheet_directory() . "/item_list_flow2.php";
	} else {
		if ( file_exists ( PVS_PATH . 'templates/item_list_flow2.php' ) ) {
			$template_file = PVS_PATH . "templates/item_list_flow2.php";
		}
	}
} else {
	if ( file_exists ( get_stylesheet_directory(). '/item_list.php' ) ) {
		$template_file = get_stylesheet_directory() . "/item_list.php";
	} else {
		if ( file_exists ( PVS_PATH . 'templates/item_list.php' ) ) {
			$template_file = PVS_PATH . "templates/item_list.php";
		}
	}
}


//Create search URL:

if ( isset( $_REQUEST["stock_type"] ) ) {
	if ( $_REQUEST["stock_type"] == "" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search );
	}

	if ( ( int )@$_REQUEST["print_id"] > 0 and $pvs_global_settings["adobe_prints"] and
		$_REQUEST["stock_type"] == "video" ) {
		$_REQUEST["stock_type"] = "photo";
	}

	if ( $_REQUEST["stock_type"] == "photo" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:photo]=1';
	}
	
	if ( $_REQUEST["stock_type"] ==
		"illustration" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:illustration]=1';
	}
	
	if ( $_REQUEST["stock_type"] == "vector" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:vector]=1';
	}

	if ( $_REQUEST["stock_type"] == "video" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:video]=1';
	}
	
	if ( $_REQUEST["stock_type"] == "template" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:template]=1';
	}
	
	if ( $_REQUEST["stock_type"] == "3d" ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search ) .
			'&search_parameters[filters][content_type:3d]=1';
	}
} else
{
	$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[words]=' . urlencode( $search );
}

//Page
$url .= '&search_parameters[offset]=' . ((@$str-1)*$items) . '&search_parameters[limit]=' . @$items;


//Sort
if ( @$_REQUEST["sort"] != "" and ( @$_REQUEST["sort"] == 'relevance' or @$_REQUEST["creation"] ==
	'popularity' or @$_REQUEST["sort"] == 'nb_downloads' ) ) {
	$url .= '&search_parameters[order]=' . pvs_result( $_REQUEST["sort"] );
} else {
	$url .= '&search_parameters[order]=relevance';
}


//Contributor
if ( @$_REQUEST["stock_type"] != "music" ) {
	if ( @$_REQUEST["author"] != "" ) {
		$url .= '&search_parameters[creator_id]=' . (int) $_REQUEST["author"];
	} else {
		if ( $pvs_global_settings["adobe_contributor"] != "" ) {
			$url .= '&search_parameters[creator_id]=' . $pvs_global_settings["adobe_contributor"];
		}
	}
}

//Category
if ( isset( $_REQUEST["category"] ) and $_REQUEST["category"] != -1 ) {
	$url .= '&search_parameters[category]=' . ( int )$_REQUEST["category"];
}

//Model property release
if ( isset( $_REQUEST["model"] ) ) {
	$url .= '&search_parameters[filters][has_releases]=' . pvs_result($_REQUEST["model"]);
}

//Orientation
if ( @$_REQUEST["orientation"] != "" ) {
	$url .= '&search_parameters[filters][orientation]=' . pvs_result( $_REQUEST["orientation"] );
}


//Color
if ( @$_REQUEST["color"] != "" and @$_REQUEST["color"] != "FFFFFF" ) {
	$url .= '&search_parameters[filters][colors]=' . pvs_result( $_REQUEST["color"] );
}

//Language
if ( @$_REQUEST["language"] != "") {
	$url .= '&locale=' . pvs_result( $_REQUEST["language"] );
}

//Duration video
if ( @$_REQUEST["duration_video"] != "" and @$_REQUEST["stock_type"] == "video" ) {
	$url .= '&search_parameters[filters][video_duration]=' . pvs_result( $_REQUEST["duration_video"] );
}




$url .= "&result_columns[]=nb_results&result_columns[]=id&result_columns[]=title&result_columns[]=creator_name&result_columns[]=width&result_columns[]=height&result_columns[]=thumbnail_url&result_columns[]=media_type_id&result_columns[]=category&result_columns[]=nb_views&result_columns[]=nb_downloads&result_columns[]=creation_date&result_columns[]=keywords&result_columns[]=has_releases&result_columns[]=content_type&result_columns[]=framerate&result_columns[]=duration&result_columns[]=details_url&result_columns[]=description&result_columns[]=size_bytes&result_columns[]=video_preview_url&result_columns[]=video_preview_width&result_columns[]=video_preview_height&result_columns[]=video_preview_content_length&result_columns[]=video_preview_content_type&result_columns[]=video_small_preview_url&result_columns[]=video_small_preview_width&result_columns[]=video_small_preview_height&result_columns[]=video_small_preview_content_length&result_columns[]=video_small_preview_content_type&result_columns[]=thumbnail_width&result_columns[]=thumbnail_height";


//echo($url."<br><br>");

$ch = curl_init();

curl_setopt( $ch, CURLOPT_URL, $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'X-API-Key: ' . $pvs_global_settings["adobe_id"], 'X-Product: MySampleApp/1.0' ) );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );

$data = curl_exec( $ch );
//var_dump($data);
if ( ! curl_errno( $ch ) ) {
	$results = json_decode( $data );
	$n = 0;
	if ( isset( $results->files ) ) {
		foreach ( $results->files as $key => $value ) {
			$n++;

			$pvs_theme_content[ 'item_title' ] = "#" . @$value->id;
			$pvs_theme_content[ 'item_id' ] = @$value->id;

			$pvs_theme_content[ 'cart' ] = false;
			$pvs_theme_content[ 'cartflow' ] = false;
			$pvs_theme_content[ 'cartflow2' ] = false;
			$pvs_theme_content[ 'featured' ] = false;
			$pvs_theme_content[ 'new' ] = false;
			$pvs_theme_content[ 'free' ] = false;
			$pvs_theme_content[ 'rights_managed' ] = false;
			$pvs_theme_content[ 'class2' ] = "";

			$pvs_theme_content[ 'item_viewed' ] = @$value->nb_views;
			$pvs_theme_content[ 'item_downloaded' ] = @$value->nb_downloads;


			$pvs_theme_content[ 'item_title' ] = @$value->title;

			$pvs_theme_content[ 'item_img' ] = @$value->thumbnail_url;

			$lightbox_width = @$value->thumbnail_width;
			$lightbox_height = @$value->thumbnail_height;
			$lightbox_url = @$value->thumbnail_url;

			if ( $lightbox_width > $lightbox_height )
			{
				if ( $lightbox_width > $pvs_global_settings["max_hover_size"] )
				{

					$lightbox_height = round( $lightbox_height * $pvs_global_settings["max_hover_size"] /
						$lightbox_width );
					$lightbox_width = $pvs_global_settings["max_hover_size"];
				}
			} else
			{
				if ( $lightbox_height > $pvs_global_settings["max_hover_size"] )
				{
					$lightbox_width = round( $lightbox_width * $pvs_global_settings["max_hover_size"] /
						$lightbox_height );
					$lightbox_height = $pvs_global_settings["max_hover_size"];
				}
			}
			
			if ( $value->media_type_id == 4 and (int)@$value->video_preview_width != 0 )
			{
				$video_width = $pvs_global_settings["video_width"];
				$video_height = round( $pvs_global_settings["video_width"] * (int)@$value->video_preview_height / (int)@$value->video_preview_width );
				
				$lightbox_hover = "onMouseover=\"lightboxon5('" . @$value->video_preview_url . "'," . $video_width. "," . $video_height . ",event,'" . site_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
					$video_width. "," . $video_height . ",event)\"";
			} else {
				$lightbox_hover = "onMouseover=\"lightboxon('" . $lightbox_url . "'," . $lightbox_width .
					"," . $lightbox_height . ",event,'" . site_url() . "','" . addslashes( str_replace
					( "'", "", str_replace( "\n", "", str_replace( "\r", "", @$value->title ) ) ) ) .
					"','" . addslashes( str_replace
					( "'", "", str_replace( "\n", "", str_replace( "\r", "", @$value->creator_name ) ) ) ) .
					"');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" . $lightbox_width .
					"," . $lightbox_height . ",event)\"";
			
			}

			$pvs_theme_content[ 'item_img2' ] = $lightbox_url;

			$flow_width =  @$value->thumbnail_width;
			$flow_height =  @$value->thumbnail_height;

			$pvs_theme_content[ 'item_lightbox' ] = $lightbox_hover;

			$width_limit = $pvs_global_settings["width_flow"];

			if ( ( $flow_width > $width_limit or $flow_height > $width_limit ) and $flow_width !=
				0 )
			{
				$flow_height = round( $flow_height * $width_limit / $flow_width );
				$flow_width = $width_limit;
			}

			if ( $flow == 1 or $flow == 2 )
			{
				$str_width = " width='" . $flow_width . "' ";
				$str_height = " height='" . $flow_height . "' ";

				$str_width2 = "width:" . $flow_width . "px";
				$str_height2 = "height:" . $flow_height . "px";
			}

			if ( $flow == 0 )
			{
				$str_width = " width='" . $flow_width . "' ";
				$str_height = " height='" . $flow_height . "' ";

				$str_width2 = "width:" . $flow_width . "px";
				$str_height2 = "height:" . $flow_height . "px";
			}

			$pvs_theme_content[ 'width' ] = $flow_width;
			$pvs_theme_content[ 'height' ] = $flow_height;

			$pvs_theme_content[ 'width_prints' ] = $flow_width;
			$pvs_theme_content[ 'height_prints' ] = $flow_height;

			$pvs_theme_content[ 'item_description' ] = @$value->description;
			$pvs_theme_content[ 'item_keywords' ] = "";

			if ( $pvs_global_settings["adobe_pages"] )
			{
				$pvs_theme_content[ 'item_url' ] = pvs_get_stock_page_url( "adobe", @$value->id, @$value->title, "stock" );
			} else
			{
				$pvs_theme_content[ 'item_url' ] = @$value->details_url;
			}

			//Prints
			if ( @$prints_flag and isset( $_REQUEST["print_id"] ) )
			{
				$sql = "select price from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )
					$_REQUEST["print_id"];
				$dn->open( $sql );
				if ( ! $dn->eof )
				{
					$pvs_theme_content[ 'price' ] = pvs_currency( 1 ) . pvs_price_format( $dn->row["price"], 2, true ) . " " . pvs_currency( 2 );
				} else
				{
					$pvs_theme_content[ 'price' ] = "";
				}

				$pvs_theme_content[ 'print_url' ] = pvs_print_url( @$value->id, ( int )$_REQUEST["print_id"], @$value->title, $prints_preview, "adobe" );
			}

			$show_print_title = true;
			include($template_file);
			if ( @$prints_flag )
			{
				echo($pvs_theme_content[ 'print_content' ]);
			}
		}
	}

	$stock_result_count = @$results->total_count;
	$_SESSION["stock_result_count"] = $stock_result_count;
} else
{
	echo ( pvs_word_lang( "Error. The script cannot connect to API." ) );
}

curl_close( $ch );
?>