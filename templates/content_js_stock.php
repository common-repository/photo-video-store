<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>
<script>
//Add stock print in the cart
function prints_stock(stock_type,stock_id,stock_url,stock_preview,stock_site_url,stock_title) {
    jQuery.ajax({
		type:'POST',
		url:'<?php echo site_url()?>/shopping-cart-add-prints-stock/',
		data:{stock_type:stock_type,stock_id:stock_id,stock_url:stock_url,stock_preview:stock_preview,stock_site_url:stock_site_url,print_id:document.getElementById('cartprint').value,stock_title:stock_title},
		success:function(data){
			if(document.getElementById('shopping_cart'))
			{
				document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
			}
			if(document.getElementById('shopping_cart_lite'))
			{
				document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
			}
			
			<?php
			if ( ! $pvs_global_settings["prints_previews"] ) {
			?>
				if(jQuery.fn.modal) 
				{
					jQuery('.modal-content').not('.modal-content2').html(data.cart_content);
					jQuery('#modal_window').modal('show');
				}
			<?php
			} else
			{
			?>
				location.href = data.redirect_url;
				<?php
			}
			?>
			
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


function apanel(x) {
	if(x == 0) {
		document.getElementById('prices_files').style.display = 'block';
		document.getElementById('prices_prints').style.display = 'none';
	}
	else {
		document.getElementById('prices_files').style.display = 'none';
		document.getElementById('prices_prints').style.display = 'block';
	}
}


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

//Show added prints
function xprint(x) {

	printitems=new Array();
	<?php
	$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
		"prints order by priority";
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
				document.getElementById('cartprint').value =x;
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
	        if (aRadio[i].value == x) 
	        {
	        	aRadio[i].checked = true; 
	        }
	    } 

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
</script>