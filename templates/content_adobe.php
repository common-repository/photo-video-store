<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
include ( "content_js_stock.php" );

if ( isset( $adobe_results ) ) {
	foreach ( $mstocks as $key => $value ) {
		if ( $key == 'adobe' )
		{
			$pvs_theme_content[ $key ] = true;
		} else
		{
			$pvs_theme_content[ $key ] = false;
		}
	}

	$pvs_theme_content[ 'id' ] = $adobe_results->id;

	if ( $adobe_results->media_type_id == 4 ) {
		$player_video_id = strval( @$adobe_results->id );
		$player_video_root = pvs_plugins_url();
		$player_video_width = $pvs_global_settings["ffmpeg_video_width"];
		$player_video_height = round( $pvs_global_settings["ffmpeg_video_width"] * (int)@$adobe_results->video_preview_height / (int)@$adobe_results->video_preview_width );
		$player_preview_video = @$adobe_results->video_preview_url;
		$player_preview_photo = @$adobe_results->thumbnail_url;

		include( PVS_PATH . 'includes/players/video_player.php');

		$pvs_theme_content[ 'image' ] = $video_player;
		
		$pvs_theme_content[ 'downloadsample' ] = @$adobe_results->thumbnail_url;
		$pvs_theme_content[ 'share_image' ] = urlencode( @$adobe_results->thumbnail_url );
	} else {
		$pvs_theme_content[ 'image' ] = "<img src='" . @$adobe_results->thumbnail_url . "' />";
		$pvs_theme_content[ 'downloadsample' ] = @$adobe_results->thumbnail_url;
		$pvs_theme_content[ 'share_image' ] = urlencode( @$adobe_results->thumbnail_url );
	}

	$publication_type = 'photo';
	
	$list_stocktypes = array(
	"",
	"photo",
	"illustration",
	"vector",
	"video",
	"template",
	"3d");
	
	$publication_type = @$list_stocktypes[@$adobe_results->media_type_id];
	
	$pvs_theme_content[ 'title' ] = @$adobe_results->title;
	$pvs_theme_content[ 'keywords' ] = @$adobe_keywords_links;
	$pvs_theme_content[ 'keywords_lite' ] = @$adobe_keywords_links;
	$pvs_theme_content[ 'description' ] = @$adobe_results->description;
	$pvs_theme_content[ 'category' ] = @$adobe_categories_links;
	$pvs_theme_content[ 'author' ] = '<b>' . pvs_word_lang( "Contributor" ) . ':</b> <a href="' . pvs_catalog_url(true) . '?stock=adobe&author=' . @$adobe_results->creator_id . '&stock_type=' . $publication_type . '" >' . @$adobe_results->creator_name . '</a>';
	$pvs_theme_content[ 'published' ] = @$shutterstock_results->added_date;
	$pvs_theme_content[ 'fotomoto' ] = "<script type='text/javascript' src='//widget.fotomoto.com/stores/script/" . $pvs_global_settings["fotomoto_id"] .
		".js'></script>";
	$pvs_theme_content[ 'share_title' ] = urlencode(@$adobe_results->title);

	if ( (int)get_query_var('pvs_print_id') > 0 ) {
		$pvs_theme_content[ 'share_url' ] = urlencode( pvs_print_url( @$adobe_results->
			id, ( int ) get_query_var('pvs_print_id'), @$adobe_results->title, $prints_preview,
			"adobe" ) );
	} else {
		$pvs_theme_content[ 'share_url' ] = urlencode( site_url() . pvs_get_stock_page_url( "adobe", @$adobe_results->id, @$adobe_results->
			title, get_query_var('adobe_type') ) );
	}

	$pvs_theme_content[ 'share_description' ] = urlencode(@$adobe_results->description );

	//Type			
	$pvs_theme_content[ 'type' ] = '<a href="' . pvs_catalog_url(true) .
	'?stock=shutterstock&stock_type=' . $publication_type . '" >' .
	pvs_word_lang( $publication_type ) . '</a>';

	//Published
	$pvs_theme_content[ 'flag_published' ] = true;

	//Category
	$pvs_theme_content[ 'flag_category' ] = true;

	//Model release
	if ( isset( $adobe_results->has_releases ) ) {
		$pvs_theme_content[ 'flag_model' ] = true;
		if ( @$adobe_results->has_releases )
		{
			$pvs_theme_content[ 'model_release' ] = pvs_word_lang( "yes" );
		} else
		{
			$pvs_theme_content[ 'model_release' ] = pvs_word_lang( "no" );
		}
	} else {
		$pvs_theme_content[ 'flag_model' ] = false;
	}

	//Property release
	$pvs_theme_content[ 'flag_property' ] = false;

	//Editorial
	$pvs_theme_content[ 'flag_editorial' ] = false;

	//Duration
	if ( isset( $adobe_results->duration ) ) {
		$pvs_theme_content[ 'flag_duration' ] = true;
		$pvs_theme_content[ 'duration' ] = @$adobe_results->duration/1000;
	} else {
		$pvs_theme_content[ 'flag_duration' ] = false;
	}

	//Aspect ratio
	$pvs_theme_content[ 'flag_aspect' ] = false;

	//Bites per minute
	$pvs_theme_content[ 'flag_bpm' ] = false;

	//Album
	$pvs_theme_content[ 'flag_album' ] = false;

	//Vocal description
	$pvs_theme_content[ 'flag_vocal_description' ] = false;


	//Lyrics
	$pvs_theme_content[ 'flag_lyrics' ] = false;

	//Artists
	$pvs_theme_content[ 'flag_artists' ] = false;


	//Genres
	$pvs_theme_content[ 'flag_genres' ] = false;

	//Instruments
	$pvs_theme_content[ 'flag_instruments' ] = false;

	//Moods
	$pvs_theme_content[ 'flag_moods' ] = false;

	//Sizes
	$sizes = '';
	if ( ! $prints_flag ) {
		$display_files = 'block';
		$display_prints = 'none';
		$checked_files = 'checked';
		$checked_prints = '';

		if ( $pvs_global_settings["adobe_prints"] and $pvs_global_settings["adobe_show"] ==
			2 and $publication_type != "video" )
		{
			$display_files = 'none';
			$display_prints = 'block';
			$checked_files = '';
			$checked_prints = 'checked';
		}
		
		if ( $pvs_global_settings["adobe_files"] and $pvs_global_settings["adobe_prints"] and
			$publication_type != "video" )
		{
			$sizes .= "<input type='radio' name='license' id='files_label' style='margin:20px 10px 10px 0px'  onClick='apanel(0);' " .
				$checked_files . "><label for='files_label' >" . pvs_word_lang( "files" ) .
				"</label><input type='radio' name='license' id='prints_label' style='margin:20px 10px 10px 20px'  onClick='apanel(1);' " .
				$checked_prints . "><label for='prints_label' >" . pvs_word_lang( "prints and products" ) .
				"</label>";
		}

		$sizes .= "<div id='prices_files' style='display:" . $display_files .
			"'><table border='0' cellpadding='0' cellspacing='0' class='table_cart'><tr valign='top'><th>" .
				pvs_word_lang( "title" ) . "</th><th>" . pvs_word_lang( "filesize" ) .
				"</th></tr>";

			$sizes .= '<tr valign="top"><td>' . pvs_word_lang( $publication_type ) . '</td><td>' . @$adobe_results->width . 'x' . @$adobe_results->height . '</td></tr>';

			$sizes .= "</table><br><br>";


		$sizes .= "<a href='" . @$adobe_results->details_url .
			"' target='blank' class = 'btn btn-primary btn-lg' style='color:#ffffff;text-decoration:none'>" .
			pvs_word_lang( "Buy on" ) . " Adobe Stock</a></div>";

		if ( $pvs_global_settings["adobe_prints"] and $publication_type != "video" )
		{
			$print_buy_checked = "checked";

			$sizes .= "<div id='prices_prints' style='display:" . $display_prints .
				"'><table border='0' cellpadding='0' cellspacing='0' class='table_cart'><tr valign='top'><th>" .
				pvs_word_lang( "title" ) . "</th><th>" . pvs_word_lang( "price" ) . "</th><th>" .
				pvs_word_lang( "buy" ) . "</th></tr>";

			$sql = "select id,title from " . PVS_DB_PREFIX .
				"prints_categories where active=1 order by priority";
			$dd->open( $sql );
			while ( ! $dd->eof )
			{
				$sizes .= "<tr><td colspan='3'><b>" . pvs_word_lang( $dd->row["title"] ) .
					"</b></th></td>";

				$sql = "select id_parent,title,price,option1,option2,option3,option4,option5,option6,option7,option8,option9,option10,option1_value,option2_value,option3_value,option4_value,option5_value,option6_value,option7_value,option8_value,option9_value,option10_value from " .
					PVS_DB_PREFIX . "prints  where category=" . $dd->row["id"] .
					" order by priority";
				$dr->open( $sql );

				while ( ! $dr->eof )
				{
					$prints_preview = "";
					if ( file_exists( pvs_upload_dir() .
						"/content/prints/product" . $dr->row["id_parent"] . "_1_big.jpg" ) or
						file_exists( pvs_upload_dir() . "/content/prints/product" .
						$dr->row["id_parent"] . "_2_big.jpg" ) or file_exists( pvs_upload_dir() . "/content/prints/product" . $dr->row["id_parent"] . "_3_big.jpg" ) )
					{
						$prints_preview = "<a href='javascript:show_prints_preview(" . $dr->row["id_parent"] .
							");'>";
					}

					$price = pvs_define_prints_price( $dr->row["price"], $dr->row["option1"], $dr->
						row["option1_value"], $dr->row["option2"], $dr->row["option2_value"], $dr->row["option3"],
						$dr->row["option3_value"], $dr->row["option4"], $dr->row["option4_value"], $dr->
						row["option5"], $dr->row["option5_value"], $dr->row["option6"], $dr->row["option6_value"],
						$dr->row["option7"], $dr->row["option7_value"], $dr->row["option8"], $dr->row["option8_value"],
						$dr->row["option9"], $dr->row["option9_value"], $dr->row["option10"], $dr->row["option10_value"] );

					$sizes .= "<tr class='tr_cart' id='tr_cart" . $dr->row["id_parent"] .
						"'><td width='40%' onClick='xprint(" . $dr->row["id_parent"] . ");'>" . $prints_preview .
						pvs_word_lang( $dr->row["title"] ) . "</td><td onClick='xprint(" . $dr->row["id_parent"] .
						");' ><span class='price'>" . pvs_currency( 1 ) . pvs_price_format( $price, 2, true ) .
						" " . pvs_currency( 2 ) . "</span></td><td onClick='xprint(" . $dr->row["id_parent"] .
						");'><input type='radio'  id='cartprint' name='cartprint' value='" . $dr->row["id_parent"] .
						"' " . $print_buy_checked . "></td></tr>";

					$print_buy_checked = "";

					$dr->movenext();
				}

				$dd->movenext();
			}

			$sizes .= "</table><br><a href=\"javascript:prints_stock('adobe'," . @$adobe_results->
				id . ",'" . urlencode( $adobe_results->details_url ) . "','" . urlencode( @$adobe_results->thumbnail_url ) . "','" . pvs_get_stock_page_url( "adobe", @$adobe_results->
				id, @$adobe_results->title, get_query_var("adobe_type") ) . "','" .
				addslashes( @$adobe_results->title ) . "')\" class = 'btn btn-danger btn-lg' style='color:#ffffff;text-decoration:none;'>" .
				pvs_word_lang( "Order print" ) . "</a></div>";
		}
	}

	$pvs_theme_content[ 'sizes' ] = $sizes;
	//End. Sizes

	//Related items
	$related_items = '';
	$related_count = 0;

	if ( ! $prints_flag ) {
		$url = 'https://stock.adobe.io/Rest/Media/1/Search/Files?search_parameters[similar]=' . (int) get_query_var("adobe") . "&result_columns[]=nb_results&result_columns[]=id&result_columns[]=title&result_columns[]=creator_name&result_columns[]=creator_id&result_columns[]=width&result_columns[]=height&result_columns[]=thumbnail_url&result_columns[]=media_type_id&result_columns[]=category&result_columns[]=nb_views&result_columns[]=nb_downloads&result_columns[]=creation_date&result_columns[]=keywords&result_columns[]=has_releases&result_columns[]=content_type&result_columns[]=framerate&result_columns[]=duration&result_columns[]=details_url&result_columns[]=description&result_columns[]=size_bytes&result_columns[]=video_preview_url&result_columns[]=video_preview_width&result_columns[]=video_preview_height&result_columns[]=video_preview_content_length&result_columns[]=video_preview_content_type&result_columns[]=video_small_preview_url&result_columns[]=video_small_preview_width&result_columns[]=video_small_preview_height&result_columns[]=video_small_preview_content_length&result_columns[]=video_small_preview_content_type&result_columns[]=thumbnail_width&result_columns[]=thumbnail_height";

		$ch = curl_init();
		
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'X-API-Key: ' . $pvs_global_settings["adobe_id"], 'X-Product: MySampleApp/1.0' ) );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );

		$data = curl_exec( $ch );
		if ( ! curl_errno( $ch ) )
		{
			$adobe_related = json_decode( $data );

			if ( isset( $adobe_related->files ) )
			{
				foreach ( $adobe_related->files as $key => $value )
				{
					//Image
					if ( $value->media_type_id != 4 )
					{
						$preview_title = @$value->title;
						$preview_img = @$value->thumbnail_url;

						$lightbox_width = @$value->width;
						$lightbox_height = @$value->height;
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
						$lightbox_hover = "onMouseover=\"lightboxon('" . $lightbox_url . "'," . $lightbox_width .
							"," . $lightbox_height . ",event,'" . site_url() . "','" . addslashes( str_replace
							( "'", "", str_replace( "\n", "", str_replace( "\r", "", @$value->title ) ) ) ) .
							"','');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" . $lightbox_width .
							"," . $lightbox_height . ",event)\"";

						$flow_width = @$value->width;
						$flow_height = @$value->height;
					} else {
					
						$preview_title = @$value->title;
						$preview_img = @$value->video_preview_url;

						$video_width = $pvs_global_settings["video_width"];
						$video_height = round( $pvs_global_settings["video_width"] * @$value->height/ @$value->width );
						$lightbox_hover = "onMouseover=\"lightboxon5('" . $value->video_preview_url . "'," . $video_width . "," . $video_height . ",event,'" . site_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
							$video_width . "," . $video_height . ",event)\"";

						$flow_width = $pvs_global_settings["width_flow"];
						if ( @$value->width != 0 )
						{
							$flow_height = round( $pvs_global_settings["width_flow"] * @$value->height/ @$value->width );
						}
					}

					$preview_title = "#" . @$value->id;
					
						
					$related_title = $preview_title;

					$related_id = @$value->id;

					$related_description = @$value->description;
					$related_url = pvs_get_stock_page_url( "adobe", @$value->id, @$value->title, "stock" );
					$related_preview = $preview_img;
					$related_lightbox = $lightbox_hover;

					$related_width = $flow_width;
					$related_height = $flow_height;
					
					if ( file_exists ( get_stylesheet_directory(). '/item_related_stock.php' ) ) {
						include( get_stylesheet_directory(). '/item_related_stock.php' );
					} else {
						if ( file_exists ( PVS_PATH . 'templates/item_related_stock.php' ) ) {
							include( PVS_PATH . 'templates/item_related_stock.php' );
						}
					}
					$related_items .= $pvs_theme_content[ 'related_content' ];
					$related_count++;
				}
			}
		}
	}

	$flag_related = false;
	if ( $pvs_global_settings["related_items"] and $related_count > 0 ) {
		$flag_related = true;
	}
	$pvs_theme_content[ 'flag_related' ] = $flag_related;

	$pvs_theme_content[ 'related_items' ] = $related_items;
	//End. Related items

	//Prints
	if ( (int)get_query_var('pvs_print_id') > 0 ) {
		$preview_url = @$adobe_results->thumbnail_url;
		$iframe_width = @$adobe_results->thumbnail_width;
		$iframe_height = @$adobe_results->thumbnail_height;
		$default_width = @$adobe_results->width;
		$default_height = @$adobe_results->height;

		$pvs_theme_content[ 'print_title' ] = pvs_word_lang( @$prints_title );

		$flag_resize = 0;
		$resize_min = $pvs_global_settings["thumb_width2"];
		;
		$resize_max = $pvs_global_settings["prints_previews_width"];
		$resize_value = $pvs_global_settings["thumb_width2"];
		;

		$sql = "select * from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )@$_REQUEST["print_id"];
		$ds->open( $sql );
		if ( ! $ds->eof )
		{
			$flag_resize = $ds->row["resize"];
			$resize_min = $ds->row["resize_min"];
			$resize_max = $ds->row["resize_max"];
			$resize_value = $ds->row["resize_value"];
		}

		$pvs_theme_content[ 'big_width_prints' ] = $iframe_width;
		$pvs_theme_content[ 'big_height_prints' ] = $iframe_height;

		$pvs_theme_content[ 'print_type' ] = $prints_preview;

		$pvs_theme_content[ 'image' ] = $preview_url;
		$pvs_theme_content[ 'preview_url' ] = $preview_url;
			
		include( PVS_PATH . "includes/prints/" . $prints_preview . "_big.php" );
		
		$pvs_theme_content[ 'image' ] = $pvs_theme_content[ 'print_content' ];

		$pvs_theme_content[ 'flag_resize' ] = $flag_resize;

		if ( $default_width < $default_height )
		{
			$photo_size = $default_height;
		} else
		{
			$photo_size = $default_width;
		}

		$print_thumb = $preview_url;
		if ( $default_width > $default_height )
		{
			$print_width = $pvs_global_settings["prints_previews_width"];
			$print_height = round( $pvs_global_settings["prints_previews_width"] * $default_height /
				$default_width );
		} else
		{
			$print_height = $pvs_global_settings["prints_previews_width"];
			$print_width = round( $pvs_global_settings["prints_previews_width"] * $default_width /
				$default_height );
		}
		
		$pvs_theme_content[ 'print_preview' ] = $print_thumb;
		$pvs_theme_content[ 'width_print_preview' ] = $print_width;
		$pvs_theme_content[ 'height_print_preview' ] = $print_height;
		$pvs_theme_content[ 'default_width' ] = $default_width;
		$pvs_theme_content[ 'default_height' ] = $default_height;

		$stock_id = @$adobe_results->id;
		$stock_type = "adobe";

		$pvs_theme_content[ 'stock_type' ] = $stock_type;
		$pvs_theme_content[ 'stock_id' ] = $stock_id;
		$pvs_theme_content[ 'stock_url' ] = pvs_get_stock_affiliate_url( "adobe", @$adobe_results->id, "stock", @$adobe_results->details_url );
		$pvs_theme_content[ 'stock_preview' ] = $preview_url;
		
		$pvs_theme_content[ 'stock_site_url' ] = pvs_print_url( @$adobe_results->
			id, ( int )get_query_var("pvs_print_id"), @$adobe_results->title, $prints_preview,
			"shutterstock" );


		$id_parent = get_query_var('adobe');
		include ( "content_print_properties.php" );
	}
	//End. Prints

	if ( (int)get_query_var('pvs_print_id') > 0 ) {
		if ( file_exists ( get_stylesheet_directory(). '/item_stockapi_print.php' ) ) {
			require_once( get_stylesheet_directory(). '/item_stockapi_print.php' );
		} else {
			if ( file_exists ( PVS_PATH . 'templates/item_stockapi_print.php' ) ) {
				require_once( PVS_PATH . 'templates/item_stockapi_print.php' );
			}
		}
	} else {
		if ( file_exists ( get_stylesheet_directory(). '/item_stockapi.php' ) ) {
			require_once( get_stylesheet_directory(). '/item_stockapi.php' );
		} else {
			if ( file_exists ( PVS_PATH . 'templates/item_stockapi.php' ) ) {
				require_once( PVS_PATH . 'templates/item_stockapi.php' );
			}
		}
	}
}
?>