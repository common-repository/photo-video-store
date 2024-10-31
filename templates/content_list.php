<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

include ( "content_list_vars.php" );?>


</div>

<style>
/*New styles for the previews. It overwrites style.css file.*/
.item_list 
{ 
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

.item_list_img
{
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
	height: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

.item_list_text1,.item_list_text2,.item_list_text3,.item_list_text4
{
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

.second_page
{
min-height:0px
}

<?php
if ( @$stock != "site" ) {
?>
	<?php
	if ( @$stock != "fotolia" and @$stock != "depositphotos" and @$stock !=
		"pixabay" ) {
?>
		.iviewed,.idownloaded
		{
		display:none;
		}
	<?php
	}
?>
	
	.action-control,.fa-heart-o,li.hb_lightbox
	{
	display:none;
	}
	
	.preview_listing
	{
	max-width:120px;
	max-height:120px;
	}
	
<?php
}
?>
</style>
<?php
if ( @$prints_flag ) {
?>
	<link href="<?php echo pvs_plugins_url()?>/includes/prints/style.css" rel="stylesheet">
	<?php
}
?>

<?php

$search_header = '<div class="row" id="search_columns" style="margin-left:30px;width:95%"><div class="col-xl-3 col-lg-3 col-md-3 search_left panel_left">';
$search_middle = '</div><div class="col-xl-9 col-lg-9 col-md-9 search_right panel_right">';
$search_footer = '</div></div>';
?>


<?php
if ( $showmenu == 1 and $pvs_global_settings["left_search"] ) {
	echo ( $search_header );

	if ( $stock == 'site' ) {
		include ( "content_list_menu.php" );
	}

	if ( $stock == 'istockphoto' ) {
		include ( "content_list_menu_istockphoto.php" );
	}

	if ( $stock == 'shutterstock' ) {
		include ( "content_list_menu_shutterstock.php" );
	}

	if ( $stock == 'fotolia' ) {
		include ( "content_list_menu_fotolia.php" );
	}

	if ( $stock == 'depositphotos' ) {
		include ( "content_list_menu_depositphotos.php" );
	}

	if ( $stock == 'rf123' ) {
		include ( "content_list_menu_123rf.php" );
	}

	if ( $stock == 'bigstockphoto' ) {
		include ( "content_list_menu_bigstockphoto.php" );
	}

	if ( $stock == 'pixabay' ) {
		include ( "content_list_menu_pixabay.php" );
	}

	if ( $stock == 'adobe' ) {
		include ( "content_list_menu_adobe.php" );
	}
	
	echo ( $search_middle );
}


//Show menu
include ( "content_list_menu_top.php" );


if ( $flow == 1 ) {
?>
	<script src="<?php echo(pvs_plugins_url() . '/assets/js/jquery.masonry.min.js'); ?>"></script>
	<script>
	jQuery(document).ready(function(){
	
		jQuery('#flow_body').masonry({
  		itemSelector: '.home_box'
		});
		
		jQuery('.home_preview').each(function(){


     		jQuery(this).animate({opacity:'1.0'},1);
   			jQuery(this).mouseover(function(){
     		jQuery(this).stop().animate({opacity:'0.6'},600);
    		});
    		jQuery(this).mouseout(function(){
    		jQuery(this).stop().animate({opacity:'1.0'},300);
    		});

    		
    		jQuery(".hb_cart").mouseover(function(){
     			jQuery(this).stop().animate({ opacity: 1}, 600);

    		});

    		jQuery(".hb_cart").mouseout(function(){
    			jQuery(this).stop().animate({ opacity: 0.5}, 600);
    		});
 		
    		<?php
				if ( @$stock == "site" ) {
			?>
    		 jQuery(".hb_lightbox").mouseover(function(){
     			jQuery(this).stop().animate({ opacity: 1}, 600);
    		});

    		jQuery(".hb_lightbox").mouseout(function(){
    			jQuery(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		<?php
				}
			?>
    		
    		 jQuery(".hb_free").mouseover(function(){
     			jQuery(this).stop().animate({ opacity: 1}, 600);
    		});

    		jQuery(".hb_free").mouseout(function(){
    			jQuery(this).stop().animate({ opacity: 0.5}, 600);
    		});
        

		});
	});
	</script>
	<?php
}

if ( $flow == 2 ) {
?>
	<script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/jquery.collagePlus.min.js"></script>
	<script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/extras/jquery.removeWhitespace.js"></script>
    <script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/extras/jquery.collageCaption.js"></script>
	<script>
	jQuery(document).ready(function(){
	
	

	
		refreshCollagePlus();
		
		jQuery('.home_preview').each(function(){
     		jQuery(this).animate({opacity:'1.0'},1);
   			jQuery(this).mouseover(function(){
     		jQuery(this).stop().animate({opacity:'0.6'},600);
    		});
    		jQuery(this).mouseout(function(){
    		jQuery(this).stop().animate({opacity:'1.0'},300);
    		});
    	});
	});
	

	
	function refreshCollagePlus() {
    	jQuery('.item_list_page').removeWhitespace().collagePlus({
        	'targetHeight'    : <?php echo $pvs_global_settings["height_flow"] ?>,
            'fadeSpeed'       : "slow",
            'effect'          : 'default',
            'direction'       : 'vertical',
            'allowPartialLastRow'       : true
    	});
	}
	
	// This is just for the case that the browser window is resized
    var resizeTimer = null;
    jQuery(window).bind('resize', function() {
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
	<link rel="stylesheet" type="text/css" href="<?php echo pvs_plugins_url()?>/assets/js/collageplus/css/transitions.css" media="all" />
	<?php
}

if ( $autopaging == 1 ) {
?>
	<script>
	str=2;
	flag_auto=true;
	res=" ";
	
	function auto_pvs_paging(page) {
		str=page;
	
    	jQuery.ajax({
			type:'POST',
			url:'<?php echo site_url()?>/content-list-paging/',
			data:'str='+str+'&id_parent=<?php echo (int)@$id_parent ?><?php echo pvs_build_variables( "str", "", false, "", false ) ?>',
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
					check_carts('<?php echo pvs_word_lang( "in your cart" )?>');
				}
		
				<?php
				if ( $flow == 1 ) {
				?>
					jQuery('#flow_body').masonry({
					itemSelector: '.home_box'
					});
				
					jQuery('#flow_body').masonry('reload') ;
					
				<?php
				}
				if ( $flow == 2 ) {
				?>
					refreshCollagePlus();
				<?php
				}
				?>
				
				
				jQuery('.home_preview').each(function(){	
					jQuery(this).animate({opacity:'1.0'},1);
					jQuery(this).mouseover(function(){
					jQuery(this).stop().animate({opacity:'0.6'},600);
					});
					jQuery(this).mouseout(function(){
					jQuery(this).stop().animate({opacity:'1.0'},300);
					});
		
					
					jQuery(".hb_cart").mouseover(function(){
						jQuery(this).stop().animate({ opacity: 1}, 600);
		
					});
		
					jQuery(".hb_cart").mouseout(function(){
						jQuery(this).stop().animate({ opacity: 0.5}, 600);
					});
					
					jQuery(".hb_cart2").mouseover(function(){
						jQuery(this).stop().animate({ opacity: 1}, 600);
					});
		
					jQuery(".hb_cart2").mouseout(function(){
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
					if(res!="")
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
	</script>
	<?php
}
?>


<div class='item_list_page' id="flow_body" style="display:block">
	<?php
$search_content = pvs_word_lang( "not found" );

if ( $stock == 'site' ) {

	if ( $pvs_global_settings["elasticsearch"] and $pvs_global_settings["elasticsearch_search"] and ! isset( $_REQUEST["collection"] ) and ! isset( $_REQUEST["lightbox"] ) and pvs_get_password_protected() == '') {
		include ( "content_list_elasticsearch.php" );
	} else {
		include ( "content_list_items.php" );	
	}
}

if ( $stock == 'istockphoto' ) {
	include ( "content_list_istockphoto.php" );
}

if ( $stock == 'shutterstock' ) {
	include ( "content_list_shutterstock.php" );
}

if ( $stock == 'fotolia' ) {
	include ( "content_list_fotolia.php" );
}

if ( $stock == 'depositphotos' ) {
	include ( "content_list_depositphotos.php" );
}

if ( $stock == 'rf123' ) {
	include ( "content_list_123rf.php" );
}

if ( $stock == 'bigstockphoto' ) {
	include ( "content_list_bigstockphoto.php" );
}

if ( $stock == 'pixabay' ) {
	include ( "content_list_pixabay.php" );
}

if ( $stock == 'adobe' ) {
	include ( "content_list_adobe.php" );
}

//Show result
echo ( $search_content );?>
</div>

<script>
check_carts('<?php echo pvs_word_lang( "in your cart" )?>');
</script>


<?php
//Stock results count
if ( $stock != 'site' or  ($pvs_global_settings["elasticsearch"] and $pvs_global_settings["elasticsearch_search"])) {
	$paging_text = pvs_paging( ( int )@$stock_result_count, $str, $kolvo, $kolvo2,
		$redirect_page, pvs_build_variables( "str", "", false ), false, true );

	if ( ( int )@$stock_result_count > $kolvo and @$autopaging == 0 ) {
?>
	<div id="search_footer">
		<div id="search_paging2"><?php echo $paging_text
?></div>
	</div>
	<?php
	}
?>
	<script>
		function show_results_count() {
			jQuery('#result_count').html('(<?php echo ( int )@$stock_result_count
?>)')
		}
		show_results_count()
	</script>
	<?php
} else
{
	if ( $record_count > $kolvo and @$autopaging == 0 ) {
?>
	<div id="search_footer">
		<div id="search_paging2"><?php echo $paging_text
?></div>
	</div>
	<?php
	}
}
?>


<?php
if ( $showmenu == 1 and $pvs_global_settings["left_search"] ) {
	echo ( $search_footer );
}
?>

<div>