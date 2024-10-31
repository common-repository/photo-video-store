
function show_search() {
    jQuery.ajax({
		type:'POST',
		url:cart_site_root+'search-lite/',
		data:'search=' + document.getElementById('search').value,
		success:function(data){
			search_result=data
			if(search_result!="")
			{
				jQuery('#instant_search').slideDown("fast");
				document.getElementById('instant_search').innerHTML =search_result;
			}
			else
			{
				document.getElementById('instant_search').style.display='none';
			}
		}
	});
}





function set_styles() {
	main_color="#595858";
	main_color2="#dddddd";
	jQuery(".search_title").css("border-top-color", main_color2);
	jQuery("#profile_menu").css("border-top-color", main_color2);
	jQuery(".portfolio_left").css("border-top-color", main_color2);
	jQuery(".checkoutbox2_title").css("border-top-color", main_color2);
	jQuery("#lightbox_header").css("background-color", main_color);
	jQuery(".portfolio_right li.activno a").css("background-color", main_color);
	
	jQuery(".paging").css("border-color", main_color);
	jQuery(".paging").css("color", main_color);
	jQuery(".paging2").css("border-color", main_color);
	jQuery(".paging2").css("background-color", main_color);
	
	jQuery("a.paging").hover(
  	function () {
    	jQuery(this).css("background-color", main_color);
    	jQuery(this).css("color", "#FFFFFF");
  	}, 
 	 function () {
    	jQuery(this).css("background-color", "#FFFFFF");
    	jQuery(this).css("color", main_color);
  	}
	);
	

	jQuery('.link_total').prepend('<i class="glyphicon glyphicon-cd"> </i>&nbsp;&nbsp;');
	jQuery('.link_subscription').prepend('<i class="glyphicon glyphicon-calendar"> </i>&nbsp;&nbsp;');
	jQuery('.link_date').prepend('<i class="glyphicon glyphicon-calendar"> </i>&nbsp;&nbsp;');
	jQuery('.link_download').prepend('<i class="glyphicon glyphicon-download"> </i>&nbsp;&nbsp;');
	jQuery('.link_lightbox').prepend('<i class="glyphicon glyphicon-heart"> </i>&nbsp;&nbsp;');
	jQuery('.link_files').prepend('<i class="glyphicon glyphicon-folder-open"> </i>&nbsp;&nbsp;');
	jQuery('.link_commission').prepend('<i class="glyphicon glyphicon-briefcase"> </i>&nbsp;&nbsp;');
	jQuery('.link_credits').prepend('<i class="glyphicon glyphicon-piggy-bank"> </i>&nbsp;&nbsp;');
	jQuery('.link_payout').prepend('<i class="glyphicon glyphicon-share-alt"> </i>&nbsp;&nbsp;');
	jQuery('.link_approved').prepend('<i class="glyphicon glyphicon-check"> </i>&nbsp;&nbsp;');
	jQuery('.link_pending').prepend('<i class="glyphicon glyphicon-edit"> </i>&nbsp;&nbsp;');
	jQuery('.link_status').prepend('<i class="glyphicon glyphicon-education"> </i>&nbsp;&nbsp;');
	jQuery('.link_order').prepend('<i class="glyphicon glyphicon-shopping-cart"> </i>&nbsp;&nbsp;');
	jQuery('.link_payment').prepend('<i class="glyphicon glyphicon-credit-card"> </i>&nbsp;&nbsp;');
	jQuery('.link_message').prepend('<i class="glyphicon glyphicon-envelope"> </i>&nbsp;&nbsp;');
	jQuery('.link_edit').prepend('<i class="glyphicon glyphicon-edit"> </i>&nbsp;&nbsp;');
	jQuery('.link_delete').prepend('<i class="glyphicon glyphicon-trash"> </i>&nbsp;&nbsp;');
	jQuery('.link_comments').prepend('<i class="glyphicon glyphicon-comment"> </i>&nbsp;&nbsp;');
	jQuery('.link_coupons').prepend('<i class="glyphicon glyphicon-barcode"> </i>&nbsp;&nbsp;');
	jQuery('.link_subscription').prepend('<i class="glyphicon glyphicon-time"> </i>&nbsp;&nbsp;');

	
	jQuery(".add_to_cart").addClass("btn").addClass("btn-danger").addClass("btn-lg");
	jQuery("input.isubmit").addClass("btn").addClass("btn-success");
	jQuery("input.isubmit_orange").addClass("btn").addClass("btn-warning");
	jQuery("input.profile_button").addClass("btn").addClass("btn-danger");
	jQuery(".lightbox_button").addClass("btn").addClass("btn-danger");
	jQuery(".lightbox_button2").addClass("btn").addClass("btn-success");
	jQuery(".ibox").addClass("form-control");
	
	jQuery(".bar").addClass("progress-bar").addClass("progress-bar-success").addClass("progress-bar-striped");
	jQuery(".comment-reply").addClass("btn").addClass("btn-primary");
	jQuery(".comment-reply a").css("color", '#ffffff').css("text-decoration", 'none');	
	jQuery('.comment-reply a').prepend('<i class="fa fa-reply"></i> ');
	jQuery('.form-submit input[type="submit"]').addClass("btn").addClass("btn-primary");	
		


}


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

	scroll_top=jQuery(document).scrollTop();

	if(definesize(1)-x_coord-10-width>0) {
		param_left=x_coord+10;
	}
	else {
		param_left=x_coord-10-width;
	}

	if(definesize(2)-y_coord-10-height>0) {
		param_top=y_coord+scroll_top+10;
	}
	else {
		param_top=y_coord+scroll_top-10-height;
		if(param_top-scroll_top<0) {
			param_top=scroll_top;
		}
	}

	if(jQuery(window).width() > 700) {
		p_top=param_top.toString()+"px";
		p_left=param_left.toString()+"px";
	
		dd.style.top=p_top
		dd.style.left=p_left
		dd.style.zIndex=10000000000000000000
	}
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







//Video wmv preview
function lightboxon2(fl,width,height,event,rt) {
	rcontent="<OBJECT ID='MediaPlayer' WIDTH='"+width+"' HEIGHT='"+height+"' CLASSID='CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95' STANDBY='Loading Windows Media Player components...' TYPE='application/x-oleobject'><PARAM NAME='FileName' VALUE='"+fl+"'><PARAM name='ShowControls' VALUE='false'><param name='ShowStatusBar' value='false'><PARAM name='ShowDisplay' VALUE='false'><PARAM name='autostart' VALUE='true'><EMBED TYPE='application/x-mplayer2' SRC='"+fl+"' NAME='MediaPlayer' WIDTH='"+width+"' HEIGHT='"+height+"' ShowControls='0' ShowStatusBar='0' ShowDisplay='0' autostart='1'></EMBED></OBJECT>";

	preview_moving(rcontent,width,height,event);
}




//Video flv preview
function lightboxon3(fl,width,height,event,rt) {
	rcontent="<object classid='CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000'  style='width:"+width+"px;height:"+height+"px;' codebase='http://active.macromedia.com/flash2/cabs/swflash.cab#version=8,0,0,0'><param name='movie' value='"+rt+"/images/movie.swf?url="+fl+"&autoplay=true&loop=true&controlbar=false&sound=true&swfborder=true' /><param name='quality' value='high' /><param name='scale' value='exactfit' /><param name='menu' value='true' /><param name='bgcolor' value='#FFFFFF' /><param name='video_url' value=' ' /><embed src='"+rt+"/images/movie.swf?url="+fl+"&autoplay=true&loop=true&controlbar=false&sound=true&swfborder=true' quality='high' scale='exactfit' menu='false' bgcolor='#FFFFFF' style='width:"+width+"px;height:"+height+"px;' swLiveConnect='false' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash'></embed></object>";

	preview_moving(rcontent,width,height,event);
}







//audio preview
function lightboxon4(fl,width,height,event,rt) {

	rcontent="<audio src="+fl+" type='audio/mp3' autoplay controls></audio>";

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

	rcontent='<iframe src="https://player.vimeo.com/video/' + fl + '?autoplay=1&loop=1" width="' + width + '" height="' + height + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

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
			jQuery('#'+form_fields[i]).removeClass("ibox_ok");
			jQuery('#'+form_fields[i]).addClass("ibox_error");			
		}
		else
		{
				jQuery('#'+form_fields[i]).removeClass("ibox_error");
				jQuery('#'+form_fields[i]).addClass("ibox_ok");	
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
	if (typeof cart_mass !== "undefined") {
		for(i=0;i<cart_mass.length;i++) {
			if(document.getElementById("cart"+cart_mass[i])) {
				jQuery("#cart"+cart_mass[i]+" a").removeClass("ac");
				jQuery("#cart"+cart_mass[i]+" a").addClass("ac2");
				jQuery("#cart"+cart_mass[i]+" a").html(word_text);
			}
			
			jQuery(".ts_cart_text"+cart_mass[i]).hide();
			jQuery(".ts_cart_text2"+cart_mass[i]).show();
			jQuery('#ts_cart'+cart_mass[i]).removeClass("btn-primary");
			//jQuery('#ts_cart'+cart_mass[i]).addClass("color_black");
		}
	}
	
	jQuery('.btn-free').removeClass("btn-primary").removeClass("btn");
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


function search_submit() {
	//jQuery("#main_search").submit();
	alert(1);
}


jQuery(document).ready(function() {

	if ( ! jQuery("div").is("#lightbox") ) 
	{
		div = jQuery("<div id='lightbox' style='top:0px;left:0px;position:absolute;z-index:1000;display:none'></div>");
		jQuery("body").prepend(div); 
	}

	set_styles();

	
	jQuery('#search').keyup(function() 
	{
		show_search();
	});


	jQuery("#instant_search").hover
	(
		function () 
		{
			
		},
		function () 
		{
			jQuery('#instant_search').slideUp("fast");
			document.getElementById('instant_search').innerHTML ="";
		}
	);
	
	
	jQuery('.home_img').each(function(){
		jQuery(this).animate({opacity:'1.0'},1);
		jQuery(this).mouseover(function(){
		jQuery(this).stop().animate({opacity:'0.6'},600);
		});
		jQuery(this).mouseout(function(){
		jQuery(this).stop().animate({opacity:'1.0'},300);
		});
	});

});




/* http://www.menucool.com/tabbed-content Free to use. v2013.7.6 */
(function(){var g=function(a){if(a&&a.stopPropagation)a.stopPropagation();else window.event.cancelBubble=true;var b=a?a:window.event;b.preventDefault&&b.preventDefault()},d=function(a,c,b){if(a.addEventListener)a.addEventListener(c,b,false);else a.attachEvent&&a.attachEvent("on"+c,b)},a=function(c,a){var b=new RegExp("(^| )"+a+"( |$)");return b.test(c.className)?true:false},j=function(b,c,d){if(!a(b,c))if(b.className=="")b.className=c;else if(d)b.className=c+" "+b.className;else b.className+=" "+c},h=function(a,b){var c=new RegExp("(^| )"+b+"( |$)");a.className=a.className.replace(c,"$1");a.className=a.className.replace(/ $/,"")},e=function(){var b=window.location.pathname;if(b.indexOf("/")!=-1)b=b.split("/");var a=b[b.length-1]||"root";if(a.indexOf(".")!=-1)a=a.substring(0,a.indexOf("."));if(a>20)a=a.substring(a.length-19);return a},c="mi"+e(),b=function(b,a){this.g(b,a)};b.prototype={h:function(){var b=new RegExp(c+this.a+"=(\\d+)"),a=document.cookie.match(b);return a?a[1]:this.i()},i:function(){for(var b=0,c=this.b.length;b<c;b++)if(a(this.b[b].parentNode,"selected"))return b;return 0},j:function(b,d){var c=document.getElementById(b.TargetId);if(!c)return;this.l(c);for(var a=0;a<this.b.length;a++)if(this.b[a]==b){j(b.parentNode,"selected");d&&this.d&&this.k(this.a,a)}else h(this.b[a].parentNode,"selected")},k:function(a,b){document.cookie=c+a+"="+b+"; path=/"},l:function(b){for(var a=0;a<this.c.length;a++)this.c[a].style.display=this.c[a].id==b.id?"block":"none"},m:function(){this.c=[];for(var c=this,a=0;a<this.b.length;a++){var b=document.getElementById(this.b[a].TargetId);if(b){this.c.push(b);d(this.b[a],"click",function(b){var a=this;if(a===window)a=window.event.srcElement;c.j(a,1);g(b);return false})}}},g:function(f,h){this.a=h;this.b=[];for(var e=f.getElementsByTagName("a"),i=/#([^?]+)/,a,b,c=0;c<e.length;c++){b=e[c];a=b.getAttribute("href");if(a.indexOf("#")==-1)continue;else{var d=a.match(i);if(d){a=d[1];b.TargetId=a;this.b.push(b)}else continue}}var g=f.getAttribute("data-persist")||"";this.d=g.toLowerCase()=="true"?1:0;this.m();this.n()},n:function(){var a=this.d?parseInt(this.h()):this.i();if(a>=this.b.length)a=0;this.j(this.b[a],0)}};var k=[],i=function(e){var b=false;function a(){if(b)return;b=true;setTimeout(e,4)}if(document.addEventListener)document.addEventListener("DOMContentLoaded",a,false);else if(document.attachEvent){try{var f=window.frameElement!=null}catch(g){}if(document.documentElement.doScroll&&!f){function c(){if(b)return;try{document.documentElement.doScroll("left");a()}catch(d){setTimeout(c,10)}}c()}document.attachEvent("onreadystatechange",function(){document.readyState==="complete"&&a()})}d(window,"load",a)},f=function(){for(var d=document.getElementsByTagName("ul"),c=0,e=d.length;c<e;c++)a(d[c],"tabs")&&k.push(new b(d[c],c))};i(f);return{}})()
