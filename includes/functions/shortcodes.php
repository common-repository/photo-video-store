<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}


/**
 * Shortcode [pvs_products]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_products( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $mstocks;
	global $pvs_global_settings;
	global $_SESSION;
	global $_REQUEST;
	global $scripts_variables;
	global $autopaging;
	global $flow_vars;
	global $id_parent;
	
	pvs_attributes_to_search_params($atts);
	include ( PVS_PATH . "templates/content_list_vars.php" );
	
	ob_start();	

	if ( $stock == 'site' ) {
		if ( $pvs_global_settings["elasticsearch"] and $pvs_global_settings["elasticsearch_search"] and ! isset( $_REQUEST["collection"] ) and ! isset( $_REQUEST["lightbox"] ) and pvs_get_password_protected() == '') {
			include ( PVS_PATH . "templates/content_list_elasticsearch.php" );
		} else {
			include ( PVS_PATH . "templates/content_list_items.php" );
		}
	}
	
	if ( $stock == 'istockphoto' ) {
		include ( PVS_PATH . "templates/content_list_istockphoto.php" );
	}
	
	if ( $stock == 'shutterstock' ) {
		include ( PVS_PATH . "templates/content_list_shutterstock.php" );
	}
	
	if ( $stock == 'fotolia' ) {
		include ( PVS_PATH . "templates/content_list_fotolia.php" );
	}
	
	if ( $stock == 'depositphotos' ) {
		include ( PVS_PATH . "templates/content_list_depositphotos.php" );
	}
	
	if ( $stock == 'rf123' ) {
		include ( PVS_PATH . "templates/content_list_123rf.php" );
	}
	
	if ( $stock == 'bigstockphoto' ) {
		include ( PVS_PATH . "templates/content_list_bigstockphoto.php" );
	}
	
	if ( $stock == 'pixabay' ) {
		include ( PVS_PATH . "templates/content_list_pixabay.php" );
	}
	
	if ( $stock == 'adobe' ) {
		include ( PVS_PATH . "templates/content_list_adobe.php" );
	}
	
	return pvs_shortcodes_wrap( $atts, 'header' ) . ob_get_clean() . pvs_shortcodes_wrap( $atts, 'footer' ); 
}
 
add_shortcode( 'pvs_products', 'pvs_shortcodes_products' );




/**
 * Shortcode [pvs_paging]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_paging( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $mstocks;
	global $pvs_global_settings;
	global $_SESSION;
	global $_REQUEST;
	global $stock_result_count;

	include ( PVS_PATH . "templates/content_list_vars.php" ); 
	
	//Stock results count
	ob_start();
	if ( $stock != 'site' ) {
		$paging_text = pvs_paging( ( int )@$_SESSION["stock_result_count"], $str, $kolvo, $kolvo2, $redirect_page, pvs_build_variables( "str", "", false ), false, true );
	
		if ( ( int )@$_SESSION["stock_result_count"] > $kolvo and @$autopaging == 0 ) {
		?>
			<div id="search_footer">
				<div id="search_paging2"><?php echo $paging_text ?></div>
			</div>
		<?php
		}
	?>
		<script>
			function show_results_count() {
				jQuery('#result_count').html('(<?php echo ( int )@$_SESSION["stock_result_count"] ?>)')
			}
			show_results_count()
		</script>
		<?php
	} else {
		if ( $record_count > $kolvo and @$autopaging == 0 ) {
		?>
			<div id="search_footer">
				<div id="search_paging2"><?php echo $paging_text ?></div>
			</div>
		<?php
		}
	}
	return ob_get_clean();
}
 
add_shortcode( 'pvs_paging', 'pvs_shortcodes_paging' );




/**
 * Shortcode [pvs_sidebar_menu]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_sidebar_menu( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $mstocks;
	global $pvs_global_settings;
	global $_SESSION;
	global $_REQUEST;
	
	ob_start();
	include ( PVS_PATH . "templates/content_list_vars.php" ); 
	
	if ( $showmenu == 1 and $pvs_global_settings["left_search"] ) {
		if ( $stock == 'site' ) {
			include ( PVS_PATH . "templates/content_list_menu.php" );
		}
	
		if ( $stock == 'istockphoto' ) {
			include ( PVS_PATH . "templates/content_list_menu_istockphoto.php" );
		}
	
		if ( $stock == 'shutterstock' ) {
			include ( PVS_PATH . "templates/content_list_menu_shutterstock.php" );
		}
	
		if ( $stock == 'fotolia' ) {
			include ( PVS_PATH . "templates/content_list_menu_fotolia.php" );
		}
	
		if ( $stock == 'depositphotos' ) {
			include ( PVS_PATH . "templates/content_list_menu_depositphotos.php" );
		}
	
		if ( $stock == 'rf123' ) {
			include ( PVS_PATH . "templates/content_list_menu_123rf.php" );
		}
	
		if ( $stock == 'bigstockphoto' ) {
			include ( PVS_PATH . "templates/content_list_menu_bigstockphoto.php" );
		}
	
		if ( $stock == 'pixabay' ) {
			include ( PVS_PATH . "templates/content_list_menu_pixabay.php" );
		}
	}
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_sidebar_menu', 'pvs_shortcodes_sidebar_menu' );





/**
 * Shortcode [pvs_top_menu]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_top_menu( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $mstocks;
	global $pvs_global_settings;
	global $_SESSION;
	global $_REQUEST;

	ob_start();
	include ( PVS_PATH . "templates/content_list_vars.php" ); 
	include ( PVS_PATH . "templates/content_list_menu_top.php" );

	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_top_menu', 'pvs_shortcodes_top_menu' );




/**
 * The function converts shortcodes attributes to search params
 *
 * @param  array $atts shortcode attributes.
 */
function pvs_attributes_to_search_params ( $atts ) {
	global $_REQUEST;
	global $pvs_global_settings;
	
	//View
	if ( isset ( $atts[ 'view' ] ) and $atts[ 'view' ] == 'grid' ) {
		$_REQUEST[ 'flow' ] = 0;
	}
	if ( isset ( $atts[ 'view' ] ) and $atts[ 'view' ] == 'fixed_width' ) {
		$_REQUEST[ 'flow' ] = 1;
	}
	if ( isset ( $atts[ 'view' ] ) and $atts[ 'view' ] == 'fixed_height' ) {
		$_REQUEST[ 'flow' ] = 2;
	}
	
	
	//Numbers
	if ( isset ( $atts[ 'limit' ] ) and  (int)$atts[ 'limit' ] > 0 ) {
		$_REQUEST[ 'items' ] = (int)$atts[ 'limit' ];
		$pvs_global_settings["auto_paging"] = 0;
		$pvs_global_settings["auto_paging_default"] = 0;
	}
	
	//Orderby
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'date' ) {
		if ( @$atts[ 'order' ] == 'DESC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'date';
		} else {
			$_REQUEST[ 'vd' ] = 'date2';
		}
	}
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'id' ) {
		if ( @$atts[ 'order' ] == 'ASC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'id';
		} else {
			$_REQUEST[ 'vd' ] = 'id2';
		}
	}
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'popularity' ) {
		if ( @$atts[ 'order' ] == 'DESC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'popular';
		} else {
			$_REQUEST[ 'vd' ] = 'popular2';
		}
	}
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'downloads' ) {
		if ( @$atts[ 'order' ] == 'DESC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'downloaded';
		} else {
			$_REQUEST[ 'vd' ] = 'downloaded2';
		}
	}
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'title' ) {
		if ( @$atts[ 'order' ] == 'ASC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'title';
		} else {
			$_REQUEST[ 'vd' ] = 'title2';
		}
	}
	if ( isset ( $atts[ 'orderby' ] ) and $atts[ 'orderby' ] == 'rating' ) {
		if ( @$atts[ 'order' ] == 'DESC' or @$atts[ 'order' ] == '' ) {
			$_REQUEST[ 'vd' ] = 'rated';
		} else {
			$_REQUEST[ 'vd' ] = 'rated2';
		}
	}
	
	//Search
	if ( isset ( $atts[ 'query' ] ) ) {
		$_REQUEST[ 'search' ] = $atts[ 'query' ];
	}
	
	//Type
	if ( isset ( $atts[ 'type' ] ) and  $atts[ 'type' ] == 'photo') {
		$_REQUEST[ 'sphoto' ] = 1;
	}
	if ( isset ( $atts[ 'type' ] ) and  $atts[ 'type' ] == 'video') {
		$_REQUEST[ 'svideo' ] = 1;
	}
	if ( isset ( $atts[ 'type' ] ) and  $atts[ 'type' ] == 'audio') {
		$_REQUEST[ 'saudio' ] = 1;
	}
	if ( isset ( $atts[ 'type' ] ) and  $atts[ 'type' ] == 'vector') {
		$_REQUEST[ 'svector' ] = 1;
	}
	
	//Content
	if ( isset ( $atts[ 'content' ] ) and  $atts[ 'content' ] == 'free') {
		$_REQUEST[ 'c' ] = "free";
	}
	if ( isset ( $atts[ 'content' ] ) and  $atts[ 'content' ] == 'featured') {
		$_REQUEST[ 'c' ] = "featured";
	}
	
	//Author
	if ( isset ( $atts[ 'author' ] ) ) {
		$_REQUEST[ 'author' ] = $atts[ 'author' ];
	}
	
	//ID
	if ( isset ( $atts[ 'id' ] ) and  $atts[ 'id' ] > 0 ) {
		$_REQUEST[ 'item_id' ] = $atts[ 'id' ];
	}
	
	//Category ID
	if ( isset ( $atts[ 'category_id' ] ) and  $atts[ 'category_id' ] > 0 ) {
		$_REQUEST[ 'acategory' ] = $atts[ 'category_id' ];
	}
	
	//Lightbox ID
	if ( isset ( $atts[ 'lightbox_id' ] ) and  $atts[ 'lightbox_id' ] > 0 ) {
		$_REQUEST[ 'lightbox' ] = $atts[ 'lightbox_id' ];
	}
	
	//Collection ID
	if ( isset ( $atts[ 'collection_id' ] ) and  $atts[ 'collection_id' ] > 0 ) {
		$_REQUEST[ 'collection' ] = $atts[ 'collection_id' ];
	}
	
	//Print ID
	if ( isset ( $atts[ 'print_id' ] ) and  $atts[ 'print_id' ] > 0 ) {
		$_REQUEST[ 'print_id' ] = $atts[ 'print_id' ];
		$_REQUEST[ 'flow' ] = 1;
	}
	
	//Royalty-free
	if ( isset ( $atts[ 'royalty_free' ] ) and  $atts[ 'royalty_free' ] == 1 ) {
		$_REQUEST[ 'royalty_free' ] = 1;
	}
	
	//Rights-managed
	if ( isset ( $atts[ 'rights_managed' ] ) and  $atts[ 'rights_managed' ] == 1 ) {
		$_REQUEST[ 'rights_managed' ] = 1;
	}
	
	//Exclusive
	if ( isset ( $atts[ 'exclusive' ] ) and  $atts[ 'exclusive' ] == 1 ) {
		$_REQUEST[ 'exclusive' ] = 1;
	}
	
	//Editorial
	if ( isset ( $atts[ 'editorial' ] ) and  $atts[ 'editorial' ] == 1 ) {
		$_REQUEST[ 'editorial' ] = 1;
	}
	
	//Color
	if ( isset ( $atts[ 'color' ] ) ) {
		$_REQUEST[ 'color' ] = $atts[ 'color' ];
	}
	
	//Orientation
	if ( isset ( $atts[ 'orientation' ] ) ) {
		$_REQUEST[ 'orientation' ] = (int) $atts[ 'orientation' ];
	}
	
	//Stock
	if ( isset ( $atts[ 'stock' ] ) ) {
		$_REQUEST[ 'stock' ] = $atts[ 'stock' ];
	}
}




/**
 * Wrapper for shortcodes
 *
 * @param  array $atts shortcode attributes.
 * @param  string $type 'header' or 'footer'.
 * @return string html+js code for catalog
 */
function pvs_shortcodes_wrap( $atts, $type ) {
	global $pvs_global_settings;
	global $_REQUEST;
	global $stock;
	global $autopaging;
	global $flow_vars;
	global $id_parent;
	
	$shortcodes_wrapper = '';
		
	$view = "grid";
	
	if ( $pvs_global_settings["fixed_width"] and $pvs_global_settings["catalog_view"] == "fixed_width" ) {
		$view = "fixed_width";
	}

	if ( $pvs_global_settings["fixed_height"] and $pvs_global_settings["catalog_view"] == "fixed_height" ) {
		$view = "fixed_height";
	}
	
	if ( isset ( $_REQUEST["flow"] ) ) {
		if ( (int)$_REQUEST["flow"] == 1 ) {
			$view = "grid";
		}
		if ( (int)$_REQUEST["flow"] == 1 ) {
			$view = "fixed_width";
		}
		if ( (int)$_REQUEST["flow"] == 2 ) {
			$view = "fixed_height";
		}
	}
	
	if ( isset ( $atts[ 'view' ] ) ) {
		$view = $atts[ 'view' ];
	}
	
	if ( $view != "fixed_height" ) {
		$shortcodes_wrapper = '<style>
											.home_box
											{
											width:' . $pvs_global_settings["width_flow"] . 'px;
											}
											
											/*New styles for the previews. It overwrites style.css file.*/
											.item_list 
											{ 
												width: ' . ($pvs_global_settings["thumb_width"] + 20 ) . 'px;
											}
											
											.item_list_img
											{
												width: ' . ( $pvs_global_settings["thumb_width"] + 20 ) . 'px;
												height: ' . ( $pvs_global_settings["thumb_width"] + 20 ) . 'px;
											}
											
											.item_list_text1,.item_list_text2,.item_list_text3,.item_list_text4
											{
												width: ' . ( $pvs_global_settings["thumb_width"] + 20 ) . 'px;
											}';
	
		if ( @$stock != "site" ) {
			if ( @$stock != "fotolia" and @$stock != "depositphotos" and @$stock != "pixabay" ) {
				$shortcodes_wrapper .= '.iviewed,.idownloaded
													{
													display:none;
													}';
			}
	
			$shortcodes_wrapper .= '.action-control,.fa-heart-o,li.hb_lightbox
												{
												display:none;
												}
												
												.preview_listing
												{
												max-width:120px;
												max-height:120px;
												}';
		}
	
		$shortcodes_wrapper .= '</style>';
	}


	if ( $view == 'grid' ) {
		if ( $type == 'header' ) {
			$shortcodes_wrapper .= '<div class="item_list_page" id="flow_body" style="display:table">';
		} else {
			$shortcodes_wrapper .= '</div><div style="clear:both"></div>';
		}
	}
	if ( $view == 'fixed_width' ) {
		if ( $type == 'header' ) {
			$shortcodes_wrapper .= '<div class="item_list_page" id="flow_body">';
		} else {
			$shortcodes_wrapper .= '</div><div style="clear:both"></div>
												<script src="' . pvs_plugins_url() . '/assets/js/jquery.masonry.min.js"></script>
												<script>
													jQuery(document).ready(function(){

														jQuery("#flow_body").masonry({
														itemSelector: ".home_box"
														});
																												
														jQuery(".home_preview").each(function(){
									
															jQuery(this).animate({opacity:"1.0"},1);
															jQuery(this).mouseover(function(){
															jQuery(this).stop().animate({opacity:"0.6"},600);
															});
															jQuery(this).mouseout(function(){
															jQuery(this).stop().animate({opacity:"1.0"},300);
															});			
															
															jQuery(".hb_cart").mouseover(function(){
																jQuery(this).stop().animate({ opacity: 1}, 600);
												
															});
												
															jQuery(".hb_cart").mouseout(function(){
																jQuery(this).stop().animate({ opacity: 0.5}, 600);
															});					
															
															 jQuery(".hb_lightbox").mouseover(function(){
																jQuery(this).stop().animate({ opacity: 1}, 600);
															});
												
															jQuery(".hb_lightbox").mouseout(function(){
																jQuery(this).stop().animate({ opacity: 0.5}, 600);
															});
															
															 jQuery(".hb_free").mouseover(function(){
																jQuery(this).stop().animate({ opacity: 1}, 600);
															});
												
															jQuery(".hb_free").mouseout(function(){
																jQuery(this).stop().animate({ opacity: 0.5}, 600);
															});								
														});
													});
													</script>';
		}
	}
	if ( $view == 'fixed_height' ) {
		if ( $type == 'header' ) {
			$shortcodes_wrapper .= '<div class="item_list_page" id="flow_body">';
		} else {
			$shortcodes_wrapper .= '</div><div style="clear:both"></div>
												<script src="' . pvs_plugins_url() . '/assets/js/collageplus/jquery.collagePlus.min.js"></script>
												<script src="' . pvs_plugins_url() . '/assets/js/collageplus/extras/jquery.removeWhitespace.js"></script>
												<script src="' . pvs_plugins_url() . '/assets/js/collageplus/extras/jquery.collageCaption.js"></script>
												<script>
												jQuery(document).ready(function(){
									
													refreshCollagePlus();
													
													jQuery(".home_preview").each(function(){
														jQuery(this).animate({opacity:"1.0"},1);
														jQuery(this).mouseover(function(){
														jQuery(this).stop().animate({opacity:"0.6"},600);
														});
														jQuery(this).mouseout(function(){
														jQuery(this).stop().animate({opacity:"1.0"},300);
														});
													});
												});
									
												function refreshCollagePlus() {
													jQuery(".item_list_page").removeWhitespace().collagePlus({
														"targetHeight"    : ' . $pvs_global_settings["height_flow"] . ',
														"fadeSpeed"       : "slow",
														"effect"          : "default",
														"direction"       : "vertical",
														"allowPartialLastRow"       : true
													});
												}
												
												// This is just for the case that the browser window is resized
												var resizeTimer = null;
												jQuery(window).bind("resize", function() {
													if (resizeTimer) clearTimeout(resizeTimer);
													resizeTimer = setTimeout(refreshCollagePlus, 200);
												});
											
												</script>
												<style>
											
												.item_list_page img{
													margin:10px;
													padding:0px;
													display:inline-block;
													vertical-align:bottom;
													opacity:1;
												}
												</style>
												<link rel="stylesheet" type="text/css" href="' . pvs_plugins_url() . '/assets/js/collageplus/css/transitions.css" media="all" />';
		}
	}
	
	if ( $autopaging == 1 and $type == 'footer' ) {
		$shortcodes_wrapper .= "<script>
												str=2;
												flag_auto=true;
												res=' ';
												
												function auto_pvs_paging(page) {
													str=page;
												
													jQuery.ajax({
													type:'POST',
													url:'" . site_url() . "/content-list-paging/',
													data:'" . @$flow_vars . "&str='+str+'&id_parent=" . (int)@$id_parent . "',
													success:function(data){	
													if(page==1)
													{
														document.getElementById('flow_body').innerHTML =data;
														res=data;
													}
													else
													{
														document.getElementById('flow_body').innerHTML = document.getElementById('flow_body').innerHTML + data;
														res=data;
														check_carts('" . pvs_word_lang( "in your cart" ) . "');
													}";
			
		if ( $view == 'fixed_width' ) {
			$shortcodes_wrapper .= "
												jQuery('#flow_body').masonry({
												itemSelector: '.home_box'
												});
											
												jQuery('#flow_body').masonry('reload') ;												
												";
		}
		if ( $view == 'fixed_height' ) {
			$shortcodes_wrapper .= "refreshCollagePlus();";
		}
		
		if (@ $flow_vars == '') {
			$flow_vars = 'xpaging:0';
		}

		$shortcodes_wrapper .= "jQuery('.home_preview').each(function(){
							
											jQuery(this).animate({opacity:'1.0'},1);
											jQuery(this).mouseover(function(){
											jQuery(this).stop().animate({opacity:'0.6'},600);
											});
											jQuery(this).mouseout(function(){
											jQuery(this).stop().animate({opacity:'1.0'},300);
											});
								
											
											jQuery('.hb_cart').mouseover(function(){
												jQuery(this).stop().animate({ opacity: 1}, 600);
								
											});
								
											jQuery('.hb_cart').mouseout(function(){
												jQuery(this).stop().animate({ opacity: 0.5}, 600);
											});
											
											jQuery('.hb_cart2').mouseover(function(){
												jQuery(this).stop().animate({ opacity: 1}, 600);
											});
								
											jQuery('.hb_cart2').mouseout(function(){
												jQuery(this).stop().animate({ opacity: 0.5}, 600);
											});
										
											
											 jQuery('.hb_lightbox').mouseover(function(){
												jQuery(this).stop().animate({ opacity: 1}, 600);
											});
								
											jQuery('.hb_lightbox').mouseout(function(){
												jQuery(this).stop().animate({ opacity: 0.5}, 600);
											});
											
											 jQuery('.hb_free').mouseover(function(){
												jQuery(this).stop().animate({ opacity: 1}, 600);
											});
								
											jQuery('.hb_free').mouseout(function(){
												jQuery(this).stop().animate({ opacity: 0.5}, 600);
											});
										});
										}
									});
									str++;
									}
									
									
									jQuery(document).ready(function(){
										jQuery(window).scroll(function(){
											if(jQuery(document).height() - jQuery(window).height() - jQuery(window).scrollTop() <150) 
											{
												if(flag_auto)
												{
													flag_auto=false;
													if(res!='')
													{
														auto_pvs_paging(str);
													}
												}
											}
											else
											{
												flag_auto=true;
											}
										});
									});
									</script>";
	}
	
	return $shortcodes_wrapper;
}



/**
 * Shortcode [pvs_categories]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_categories( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;
	global $_REQUEST;
	
	$category_id = 0;
	if ( isset( $_REQUEST["id"] ) ) {
		$category_id = ( int )$_GET["id"];
	}
	if ( isset( $atts["id"] ) ) {
		$category_id = ( int )$atts["id"];
	}

	ob_start();
	include ( PVS_PATH . "templates/categories_content.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_categories', 'pvs_shortcodes_categories' );




/**
 * Shortcode [pvs_collections]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_collections( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;
	global $_REQUEST;

	ob_start();
	include ( PVS_PATH . "templates/collections_content.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_collections', 'pvs_shortcodes_collections' );





/**
 * Shortcode [pvs_packages]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_packages( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;
	global $_REQUEST;

	ob_start();
	include ( PVS_PATH . "templates/packages_content.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_packages', 'pvs_shortcodes_packages' );





/**
 * Shortcode [pvs_lightboxes]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_lightboxes( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;
	global $_REQUEST;

	ob_start();
	include ( PVS_PATH . "templates/lightboxes_content.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_lightboxes', 'pvs_shortcodes_lightboxes' );






/**
 * Shortcode [pvs_credits]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_credits( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;

	ob_start();
	include ( PVS_PATH . "templates/credits_buy.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_credits', 'pvs_shortcodes_credits' );






/**
 * Shortcode [pvs_subscription]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_subscription( $atts ){
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $pvs_global_settings;

	ob_start();
	include ( PVS_PATH . "templates/subscription_new.php" ); 
	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_subscription', 'pvs_shortcodes_subscription' );






/**
 * Shortcode [pvs_product]
 *
 * @param  array $atts shortcode attributes.
 * @return string
 */
function pvs_shortcodes_product( $atts ){
	global $db;
	global $rs;
	global $dr;
	global $dd;
	global $dn;
	global $ds;
	global $dq;
	global $pvs_global_settings;
	global $pvs_theme_content;
	global $mstocks;

	ob_start();
	if ( @ (int) $atts["id"] > 0 ) {

		if ( @ $atts["type"] == '' or @ $atts["type"] == 'file' ) {		
			set_query_var( 'pvs_id', @ (int) $atts["id"] );
			set_query_var( 'pvs_page', pvs_media_type ( @ (int) $atts["id"] ) );
		
			if (get_query_var('pvs_page') == 'photo') {
				require_once( PVS_PATH . 'templates/content_photo.php' );
			}
			
			if (get_query_var('pvs_page') == 'video') {
				require_once( PVS_PATH . 'templates/content_video.php' );
			}
			
			if (get_query_var('pvs_page') == 'audio') {
				require_once( PVS_PATH . 'templates/content_audio.php' );
			}
			
			if (get_query_var('pvs_page') == 'vector') {
				require_once( PVS_PATH . 'templates/content_vector.php' );
			}
		}
		
		if ( @ (int) $atts["type"] == 'print' ) {
			if ( @ (int) $atts["print_id"] > 0 ) {
				set_query_var( 'pvs_id', @ (int) $atts["id"] );
				set_query_var( 'pvs_print_id', @ (int) $atts["print_id"] );
				set_query_var( 'pvs_page', 'print' );
				require_once( PVS_PATH . 'includes/functions/header.php' );
				require_once( PVS_PATH . 'templates/content_print.php' );
			}
		}
		
		if ( @ (int) $atts["type"] == 'stock' ) {
			set_query_var( 'pvs_page', 'stockapi' );
			
			if ( @ $atts["stock_type"] == 'shutterstock' ) {
				set_query_var( 'shutterstock', @ (int) $atts["id"] );
				set_query_var( 'shutterstock_type', @ $atts["stock_content"] );
			}
			if ( @ $atts["stock_type"] == 'fotolia' ) {
				set_query_var( 'fotolia', @ (int) $atts["id"] );
				set_query_var( 'fotolia_type', @ $atts["stock_content"] );
			}
			if ( @ $atts["stock_type"] == 'istockphoto' ) {
				set_query_var( 'istockphoto', @ (int) $atts["id"] );
				set_query_var( 'istockphoto_type', @ $atts["stock_content"] );
			}
			if ( @ $atts["stock_type"] == 'depositphotos' ) {
				set_query_var( 'depositphotos', @ (int) $atts["id"] );
				set_query_var( 'depositphotos_type', @ $atts["stock_content"] );
			}
			if ( @ $atts["stock_type"] == 'bigstockphoto' ) {
				set_query_var( 'bigstockphoto', @ (int) $atts["id"] );
				set_query_var( 'bigstockphoto_type', @ $atts["stock_content"] );
			}
			if ( @ $atts["stock_type"] == '123rf' ) {
				set_query_var( 'rf123', @ (int) $atts["id"] );
				set_query_var( 'rf123_type', @ $atts["stock_content"] );
			}
			
			require_once( PVS_PATH . 'includes/functions/header.php' );

			if ( (int) get_query_var('shutterstock') > 0) {
				require_once( PVS_PATH . 'templates/content_shutterstock.php' );
			}
			
			if ( (int) get_query_var('fotolia') > 0) {
				require_once( PVS_PATH . 'templates/content_fotolia.php' );
			}
			
			if ( (int) get_query_var('istockphoto') > 0) {
				require_once( PVS_PATH . 'templates/content_istockphoto.php' );
			}
			
			if ( (int) get_query_var('depositphotos') > 0) {
				require_once( PVS_PATH . 'templates/content_depositphotos.php' );
			}
			
			if ( (int) get_query_var('bigstockphoto') > 0) {
				require_once( PVS_PATH . 'templates/content_bigstockphoto.php' );
			}
			
			if ( (int) get_query_var('rf123') > 0) {
				require_once( PVS_PATH . 'templates/content_123rf.php' );
			}
		}
	}

	return ob_get_clean(); 
}
 
add_shortcode( 'pvs_product', 'pvs_shortcodes_product' );
?>