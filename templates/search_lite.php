<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

$search = pvs_result( $_REQUEST["search"] );

if ( $search != "" ) {
	if ( ! $pvs_global_settings["elasticsearch"] or ! $pvs_global_settings["elasticsearch_search"] ) {
		$count_lite = 8;
		$count_limit = 0;
	
	
		$sch = explode( " ", trim( pvs_remove_words( pvs_result( $search ) ) ) );
	
		$com = "";
		$com_multilangual = "";
	
		if ( count( $sch ) > 0 ) {
			for ( $i = 0; $i < count( $sch ); $i++ ) {
				if ( $i != 0 )
				{
					$com .= " and ";
				}
	
				//Slow query. It finds words exactly.
				//$com.=" (title rlike '[[:<:]]".$sch[$i]."[[:>:]]' or description rlike '[[:<:]]".$sch[$i]."[[:>:]]' or keywords rlike '[[:<:]]".$sch[$i]."[[:>:]]') ";
	
				//Fast query
				//$com.=" (title like '%".$sch[$i]."%' or description like '%".$sch[$i]."%' or keywords like '%".$sch[$i]."%') ";
	
				//Fast query. It searches only in the titles
				$com .= " (title like '%" . $sch[$i] . "%') ";
	
				//Cirillic
				//$com.=" (UCASE(title) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]') or UCASE(description) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]') or UCASE(keywords) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]')) ";
			}
	
			//Multilangual
			if ( $pvs_global_settings["multilingual_publications"] and $com != '' ) {
				$com_multilangual = " (id in (select id from " . PVS_DB_PREFIX . "translations where types=1 and " . $com . ")) ";
			}
		}
	
		$sql_mass = array();
	
		$password_protected = pvs_get_password_protected();
	
		if ( $password_protected != '' ) {
			$password_protected = " and id not in (select publication_id from " . PVS_DB_PREFIX . "category_items where " . $password_protected . ") ";
		}
	
		$mass_was = array();
	
		if ($com_multilangual != '') {
			$sql = "select id,title from " . PVS_DB_PREFIX . "media where published=1 and (" . $com . " or " . $com_multilangual . ")" . $password_protected . " limit 0," . $count_lite;
		} else {
			$sql = "select id,title from " . PVS_DB_PREFIX . "media where published=1 and (" . $com . ")" . $password_protected . " limit 0," . $count_lite;
		}
		$rs->open( $sql );
		while ( ! $rs->eof )
		{
			if ( ! isset( $mass_was[$rs->row["title"]] ) and $count_limit < $count_lite + 1 )
			{
				$count_limit++;
	
				echo ( "<div class='instant_search_result' onClick=\"search_go('" . $rs->row["title"] . "')\">" );
				$title = "";
	
				$translate_results = pvs_translate_publication( $rs->row["id"], $rs->row["title"],
					"", "" );
	
				$titles = array();
				preg_match_all( "|(.*)(" . $search . ")(.*)|Uis", $translate_results["title"], $titles );
				if ( isset( $titles[1][0] ) )
				{
					$title = $titles[1][0];
				}
				if ( isset( $titles[2][0] ) )
				{
					$title = "<span>" . $titles[2][0] . "</span>";
				}
				if ( isset( $titles[3][0] ) )
				{
					$title = $titles[3][0];
				}
	
				if ( $title == "" )
				{
					$title = $translate_results["title"];
				}
				echo ( $title );
	
				echo ( "</div>" );
				$mass_was[$rs->row["title"]] = 1;
			}
			$rs->movenext();
		}
	} else {
		$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"] . "/" . $pvs_global_settings["elasticsearch_type"] . "/_search?pretty";

		//Published
		$filters[] = array("term" => array("published" => 1));
		
		$params = array();
		
		//Sorting
		$params["sort"] = array("downloaded" => array("order" => "desc"));
		
		$params["query"] = array("bool" => array("must" => array("multi_match" => array("query"=>$search,
																																"fields" => array("title"),
																																"type" => "most_fields"
																																),
																							),
																   "filter" => $filters			
																   )
										);
		//Paging
		$params["size"] = 8;
		$params["from"] = 0;
		
		$data_json = json_encode($params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = json_decode(curl_exec($ch));
		curl_close($ch);

		if ( @$response->hits->total > 0) {
			foreach ( @$response->hits->hits as $key => $value ) {
				echo ( "<div class='instant_search_result' onClick=\"search_go('" . @$value->_source->title . "')\">" );
				$title = "";
	
				$translate_results = pvs_translate_publication( @$value->_id, @$value->_source->title,
					"", "" );
	
				$titles = array();
				preg_match_all( "|(.*)(" . $search . ")(.*)|Uis", $translate_results["title"], $titles );
				if ( isset( $titles[1][0] ) )
				{
					$title = $titles[1][0];
				}
				if ( isset( $titles[2][0] ) )
				{
					$title = "<span>" . $titles[2][0] . "</span>";
				}
				if ( isset( $titles[3][0] ) )
				{
					$title = $titles[3][0];
				}
	
				if ( $title == "" )
				{
					$title = $translate_results["title"];
				}
				echo ( $title );
	
				echo ( "</div>" );		
			}
		}
	}
}

?>