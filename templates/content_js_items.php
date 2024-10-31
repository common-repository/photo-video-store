<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

if ( $pvs_global_settings["google_coordinates"] ) {
?>
	<script src="https://maps.google.com/maps/api/js?sensor=true&key=<?php echo $pvs_global_settings["google_api"] ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/min/jquery.ui.map.min.js"></script>
	<script>
	function map_show(x,y) {
		document.getElementById('reviewscontent').style.display='none';
			document.getElementById('reviewscontent').innerHTML ="<div id='map'></div>";
			 pos=x+","+y;
			 jQuery('#map').gmap({'zoom':11, 'center': pos}).bind('init', function(ev, map) {
				jQuery('#map').gmap('addMarker', { 'position': map.getCenter(), 'bounds': false})
			});
	}
	</script>
<?php
}
?>

<script>
    jQuery(function() {
      jQuery.fn.raty.defaults.path = '<?php echo pvs_plugins_url()?>/assets/js/raty/img';

      jQuery('.star').raty({ score: 5 });
      
    });
    
    function vote_rating(id,score)
    {
    	<?php
		if ( ! is_user_logged_in() and $pvs_global_settings["auth_rating"] ) {
		?>	
			location.href='<?php echo site_url()?>/login/';
		<?php
		} else {
		?>
    		jQuery.ajax({
				type:'POST',
				url:'<?php echo (site_url( ) );?>/vote-add/',
				data:'id=' + id + '&vote=' + score,
				success:function(data){

				}
			});
    	<?php
		}
		?>
   	}
</script>


<script>
	 
	function like_dislike(value)
    {
    	<?php
		if ( ! is_user_logged_in() and $pvs_global_settings["auth_rating"] ) {
		?>	
			location.href='<?php echo site_url()?>/login/';
		<?php
		} else {
		?>
    		jQuery.ajax({
				type:'POST',
				url:'<?php echo site_url()?>/like/',
				data:'id=<?php echo ( int )get_query_var('pvs_id')?>&vote=' + value,
				success:function(data){
					if(data != "") {
						if(value>0)
						{
							document.getElementById('vote_like').innerHTML = data
						}
						else
						{
							document.getElementById('vote_dislike').innerHTML = data
						}
					}		
				}
			});
    	<?php
		}
		?>
   	}



    jQuery(function(){ 
        jQuery('.like-btn').click(function(){
            jQuery('.dislike-btn').removeClass('dislike-h');    
            jQuery(this).addClass('like-h');
			like_dislike(1);
        });
        jQuery('.dislike-btn').click(function(){
            jQuery('.like-btn').removeClass('like-h');
            jQuery(this).addClass('dislike-h');
			like_dislike(-1)
        });
    });




//Rights-managed photos
function rights_managed(id) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo site_url()?>/rights-managed/',
		data:'id=' + id,
		success:function(data){
			if(jQuery.fn.modal) 
			{
				jQuery('.modal-content').not('.modal-content2').html(data.cart_content);
				jQuery('#modal_window').modal('show');
			}
	
			if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}

//Rights-managed photos
function change_rights_managed(publication_id,price_id,option_id,option_value) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/rights-managed-change/',
		data:'publication_id=' + publication_id + '&price_id=' + price_id + '&option_id=' + option_id + '&option_value=' + option_value,
		success:function(data){
			next_options=data.next_options;
			list_options=next_options.split("-");
			jQuery(".group_box").css("display","none");
			
			flag_finish=true;
			
			for(i=0;i<list_options.length;i++) {
				if(document.getElementById("group_box"+list_options[i])) {
					document.getElementById("group_box"+list_options[i]).style.display='block';
					if(document.getElementById("group"+list_options[i]).value==0)
					{
						flag_finish=false;
					}
				}
			}	
			
			document.getElementById('rights_managed_price').innerHTML = data.price;
			
			if(flag_finish) {
				jQuery('.modal-footer').css("display","block");
				jQuery('#price_box').css("display","block");
			}
			else {
				jQuery('.modal-footer').css("display","none");
				jQuery('#price_box').css("display","none");
			}
		}
	});
}

cartitems=new Array();
cartprices=new Array();
<?php
$sql = "select id,price from " . PVS_DB_PREFIX . "items where id_parent=" . ( int )get_query_var('pvs_id') .
	" order by priority";
$rs->open( $sql );
$nn = 0;
while ( ! $rs->eof ) {
?>
		cartitems[<?php echo $nn ?>]=<?php echo $rs->row["id"] ?>;
		cartprices[<?php echo $rs->row["id"] ?>]=<?php echo $rs->row["price"] ?>;
		<?php
	$nn++;
	$rs->movenext();
}
?>

//The function adds an item into the shopping cart
function add_cart(x) {
	if(x==0) {
		value=document.getElementById("cart").value;
	}
	if(x==1) {
		value=document.getElementById("cartprint").value;
	}
    
    // Code automatically called on load finishing.
    if(cartprices[value]==0 && x==0)
    {
    	location.href="<?php echo site_url()?>/count/?type=<?php echo get_query_var('pvs_page') ?>&id="+document.getElementById("cart").value+"&id_parent=<?php echo ( int )@get_query_var('pvs_id') ?>";
    }
    else
    {
   	 	jQuery.ajax({
			type:'POST',
			url:'<?php echo site_url()?>/shopping-cart-add/',
			data: 'id='+ value + '&_wpnonce=<?php echo wp_create_nonce( 'pvs-shopping-cart-add' ); ?>',
			success:function(data){
				if(document.getElementById('shopping_cart')) {
					document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite')) {
					document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
				}
				
				if(x==1) {
					<?php
					if ( ! $pvs_global_settings["prints_previews"] ) {
					?>
						if(jQuery.fn.modal) 
						{
							jQuery('.modal-content').not('.modal-content2').html(data.cart_content);
							jQuery('#modal_window').modal('show');
						}
					<?php
					} else {
					?>
						location.href = data.redirect_url
					<?php
					}
					?>
				}
				else 
				{
					<?php
					if ( $pvs_global_settings["no_cart"] ) {
					?>
						location.href = '<?php echo site_url()?>/checkout/';
					<?php
					} else {
					?>
						if(jQuery.fn.modal) 
						{
							jQuery('.modal-content').not('.modal-content2').html(data.cart_content);
							jQuery('#modal_window').modal('show');
						}
					<?php
					}
					?>
				}
				
				if(typeof set_styles == 'function') 
				{
					set_styles();
				}
				
				if(typeof reload_cart == 'function') 
				{
					reload_cart();
				}	
			}
		});
	}
}


//Paypal payment
function paypal_payment()
{
	if(cartprices[document.getElementById("cart").value]==0)
    {
    	location.href="<?php echo site_url()?>/count/?type=<?php echo get_query_var('pvs_page') ?>&id="+document.getElementById("cart").value+"&id_parent=<?php echo ( int )@get_query_var('pvs_id') ?>";
    }
    else
    {
		location.href="<?php echo site_url()?>/payment-process/?payment=paypal&item_id="+document.getElementById("cart").value+"&publication_id=<?php echo ( int )@get_query_var('pvs_id') ?>";
	}
}


//The function shows prints previews

function show_prints_preview(id) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/prints-preview/',
		data:'id=' + id,
		success:function(data){
        	if(jQuery.fn.modal) 
			{
				jQuery('.modal-content').not('.modal-content2').html(data.prints_content);
				jQuery('#modal_window').modal('show');
			}
        	
        	if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}





//The function shows a download link
function add_download(a_type,a_parent,a_server) {
	if(document.getElementById("cart")) {
		location.href="<?php echo site_url()?>/count/?type="+a_type+"&id="+document.getElementById("cart").value+"&id_parent="+a_parent+"&server="+a_server;
	}
}




//Show reviews
function reviews_show(value) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/reviews-content/',
		data:'id=' + value,
		success:function(data){
			if(document.getElementById('comments_content'))
			{
				document.getElementById('comments_content').innerHTML =data;
			}
		}
	});
}


//Show EXIF
function exif_show(value) {
  	jQuery.ajax({
		type:'POST',
		url:'<?php echo site_url()?>/exif/',
		data:'id=' + value,
		success:function(data){
			if(document.getElementById('exif_content'))
			{
				document.getElementById('exif_content').innerHTML = data;
			}
		}
	});
}

//Add a new review
function reviews_add(value) {
	var form_vars   = jQuery('#' + value).serialize();
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/reviews-content/',
		data: form_vars,
		success:function(data){
			if(document.getElementById('comments_content'))
			{
				document.getElementById('comments_content').innerHTML = data;
			}
		}
	});
}



//Hide reviews
function reviews_hide() {
	document.getElementById('reviewscontent').innerHTML ="";
	jQuery("#reviewscontent").slideUp("slow");
}






//Show pixels/inches
function show_size(value) {
	if(jQuery('#link_size1_'+value).hasClass('link_pixels')) {
		jQuery('#p'+value+' div.item_pixels').css({'display':'none'});
		jQuery('#p'+value+' div.item_inches').css({'display':'block'});
		jQuery('#link_size1_'+value).removeClass("link_pixels");
		jQuery('#link_size1_'+value).addClass("link_inches");
		jQuery('#link_size2_'+value).removeClass("link_inches");
		jQuery('#link_size2_'+value).addClass("link_pixels");
	}
	else {
		jQuery('#p'+value+' div.item_pixels').css({'display':'block'});
		jQuery('#p'+value+' div.item_inches').css({'display':'none'});
		jQuery('#link_size1_'+value).removeClass("link_inches");
		jQuery('#link_size1_'+value).addClass("link_pixels");
		jQuery('#link_size2_'+value).removeClass("link_pixels");
		jQuery('#link_size2_'+value).addClass("link_inches");
	}
}





//Show tell a friend
function tell_show(value) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo site_url()?>/tell-a-friend/',
		data:'id=' + value,
		success:function(data){
			if(document.getElementById('tell_content'))
			{
				document.getElementById('tell_content').innerHTML =data;
			}
		}
	});
}


//Show tell a friend form
function tell_add() {  
    jQuery.ajax({
		type:'POST',
		url:'<?php echo site_url()?>/tell-a-friend/',
		data:'id=' + jQuery('#tell_id').val()+'&name1=' + jQuery('#tell_name').val()+'&email=' + jQuery('#tell_email').val()+'&name2=' + jQuery('#tell_name2').val()+'&email2=' + jQuery('#tell_email2').val()+'&rn1=' + jQuery('#tell_rn1').val()+'&rn2=' + jQuery('#tell_rn2').val(),
		success:function(data){
			if(document.getElementById('tell_content'))
			{
				document.getElementById('tell_content').innerHTML =data;
			}
		}
	});
}





//Show prices by license
function apanel(x) {

	sizeboxes=new Array();
	<?php
	$sql = "select id_parent from " . PVS_DB_PREFIX . "licenses order by priority";
	$rs->open( $sql );
	$nn = 0;
	while ( ! $rs->eof ) {
	?>
		sizeboxes[<?php echo $nn ?>]=<?php echo $rs->row["id_parent"] ?>;
	<?php
		$nn++;
		$rs->movenext();
	}
	
	if ( ( get_query_var('pvs_page') == 'photo' or get_query_var('pvs_page') == 'vector' ) and $pvs_global_settings["prints"] ) {
	?>
			//Prints
			sizeboxes[<?php echo $nn ?>]=0;
	<?php
	}
	?>
	
	//Rights managed and Contact Us
	if(document.getElementById("license1")) {
		sizeboxes[sizeboxes.length]=1;
	}
	
	//Hide item cart button
	if(document.getElementById("item_button_cart")) {
		if(x==0) {
			document.getElementById("item_button_cart").style.display='none';
		}
		else
		{
			document.getElementById("item_button_cart").style.display='block';
		}
	}

	for(i=0;i<sizeboxes.length;i++) {
		if(document.getElementById('p'+sizeboxes[i].toString())) {
			if(sizeboxes[i]==x)
			{
				document.getElementById('p'+sizeboxes[i].toString()).style.display ='inline';
			}
			else
			{
				document.getElementById('p'+sizeboxes[i].toString()).style.display ='none';
			}
		}
	}
}



//Show added items 
function xcart(x) {
	for(i=0;i<cartitems.length;i++) {
		if(document.getElementById('tr_cart'+cartitems[i].toString())) {
			if(cartitems[i]==x)
			{
				document.getElementById('tr_cart'+cartitems[i].toString()).className ='tr_cart_active';
				document.getElementById('cart').value =x;
			}
			else
			{
				document.getElementById('tr_cart'+cartitems[i].toString()).className ='tr_cart';
			}
		}
	}

	var aRadio = document.getElementsByTagName('input'); 
	for (var i=0; i < aRadio.length; i++)
	{ 
		if (aRadio[i].type != 'radio') continue; 
		if (aRadio[i].value == x) aRadio[i].checked = true; 
	} 
}




//Show added prints
function xprint(x) {

	printitems=new Array();
	<?php
	$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
		"prints_items where itemid=" . ( int )get_query_var('pvs_id') . " order by priority";
	$rs->open( $sql );
	$nn = 0;
	while ( ! $rs->eof ) {
	?>
			printitems[<?php echo $nn ?>]=<?php echo $rs->row["id_parent"] ?>;
			<?php
		$nn++;
		$rs->movenext();
	}
	?>

	for(i=0;i<printitems.length;i++) {
		if(document.getElementById('tr_cart'+printitems[i].toString())) {
			if(printitems[i]==x)
			{
				document.getElementById('tr_cart'+printitems[i].toString()).className ='tr_cart_active';
				document.getElementById('cartprint').value =-1*x;
			}
			else
			{
				document.getElementById('tr_cart'+printitems[i].toString()).className ='tr_cart';
			}
		}
	}

	var aRadio = document.getElementsByTagName('input'); 
	for (var i=0; i < aRadio.length; i++)
	{ 
		if (aRadio[i].type != 'radio') continue; 
		if (aRadio[i].value == -1*x) 
		{
			aRadio[i].checked = true; 
		}
	} 
}

		
//Video mp4/mov preview
function lightboxon_istock(fl,width,height,event,rt) {
	rcontent="<video   width='"+width+"' height='"+height+"' autoplay controls><source src='"+fl+"' type='video/mp4'></video>";

	preview_moving(rcontent,width,height,event);
}


function show_more(value) {
	if(jQuery.fn.modal) 
	{
		jQuery(".modal-content").not('.modal-content2').load(value);
		jQuery(".modal-content").not('.modal-content2').modal({
		  backdrop: false
		});
	}
}


//Print's quantity
function quantity_change(value,quantity_limit) {
	quantity = jQuery("#quantity").val()*1+value;
	
	if(quantity< 0) {
		quantity = 0;
	}
	
	if(quantity> quantity_limit && quantity_limit != -1) {
		quantity = quantity_limit;
	}
	
	jQuery("#quantity").val(quantity);
}




function show_package(id,print_id) {
	jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/package-show/',
		data:'id=' + id+'&print_id='+print_id,
		success:function(data){
		 	results = JSON.parse(data);
			if(jQuery.fn.modal) 
			{
				jQuery('.modal-content').not('.modal-content2').html(results["package_message"]);
				jQuery('#modal_window').modal('show');
			}
			set_styles();
		}
	});
}


function package_add(id,cart_content_id,print_id) {
	jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/package-show-add/',
		data:'id=' + id + '&cart_content_id=' + cart_content_id+'&print_id='+print_id,
		success:function(data){
			if ( data == 0) {
				jQuery(".warning").html("");
				jQuery(".warning").css("display","none");			
				show_package(id,print_id);
			}
			if ( data == 1) {
				jQuery(".warning").html("<?php echo pvs_word_lang( "Error. You may not attach the file to the package" )?>");
				jQuery(".warning").css("display","block");
			}
		}
	});
}

function package_delete(id,cart_content_id,print_id) {
	jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/package-show-delete/',
		data:'id=' + id + '&cart_content_id=' + cart_content_id+'&print_id='+print_id,
		success:function(data){
			if ( data == 0) {
				show_package(id,print_id);
			}
		}
	});
}
</script>