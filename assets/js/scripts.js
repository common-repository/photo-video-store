function definesize(param) 
{
	if(param==1) {
		return jQuery(window).width();
	}
	else {
		return jQuery(window).height();
	}
}



//Move a hover
function lightboxmove(width,height,event) {
	dd=document.getElementById("lightbox")

	x_coord=event.clientX;
	y_coord=event.clientY;
	
	if ( jQuery('#adminmenuwrap').length > 0) {
		x_coord -= jQuery('#adminmenuwrap').width();
	}

	scroll_top=jQuery(document).scrollTop();

	if(definesize(1)-x_coord-width>0) {
		param_left=x_coord;
	}
	else {
		param_left=x_coord-width;
	}

	if(definesize(2)-y_coord-height>0) {
		param_top=y_coord+scroll_top;
	}
	else {
		param_top=y_coord+scroll_top-height;
		if(param_top-scroll_top<0) {
			param_top=scroll_top;
		}
	}

	p_top=param_top.toString()+"px";
	p_left=param_left.toString()+"px";

	dd.style.top=p_top
	dd.style.left=p_left
	dd.style.zIndex=10000000000000000000
}


function lightboxoff() {
	dd=document.getElementById("lightbox")
	dd.innerHTML="";
	dd.style.display="none";
}


//Make a hover visible and insert an appropriate content
function preview_moving(rcontent,width,height,event) {
	dd=document.getElementById("lightbox");
	dd.style.width=width+2;
	dd.style.width=height+2;
	dd.innerHTML=rcontent;
	jQuery('#lightbox').fadeIn(500);

	lightboxmove(width,height,event);
}


//Photo preview
function lightboxon(fl,width,height,event,rt,title,author) {

	rcontent="<div style=\"position:relative;width:"+width+"px;height:"+height+"px;background: url('"+fl+"');background-size:cover;background-position:center center;border: 1px #1f1f1f solid;\"><div class='hover_string' style='position:absolute;left:0;bottom:0;right:0'><p>"+title+"</p><span>"+author+"</span></div></div>";

	preview_moving(rcontent,width,height,event)
}






//Video flv preview
function lightboxon3(fl,width,height,event,rt) {
	rcontent="<object classid='CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000'  style='width:"+width+"px;height:"+height+"px;' codebase='http://active.macromedia.com/flash2/cabs/swflash.cab#version=8,0,0,0'><param name='movie' value='"+rt+"/assets/images/movie.swf?url="+fl+"&autoplay=true&loop=true&controlbar=false&sound=true&swfborder=true' /><param name='quality' value='high' /><param name='scale' value='exactfit' /><param name='menu' value='true' /><param name='bgcolor' value='#FFFFFF' /><param name='video_url' value=' ' /><embed src='"+rt+"/assets/images/movie.swf?url="+fl+"&autoplay=true&loop=true&controlbar=false&sound=true&swfborder=true' quality='high' scale='exactfit' menu='false' bgcolor='#FFFFFF' style='width:"+width+"px;height:"+height+"px;' swLiveConnect='false' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash'></embed></object>";

	preview_moving(rcontent,width,height,event);
}







//audio preview
function lightboxon4(fl,width,height,event,rt) {
	rcontent="<audio src="+fl+" type='audio/mp3' autoplay controls></audio>";s

	preview_moving(rcontent,width,height,event);
}



//Video mp4/mov preview
function lightboxon5(fl,width,height,event,rt) {
	rcontent="<video   width='"+width+"' height='"+height+"' autoplay controls><source src='"+fl+"' type='video/mp4'></video>";

	preview_moving(rcontent,width,height,event);
}




//Youtube preview
function lightboxon_youtube(fl,width,height,event,rt,title,author) {
	
	rcontent='<iframe width="' + width + '" height="' + height + '" src="https://www.youtube.com/embed/' + fl + '?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

	preview_moving(rcontent,width,height,event)
}

//Vimeo preview
function lightboxon_vimeo(fl,width,height,event,rt,title,author) {

	rcontent='<iframe src="https://player.vimeo.com/video/' + fl + '?autoplay=1&loop=1" width="' + width + '" height="' + height + '" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

	preview_moving(rcontent,width,height,event)
}




function change_color(value) {

	color_mass=new Array("black","white","red","green","blue","magenta","cian","yellow","orange");
	for(i=0;i<color_mass.length;i++) {
		if(color_mass[i]==value) {
			document.getElementById("color_"+color_mass[i]).className='box_color2';
		}
		else
		{
			document.getElementById("color_"+color_mass[i]).className='box_color';
		}
	}
	document.getElementById("color").value=value;
}


function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
    }



function my_form_validate() {
	flag_validate=true;
	flag_scrolling=true;
	
	for(i=0;i<form_fields.length;i++) {
		flag_current=true;
		
		if(jQuery('#'+form_fields[i]).val()=="") {	
			flag_validate=false;
			flag_current=false;			
		}

		if(fields_emails[i]==1) {
			if(!isValidEmailAddress(jQuery('#'+form_fields[i]).val()))
   			{
				flag_validate=false;
				flag_current=false;
			}
		}
		
		if(!flag_current) {			
			//jQuery('#'+form_fields[i]).removeClass("ibox");
			//jQuery('#'+form_fields[i]).addClass("ibox_error");
			
			if(flag_scrolling)
			{
				jQuery(window).scrollTo(jQuery('#'+form_fields[i]).offset().top-100,1000, {axis:'y'} );
				flag_scrolling=false;
			}
	/*		
				jQuery('#'+form_fields[i]).qtip({
   				content: error_message,
				show: { ready: true },
				hide: {fixed:true},
				position: {    
					corner: {
     					target: 'topRight',
         				tooltip: 'bottomLeft'
   					},
   					adjust: { x: 10, y: 30 } 
   				},
   				style: { 
      				width: 150,
      				padding: 3,
     				background: '#febbc9',
      				color: '#6a1414',
     				 textAlign: 'center',
     				 border: {
         				width: 0,
         				radius: 5,
         				color: '#febbc9'
      				},
     				 tip: 'leftMiddle',
     				 name: 'dark'
  				 }
			});
			*/
		}
		else
		{
			
			if(jQuery('#'+form_fields[i]).attr('class')=="ibox_error")
			{
				//jQuery('#'+form_fields[i]).removeClass("ibox_error");
				//jQuery('#'+form_fields[i]).addClass("ibox_ok");
				//jQuery('#'+form_fields[i]).qtip("destroy");
			}
			
		}
	}	
	return flag_validate;
}




function show_lightbox(id,site_root) {
    jQuery.ajax({
		type:'POST',
		url:site_root+'/lightbox-show/',
		data:'id=' + id,
		success:function(data){
        	if(data.authorization==1)
        	{
        		if(jQuery.fn.modal) 
				{
					jQuery('.modal-content').not('.modal-content2').html(data.lightbox_message);
					jQuery('#modal_window').modal('show');
				}
        		set_styles();
        	}
        	else
        	{
        		document.getElementById('lightbox_menu_error').innerHTML=data.lightbox_message;
        		jQuery('#lightbox_menu_error').css({'top':20,'left':'40%','right':'40%'});
        		jQuery('#lightbox_menu_error').fadeIn(3000);
        		setTimeout(function(){
      				jQuery('#lightbox_menu_error').fadeOut(3000);
   				 }, 2000);
        	}
		}
	});
}



function pvs_lightbox_add(site_root) {
    if(jQuery("#new_lightbox").attr("checked") == 'checked' && document.getElementById("new").value=="") {
		document.getElementById("new").className='ibox_error';
	}
	else {
		var form_vars   = jQuery('#lightbox_form').serialize();
		jQuery.ajax({
			type:'POST',
			url:site_root+'/lightbox-add/',
			data:form_vars,
			success:function(data){
				if(jQuery.fn.modal) 
				{			
					jQuery('#modal_window').modal('hide');
				}
				document.getElementById('lightbox_menu_ok').innerHTML=data.result_code;
				jQuery('#lightbox_menu_ok').css({'top':20,'left':'40%','right':'40%'});
				jQuery('#lightbox_menu_ok').fadeIn(3000);
				setTimeout(function(){
					jQuery('#lightbox_menu_ok').fadeOut(3000);
				}, 2000);	
			}
		});	
    }
}



function pvs_shopping_cart_add(site_root,next_action) {
	var form_vars   = jQuery('#cart_form').serialize();
    jQuery.ajax({
		type:'POST',
		url:site_root+'shopping-cart-add-next/',
		data:form_vars,
		success:function(data){
        	if(jQuery.fn.modal) 
			{			
				jQuery('#modal_window').modal('hide');
			}

        	if(next_action==1)
        	{
        		location.href=site_root+"checkout/";
        	}
		}
	});
}

function check_carts(word_text) {
	for(i=0;i<cart_mass.length;i++) {
		if(document.getElementById("cart"+cart_mass[i])) {
			jQuery("#cart"+cart_mass[i]+" a").removeClass("ac");
			jQuery("#cart"+cart_mass[i]+" a").addClass("ac2");
			jQuery("#cart"+cart_mass[i]+" a").html(word_text);
		}
		
		if(document.getElementById("hb_cart"+cart_mass[i])) {
			jQuery('#hb_cart'+cart_mass[i]).removeClass("hb_cart");
			jQuery('#hb_cart'+cart_mass[i]).addClass("hb_cart2");
		}
		
		if(document.getElementById("ts_cart"+cart_mass[i])) {
			document.getElementById("ts_cart_text"+cart_mass[i]).style.display='none';
			document.getElementById("ts_cart_text2"+cart_mass[i]).style.display='inline';
			jQuery('#ts_cart'+cart_mass[i]).removeClass("btn-primary");
			jQuery('#ts_cart'+cart_mass[i]).addClass("btn-danger");
		}
	}
}


function add_cart_flow(x,site_root) {
	flag_add=true;
	x_number=0;
	value=x;

    for(i=0;i<cart_mass.length;i++) {
		if(cart_mass[i]==x) {
			flag_add=false;
			x_number=i;
		}
	}
	
	if(site_root=="/") {
		site_root="";
	}
    
    if(flag_add)
    {
    	cart_mass[cart_mass.length]=x;
    	
    	jQuery.ajax({
			type:'POST',
			url:site_root+'shopping-cart-add-light/',
			data:'id=' + value,
			success:function(data){
				if(data.rights_managed==1)
				{
					location.href = data.url;
				}
				else
				{
					if(document.getElementById('shopping_cart'))
					{
						document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
					}
					if(document.getElementById('shopping_cart_lite'))
					{
						document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
					}
					
					if(typeof reload_cart == 'function') 
					{
   						reload_cart();
   						
						jQuery(".ts_cart_text"+value.toString()).hide();
						jQuery(".ts_cart_text2"+value.toString()).show();
					}
				}	
			}
		});
    }
    else
    {
   	 	cart_mass[x_number]=0;
   	 	
   	 	jQuery.ajax({
			type:'POST',
			url:site_root+'shopping-cart-delete-light/',
			data:'id=' + value,
			success:function(data){
				if(document.getElementById('shopping_cart'))
				{
					document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
				}
				if(document.getElementById('shopping_cart_lite'))
				{
					document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
				}
				
				if(typeof reload_cart == 'function') 
				{
   					reload_cart();
   					
					jQuery(".ts_cart_text"+value.toString()).show();
					jQuery(".ts_cart_text2"+value.toString()).hide();
				}	
			}
		});
    }
}






function reload_flow(site_root) {
    jQuery.ajax({
		type:'POST',
		url:site_root+'shopping-cart-reload/',
		data:'id=0',
		success:function(data){
			if(document.getElementById('shopping_cart'))
			{
				document.getElementById('shopping_cart').innerHTML = data.box_shopping_cart;
			}
			if(document.getElementById('shopping_cart_lite'))
			{
				document.getElementById('shopping_cart_lite').innerHTML = data.box_shopping_cart_lite;
			}
					
			if(typeof reload_cart == 'function') 
			{
   				reload_cart();				
			}
		}
	});
}

jQuery(document).ready(function() {
	if ( ! jQuery("div").is("#lightbox") ) 
	{
		div = jQuery("<div id='lightbox' style='top:0px;left:0px;position:absolute;z-index:1000;display:none'></div>");
		jQuery("body").prepend(div); 
	}
});