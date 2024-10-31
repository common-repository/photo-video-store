<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>

<script>

//Add to cart on catalog listing
function add_cart(x) {
	flag_add=true;
	x_number=0;
	value=x;
    for(i=0;i<cart_mass.length;i++) {
		if(cart_mass[i]==x) {
			flag_add=false;
			x_number=i;
		}
	}
    
    if(flag_add)
    {
    	cart_mass[cart_mass.length]=x;
    	
    	jQuery.ajax({
			type:'POST',
			url:'<?php echo (site_url( ) );?>/shopping-cart-add-light/',
			data:'id=' + value,
			success:function(data){
				if(document.getElementById('shopping_cart')) {
					document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite')) {
					document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
				}
				if(document.getElementById('cart'+value.toString())) {
					document.getElementById('cart'+value.toString()).innerHTML ="<a href='javascript:add_cart("+value+");' class='ac2'><?php echo pvs_word_lang( "in your cart" )?></a>";
				}
				
				if(typeof reload_cart == 'function') 
				{
					reload_cart();
				}	
			}
		});
    }
    else
    {
   	 	cart_mass[x_number]=0;
   	 	
   	 	jQuery.ajax({
			type:'POST',
			url:'<?php echo (site_url( ) );?>/shopping-cart-delete-light/',
			data:'id=' + value,
			success:function(data){
				if(document.getElementById('shopping_cart')) {
					document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite')) {
					document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
				}
				if(document.getElementById('cart'+value.toString())) {
					document.getElementById('cart'+value.toString()).innerHTML ="<a href='javascript:add_cart("+value+");' class='ac'><?php echo pvs_word_lang( "add to cart" )?></a>";
				}
				
				if(typeof reload_cart == 'function') 
				{
					reload_cart();
				}	
			}
		});
    }
}




		jQuery(function(){
		jQuery('.preview_listing').each(function(){
     		jQuery(this).animate({opacity:'1.0'},1);
   			jQuery(this).mouseover(function(){
     		jQuery(this).stop().animate({opacity:'0.3'},600);
    		});
    		jQuery(this).mouseout(function(){
    		jQuery(this).stop().animate({opacity:'1.0'},300);
    		});
		});

		});
		
//Video mp4/mov preview
function lightboxon_istock(fl,width,height,event,rt) {
	rcontent="<video   width='"+width+"' height='"+height+"' autoplay controls><source src='"+fl+"' type='video/mp4'></video>";

	preview_moving(rcontent,width,height,event);
}

</script>