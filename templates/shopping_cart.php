<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>
<div class="page_internal">
<h1><?php echo pvs_word_lang( "shopping cart" );?></h1>


<script>

function cart_delete(value) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/shopping-cart-delete/',
		data:'id=' + value,
		success:function(data){
			document.getElementById('shopping_cart2').innerHTML = data;
			
			reload_flow('<?php echo site_url();?>');
			
   			if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}


function cart_change(value,value2,stock_limit) {
	qty = jQuery("#qty"+value).val()*1+value2;
    if(qty < 0)
    {
    	qty=0;
    }
      
    if(stock_limit != -1 && qty > stock_limit)
    {
    	flag = false;
    }
    else
    {
    	 flag = true;
    }
	
	if(flag) {
		jQuery.ajax({
			type:'POST',
			url:'<?php echo (site_url( ) );?>/shopping-cart-change/',
			data:'id=' + value + '&qty=' + qty,
			success:function(data){
				document.getElementById('shopping_cart2').innerHTML =data;
				
				reload_flow('<?php echo site_url();?>');
			
				if(typeof set_styles == 'function') 
				{
					set_styles();
				}
			}
		});	
    }
}

function cart_add(value,value2) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/shopping-cart-change-new/',
		data:'id=' + value + '&id2=' + value2,
		success:function(data){
			document.getElementById('shopping_cart2').innerHTML = data;
			
			reload_flow('<?php echo site_url(); ?>');
			
   			if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}


function cart_clear(value) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/shopping-cart-clear/',
		data:'id=' + value,
		success:function(data){
			document.getElementById('shopping_cart2').innerHTML = data;
			
			reload_flow('<?php echo site_url(); ?>');
			
   			if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}


function cart_change_option(value2,value3,value4,value5) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/shopping-cart-change-option/',
		data:'id=' + value2+'&i=' + value3 + '&option_id=' + value4 + '&option_value=' + value5,
		success:function(data){
			document.getElementById('shopping_cart2').innerHTML = data;
			
			reload_flow('<?php echo site_url(); ?>');
			
   			if(typeof set_styles == 'function') 
			{
   				set_styles();
   			}
		}
	});
}

</script>
<link href="<?php echo(pvs_plugins_url());?>/includes/prints/style.css" rel="stylesheet">


<?php
if ( pvs_get_user_type () == "buyer" or
	pvs_get_user_type () == "common" ) {
?>
	<div id="shopping_cart2" name="shopping_cart2"><?php
	include ( "shopping_cart_content.php" );?></div>
	<br><br>
<?php
} else
{
?>
	<p><b><?php echo pvs_word_lang( "the seller may not buy items" );?></b></p>
<?php
}
?>
</div>
