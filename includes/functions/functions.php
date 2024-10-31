<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

/**
 * Init Functions
 */


/**
 * Start session for the plugin
 */
function pvs_session_start()
{
	if( ! session_id() ) {
		session_start();
	}
}



/**
 * Destroy session for the plugin
 */
function pvs_session_destroy()
{
	session_destroy();
}


/**
 * Return wp 'plugins_url' function + plug-in name 'photo-video-store'
 *
 * @return string
 */
function pvs_plugins_url()
{
	return plugins_url( PVS_DOMAIN );
}


/**
 * Return admin page URL
 *
 * @param  string $url URL in /includes/admin/.
 * @return string
 */
function pvs_plugins_admin_url( $url )
{
	return admin_url() . 'admin.php?page=' . PVS_DOMAIN . urlencode( '/includes/admin/' .
		$url );
}

/**
 * Blocks automatic plugin's update
 *
 */
function pvs_filter_plugin_updates( $value ) {
	unset( $value->response['photo-video-store/photo-video-store.php'] );
	return $value;
}


/**
 * Create admin menu links
 *
 * used in plugin's init add_action( 'admin_menu', ...);
 */
function pvs_get_admin_menu()
{
	global $pvs_menu_admin;
	global $pvs_menu_admin_name;
	global $pvs_menu_admin_icon;
	global $pvs_menu_admin_url;
	global $pvs_submenu_admin;
	global $pvs_submenu_admin_url;

	for ( $i = 0; $i < count( $pvs_menu_admin ); $i++ )
	{
		add_menu_page( $pvs_menu_admin_name[$i], PVS_NAME . ' - ' . $pvs_menu_admin_name[$i],
			'manage_options', PVS_DOMAIN . '/includes/admin/' . $pvs_menu_admin_url[$i], '', $pvs_menu_admin_icon[$i] );

		foreach ( $pvs_submenu_admin as $key => $value )
		{
			if ( preg_match( "/^" . $pvs_menu_admin[$i] . "_/", $key ) )
			{
				$menu_count = "";
				
				$style=" class='round_red'";

				if ( $key == "orders_orders" and  pvs_get_admin_notifications( 'orders', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'orders', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_credits" and pvs_get_admin_notifications( 'credits', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'credits', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_subscription" and pvs_get_admin_notifications( 'subscription', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'subscription', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_commission" and pvs_get_admin_notifications( 'commission', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'commission', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_downloads" and pvs_get_admin_notifications( 'downloads', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'downloads', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_invoices" and pvs_get_admin_notifications( 'invoices', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'invoices', 'count' ) .
						'</span>';
				}
	
				if ( $key == "orders_payments" and pvs_get_admin_notifications( 'payments', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'payments', 'count' ) .
						'</span>';
				}
	
				if ( $key == "catalog_exam" and pvs_get_admin_notifications( 'exams', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'exams', 'count' ) .
						'</span>';
				}
	
				if ( $key == "catalog_comments" and pvs_get_admin_notifications( 'comments', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'comments', 'count' ) .
						'</span>';
				}
	
				if ( $key == "catalog_lightboxes" and pvs_get_admin_notifications( 'lightboxes', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'lightboxes', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_customers" and pvs_get_admin_notifications( 'users', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'users', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_documents" and pvs_get_admin_notifications( 'documents', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'documents', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_messages" and pvs_get_admin_notifications( 'messages', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'messages', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_contacts" and pvs_get_admin_notifications( 'contacts', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'contacts', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_testimonials" and pvs_get_admin_notifications( 'testimonials', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'testimonials', 'count' ) .
						'</span>';
				}
	
				if ( $key == "users_support" and pvs_get_admin_notifications( 'support', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'support', 'count' ) .
						'</span>';
				}
				if ( $key == "catalog_upload" and pvs_get_admin_notifications( 'uploads', 'count' ) > 0 )
				{
					$menu_count = '<span ' . $style . '>' . pvs_get_admin_notifications( 'uploads', 'count' ) .
						'</span>';
				}
				
				add_submenu_page( PVS_DOMAIN . '/includes/admin/' . $pvs_menu_admin_url[$i], $value, $value . $menu_count, 'manage_options',
					PVS_DOMAIN . '/includes/admin/' . $pvs_submenu_admin_url[$key], '' );
			}
		}
	}
}



/**
 * Activate js and css libraries for admin panel
 */
function pvs_load_js_css_admin()
{
	global $pvs_global_settings;
	
	$show_regime = 'local';
	
	wp_enqueue_script( 'jquery' );
	
	if ( $show_regime == 'local') {
		wp_enqueue_script( 'bootstrap_admin', pvs_plugins_url() . '/assets/js/bootstrap.min.js' );
		if ($pvs_global_settings["google_coordinates"]) {
			wp_enqueue_script( 'pvs_google_map_admin', 'https://maps.googleapis.com/maps/api/js?sensor=false&key=' . @$pvs_global_settings["google_api"] );
			wp_enqueue_script( 'pvs_gmap_picker_admin', pvs_plugins_url() . '/assets/js/gmap_picker/jquery-gmaps-latlon-picker.js' );
			wp_enqueue_script( 'pvs_gmap_mustache_admin', pvs_plugins_url() . '/assets/js/mustache.min.js' );	
		}
		wp_enqueue_script( 'pvs_admin_js', pvs_plugins_url() . '/assets/js/scripts.js' );	
	
		wp_enqueue_style( 'pvs_admin_style', pvs_plugins_url() . '/includes/admin/includes/css/style.css' );
		wp_enqueue_style( 'pvs_admin_font_awesome', pvs_plugins_url() . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap_style_admin', pvs_plugins_url() . '/assets/css/bootstrap.min.css' );	
	}
	
	if ( $show_regime == 'cdn') {
		wp_enqueue_script( 'bootstrap_admin', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js' );
		if ($pvs_global_settings["google_coordinates"]) {
			wp_enqueue_script( 'pvs_google_map_admin', 'https://maps.googleapis.com/maps/api/js?sensor=false&key=' . @$pvs_global_settings["google_api"] );
			wp_enqueue_script( 'pvs_gmap_picker_admin', pvs_plugins_url() . '/assets/js/gmap_picker/jquery-gmaps-latlon-picker.js' );
			wp_enqueue_script( 'pvs_gmap_mustache_admin', pvs_plugins_url() . '/assets/js/mustache.min.js' );	
		}
		wp_enqueue_script( 'pvs_admin_js', pvs_plugins_url() . '/assets/js/scripts.js' );	
	
		wp_enqueue_style( 'pvs_admin_style', pvs_plugins_url() . '/includes/admin/includes/css/style.css' );
		wp_enqueue_style( 'pvs_admin_font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap_style_admin', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css' );	
	}
}

/**
 * Activate js and css libraries for front end
 */
function pvs_load_js_css()
{
	global $pvs_global_settings;
	
	$show_regime = 'local';
	
	if ( $show_regime == 'local') {
		wp_enqueue_script( 'pvs_jqueryui', pvs_plugins_url() . '/assets/js/jquery-ui.min.js' );
		//wp_enqueue_script( 'bootstrap', pvs_plugins_url() . '/assets/js/bootstrap.min.js' );		
		wp_enqueue_script( 'pvs_raty', pvs_plugins_url() . '/assets/js/raty/jquery.raty.min.js' );	
		wp_enqueue_script( 'pvs_colorpicker', pvs_plugins_url() . '/assets/js/colorpicker/js/colorpicker.js' );
		wp_enqueue_script( 'pvs_colorpicker_eye', pvs_plugins_url() . '/assets/js/colorpicker/js/eye.js' );
		wp_enqueue_script( 'pvs_colorpicker_utils', pvs_plugins_url() . '/assets/js/colorpicker/js/utils.js' );	
		wp_enqueue_script( 'pvs_cookie', pvs_plugins_url() . '/assets/js/navgoco/jquery.cookie.min.js' );
		wp_enqueue_script( 'pvs_navgoco', pvs_plugins_url() . '/assets/js/navgoco/jquery.navgoco.min.js' );
		//wp_enqueue_script( 'pvs_jshttprequest', pvs_plugins_url() . '/assets/js/JsHttpRequest.js' );
		wp_enqueue_script( 'pvs_custom_js', pvs_plugins_url() . '/assets/js/custom.js' );
	
		wp_enqueue_style( 'pvs_colorpicker_style', pvs_plugins_url() . '/assets/js/colorpicker/css/colorpicker.css' );
		wp_enqueue_style( 'pvs_jquery_ui_style', pvs_plugins_url() . '/assets/css/jquery-ui.css' );
		wp_enqueue_style( 'pvs_prints_style', pvs_plugins_url() . '/includes/prints/style.css' );
		wp_enqueue_style( 'pvs_navgoco', pvs_plugins_url() . '/assets/js/navgoco/jquery.navgoco.css' );
		//wp_enqueue_style( 'bootstrap_style', pvs_plugins_url() . '/assets/css/bootstrap.min.css' );	
		wp_enqueue_style( 'pvs_css', pvs_plugins_url() . '/assets/css/theme.css' );
	}
	
	if ( $show_regime == 'cdn') {
		wp_enqueue_script( 'pvs_jqueryui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js' );
		//wp_enqueue_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js' );		
		wp_enqueue_script( 'pvs_jqueryui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js' );
		wp_enqueue_script( 'pvs_raty', 'https://cdnjs.cloudflare.com/ajax/libs/raty/2.8.0/jquery.raty.min.js' );	
		wp_enqueue_script( 'pvs_colorpicker', pvs_plugins_url() . '/assets/js/colorpicker/js/colorpicker.js' );
		wp_enqueue_script( 'pvs_colorpicker_eye', pvs_plugins_url() . '/assets/js/colorpicker/js/eye.js' );
		wp_enqueue_script( 'pvs_colorpicker_utils', pvs_plugins_url() . '/assets/js/colorpicker/js/utils.js' );	
		wp_enqueue_script( 'pvs_cookie', pvs_plugins_url() . '/assets/js/navgoco/jquery.cookie.min.js' );
		wp_enqueue_script( 'pvs_navgoco', pvs_plugins_url() . '/assets/js/navgoco/jquery.navgoco.min.js' );
		//wp_enqueue_script( 'pvs_jshttprequest', pvs_plugins_url() . '/assets/js/JsHttpRequest.js' );
		wp_enqueue_script( 'pvs_custom_js', pvs_plugins_url() . '/assets/js/custom.js' );
	
		wp_enqueue_style( 'pvs_colorpicker_style', pvs_plugins_url() . '/assets/js/colorpicker/css/colorpicker.css' );
		wp_enqueue_style( 'pvs_jquery_ui_style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'pvs_prints_style', pvs_plugins_url() . '/includes/prints/style.css' );
		wp_enqueue_style( 'pvs_navgoco', pvs_plugins_url() . '/assets/js/navgoco/jquery.navgoco.css' );
		//wp_enqueue_style( 'bootstrap_style', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css' );	
		wp_enqueue_style( 'pvs_css', pvs_plugins_url() . '/assets/css/theme.css' );
	}
}




/**
 * Add rewrite rules for PVS plugin
 */
function pvs_rewrite_rules(){
	pvs_rewrite('rewrite');
	add_rewrite_rule('^member\/([\w\-]+)\/?$','index.php?pvs_page=user&pvs_user_id=$matches[1]','top'); 	

	add_rewrite_rule('^static([0-9]*)\/preview([0-9]*)\/([\w\-]+)-([0-9]+).(jpg|jpeg|flv|mp4|mp3)?','index.php?pvs_page=preview&pvs_folder=$matches[1]&pvs_id=$matches[4]&pvs_file=$matches[2]&pvs_filename=$matches[3]&pvs_ext=$matches[5]','top');
	add_rewrite_rule('^stock-(photo|video|audio|vector)\/[\w\-]+-([0-9]+)$','index.php?pvs_page=$matches[1]&pvs_id=$matches[2]','top');
	add_rewrite_rule('^gallery\/[\w\-]+-([0-9]+)$','index.php?pvs_page=category&pvs_id=$matches[1]','top');
	add_rewrite_rule('^lightbox\/[\w\-]+-([0-9]+)$','index.php?pvs_page=lightbox&pvs_id=$matches[1]','top');
	add_rewrite_rule('^collection\/[\w\-]+-([0-9]+)$','index.php?pvs_page=collection&pvs_id=$matches[1]','top'); 
	add_rewrite_rule('^(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$','index.php?pvs_page=print&pvs_id=$matches[3]&pvs_print_id=$matches[2]','top'); 
	
	add_rewrite_rule('^keyword\/([\w\- ]+)$','index.php?pvs_page=category&pvs_search=$matches[1]','top');
	
	add_rewrite_rule('^shutterstock\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?shutterstock=$matches[3]&shutterstock_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^fotolia\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?fotolia=$matches[3]&fotolia_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^istockphoto\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?istockphoto=$matches[3]&istockphoto_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^depositphotos\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?depositphotos=$matches[3]&depositphotos_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^bigstockphoto\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?bigstockphoto=$matches[3]&bigstockphoto_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^123rf\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?rf123=$matches[3]&rf123_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^pixabay\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?pixabay=$matches[3]&pixabay_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	add_rewrite_rule('^adobe\/(canvas-print|print|metal-print|framed-print|acrylic-print|greeting-card|iphone-case|galaxy-case|pillow|tote-bag|duvet-cover|shower-curtain|t-shirt)\/[\w-]+-([0-9]+)-([0-9]+)$', 'index.php?adobe=$matches[3]&adobe_type=photo&pvs_page=stockapi&pvs_print_id=$matches[2]','top');
	
	add_rewrite_rule('^shutterstock-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?shutterstock=$matches[2]&shutterstock_type=$matches[1]&pvs_page=stockapi','top'); 
	add_rewrite_rule('^fotolia-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?fotolia=$matches[2]&fotolia_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^istockphoto-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?istockphoto=$matches[2]&istockphoto_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^depositphotos-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?depositphotos=$matches[2]&depositphotos_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^bigstockphoto-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?bigstockphoto=$matches[2]&bigstockphoto_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^123rf-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?rf123=$matches[2]&rf123_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^pixabay-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?pixabay=$matches[2]&pixabay_type=$matches[1]&pvs_page=stockapi','top');
	add_rewrite_rule('^adobe-([a-z]*)\/[\w\-]+-([0-9]+)$','index.php?adobe=$matches[2]&adobe_type=$matches[1]&pvs_page=stockapi','top');

	flush_rewrite_rules();
}



/**
 * Add rewrite rules for service pages
 */
function pvs_rewrite($action) {

	$pvs_rewrite_pages = array (
		'admin_photo_preview2' => 'includes/admin/bulk_upload/image2.php',
		'admin_photo_bulk' => 'includes/admin/bulk_upload/image.php',		
		'agreement' => 'templates/agreement.php',
		'affiliate-change' => 'templates/affiliate_change.php', 
		'affiliate' => 'templates/affiliate.php', 
		'billing-payment' => 'templates/billing2.php', 
		'billing-confirm' => 'templates/billing3.php', 
		'billing-coupon' => 'templates/billing_coupon.php', 
		'billing' => 'templates/billing.php', 
		'cart' => 'templates/shopping_cart.php',
		'categories' => 'templates/categories.php',
		'canvaspop' => 'templates/canvaspop.php',
		'check-facebook' => 'templates/check_facebook.php',
		'check-google' => 'templates/check_google.php',
		'check-twitter' => 'templates/check_twitter.php',
		'check-vk' => 'templates/check_vk.php',
		'check-yandex' => 'templates/check_yandex.php',
		'check-login' => 'templates/check_login.php',
		'check-email' => 'templates/check_email.php',
		'check-guest' => 'templates/check_guest.php',
		'check-instagram' => 'templates/check_instagram.php',
		'check-category' => 'templates/check_category.php',
		'checkout-address' => 'templates/checkout_address.php', 
		'checkout-coupon' => 'templates/checkout_coupon.php', 
		'checkout-method' => 'templates/checkout_method.php', 
		'checkout-shipping' => 'templates/checkout_shipping.php', 
		'checkout-vat' => 'templates/checkout_vat.php', 
		'checkout' =>  'templates/checkout.php',
		'media-collections' => 'templates/collections.php', 
		'commission-change' => 'templates/commission_change.php', 
		'commission' => 'templates/commission.php',
		'coffee' => 'templates/coffee.php', 
		'contacts' => 'templates/contacts.php', 
		'content-list-paging' => 'templates/content_list_paging.php', 
		'content-photo-preview' => 'templates/content_photo_preview.php', 
		'content-print-price' => 'templates/content_print_price.php', 
		'count' => 'templates/count.php', 
		'coupons' => 'templates/coupons.php', 
		'credits-list' => 'templates/credits_packages.php',
		'credits' => 'templates/credits.php',
		'cron-amazon' => 'templates/cron_amazon.php',
		'cron-ffmpeg' => 'templates/cron_ffmpeg.php',
		'cron-photos' => 'templates/cron_photos.php',
		'cron-printful' => 'templates/cron_printful.php',
		'cron-pwinty' => 'templates/cron_pwinty.php',
		'cron-rackspace' => 'templates/cron_rackspace.php',
		'cron-backblaze' => 'templates/cron_backblaze.php',
		'cron-elasticsearch' => 'templates/cron_elasticsearch.php',
		'cron-video' => 'templates/cron_video.php',
		'delete-publication' => 'templates/delete_publication.php', 
		'delete-category' => 'templates/delete_category.php', 
		'download-limit' => 'templates/download_limit.php', 
		'download' => 'templates/download.php', 
		'examination-take' => 'templates/examination_take.php', 
		'exif' => 'templates/exif.php', 
		'filemanager-photo-dropzone-delete' => 'templates/filemanager_photo_dropzone_delete.php',
		'filemanager-photo-dropzone-list' => 'templates/filemanager_photo_dropzone_list.php',
		'filemanager-photo-dropzone-preview' => 'templates/filemanager_photo_dropzone_preview.php',		
		'filemanager-photo-dropzone' => 'templates/filemanager_photo_dropzone.php',
		'filemanager-photo-jquery' => 'templates/filemanager_photo_jquery.php',
		'filemanager-photo-plupload' => 'templates/filemanager_photo_plupload.php',
		'filemanager-photo-java' => 'templates/filemanager_photo_java.php',
		'filemanager-photo' => 'templates/filemanager_photo.php',
		'filemanager-video' => 'templates/filemanager_video.php',
		'filemanager-audio' => 'templates/filemanager_audio.php',
		'filemanager-vector' => 'templates/filemanager_vector.php',
		'filemanager-category' => 'templates/filemanager_category.php',
		'forgot-password' => 'templates/forgot.php', 
		'friends-add' => 'templates/friends_add.php', 
		'friends-delete' => 'templates/friends_delete.php', 
		'friends-remove' => 'templates/friends_remove.php', 
		'friends' => 'templates/friends.php', 
		'google-map' => 'templates/map.php',
		'image' => 'templates/image.php', 
		'invoice-pdf' => 'templates/invoice_pdf.php', 
		'invoice-html' => 'templates/invoice_html.php', 
		'invoice' => 'templates/invoice.php', 
		'language-list' => 'templates/languages_list.php',
		'language-select' => 'templates/language.php', 
		'license' => 'templates/license.php', 
		'lightbox-add' => 'templates/lightbox_add.php', 
		'lightbox-content' => 'templates/lightbox_content.php', 
		'lightbox-delete' => 'templates/lightbox_delete.php', 
		'lightbox-edit' => 'templates/lightbox_edit.php', 
		'lightbox-show' => 'templates/lightbox_show.php', 
		'lightboxes' => 'templates/lightboxes.php', 
		'my-favorite-list' => 'templates/lightbox.php', 
		'like' => 'templates/like.php', 
		'login' => 'templates/login.php', 
		'map-json' => 'templates/map_json.php', 
		'messages-new' => 'templates/messages_new.php', 
		'messages-to-trash' => 'templates/messages_to_trash.php', 
		'messages-trash' => 'templates/messages_trash.php', 
		'messages-content' => 'templates/messages_content.php', 
		'messages-add' => 'templates/messages_add.php', 
		'messages-delete' => 'templates/messages_delete.php', 
		'messages-sent' => 'templates/messages_sent.php', 
		'messages' => 'templates/messages.php', 
		'models-add' => 'templates/models_add.php',
		'models-new' => 'templates/models_new.php', 
		'models-content' => 'templates/models_content.php', 
		'models-delete' => 'templates/models_delete.php', 
		'models-edit' => 'templates/models_edit.php', 
		'models-file-delete' => 'templates/models_file_delete.php', 
		'models' => 'templates/models.php', 
		'orders-scheme' => 'includes/admin/orders/scheme.php', 
		'orders-crop' => 'includes/admin/orders/crop.php', 
		'orders-export-csv' => 'includes/admin/orders/export_csv.php', 
		'orders-export-xls' => 'includes/admin/orders/export_xls.php', 
		'orders-print-version' => 'includes/admin/orders/print_version.php', 
		'orders-add' => 'templates/orders_add.php', 
		'orders-content' => 'templates/orders_content.php', 
		'orders' => 'templates/orders.php', 
		'print-version' => 'templates/print_version.php', 
		'prints-preview' => 'templates/prints_preview.php', 
		'my-package' => 'templates/package.php', 
		'package-save' => 'templates/package_save.php', 
		'package-preview' => 'templates/package_preview.php',
		'package-show-add' => 'templates/package_show_add.php',
		'package-show-delete' => 'templates/package_show_delete.php',
		'package-show' => 'templates/package_show.php',
		'packages' => 'templates/packages.php', 		
		'payment-process' => 'templates/payment_process.php', 
		'payment-page' => 'templates/payment_page.php', 
		'payment-notification' => 'templates/payment_notification.php', 
		'payment-success' => 'templates/payment_success.php', 
		'payment-fail' => 'templates/payment_fail.php', 
		'popup' => 'templates/popup.php',  
		'printslab-change' => 'templates/printslab_change.php', 
		'printslab-order' => 'templates/printslab_order.php', 
		'printslab-upload-process' => 'templates/printslab_upload2.php', 
		'printslab-upload' => 'templates/printslab_upload.php', 
		'printslab-delete' => 'templates/printslab_delete.php', 
		'printslab-content' => 'templates/printslab_content.php', 
		'printslab-add-to-cart2' => 'templates/printslab_add_to_cart2.php', 
		'printslab-add-to-cart' => 'templates/printslab_add_to_cart.php', 
		'printslab-add' => 'templates/printslab_add.php',
		'printslab-mockup' => 'templates/printslab_mockup.php', 
		'printslab-preupload' => 'templates/printslab_preupload.php', 
		'printslab' => 'templates/printslab.php', 
		'profile-downloads-table' => 'templates/profile_downloads_table.php', 
		'profile-downloads-xls' => 'templates/profile_downloads_xls.php', 
		'profile-downloads' => 'templates/profile_downloads.php', 
		'profile-document-upload' => 'templates/profile_document_upload.php', 
		'profile-photo-delete' => 'templates/profile_photo_delete.php', 
		'profile-photo-upload' => 'templates/profile_photo_upload.php', 
		'profile-about' => 'templates/profile_about.php', 
		'profile-edit' => 'templates/profile_edit.php', 
		'profile' => 'templates/profile_home.php',
		'publications-edit' => 'templates/publications_edit.php', 
		'publications' => 'templates/publications.php', 
		'recognition-imagga' => 'templates/recognition_imagga.php', 
		'reviews-content' => 'templates/reviews_content.php', 
		'reviews-edit' => 'templates/reviews_edit.php', 
		'reviews-change' => 'templates/reviews_change.php', 
		'reviews-delete' => 'templates/reviews_delete.php', 
		'reviews-for-me' => 'templates/reviews_for_me.php', 
		'reviews' => 'templates/reviews.php', 
		'rights-managed-change' => 'templates/rights_managed_change.php', 
		'rights-managed' => 'templates/rights_managed.php', 
		'rss-category' => 'templates/rss_category.php', 
		'search-lite' => 'templates/search_lite.php', 
		'shopping-cart-add-package' => 'templates/shopping_cart_add_package.php', 
		'shopping-cart-add-lightbox' => 'templates/shopping_cart_add_lightbox.php', 
		'shopping-cart-add-light' => 'templates/shopping_cart_add_light.php', 
		'shopping-cart-add-next' => 'templates/shopping_cart_add_next.php', 
		'shopping-cart-add-prints-stock' => 'templates/shopping_cart_add_prints_stock.php', 
		'shopping-cart-add-print' => 'templates/shopping_cart_add_print.php', 		
		'shopping-cart-add-rights-managed' => 'templates/shopping_cart_add_rights_managed.php', 
		'shopping-cart-add-collection' => 'templates/shopping_cart_add_collection.php', 
		'shopping-cart-add' => 'templates/shopping_cart_add.php', 
		'shopping-cart-change-option' => 'templates/shopping_cart_change_option.php', 
		'shopping-cart-change-new' => 'templates/shopping_cart_change_new.php', 
		'shopping-cart-change' => 'templates/shopping_cart_change.php', 
		'shopping-cart-clear' => 'templates/shopping_cart_clear.php', 
		'shopping-cart-delete-light' => 'templates/shopping_cart_delete_light.php', 
		'shopping-cart-delete' => 'templates/shopping_cart_delete.php', 
		'signup-add' => 'templates/signup_add.php', 
		'signup' => 'templates/signup.php', 
		'states' => 'templates/states.php', 
		'subscription-list' => 'templates/subscription_list.php',
		'subscription' => 'templates/subscription.php', 
		'support-new' => 'templates/support_new.php', 
		'support-content' => 'templates/support_content.php', 
		'support-rating' => 'templates/support_rating.php', 
		'support-add' => 'templates/support_add.php', 
		'support' => 'templates/support.php', 
		'tell-a-friend' => 'templates/tell_a_friend.php', 
		'testimonials-edit' => 'templates/testimonials_edit.php', 
		'testimonials-change' => 'templates/testimonials_change.php', 
		'testimonials-delete' => 'templates/testimonials_delete.php', 
		'testimonials-for-me' => 'templates/testimonials_for_me.php', 
		'testimonials' => 'templates/testimonials.php', 	
		'thanks' => 'templates/thanks.php', 	
		'upload_files_jquery' => 'templates/upload_files_jquery.php',
		'upload_java_admin' => 'includes/admin/bulk_upload/photo_java_preupload.php',
		'upload-photo-dropzone-process' => 'templates/upload_photo_dropzone_process.php', 
		'upload-photo-dropzone' => 'templates/upload_photo_dropzone.php', 
		'upload-photo-jquery-process' => 'templates/upload_photo_jquery3.php',
		'upload-photo-jquery' => 'templates/upload_photo_jquery.php',
		'upload-audio' => 'templates/upload_audio.php', 
		'upload-category' => 'templates/upload_category.php', 
		'upload-photo-java-process' => 'templates/upload_photo_java2.php', 
		'upload-photo-java' => 'templates/upload_photo_java.php', 
		'upload-photo-plupload-process' => 'templates/upload_photo_plupload2.php', 
		'upload-photo-plupload' => 'templates/upload_photo_plupload.php', 
		'upload-photo' => 'templates/upload_photo.php', 
		'upload-vector' => 'templates/upload_vector.php', 
		'upload-video' => 'templates/upload_video.php', 
		'upload' => 'templates/upload.php',
		'user-testimonials-content' => 'templates/user_testimonials_content.php', 
		'users' => 'templates/users_list.php',
		'vote-add' => 'templates/vote_add.php', 
		'vote-user' => 'templates/vote_user.php', 
		'zoomer' => 'templates/zoomer.php'
	);
		
	foreach ( $pvs_rewrite_pages as $key => $value ) {
		if ($action == 'rewrite') {
			add_rewrite_rule('^' . $key . '?','index.php?pvs_page=' . $key, 'top');
		}
	}	

	return $pvs_rewrite_pages;
}



/**
 * Set rewite vars
 */
function pvs_rewrite_vars($vars) {
    array_push($vars, 'pvs_page');
    array_push($vars, 'pvs_folder');
    array_push($vars, 'pvs_id');
    array_push($vars, 'pvs_file');
    array_push($vars, 'pvs_filename');
    array_push($vars, 'pvs_ext');
    array_push($vars, 'pvs_print_id');
    array_push($vars, 'pvs_user_id');
    array_push($vars, 'pvs_search');
    array_push($vars, 'shutterstock');
    array_push($vars, 'shutterstock_type');
    array_push($vars, 'fotolia');
    array_push($vars, 'fotolia_type');
    array_push($vars, 'istockphoto');
    array_push($vars, 'istockphoto_type');
    array_push($vars, 'depositphotos');
    array_push($vars, 'depositphotos_type');
    array_push($vars, 'bigstockphoto');
    array_push($vars, 'bigstockphoto_type');
    array_push($vars, 'rf123');
    array_push($vars, 'rf123_type');
    array_push($vars, 'pixabay');
    array_push($vars, 'pixabay_type');
    array_push($vars, 'adobe');
    array_push($vars, 'adobe_type');
    return $vars;
}



/**
 * Check if PVS rewrite rules exists
 */
function pvs_flush_rules()
{
    global $wp_rewrite; 
    
    $rules = get_option( 'rewrite_rules' );
    if ( ! isset( $rules['^profile?'] ) ) { 
        $wp_rewrite->flush_rules();
    }
}





/**
 * Check if a page requires authorization
 */
function pvs_check_auth () {
	global $pvs_global_settings;
	
	//Session start	
	if ( pvs_check_session () ) {
		pvs_session_start();
	}

	$pvs_pages_auth = array (
		'affiliate-change', 
		'affiliate', 
		'billing-payment', 
		'billing-confirm', 
		'billing-coupon', 
		'billing', 
		'checkout-coupon', 
		'checkout-method', 
		'checkout-shipping', 
		'commission-change', 
		'commission',
		'coupons', 
		'count',
		'credits',
		'delete-publication', 
		'delete-category', 
		'examination-take', 
		'filemanager-photo-dropzone',
		'filemanager-photo-dropzone-delete',
		'filemanager-photo-dropzone-list',
		'filemanager-photo-dropzone-preview',
		'filemanager-photo-jquery',
		'filemanager-photo-plupload',
		'filemanager-photo-java',
		'filemanager-photo',
		'filemanager-video',
		'filemanager-audio',
		'filemanager-vector',
		'filemanager-category',
		'friends-add', 
		'friends-delete', 
		'friends-remove', 
		'friends', 
		'invoice-pdf', 
		'invoice-html', 
		'invoice', 
		'lightbox-add', 
		'lightbox-content', 
		'lightbox-delete', 
		'lightbox-edit', 
		'lightboxes', 
		'my-favorite-list', 
		'messages-new', 
		'messages-to-trash', 
		'messages-trash', 
		'messages-content', 
		'messages-add', 
		'messages-delete', 
		'messages-sent', 
		'messages', 
		'models-add',
		'models-new', 
		'models-content', 
		'models-delete', 
		'models-edit', 
		'models-file-delete', 
		'models', 
		'orders-scheme', 
		'orders-crop', 
		'orders-export-csv', 
		'orders-export-xls', 
		'orders-print-version', 
		'orders-content', 
		'orders', 
		'print-version', 
		//'payment-process', 
		'payment-page', 
		'printslab-change', 
		'printslab-order', 
		'printslab-upload-process', 
		'printslab-upload', 
		'printslab-delete', 
		'printslab-content', 
		'printslab-add-to-cart2', 
		'printslab-add-to-cart', 
		'printslab-add',
		'printslab-mockup', 
		'printslab-preupload', 
		'printslab', 
		'profile-downloads-table', 
		'profile-downloads-xls', 
		'profile-downloads', 
		'profile-document-upload', 
		'profile-photo-delete', 
		'profile-photo-upload', 
		'profile-about', 
		'profile-edit', 
		'profile',
		'publications-edit', 
		'publications', 
		'recognition-imagga', 
		'reviews-content', 
		'reviews-edit', 
		'reviews-change', 
		'reviews-delete', 
		'reviews-for-me', 
		'reviews', 
		'subscription', 
		'support-new', 
		'support-content', 
		'support-rating', 
		'support-add', 
		'support', 
		'testimonials-edit', 
		'testimonials-change', 
		'testimonials-delete', 
		'testimonials-for-me', 
		'testimonials', 		
		'upload_files_jquery',
		'upload-photo-jquery-process',
		'upload-photo-jquery',
		'upload-audio', 
		'upload-category', 
		'upload-photo-dropzone-process', 
		'upload-photo-dropzone', 
		'upload-photo-java-process', 
		'upload-photo-plupload-process', 
		'upload-photo-plupload', 
		'upload-photo', 
		'upload-vector', 
		'upload-video', 
		'upload'
	);
	
	$flag = true;
	
	if ( in_array(get_query_var('pvs_page'), $pvs_pages_auth ) and ! is_user_logged_in() ) {
		$flag = false;
	}
	
	if (get_query_var('pvs_page') == 'count' and ! $pvs_global_settings["auth_freedownload"]) {
		$flag = true;
	}
	
	return $flag;
}






/**
 * Check if session is necessary on the page
 */
function pvs_check_session () {
	global $pvs_global_settings;

	$pvs_pages_session = array (
		'billing-payment', 
		'billing-confirm', 
		'billing-coupon', 
		'billing', 
		'cart',
		'category-password',
		'check-facebook',
		'check-google',
		'check-twitter',
		'check-vk',
		'check-yandex',
		'check-guest',
		'check-instagram',
		'checkout-address', 
		'checkout-coupon', 
		'checkout-method', 
		'checkout-shipping', 
		'checkout',
		'orders-add', 
		'payment-process',
		'rights-managed-change', 
		'rights-managed', 	
		'signup-add', 
		'signup',
		'shopping-cart-add-lightbox', 
		'shopping-cart-add-light', 
		'shopping-cart-add-next', 
		'shopping-cart-add-prints-stock', 
		'shopping-cart-add-print', 		
		'shopping-cart-add-rights-managed', 
		'shopping-cart-add-collection', 
		'shopping-cart-add', 
		'shopping-cart-change-option', 
		'shopping-cart-change-new', 
		'shopping-cart-change', 
		'shopping-cart-clear', 
		'shopping-cart-delete-light', 
		'shopping-cart-delete'
	);
	
	$flag = false;
	
	if ( in_array(get_query_var('pvs_page'), $pvs_pages_session ) ) {
		$flag = true;
	}
	
	return $flag;
}



/**
 * Set .htaccess rules for previews and uploaded files
 */
function pvs_set_htaccess() {
	global $rs;
	
	$htaccess_path = get_home_path() . '.htaccess';
	
	if( file_exists($htaccess_path) and is_writeable($htaccess_path) ) {
		$htaccess_content = file_get_contents($htaccess_path);
		if ( ! preg_match('/BEGIN Photo Video Store/i',$htaccess_content)) {
			$htaccess_pvs ='
									# BEGIN Photo Video Store
									RewriteRule ^static([0-9]*)\/preview([0-9]*)\/[\w\-]+-([0-9]+).(jpg|jpeg|flv|mp4|mp3)$ wp-content/uploads/content$1/$3/thumb$2.$4 [L]
									# END Photo Video Store
									
									';
		
			file_put_contents($htaccess_path, $htaccess_pvs . $htaccess_content);
		}
	}
	
	$htaccess_pvs2 = '
								RewriteEngine On
								
								RewriteRule ([0-9]+)/thumb_original\.jpg$ ' . pvs_plugins_url() . '/assets/images/access_denied.gif
								
								RewriteCond %{REQUEST_URI} !thumb[A-Za-z0-9_]{0,}\.[A-Za-z0-9]+$ 
								RewriteRule ([0-9]+)/([A-Za-z0-9_\-]{0,})\.([A-Za-z0-9]+)$ ' . site_url() . '/download/?u=$1/$2.$3
								
								RemoveHandler .phtml .php .php3 .php4 .php5 .php6 .phps .cgi .exe .pl .asp .aspx .shtml .shtm .fcgi .fpl .jsp .htm .html .wml
								
								AddType text/html .phtml .php .php3 .php4 .php5 .php6 .phps .cgi .exe .pl .asp .aspx .shtml .shtm .fcgi .fpl .jsp .htm .html .wml 
								
								AddHandler server-parsed .phtml .php .php3 .php4 .php5 .php6 .phps .cgi .exe .pl .asp .aspx .shtml .shtm .fcgi .fpl .jsp .htm .html .wml
								';

	if ( ! file_exists( pvs_upload_dir() . "/content/.htaccess" ) and is_writeable(pvs_upload_dir() . "/content" ) ) {
		file_put_contents( pvs_upload_dir() . "/content/.htaccess", $htaccess_pvs2 );
	}

	if ( ! file_exists( pvs_upload_dir() . "/content2/.htaccess" ) and is_writeable(pvs_upload_dir() . "/content2" ) ) {
		file_put_contents( pvs_upload_dir() . "/content2/.htaccess", $htaccess_pvs2 );
	}
}



/**
 * Set cookies
 */
function pvs_set_cookies() {
	global $_REQUEST;
	global $_POST;
	global $_COOKIE;
	global $rs;
	global $ds;
	global $cookie_slow;
	$host = "." . parse_url(site_url(), PHP_URL_HOST);
	$path = "/";

	//Catalog view
	if ( isset( $_REQUEST["flow"] ) ) {
		setcookie( "flow_setting", (int) $_REQUEST["flow"], (time()+30 * 24 * 3600), $path, $host );
	}
	
	//Auto paging
	if ( isset( $_REQUEST["autopaging"] ) ) {
		setcookie( "autopaging_setting", (int) $_REQUEST["autopaging"], (time()+30 * 24 * 3600), $path, $host );
	}
	
	//Show left menu
	if ( isset( $_REQUEST["showmenu"] ) ) {
		setcookie( "showmenu_setting", (int) $_REQUEST["showmenu"], (time()+30 * 24 * 3600), $path, $host );
	}
	
	//Admin panel catalog view
	if ( isset( $_REQUEST["view"] ) ) {
		setcookie( "view_setting", (int) $_REQUEST["view"], (time()+30 * 24 * 3600), $path, $host );
	}
	
	//language
	if ( isset( $_REQUEST["lang"] ) ) {
		setcookie( "pvs_lang", pvs_result($_REQUEST["lang"]), (time()+30 * 24 * 3600), $path, $host );
	}
	
	//Stock
	if ( isset( $_REQUEST["stock"] ) ) {
		setcookie( "stock_selected", pvs_result( $_REQUEST["stock"] ), (time()+30 * 24 * 3600), $path, $host );
	}
	
	//Password protected
	if ( isset($_POST["id_parent"]) and isset($_POST["password"])  and isset($_POST["type"]) ) {
		$cprotected = "";
		
		if ( $_POST["type"] == 'category' ) {
			$idt = pvs_check_password( 0, ( int )$_POST["id_parent"], 1 );
			
			if ( $idt != 0 ) {
				$sql = "select id,password from " . PVS_DB_PREFIX .
					"category where id=" . ( int )$idt;
				$rs->open( $sql );
				if ( $rs->row["password"] == pvs_result($_POST["password"]) ) {
					$hash = substr(md5( pvs_result($_POST["password"]) . $idt ), 0, 7);
				
					if ( ! isset( $_COOKIE["cprotected"] ) ) {
						$cprotected = $hash;
					} else {
						$cprotected = $_COOKIE["cprotected"] . "|" . $hash;
					}
				}
			}		
		}
		
		if ( $_POST["type"] == 'item' ) {
			$sql = "select category_id from " . PVS_DB_PREFIX . "category_items where publication_id=" . ( int )$_POST["id_parent"];
			$ds->open($sql);
			while( !$ds->eof ) {
				$sql = "select id,password from " . PVS_DB_PREFIX .
					"category where id=" . $ds->row["category_id"];
				$rs->open( $sql );
				if ( $rs->row["password"] == pvs_result($_POST["password"]) ) {
					$hash = substr(md5( pvs_result($_POST["password"]) . $ds->row["category_id"] ), 0, 7);
					
					if ( ! isset( $_COOKIE["cprotected"] ) ) {
						$cprotected = $hash;
					} else {
						$cprotected = $_COOKIE["cprotected"] . "|" . $hash;
					}
				}
				$ds->movenext();
			}
		}
				
		if ( $cprotected != "" ) {
			setcookie( "cprotected", $cprotected, (time()+30 * 24 * 3600), $path, $host );
			//Cookies are created slowly so we reset the variable for the first time
			$_COOKIE["cprotected"] = $cprotected;
		}
	}
	
	//Affiliates
	if ( (int)@$_REQUEST["aff"] > 0 ) {
		setcookie( "aff", (int)$_REQUEST["aff"], (time()+30 * 24 * 3600), $path, $host );
		$user_info = get_userdata((int)$_REQUEST["aff"]);
		if ($user_info) {
			update_user_meta( (int)$_REQUEST["aff"], 'aff_visits', $user_info->aff_visits+1);
		}
	}
}




/**
 * Set default site language
 *
 * return $pvs_locale lang local
 */
function pvs_set_lang() {
	global $lang_name;
	global $lang_symbol;
	global $lang_wp;	
	global $lng;
	global $lng_original;
	global $pvs_site_langs;
	global $rs;
	global $_COOKIE;
	global $_SERVER;
	global $pvs_global_settings;
		
	if ($rs) {	
		$sql = "select name,metatags,activ from " . PVS_DB_PREFIX . "languages where display=1 order by name";
		$rs->open( $sql );
		while ( ! $rs->eof ) {
			if ( $rs->row["activ"] == 1) {
				$lng = $rs->row["name"];
				$lng_original = $rs->row["name"];
			}
			
			$pvs_site_langs[$rs->row["name"]] = $rs->row["metatags"];
			$rs->movenext();
		}
	
		if ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) and @$pvs_global_settings["language_detection"] ) {
			foreach ( $lang_symbol as $key => $value ) {
				if ( preg_match( "/" . $value . "/", $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) ) {
					$lng = $key;
					$lng_original = $key;
				}
			}
		}
				
		if ( isset( $_COOKIE['pvs_lang'] ) and $_COOKIE['pvs_lang'] != '' and isset($lang_name[@$_COOKIE['pvs_lang']]) ) {
			$lng = pvs_result(@$_COOKIE['pvs_lang']);
			$lng_original = pvs_result(@$_COOKIE['pvs_lang']);
		}
	
		
		if (isset($lang_wp[$lng])) {
			$pvs_locale = $lang_wp[$lng];
		} else {
			$pvs_locale = 'en_US';
		}
	} else {
		$lng = 'English';
		$lng_original = 'English';
		$pvs_locale = 'en_US';
	}
		
	return $pvs_locale;
}



/**
 * Translation function. Wrap for __()
 *
 * @param  string $text.
 * @return  string translation
 */
function pvs_word_lang( $text )
{
	
	$phrase_translation = __( $text, PVS_DOMAIN );
	$phrase_translation2 = __( strtolower( $text ), PVS_DOMAIN );

	if ( $phrase_translation != $text )
	{
		return $phrase_translation;
	} else
	{
		if ( $phrase_translation != strtolower( $text ) and $phrase_translation2 !=
			strtolower( $text ) )
		{
			return $phrase_translation2;
		} else
		{
			return $phrase_translation;
		}
	}
}




/**
 * Check admin access rights.
 */
function pvs_admin_panel_access( $param )
{
	if ( ! current_user_can( 'manage_options' ) )
	{
		exit();
	}
}




/**
 * The function returns upload dir path or URL
 *
 * @param  string $type 'basedir'.
 * @return  string upload path or URL
 */
function pvs_upload_dir( $type = 'basedir' )
{
	$upload_dir = wp_get_upload_dir();
	
	if ( is_multisite() ) {
		$upload_dir['baseurl'] = network_site_url( '/wp-content/uploads' );
    	$upload_dir['basedir'] = ABSPATH . 'wp-content/uploads';
	}

	return $upload_dir[$type];
}




/**
 * The function gets PVS global settings
 *
 */
function pvs_get_settings()
{
	global $pvs_global_settings;
	global $rs;

	$sql = "select setting_key,svalue from " . PVS_DB_PREFIX . "settings";
	$rs->open( $sql );
	while ( ! $rs->eof )
	{
		$pvs_global_settings[$rs->row["setting_key"]] = $rs->row["svalue"];

		$rs->movenext();
	}
	
	if ( PVS_LICENSE == 'Free' or PVS_LICENSE == 'Lite'  or ! @$pvs_global_settings[ 'act' . 'iv' .'a' . 't' . 'ion' ]  ) {
		$pvs_global_settings['userupload'] = 0;
		$pvs_global_settings['affiliates'] = 0;
		$pvs_global_settings['common_account'] = 0;
		$pvs_global_settings['examination'] = 0;
		$pvs_global_settings['seller_prices'] = 0;
	}
	
	if ( PVS_LICENSE == 'Free'  or ! @$pvs_global_settings[ 'a' . 'ct' . 'iva' . 't' . 'ion' ]) {
		$pvs_global_settings['prints_lab'] = 0;
		$pvs_global_settings['rights_managed'] = 0;
		$pvs_global_settings['rights_managed_sellers'] = 0;
		$pvs_global_settings['credits'] = 0;
		$pvs_global_settings['credits_currency'] = 0;
		$pvs_global_settings['subscription'] = 0;
		$pvs_global_settings['subscription_only'] = 0;
		$pvs_global_settings['no_calculation'] = 0;
		$pvs_global_settings['show_content_type'] = 0;
		$pvs_global_settings['messages'] = 0;
		$pvs_global_settings['testimonials'] = 0;
		$pvs_global_settings['reviews'] = 0;
		$pvs_global_settings['friends'] = 0;
		$pvs_global_settings['support'] = 0;
		$pvs_global_settings['multilingual_categories'] = 0;
		$pvs_global_settings['multilingual_publications'] = 0;
		$pvs_global_settings['taxes_cart'] = 0;
		$pvs_global_settings['show_in_stock'] = 0;
		$pvs_global_settings['seller_prints_quantity'] = 0;
		$pvs_global_settings['show_not_in_stock'] = 0;
		$pvs_global_settings['upload_previews'] = 0;
		$pvs_global_settings['collections'] = 0;
		$pvs_global_settings['invoices'] = 0;
		$pvs_global_settings['lightboxes'] = 0;
		
		$pvs_global_settings['prints_previews'] = 0;
		$pvs_global_settings['amazon'] = 0;
		$pvs_global_settings['rackspace'] = 0;
		$pvs_global_settings['backblaze'] = 0;
		$pvs_global_settings['eu_tax'] = 0;
	}
}



/**
 * The function gets a settings's value
 *
 * @param  string $key setting key.
 * @return string setting value.
 */
function pvs_settings_value($key)
{
	global $pvs_global_settings;
	return @$pvs_global_settings[$key];
}




/**
 * Get time in seconds
 *
 * @param int date and time.
 * @return int time in seconds.
 */
function pvs_get_time( $H = 0, $i = 0, $s = 0, $m = 0, $d = 0, $Y = 0 )
{
	if ( $H == 0 and $i == 0 and $s == 0 and $m == 0 and $d == 0 and $Y == 0 )
	{
		$current_time = mktime( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date
			( "d" ), date( "Y" ) );
	} else
	{
		$current_time = mktime( $H, $i, $s, $m, $d, $Y );
	}
	return $current_time;
}




/**
 * Make translate for non-latin letters in seo-friendly URLs
 *
 * @param string.
 * @return string.
 */
function pvs_make_translit( $stroka )
{
	//Russian
	$string_cirillic["а"] = "a";
	$string_cirillic["б"] = "b";
	$string_cirillic["в"] = "v";
	$string_cirillic["г"] = "g";
	$string_cirillic["д"] = "d";
	$string_cirillic["е"] = "e";
	$string_cirillic["ё"] = "e";
	$string_cirillic["ж"] = "zh";
	$string_cirillic["з"] = "z";
	$string_cirillic["и"] = "i";
	$string_cirillic["й"] = "y";
	$string_cirillic["к"] = "k";
	$string_cirillic["л"] = "l";
	$string_cirillic["м"] = "m";
	$string_cirillic["н"] = "n";
	$string_cirillic["о"] = "o";
	$string_cirillic["п"] = "p";
	$string_cirillic["р"] = "r";
	$string_cirillic["с"] = "s";
	$string_cirillic["т"] = "t";
	$string_cirillic["у"] = "u";
	$string_cirillic["ф"] = "f";
	$string_cirillic["х"] = "h";
	$string_cirillic["ц"] = "c";
	$string_cirillic["ч"] = "ch";
	$string_cirillic["ш"] = "sh";
	$string_cirillic["щ"] = "sch";
	$string_cirillic["ъ"] = "";
	$string_cirillic["ы"] = "y";
	$string_cirillic["ь"] = "";
	$string_cirillic["э"] = "e";
	$string_cirillic["ю"] = "yu";
	$string_cirillic["я"] = "ya";
	$string_cirillic["А"] = "A";
	$string_cirillic["Б"] = "B";
	$string_cirillic["В"] = "V";
	$string_cirillic["Г"] = "G";
	$string_cirillic["Д"] = "D";
	$string_cirillic["Е"] = "E";
	$string_cirillic["Ё"] = "E";
	$string_cirillic["Ж"] = "Zh";
	$string_cirillic["З"] = "Z";
	$string_cirillic["И"] = "I";
	$string_cirillic["Й"] = "Y";
	$string_cirillic["К"] = "K";
	$string_cirillic["Л"] = "L";
	$string_cirillic["М"] = "M";
	$string_cirillic["Н"] = "N";
	$string_cirillic["О"] = "O";
	$string_cirillic["П"] = "P";
	$string_cirillic["Р"] = "R";
	$string_cirillic["С"] = "S";
	$string_cirillic["Т"] = "T";
	$string_cirillic["У"] = "U";
	$string_cirillic["Ф"] = "F";
	$string_cirillic["Х"] = "H";
	$string_cirillic["Ц"] = "C";
	$string_cirillic["Ч"] = "Ch";
	$string_cirillic["Ш"] = "Sh";
	$string_cirillic["Щ"] = "Sch";
	$string_cirillic["Ы"] = "Y";
	$string_cirillic["Э"] = "E";
	$string_cirillic["Ю"] = "Yu";
	$string_cirillic["Я"] = "Ya";

	//French
	$string_cirillic["À"] = "A";
	$string_cirillic["à"] = "a";
	$string_cirillic["Â"] = "A";
	$string_cirillic["â"] = "a";
	$string_cirillic["Æ"] = "Ae";
	$string_cirillic["æ"] = "ae";
	$string_cirillic["Ç"] = "C";
	$string_cirillic["ç"] = "c";
	$string_cirillic["É"] = "E";
	$string_cirillic["é"] = "e";
	$string_cirillic["È"] = "E";
	$string_cirillic["è"] = "e";
	$string_cirillic["Ê"] = "E";
	$string_cirillic["ê"] = "e";
	$string_cirillic["Ë"] = "E";
	$string_cirillic["ë"] = "e";
	$string_cirillic["Î"] = "I";
	$string_cirillic["î"] = "i";
	$string_cirillic["Ï"] = "I";
	$string_cirillic["ï"] = "i";
	$string_cirillic["Ô"] = "O";
	$string_cirillic["ô"] = "o";
	$string_cirillic["Œ"] = "Oe";
	$string_cirillic["œ"] = "oe";
	$string_cirillic["Ù"] = "U";
	$string_cirillic["ù"] = "u";
	$string_cirillic["Û"] = "U";
	$string_cirillic["û"] = "u";
	$string_cirillic["Ü"] = "U";
	$string_cirillic["ü"] = "u";
	$string_cirillic["Ÿ"] = "Y";
	$string_cirillic["ÿ"] = "y";

	//Polish
	$string_cirillic["Ą"] = "A";
	$string_cirillic["Ć"] = "C";
	$string_cirillic["Ę"] = "E";
	$string_cirillic["Ł"] = "L";
	$string_cirillic["Ń"] = "N";
	$string_cirillic["Ó"] = "O";
	$string_cirillic["Ś"] = "S";
	$string_cirillic["Ź"] = "Z";
	$string_cirillic["Ż"] = "Z";
	$string_cirillic["ą"] = "a";
	$string_cirillic["ć"] = "c";
	$string_cirillic["ę"] = "e";
	$string_cirillic["ł"] = "l";
	$string_cirillic["ń"] = "n";
	$string_cirillic["ó"] = "o";
	$string_cirillic["ś"] = "s";
	$string_cirillic["ź"] = "z";
	$string_cirillic["ż"] = "z";

	//Spanish
	$string_cirillic["Ñ"] = "N";
	$string_cirillic["ñ"] = "n";
	$string_cirillic["á"] = "a";
	$string_cirillic["é"] = "e";
	$string_cirillic["í"] = "i";

	//Albanian
	$string_cirillic["ë"] = "e";
	$string_cirillic["ç"] = "c";
	$string_cirillic["Ë"] = "e";
	$string_cirillic["Ç"] = "c";

	$stroka = strtr( $stroka, $string_cirillic );
	return $stroka;
}




/**
 * Check variables for sql queries
 *
 * @param string.
 * @return string.
 */
function pvs_result( $entry )
{
	return esc_sql( $entry );
}




/**
 * Check variables for includes
 *
 * @param string.
 * @return string.
 */
function pvs_result_strict( $entry )
{
	$entry = pvs_result( $entry );
	$entry = preg_replace( '/[^a-z0-9\-_:\. ]/i', '', $entry );
	return $entry;
}




/**
 * Check uploaded filenames and extentions
 *
 * @param string.
 * @return string.
 */
function pvs_result_file( $entry )
{
	if ( preg_match( "/php|txt|html|js|phtml/i", $entry ) )
	{
		echo ( "Error. The filename is not permitted. Please rename the file." );
		exit();
	}

	$entry = str_replace( array(
		'&',
		'?',
		'#',
		'/',
		'%00' ), '', $entry );
	$entry = str_replace( ".php", "", $entry );
	return $entry;
}





/**
 * Generate a new password, a random string
 *
 * @return string.
 */
function pvs_create_password()
{
	$stroka = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-!";
	$password = "";
	for ( $i = 0; $i < 9; $i++ )
	{
		$password .= $stroka[rand( 0, strlen( $stroka ) - 1 )];
	}
	return $password;
}





/**
 * Make price format 1.00
 *
 * @param float $t_entry price.
 * @param int $t_kolvo digits after dot.
 * @param bool $cr if price in Credits, not to use price format.
 * @return float.
 */
function pvs_price_format( $t_entry, $t_kolvo = 2, $cr = false )
{
	global $pvs_global_settings;
	if ( $cr == true and @$pvs_global_settings["credits"] )
	{
		return $t_entry;
	} else
	{
		$t_entry = number_format( ( float )$t_entry, $t_kolvo, '.', '' );
		return $t_entry;
	}
}




/**
 * Update setting
 *
 * @param string $setting_key.
 * @param string $setting_value.
 */
function pvs_update_setting($setting_key, $setting_value) {
	global $db;
	global $pvs_global_settings;
	
	if ( isset($pvs_global_settings[$setting_key]) ) {
		$sql = "update " . PVS_DB_PREFIX . "settings set svalue='" . pvs_result($setting_value) . "' where setting_key='" . pvs_result($setting_key) . "'";
		$db->execute( $sql );
	}
}





/**
 * Create upload folders during the installation
 *
 */
function pvs_create_upload_folders() {
	if ( ! file_exists( pvs_upload_dir() . "/content" ) )
	{
		mkdir( pvs_upload_dir() . "/content" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content2" ) )
	{
		mkdir( pvs_upload_dir() . "/content2" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/categories" ) )
	{
		mkdir( pvs_upload_dir() . "/content/categories" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/galleries" ) )
	{
		mkdir( pvs_upload_dir() . "/content/galleries" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/models" ) )
	{
		mkdir( pvs_upload_dir() . "/content/models" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/printful" ) )
	{
		mkdir( pvs_upload_dir() . "/content/printful" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/prints" ) )
	{
		mkdir( pvs_upload_dir() . "/content/prints" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/pwinty" ) )
	{
		mkdir( pvs_upload_dir() . "/content/pwinty" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/photopreupload" ) )
	{
		mkdir( pvs_upload_dir() . "/content/photopreupload" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/videopreupload" ) )
	{
		mkdir( pvs_upload_dir() . "/content/videopreupload" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/audiopreupload" ) )
	{
		mkdir( pvs_upload_dir() . "/content/audiopreupload" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/vectorpreupload" ) )
	{
		mkdir( pvs_upload_dir() . "/content/vectorpreupload" );
	}
	
	if ( ! file_exists( pvs_upload_dir() . "/content/users" ) )
	{
		mkdir( pvs_upload_dir() . "/content/users" );
	}
}





/**
 * Check if a db table's column exists
 *
 * @param string $table_name.
 * @param string $column_name.
 * @return bool
 */
function pvs_table_column_exists( $table_name, $column_name ) {
	global $wpdb;
	$column = $wpdb->get_results( $wpdb->prepare(
		"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
		DB_NAME, $table_name, $column_name
	) );
	if ( ! empty( $column ) ) {
		return true;
	}
	return false;
}





/**
 * Image Functions
 */




/**
 * Image fast resize function. Optimized wrap for php GD imagecopyresampled() function
 *
 * @return bool
 */
function pvs_fastimagecopyresampled( $dst_image, $src_image, $dst_x, $dst_y, $src_x,
	$src_y, $dst_w, $dst_h, $src_w, $src_h, $quality = 3 )
{
	// Plug-and-Play pvs_fastimagecopyresampled function replaces much slower imagecopyresampled.
	// Just include this function and change all "imagecopyresampled" references to "pvs_fastimagecopyresampled".
	// Typically from 30 to 60 times faster when reducing high resolution images down to thumbnail size using the default quality setting.
	// Author: Tim Eckel - Date: 09/07/07 - Version: 1.1 - Project: FreeRingers.net - Freely distributable - These comments must remain.
	//
	// Optional "quality" parameter (defaults is 3). Fractional values are allowed, for example 1.5. Must be greater than zero.
	// Between 0 and 1 = Fast, but mosaic results, closer to 0 increases the mosaic effect.
	// 1 = Up to 350 times faster. Poor results, looks very similar to imagecopyresized.
	// 2 = Up to 95 times faster.  Images appear a little sharp, some prefer this over a quality of 3.
	// 3 = Up to 60 times faster.  Will give high quality smooth results very close to imagecopyresampled, just faster.
	// 4 = Up to 25 times faster.  Almost identical to imagecopyresampled for most images.
	// 5 = No speedup. Just uses imagecopyresampled, no advantage over imagecopyresampled.

	if ( empty( $src_image ) || empty( $dst_image ) || $quality <= 0 )
	{
		return false;
	}
	if ( $quality < 5 && ( ( $dst_w * $quality ) < $src_w || ( $dst_h * $quality ) <
		$src_h ) )
	{
		$temp = imagecreatetruecolor( $dst_w * $quality + 1, $dst_h * $quality + 1 );
		imagecopyresized( $temp, $src_image, 0, 0, $src_x, $src_y, $dst_w * $quality + 1,
			$dst_h * $quality + 1, $src_w, $src_h );
		imagecopyresampled( $dst_image, $temp, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $dst_w *
			$quality, $dst_h * $quality );
		imagedestroy( $temp );
	} else
		imagecopyresampled( $dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w,
			$dst_h, $src_w, $src_h );
	return true;
}





/**
 * Images resize function
 *
 * @param  string $img_sourse image path
 * @param  string $save_to image path
 * @param  int $quality JPG quality in %
 * @param  int $width image width
 */
function pvs_easyResize( $img_sourse, $save_to, $quality, $width )
{
	global $pvs_global_settings;
	$size = GetImageSize( $img_sourse );
	$new_height = ( $width * $size[1] ) / $size[0]; // Generate new height for image

	$fextention = strtolower( pvs_get_file_info( $img_sourse, "extention" ) );
	$fextention2 = strtolower( pvs_get_file_info( $save_to, "extention" ) );

	$resize_method = strtolower( $pvs_global_settings["image_resize"] );

	if ( $resize_method == "imagemagick" and ! class_exists( 'Imagick' ) )
	{
		$resize_method = "gd";
	}

	if ( $resize_method == "gd" )
	{
		if ( $fextention == "jpg" or $fextention == "jpeg" )
		{
			$im_in = ImageCreateFromJPEG( $img_sourse );
			$im_out = imagecreatetruecolor( $width, $new_height );
			if ( $width < $pvs_global_settings["thumb_width2"] + 1 )
			{
				pvs_fastimagecopyresampled( $im_out, $im_in, 0, 0, 0, 0, $width, $new_height, $size[0],
					$size[1] );
			} else
			{
				imagecopyresampled( $im_out, $im_in, 0, 0, 0, 0, $width, $new_height, $size[0],
					$size[1] );
			}
		}

		if ( $fextention == "png" )
		{
			$im_in = ImageCreateFromPNG( $img_sourse );
			$im_out = imagecreatetruecolor( $width, $new_height );

			if ( $fextention2 == "png" )
			{
				imagealphablending( $im_out, false );
				imagesavealpha( $im_out, true );
				$transparent = imagecolorallocatealpha( $im_out, 255, 255, 255, 127 );
				imagefilledrectangle( $im_out, 0, 0, $width, $new_height, $transparent );
			} else
			{
				imagefill( $im_out, 0, 0, imagecolorallocate( $im_out, 255, 255, 255 ) );
				imagealphablending( $im_out, TRUE );
				//imagecopy($im_out, $im_in, 0, 0, 0, 0,$size[0],$size[1]);
			}

			imagecopyresampled( $im_out, $im_in, 0, 0, 0, 0, $width, $new_height, $size[0],
				$size[1] );
		}

		if ( $fextention == "gif" )
		{
			$im_in = ImageCreateFromGIF( $img_sourse );
			$im_out = imagecreatetruecolor( $width, $new_height );

			$transparency = imagecolortransparent( $im_in );
			if ( $transparency >= 0 )
			{
				$transparent_color = imagecolorsforindex( $im_in, $transparency );
				$transparency = imagecolorallocate( $im_out, $transparent_color['red'], $transparent_color['green'],
					$transparent_color['blue'] );
				imagefill( $im_out, 0, 0, $transparency );
				imagecolortransparent( $im_out, $transparency );
			}

			imagecopyresampled( $im_out, $im_in, 0, 0, 0, 0, $width, $new_height, $size[0],
				$size[1] );
		}

		if ( $fextention2 == "jpg" or $fextention2 == "jpeg" )
		{
			ImageJPEG( $im_out, $save_to, 100 );
		}

		if ( $fextention2 == "png" )
		{
			ImagePNG( $im_out, $save_to );
		}

		if ( $fextention2 == "gif" )
		{
			ImageGIF( $im_out, $save_to );
		}

		ImageDestroy( $im_in );
		ImageDestroy( $im_out );
	}

	if ( $resize_method == "imagemagick" )
	{
		$image = new Imagick( $img_sourse );
		$image->resizeImage( $width, $new_height, Imagick::FILTER_LANCZOS, 0.8 );
		$image->writeImage( $save_to );
		$image->destroy();
	}

}





/**
 * The function sets dpi for the photos
 *
 * @param  string $save_to image path
 */
function pvs_set_dpi( $save_to )
{
	global $pvs_global_settings;

	$fextention = strtolower( pvs_get_file_info( $save_to, "extention" ) );

	if ( $fextention == "jpg" or $fextention == "jpeg" )
	{
		// Change DPI
		$dpi_x = ( int )$pvs_global_settings["resolution_dpi"];
		$dpi_y = ( int )$pvs_global_settings["resolution_dpi"];

		if ( $dpi_x > 0 and $dpi_y > 0 )
		{
			$img = file_get_contents( $save_to );

			// Update DPI information in the JPG header
			$img[13] = chr( 1 );
			$img[14] = chr( floor( $dpi_x / 255 ) );
			$img[15] = chr( $dpi_x % 255 );
			$img[16] = chr( floor( $dpi_y / 255 ) );
			$img[17] = chr( $dpi_y % 255 );

			// Write the new JPG
			file_put_contents( $save_to, $img );
		}
	}
}






/**
 * Panorama Images resize function
 *
 * @param  string $img_sourse image path
 * @param  string $save_to image path
 * @param  int $photo_vars, 1 - small preview, 2 - big preview 
 */
function pvs_resize_panorama( $img_sourse, $save_to, $photo_vars )
{
	global $pvs_global_settings;

	$size = GetImageSize( $img_sourse );

	$image_height = $size[1];
	$image_width = round( 3 * $size[1] / 2 );

	if ( $photo_vars == 1 )
	{
		$thumb_width = $pvs_global_settings["thumb_width"];
		$thumb_height = round( 2 * $pvs_global_settings["thumb_width"] / 3 );
	}
	if ( $photo_vars == 2 )
	{
		$thumb_width = $pvs_global_settings["thumb_width2"];
		$thumb_height = round( 2 * $pvs_global_settings["thumb_width2"] / 3 );
	}

	$im_in = ImageCreateFromJPEG( $img_sourse );

	$im_out = imagecreatetruecolor( $thumb_width, $thumb_height );

	pvs_fastimagecopyresampled( $im_out, $im_in, 0, 0, 0, 0, $thumb_width, $thumb_height,
		$image_width, $image_height );

	//imageinterlace($im_out, true);

	ImageJPEG( $im_out, $save_to, 100 ); // Create image
	ImageDestroy( $im_in );
	ImageDestroy( $im_out );
}





/**
 * Set watermark
 *
 * @param  string $img_sourse image path
 * @param  string $png_file png watermark path
 */
function pvs_watermark( $img_sourse, $png_file )
{
	global $pvs_global_settings;

	$fextention = strtolower( pvs_get_file_info( $img_sourse, "extention" ) );

	$sz = getimagesize( $img_sourse );
	$wz = getimagesize( $png_file );

	$px = 0;
	$py = 0;
	$wx = 0;
	$wy = 0;
	if ( $wz[0] < $sz[0] and $wz[1] < $sz[1] )
	{
		if ( $pvs_global_settings["watermark_position"] == 1 )
		{
			$px = 0;
			$py = 0;
		} elseif ( $pvs_global_settings["watermark_position"] == 2 )
		{
			$px = ( $sz[0] - $wz[0] ) / 2;
			$py = 0;
		} elseif ( $pvs_global_settings["watermark_position"] == 3 )
		{
			$px = $sz[0] - $wz[0];
			$py = 0;
		} elseif ( $pvs_global_settings["watermark_position"] == 4 )
		{
			$px = 0;
			$py = ( $sz[1] - $wz[1] ) / 2;
		} elseif ( $pvs_global_settings["watermark_position"] == 5 )
		{
			$px = ( $sz[0] - $wz[0] ) / 2;
			$py = ( $sz[1] - $wz[1] ) / 2;
		} elseif ( $pvs_global_settings["watermark_position"] == 6 )
		{
			$px = $sz[0] - $wz[0];
			$py = ( $sz[1] - $wz[1] ) / 2;
		} elseif ( $pvs_global_settings["watermark_position"] == 7 )
		{
			$px = 0;
			$py = $sz[1] - $wz[1];
		} elseif ( $pvs_global_settings["watermark_position"] == 8 )
		{
			$px = ( $sz[0] - $wz[0] ) / 2;
			$py = $sz[1] - $wz[1];
		} else
		{
			$px = $sz[0] - $wz[0];
			$py = $sz[1] - $wz[1];
		}
	}

	if ( $wz[0] >= $sz[0] and $wz[1] >= $sz[1] )
	{
		$px = 0;
		$py = 0;
		$wx = ( $wz[0] - $sz[0] ) / 2;
		$wy = ( $wz[1] - $sz[1] ) / 2;
	}

	if ( $wz[0] < $sz[0] and $wz[1] >= $sz[1] )
	{
		$px = ( $sz[0] - $wz[0] ) / 2;
		$py = 0;
		$wx = 0;
		$wy = ( $wz[1] - $sz[1] ) / 2;
	}

	if ( $wz[0] >= $sz[0] and $wz[1] < $sz[1] )
	{
		$px = 0;
		$py = ( $sz[1] - $wz[1] ) / 2;
		$wx = ( $wz[0] - $sz[0] ) / 2;
		$wy = 0;
	}

	$resize_method = strtolower( $pvs_global_settings["image_resize"] );

	if ( $resize_method == "imagemagick" and ! class_exists( 'Imagick' ) )
	{
		$resize_method = "gd";
	}

	if ( $resize_method == "gd" )
	{
		$im1 = imagecreatefrompng( $png_file );

		if ( $fextention == "jpg" or $fextention == "jpeg" )
		{
			$im2 = ImageCreateFromJPEG( $img_sourse );
		}

		if ( $fextention == "png" )
		{
			$im2 = ImageCreateFromPNG( $img_sourse );
		}

		if ( $fextention == "gif" )
		{
			$im2 = ImageCreateFromGIF( $img_sourse );
		}

		imagecopy( $im2, $im1, ( int )$px, ( int )$py, ( int )$wx, ( int )$wy, $wz[0], $wz[1] );

		if ( $fextention == "jpg" or $fextention == "jpeg" )
		{
			ImageJPEG( $im2, $img_sourse, 100 );
		}

		if ( $fextention == "png" )
		{
			ImagePNG( $im2, $img_sourse );
		}

		if ( $fextention == "gif" )
		{
			ImageGIF( $im2, $img_sourse );
		}

		ImageDestroy( $im1 );
		ImageDestroy( $im2 );
	}

	if ( $resize_method == "imagemagick" )
	{
		$image = new Imagick( $img_sourse );

		$watermark_img = new Imagick();
		$watermark_img->readImage( $png_file );
		$image->compositeImage( $watermark_img, imagick::COMPOSITE_OVER, ( int )$px, ( int )
			$py );

		$image->writeImage( $img_sourse );

		$image->destroy();
		$watermark_img->destroy();
	}
}





/**
 * Get resizes photo previews: thumb1; thumb2
 *
 * @param  string $photo_in image path
 * @param  string $photo_out image path
 * @param  int $photo_vars, 1 - small preview, 2 - big preview 
 */
function pvs_photo_resize( $photo_in, $photo_out, $photo_vars )
{
	global $pvs_global_settings;

	if ( file_exists( $photo_in ) )
	{
		$size = getimagesize( $photo_in );
		$wd1 = $pvs_global_settings["thumb_width"];
		$wd2 = $pvs_global_settings["thumb_width2"];
		$wd3 = $pvs_global_settings["prints_previews_width"];

		if ( isset( $size[1] ) )
		{
			if ( $size[0] < $size[1] and $size[1] != 0 )
			{
				$wd1 = $size[0] * $pvs_global_settings["thumb_height"] / $size[1];
				$wd2 = $size[0] * $pvs_global_settings["thumb_height2"] / $size[1];
				$wd3 = $size[0] * $pvs_global_settings["prints_previews_width"] / $size[1];
			}
		}

		//Cut panorama previews.
		$panorama_flag = false;
		if ( $size[0] / $size[1] > 3 )
		{
			$panorama_flag = true;
		}
		//Disable panorama previews
		$panorama_flag = false;

		//Small photo preview
		if ( $photo_vars == 1 )
		{
			if ( $panorama_flag )
			{
				pvs_resize_panorama( $photo_in, $photo_out, 1 );
			} else
			{
				pvs_easyResize( $photo_in, $photo_out, 100, $wd1 );
			}
		}

		//Big photo preview
		if ( $photo_vars == 2 )
		{
			if ( $panorama_flag )
			{
				pvs_resize_panorama( $photo_in, $photo_out, 2 );
			} else
			{
				pvs_easyResize( $photo_in, $photo_out, 100, $wd2 );
			}
		}

		//Print's preview
		if ( $photo_vars == 3 )
		{
			pvs_easyResize( $photo_in, $photo_out, 100, $wd3 );
		}
	}
}






/**
 * Define a photo's color distance
 *
 */
function getDistance($arr1, $arr2, $l) {
    $s = 0;
    for($i = 0; $i < $l; ++$i)
        $s += $arr1[$i] > $arr2[$i] ? ($arr1[$i] - $arr2[$i]) : ($arr2[$i] - $arr1[$i]);
    return $s;
}





/**
 * Define a photo's color
 * Author: https://ru.stackoverflow.com/users/1720/iproger
 */
function pvs_define_color($photo_id, $url, $amount = 1, $sort = true, $maxPreSize = 50, $epselon = 1) {
	global $db;
	global $pvs_global_settings;
	
    if (file_exists($url) or preg_match("/^http/i", $url) ) {	
		$size = @getimagesize($url);
		$width = $size[0];
		$height = $size[1];
	
		$format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
		if($format == 'x-ms-bmp')
			$format = 'wbmp';
		$func = 'imagecreatefrom'.$format;
		if(!function_exists($func))
			return false;
		$bitmap = @$func($url);
		if(!$bitmap)
			return false;
	
		$newW = $width > $maxPreSize ? $maxPreSize : $width;
		$newH = $height > $maxPreSize ? $maxPreSize : $height;
		$bitmapNew = imagecreatetruecolor($newW, $newH);
		
		//imagecopyresampled($bitmapNew, $bitmap, 0, 0, 0, 0, $newW, $newH, $width, $height);
		imagecopyresized($bitmapNew, $bitmap, 0, 0, 0, 0, $newW, $newH, $width, $height);
	
		$pixelsAmount = $newW * $newH;
		$pixels = Array();
		for($i = 0; $i < $newW; ++$i)
			for($j = 0; $j < $newH; ++$j) {
				$rgb = imagecolorat($bitmapNew, $i, $j);
				$pixels[] = Array(
					($rgb >> 16) & 0xFF,
					($rgb >> 8) & 0xFF,
					$rgb & 0xFF
				);
			}
		imagedestroy($bitmapNew);
	
		$clusters = Array();
		$pixelsChosen = Array();
		for($i = 0; $i < $amount; ++$i) {
			do {
				$id = rand(0, $pixelsAmount - 1);
			} while(in_array($id, $pixelsChosen));
			$pixelsChosen[] = $id;
			$clusters[] = $pixels[$id];
		}
	
		$clustersPixels = Array();
		$clustersAmounts = Array();
	
		do {
			for($i = 0; $i < $amount; ++$i) {
				$clustersPixels[$i] = Array();
				$clustersAmounts[$i] = 0;
			}
			
			for($i = 0; $i < $pixelsAmount; ++$i) {
				$distMin = -1;
				$id = 0;
				for($j = 0; $j < $amount; ++$j) {
					$dist = getDistance($pixels[$i], $clusters[$j], 3);
					if($distMin == -1 or $dist < $distMin) {
						$distMin = $dist;
						$id = $j;
					}
				}
				$clustersPixels[$id][] = $i;
				++$clustersAmounts[$id];
			}
	
			$diff = 0;
			for($i = 0; $i < $amount; ++$i) {
				if($clustersAmounts[$i] > 0) {
					$old = $clusters[$i];
					for($k = 0; $k < 3; ++$k) {
						$clusters[$i][$k] = 0;
						for($j = 0; $j < $clustersAmounts[$i]; ++$j)
							$clusters[$i][$k] += $pixels[$clustersPixels[$i][$j]][$k];
						$clusters[$i][$k] /= $clustersAmounts[$i];
					}
	
					$dist = getDistance($old, $clusters[$i], 3);
					$diff = $diff > $dist ? $diff : $dist;
				}
			}
		} while($diff >= $epselon);
	
		if($sort and $amount > 1)
			for($i = 1; $i < $amount; ++$i)
				for($j = $i; $j >= 1 and $clustersAmounts[$j] > $clustersAmounts[$j - 1]; --$j) {
					$t = $clustersAmounts[$j - 1];
					$clustersAmounts[$j - 1] = $clustersAmounts[$j];
					$clustersAmounts[$j] = $t;
	
					$t = $clusters[$j - 1];
					$clusters[$j - 1] = $clusters[$j];
					$clusters[$j] = $t;
				}
	
		for($i = 0; $i < $amount; ++$i)
			for($j = 0; $j < 3; ++$j)
				$clusters[$i][$j] = floor($clusters[$i][$j]);
	
		imagedestroy($bitmap);
	
		$sql = "delete from " . PVS_DB_PREFIX . "colors where publication_id=" . (int) $photo_id;
		$db -> execute($sql);
		
		$i = 1;
		foreach ( $clusters as $key => $value )
		{
			$color = dechex($value[0]) . dechex($value[1]) . dechex($value[2]);
			
			$sql = "insert into " . PVS_DB_PREFIX . "colors (publication_id, color, red, green, blue,priority) values (" . $photo_id . ", '" . $color . "', " . (int) $value[0] . ", " . (int) $value[1] . ", " . (int) $value[2] . ", " . $i . ")";
			$db -> execute($sql);
			$i++;
		}
    }
}






/**
 * The function calculates an image size
 *
 * @param  int $id media ID
 * @return array
 */
function pvs_define_thumb_size( $id )
{
	global $pvs_global_settings;
	global $db;
	global $dr;
	global $ds;
	global $_SERVER;

	$size_result = array();
	$img_preview = "";
	$img_preview2 = "";
	$width = 0;
	$height = 0;
	$sql = "select media_id from " . PVS_DB_PREFIX . "media where id=" . $id;
	$dr->open( $sql );
	if ( ! $dr->eof )
	{
		if ( pvs_media_type ($dr->row["media_id"]) == 'photo' )
		{
			$img_preview = pvs_show_preview( $id, "photo", 1, 1, "", "" );
			$img_preview2 = pvs_show_preview( $id, "photo", 1, 1, "", "", false );
			$sql = "select url,filename1,filename2,width,height from " . PVS_DB_PREFIX .
				"filestorage_files where id_parent=" . $id . " and filename1 like '%thumb1%'";
		}
		if ( pvs_media_type ($dr->row["media_id"]) == 'video' )
		{
			$img_preview = pvs_show_preview( $id, "video", 1, 1, "", "" );
			$img_preview2 = pvs_show_preview( $id, "video", 1, 1, "", "", false );
			$sql = "select url,filename1,filename2,width,height from " . PVS_DB_PREFIX .
				"filestorage_files where id_parent=" . $id .
				" and filename1 like '%thumb%' order by filename1";
		}
		if ( pvs_media_type ($dr->row["media_id"]) == 'audio' )
		{
			$img_preview = pvs_show_preview( $id, "audio", 1, 1, "", "" );
			$img_preview2 = pvs_show_preview( $id, "audio", 1, 1, "", "", false );
			$sql = "select url,filename1,filename2,width,height from " . PVS_DB_PREFIX .
				"filestorage_files where id_parent=" . $id .
				" and filename1 like '%thumb%' order by filename1";
		}
		if ( pvs_media_type ($dr->row["media_id"]) == 'vector' )
		{
			$img_preview = pvs_show_preview( $id, "vector", 1, 1, "", "" );
			$img_preview2 = pvs_show_preview( $id, "vector", 1, 1, "", "", false );
			$sql = "select url,filename1,filename2,width,height from " . PVS_DB_PREFIX .
				"filestorage_files where id_parent=" . $id .
				" and (filename1 like '%thumb1%' or filename1 like '%thumb%')";
		}

		if ( $sql != "" and $img_preview2 != "" )
		{
			if ( file_exists( str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), $img_preview2) ) ) {
				$size = getimagesize( str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), $img_preview2) );
				$width = $size[0];
				$height = $size[1];
			} else {
				if ( pvs_is_remote_storage() )
				{
					$ds->open( $sql );
					if ( ! $ds->eof )
					{
						$width = $ds->row["width"];
						$height = $ds->row["height"];
					}
				}
			}
		}
	}

	$size_result["width"] = $width;
	$size_result["height"] = $height;
	$size_result["thumb"] = $img_preview;

	return $size_result;
}





/**
 * Publication Functions
 */




/**
 * Remove uploaded files
 *
 * @param  int $id media ID.
 * @param  bool $folder_delete.
 */
function pvs_delete_files( $id, $folder_delete = true )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$folder = ( int )$id;
	$server1 = "";

	$sql = "select server1 from " . PVS_DB_PREFIX . "media where id=" . ( int )
		$id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$server1 = $dp->row["server1"];
	}

	if ( $folder != "" and file_exists( pvs_upload_dir() .
		pvs_server_url( $server1 ) . "/" . $folder ) )
	{
		$dir = opendir( pvs_upload_dir() . pvs_server_url( $server1 ) .
			"/" . $folder );
		while ( $file = readdir( $dir ) )
		{
			if ( $file <> "." && $file <> ".." )
			{
				@unlink( pvs_upload_dir() . pvs_server_url( $server1 ) .
					"/" . $folder . "/" . $file );

			}
		}

		if ( $folder_delete )
		{
			@rmdir( pvs_upload_dir() . pvs_server_url( $server1 ) . "/" .
				$folder );
		}
	}

}




/**
 * Generate flv/mp4 and jpg video previews by FFMPEG
 *
 * @param  string $apath video path.
 * @param  bool $delete_source delete a video source.
 * @param  int $id media ID.
 */
function pvs_generate_video_preview( $apath, $delete_source, $id )
{
	global $pvs_global_settings;

	if ( file_exists( $apath ) )
	{
		//Define movie size
		$duration = $pvs_global_settings["ffmpeg_duration"];

		$wd = $pvs_global_settings["ffmpeg_video_width"];
		$ht = $pvs_global_settings["ffmpeg_video_height"];

		//Define video file name
		$fln = explode( "/", $apath );
		$original_name = $fln[count( $fln ) - 1];

		//Define flv file name
		if ( $pvs_global_settings["ffmpeg_video_format"] == "flv" )
		{
			$flv_name = "thumb.flv";
		} else
		{
			$flv_name = "thumb.mp4";
		}

		//Define flv file path
		$flv_path = "";
		for ( $i = 0; $i < count( $fln ) - 1; $i++ )
		{
			if ( $i != 0 )
			{
				$flv_path .= "/";
			}
			$flv_path .= $fln[$i];
		}
		$thumb_path = $flv_path;
		$flv_path .= "/" . $flv_name;

		//FFMPEG command
		if ( $pvs_global_settings["ffmpeg_video_format"] == "flv" )
		{
			if ( $pvs_global_settings["ffmpeg_watermark"] )
			{
				$com = $pvs_global_settings["ffmpeg_path"] . " -i \"" . $apath . "\" -b 300k -ar 22050 -t " .
					$duration . " -vf 'movie=" . pvs_upload_dir() .
					"/content/watermark.png [wm];[in][wm] overlay=(main_w-overlay_w-10)/2:(main_h-overlay_h-10)/2 [out]' -f flv -s " .
					$wd . "x" . $ht . " " . $flv_path;
			} else
			{
				$com = $pvs_global_settings["ffmpeg_path"] . " -i \"" . $apath . "\" -b 300k -ar 22050 -t " .
					$duration . " -f flv -s " . $wd . "x" . $ht . " " . $flv_path;
			}
		} else
		{
			if ( $pvs_global_settings["ffmpeg_watermark"] )
			{
				$com = $pvs_global_settings["ffmpeg_path"] . " -i \"" . $apath . "\" -vcodec libx264 -strict -2  -t " .
					$duration . "  -vf 'movie=" . pvs_upload_dir() .
					"/content/watermark.png [wm];[in][wm] overlay=(main_w-overlay_w-10)/2:(main_h-overlay_h-10)/2 [out]' " .
					$flv_path;

				//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec libx264 -vpre medium -strict -2  -t ".$duration."  -vf 'movie=".pvs_upload_dir()."/content/watermark.png [wm];[in][wm] overlay=(main_w-overlay_w-10)/2:(main_h-overlay_h-10)/2 [out]' ".$flv_path;

				//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec libx264 -preset medium -strict -2  -t ".$duration."  -vf 'movie=".pvs_upload_dir()."/content/watermark.png [wm];[in][wm] overlay=(main_w-overlay_w-10)/2:(main_h-overlay_h-10)/2 [out]' ".$flv_path;
			} else
			{
				//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec libx264  -vpre medium -strict -2  -t ".$duration."  ".$flv_path;

				//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec libx264  -preset medium -strict -2  -t ".$duration."  ".$flv_path;

				$com = $pvs_global_settings["ffmpeg_path"] . " -i \"" . $apath . "\" -vcodec libx264 -strict -2  -t " .
					$duration . "  " . $flv_path;
			}

			//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -b 300k -ar 22050 -t ".$duration." -f mp4 -s ".$wd."x".$ht." ".$flv_path;
			//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec mpeg4 -movflags faststart  -an -b 150k -vf scale=400:-1  -t ".$duration."  ".$flv_path;
			//$com=$pvs_global_settings["ffmpeg_path"]." -i \"".$apath."\" -vcodec copy  -b 300k -ar 22050  -t ".$duration."  ".$flv_path;
		}
		@exec( $com );

		//Do jpg photo preview
		//$step=round($duration/($pvs_global_settings["ffmpeg_frequency"]+1));
		$step = 1;

		for ( $i = 1; $i < $pvs_global_settings["ffmpeg_frequency"] + 1; $i++ )
		{
			if ( $duration > $step * $i )
			{
				$preview_time = 1 + $step * ( $i - 1 );

				//$com=$pvs_global_settings["ffmpeg_path"]." -itsoffset -1 -i \"".$apath."\" -vcodec mjpeg -vframes 1 -an -f rawvideo ".$thumb_path."/thumb".($i-1).".jpg";
				$com = $pvs_global_settings["ffmpeg_path"] . " -y -i \"" . $apath . "\" -an -ss " .
					$preview_time . " -an -r 1 -vframes 1 -y -vcodec mjpeg -f mjpeg " . $thumb_path .
					"/thumb" . ( $i - 1 ) . ".jpg";
				exec( $com );
				if ( file_exists( $thumb_path . "/thumb" . ( $i - 1 ) . ".jpg" ) )
				{
					if ( $i == 2 )
					{
						copy( $thumb_path . "/thumb" . ( $i - 1 ) . ".jpg", $thumb_path .
							"/thumb100.jpg" );
						pvs_photo_resize( $thumb_path . "/thumb100.jpg", $thumb_path . "/thumb100.jpg",
							2 );
					}

					pvs_easyResize( $thumb_path . "/thumb" . ( $i - 1 ) . ".jpg", $thumb_path .
						"/thumb" . ( $i - 1 ) . ".jpg", 1, $pvs_global_settings["ffmpeg_thumb_width"] );
				}
			}
		}

		//Delete source
		if ( ! preg_match( "/.flv$/i", $apath ) and ! preg_match( "/.mp4$/i", $apath ) )
		{
			if ( $delete_source == 1 )
			{
				@unlink( $apath );
			}
		}
	}
	return $flv_name;
}





/**
 * Generate mp3 preview by SOX or FFMPEG
 *
 * @param  string $original_file audio path.
 * @param  string $result_file preview path.
 */
function pvs_generate_mp3( $original_file, $result_file )
{
	global $pvs_global_settings;

	if ( file_exists( $original_file ) )
	{
		if ( $pvs_global_settings["sox_library"] == "ffmpeg" )
		{
			$com = $pvs_global_settings["ffmpeg_path"] . " -i \"" . $original_file . "\" -acodec copy -t " .
				$pvs_global_settings["sox_duration"] . " " . $result_file;
		} else
		{
			$duration = $pvs_global_settings["sox_duration"];

			/*
			$com="soxi -D '".$original_file."'";
			exec($com, $output);
			if(isset($output[0]))
			{
			$duration=$output[0];
			}
			*/

			if ( $pvs_global_settings["sox_watermark"] and $pvs_global_settings["sox_watermark_file"] !=
				"" and file_exists( pvs_upload_dir() .
				"/content/watermark.mp3" ) )
			{
				$com = $pvs_global_settings["sox_path"] . " -m '|" . $pvs_global_settings["sox_path"] .
					" " . pvs_upload_dir() .
					"/content/watermark.mp3 -p pad 4 repeat 15' \"" . $original_file . "\" " . $result_file .
					" trim 0 " . $duration;
			} else
			{
				$com = $pvs_global_settings["sox_path"] . " \"" . $original_file . "\" " . $result_file .
					" trim 0 " . $duration;
			}
		}
		//echo($com);exit();
		@exec( $com );
	}
}





/**
 * Check if a publication password protected
 *
 * @param  int $id media ID.
 * @return bool
 */
function pvs_check_password_publication( $id ) {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$flag_protected = false;
	
	$sql = "select category_id from " . PVS_DB_PREFIX . "category_items where publication_id=" . $id;
	$dp->open($sql);
	while( !$dp->eof ) {
		if ( ! pvs_check_password( 0, $dp->row["category_id"], 0 ) ) {
			$flag_protected = true;
		}
		$dp->movenext();
	}
	
	return $flag_protected;
}





/**
 * Get a folder where files are saved
 *
 * @param  int $snm upload folder ID.
 * @return string folder name
 */
function pvs_server_url( $snm )
{
	global $site_servers;

	$server_name_url = "/content";
	$snm = ( int )$snm;
	if ( $snm == 0 )
	{
		$snm = 1;
	}
	if ( isset( $site_servers[$snm] ) )
	{
		$server_name_url = $site_servers[$snm];
	}
	return $server_name_url;
}





/**
 * The function delete a publication and all files
 *
 * @param  int $id media ID.
 */
function pvs_publication_delete( $id ) {
	global $db;
	global $pvs_global_settings;

	pvs_delete_files( ( int )$id );

	$sql = "delete from " . PVS_DB_PREFIX . "media where id=" . ( int )$id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "photos_exif where photo_id=" . ( int ) $id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "ffmpeg_cron where id=" . ( int )$id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "items where id_parent=" . ( int )$id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "models_files where publication_id=" . ( int ) $id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "prints_items where itemid=" . ( int )$id;
	$db->execute( $sql );

	$sql = "delete from " . PVS_DB_PREFIX . "downloads where publication_id=" . ( int ) $id;
	$db->execute( $sql );
	
	$sql = "delete from " . PVS_DB_PREFIX . "colors where publication_id=" . ( int ) $id;
	$db->execute( $sql );
	
	$sql = "delete from " . PVS_DB_PREFIX . "category_items where publication_id=" . ( int ) $id;
	$db->execute( $sql );
	
	$sql = "delete from " . PVS_DB_PREFIX . "collections_items where publication_id=" . ( int ) $id;
	$db->execute( $sql );
	
	$sql = "delete from " . PVS_DB_PREFIX . " lightboxes_files where item=" . ( int ) $id;
	$db->execute( $sql );

	$sql = "update " . PVS_DB_PREFIX .
		"filestorage_files set pdelete=1 where id_parent=" . ( int )$id;
	$db->execute( $sql );
	
	$sql = "delete from " . PVS_DB_PREFIX .
		"filestorage_files where id_parent=" . ( int )$id . " and server1=0";
	$db->execute( $sql );
	
	if ( $pvs_global_settings["elasticsearch"]) {
		if ( $pvs_global_settings["elasticsearch_automatic"]) {
			pvs_elastic_delete( $id );
		} else {
			$sql = "update " . PVS_DB_PREFIX . "elasticsearch set update_delete=1 where publication_id=" . ( int )$id;
			$db->execute( $sql );
		}
	}
}






/**
 * The function shows a publication's preview
 *
 * @param  int $id media ID.
 * @param  string $type photo, video, audio or vector.
 * @param  int $type_preview 1 - small preview; 2,3 - big preview.
 * @param  string $type_url return 1 - URL, 0 - HTML code.
 * @param  string $preview_server1 upload folder /content[n]/.
 * @param  string $preview_folder upload subfolder /[media ID]/.
 * @param  bool $seo_view seo-friendly URL or file path.
 * @return preview URL or HTML code
 */
function pvs_show_preview( $id, $type, $type_preview, $type_url, $preview_server1 =
	"", $preview_folder = "", $seo_view = true )
{
	global $db;
	global $aspect_ratio;
	global $_SERVER;
	global $pvs_global_settings;
	global $pvs_regular_expressions;

	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dz = new TMySQLQuery;
	$dz->connection = $db;

	$preview = "";
	$preview_url = "";

	$previews_remote = array();
	$flag_remote = false;

	if ( pvs_is_remote_storage() )
	{
		$sql = "select url,filename1,filename2 from " . PVS_DB_PREFIX .
			"filestorage_files where id_parent=" . ( int )$id;
		$dz->open( $sql );
		while ( ! $dz->eof )
		{
			$previews_remote[$dz->row["filename1"]] = $dz->row["url"] . "/" . $dz->row["filename2"];
			$flag_remote = true;
			$dz->movenext();
		}
	}
	
	$adult_flag = false;
	$adult_image = pvs_plugins_url() . "/assets/images/adult_content.gif";
	
	if ( $pvs_global_settings[ 'adult_content_show' ] and ! is_user_logged_in() )
	{
		$sql = "select adult from " . PVS_DB_PREFIX . "media where adult = 1 and  id=" . ( int )$id;
		$dz->open( $sql );
		if ( ! $dz->eof )
		{
			$adult_flag = true;
		}
	}

	if ( $type == "photo" )
	{

		if ( ( $preview_server1 == "" or $preview_folder == "" ) )
		{
			$sql = "select server1,id from " . PVS_DB_PREFIX .
				"media where id=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$preview_server1 = $dp->row["server1"];
				$preview_folder = $dp->row["id"];
			}
		}

		$preview_url = pvs_plugins_url() . "/assets/images/icon_photo.gif";

		if ( $type_preview == 1 )
		{
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb1.jpg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb1.jpg";
			} else
			{
				if ( isset( $previews_remote["thumb1.jpg"] ) )
				{
					$preview_url = $previews_remote["thumb1.jpg"];
				}
			}
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb1.jpeg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb1.jpeg";
			} else
			{
				if ( isset( $previews_remote["thumb1.jpeg"] ) )
				{
					$preview_url = $previews_remote["thumb1.jpeg"];
				}
			}
		} else
		{
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb2.jpg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb2.jpg";
			} else
			{
				if ( isset( $previews_remote["thumb2.jpg"] ) )
				{
					$preview_url = $previews_remote["thumb2.jpg"];
				}
			}
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb2.jpeg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb2.jpeg";
			} else
			{
				if ( isset( $previews_remote["thumb2.jpeg"] ) )
				{
					$preview_url = $previews_remote["thumb2.jpeg"];
				}
			}
		}

		//Regenerate thumbs
		if ( $preview_url == pvs_plugins_url() . "/assets/images/icon_photo.gif" )
		{
			$regenerate_file = '';
			$sql = "select server1,id,url_jpg,url_gif,url_png from " . PVS_DB_PREFIX .
				"media where id=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				if ( ! $flag_remote )
				{
					if ( $dp->row["url_gif"] != '' and file_exists( pvs_upload_dir() . pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
						"/" . $dp->row["url_gif"] ) )
					{
						$regenerate_file = pvs_upload_dir() . pvs_server_url( $dp->
							row["server1"] ) . "/" . $dp->row["id"] . "/" . $dp->row["url_gif"];
					}

					if ( $dp->row["url_png"] != '' and file_exists( pvs_upload_dir() . pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
						"/" . $dp->row["url_png"] ) )
					{
						$regenerate_file = pvs_upload_dir() . pvs_server_url( $dp->
							row["server1"] ) . "/" . $dp->row["id"] . "/" . $dp->row["url_png"];
					}

					if ( $dp->row["url_jpg"] != '' and file_exists( pvs_upload_dir() . pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
						"/" . $dp->row["url_jpg"] ) )
					{
						$regenerate_file = pvs_upload_dir() . pvs_server_url( $dp->
							row["server1"] ) . "/" . $dp->row["id"] . "/" . $dp->row["url_jpg"];
					}
				} else
				{
					foreach ( $previews_remote as $key => $value )
					{
						if ( ! preg_match( "/thumb/i", $key ) and preg_match( "/.jpg$|.jpeg|.gif|.png$/i",
							$key ) )
						{
							$regenerate_file = $value;
						}
					}
				}

				if ( $regenerate_file != '' )
				{
					if ( $type_preview == 1 )
					{
						pvs_photo_resize( $regenerate_file, pvs_upload_dir() .
							pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
							"/thumb1.jpg", 1 );
						$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $dp->row["server1"] ) . "/" . $dp->
							row["id_parent"] . "/thumb1.jpg";
					} else
					{
						pvs_photo_resize( $regenerate_file, pvs_upload_dir() .
							pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
							"/thumb2.jpg", 2 );
						pvs_publication_watermark_add( $id, pvs_upload_dir() .
							pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
							"/thumb2.jpg" );
						$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $dp->row["server1"] ) . "/" . $dp->
							row["id"] . "/thumb2.jpg";

						if ( $pvs_global_settings["prints"] and $pvs_global_settings["prints_previews"] and
							$pvs_global_settings["prints_previews_thumb"] and $pvs_global_settings["prints_previews_width"] >
							$pvs_global_settings["thumb_width2"] )
						{
							pvs_photo_resize( $regenerate_file, pvs_upload_dir() .
								pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
								"/thumb_print.jpg", 3 );
							pvs_publication_watermark_add( $id, pvs_upload_dir() .
								pvs_server_url( $dp->row["server1"] ) . "/" . $dp->row["id"] .
								"/thumb_print.jpg" );
						}
					}
				}
			}
		}

		$preview = "<img src='" . $preview_url . "' border='0'>";
	}

	if ( $type == "video" )
	{
		$sql = "select server1,id,ratio from " . PVS_DB_PREFIX .
			"media where id=" . ( int )$id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$preview_server1 = $dp->row["server1"];
			$preview_folder = $dp->row["id"];
			$preview_ratio = $dp->row["ratio"];
		}

		$preview_url = pvs_plugins_url() . "/assets/images/icon_video.gif";
		$preview_url2 = "";

		if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
			"/" . $preview_folder . "/thumb.jpg" ) )
		{
			$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
				"/thumb.jpg";
		} else
		{
			if ( isset( $previews_remote["thumb.jpg"] ) )
			{
				$preview_url = $previews_remote["thumb.jpg"];
			}
		}

		if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
			"/" . $preview_folder . "/thumb.jpeg" ) )
		{
			$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
				"/thumb.jpeg";
		} else
		{
			if ( isset( $previews_remote["thumb.jpeg"] ) )
			{
				$preview_url = $previews_remote["thumb.jpeg"];
			}
		}

		if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
			"/" . $preview_folder . "/thumb0.jpg" ) )
		{
			$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
				"/thumb0.jpg";
		} else
		{
			if ( isset( $previews_remote["thumb0.jpg"] ) )
			{
				$preview_url = $previews_remote["thumb0.jpg"];
			}
		}

		if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
			"/" . $preview_folder . "/thumb100.jpg" ) )
		{
			$preview_url2 = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
				"/thumb100.jpg";
		} else
		{
			if ( isset( $previews_remote["thumb100.jpg"] ) )
			{
				$preview_url2 = $previews_remote["thumb100.jpg"];
			}
		}

		if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
			"/" . $preview_folder . "/thumb100.jpeg" ) )
		{
			$preview_url2 = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
				"/thumb100.jpeg";
		} else
		{
			if ( isset( $previews_remote["thumb100.jpeg"] ) )
			{
				$preview_url2 = $previews_remote["thumb100.jpeg"];
			}
		}
		
		if ( $preview_url2 != '' and $preview_url == '') {
			$preview_url = $preview_url2;
		}
		
		if ( isset ($previews_remote["youtube_photo"]) ) {
			$preview_url = $previews_remote["youtube_photo"];
			
			if ($preview_url [ strlen($preview_url) -1 ] == '/' ) {
				$preview_url =substr( $preview_url, 0, strlen($preview_url) -1 );
			}
			
			$preview_url2 = $preview_url;
		}
		
		if ( isset ($previews_remote["vimeo_photo"]) ) {
			$preview_url = $previews_remote["vimeo_photo"];
			
			if ($preview_url [ strlen($preview_url) -1 ] == '/' ) {
				$preview_url =substr( $preview_url, 0, strlen($preview_url) -1 );
			}
			
			$preview_url2 = $preview_url;
		}

		$preview_url_video = $preview_url;

		if ( $type_preview == 3 )
		{
			if ( $preview_url2 != "" )
			{
				$preview_url_video = $preview_url2;
				$preview_url = $preview_url2;
			} else
			{
				$preview_url_video = $preview_url;
			}
		}

		if ( $type_preview == 1 or $type_preview == 3 )
		{

			$preview = "<img src='" . $preview_url . "' border='0'>";

		} else
		{
			$preview = "<img src='" . $preview_url . "' border='0'>";

			if ( isset( $aspect_ratio[$preview_ratio] ) )
			{
				$pvs_global_settings["ffmpeg_video_height"] = round( $pvs_global_settings["ffmpeg_video_width"] *
					$aspect_ratio[$preview_ratio] );
			} else
			{
				$pvs_global_settings["ffmpeg_video_height"] = round( $pvs_global_settings["ffmpeg_video_width"] *
					3 / 4 );
			}



			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) . "/" . $preview_folder . "/thumb.flv" ) ) {
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder . "/thumb.flv";
			} else {
				if ( isset( $previews_remote["thumb.flv"] ) ) {
					$preview_url = $previews_remote["thumb.flv"];
				}
			}

			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) . "/" . $preview_folder . "/thumb.mp4" ) ) {
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder . "/thumb.mp4";
			} else {
				if ( isset( $previews_remote["thumb.mp4"] ) ) {
					$preview_url = $previews_remote["thumb.mp4"];
				}
			}
			
			$video_player = "";
			$player_video_id = $id;
			$player_video_root = pvs_plugins_url();
			$player_video_width = $pvs_global_settings["ffmpeg_video_width"];
			$player_video_height = $pvs_global_settings["ffmpeg_video_height"];
			$player_preview_video = $preview_url;
			$player_preview_photo = $preview_url2;

			if ( file_exists( PVS_PATH . "/includes/players/video_player.php" ) ) {
				include(PVS_PATH . "/includes/players/video_player.php");
			}
			
			if ( isset ($previews_remote["youtube"]) ) {
				$preview_url = $previews_remote["youtube"];
				preg_match($pvs_regular_expressions[ 'youtube' ], $preview_url, $res); 
				$player_video_id = @$res[1];
				
				if ( file_exists( PVS_PATH . "/includes/players/video_player_youtube.php" ) ) {
					include(PVS_PATH . "/includes/players/video_player_youtube.php");
				} else {
					$video_player = '<iframe width="' . $player_video_width . '" height="' . $player_video_height . '" src="https://www.youtube.com/embed/' . $player_video_id . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				}
			}
			
			if ( isset ($previews_remote["vimeo"]) ) {
				$preview_url = $previews_remote["vimeo"];
				preg_match($pvs_regular_expressions[ 'vimeo' ], $preview_url, $res); 
				$player_video_id = @$res[5];
				
				if ( file_exists( PVS_PATH . "/includes/players/video_player_vimeo.php" ) ) {
					include(PVS_PATH . "/includes/players/video_player_vimeo.php");
				} else {
					$video_player = '<iframe src="https://player.vimeo.com/video/' . $player_video_id . '?autoplay=0&loop=0" width="' . $player_video_width . '" height="' . $player_video_height . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
			}
			
			$preview = $video_player;
		}
	}

	if ( $type == "audio" )
	{

		if ( ( $preview_server1 == "" or $preview_folder == "" ) )
		{
			$sql = "select server1,id from " . PVS_DB_PREFIX .
				"media where id=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$preview_server1 = $dp->row["server1"];
				$preview_folder = $dp->row["id"];
			}
		}

		$preview_url = pvs_plugins_url() . "/assets/images/icon_audio.gif";

		if ( $type_preview == 1 or $type_preview == 3 )
		{
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb.jpg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb.jpg";
			} else
			{
				if ( isset( $previews_remote["thumb.jpg"] ) )
				{
					$preview_url = $previews_remote["thumb.jpg"];
				}
			}

			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb.jpeg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb.jpeg";
			} else
			{
				if ( isset( $previews_remote["thumb.jpeg"] ) )
				{
					$preview_url = $previews_remote["thumb.jpeg"];
				}
			}

			if ( $type_preview == 3 )
			{
				if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
					"/" . $preview_folder . "/thumb100.jpg" ) )
				{
					$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
						"/thumb100.jpg";
				} else
				{
					if ( isset( $previews_remote["thumb100.jpg"] ) )
					{
						$preview_url = $previews_remote["thumb100.jpg"];
					}
				}

				if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
					"/" . $preview_folder . "/thumb100.jpeg" ) )
				{
					$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
						"/thumb100.jpeg";
				} else
				{
					if ( isset( $previews_remote["thumb100.jpeg"] ) )
					{
						$preview_url = $previews_remote["thumb100.jpeg"];
					}
				}
			}

			$preview = "<img src='" . $preview_url . "' border='0'>";

		} else
		{
			$preview = "<img src='" . $preview_url . "' border='0'>";

			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb.mp3" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder . "/thumb.mp3";
			} else
			{
				if ( isset( $previews_remote["thumb.mp3"] ) )
				{
					$preview_url = $previews_remote["thumb.mp3"];
				}
			}
			$player_audio_id = $id;
			$player_audio_root = pvs_plugins_url();
			$player_preview_audio = $preview_url;
			
			if ( file_exists( PVS_PATH . "/includes/players/audio_player.php" ) ) {
				include(PVS_PATH . "/includes/players/audio_player.php");
			} else {
				$audio_player = "";
			}
			
			$preview = $audio_player;
		}
	}

	if ( $type == "vector" )
	{

		if ( ( $preview_server1 == "" or $preview_folder == "" ) )
		{
			$sql = "select server1,id from " . PVS_DB_PREFIX .
				"media where id=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$preview_server1 = $dp->row["server1"];
				$preview_folder = $dp->row["id"];
			}
		}

		$preview_url = pvs_plugins_url() . "/assets/images/icon_vector.gif";

		if ( $type_preview == 1 )
		{
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb1.jpg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb1.jpg";
			} else
			{
				if ( isset( $previews_remote["thumb1.jpg"] ) )
				{
					$preview_url = $previews_remote["thumb1.jpg"];
				}
			}
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb1.jpeg" ) )
			{
				$preview_url =pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb1.jpeg";

			} else
			{
				if ( isset( $previews_remote["thumb1.jpeg"] ) )
				{
					$preview_url = $previews_remote["thumb1.jpeg"];
				}
			}

			$preview = "<img src='" . $preview_url . "' border='0'>";
		} elseif ( $type_preview == 2 )
		{
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb2.jpg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb2.jpg";
			} else
			{
				if ( isset( $previews_remote["thumb2.jpg"] ) )
				{
					$preview_url = $previews_remote["thumb2.jpg"];
				}
			}
			if ( file_exists( pvs_upload_dir() . pvs_server_url( $preview_server1 ) .
				"/" . $preview_folder . "/thumb2.jpeg" ) )
			{
				$preview_url = pvs_upload_dir('baseurl') . pvs_server_url( $preview_server1 ) . "/" . $preview_folder .
					"/thumb2.jpeg";
			} else
			{
				if ( isset( $previews_remote["thumb2.jpeg"] ) )
				{
					$preview_url = $previews_remote["thumb2.jpeg"];
				}
			}

			$preview = "<img src='" . $preview_url . "' border='0'>";
		}

	}

	$flag_seo_url = true;
	if ( ! $flag_remote and $flag_seo_url and ! preg_match( '/icon_(photo|video|audio|vector)/i',
		$preview_url ) and $seo_view )
	{
		$seo_url = "";
		$seo_title = "file-" . $id;
		$sql = "select media_id,title from " . PVS_DB_PREFIX . "media where id=" . ( int ) $id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			if ( pvs_media_type ($dp->row["media_id"]) == 'photo' )
			{
				$seo_title = "stock-photo-" . strtolower( str_replace( " ", "-", preg_replace( '/[^a-z0-9 ]/i', '', pvs_make_translit( $dp->row["title"] ) ) ) ) . "-" . $id;
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'video' )
			{
				$seo_title = "stock-video-" . strtolower( str_replace( " ", "-", preg_replace( '/[^a-z0-9 ]/i', '', pvs_make_translit( $dp->row["title"] ) ) ) ) . "-" . $id;
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'audio' )
			{
				$seo_title = "stock-audio-" . strtolower( str_replace( " ", "-", preg_replace( '/[^a-z0-9 ]/i', '', pvs_make_translit( $dp->row["title"] ) ) ) ) . "-" . $id;
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'vector' )
			{
				$seo_title = "stock-vector-" . strtolower( str_replace( " ", "-", preg_replace( '/[^a-z0-9 ]/i', '', pvs_make_translit( $dp->row["title"] ) ) ) ) . "-" . $id;
			}
		}
		$seo_mass = array();
		preg_match_all( '|content([0-9]*)\/[0-9]*\/thumb([0-9]*)\.([a-z0-9]*)$|Uis', $preview_url,
			$seo_mass );
		if ( isset( $seo_mass[1][0] ) and isset( $seo_mass[2][0] ) and isset( $seo_mass[3][0] ) )
		{
			$seo_url = site_url() . "/static" . $seo_mass[1][0] . "/preview" . $seo_mass[2][0] .
				"/" . $seo_title . "." . $seo_mass[3][0];
		}
		if ( $seo_url != "" )
		{
			$preview = str_replace( $preview_url, $seo_url, $preview );
			$preview_url = $seo_url;
		}
	}
	
	//Adult content
	if ( $adult_flag ) {
		$preview_url = 	$adult_image;
		$preview = "<img src='" . $preview_url . "' border='0'>";
	}

	if ( $type_url == 1 )
	{
		//Return preview URL
		//return str_replace("http:", "https:", $preview_url);
		return $preview_url;
	} else
	{
		//Return preview HTML code
		//return str_replace("http:", "https:", $preview);
		return $preview;
	}
}






/**
 * The function shows exif info
 *
 * @param  string $img image source path.
 * @param  bool $short_info.
 * @param  int $photo_id media ID.
 * @return string EXIF HTML code
 */
function pvs_get_exif( $img, $short_info = false, $photo_id = 0 )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$flag = false;
	$exif_text = "";
	$exif_text_short = "";

	if ( $photo_id != 0 )
	{
		$sql = "select id,photo_id,FileName,DateTime,FileSize,Width,Height,IsColor,UserComment,Copyright,Copyright_Photographer,Copyright_Editor,Orientation,XResolution,YResolution,Software,Make,Model,Artist,ExposureTime,FNumber,ISOSpeedRatings,ShutterSpeedValue,ApertureValue,ExposureBiasValue,MeteringMode,Flash,FocalLength,GPSLongitude,GPSLongitudeRef,GPSLatitude,GPSLatitudeRef from " .
			PVS_DB_PREFIX . "photos_exif where photo_id=" . ( int )$photo_id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$flag = true;

			$exif_text .= "<b>FileSize:</b> " . $dp->row["Width"] . "x" . $dp->row["Height"] .
				"px&nbsp&nbsp;&nbsp; " . pvs_price_format( $dp->row["FileSize"] / ( 1024 * 1024 ),
				2 ) . "Mb.<br>";

			$exif_text_short = $dp->row["Width"] . "x" . $dp->row["Height"] . "px<br>" .
				pvs_price_format( $dp->row["FileSize"] / ( 1024 * 1024 ), 2 ) . "Mb.";

			if ( $dp->row["Make"] != "" )
			{
				$exif_text .= "<b>Make:</b> " . $dp->row["Make"] . "<br>";
			}

			if ( $dp->row["Model"] != "" )
			{
				$exif_text .= "<b>Model:</b> " . $dp->row["Model"] . "<br>";
			}

			if ( $dp->row["XResolution"] != "" )
			{
				$exif_text .= "<b>XResolution:</b> " . $dp->row["XResolution"] . "<br>";
			}

			if ( $dp->row["YResolution"] != "" )
			{
				$exif_text .= "<b>YResolution:</b> " . $dp->row["YResolution"] . "<br>";
			}

			if ( $dp->row["DateTime"] != "" )
			{
				$exif_text .= "<b>DateTime:</b> " . $dp->row["DateTime"] . "<br>";
			}

			if ( $dp->row["Artist"] != "" )
			{
				$exif_text .= "<b>Artist:</b> " . $dp->row["Artist"] . "<br>";
			}

			if ( $dp->row["Copyright"] != "" )
			{
				$exif_text .= "<b>Copyright:</b> " . $dp->row["Copyright"] . "<br>";
			}

			if ( $dp->row["ExposureTime"] != "" )
			{
				$exif_text .= "<b>ExposureTime:</b> " . $dp->row["ExposureTime"] . "<br>";
			}

			if ( $dp->row["FNumber"] != "" )
			{
				$exif_text .= "<b>FNumber:</b> " . $dp->row["FNumber"] . "<br>";
			}

			if ( $dp->row["ISOSpeedRatings"] != "" )
			{
				$exif_text .= "<b>ISOSpeedRatings:</b> " . $dp->row["ISOSpeedRatings"] . "<br>";
			}

			if ( $dp->row["ShutterSpeedValue"] != "" )
			{
				$exif_text .= "<b>ShutterSpeedValue:</b> " . $dp->row["ShutterSpeedValue"] .
					"<br>";
			}

			if ( $dp->row["ApertureValue"] != "" )
			{
				$exif_text .= "<b>ApertureValue:</b> " . $dp->row["ApertureValue"] . "<br>";
			}

			if ( $dp->row["ExposureBiasValue"] != "" )
			{
				$exif_text .= "<b>ExposureBiasValue:</b> " . $dp->row["ExposureBiasValue"] .
					"<br>";
			}

			if ( $dp->row["MeteringMode"] != "" )
			{
				$exif_text .= "<b>MeteringMode:</b> " . $dp->row["MeteringMode"] . "<br>";
			}

			if ( $dp->row["Flash"] != "" )
			{
				$exif_text .= "<b>Flash:</b> " . $dp->row["Flash"] . "<br>";
			}

			if ( $dp->row["FocalLength"] != "" )
			{
				$exif_text .= "<b>FocalLength:</b> " . $dp->row["FocalLength"] . "<br>";
			}
		}
	} else
	{
		$flag = false;
	}

	if ( $flag == false )
	{
		$exif_info = @exif_read_data( $img, 0, true );

		if ( $photo_id != 0 )
		{
			pvs_add_exif_to_database( $photo_id, $img );
		}

		if ( isset( $exif_info["FILE"]["FileSize"] ) and isset( $exif_info["COMPUTED"]["Width"] ) and
			isset( $exif_info["COMPUTED"]["Height"] ) )
		{
			$exif_text .= "<b>FileSize:</b> " . $exif_info["COMPUTED"]["Width"] . "x" . $exif_info["COMPUTED"]["Height"] .
				"px&nbsp&nbsp;&nbsp; " . pvs_price_format( $exif_info["FILE"]["FileSize"] / ( 1024 *
				1024 ), 2 ) . "Mb.<br>";

			$exif_text_short = $exif_info["COMPUTED"]["Width"] . "x" . $exif_info["COMPUTED"]["Height"] .
				"px<br>" . pvs_price_format( $exif_info["FILE"]["FileSize"] / ( 1024 * 1024 ), 2 ) .
				"Mb.";
		}

		if ( isset( $exif_info["IFD0"]["Make"] ) )
		{
			$exif_text .= "<b>Make:</b> " . $exif_info["IFD0"]["Make"] . "<br>";
		}

		if ( isset( $exif_info["IFD0"]["Model"] ) )
		{
			$exif_text .= "<b>Model:</b> " . $exif_info["IFD0"]["Model"] . "<br>";
		}

		if ( isset( $exif_info["IFD0"]["XResolution"] ) )
		{
			$exif_text .= "<b>XResolution:</b> " . $exif_info["IFD0"]["XResolution"] .
				"<br>";
		}

		if ( isset( $exif_info["IFD0"]["YResolution"] ) )
		{
			$exif_text .= "<b>YResolution:</b> " . $exif_info["IFD0"]["YResolution"] .
				"<br>";
		}

		if ( isset( $exif_info["IFD0"]["DateTime"] ) )
		{
			$exif_text .= "<b>DateTime:</b> " . $exif_info["IFD0"]["DateTime"] . "<br>";
		}

		if ( isset( $exif_info["IFD0"]["Artist"] ) )
		{
			$exif_text .= "<b>Artist:</b> " . $exif_info["IFD0"]["Artist"] . "<br>";
		}

		if ( isset( $exif_info["IFD0"]["Copyright"] ) )
		{
			$exif_text .= "<b>Copyright:</b> " . $exif_info["IFD0"]["Copyright"] . "<br>";
		}

		if ( isset( $exif_info["EXIF"]["ExposureTime"] ) )
		{
			$exif_text .= "<b>ExposureTime:</b> " . $exif_info["EXIF"]["ExposureTime"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["FNumber"] ) )
		{
			$exif_text .= "<b>FNumber:</b> " . $exif_info["EXIF"]["FNumber"] . "<br>";
		}

		if ( isset( $exif_info["EXIF"]["ISOSpeedRatings"] ) )
		{
			$exif_text .= "<b>ISOSpeedRatings:</b> " . $exif_info["EXIF"]["ISOSpeedRatings"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["ShutterSpeedValue"] ) )
		{
			$exif_text .= "<b>ShutterSpeedValue:</b> " . $exif_info["EXIF"]["ShutterSpeedValue"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["ApertureValue"] ) )
		{
			$exif_text .= "<b>ApertureValue:</b> " . $exif_info["EXIF"]["ApertureValue"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["ExposureBiasValue"] ) )
		{
			$exif_text .= "<b>ExposureBiasValue:</b> " . $exif_info["EXIF"]["ExposureBiasValue"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["MeteringMode"] ) )
		{
			$exif_text .= "<b>MeteringMode:</b> " . $exif_info["EXIF"]["MeteringMode"] .
				"<br>";
		}

		if ( isset( $exif_info["EXIF"]["Flash"] ) )
		{
			$exif_text .= "<b>Flash:</b> " . $exif_info["EXIF"]["Flash"] . "<br>";
		}

		if ( isset( $exif_info["EXIF"]["FocalLength"] ) )
		{
			$exif_text .= "<b>FocalLength:</b> " . $exif_info["EXIF"]["FocalLength"] .
				"<br>";
		}
	}

	if ( $short_info )
	{
		return $exif_text_short;
	} else
	{
		return $exif_text;
	}
}





/**
 * The function saves exif info in the database
 *
 * @param  int $photo_id media ID.
 * @param  string $img photo path.
 */
function pvs_add_exif_to_database( $photo_id, $img )
{
	global $db;

	$com = "insert into photos_exif set photo_id=" . ( int )$photo_id;

	$exif_info = @exif_read_data( $img, 0, true );

	$com .= ",FileName='" . pvs_result( @$exif_info["FILE"]["FileName"] ) . "'";
	$com .= ",DateTime='" . pvs_result( @$exif_info["IFD0"]["DateTime"] ) . "'";
	$com .= ",FileSize='" . ( int )@$exif_info["FILE"]["FileSize"] . "'";
	$com .= ",Width='" . ( int )@$exif_info["COMPUTED"]["Width"] . "'";
	$com .= ",Height='" . ( int )@$exif_info["COMPUTED"]["Height"] . "'";
	$com .= ",IsColor='" . pvs_result( @$exif_info["COMPUTED"]["IsColor"] ) . "'";
	$com .= ",UserComment='" . pvs_result( @$exif_info["COMPUTED"]["UserComment"] ) .
		"'";
	$com .= ",Copyright='" . pvs_result( @$exif_info["IFD0"]["Copyright"] ) . "'";
	$com .= ",Copyright_Photographer='" . pvs_result( @$exif_info["COMPUTED"]["Copyright_Photographer"] ) .
		"'";
	$com .= ",Copyright_Editor='" . pvs_result( @$exif_info["COMPUTED"]["Copyright_Editor"] ) .
		"'";
	$com .= ",Orientation='" . pvs_result( @$exif_info["IFD0"]["Orientation"] ) .
		"'";
	$com .= ",XResolution='" . pvs_result( @$exif_info["IFD0"]["XResolution"] ) .
		"'";
	$com .= ",YResolution='" . pvs_result( @$exif_info["IFD0"]["YResolution"] ) .
		"'";
	$com .= ",Software='" . pvs_result( @$exif_info["IFD0"]["Software"] ) . "'";
	$com .= ",Make='" . pvs_result( @$exif_info["IFD0"]["Make"] ) . "'";
	$com .= ",Model='" . pvs_result( @$exif_info["IFD0"]["Model"] ) . "'";
	$com .= ",Artist='" . pvs_result( @$exif_info["IFD0"]["Artist"] ) . "'";
	$com .= ",ExposureTime='" . pvs_result( @$exif_info["EXIF"]["ExposureTime"] ) .
		"'";
	$com .= ",FNumber='" . pvs_result( @$exif_info["EXIF"]["FNumber"] ) . "'";
	$com .= ",ISOSpeedRatings='" . pvs_result( @$exif_info["EXIF"]["ISOSpeedRatings"] ) .
		"'";
	$com .= ",ShutterSpeedValue='" . pvs_result( @$exif_info["EXIF"]["ShutterSpeedValue"] ) .
		"'";
	$com .= ",ApertureValue='" . pvs_result( @$exif_info["EXIF"]["ApertureValue"] ) .
		"'";
	$com .= ",ExposureBiasValue='" . pvs_result( @$exif_info["EXIF"]["ExposureBiasValue"] ) .
		"'";
	$com .= ",MeteringMode='" . pvs_result( @$exif_info["EXIF"]["MeteringMode"] ) .
		"'";
	$com .= ",Flash='" . pvs_result( @$exif_info["EXIF"]["Flash"] ) . "'";
	$com .= ",FocalLength='" . pvs_result( @$exif_info["EXIF"]["FocalLength"] ) .
		"'";
	$com .= ",GPSLongitude='" . pvs_result( @$exif_info["GPS"]["GPSLongitude"] ) .
		"'";
	$com .= ",GPSLongitudeRef='" . pvs_result( @$exif_info["GPS"]["GPSLongitudeRef"] ) .
		"'";
	$com .= ",GPSLatitude='" . pvs_result( @$exif_info["GPS"]["GPSLatitude"] ) . "'";
	$com .= ",GPSLatitudeRef='" . pvs_result( @$exif_info["GPS"]["GPSLatitudeRef"] ) .
		"'";

	$db->execute( $com );
}





/**
 * The function gets a hover box for a small preview
 *
 * @param  int $id media ID.
 * @param  string $type photo, video, audio or vector.
 * @param  int $server upload folder ID.
 * @param  string $title media title.
 * @param  string $user media author.
 * @return array
 */
function pvs_get_hoverbox( $id, $type, $server, $title, $user )
{
	global $pvs_global_settings;
	global $pvs_regular_expressions;
	global $db;
	global $aspect_ratio;

	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$hoverbox_results = array();
	$hoverbox_results["hover"] = "";
	$hoverbox_results["image"] = "";
	$hoverbox_results["width"] = 0;
	$hoverbox_results["height"] = 0;
	$hoverbox_results["flow_image"] = "";
	$hoverbox_results["flow_width"] = 0;
	$hoverbox_results["flow_height"] = 0;

	$remote_width = 0;
	$remote_height = 0;
	$remote_width_videoaudio = 0;
	$remote_height_videoaudio = 0;
	$flow_width = 0;
	$flow_height = 0;
	$flag_storage = false;

	if ( pvs_is_remote_storage() )
	{
		$sql = "select url,filename1,filename2,width,height from " . PVS_DB_PREFIX .
			"filestorage_files where id_parent=" . ( int )$id .
			" and (filename1 like '%thumb2%' or filename1 like '%thumb100%' or filename1='youtube_photo' or filename1='vimeo_photo')";
		$dp->open( $sql );
		while ( ! $dp->eof )
		{
			if ( preg_match( "/thumb2/i", $dp->row["filename1"] ) )
			{
				$remote_width = $dp->row["width"];
				$remote_height = $dp->row["height"];
			}
			if ( preg_match( "/thumb100/i", $dp->row["filename1"] ) or  $dp->row["filename1"] == 'youtube_photo' or  $dp->row["filename1"] == 'vimeo_photo' )
			{
				$remote_width_videoaudio = $dp->row["width"];
				$remote_height_videoaudio = $dp->row["height"];
			}
			$flag_storage = true;

			$dp->movenext();
		}
	}

	if ( $type == "photo" )
	{
		$hoverbox_results["image"] = pvs_show_preview( $id, "photo", 2, 1, $server, $id, true );
		$hoverbox_results["flow_image"] = $hoverbox_results["image"];
		$item_img_lightbox = pvs_show_preview( $id, "photo", 2, 1, $server, $id, true );
		$item_img_lightbox2 = str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), pvs_show_preview( $id, "photo", 2, 1, $server, $id, false ));

		if ( ! $flag_storage and file_exists( $item_img_lightbox2 ) )
		{
			$size = getimagesize( $item_img_lightbox2 );
			$hoverbox_results["width"] = $size[0];
			$hoverbox_results["height"] = $size[1];
			$hoverbox_results["flow_width"] = $size[0];
			$hoverbox_results["flow_height"] = $size[1];
		}

		if ( $remote_width != 0 and $remote_height != 0 )
		{
			$hoverbox_results["width"] = $remote_width;
			$hoverbox_results["height"] = $remote_height;
			$hoverbox_results["flow_width"] = $remote_width;
			$hoverbox_results["flow_height"] = $remote_height;
		}

		if ( $pvs_global_settings["lightbox_photo"] and ! preg_match( "/icon_photo/", $item_img_lightbox ) and ! preg_match( "/adult_content/", $item_img_lightbox ) )
		{
			if ( $hoverbox_results["width"] != 0 and $hoverbox_results["height"] != 0 )
			{
				$lightbox_width = $hoverbox_results["width"];
				$lightbox_height = $hoverbox_results["height"];

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

				$hoverbox_results["hover"] = "onMouseover=\"lightboxon('" . $hoverbox_results["image"] .
					"'," . $lightbox_width . "," . $lightbox_height . ",event,'" . site_url() . "','" .
					$title . "','" . pvs_word_lang( "author" ) . ": " . $user . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
					$lightbox_width . "," . $lightbox_height . ",event)\"";
			}
		}
	}
	if ( $type == "video" )
	{
		$hoverbox_results["flow_image"] = pvs_show_preview( $id, "video", 3, 1, $server,
			$id );
		$item_img2_path = str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), pvs_show_preview( $id, "video", 3, 1, $server, $id, false ));

		$hoverbox_results["image"] = pvs_show_preview( $id, "video", 2, 1, $server, $id );

		$hoverbox_results["width"] = $pvs_global_settings["video_width"];
		$hoverbox_results["height"] = $pvs_global_settings["video_height"];
		$sql = "select ratio from " . PVS_DB_PREFIX . "media where id=" . $id;
		$dt->open( $sql );
		if ( ! $dt->eof )
		{
			if ( isset( $aspect_ratio[$dt->row["ratio"]] ) )
			{
				$hoverbox_results["height"] = round( $pvs_global_settings["video_width"] * $aspect_ratio[$dt->
					row["ratio"]] );
			} else
			{
				$hoverbox_results["height"] = round( $pvs_global_settings["video_width"] * 3 / 4 );
			}
		}

		if ( $hoverbox_results["image"] != "" and preg_match( "/flv$/", $hoverbox_results["image"] ) and
			$pvs_global_settings["lightbox_video"] and ! preg_match( "/adult_content/", $hoverbox_results["image"] ) )
		{
			$hoverbox_results["hover"] = "onMouseover=\"lightboxon3('" . $hoverbox_results["image"] .
				"'," . $hoverbox_results["width"] . "," . $hoverbox_results["height"] .
				",event,'" . pvs_plugins_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
				$hoverbox_results["width"] . "," . $hoverbox_results["height"] . ",event)\"";
		}
		if ( $hoverbox_results["image"] != "" and preg_match( "/mp4$/", $hoverbox_results["image"] ) and $pvs_global_settings["lightbox_video"] and ! preg_match( "/adult_content/", $hoverbox_results["image"] ) )
		{
			$hoverbox_results["hover"] = "onMouseover=\"lightboxon5('" . $hoverbox_results["image"] .
				"'," . $hoverbox_results["width"] . "," . $hoverbox_results["height"] .
				",event,'" . pvs_plugins_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
				$hoverbox_results["width"] . "," . $hoverbox_results["height"] . ",event)\"";
		}
		
		if ( $hoverbox_results["image"] != "" and preg_match( $pvs_regular_expressions[ 'youtube' ], $hoverbox_results["image"], $res ) and $pvs_global_settings["lightbox_video"] and ! preg_match( "/adult_content/", $hoverbox_results["image"] ) ) {
			$hoverbox_results["hover"] = "onMouseover=\"lightboxon_youtube('" . @$res[1] .
				"'," . $hoverbox_results["width"] . "," . $hoverbox_results["height"] .
				",event,'" . pvs_plugins_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
				$hoverbox_results["width"] . "," . $hoverbox_results["height"] . ",event)\"";
		}
		
		if ( $hoverbox_results["image"] != "" and preg_match( $pvs_regular_expressions[ 'vimeo' ], $hoverbox_results["image"], $res ) and $pvs_global_settings["lightbox_video"] and ! preg_match( "/adult_content/", $hoverbox_results["image"] ) ) {
			$hoverbox_results["hover"] = "onMouseover=\"lightboxon_vimeo('" . @$res[5] .
				"'," . $hoverbox_results["width"] . "," . $hoverbox_results["height"] .
				",event,'" . pvs_plugins_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
				$hoverbox_results["width"] . "," . $hoverbox_results["height"] . ",event)\"";
		}

		if ( ! $flag_storage and file_exists( $item_img2_path ) )
		{
			$size = getimagesize( $item_img2_path );
			$hoverbox_results["flow_width"] = $size[0];
			$hoverbox_results["flow_height"] = $size[1];
			$hoverbox_results["width"] = $size[0];
			$hoverbox_results["height"] = $size[1];
		} else
		{
			$hoverbox_results["flow_width"] = $remote_width_videoaudio;
			$hoverbox_results["flow_height"] = $remote_height_videoaudio;
			$hoverbox_results["width"] = $remote_width_videoaudio;
			$hoverbox_results["height"] = $remote_height_videoaudio;
		}
	}
	if ( $type == "audio" )
	{
		$hoverbox_results["flow_image"] = pvs_show_preview( $id, "audio", 3, 1, $server,
			$id );
		$item_img2_path = str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), pvs_show_preview( $id, "audio", 3, 1, $server, $id, false ));
		$hoverbox_results["image"] = pvs_show_preview( $id, "audio", 2, 1, $server, $id );

		if ( $hoverbox_results["image"] != "" and $pvs_global_settings["lightbox_video"] and
			preg_match( "/mp3$/", $hoverbox_results["image"] ) and ! preg_match( "/adult_content/", $hoverbox_results["image"] ) )
		{
			$hoverbox_results["hover"] = "onMouseover=\"lightboxon4('" . $hoverbox_results["image"] .
				"',200,20,event,'" . pvs_plugins_url() . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(200,20,event)\"";
		}

		if ( ! $flag_storage and file_exists( $item_img2_path ) )
		{
			$size = getimagesize( $item_img2_path );
			$hoverbox_results["flow_width"] = $size[0];
			$hoverbox_results["flow_height"] = $size[1];
			$hoverbox_results["width"] = $size[0];
			$hoverbox_results["height"] = $size[1];
		} else
		{
			$hoverbox_results["flow_width"] = $remote_width_videoaudio;
			$hoverbox_results["flow_height"] = $remote_height_videoaudio;
			$hoverbox_results["width"] = $remote_width_videoaudio;
			$hoverbox_results["height"] = $remote_height_videoaudio;
		}
	}
	if ( $type == "vector" )
	{
		$hoverbox_results["image"] = pvs_show_preview( $id, "vector", 2, 1, $server, $id, true );
		$hoverbox_results["flow_image"] = $hoverbox_results["image"];
		
		$item_img_lightbox2 = str_replace(pvs_upload_dir('baseurl'), pvs_upload_dir(), pvs_show_preview( $id, "vector", 2, 1, $server, $id, false ));

		if ( ! $flag_storage and file_exists( $item_img_lightbox2 ) )
		{
			$size = getimagesize( $item_img_lightbox2 );
			$hoverbox_results["width"] = $size[0];
			$hoverbox_results["height"] = $size[1];
			$hoverbox_results["flow_width"] = $size[0];
			$hoverbox_results["flow_height"] = $size[1];
		}

		if ( $remote_width != 0 and $remote_height != 0 )
		{
			$hoverbox_results["width"] = $remote_width;
			$hoverbox_results["height"] = $remote_height;
			$hoverbox_results["flow_width"] = $remote_width;
			$hoverbox_results["flow_height"] = $remote_height;
		}

		if ( $hoverbox_results["image"] != "" and $pvs_global_settings["lightbox_photo"] and
			! preg_match( "/icon_vector/", $hoverbox_results["image"] ) and ! preg_match( "/adult_content/", $hoverbox_results["image"] )  )
		{
			if ( $hoverbox_results["width"] != 0 and $hoverbox_results["height"] != 0 )
			{
				$lightbox_width = $hoverbox_results["width"];
				$lightbox_height = $hoverbox_results["height"];

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

				$hoverbox_results["hover"] = "onMouseover=\"lightboxon('" . $hoverbox_results["image"] .
					"'," . $lightbox_width . "," . $lightbox_height . ",event,'" . pvs_plugins_url() . "','" .
					$title . "','" . pvs_word_lang( "author" ) . ": " . $user . "');\" onMouseout=\"lightboxoff();\" onMousemove=\"lightboxmove(" .
					$lightbox_width . "," . $lightbox_height . ",event)\"";
			}
		}
	}
	
	if ( preg_match( "/adult_content/", $hoverbox_results["image"] ) ) {
		$hoverbox_results["flow_width"] = 400;
		$hoverbox_results["flow_height"] = 300;
	}

	$width_limit = $pvs_global_settings["width_flow"];
	if ( ( $hoverbox_results["flow_width"] > $width_limit or $hoverbox_results["flow_height"] >
		$width_limit ) and $hoverbox_results["flow_width"] != 0 )
	{
		$hoverbox_results["flow_height"] = round( $hoverbox_results["flow_height"] * $width_limit /
			$hoverbox_results["flow_width"] );
		$hoverbox_results["flow_width"] = $width_limit;
	}

	return $hoverbox_results;
}





/**
 * The function translates a publication
 *
 * @param  int $id media ID.
 * @param  string $title media title.
 * @param  string $description media description.
 * @param  string $keywords media keywords.
 * @return array
 */
function pvs_translate_publication( $id, $title, $description, $keywords )
{
	global $pvs_global_settings;
	global $db;
	global $lng;
	global $lang_symbol;

	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$translate_results = array();
	$translate_results["title"] = $title;
	$translate_results["description"] = $description;
	$translate_results["keywords"] = $keywords;

	if ( @$pvs_global_settings["multilingual_publications"] )
	{
		$lng_symbol = $lang_symbol[$lng];
		if ( $lng == "Chinese traditional" )
		{
			$lng_symbol = "zh1";
		}
		if ( $lng == "Chinese simplified" )
		{
			$lng_symbol = "zh2";
		}
		if ( $lng == "Afrikaans formal" )
		{
			$lng_symbol = "af1";
		}
		if ( $lng == "Afrikaans informal" )
		{
			$lng_symbol = "af2";
		}

		$sql = "select title,keywords,description from " . PVS_DB_PREFIX .
			"translations where id=" . ( int )$id . " and lang='" . $lng_symbol . "'";
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			if ( $dp->row["title"] != "" )
			{
				$translate_results["title"] = $dp->row["title"];
			}
			if ( $dp->row["description"] != "" )
			{
				$translate_results["description"] = $dp->row["description"];
			}
			if ( $dp->row["keywords"] != "" )
			{
				$translate_results["keywords"] = $dp->row["keywords"];
			}
		}
	}

	return $translate_results;
}





/**
 * The function gets filename and file extention
 *
 * @param  string $filename - file path.
 * @param  string $type filename or extention.
 * @return string filename or extention
 */
function pvs_get_file_info( $filename, $type )
{
	$fname = "";
	$nf = explode( ".", $filename );
	$fext = $nf[count( $nf ) - 1];

	for ( $i = 0; $i < count( $nf ) - 1; $i++ )
	{
		if ( $fname != "" )
		{
			$fname .= ".";
		}
		$fname .= $nf[$i];
	}

	if ( $type == "filename" )
	{
		return $fname;
	}
	if ( $type == "extention" )
	{
		return $fext;
	}
}





/**
 * Check if a publication is rights-managed
 *
 * @param  int $id media ID.
 * @return bool
 */
function pvs_is_rights_managed($id) {
	global $db;
	global $pvs_global_settings;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$rights_managed_flag = 0;
	
	$sql = "select rights_managed from " . PVS_DB_PREFIX . "media where id=" . $id;
	$dt->open( $sql );
	if ( ! $dt->eof ) {
		if ( $dt->row["rights_managed"] > 0 ) {
			$rights_managed_flag = 1;
		}
	}
	
	return $rights_managed_flag;
}	





/**
 * Check if a price is 'Contact Us'
 *
 * @param  int $id item ID.
 * @return bool
 */
function pvs_is_contacts_price($id) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$contacts_flag = 0;
	
	$sql = "select contacts from " . PVS_DB_PREFIX . "items where id=" . (int) $id;
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		$contacts_flag = (int) $dp->row["contacts"];
	}
	
	return $contacts_flag;
}




/**
 * Get media type
 *
 * @param  int $media_id media type ID.
 * @return string
 */
function pvs_media_type ($media_id) {
	$media_type = 'photo';
	if ($media_id == 1) {
		$media_type = 'photo';
	}
	if ($media_id == 2) {
		$media_type = 'video';
	}
	if ($media_id == 3) {
		$media_type = 'audio';
	}
	if ($media_id == 4) {
		$media_type = 'vector';
	}
	return $media_type;
}





/**
 * Check if minimum one of remote storage option is enabled
 *
 * @return bool
 */
function pvs_is_remote_storage() {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$sql = "select id_parent from " . PVS_DB_PREFIX . "filestorage_files limit 0,1";
	$dp->open($sql);
	if ( ! $dp->eof ) {
		return true;
	} else {
		return false;
	}
}





/**
 * Get size of remote file in bytes
 *
 * @param  string $url file URL http://.
 * @return int
 */
function pvs_get_size( $url ) {
	$remote_size = array_change_key_case(get_headers($url,1));
	return $remote_size['content-length'];
}





/**
 * Check if a remote file exists
 *
 * @param  string $remote file URL http://.
 * @return bool.
 */
function pvs_remote_check( $remote ) {
	if ($remote[strlen($remote) - 1] == '/') {
		$remote = substr($remote, 0, strlen($remote) - 1);
	}

	$urlHeaders = @get_headers( $remote );

	if ( strpos($urlHeaders[0], '200') ) {
		return true;
	} else {
		return false;
	}
}




/**
 * Category Functions
 */
 
 


/**
 * Check if a category password protected
 *
 * @param  int $otkuda parent category ID.
 * @param  int $kuda category ID.
 * @return bool or int protected category ID
 */
function pvs_check_password( $otkuda, $kuda, $chto )
{
	global $_COOKIE;
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$navig = true;
	$idp = 0;

	$t_perem = $kuda;

	while ( $t_perem != $otkuda )
	{
		$sql = "select id_parent, password from " . PVS_DB_PREFIX . "category where id=" . ( int )
			$t_perem;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			if ( $dp->row["password"] != "" )
			{
				$navig = false;
				$idp = $t_perem;
				if ( isset( $_COOKIE["cprotected"] ) )
				{
					$cpr = explode( "|", $_COOKIE["cprotected"] );
					for ( $i = 0; $i < count( $cpr ); $i++ )
					{
						$hash = substr(md5( $dp->row["password"] . $t_perem ), 0, 7);
						if ( $hash == $cpr[$i] )
						{
							$navig = true;
						}
					}
				}
			}
			$t_perem = $dp->row["id_parent"];
		} else {
			break;
		}
	}

	if ( $chto == 0 )
	{
		return $navig;
	} else
	{
		return $idp;
	}
}






/**
 * The function gets sql id of the password protected categories to exclude them from the search result
 *
 * @return string
 */
function pvs_get_password_protected() {
	global $db;
	global $dr;
	global $_COOKIE;

	$sql_command = "";

	$sql = "select id,password from " . PVS_DB_PREFIX .
		"category where password<>'' or activation_date > " . pvs_get_time() .
		" or (expiration_date < " . pvs_get_time() . " and expiration_date <> 0)";
	$dr->open( $sql );
	while ( ! $dr->eof ) {

		$flag_password = true;
		if ( isset( $_COOKIE["cprotected"] ) ) {
			$hash = substr(md5( $dr->row["password"] . $dr->row["id"] ), 0, 7);
				
			if ( preg_match( "/" . $hash . "/", $_COOKIE["cprotected"] ) )
			{
				$flag_password = false;
			}
		}
		if ( $flag_password == true ) {
			if ( $sql_command != '' )
			{
				$sql_command .= " or ";
			}

			$sql_command .= " category_id=" . $dr->row["id"] . " ";
		}

		$dr->movenext();
	}

	return $sql_command;
}






/**
 * The function translates a category
 *
 * @param  int $id category ID.
 * @param  string $title category title.
 * @param  string $description category description.
 * @param  string $keywords category keywords.
 * @return array
 */
function pvs_translate_category( $id, $title, $description, $keywords )
{
	global $pvs_global_settings;
	global $db;
	global $lng;
	global $lang_symbol;

	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$translate_results = array();
	$translate_results["title"] = $title;
	$translate_results["description"] = $description;
	$translate_results["keywords"] = $keywords;

	if ( @$pvs_global_settings["multilingual_categories"] )
	{
		$lng_symbol = $lang_symbol[$lng];
		if ( $lng == "Chinese traditional" )
		{
			$lng_symbol = "zh1";
		}
		if ( $lng == "Chinese simplified" )
		{
			$lng_symbol = "zh2";
		}
		if ( $lng == "Afrikaans formal" )
		{
			$lng_symbol = "af1";
		}
		if ( $lng == "Afrikaans informal" )
		{
			$lng_symbol = "af2";
		}

		$sql = "select title,keywords,description from " . PVS_DB_PREFIX .
			"translations where id=" . ( int )$id . " and lang='" . $lng_symbol . "'";
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			if ( $dp->row["title"] != "" )
			{
				$translate_results["title"] = $dp->row["title"];
			}
			if ( $dp->row["description"] != "" )
			{
				$translate_results["description"] = $dp->row["description"];
			}
			if ( $dp->row["keywords"] != "" )
			{
				$translate_results["keywords"] = $dp->row["keywords"];
			}
		}
	}

	return $translate_results;
}





/**
 * Show collection preview
 *
 * @param  int $id Collection ID.
 * @return array
 */
function pvs_show_collection_preview($id) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$collection_result = array();
	
	$collection_result["photo"] = "";
	$collection_result["width"] = @$pvs_global_settings["category_preview"];
	$collection_result["height"] = 0;

	if ( file_exists(pvs_upload_dir() . "/content/categories/collection_" . (int) $id . ".jpg") ) {
		$collection_result["photo"] = pvs_upload_dir('baseurl'). "/content/categories/collection_" . (int) $id . ".jpg";
		$size = getimagesize( pvs_upload_dir() . "/content/categories/collection_" . (int) $id . ".jpg" );
		$collection_result["width"] = $size[0];
		$collection_result["height"] = $size[1];
	} else {
		$sql = "select publication_id, category_id from " . PVS_DB_PREFIX . "collections_items where collection_id=" . (int) $id;
		$dp->open( $sql );
		while(!$dp->eof) {
			if ($dp->row["publication_id"] != 0) {
				$sql = "select media_id,server1,title from " . PVS_DB_PREFIX . "media where id=" . $dp->row["publication_id"];
				$dt->open( $sql );
				if(!$dt->eof) {
					if (pvs_media_type ($dt->row["media_id"]) == 'photo') {
						$hoverbox_results = pvs_get_hoverbox( $dp->row["publication_id"], "photo", $dt->row["server1"], "", "" );
						$collection_result["photo"] = $hoverbox_results["flow_image"];
						$collection_result["width"] = $hoverbox_results["flow_width"];
						$collection_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dt->row["media_id"]) == 'video') {
						$hoverbox_results = pvs_get_hoverbox( $dp->row["publication_id"], "video", $dt->row["server1"], "", "" );
						$collection_result["photo"] = $hoverbox_results["flow_image"];
						$collection_result["width"] = $hoverbox_results["flow_width"];
						$collection_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dt->row["media_id"]) == 'audio') {
						$hoverbox_results = pvs_get_hoverbox( $dp->row["publication_id"], "audio", $dt->row["server1"], "", "" );
						$collection_result["photo"] = $hoverbox_results["flow_image"];
						$collection_result["width"] = $hoverbox_results["flow_width"];
						$collection_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dt->row["media_id"]) == 'vector') {
						$hoverbox_results = pvs_get_hoverbox( $dp->row["publication_id"], "vector", $dt->row["server1"], "", "" );
						$collection_result["photo"] = $hoverbox_results["flow_image"];
						$collection_result["width"] = $hoverbox_results["flow_width"];
						$collection_result["height"] = $hoverbox_results["flow_height"];
					}
				}
			}
			if ($dp->row["category_id"] != 0) {
				$collection_result = pvs_show_category_preview($dp->row["category_id"]);
			}
			if ($collection_result["photo"] != '') {
				break;
			}
			$dp->movenext();
		}
	}
	
	return $collection_result;
}






/**
 * Show category preview
 *
 * @param  int $id Category ID.
 * @return array
 */
function pvs_show_category_preview($id) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	$dz = new TMySQLQuery;
	$dz->connection = $db;
	
	$category_result = array();
	
	$category_result["photo"] = "";
	$category_result["width"] = $pvs_global_settings["category_preview"];
	$category_result["height"] = 0;
	
	$sql = "select id, photo from " . PVS_DB_PREFIX . "category where id = " . (int)$id;
	$dp->open( $sql );
	if ( ! $dp->eof ) {	
		if ( $dp->row["photo"] != "" ) {
			$category_result["photo"] = pvs_upload_dir('baseurl') . $dp->row["photo"];

			if ( file_exists( pvs_upload_dir() . $dp->row["photo"] ) )
			{
				$size = getimagesize( pvs_upload_dir() . $dp->row["photo"] );
				$category_result["width"] = $size[0];
				$category_result["height"] = $size[1];
			}
		} else {
			$sql = "select publication_id from " . PVS_DB_PREFIX . "category_items where category_id=" . $id;
			$dt->open( $sql );
			while(!$dt->eof) {
				$sql = "select media_id,server1,title from " . PVS_DB_PREFIX . "media where id=" . $dt->row["publication_id"];
				$dx->open( $sql );
				if(!$dx->eof) {
					if (pvs_media_type ($dx->row["media_id"]) == 'photo') {
						$hoverbox_results = pvs_get_hoverbox( $dt->row["publication_id"], "photo", $dx->row["server1"], "", "" );
						$category_result["photo"] = $hoverbox_results["flow_image"];
						$category_result["width"] = $hoverbox_results["flow_width"];
						$category_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dx->row["media_id"]) == 'video') {
						$hoverbox_results = pvs_get_hoverbox( $dt->row["publication_id"], "video", $dx->row["server1"], "", "" );
						$category_result["photo"] = $hoverbox_results["flow_image"];
						$category_result["width"] = $hoverbox_results["flow_width"];
						$category_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dx->row["media_id"]) == 'audio') {
						$hoverbox_results = pvs_get_hoverbox( $dt->row["publication_id"], "audio", $dx->row["server1"], "", "" );
						$category_result["photo"] = $hoverbox_results["flow_image"];
						$category_result["width"] = $hoverbox_results["flow_width"];
						$category_result["height"] = $hoverbox_results["flow_height"];
					}
					if (pvs_media_type ($dx->row["media_id"]) == 'vector') {
						$hoverbox_results = pvs_get_hoverbox( $dt->row["publication_id"], "vector", $dx->row["server1"], "", "" );
						$category_result["photo"] = $hoverbox_results["flow_image"];
						$category_result["width"] = $hoverbox_results["flow_width"];
						$category_result["height"] = $hoverbox_results["flow_height"];
					}
				}
				if ($category_result["photo"] != '') {
					break;
				}
				$dt->movenext();
			}
		}
	}
	
	if ( $category_result["width"] != 0 ) {
		$category_result["height"] = round( $category_result["height"] *  $pvs_global_settings["category_preview"] / $category_result["width"]);
		$category_result["width"] = $pvs_global_settings["category_preview"];
	}
	
	return $category_result;
}





/**
 * Count files in collection
 *
 * @param  int $id Collection ID.
 * @return int
 */
function pvs_count_files_in_collection($id) {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$count_id = 0;
	
	$sql = "select id, title, description, price, types from " . PVS_DB_PREFIX . "collections where id = " . (int) $id;
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		if ( $dp->row["types"] == 1 ) {
			$sql = "select count(id) as count_files from " . PVS_DB_PREFIX . "collections_items where category_id = 0 and collection_id=" . $dp->row["id"];
			$dt->open( $sql );
			if ( ! $dt->eof ) {
				$count_id = $dt->row["count_files"];
			}
		} else {
			$sql = "select count(id) as count_files from " . PVS_DB_PREFIX . "category_items where category_id in (select category_id from " . PVS_DB_PREFIX . "collections_items where publication_id = 0 and collection_id=" . $dp->row["id"].")";
			$dt->open( $sql );
			if ( ! $dt->eof ) {
				$count_id = $dt->row["count_files"];
			}
		}	
	}
	
	return $count_id;
}	





/**
 * The function counts included files in a category
 *
 * @param  int $id_parent Category ID.
 * @return int
 */
function pvs_count_files_in_category( $id_parent ) {
	global $db;
	global $pvs_global_settings;
	global $itg;
	global $nlimit;

	$record_count = 0;

	$dt = new TMySQLQuery;
	$dt->connection = $db;

	//Search all subcategories from the category
	$itg = "";
	$nlimit = 0;
	pvs_build_subcategories_query( ( int )$id_parent );

	$password_protected = pvs_get_password_protected();

	if ( $password_protected != '' ) {
		$password_protected = " and " . $password_protected;
	}

	$category = " and (id in (select publication_id from " . PVS_DB_PREFIX .
		"category_items where (category_id=" . ( int )$id_parent . $itg . ") " . $password_protected .
		")) ";

	$sql_mass["media"] = "select count(*) as count_rows from " . PVS_DB_PREFIX .
		"media b where b.published=1 " . $category;

	foreach ( $sql_mass as $key => $value ) {
		$dt->open( $value );
		if ( ! $dt->eof )
		{
			$record_count += $dt->row["count_rows"];
		}
	}

	return $record_count;
}



/**
 * URL Function
 *
 */



/**
 * Item seo-friendly url
 *
 * @param  int $id publication id.
 * @param  string $product_url publication URL.
 * @return string publication URL
 */
function pvs_item_url( $id, $product_url = "" )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$url = "";

	if ( $product_url == "" )
	{

		$module_table = 0;
		$sql = "select id,title,media_id from " . PVS_DB_PREFIX .
			"media where id=" . ( int )$id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$title = pvs_make_translit( $dp->row["title"] );
			$title_correct = preg_replace( '/[^a-z0-9 ]/i', '', $title );
			if ( $title_correct == "" or ! preg_match( "/[a-z0-9]/i", $title_correct ) )
			{
				$title = "file-" . $id;
			} else
			{
				$title = strtolower( str_replace( " ", "-", $title_correct ) ) . "-" . $id;
			}

			if ( pvs_media_type ($dp->row["media_id"]) == 'photo' )
			{
				$cfolder = "stock-photo";
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'video' )
			{
				$cfolder = "stock-video";
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'audio' )
			{
				$cfolder = "stock-audio";
			}
			if ( pvs_media_type ($dp->row["media_id"]) == 'vector' )
			{
				$cfolder = "stock-vector";
			}

			$url = "/" . $cfolder . "/" . $title . "/";

			$sql = "update " . PVS_DB_PREFIX . "media set url='" . $url .
				"' where id=" . ( int )$id;
			$db->execute( $sql );

			$url = site_url() . $url;

		}
	} else
	{
		$url = site_url() . $product_url;
	}
	return $url;
}


/**
 * Print URL
 *
 * @param  int $id publication id.
 * @param  int $print_id print id.
 * @param  string $title publication title.
 * @param  string $type print type.
 * @param  string $stock stock title.
 * @return string print URL
 */
function pvs_print_url( $id, $print_id, $title, $type, $stock )
{
	$url = "";

	$cfolder = "print";

	if ( $type == 'canvas_prints' )
	{
		$cfolder = "canvas-print";
	}

	if ( $type == 'metal_prints' )
	{
		$cfolder = "metal-print";
	}

	if ( $type == 'framed_prints' )
	{
		$cfolder = "framed-print";
	}

	if ( $type == 'acrylic_prints' )
	{
		$cfolder = "acrylic-print";
	}

	if ( $type == 'greeting_cards' )
	{
		$cfolder = "greeting-card";
	}

	if ( $type == 'iphone_cases' )
	{
		$cfolder = "iphone-case";
	}

	if ( $type == 'galaxy_cases' )
	{
		$cfolder = "galaxy-case";
	}

	if ( $type == 'pillow' )
	{
		$cfolder = "pillow";
	}

	if ( $type == 'bag' )
	{
		$cfolder = "tote-bag";
	}

	if ( $type == 'duvet_cover' )
	{
		$cfolder = "duvet-cover";
	}

	if ( $type == 'shower_curtain' )
	{
		$cfolder = "shower-curtain";
	}

	if ( $type == 'tshirt' )
	{
		$cfolder = "t-shirt";
	}

	$title = pvs_make_translit( $title );
	$title_correct = preg_replace( '/[^a-z0-9 ]/i', '', $title );

	if ( $title_correct == "" or ! preg_match( "/[a-z0-9]/i", $title_correct ) )
	{
		$title = "file";
	} else
	{
		$title = strtolower( str_replace( " ", "-", $title_correct ) );
	}

	$url = "/" . $cfolder . "/" . $title . "-" . $print_id . "-" . $id . "/";

	if ( $stock == "site" or $stock == "" )
	{
		$url = site_url() . $url;
	} elseif ( $stock == "rf123" )
	{
		$url = site_url() . "/123rf" . $url;
	} else
	{
		$url = site_url() . "/" . $stock . $url;
	}

	return $url;
}





/**
 * Category seo-friendly url
 *
 * @param  int $id category id.
 * @param  string $product_url category URL.
 * @return string category URL
 */
function pvs_category_url( $id, $product_url = "" )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$url = "";

	if ( $product_url == "" )
	{
		$sql = "select id,title from " . PVS_DB_PREFIX . "category where id=" . $id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$title = $dp->row["title"];
			
			$title = pvs_make_translit( $title );
			$title = preg_replace( '/[^a-z0-9 ]/i', '', $title );
			$title = str_replace( " ", "-", $title );
			$title = strtolower( $title );

			$url = "/gallery/" . $title . "-" . $dp->row["id"] . "/";

			$sql = "update " . PVS_DB_PREFIX . "category set url='" . $url . "' where id=" . ( int )
				$id;
			$db->execute( $sql );

			$url = site_url() . $url;
		}
	} else
	{
		$url = site_url( ) . $product_url;
	}
	return $url;
}





/**
 * Lightbox seo-friendly url
 *
 * @param  int $id lightbox id.
 * @param  string $title lightbox title.
 * @return string lightbox URL
 */
function pvs_lightbox_url( $id, $title = "" )
{
	global $db;
	$dp = new TMySQLQuery;

	$url = "";

	if ( $title == "" )
	{
		$sql = "select title from " . PVS_DB_PREFIX . "lightboxes where id=" . $id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$title = str_replace( " ", "-", $dp->row["title"] );
		}
	}

	$title = pvs_make_translit( $title );
	$title = preg_replace( '/[^a-z0-9 ]/i', '', $title );
	$title = str_replace( " ", "-", $title );
	$title = strtolower( $title );

	$url = site_url() . "/lightbox/" . $title . "-" . $id . "/";

	return $url;
}






/**
 * Collection seo-friendly url
 *
 * @param  int $id collection id.
 * @param  string $title collection title.
 * @return string collection URL
 */
function pvs_collection_url( $id, $title = "" ) {
	global $db;
	$dp = new TMySQLQuery;

	$url = "";

	if ( $title == "" ) {
		$sql = "select title from " . PVS_DB_PREFIX . "collections where id=" . $id;
		$dp->open( $sql );
		if ( ! $dp->eof ) {
			$title = str_replace( " ", "-", $dp->row["title"] );
		}
	}

	$title = pvs_make_translit( $title );
	$title = preg_replace( '/[^a-z0-9 ]/i', '', $title );
	$title = str_replace( " ", "-", $title );
	$title = strtolower( $title );

	$url = site_url() . "/collection/" . $title . "-" . $id . "/";

	return $url;
}



/**
 * The function creates URL for internal stock pages
 *
 * @param  string $stock_type stock type.
 * @param  int $id id on stock.
 * @param  string $title title on stock.
 * @param  string $content_type type of content.
 * @return string stock URL
 */
function pvs_get_stock_page_url( $stock_type, $id, $title, $content_type )
{
	$stock_url = "";

	$title = pvs_make_translit( $title );
	$title_correct = preg_replace( '/[^a-z0-9 ]/i', '', $title );
	if ( $title_correct == "" or ! preg_match( "/[a-z0-9]/i", $title_correct ) )
	{
		$title = "file-" . $id;
	} else
	{
		$title = strtolower( str_replace( " ", "-", $title_correct ) ) . "-" . $id;
	}

	$stock_url = site_url() . "/" . $stock_type . "-" . $content_type . "/" . $title .
		"/";

	return $stock_url;
}







/**
 * The function creates URL with aff link to a stock site
 *
 * @param  string $stock_type stock type.
 * @param  int $id id on stock.
 * @param  string $type type of content.
 * @param  string $aff_url affiliate URL.
 * @param  string $aff_url2 affiliate URL.
 * @return string affiliate URL
 */
function pvs_get_stock_affiliate_url( $stock_type, $id, $type, $aff_url = '', $aff_url2 = '' )
{
	global $pvs_global_settings;

	$stock_url = "";

	if ( $stock_type == "shutterstock" )
	{
		if ( $type == 'audio' )
		{
			$stock_url = $pvs_global_settings["shutterstock_affiliate"] . "?u=" . urlencode( "http://www.shutterstock.com/music/track/clip/" .
				$id );
		} elseif ( $type == 'video' )
		{
			$stock_url = $pvs_global_settings["shutterstock_affiliate"] . "?u=" . urlencode( "http://www.shutterstock.com/video/clip-" . $id );
		} else
		{
			$stock_url = $pvs_global_settings["shutterstock_affiliate"] .
				"?u=http%3A%2F%2Fwww.shutterstock.com%2Fpic.mhtml%3Fid%3D" . $id;
		}
	}

	if ( $stock_type == "fotolia" )
	{
		if ( $aff_url != '' )
		{
			$stock_url = $aff_url;
		} else
		{
			$stock_url = 'http://www.fotolia.com/id/' . $id . '/partner/' . $pvs_global_settings["fotolia_account"];
		}
	}

	if ( $stock_type == "istockphoto" )
	{
		$stock_url = $pvs_global_settings['istockphoto_affiliate'];

		if ( $type == 'photo' )
		{
			if ( $aff_url2 != '' and $pvs_global_settings['istockphoto_site'] ==
				'istockphoto' )
			{
				$ref_url = $aff_url2;
			} else
			{
				$ref_url = $aff_url;
			}
		} else
		{
			if ( $pvs_global_settings['istockphoto_site'] == 'istockphoto' )
			{
				$ref_url = 'http://www.istockphoto.com/video/video-' . $id;
			} else
			{
				$ref_url = 'http://www.gettyimages.com/detail/video/video/' . $id;
			}
		}

		$stock_url = str_replace( "{ID}", $id, $stock_url );
		$stock_url = str_replace( "{URL}", $ref_url, $stock_url );
		$stock_url = str_replace( "{URL_ENCODED}", urlencode( $ref_url ), $stock_url );
	}

	if ( $stock_type == "depositphotos" )
	{
		$stock_url = $pvs_global_settings['depositphotos_affiliate'];

		$ref_url = 'http://www.depositphotos.com/' . $id . '/';

		$stock_url = str_replace( "{ID}", $id, $stock_url );
		$stock_url = str_replace( "{URL}", $ref_url, $stock_url );
		$stock_url = str_replace( "{URL_ENCODED}", urlencode( $ref_url ), $stock_url );
	}

	if ( $stock_type == "bigstockphoto" )
	{
		$stock_url = $pvs_global_settings['bigstockphoto_affiliate'];

		$ref_url = 'http://www.bigstockphoto.com/image-' . $id . '/';

		$stock_url = str_replace( "{ID}", $id, $stock_url );
		$stock_url = str_replace( "{URL}", $ref_url, $stock_url );
		$stock_url = str_replace( "{URL_ENCODED}", urlencode( $ref_url ), $stock_url );
	}

	if ( $stock_type == "123rf" )
	{
		$stock_url = $pvs_global_settings['rf123_affiliate'];

		$ref_url = 'http://www.123rf.com/photo_' . $id . '.html';

		$stock_url = str_replace( "{ID}", $id, $stock_url );
		$stock_url = str_replace( "{URL}", $ref_url, $stock_url );
		$stock_url = str_replace( "{URL_ENCODED}", urlencode( $ref_url ), $stock_url );
	}
	if ( $stock_type == "adobe" ) {
		$stock_url = $aff_url;
	}

	return $stock_url;
}





/**
 * Order functions
 *
 */





/**
 * Currency function
 *
 * @param  int $param '1' = $1, '2' = 1 USD.
 * @param  bool $cr Is Credits price?. The credits price must be in currency.
 * @param  string $method 'currency' or 'credits'.
 * @return string price prefix or postfix.
 */
function pvs_currency( $param, $cr = true, $method = "" )
{
	global $pvs_global_settings;
	global $currency_symbol;

	if ( ! @$pvs_global_settings["credits"] or $cr == false  or $pvs_global_settings["no_cart"] )
	{
		if ( $param == 1 and isset( $currency_symbol[pvs_get_currency_code(1)] ) )
		{
			return $currency_symbol[pvs_get_currency_code(1)];
		}
		if ( $param == 2 and ! isset( $currency_symbol[pvs_get_currency_code(1)] ) )
		{
			return pvs_get_currency_code(1);
		}
	} else
	{
		if ( $param == 1 and $pvs_global_settings["credits_currency"] and $method ==
			"currency" and isset( $currency_symbol[pvs_get_currency_code(1)] ) )
		{
			return $currency_symbol[pvs_get_currency_code(1)];
		}

		if ( $param == 2 )
		{
			if ( $pvs_global_settings["credits_currency"] )
			{
				if ( $method == "" )
				{
					return pvs_get_currency_code(1) . "&nbsp;" . pvs_word_lang( "or" ) . "&nbsp;" .
						pvs_word_lang( "credits" );
				} elseif ( $method == "currency" )
				{
					if ( ! isset( $currency_symbol[pvs_get_currency_code(1)] ) )
					{
						return pvs_get_currency_code(1);
					}
				} else
				{
					return pvs_word_lang( "credits" );
				}
			} else
			{
				return pvs_word_lang( "credits" );
			}
		}
	}

}



/**
 * Get currency code
 *
 * @param  int $type '1' = USD, '2' = $.
 * @return string
 */
function pvs_get_currency_code($type)
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$currency_code1 = "";
	$currency_code2 = "";
	$sql = "select code1,code2 from " . PVS_DB_PREFIX . "currency where activ=1";
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		$currency_code1 = $dp->row["code1"];
		$currency_code2 = $dp->row["code2"];
	}
	
	if ($type == 1) {
		return $currency_code1;
	} else {
		return $currency_code2;
	}
}






/**
 * Add transaction in the database
 *
 * @param  string $processor paypal.
 * @param  string $tid internal transaction ID in payment system.
 * @param  string $ptype order, credits, subscription.
 * @param  int $pid order ID.
 * @return int transaction ID
 */
function pvs_transaction_add( $processor, $tid, $ptype, $pid )
{
	global $db;
	global $_SESSION;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$id = 0;
	$title = "transaction";
	$total = 0.00;
	$user = "unknown";

	if ( $ptype == "credits" )
	{
		$sql = "select user,credits,total from " . PVS_DB_PREFIX .
			"credits_list where id_parent=" . ( int )$pid;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$user = $dp->row["user"];
			$sql = "select title,price from " . PVS_DB_PREFIX . "credits where id_parent=" .
				$dp->row["credits"];
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$title = $dt->row["title"];
				$total = $dp->row["total"];
			}
		}
	}

	if ( $ptype == "subscription" )
	{
		$sql = "select user,subscription,total from " . PVS_DB_PREFIX .
			"subscription_list where id_parent=" . ( int )$pid;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$user = $dp->row["user"];
			$sql = "select title,price from " . PVS_DB_PREFIX .
				"subscription where id_parent=" . $dp->row["subscription"];
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$title = $dt->row["title"];
				$total = $dp->row["total"];
			}
		}
	}

	if ( $ptype == "order" )
	{
		$sql = "select id,total,user from " . PVS_DB_PREFIX . "orders where id=" . ( int )
			$pid;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$title = "Order #" . $pid;
			$total = $dp->row["total"];
			$user = pvs_user_id_to_login($dp->row["user"]);
		}
	}

	$sql = "insert into " . PVS_DB_PREFIX .
		"payments (data,user,total,ip,processor,tnumber,ptype,pid) values (" .
		pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
		date( "Y" ) ) . ",'" . $user . "','" . $total . "','" . $_SERVER["REMOTE_ADDR"] .
		"','" . $processor . "','" . $tid . "','" . $ptype . "'," . $pid . ")";
	$db->execute( $sql );

	$sql = "select id_parent from " . PVS_DB_PREFIX . "payments where user='" . $user .
		"' order by id_parent desc";
	$dt->open( $sql );
	$id = $dt->row['id_parent'];

	return $id;
}







/**
 * Approve order
 *
 * @param  int $pid order ID.
 */
function pvs_order_approve( $pid )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$sql = "update " . PVS_DB_PREFIX . "orders set status=1 where id=" . ( int )$pid;
	$db->execute( $sql );

	//Affiliate commission
	pvs_affiliate_add_commission( $pid, "orders" );

	pvs_downloads_create( $pid );

	//Create invoice
	$sql = "select credits from " . PVS_DB_PREFIX . "orders where id=" . ( int )$pid;
	$dp->open( $sql );
	if ( ! $dp->eof and ( int )$dp->row["credits"] != 1 )
	{
		pvs_add_invoice( ( int )$pid, "orders" );
	}

	//Update prints in stock
	pvs_update_prints_in_stock( $pid );
}






/**
 * if the order is approved
 *
 * @param  int $id order ID.
 * @param  string $type order, credits, subscription.
 * @return bool
 */
function pvs_is_order_approved( $id, $type )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$flag = false;
	
	if ($type == 'order') {
		$sql = 'select id from ' . PVS_DB_PREFIX . 'orders where status = 1 and id=' . (int) $id;
		$dp->open($sql);
		if (!$dp->eof) {
			$flag = true;
		}
	}
	
	if ($type == 'credits') {
		$sql = 'select id_parent from ' . PVS_DB_PREFIX . 'credits_list where approved = 1 and id_parent=' . (int) $id;
		$dp->open($sql);
		if (!$dp->eof) {
			$flag = true;
		}	
	}
	
	if ($type == 'subscription') {
		$sql = 'select id_parent from ' . PVS_DB_PREFIX . 'subscription_list where approved = 1 and id_parent=' . (int) $id;
		$dp->open($sql);
		if (!$dp->eof) {
			$flag = true;
		}	
	}
	
	return $flag;
}






/**
 * Get order content
 *
 * @param  int $id order ID.
 * @param  string $type admin or not.
 * @param  string $method currency or credits.
 * @return string
 */
function pvs_get_order_content( $id, $type, $method ) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;	
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	$dy = new TMySQLQuery;
	$dy->connection = $db;
	$dz = new TMySQLQuery;
	$dz->connection = $db;
	$dv = new TMySQLQuery;
	$dv->connection = $db;

	$order_content = '<table class="table_admin table table-striped">
	<tr>
	<th>&nbsp;</th>
	<th><b>ID</b></th>
	<th><b>' . pvs_word_lang( "item" ). '</b></th>
	<th><b>' . pvs_word_lang( "price" ). '</b></th>
	<th><b>' . pvs_word_lang( "qty" ). '</b></th>
	<th><b>' . pvs_word_lang( "download links" ). '</b></th>
	</tr>';

	$sql = "select * from " . PVS_DB_PREFIX . "orders_content where id_parent=" . ( int ) $id . " order by id";
	$dp->open( $sql );
	while ( ! $dp->eof ) {
		if ( (int) $dp->row["package"] == 0 ) {
			if ( (int) $dp->row["collection"] == 0 ) {
				if ( $dp->row["prints"] != 1 ) {
					//Digital files
					$sql = "select id,name,price,id_parent,url,shipped from " . PVS_DB_PREFIX . "items where id=" . $dp->row["item"];
					$dt->open( $sql );
					if ( ! $dt->eof ) {
						$order_content .= '<tr valign="top">';
						$folder = "";
						$fl = "photos";
						$url = pvs_item_url( $dt->row["id_parent"] );
						$model = 0;
		
						$sql = "select id,title,server1,media_id from " . PVS_DB_PREFIX . "media where id=" . ( int )$dt->row["id_parent"];
						$dx->open( $sql );
						if ( ! $dx->eof ) {
							if ( pvs_media_type ($dx->row["media_id"]) == 'photo' )
							{
								$server1 = $dx->row["server1"];
								$folder = $dx->row["id"];
								
								$photo_width = 0;
								$photo_height = 0;
			
								$sql = "select width,height from " . PVS_DB_PREFIX . "filestorage_files where id_parent=" . $dx->row["id"] . " and item_id<>0";
								$dy->open( $sql );
								if ( ! $dy->eof ) {
									$photo_width = $dy->row["width"];
									$photo_height = $dy->row["height"];
								} else {
									if ( file_exists( pvs_upload_dir() . pvs_server_url( $dx->row["server1"] ) . "/" .
										$folder . "/" . $dt->row["url"] ) )
									{
										$size = getimagesize( pvs_upload_dir() . pvs_server_url( $dx->row["server1"] ) .
											"/" . $folder . "/" . $dt->row["url"] );
										$photo_width = $size[0];
										$photo_height = $size[1];
									}
								}
			
								$rw = $photo_width;
								$rh = $photo_height;
			
								if ( $photo_width != 0 and $photo_height != 0 )
								{
									$sql = "select * from " . PVS_DB_PREFIX . "sizes where title='" . $dt->row["name"] . "'";
									$dy->open( $sql );
									if ( ! $dy->eof )
									{
										if ( $dy->row["size"] != 0 )
										{
											if ( $rw > $rh )
											{
												$rw = $dy->row["size"];
												if ( $rw != 0 )
												{
													$rh = round( $photo_height * $rw / $photo_width );
												}
											} else
											{
												$rh = $dy->row["size"];
												if ( $rh != 0 )
												{
													$rw = round( $photo_width * $rh / $photo_height );
												}
											}
										}
									}
								}
			
								$fl = "photos";
								$preview = pvs_show_preview( $dt->row["id_parent"], "photo", 1, 1, $dx->row["server1"], $dx->row["id"] );
							}
							if ( pvs_media_type ($dx->row["media_id"]) == 'video' )
							{
								$folder = $dx->row["id"];
								$fl = "videos";
								$server1 = $dx->row["server1"];
								$preview = pvs_show_preview( $dt->row["id_parent"], "video", 1, 1, $dx->row["server1"], $dx->row["id"] );						
							}
							if ( pvs_media_type ($dx->row["media_id"]) == 'audio' )
							{
								$folder = $dx->row["id"];
								$fl = "audio";
								$server1 = $dx->row["server1"];
								$preview = pvs_show_preview( $dt->row["id_parent"], "audio", 1, 1, $dx->row["server1"], $dx->row["id"] );						
							}
							if ( pvs_media_type ($dx->row["media_id"]) == 'vector' )
							{
								$folder = $dx->row["id"];
								$fl = "vector";
								$server1 = $dx->row["server1"];
								$preview = pvs_show_preview( $dt->row["id_parent"], "vector", 1, 1, $dx->row["server1"], $dx->row["id"] );						
							}
						}
	
						$order_content .= '<td><a href="' . $url . '"><img src="' . $preview . '" border="0"></a></td>';
						$order_content .= '<td><a href="' . $url . '"><b>#' . $dt->row["id_parent"] . '</b></a></td>';
						$order_content .= '<td>' . pvs_word_lang( $dt->row["name"] );
						if ( $fl == "photos" ) {
							$order_content .= ': ' . $rw . 'x' . $rh;
						}
	
						$price = $dt->row["price"];
		
						if ( $dp->row["rights_managed"] != "" ) {
							$order_content .= '<div style="margin-top:10px"><b>' . pvs_word_lang( "rights managed" ) . ':</b></div>';
	
							$rights_mass = explode( "|", $dp->row["rights_managed"] );
							for ( $i = 0; $i < count( $rights_mass ); $i++ ) {
								if ( $i == 0 ) {
									$price = $rights_mass[$i];
								} else {
									$rights_mass2 = explode( "-", $rights_mass[$i] );
									if ( isset( $rights_mass2[0] ) and isset( $rights_mass2[1] ) ) {
										$sql = "select title from " . PVS_DB_PREFIX . "rights_managed_structure where id=" . ( int )$rights_mass2[0] . " and  types=1";
										$dx->open( $sql );
										if ( ! $dx->eof ) {
											$order_content .= '<div style="margin-bottom:6px"><b>' . pvs_word_lang( $dx->row["title"] ). ':</b> ';
										}
		
										$sql = "select title from " . PVS_DB_PREFIX . "rights_managed_structure where id=" . ( int )$rights_mass2[1] . " and  types=2";
										$dx->open( $sql );
										if ( ! $dx->eof ) {
											$order_content .= pvs_word_lang( $dx->row["title"] ). '</div>';
										}
									}
								}
							}
						}
		
						if ( $model != 0 ) {
							$order_content .= '<br><small><a href="model.php?model=' . $model . '&order_id=' . ( int )$id . '&item_id=' . $dp->row["item"] . '" target="_blank">' . pvs_word_lang( "model property release" ) . '</a></small>';
						}
						$order_content .= '</td>';
						$order_content .= '<td><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price, 2 ) . ' ' . pvs_currency( 2, true, $method ) . '</span></td>';
						$order_content .= '<td>' . $dp->row["quantity"]. '</td>';
						$order_content .= '<td>';
	
						if ( $dt->row["shipped"] != 1 ) {	 
							$sql = "select id,link,data,tlimit,ulimit from " . PVS_DB_PREFIX .
								"downloads where id_parent=" . $dt->row["id"] . " and order_id=" . ( int )$id;
							$dx->open( $sql );
							if ( ! $dx->eof ) {
								if ( $dx->row["data"] > pvs_get_time() and $dx->row["tlimit"] < $dx->row["ulimit"]+1 ) {
									$order_content .= '<div style="margin-bottom:5px"><b>' . pvs_word_lang( "link" ). ':</b> <a href="' . site_url() . '/download/?f=' . $dx->row["link"] . '" target="blank">' . site_url() . '/download/?f=' . $dx->row["link"] . '</a></div>
									<div style="margin-bottom:5px"><b>' . pvs_word_lang( "expiration date" ) . ':</b> ' . date( date_format, $dx->row["data"] ) . '</div>
									<div><b>' . pvs_word_lang( "times usage" ). ':</b> ' . $dx->row["tlimit"] . ' (' . $dx->row["ulimit"] . ')</div>';
								} else {
									$order_content .= pvs_word_lang( "expired" );
									if ($type == 'admin') {
										$order_content .=  " - <a href='" . pvs_plugins_admin_url('orders/index.php') . "&action=restore&id=" . ( int )$id . "&download_id=" . $dx->row["id"] . "&_wpnonce=" . wp_create_nonce('pvs-order-restore') . "'>" . pvs_word_lang( "restore link" ) . "</a>";
									}
								}
							}
						} else {
							$order_content .= '&mdash;';
						}
						$order_content .= '</td>';
						$order_content .= '</tr>';
					}
				}
		
				if ( $dp->row["prints"] == 1 ) {
					if ( ( int )$dp->row["stock"] == 0 ) {
						if ( $dp->row["printslab"] != 1 ) {
							//Prints items
							$sql = "select id_parent,title,price,itemid,printsid from " . PVS_DB_PREFIX .
								"prints_items where id_parent=" . $dp->row["item"];
							$dt->open( $sql );
							if ( ! $dt->eof ) {
								$folder = "";
								$model = 0;
								$url = pvs_item_url( $dt->row["itemid"] );
								$sql = "select id,title,server1 from " . PVS_DB_PREFIX .
									"media where id=" . ( int )$dt->row["itemid"];
								$dx->open( $sql );
								if ( ! $dx->eof ) {
									$title = $dx->row["title"];
									$folder = $dx->row["id"];
									$server1 = $dx->row["server1"];
									
									$preview2 = pvs_show_preview( $dx->row["id"], "photo", 2, 1, $dx->row["server1"],
									$dx->row["id"] );
									
									$sql = "select width,height,url,filename2 from " . PVS_DB_PREFIX .
									"filestorage_files where id_parent=" . $dx->row["id"] . " and item_id<>0";
									$dy->open( $sql );
									if ( ! $dy->eof ) {
										$photo_width = $dy->row["width"];
										$photo_height = $dy->row["height"];
										$photo_url = $dy->row["url"] . "/" . $dy->row["filename2"];
									} else {
										$photo_url = pvs_upload_dir() . pvs_server_url( $dx->row["server1"] ) . "/" . $folder .
											"/" . pvs_get_photo_file( $dx->row["id"] );
		
										if ( file_exists( $photo_url ) ) {
											$size = getimagesize( $photo_url );
											$photo_width = $size[0];
											$photo_height = $size[1];
										}
									}
		
									if ( $pvs_global_settings["prints_previews"] ) {
										$print_info = pvs_get_print_preview_info( $dt->row["printsid"] );
										if ( $print_info["flag"] ) {
											$url = pvs_print_url( $dt->row["itemid"], $dt->row["printsid"], $dx->row["title"], $print_info["preview"], '' );
										} else {
											$url = pvs_item_url( $dt->row["itemid"] );
										}
		
										$preview = pvs_show_print_preview( $dt->row["itemid"], $dt->row["printsid"] );
									} else {
										$url = pvs_item_url( $dt->row["itemid"] );
										$preview = '<a href="' . $url . '"><img src="' . pvs_show_preview( $dx->row["id"], "photo", 1, 1, $dx->row["server1"], $dx->row["id"] ) . '"></a>';
									}
								}
								$order_content .= '<tr valign="top">';
								$order_content .= '<td>' . $preview;
								
								if ($type == 'admin') {
									if ( ( ( int )$dp->row["x1"] == 0 and ( int )$dp->row["y1"] == 0 and ( int )$dp-> row["x2"] == 0 and ( int )$dp->row["y2"] == 0 ) or ( ( int )$dp->row["x2"] - ( int ) $dp->row["x1"] == $photo_width and ( int )$dp->row["y2"] - ( int )$dp->row["y1"] == $photo_height ) or ( int )$dp->row["print_width"] == 0 or ( int )$dp->row["print_height"] == 0 ) {
	
									} else {
										$order_content .= '<div style="margin-top:5px"><a href="' . site_url( ) . '/orders-scheme/?width=' . $dp->row["print_width"] . '&height=' . $dp->row["print_height"] . '&x1=' . $dp->row["x1"] . ' &y1=' . $dp->row["y1"] . '&x2=' . $dp->row["x2"] . '&y2=' . $dp->row["y2"] . '&preview=' . urlencode( $preview2 ) . '&photo=' . urlencode( @$photo_url ) . '&photo_id=' . $dt->row["itemid"] . '&print=' . $dt->row["title"] . '&order_id=' . ( int )$id . '" target="blank"><i class="glyphicon glyphicon-th-large"></i> ' . pvs_word_lang( "Scheme" ) . '</a>
										</div>
										<div style="margin-top:5px"><a href="' . site_url( ) . '/orders-crop/?width=' . $dp->row["print_width"] . '&height=' . $dp->row["print_height"] . '&x1=' . $dp->row["x1"] . '&y1=' . $dp->row["y1"] . '&x2=' . $dp->row["x2"] . '&y2=' . $dp->row["y2"] . '&photo=' . urlencode( @$photo_url ) . '" target="blank"><i class="glyphicon glyphicon-scissors"></i> ' . pvs_word_lang( "Crop image for print" ) . '</a>
										</div>';
									}
								}
								
								$order_content .= '</td>';
								$order_content .= '<td><a href="' . $url. '"><b>#' . $dt->row["itemid"] . '</b></a></td>';
								$order_content .= '<td>' . pvs_word_lang( "prints" ). ': ' . pvs_word_lang( $dt->row["title"] );
								for ( $i = 1; $i < 11; $i++ ) {
									if ( $dp->row["option" . $i . "_id"] != 0 and $dp->row["option" . $i . "_value"] != "" ) {
										$sql = "select title,property_name from " . PVS_DB_PREFIX .
											"products_options where id=" . $dp->row["option" . $i . "_id"];
										$dx->open( $sql );
										if ( ! $dx->eof ) {
											if ( $dx->row["property_name"] == 'print_size' ) {
												$print_width = $dp->row["print_width"];
												$print_height = $dp->row["print_height"];
		
												if ( $print_width > $print_height ) {
													$print_size = $print_width;
												} else {
													$print_size = $print_height;
												}
		
												$property_value = $dp->row["option" . $i . "_value"];
		
												$value_array = explode( "cm", $property_value );
												if ( count( $value_array ) == 2 and $print_size != 0 ) {
													$property_value = $value_array[0];
													$property_value = round( $property_value * $print_width / $print_size ) .
														"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
												}
		
												$value_array = explode( 'in', $property_value );
												if ( count( $value_array ) == 2 and $print_size != 0 ) {
													$property_value = $value_array[0];
													$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
														round( $property_value * $print_height / $print_size ) . '"';
												}
												$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $property_value . '.</div>';
											} else {
												$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $dp->row["option" . $i . "_value"] . '.</div>';
											}
										}
									}
								}
		
								$price_total = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
									$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
									row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
									$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
									row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
									row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
									$dp->row["option10_id"], $dp->row["option10_value"] );
		
		
								$order_content .= '</td>';
								$order_content .= '<td><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price_total, 2 ) . ' ' . pvs_currency( 2, true, $method ) . '</span></td>';
								$order_content .= '<td>' . $dp->row["quantity"] . '</td>';
								$order_content .= '<td>&mdash;</td>';
								$order_content .= '</tr>';
							}
						} else {
							//Printslab items
							$sql = "select id_parent,title,price from " . PVS_DB_PREFIX . "prints where id_parent=" . $dp->row["item"];
							$dt->open( $sql );
							if ( ! $dt->eof ) {
								$sql = "select id,title,photo,id_parent from " . PVS_DB_PREFIX . "galleries_photos where id=" . ( int )$dp->row["printslab_id"];
								$dx->open( $sql );
								if ( ! $dx->eof ) {
									$title = $dx->row["title"];
									$url = site_url( ) . "/printslab-content/?id=" . $dx->row["id_parent"];
									if ($type == 'admin') {
										$url = pvs_plugins_admin_url('upload/index.php') . "&d=7&id=" . $dx->row["id_parent"];
									}
		
									$photo = "/content/galleries/" . $dx->row["id_parent"] . "/thumb" . $dx->row["id"] . ".jpg";
									$photo_original = pvs_upload_dir()  . "/content/galleries/" . $dx->row["id_parent"] . "/" . $dx->row["photo"];
		
									if ( file_exists( pvs_upload_dir() . "/content/galleries/" .
										$dx->row["id_parent"] . "/thumb" . $dx->row["id"] . "_2.jpg" ) ) {
										$photo = "/content/galleries/" . $dx->row["id_parent"] . "/thumb" . $dx->row["id"] . "_2.jpg";
									}
		
									if ( $pvs_global_settings["prints_previews"] ) {
										$preview = pvs_show_print_preview_printslab( $dt->row["id_parent"], $dx->row["title"], $url, $photo );
									} else {
										$preview = "<a href='" . $url . "'><img src='" . $photo . "'></a>";
									}
								}
								$order_content .= '<tr valign="top">';
								$order_content .= '<td>' . $preview; 
															
								if ($type == 'admin') {
									if ( ( ( int )$dp->row["x1"] == 0 and ( int )$dp->row["y1"] == 0 and ( int )$dp-> row["x2"] == 0 and ( int )$dp->row["y2"] == 0 ) or ( ( int )$dp->row["x2"] - ( int ) $dp->row["x1"] == @$photo_width and ( int )$dp->row["y2"] - ( int )$dp->row["y1"] == @$photo_height ) or ( int )$dp->row["print_width"] == 0 or ( int )$dp->row["print_height"] == 0 ) {
	
									} else {
										$order_content .= '<div style="margin-top:5px"><a href="' . site_url( ) . '/orders-scheme/?width=' . $dp->row["print_width"] . '&height=' . $dp->row["print_height"] . '&x1=' . $dp->row["x1"] . ' &y1=' . $dp->row["y1"] . '&x2=' . $dp->row["x2"] . '&y2=' . $dp->row["y2"] . '&preview=' . urlencode( pvs_upload_dir('baseurl') . $photo ) . '&photo=' . urlencode( @$photo_original ) . '&photo_id=' . $dx->row["id"] . '&print=' . $dt->row["title"] . '&order_id=' . ( int )$id . '" target="blank"><i class="glyphicon glyphicon-th-large"></i> ' . pvs_word_lang( "Scheme" ) . '</a>
										</div>
										<div style="margin-top:5px"><a href="' . site_url( ) . '/orders-crop/?width=' . $dp->row["print_width"] . '&height=' . $dp->row["print_height"] . '&x1=' . $dp->row["x1"] . '&y1=' . $dp->row["y1"] . '&x2=' . $dp->row["x2"] . '&y2=' . $dp->row["y2"] . '&photo=' . urlencode( @$photo_original ) . '" target="blank"><i class="glyphicon glyphicon-scissors"></i> ' . pvs_word_lang( "Crop image for print" ) . '</a>
										</div>';
									}
								}
								$order_content .= '</td>';
								$order_content .= '<td><a href="' . $url . '"><b>' . pvs_word_lang( "prints lab" ) . ' #' . $dp->row["printslab_id"] . '</a></td>';
								$order_content .= '<td>' . pvs_word_lang( "prints" ) . ': ' . pvs_word_lang( $dt->row["title"] ) . '</b>';
	
								for ( $i = 1; $i < 11; $i++ ) {
									if ( $dp->row["option" . $i . "_id"] != 0 and $dp->row["option" . $i . "_value"] != "" ) {
										$sql = "select title,property_name from " . PVS_DB_PREFIX . "products_options where id=" . $dp->row["option" . $i . "_id"];
										$dx->open( $sql );
										if ( ! $dx->eof ) {
											if ( $dx->row["property_name"] == 'print_size' ) {
												$print_width = $dp->row["print_width"];
												$print_height = $dp->row["print_height"];
		
												if ( $print_width > $print_height ) {
													$print_size = $print_width;
												} else {
													$print_size = $print_height;
												}
		
												$property_value = $dp->row["option" . $i . "_value"];
		
												$value_array = explode( "cm", $property_value );
												if ( count( $value_array ) == 2 and $print_size != 0 ) {
													$property_value = $value_array[0];
													$property_value = round( $property_value * $print_width / $print_size ) . "cm x " . round( $property_value * $print_height / $print_size ) . "cm";
												}
		
												$value_array = explode( 'in', $property_value );
												if ( count( $value_array ) == 2 and $print_size != 0 ) {
													$property_value = $value_array[0];
													$property_value = round( $property_value * $print_width / $print_size ) . '" x ' . round( $property_value * $print_height / $print_size ) . '"';
												}
												$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $property_value . '.</div>';
											} else {
												$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $dp->row["option" . $i . "_value"] . '.</div>';
											}
										}
									}
								}
		
								$price_total = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
									$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
									row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
									$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
									row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
									row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
									$dp->row["option10_id"], $dp->row["option10_value"] );
								$order_content .= '</td>';
								$order_content .= '<td class="hidden-phone hidden-tablet"><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price_total, 2 ) . ' ' . pvs_currency( 2, true, $method ) . '</span></td>';
								$order_content .= '<td class="hidden-phone hidden-tablet">' . $dp->row["quantity"] . '</td>';
								$order_content .= '<td>&mdash;</td>';
								$order_content .= '</tr>';
							}
						}
					} else {
						//Stock items
						$sql = "select id_parent,title,price from " . PVS_DB_PREFIX . "prints where id_parent=" . $dp->row["item"];
						$dt->open( $sql );
						if ( ! $dt->eof ) {
							$title = @$mstocks[$dp->row["stock_type"]] . " #" . $dp->row["stock_id"];
							$photo = $dp->row["stock_preview"];
							$url = $dp->row["stock_site_url"];
		
							if ( $pvs_global_settings["prints_previews"] ) {
								$preview = pvs_show_print_preview_stock( $dt->row["id_parent"], '', $dp->row["stock_type"], $dp->row["stock_id"], $photo );
							} else {
								$preview = "<a href='" . $url . "'><img src='" . $photo . "'></a>";
							}
							
							$order_content .= '<tr valign="top">';
							$order_content .= '<td>' . $preview; 
							
							if ($type == 'admin') {
								if ( ( ( int )$dp->row["x1"] == 0 and ( int )$dp->row["y1"] == 0 and ( int )$dp-> row["x2"] == 0 and ( int )$dp->row["y2"] == 0 ) or ( ( int )$dp->row["x2"] - ( int ) $dp->row["x1"] == $dp->row["print_width"] and ( int )$dp->row["y2"] - ( int )$dp->row["y1"] == $dp->row["print_height"] ) or ( int )$dp->row["print_width"] == 0 or ( int )$dp->row["print_height"] == 0 ) {
								} else {
									$order_content .= '<div style="margin-top:5px"><a href="' . site_url( ) . '/orders-scheme/?width=' . $dp->row["print_width"] . '&height=' . $dp->row["print_height"] . '&x1=' . $dp->row["x1"] . ' &y1=' . $dp->row["y1"] . '&x2=' . $dp->row["x2"] . '&y2=' . $dp->row["y2"] . '&preview=' . urlencode( $photo ) . '&photo=' . urlencode( $photo ) . '&photo_id=' . $dp->row["stock_id"] . '&print=' . $dt->row["title"] . '&order_id=' . ( int )$id . '&stock=1" target="blank"><i class="glyphicon glyphicon-th-large"></i> ' . pvs_word_lang( "Scheme" ) . '</a>
									</div>';
								}
							}						
							
							
							$order_content .= '</td>';
							$order_content .= '<td><a href="' . $url . '"><b>' . $title . '</a></td>';
							$order_content .= '<td>' . pvs_word_lang( "prints" ) . ': ' . pvs_word_lang( $dt->row["title"] ) . '</b>';
	
							for ( $i = 1; $i < 11; $i++ ) {
								if ( $dp->row["option" . $i . "_id"] != 0 and $dp->row["option" . $i . "_value"] != "" ) {
									$sql = "select title,property_name from " . PVS_DB_PREFIX . "products_options where id=" . $dp->row["option" . $i . "_id"];
									$dx->open( $sql );
									if ( ! $dx->eof ) {
										if ( $dx->row["property_name"] == 'print_size' ) {
											$print_width = $dp->row["print_width"];
											$print_height = $dp->row["print_height"];
		
											if ( $print_width > $print_height ) {
												$print_size = $print_width;
											} else {
												$print_size = $print_height;
											}
		
											$property_value = $dp->row["option" . $i . "_value"];
		
											$value_array = explode( "cm", $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 ) {
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) .
													"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
											}
		
											$value_array = explode( 'in', $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 ) {
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
													round( $property_value * $print_height / $print_size ) . '"';
											}
											$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $property_value . '.</div>';
										} else {
											$order_content .= '<div class="gr">' . pvs_word_lang( $dx->row["title"] ) . ': ' . $dp->row["option" . $i . "_value"] . '.</div>';
										}
									}
								}
							}
		
							$price_total = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
								$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
								row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
								$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
								row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
								row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
								$dp->row["option10_id"], $dp->row["option10_value"] );
							$order_content .= '</td>';
							$order_content .= '<td class="hidden-phone hidden-tablet"><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price_total, 2 ) . ' ' . 
							pvs_currency( 2, true, $method ) . '</span></td>';
							$order_content .= '<td class="hidden-phone hidden-tablet">' . $dp->row["quantity"] . '</td>';
							$order_content .= '<td>&mdash;</td>';
							$order_content .= '</tr>';
						}
					}
				}
			} else {
				//Collection
				$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . $dp->row["collection"];
				$dx->open( $sql );
				if ( ! $dx->eof ) {
					$price = $dx->row["price"];
	
					$title = pvs_word_lang("Collection") . ': ' . $dx->row["title"] . ' (' . pvs_count_files_in_collection($dx->row["id"]) . ')';
					$url = pvs_collection_url( $dx->row["id"], $dx->row["title"] );
					$collection_result = pvs_show_collection_preview($dx->row["id"]);
	
					$order_content .= '<tr valign="top">';
					$order_content .= '<td><a href="' . pvs_collection_url( $dx->row["id"], $dx->row["title"] ) . '"><img src="' . $collection_result["photo"] . '" style="max-width:' . $pvs_global_settings["thumb_width"] . 'px;max-height:' . $pvs_global_settings["thumb_width"] . 'px"></a></td>';
					$order_content .= '<td><a href="' . pvs_collection_url( $dx->row["id"], $dx->row["title"] ) . '"><b>#' . $dx->row["id"] . '</b></a></td>';
					$order_content .= '<td>' . $title . '</td>';
					$order_content .= '<td><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price, 2 ) . ' ' . pvs_currency( 2, true, $method ) . '</span></td>';
					$order_content .= '<td>1</td>';
					$order_content .= '<td>';
					
					$sql = "select id,link,data,tlimit,ulimit from " . PVS_DB_PREFIX .
							"downloads where collection_id=" . $dx->row["id"] . " and order_id=" . ( int )$id;
					$dt->open( $sql );
					if ( ! $dt->eof ) {
						if ( $dt->row["data"] > pvs_get_time() and $dt->row["tlimit"] < $dt->row["ulimit"]+1 ) {
							$order_content .= '<div style="margin-bottom:5px"><b>' . pvs_word_lang( "link" ). ':</b> <a href="' . site_url() . '/download/?f=' . $dt->row["link"] . '" target="blank">' . site_url() . '/download/?f=' . $dt->row["link"] . '</a></div>';
							
							$order_content .= '<div style="margin-bottom:5px"><b>' . pvs_word_lang( "expiration date" ). ':</b> ' . date( date_format, $dt->row["data"] ) . '</div>';
							
							$order_content .= '<div><b>' . pvs_word_lang( "times usage" ) . ':</b> ' . $dt->row["tlimit"] . ' (' . $dt->row["ulimit"] . ')</div>';
						} else {
							$order_content .= pvs_word_lang( "expired" );
							if ($type == 'admin') {
								$order_content .=  " - <a href='" . pvs_plugins_admin_url('orders/index.php') . "&action=restore&download_id=" . $dt->row["id"] . "&id=" . ( int )$id . "&_wpnonce=" . wp_create_nonce('pvs-order-restore') . "'>" . pvs_word_lang( "restore link" ) . "</a>";
							}
						}
					}
					$order_content .= '</td></tr>';
				}
			}
		} else {
			//Package
			$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . $dp->row["package"];
			$dx->open( $sql );
			if ( ! $dx->eof ) {
				$price = $dx->row["price"];

				$title = pvs_word_lang("Package") . ': ' . $dx->row["title"];
				$url = pvs_package_url($dx->row["id"], $dp->row["id"]);
				$package_result = pvs_show_package_preview($dx->row["id"]);

				$order_content .= '<tr valign="top">';
				$order_content .= '<td><img src="' . $package_result["photo"] . '" style="max-width:' . $pvs_global_settings["thumb_width"] . 'px;max-height:' . $pvs_global_settings["thumb_width"] . 'px"></td>';
				$order_content .= '<td><b>#' . $dx->row["id"] . '</b></td>';
				$order_content .= '<td>' . $title;
								
				$sql = "select file_type, file_id,file_number,print_id from " . PVS_DB_PREFIX .
						"packages_list where order_content_id = " . $dp->row["id"] . " and file_id > 0";
				$dt->open( $sql );
				while ( ! $dt->eof ) {
					$print_title = '';
					
					if ( $dt->row["print_id"] > 0 ) {
						$sql = "select title from " . PVS_DB_PREFIX .
						"prints where id_parent = " . $dt->row["print_id"];
						$dz->open( $sql );
						if ( ! $dz->eof ) {
							$print_title = ' - ' . $dz->row["title"];
						}
					}
				
					$order_content .= '<br><small><a href="' . pvs_item_url( $dt->row["file_id"] ) . '">ID #' . $dt->row["file_id"] . $print_title . '</a></small>';
					$dt->movenext();
				}				
				
				$order_content .= '</td>';
				$order_content .= '<td><span class="price">' . pvs_currency( 1, true, $method ) . pvs_price_format( $price, 2 ) . ' ' . pvs_currency( 2, true, $method ) . '</span></td>';
				$order_content .= '<td>1</td>';
				$order_content .= '<td>';
				
				$sql = "select id,link,data,tlimit,ulimit from " . PVS_DB_PREFIX .
						"downloads where id_parent = " . $dp->row["id"] . " and order_id = " . ( int )$id . " and package_id=" . $dx->row["id"] . " and order_id=" . ( int )$id;
				$dt->open( $sql );
				if ( ! $dt->eof ) {
					if ( $dt->row["data"] > pvs_get_time() and $dt->row["tlimit"] < $dt->row["ulimit"]+1 ) {
						$order_content .= '<div style="margin-bottom:5px"><b>' . pvs_word_lang( "link" ). ':</b> <a href="' . site_url() . '/download/?f=' . $dt->row["link"] . '" target="blank">' . site_url() . '/download/?f=' . $dt->row["link"] . '</a></div>';
						
						$order_content .= '<div style="margin-bottom:5px"><b>' . pvs_word_lang( "expiration date" ). ':</b> ' . date( date_format, $dt->row["data"] ) . '</div>';
						
						$order_content .= '<div><b>' . pvs_word_lang( "times usage" ) . ':</b> ' . $dt->row["tlimit"] . ' (' . $dt->row["ulimit"] . ')</div>';
					} else {
						$order_content .= pvs_word_lang( "expired" );
						if ($type == 'admin') {
							$order_content .=  " - <a href='" . pvs_plugins_admin_url('orders/index.php') . "&action=restore&download_id=" . $dt->row["id"] . "&id=" . ( int )$id . "&_wpnonce=" . wp_create_nonce('pvs-order-restore') . "'>" . pvs_word_lang( "restore link" ) . "</a>";
						}
					}
				}
				$order_content .= '</td></tr>';
			}		
		}
		$dp->movenext();
	}
	$order_content .= '</table>';
	return $order_content;
}







/**
 * Add order to the database
 *
 * @param  float $subtotal.
 * @param  float $discount.
 * @param  float $total.
 * @param  float $shipping.
 * @param  float $taxes.
 * @param  int $shipping_method digital or delivered.
 * @param  float $weight.
 * @return int order ID
 */
function pvs_order_add( $subtotal, $discount, $total, $shipping, $taxes, $shipping_method, $weight ) {
	global $db;
	global $_SESSION;
	global $pvs_global_settings;
	$dpp = new TMySQLQuery;
	$dpp->connection = $db;
	$dtt = new TMySQLQuery;
	$dtt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	$dxx = new TMySQLQuery;
	$dxx->connection = $db;
	global $taxes_info;

	if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
		@$_SESSION["checkout_method"] == "currency" ) ) {
		$credits = 0;
	} else {
		$credits = 1;
	}

	$user_info = get_userdata(get_current_user_id());
	
	$sql = "insert into " . PVS_DB_PREFIX .
		"orders (user,subtotal,discount,total,status,payment,data,shipping,tax,shipping_firstname,shipping_lastname,shipping_address,shipping_country,shipping_city,shipping_zip,shipped,billing_firstname,billing_lastname,billing_address,billing_country,billing_city,billing_zip,shipping_method,shipping_state,billing_state,weight,credits,billing_company,billing_vat,billing_business) values (" . get_current_user_id() . "," . $subtotal . "," . $discount . "," . $total . ",0,0," .
		pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
		date( "Y" ) ) . "," . $shipping . "," . $taxes . ",'" . pvs_result( @$_SESSION["shipping_firstname"] ) .
		"','" . pvs_result( @$_SESSION["shipping_lastname"] ) . "','" . pvs_result( @$_SESSION["shipping_address"] ) .
		"','" . pvs_result( @$_SESSION["shipping_country"] ) . "','" . pvs_result( @$_SESSION["shipping_city"] ) .
		"','" . pvs_result( @$_SESSION["shipping_zip"] ) . "',0,'" . pvs_result( @$_SESSION["billing_firstname"] ) .
		"','" . pvs_result( @$_SESSION["billing_lastname"] ) . "','" . pvs_result( @$_SESSION["billing_address"] ) .
		"','" . pvs_result( @$_SESSION["billing_country"] ) . "','" . pvs_result( @$_SESSION["billing_city"] ) .
		"','" . pvs_result( @$_SESSION["billing_zip"] ) . "'," . ( int )$shipping_method .
		",'" . pvs_result( @$_SESSION["shipping_state"] ) . "','" . pvs_result( @$_SESSION["billing_state"] ) .
		"'," . ( float )@$_SESSION["weight"] . "," . $credits . ",'" . pvs_result($user_info-> company) . "','" . pvs_result($user_info-> vat) . "'," . (int)$user_info-> business . ")";
	$db->execute( $sql );

	$sql = "select id,user from " . PVS_DB_PREFIX . "orders where user=" . get_current_user_id() .
		" order by id desc";
	$dpp->open( $sql );
	if ( ! $dpp->eof ) {
		$order_id = $dpp->row["id"];
	}

	$cart_id = pvs_shopping_cart_id();

	$sql = "select id,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,stock,stock_type,stock_id,stock_url,stock_preview,stock_site_url,x1,y1,x2,y2,print_width,print_height,collection,package from " .
		PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
	$dpp->open( $sql );
	while ( ! $dpp->eof ) {
		if ( (int) $dpp->row["package"] == 0 ) {
			if ( (int) $dpp->row["collection"] == 0 ) {
				if ( $dpp->row["item_id"] > 0 ) {
					//Digital files
					$sql = "select id,price,name,shipped from " . PVS_DB_PREFIX . "items where id=" .
						$dpp->row["item_id"];
					$dtt->open( $sql );
					if ( ! $dtt->eof )
					{
						$price = $dtt->row["price"];
		
						if ( $dpp->row["rights_managed"] != "" )
						{
							$rights_mass = explode( "|", $dpp->row["rights_managed"] );
							$price = $rights_mass[0];
						}
		
						if ( $dtt->row["shipped"] != 1 )
						{
							pvs_order_taxes_calculate( $price, false, "order" );
						} else
						{
							pvs_order_taxes_calculate( $price, false, "prints" );
						}
		
						if ( $credits == 1 )
						{
							$taxes_info["id"] = 0;
							$taxes_info["total"] = 0;
						}
		
						$sql = "insert into " . PVS_DB_PREFIX .
							"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,taxes,taxes_id,collection) values (" .
							$order_id . "," . $dtt->row["id"] . "," . $price . "," . $dpp->row["quantity"] .
							",0,0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'','" . $dpp->row["rights_managed"] .
							"'," . $dpp->row["printslab"] . ",0," . ( float )$taxes_info["total"] . "," . ( int )
							$taxes_info["id"] . ",0)";
						$db->execute( $sql );
		
						//Remove exclusive files
						$sql = "update " . PVS_DB_PREFIX . "media set published=-1 where exclusive=1 and id=" . $dpp->row["publication_id"];
						$db->execute( $sql );
					}
				}
		
				if ( $dpp->row["prints_id"] > 0 ) {
		
					if ( ( int )$dpp->row["stock"] == 0 )
					{
						if ( $dpp->row["printslab"] != 1 )
						{
							//Prints
							$sql = "select id_parent,price,title from " . PVS_DB_PREFIX .
								"prints_items where id_parent=" . $dpp->row["prints_id"];
							$dtt->open( $sql );
							if ( ! $dtt->eof )
							{
								$price = pvs_define_prints_price( $dtt->row["price"], $dpp->row["option1_id"], $dpp->
									row["option1_value"], $dpp->row["option2_id"], $dpp->row["option2_value"], $dpp->
									row["option3_id"], $dpp->row["option3_value"], $dpp->row["option4_id"], $dpp->
									row["option4_value"], $dpp->row["option5_id"], $dpp->row["option5_value"], $dpp->
									row["option6_id"], $dpp->row["option6_value"], $dpp->row["option7_id"], $dpp->
									row["option7_value"], $dpp->row["option8_id"], $dpp->row["option8_value"], $dpp->
									row["option9_id"], $dpp->row["option9_value"], $dpp->row["option10_id"], $dpp->
									row["option10_value"] );
								pvs_order_taxes_calculate( $price, false, "prints" );
		
								if ( $credits == 1 )
								{
									$taxes_info["id"] = 0;
									$taxes_info["total"] = 0;
								}
		
								$sql = "insert into " . PVS_DB_PREFIX .
									"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,taxes,taxes_id,x1,y1,x2,y2,print_width,print_height,collection) values (" .
									$order_id . "," . $dtt->row["id_parent"] . "," . $dtt->row["price"] . "," . $dpp->
									row["quantity"] . ",1," . $dpp->row["option1_id"] . ",'" . $dpp->row["option1_value"] .
									"'," . $dpp->row["option2_id"] . ",'" . $dpp->row["option2_value"] . "'," . $dpp->
									row["option3_id"] . ",'" . $dpp->row["option3_value"] . "'," . $dpp->row["option4_id"] .
									",'" . $dpp->row["option4_value"] . "'," . $dpp->row["option5_id"] . ",'" . $dpp->
									row["option5_value"] . "'," . $dpp->row["option6_id"] . ",'" . $dpp->row["option6_value"] .
									"'," . $dpp->row["option7_id"] . ",'" . $dpp->row["option7_value"] . "'," . $dpp->
									row["option8_id"] . ",'" . $dpp->row["option8_value"] . "'," . $dpp->row["option9_id"] .
									",'" . $dpp->row["option9_value"] . "'," . $dpp->row["option10_id"] . ",'" . $dpp->
									row["option10_value"] . "',''," . $dpp->row["printslab"] . ",0," . ( float )$taxes_info["total"] *
									$dpp->row["quantity"] . "," . ( int )$taxes_info["id"] . "," . ( int )$dpp->row["x1"] .
									"," . ( int )$dpp->row["y1"] . "," . ( int )$dpp->row["x2"] . "," . ( int )$dpp->
									row["y2"] . "," . ( int )$dpp->row["print_width"] . "," . ( int )$dpp->row["print_height"] .
									",0)";
								$db->execute( $sql );
							}
						} else {
							//Prints lab
							$sql = "select id_parent,price,title from " . PVS_DB_PREFIX .
								"prints where id_parent=" . $dpp->row["prints_id"];
							$dtt->open( $sql );
							if ( ! $dtt->eof ) {
								$price = pvs_define_prints_price( $dtt->row["price"], $dpp->row["option1_id"], $dpp->
									row["option1_value"], $dpp->row["option2_id"], $dpp->row["option2_value"], $dpp->
									row["option3_id"], $dpp->row["option3_value"], $dpp->row["option4_id"], $dpp->
									row["option4_value"], $dpp->row["option5_id"], $dpp->row["option5_value"], $dpp->
									row["option6_id"], $dpp->row["option6_value"], $dpp->row["option7_id"], $dpp->
									row["option7_value"], $dpp->row["option8_id"], $dpp->row["option8_value"], $dpp->
									row["option9_id"], $dpp->row["option9_value"], $dpp->row["option10_id"], $dpp->
									row["option10_value"] );
								pvs_order_taxes_calculate( $price, false, "prints" );
		
								if ( $credits == 1 ) {
									$taxes_info["id"] = 0;
									$taxes_info["total"] = 0;
								}
		
								$sql = "insert into " . PVS_DB_PREFIX .
									"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,taxes,taxes_id,x1,y1,x2,y2,print_width,print_height,collection) values (" .
									$order_id . "," . $dtt->row["id_parent"] . "," . $dtt->row["price"] . "," . $dpp->
									row["quantity"] . ",1," . $dpp->row["option1_id"] . ",'" . $dpp->row["option1_value"] .
									"'," . $dpp->row["option2_id"] . ",'" . $dpp->row["option2_value"] . "'," . $dpp->
									row["option3_id"] . ",'" . $dpp->row["option3_value"] . "'," . $dpp->row["option4_id"] .
									",'" . $dpp->row["option4_value"] . "'," . $dpp->row["option5_id"] . ",'" . $dpp->
									row["option5_value"] . "'," . $dpp->row["option6_id"] . ",'" . $dpp->row["option6_value"] .
									"'," . $dpp->row["option7_id"] . ",'" . $dpp->row["option7_value"] . "'," . $dpp->
									row["option8_id"] . ",'" . $dpp->row["option8_value"] . "'," . $dpp->row["option9_id"] .
									",'" . $dpp->row["option9_value"] . "'," . $dpp->row["option10_id"] . ",'" . $dpp->
									row["option10_value"] . "',''," . $dpp->row["printslab"] . "," . $dpp->row["publication_id"] .
									"," . ( float )$taxes_info["total"] * $dpp->row["quantity"] . "," . ( int )$taxes_info["id"] .
									"," . ( int )$dpp->row["x1"] . "," . ( int )$dpp->row["y1"] . "," . ( int )$dpp->
									row["x2"] . "," . ( int )$dpp->row["y2"] . "," . ( int )$dpp->row["print_width"] .
									"," . ( int )$dpp->row["print_height"] . ",0)";
								$db->execute( $sql );
							}
						}
					} else {
						//Stock prints
						$sql = "select id_parent,price,title from " . PVS_DB_PREFIX .
							"prints where id_parent=" . $dpp->row["prints_id"];
						$dtt->open( $sql );
						if ( ! $dtt->eof ) {
							$price = pvs_define_prints_price( $dtt->row["price"], $dpp->row["option1_id"], $dpp->
								row["option1_value"], $dpp->row["option2_id"], $dpp->row["option2_value"], $dpp->
								row["option3_id"], $dpp->row["option3_value"], $dpp->row["option4_id"], $dpp->
								row["option4_value"], $dpp->row["option5_id"], $dpp->row["option5_value"], $dpp->
								row["option6_id"], $dpp->row["option6_value"], $dpp->row["option7_id"], $dpp->
								row["option7_value"], $dpp->row["option8_id"], $dpp->row["option8_value"], $dpp->
								row["option9_id"], $dpp->row["option9_value"], $dpp->row["option10_id"], $dpp->
								row["option10_value"] );
							pvs_order_taxes_calculate( $price, false, "prints" );
		
							if ( $credits == 1 ) {
								$taxes_info["id"] = 0;
								$taxes_info["total"] = 0;
							}
		
							$sql = "insert into " . PVS_DB_PREFIX .
								"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,stock,stock_type,stock_id,stock_url,stock_preview,stock_site_url,taxes,taxes_id,x1,y1,x2,y2,print_width,print_height,collection) values (" .
								$order_id . "," . $dtt->row["id_parent"] . "," . $dtt->row["price"] . "," . $dpp->
								row["quantity"] . ",1," . $dpp->row["option1_id"] . ",'" . $dpp->row["option1_value"] .
								"'," . $dpp->row["option2_id"] . ",'" . $dpp->row["option2_value"] . "'," . $dpp->
								row["option3_id"] . ",'" . $dpp->row["option3_value"] . "'," . $dpp->row["option4_id"] .
								",'" . $dpp->row["option4_value"] . "'," . $dpp->row["option5_id"] . ",'" . $dpp->
								row["option5_value"] . "'," . $dpp->row["option6_id"] . ",'" . $dpp->row["option6_value"] .
								"'," . $dpp->row["option7_id"] . ",'" . $dpp->row["option7_value"] . "'," . $dpp->
								row["option8_id"] . ",'" . $dpp->row["option8_value"] . "'," . $dpp->row["option9_id"] .
								",'" . $dpp->row["option9_value"] . "'," . $dpp->row["option10_id"] . ",'" . $dpp->
								row["option10_value"] . "',''," . $dpp->row["printslab"] . "," . $dpp->row["publication_id"] .
								",1,'" . $dpp->row["stock_type"] . "'," . $dpp->row["stock_id"] . ",'" . $dpp->
								row["stock_url"] . "','" . $dpp->row["stock_preview"] . "','" . $dpp->row["stock_site_url"] .
								"'," . ( float )$taxes_info["total"] * $dpp->row["quantity"] . "," . ( int )$taxes_info["id"] .
								"," . ( int )$dpp->row["x1"] . "," . ( int )$dpp->row["y1"] . "," . ( int )$dpp->
								row["x2"] . "," . ( int )$dpp->row["y2"] . "," . ( int )$dpp->row["print_width"] .
								"," . ( int )$dpp->row["print_height"] . ",0)";
							$db->execute( $sql );
						}
					}
				}
			} else {
				//Collection
				$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . $dpp->row["collection"];
				$dtt->open( $sql );
				if ( ! $dtt->eof ) {
					$price = $dtt->row["price"];
	
					$title = pvs_word_lang("Collection") . ': ' . $dtt->row["title"] . ' (' . pvs_count_files_in_collection($dtt->row["id"]) . ')';
					$url = pvs_collection_url( $dtt->row["id"], $dtt->row["title"] );
					
					pvs_order_taxes_calculate( $price, false, "order" );
					
					if ( $credits == 1 ) {
						$taxes_info["id"] = 0;
						$taxes_info["total"] = 0;
					}
					
					$sql = "insert into " . PVS_DB_PREFIX .
							"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,taxes,taxes_id,collection) values (" .
							$order_id . ",0," . $price . "," . $dpp->row["quantity"] . ",0,0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'','',0,0," . ( float )$taxes_info["total"] . "," . ( int )
							$taxes_info["id"] . "," . $dpp->row["collection"] . ")";
						$db->execute( $sql );
				}
			}
		} else {
			//Package
			$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . $dpp->row["package"];
			$dtt->open( $sql );
			if ( ! $dtt->eof ) {
				$price = $dtt->row["price"];

				$title = pvs_word_lang("Package") . ': ' . $dtt->row["title"];

				$sql = "select id from " . PVS_DB_PREFIX . "packages_files where print_id > 0 and quantity > 0 and package_id = " . $dpp->row["package"];
				$dxx->open($sql);
				if ( ! $dxx->eof ) {
					pvs_order_taxes_calculate( $price, false, "prints" );
				} else {
					pvs_order_taxes_calculate( $price, false, "order" );
				}
				
				if ( $credits == 1 ) {
					$taxes_info["id"] = 0;
					$taxes_info["total"] = 0;
				}
				
				$sql = "insert into " . PVS_DB_PREFIX .
						"orders_content (id_parent,item,price,quantity,prints,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,printslab_id,taxes,taxes_id,collection,package) values (" .
						$order_id . ",0," . $price . "," . $dpp->row["quantity"] . ",0,0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'','',0,0," . ( float )$taxes_info["total"] . "," . ( int )
						$taxes_info["id"] . ",0," . $dpp->row["package"] . ")";
				$db->execute( $sql );
				
				$sql = "select id from " . PVS_DB_PREFIX . "orders_content where package = " . $dpp->row["package"] . " and id_parent = " . $order_id . " order by id desc";
				$dxx->open($sql);
				
				$order_content_id = $dxx->row["id"];
				
				$sql = "update " . PVS_DB_PREFIX . "packages_list set order_content_id = " . $order_content_id . " where cart_content_id = " . $dpp->row["id"];
				$db->execute($sql);
			}		
		}
		$dpp->movenext();
	}

	//Update carts
	$sql = "update " . PVS_DB_PREFIX . "carts set order_id=" . $order_id .
		",user_id=" . get_current_user_id() . " where id=" . $cart_id;
	$db->execute( $sql );

	//Update coupon
	$sql = "update " . PVS_DB_PREFIX . "coupons set used=1 where tlimit=ulimit";
	$db->execute( $sql );

	return $order_id;
}






/**
 * Get user login by order ID
 *
 * @param  int $id order ID.
 * @return sting user login
 */
function pvs_order_user( $id )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$user = "";
	$sql = "select user from " . PVS_DB_PREFIX . "orders where id=" . ( int )$id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$user = pvs_user_id_to_login($dp->row["user"]);
	}
	return $user;
}






/**
 * The function checks if the order's total is correct
 *
 * @param float $total order total.
 * @param string $product_type order, credits, subscription.
 * @param int $product_id order ID.
 * @return bool
 */
function pvs_check_order_total( $total, $product_type, $product_id )
{
	global $rs;
	global $ds;
	$product_total2 = 0;

	if ( $product_type == "order" )
	{
		$sql = "select total from " . PVS_DB_PREFIX . "orders where id=" . ( int )$product_id;
		$rs->open( $sql );
		if ( ! $rs->eof )
		{
			$product_total2 = $rs->row["total"];
		}
	}

	if ( $product_type == "credits" )
	{
		$sql = "select total from " . PVS_DB_PREFIX . "credits_list where id_parent=" . ( int )
			$product_id;
		$rs->open( $sql );
		if ( ! $rs->eof )
		{
			$product_total2 = $rs->row["total"];
		}
	}

	if ( $product_type == "subscription" )
	{
		$sql = "select total from " . PVS_DB_PREFIX .
			"subscription_list where id_parent=" . ( int )$product_id;
		$rs->open( $sql );
		if ( ! $rs->eof )
		{
			$product_total2 = $rs->row["total"];
		}
	}

	if ( $total != $product_total2 )
	{
		return false;
	} else
	{
		return true;
	}
}





/**
 * The function shows an order content
 *
 * @param  string $product_type order, credits or subscription.
 * @param  int $product_in order ID, credits ID or subscription ID.
 * @param float $coefficient taxes rate.
 * @return string
 */
function pvs_show_order_content( $product_type, $product_id, $coefficient = "" ) {
	global $db;
	global $pvs_global_settings;
	global $mstocks;

	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$product_subtotal = 0;
	$product_shipping = 0;
	$product_discount = 0;
	$product_tax = 0;
	$product_total = 0;
	$product_name = 0;
	$product_tax_id = 0;
	$product_tax_name = "";
	$product_order_credits = 0;

	if ( $product_type == "orders" ) {
		$product_type = "order";
	}

	if ( $product_type == "credits" ) {
		$sql = "select title,subtotal,discount,taxes,total,taxes_id from " .
			PVS_DB_PREFIX . "credits_list where id_parent=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof ) {
			$product_name = pvs_word_lang( "credits" ) . ": " . $dp->row["title"];
			$product_total = $dp->row["total"];
			$product_subtotal = $dp->row["subtotal"];
			$product_tax = $dp->row["taxes"];
			$product_discount = $dp->row["discount"];
			$product_tax_id = $dp->row["taxes_id"];

			if ( $product_tax_id != 0 )
			{
				$sql = "select title,title,	rates_depend,price_include,rate_all,rate_all_type from " .
					PVS_DB_PREFIX . "tax where id=" . ( int )$product_tax_id;
				$dp->open( $sql );
				if ( ! $dp->eof )
				{
					if ( $dp->row["rate_all_type"] == 1 )
					{
						$product_tax_name = $dp->row["rate_all"] . "%";
					}
				}
			}
		}
	}

	if ( $product_type == "subscription" ) {
		$sql = "select title,subtotal,discount,taxes,total,taxes_id from " .
			PVS_DB_PREFIX . "subscription_list where id_parent=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof ) {
			$product_name = pvs_word_lang( "subscription" ) . ": " . $dp->row["title"];
			$product_total = $dp->row["total"];
			$product_subtotal = $dp->row["subtotal"];
			$product_tax = $dp->row["taxes"];
			$product_discount = $dp->row["discount"];
			$product_tax_id = $dp->row["taxes_id"];

			if ( $product_tax_id != 0 )
			{
				$sql = "select title,title,	rates_depend,price_include,rate_all,rate_all_type from " .
					PVS_DB_PREFIX . "tax where id=" . ( int )$product_tax_id;
				$dp->open( $sql );
				if ( ! $dp->eof )
				{
					if ( $dp->row["rate_all_type"] == 1 )
					{
						$product_tax_name = $dp->row["rate_all"] . "%";
					}
				}
			}
		}
	}

	if ( $product_type == "order" ) {
		$sql = "select id,total,subtotal,discount,shipping,tax,credits from " .
			PVS_DB_PREFIX . "orders where id=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof ) {
			$product_name = pvs_word_lang( "order" ) . "#" . $dp->row["id"];
			$product_total = $dp->row["total"];
			$product_subtotal = $dp->row["subtotal"];
			$product_shipping = $dp->row["shipping"];
			$product_tax = $dp->row["tax"];
			$product_discount = $dp->row["discount"];
			$product_order_credits = ( int )$dp->row["credits"];
		}
	}

	$order_text = "<table border='0' cellpadding='0' cellspacing='0' class='table table-striped' style='width:100%' border='1' cellspacing='0' cellpadding='5'>
	<tr>
	<th width='50%'><b>" . pvs_word_lang( "Items" ) . "</b></th>
	<th><b>" . pvs_word_lang( "quantity" ) . "</b></th>
	
	<th><b>" . pvs_word_lang( "price" ) . "</b></th>
	<th><b>" . pvs_word_lang( "VAT" ) . "</b></th>
	<th><b>" . pvs_word_lang( "Amount" ) . "</b></th>
	</tr>";

	if ( $product_type == "credits" or $product_type == "subscription" ) {
		$order_text .= "<tr>
		<td><b>" . $product_name . "</b></td>
		<td>1</td>
		
		<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_total,
			2 ) . " " . pvs_currency( 2, false ) . "</td>
		<td>" . $product_tax_name . "</td>
		<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_total,
			2 ) . " " . pvs_currency( 2, false ) . "</td>
		</tr>";
	} else {
		$sql = "select * from " . PVS_DB_PREFIX .
			"orders_content where id_parent=" . ( int )$product_id;
		$dp->open( $sql );
		while ( ! $dp->eof ) {
			$order_text .= "<tr>
			<td>";
			if ( (int) $dp->row["package"] == 0 ) {
				if ( (int) $dp->row["collection"] == 0 ) {
					if ( $dp->row["prints"] == 0 ) {
						//Digital files
						$sql = "select name,id_parent from " . PVS_DB_PREFIX . "items where id=" . $dp->
							row["item"];
						$dt->open( $sql );
						if ( ! $dt->eof )
						{
							$order_text .= "#" . $dt->row["id_parent"] . "  &mdash;  " . $dt->row["name"];
							$price = $dp->row["price"];
						}
					} else {
						if ( ( int )$dp->row["stock"] == 0 ) {
							if ( $dp->row["printslab"] != 1 ) {
								//Prints
								$sql = "select title,itemid from " . PVS_DB_PREFIX .
									"prints_items where id_parent=" . $dp->row["item"];
								$dt->open( $sql );
								if ( ! $dt->eof ) {
									$order_text .= "#" . $dt->row["itemid"] . " " . pvs_word_lang( "prints" ) . " " .
										$dt->row["title"];
									$price = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
									$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
									row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
									$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
									row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
									row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
									$dp->row["option10_id"], $dp->row["option10_value"] );
								}
							} else {
								//Printslab
								$sql = "select id_parent,title,price from " . PVS_DB_PREFIX . "prints where id_parent=" . $dp->row["item"];
								$dt->open( $sql );
								if ( ! $dt->eof ) {
									//Printslab
									$sql = "select id_parent,title,price from " . PVS_DB_PREFIX . "prints where id_parent=" . $dp->row["item"];
									$dt->open( $sql );
									if ( ! $dt->eof ) {
										$order_text .= pvs_word_lang( "prints lab" ) . ' #' . $dp->row["printslab_id"];
										$price = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
										$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
										row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
										$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
										row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
										row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
										$dp->row["option10_id"], $dp->row["option10_value"] );
									}
								}
							}
						} else {
							//Prints stock
							$sql = "select id_parent,title,price from " . PVS_DB_PREFIX . "prints where id_parent=" . $dp->row["item"];
							$dt->open( $sql );
							if ( ! $dt->eof ) {
								$order_text .= @$mstocks[$dp->row["stock_type"]] . " #" . $dp->row["stock_id"] . ' - ' . pvs_word_lang( $dt->row["title"] );
								$price = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
								$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
								row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
								$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
								row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
								row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
								$dp->row["option10_id"], $dp->row["option10_value"] );
							}
						}
					}
				} else {
					//Collection
					$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . $dp->row["collection"];
					$dt->open( $sql );
					if ( ! $dt->eof ) {
						$order_text .= pvs_word_lang("Collection") . ': ' . $dt->row["title"] . ' (' . pvs_count_files_in_collection($dt->row["id"]) . ')';
						$price = $dt->row["price"];
					}
				}
			} else {
				//Package
				$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . $dp->row["package"];
				$dt->open( $sql );
				if ( ! $dt->eof ) {
					$order_text .= pvs_word_lang("Package") . ': ' . $dt->row["title"];
					$price = $dt->row["price"];
				}			
			}

			if ( $dp->row["taxes_id"] != 0 ) {
				$sql = "select title,title,	rates_depend,price_include,rate_all,rate_all_type from " .
					PVS_DB_PREFIX . "tax where id=" . ( int )$dp->row["taxes_id"];
				$dt->open( $sql );
				if ( ! $dt->eof ) {
					if ( $dt->row["rate_all_type"] == 1 ) {
						$product_tax_name = $dt->row["rate_all"] . "%";
					}
				}
			}

			$order_text .= "</td>
			<td>" . $dp->row["quantity"] . "</td>
			<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $price,
				2 ) . " " . pvs_currency( 2, false ) . "</td>
			<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $dp->row["taxes"],
				2 ) . " " . pvs_currency( 2, false ) . "(" . $product_tax_name . ")</td>		
			<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( ( ( $price + $dp->row["taxes"] ) * $dp->row["quantity"] ), 2 ) . " " .
				pvs_currency( 2, false ) . "</td>
			</tr>";
			$dp->movenext();
		}
	}

	$order_text .= "<tr>
	<td style='text-align:right' colspan='4'><b>" . pvs_word_lang( "subtotal" ) .
		":</b></td>
	<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_subtotal,
		2 ) . " " . pvs_currency( 2, false ) . "</td>
	</tr>";

	if ( $product_type == "credits" or $product_type == "subscription" or ( ( ! $pvs_global_settings["credits"] or
		$pvs_global_settings["credits_currency"] ) and $product_type == "order" and ! $product_order_credits ) ) {
		$order_text .= "<tr>
		<td style='text-align:right' colspan='4'><b>" . pvs_word_lang( "discount" ) .
			":</b></td>
		<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_discount,
			2 ) . " " . pvs_currency( 2, false ) . "</td>
		</tr>";
	}

	if ( $product_type == "order" and ( ! $pvs_global_settings["credits"] or $pvs_global_settings["credits_currency"] ) and
		! $product_order_credits ) {
		$order_text .= "<tr>
		<td style='text-align:right' colspan='4'><b>" . pvs_word_lang( "shipping" ) .
			":</b></td>
		<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_shipping,
			2 ) . " " . pvs_currency( 2, false ) . "</td>
		</tr>";
	}

	if ( $product_type == "credits" or $product_type == "subscription" or ( ( ! $pvs_global_settings["credits"] or
		$pvs_global_settings["credits_currency"] ) and $product_type == "order" and ! $product_order_credits ) ) {
		$order_text .= "<tr>
		<td style='text-align:right' colspan='4'><b>" . pvs_word_lang( "taxes" ) .
			":</b></td>
		<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_tax,
			2 ) . " " . pvs_currency( 2, false ) . "</td>
		</tr>";
	}

	$order_text .= "<tr class='snd'>
	<td style='text-align:right' colspan='4'><b>" . pvs_word_lang( "total" ) .
		":</b></td>
	<td>" . $coefficient . pvs_currency( 1, false ) . pvs_price_format( $product_total,
		2 ) . " " . pvs_currency( 2, false ) . "</td>
	</tr>

	</tr>
	</table>";

	return $order_text;
}





/**
 * The function gets buyer's info for the order
 *
 * @param  int $buyer_id user ID.
 * @param  int $order_id order ID.
 * @param  string $order_type order, credits or subscription.
 * @return array
 */
function pvs_get_buyer_info( $buyer_id, $order_id, $order_type )
{
	global $db;
	global $buyer_info;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$user_info = get_userdata(( int )$buyer_id);

	$buyer_info["name"] = @$user_info -> first_name;
	$buyer_info["lastname"] = @$user_info -> last_name;
	$buyer_info["email"] = @$user_info -> user_email;
	$buyer_info["telephone"] = @$user_info -> telephone;
	$buyer_info["company"] = @$user_info -> company;
	$buyer_info["country"] = @$user_info -> country;
	$buyer_info["address"] = @ $user_info -> address;
	$buyer_info["city"] = @$user_info -> city;
	$buyer_info["state"] = @$user_info -> state;
	$buyer_info["zipcode"] = @$user_info -> zipcode;

	$buyer_info["billing_name"] = @$user_info -> first_name;
	$buyer_info["billing_lastname"] = @$user_info -> last_name;
	$buyer_info["billing_country"] = @$user_info -> country;
	$buyer_info["billing_address"] = @ $user_info -> address;
	$buyer_info["billing_city"] = @$user_info -> city;
	$buyer_info["billing_state"] = @$user_info -> state;
	$buyer_info["billing_zipcode"] = @$user_info -> zipcode;

	$buyer_info["shipping_name"] = @$user_info -> first_name;
	$buyer_info["shipping_lastname"] = @$user_info -> last_name;
	$buyer_info["shipping_country"] = @$user_info -> country;
	$buyer_info["shipping_address"] = @ $user_info -> address;
	$buyer_info["shipping_city"] = @$user_info -> city;
	$buyer_info["shipping_state"] = @$user_info -> state;
	$buyer_info["shipping_zipcode"] = @$user_info -> zipcode;

	if ( $order_type == "order" )
	{
		$sql = "select shipping_firstname,shipping_lastname,shipping_address,shipping_country,shipping_state,shipping_city,shipping_zip,billing_firstname,billing_lastname,billing_address,billing_country,billing_city,billing_state,billing_zip from " .
			PVS_DB_PREFIX . "orders where id=" . ( int )$order_id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$buyer_info["billing_name"] = $dp->row["billing_firstname"];
			$buyer_info["billing_lastname"] = $dp->row["billing_lastname"];
			$buyer_info["billing_country"] = $dp->row["billing_country"];
			$buyer_info["billing_address"] = $dp->row["billing_address"];
			$buyer_info["billing_city"] = $dp->row["billing_city"];
			$buyer_info["billing_state"] = $dp->row["billing_state"];
			$buyer_info["billing_zipcode"] = $dp->row["billing_zip"];

			$buyer_info["shipping_name"] = $dp->row["shipping_firstname"];
			$buyer_info["shipping_lastname"] = $dp->row["shipping_lastname"];
			$buyer_info["shipping_country"] = $dp->row["shipping_country"];
			$buyer_info["shipping_address"] = $dp->row["shipping_address"];
			$buyer_info["shipping_city"] = $dp->row["shipping_city"];
			$buyer_info["shipping_state"] = $dp->row["shipping_state"];
			$buyer_info["shipping_zipcode"] = $dp->row["shipping_zip"];
		}
	}

}





/**
 * The function gets order info
 *
 * @param  int $product_id order ID.
 * @param  string $product_type order, credits or subscription.
 * @return array
 */
function pvs_get_order_info( $product_id, $product_type )
{
	global $order_info;
	global $db;

	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$order_info["product_subtotal"] = 0;
	$order_info["product_shipping"] = 0;
	$order_info["product_discount"] = 0;
	$order_info["product_tax"] = 0;
	$order_info["product_total"] = 0;
	$order_info["product_name"] = 0;

	if ( $product_type == "credits" )
	{
		$sql = "select credits,title from " . PVS_DB_PREFIX .
			"credits_list where id_parent=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$sql = "select price from " . PVS_DB_PREFIX . "credits where id_parent=" . $dp->
				row["credits"];
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$order_info["product_total"] = $dt->row["price"];
				$order_info["product_subtotal"] = $order_info["product_total"];
			}
		}
	}

	if ( $product_type == "subscription" )
	{
		$sql = "select subscription,title from " . PVS_DB_PREFIX .
			"subscription_list where id_parent=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$sql = "select price from " . PVS_DB_PREFIX . "subscription where id_parent=" .
				$dp->row["subscription"];
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$order_info["product_total"] = $dt->row["price"];
				$order_info["product_subtotal"] = $order_info["product_total"];
			}
		}
	}

	if ( $product_type == "order" )
	{
		$sql = "select total,subtotal,discount,shipping,tax,id from " . PVS_DB_PREFIX .
			"orders where id=" . ( int )$product_id;
		$dp->open( $sql );
		if ( ! $dp->eof )
		{
			$order_info["product_total"] = $dp->row["total"];
			$order_info["product_subtotal"] = $dp->row["subtotal"];
			$order_info["product_shipping"] = $dp->row["shipping"];
			$order_info["product_tax"] = $dp->row["tax"];
			$order_info["product_discount"] = $dp->row["discount"];
		}
	}

}






/**
 * Create invoice
 *
 * @param  int $order_id order ID.
 * @param  string $order_type order, credits or subscription.
 */
function pvs_add_invoice( $order_id, $order_type )
{
	global $rs;
	global $db;
	global $pvs_global_settings;

	$sql = "select id from " . PVS_DB_PREFIX . "invoices where order_id=" . $order_id .
		" and order_type='" . $order_type . "'";
	$rs->open( $sql );
	if ( $rs->eof )
	{
		$invoice_number = $pvs_global_settings["invoice_number"] + 1;

		$sql = "insert into " . PVS_DB_PREFIX .
			"invoices (invoice_number,order_id,order_type,status,comments,refund) values (" .
			$invoice_number . "," . $order_id . ",'" . $order_type . "'," . $pvs_global_settings["invoice_publish"] .
			",'',0)";
		$db->execute( $sql );
		
		pvs_update_setting('invoice_number', $invoice_number );
	}
}






/**
 * Credits Functions
 *
 */




/**
 * Add credits to user balance
 *
 * @param int $credits_id Credits package ID.
 * @return int Credits order ID.
 */
function pvs_credits_add( $credits_id )
{
	global $db;
	global $_SESSION;
	global $taxes_info;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$sql = "select id_parent,title,quantity,price,priority,days from " .
		PVS_DB_PREFIX . "credits where id_parent=" . ( int )$credits_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$expiration_date = 0;
		if ( $dp->row["days"] > 0 )
		{
			$expiration_date = pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
				date( "d" ), date( "Y" ) ) + 3600 * 24 * $dp->row["days"];
		}

		$subtotal = $dp->row["price"];
		$discount = 0;
		if ( isset( $_SESSION["coupon_code"] ) )
		{
			$discount = pvs_order_discount_calculate( $_SESSION["coupon_code"], $subtotal );
			pvs_coupons_delete( $_SESSION["coupon_code"] );
		}

		$taxes = pvs_order_taxes_calculate( $dp->row["price"], true, "credits" );
		$total = $subtotal + $taxes - $discount;

		$user_info = get_userdata(get_current_user_id());
		
		$sql = "insert into " . PVS_DB_PREFIX .
			"credits_list (title,data,user,quantity,approved,payment,credits,expiration_date,subtotal,discount,taxes,total,billing_firstname,billing_lastname,billing_address,billing_city,billing_zip,billing_country,billing_state,taxes_id,billing_company,billing_vat,billing_business) values ('" .
			$dp->row["title"] . "'," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
			date( "m" ), date( "d" ), date( "Y" ) ) . ",'" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) .
			"','" . $dp->row["quantity"] . "',0,0," . ( int )$credits_id . "," . $expiration_date .
			"," . $subtotal . "," . $discount . "," . $taxes . "," . $total . ",'" .
			pvs_result( @$_SESSION["billing_firstname"] ) . "','" . pvs_result( @$_SESSION["billing_lastname"] ) .
			"','" . pvs_result( @$_SESSION["billing_address"] ) . "','" . pvs_result( @$_SESSION["billing_city"] ) .
			"','" . pvs_result( @$_SESSION["billing_zip"] ) . "','" . pvs_result( @$_SESSION["billing_country"] ) .
			"','" . pvs_result( @$_SESSION["billing_state"] ) . "'," . ( int )$taxes_info["id"] .
			",'" . pvs_result($user_info-> company) . "','" . pvs_result($user_info-> vat) . "'," . (int)$user_info-> business .
			")";
		$db->execute( $sql );

		unset( $_SESSION["coupon_code"] );
		unset( $_SESSION["billing_firstname"] );
		unset( $_SESSION["billing_lastname"] );
		unset( $_SESSION["billing_address"] );
		unset( $_SESSION["billing_city"] );
		unset( $_SESSION["billing_zip"] );
		unset( $_SESSION["billing_country"] );
		unset( $_SESSION["billing_state"] );

		$sql = "select id_parent from " . PVS_DB_PREFIX . "credits_list where user='" .
			pvs_result( pvs_user_id_to_login( get_current_user_id()) ) . "' order by data desc";
		$dt->open( $sql );
		$id = $dt->row["id_parent"];

		return $id;
	}
}





/**
 * Remove credits from user's balance
 *
 * @param  float $total order total paid by credits.
 * @param  int $order_id order ID paid by credits.
 */
function pvs_credits_delete( $total, $order_id )
{
	global $db;
	global $_SESSION;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$sql = "insert into " . PVS_DB_PREFIX .
		"credits_list (title,data,user,quantity,approved,payment,expiration_date) values ('Order #" .
		$order_id . "'," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
		date( "d" ), date( "Y" ) ) . ",'" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) .
		"','" . ( -1 * $total ) . "',1,0,0)";
	$db->execute( $sql );
}






/**
 * Approve credits order
 *
 * @param  int $pid credits order ID.
 * @param  int $tid payment ID.
 */
function pvs_credits_approve( $pid, $tid )
{
	global $db;

	$sql = "update " . PVS_DB_PREFIX . "credits_list set approved=1,payment=" . ( int )
		$tid . " where id_parent=" . ( int )$pid;
	$db->execute( $sql );

	//Affiliate commission
	pvs_affiliate_add_commission( $pid, "credits" );

	//Create invoice
	pvs_add_invoice( ( int )$pid, "credits" );
}






/**
 * Get user's credits balance
 *
 * @return float
 */
function pvs_credits_balance()
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$balance = 0;
	if ( is_user_logged_in() )
	{
		$expiration_date[] = 0;
		$sql = "select expiration_date from " . PVS_DB_PREFIX .
			"credits_list where user='" . pvs_result( pvs_user_id_to_login( get_current_user_id())) .
			"' and approved=1 and expiration_date<>0 order by expiration_date";
		$dp->open( $sql );
		while ( ! $dp->eof )
		{
			$expiration_date[] = $dp->row["expiration_date"];
			$dp->movenext();
		}
		$current_time = pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
			date( "d" ), date( "Y" ) );
		if ( $current_time > $expiration_date[count( $expiration_date ) - 1] )
		{
			$expiration_date[] = $current_time;
		}

		for ( $i = 0; $i < count( $expiration_date ) - 1; $i++ )
		{
			$sql = "select quantity,expiration_date from " . PVS_DB_PREFIX .
				"credits_list where user='" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) .
				"' and approved=1 and data>" . ( $expiration_date[$i] - 1 ) . " and data<" . ( $expiration_date[$i +
				1] + 1 ) . " order by data";
			$dp->open( $sql );
			while ( ! $dp->eof )
			{
				if ( $dp->row["expiration_date"] != 0 and $dp->row["expiration_date"] < $current_time )
				{

				} else
				{
					$balance += $dp->row["quantity"];
				}
				$dp->movenext();
			}
			if ( $balance < 0 )
			{
				$balance = 0;
			}
		}
	}
	return $balance;
}




/**
 * Subscription Functions
 *
 */




/**
 * Add subscription to user
 *
 * @param  int $subscription_id subscription plan ID.
 * @return int subscription order ID
 */
function pvs_subscription_add( $subscription_id )
{
	global $db;
	global $_SESSION;
	global $taxes_info;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$sql = "select * from " . PVS_DB_PREFIX . "subscription where id_parent=" . ( int )
		$subscription_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$subtotal = $dp->row["price"];
		$discount = 0;
		if ( isset( $_SESSION["coupon_code"] ) )
		{
			$discount = pvs_order_discount_calculate( $_SESSION["coupon_code"], $subtotal );
			pvs_coupons_delete( $_SESSION["coupon_code"] );
		}
		$taxes = pvs_order_taxes_calculate( $dp->row["price"], true, "subscription" );
		$total = $subtotal + $taxes - $discount;

		$user_info = get_userdata(get_current_user_id());
		
		$sql = "insert into " . PVS_DB_PREFIX .
			"subscription_list (title,data1,data2,user,approved,bandwidth,bandwidth_limit,subscription,subtotal,discount,taxes,total,billing_firstname,billing_lastname,billing_address,billing_city,billing_zip,billing_country,recurring,payments,bandwidth_daily,bandwidth_daily_limit,bandwidth_date,taxes_id,billing_company,billing_vat,billing_business) values ('" .
			$dp->row["title"] . "'," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
			date( "m" ), date( "d" ), date( "Y" ) ) . "," . ( pvs_get_time( date( "H" ),
			date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) + 3600 * 24 *
			$dp->row["days"] ) . ",'" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) . "',0,0," .
			$dp->row["bandwidth"] . "," . ( int )$subscription_id . "," . $subtotal . "," .
			$discount . "," . $taxes . "," . $total . ",'" . pvs_result( @$_SESSION["billing_firstname"] ) .
			"','" . pvs_result( @$_SESSION["billing_lastname"] ) . "','" . pvs_result( @$_SESSION["billing_address"] ) .
			"','" . pvs_result( @$_SESSION["billing_city"] ) . "','" . pvs_result( @$_SESSION["billing_zip"] ) .
			"','" . pvs_result( @$_SESSION["billing_country"] ) . "'," . $dp->row["recurring"] .
			",0,0," . $dp->row["bandwidth_daily"] . ",0," . ( int )$taxes_info["id"] . ",'" .
			pvs_result($user_info-> company) . "','" . pvs_result($user_info-> vat) . "'," . (int)$user_info-> business .
			")";
		$db->execute( $sql );

		unset( $_SESSION["coupon_code"] );
		unset( $_SESSION["billing_firstname"] );
		unset( $_SESSION["billing_lastname"] );
		unset( $_SESSION["billing_address"] );
		unset( $_SESSION["billing_city"] );
		unset( $_SESSION["billing_zip"] );
		unset( $_SESSION["billing_country"] );

		$sql = "select id_parent from " . PVS_DB_PREFIX .
			"subscription_list where user='" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) .
			"' order by data1 desc";
		$dt->open( $sql );
		$id = $dt->row["id_parent"];

		return $id;
	}
}





/**
 * Approve subscription
 *
 * @param  int $pid subscription order ID.
 */
function pvs_subscription_approve( $pid )
{
	global $db;

	$sql = "update " . PVS_DB_PREFIX .
		"subscription_list set approved=1,payments=1 where id_parent=" . ( int )$pid;
	$db->execute( $sql );

	//Affiliate commission
	pvs_affiliate_add_commission( $pid, "subscription" );

	//Create invoice
	pvs_add_invoice( ( int )$pid, "subscription" );
}





/**
 * Check if a user has a subscription
 *
 * @param  string $login user login.
 * @param  int $id_parent media ID.
 * @return bool
 */
function pvs_user_subscription( $login, $id_parent )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$flag = false;

	$content_type = "";

	$sql = "select content_type from " . PVS_DB_PREFIX . "media where id=" .
		$id_parent;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$content_type = $dp->row["content_type"];
	}


	$sql = "select id_parent,subscription,bandwidth_daily,bandwidth_daily_limit ,bandwidth_date from " .
		PVS_DB_PREFIX . "subscription_list where user='" . $login . "' and (data2>" .
		pvs_get_time() . " or data1=data2) and bandwidth<bandwidth_limit and approved=1 order by data2 desc";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "select id_parent from " . PVS_DB_PREFIX .
			"subscription where id_parent=" . $dp->row["subscription"] .
			" and content_type like '%" . $content_type . "%'";
		$dt->open( $sql );
		if ( ! $dt->eof )
		{
			if ( $dp->row["bandwidth_daily_limit"] == 0 )
			{
				$flag = true;
			} else
			{
				if ( date( "j" ) == $dp->row["bandwidth_date"] )
				{
					if ( $dp->row["bandwidth_daily"] <= $dp->row["bandwidth_daily_limit"] )
					{
						$flag = true;
					}
				} else
				{
					$sql = "update " . PVS_DB_PREFIX .
						"subscription_list set bandwidth_daily=0,bandwidth_date=" . date( "j" ) .
						" where id_parent=" . $dp->row["id_parent"];
					$db->execute( $sql );
					$flag = true;
				}
			}
		}
	}
	return $flag;
}






/**
 * Check subscription limits
 *
 * @param  string $login user login.
 * @param  int $param '0' - return user's current bandwidth, '1' - return user's max limit.
 * @return int
 */
function pvs_bandwidth_user( $login, $param )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$bn = 0;
	$bn2 = 0;

	$sql = "select bandwidth,bandwidth_limit from " . PVS_DB_PREFIX .
		"subscription_list where user='" . $login . "' and (data2>" . pvs_get_time() .
		" or data1=data2) and bandwidth<bandwidth_limit and approved=1";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$bn = $dp->row["bandwidth"];
		$bn2 = $dp->row["bandwidth_limit"];
	}

	if ( $param == 0 )
	{
		return $bn;
	} else
	{
		return $bn2;
	}
}





/**
 * Increase limits after the download
 *
 * @param  string $login user login.
 * @param  int $fsize add filesize, downloads or credits to user's bandwidth.
 */
function pvs_bandwidth_add( $login, $fsize )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$sql = "select id_parent,bandwidth_daily_limit from " . PVS_DB_PREFIX .
		"subscription_list where user='" . $login . "' and (data2>" . pvs_get_time() .
		" or data1=data2) and bandwidth<bandwidth_limit and approved=1";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "update " . PVS_DB_PREFIX . "subscription_list set bandwidth=bandwidth+" .
			$fsize . " where id_parent=" . $dp->row["id_parent"];
		$db->execute( $sql );

		if ( $dp->row["bandwidth_daily_limit"] != 0 )
		{
			$sql = "update " . PVS_DB_PREFIX .
				"subscription_list set bandwidth_daily=bandwidth_daily+" . $fsize .
				" where id_parent=" . $dp->row["id_parent"];
			$db->execute( $sql );
		}
	}
}



/**
 * Commission Functions
 *
 */
 
 



/**
 * Get user's commission's balance
 *
 * @return float
 */
function pvs_user_balance()
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$userbalance = 0;

	$sql = "select user,total from " . PVS_DB_PREFIX . "commission where user=" . get_current_user_id() . " and status=1";
	$dp->open( $sql );
	while ( ! $dp->eof )
	{
		$userbalance += $dp->row["total"];
		$dp->movenext();
	}
	return $userbalance;
}






/**
 * Add commission for order
 *
 * @param  int $order_id order ID.
 */
function pvs_commission_add( $order_id )
{
	global $db;
	global $_SESSION;
	
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dm = new TMySQLQuery;
	$dm->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$user_order = "";
	$sql = "select user from " . PVS_DB_PREFIX . "orders where id=" . ( int )$order_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$user_order = pvs_user_id_to_login($dp->row["user"]);
	}

	$sql = "select a.id,a.status,a.data,b.id,b.id_parent,b.price,b.item,b.quantity,b.prints,b.printslab,b.option1_id,b.option1_value,b.option2_id,b.option2_value,b.option3_id,b.option3_value,b.option4_id,b.option4_value,b.option5_id,b.option5_value,b.option6_id,b.option6_value,b.option7_id,b.option7_value,b.option8_id,b.option8_value,b.option9_id,b.option9_value,b.option10_id,b.option10_value,b.package from " .
		PVS_DB_PREFIX . "orders a," . PVS_DB_PREFIX .
		"orders_content b where a.id=b.id_parent and a.id=" . $order_id .
		" order by a.data desc";
	$dp->open( $sql );
	while ( ! $dp->eof )
	{
		$flag = false;
		if ( (int)$dp->row["package"] == 0 )
		{
			if ( $dp->row["printslab"] != 1 )
			{
				$idp = 0;
				$userid = 0;
				$userlogin = "";
				$url = "";
				$title = "";
				$types = "";
	
				$sql = "select id,id_parent from " . PVS_DB_PREFIX . "items where id=" . $dp->
					row["item"];
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$idp = $dt->row["id_parent"];
				}
	
				$sql = "select id,userid,title,author,media_id from " . PVS_DB_PREFIX .
					"media where id=" . $idp;
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$userid = $dt->row["userid"];
					$userlogin = $dt->row["author"];
					$flag = true;
					if ( pvs_media_type ($dt->row["media_id"]) == 'photo' )
					{
						$types = "photos";
					}
					if ( pvs_media_type ($dt->row["media_id"]) == 'video' )
					{
						$types = "videos";
					}
					if ( pvs_media_type ($dt->row["media_id"]) == 'audio' )
					{
						$types = "audio";
					}
					if ( pvs_media_type ($dt->row["media_id"]) == 'vector' )
					{
						$types = "vector";
					}
				}
	
				if ( $dp->row["prints"] == 1 )
				{
					$sql = "select id_parent,itemid from " . PVS_DB_PREFIX .
						"prints_items where id_parent=" . $dp->row["item"];
					$dt->open( $sql );
					if ( ! $dt->eof )
					{
						$sql = "select id,userid,title,author from " . PVS_DB_PREFIX .
							"media where id=" . $dt->row["itemid"];
						$dm->open( $sql );
						if ( ! $dm->eof )
						{
							$userid = $dm->row["userid"];
							$userlogin = $dm->row["author"];
						}
	
						$flag = true;
						$types = "prints_items";
						$idp = $dp->row["item"];
					}
				}
			} else
			{
				if ( $dp->row["prints"] == 1 )
				{
					$sql = "select id_parent from " . PVS_DB_PREFIX . "galleries_photos where id=" .
						$dp->row["item"];
					$dt->open( $sql );
					if ( ! $dt->eof )
					{
						$sql = "select user_id from " . PVS_DB_PREFIX . "galleries where id_parent=" . $dt->
							row["id_parent"];
						$dm->open( $sql );
						if ( ! $dm->eof )
						{
							$userid = $dm->row["user_id"];
							$userlogin = pvs_user_id_to_login( $dm->row["user_id"] );
						}
	
						$flag = true;
						$types = "prints_items";
						$idp = $dp->row["item"];
					}
				}
			}
		} else {
			$package_files = array();
			$sql = "select file_id,print_id from " . PVS_DB_PREFIX . "packages_list where order_content_id=" . $dp->row["id"] . " and package_id=" . $dp->row["package"];
			$dt->open( $sql );
			while ( ! $dt->eof )
			{
				if ( $dt->row["file_id"] != 0) {
					$package_files[ $dt->row["file_id"] . '-' . $dt->row["print_id"] ] = 0;
					$flag = true;
				}
				$dt->movenext();	
			}
		}

		if ( $flag == true )
		{
			if ( (int)$dp->row["package"] == 0 )
			{
				$category = "";
				
				if ( $userid == 0 ) {
					$user_info = get_userdata(pvs_user_login_to_id( $userlogin ));
					$userid = $user_info -> ID;
				} else {
					$user_info = get_userdata($userid);
				}
				$category = $user_info->category;
				
				if ($category == '') {
					$category = $pvs_global_settings["userstatus"];
				}
	
				$percentage = 0;
				$percentage_prints = 0;
				$percentage_type = 0;
				$percentage_prints_type = 0;
	
				$sql = "select name,percentage,percentage_prints,percentage_type,percentage_prints_type from " .
					PVS_DB_PREFIX . "user_category where name='" . $category . "'";
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$percentage = $dt->row["percentage"];
					$percentage_prints = $dt->row["percentage_prints"];
					$percentage_type = $dt->row["percentage_type"];
					$percentage_prints_type = $dt->row["percentage_prints_type"];
				}				
				
				if ( $user_order != $userlogin ) {
					if ( $dp->row["printslab"] != 1 )
					{
						$price_total = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
							$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
							row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
							$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
							row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
							row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
							$dp->row["option10_id"], $dp->row["option10_value"] );
		
						if ( $types != "prints_items" )
						{
							if ( $percentage_type == 0 )
							{
								$commission_total = $dp->row["quantity"] * $percentage * $price_total / 100;
							} else
							{
								$commission_total = $percentage;
							}
		
							$sql = "insert into " . PVS_DB_PREFIX .
								"commission (total,user,orderid,item,publication,types,data,description,status) values (" .
								pvs_price_format( $commission_total, 2 ) . "," . $userid . "," . $dp->row["id_parent"] .
								"," . $dp->row["id"] . "," . $idp . ",'" . $types . "'," . $dp->row["data"] .
								",'order',1)";
							$db->execute( $sql );
		
							pvs_send_notification( "commission_to_seller", $userid, "O" . $dp->row["id_parent"],
								$idp, pvs_price_format( $commission_total, 2 ) );
						} else
						{
							if ( $percentage_prints_type == 0 )
							{
								$commission_total = $dp->row["quantity"] * $percentage_prints * $price_total /
									100;
							} else
							{
								$commission_total = $percentage_prints;
							}
		
							$sql = "insert into " . PVS_DB_PREFIX .
								"commission (total,user,orderid,item,publication,types,data,description,status) values (" .
								pvs_price_format( $commission_total, 2 ) . "," . $userid . "," . $dp->row["id_parent"] .
								"," . $dp->row["id"] . "," . $idp . ",'" . $types . "'," . $dp->row["data"] .
								",'order',1)";
							$db->execute( $sql );
		
							pvs_send_notification( "commission_to_seller", $userid, "O" . $dp->row["id_parent"],
								$idp, pvs_price_format( $commission_total, 2 ) );
						}
					}
				}
			} else {
				//Commission for package
				if ( count( $package_files ) > 0 ) {
					$package_price = 0;
					
					$sql = "select price from " . PVS_DB_PREFIX . "packages where id=" . $dp->row["package"];
					$dt->open( $sql );
					if ( ! $dt->eof ) {
						$package_price = $dt->row["price"];
					}
			
					$package_price = $package_price / count( $package_files );
		
					if ($package_price > 0) {
						foreach ( $package_files as $key => $value ) {
							$pack = explode("-", $key);
							$file_id = (int)$pack[0];
							$print_id = (int)$pack[1];
							
							$sql = "select id_parent from " . PVS_DB_PREFIX . "prints_items where itemid=" . $file_id . " and printsid = " . $print_id;
							$dt->open( $sql );
							if ( ! $dt->eof )
							{
								$print_id = $dt->row["id_parent"];
							}
						
							$sql = "select id,userid,title,author,media_id from " . PVS_DB_PREFIX . "media where id=" . $file_id;
							$dt->open( $sql );
							if ( ! $dt->eof )
							{
								$userid = $dt->row["userid"];
								$userlogin = $dt->row["author"];
								
								if ( pvs_media_type ($dt->row["media_id"]) == 'photo' )
								{
									$types = "photos";
								}
								if ( pvs_media_type ($dt->row["media_id"]) == 'video' )
								{
									$types = "videos";
								}
								if ( pvs_media_type ($dt->row["media_id"]) == 'audio' )
								{
									$types = "audio";
								}
								if ( pvs_media_type ($dt->row["media_id"]) == 'vector' )
								{
									$types = "vector";
								}
							}
							
							$category = "";
					
							if ( $userid == 0 ) {
								$user_info = get_userdata(pvs_user_login_to_id( $userlogin ));
								$userid = $user_info -> ID;
							} else {
								$user_info = get_userdata($userid);
							}
							$category = $user_info->category;
							
							if ($category == '') {
								$category = $pvs_global_settings["userstatus"];
							}
				
							$percentage = 0;
							$percentage_prints = 0;
							$percentage_type = 0;
							$percentage_prints_type = 0;
				
							$sql = "select name,percentage,percentage_prints,percentage_type,percentage_prints_type from " .
								PVS_DB_PREFIX . "user_category where name='" . $category . "'";
							$dt->open( $sql );
							if ( ! $dt->eof )
							{
								$percentage = $dt->row["percentage"];
								$percentage_prints = $dt->row["percentage_prints"];
								$percentage_type = $dt->row["percentage_type"];
								$percentage_prints_type = $dt->row["percentage_prints_type"];
							}
							
							if ( $user_order != $userlogin ) {
								if ( $print_id != 0 ) {							
									//Print
									if ( $percentage_prints_type == 0 ) {
										$commission_total = $dp->row["quantity"] * $percentage_prints * $package_price / 100;
									} else {
										$commission_total = $percentage_prints;
									}
									
									$sql = "insert into " . PVS_DB_PREFIX .
										"commission (total,user,orderid,item,publication,types,data,description,status) values (" .
										pvs_price_format( $commission_total, 2 ) . "," . $userid . "," . $dp->row["id_parent"] .
										"," . $dp->row["id"] . "," . $print_id . ",'prints_items'," . $dp->row["data"] .
										",'order',1)";
									$db->execute( $sql );
				
									pvs_send_notification( "commission_to_seller", $userid, "O" . $dp->row["id_parent"], $print_id, pvs_price_format( $commission_total, 2 ) );								
								} else {
									//File
									if ( $percentage_type == 0 ) {
										$commission_total = $dp->row["quantity"] * $percentage * $package_price / 100;
									} else {
										$commission_total = $percentage;
									}
									
									$sql = "insert into " . PVS_DB_PREFIX .
										"commission (total,user,orderid,item,publication,types,data,description,status) values (" .
										pvs_price_format( $commission_total, 2 ) . "," . $userid . "," . $dp->row["id_parent"] .
										"," . $dp->row["id"] . "," . $file_id . ",'" . $types . "'," . $dp->row["data"] .
										",'order',1)";
									$db->execute( $sql );
		
									pvs_send_notification( "commission_to_seller", $userid, "O" . $dp->row["id_parent"], $file_id, pvs_price_format( $commission_total, 2 ) );
								}
							}
						}
					}
				}
			}

			//Affiliate commission
			if ( $pvs_global_settings["affiliates"] )
			{
				$user_info = get_userdata($userid);
				if ( ( int )$user_info->aff_referal > 0 )
				{
					$user_info2 = get_userdata($user_info->aff_referal);

					$price_total = pvs_define_prints_price( $dp->row["price"], $dp->row["option1_id"],
						$dp->row["option1_value"], $dp->row["option2_id"], $dp->row["option2_value"], $dp->
						row["option3_id"], $dp->row["option3_value"], $dp->row["option4_id"], $dp->row["option4_value"],
						$dp->row["option5_id"], $dp->row["option5_value"], $dp->row["option6_id"], $dp->
						row["option6_value"], $dp->row["option7_id"], $dp->row["option7_value"], $dp->
						row["option8_id"], $dp->row["option8_value"], $dp->row["option9_id"], $dp->row["option9_value"],
						$dp->row["option10_id"], $dp->row["option10_value"] );

					$total = $price_total * $user_info2 -> aff_commission_seller / 100;
					$sql = "insert into " . PVS_DB_PREFIX .
						"affiliates_signups (userid,types,types_id,rates,total,data,aff_referal,status) values (" .
						$userid . ",'orders'," . $dp->row["id_parent"] . "," . $user_info2 -> aff_commission_seller .
						"," . $total . "," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
						date( "d" ), date( "Y" ) ) . "," . $user_info->aff_referal . ",1)";
					$db->execute( $sql );

					pvs_send_notification( "commission_to_affiliate", $userid, "O" . $dp->row["id_parent"],
						"", $total );
				}
			}
			//End. Affiliate commission
		}
		$dp->movenext();
	}
}





/**
 * Add commission for subscription
 *
 * @param  string $user_login user login.
 * @param  int $publication_id publication ID.
 * @param  int $item_id price/size ID.
 */
function pvs_commission_subscription_add( $user_login, $publication_id, $item_id )
{
	global $_SESSION;
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$price = 0;
	$userid = 0;
	$subscription_id = 0;

	$sql = "select price from " . PVS_DB_PREFIX . "items where id=" . ( int )$item_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$price = round( $dp->row["price"] );
	}

	$sql = "select id_parent from " . PVS_DB_PREFIX .
		"subscription_list where user='" . pvs_result( $user_login ) . "' and data2>" .
		pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
		date( "Y" ) ) . " and bandwidth<bandwidth_limit and approved=1 order by data2 desc";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$subscription_id = $dp->row["id_parent"];
	}

	$sql = "select userid,author,media_id from " . PVS_DB_PREFIX . "media where id=" . ( int )
		$publication_id;
	$dt->open( $sql );
	if ( ! $dt->eof )
	{
		$userid = $dt->row["userid"];
		$userlogin = $dt->row["author"];
		if ( pvs_media_type ($dt->row["media_id"]) == 'photo' )
		{
			$types = "photos";
		}
		if ( pvs_media_type ($dt->row["media_id"]) == 'video' )
		{
			$types = "videos";
		}
		if ( pvs_media_type ($dt->row["media_id"]) == 'audio' )
		{
			$types = "audio";
		}
		if ( pvs_media_type ($dt->row["media_id"]) == 'vector' )
		{
			$types = "vector";
		}
	}

	if ( $price > 0 and $subscription_id > 0 and $userlogin != pvs_user_id_to_login( get_current_user_id()) )
	{

		$category = "";
		
		if ( $userid == 0 ) {
			$user_info = get_userdata(pvs_user_login_to_id( $userlogin ));
			$userid = $user_info -> ID;
		} else {
			$user_info = get_userdata($userid);
		}
		$category = $user_info->category;
		
		if ($category == '') {
			$category = $pvs_global_settings["userstatus"];
		}

		$percentage_subscription = 0;
		$percentage_subscription_type = 0;
		$sql = "select name,percentage_subscription,percentage_subscription_type from " .
			PVS_DB_PREFIX . "user_category where name='" . $category . "'";
		$dt->open( $sql );
		if ( ! $dt->eof )
		{
			$percentage_subscription = $dt->row["percentage_subscription"];
			$percentage_subscription_type = $dt->row["percentage_subscription_type"];
		}

		if ( $percentage_subscription_type == 0 )
		{
			$commission_total = $percentage_subscription * $price / 100;
		} else
		{
			$commission_total = $percentage_subscription;
		}

		$sql = "insert into " . PVS_DB_PREFIX .
			"commission (total,user,orderid,item,publication,types,data,description,status) values (" .
			pvs_price_format( $commission_total, 2 ) . "," . $userid . "," . $subscription_id .
			"," . ( int )$item_id . "," . ( int )$publication_id . ",'" . $types . "'," .
			pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
			date( "Y" ) ) . ",'subscription',1)";
		$db->execute( $sql );

		pvs_send_notification( "commission_to_seller", $userid, "S" . $subscription_id,
			$publication_id, pvs_price_format( $commission_total, 2 ) );

		//Affiliate commission
		if ( $pvs_global_settings["affiliates"] )
		{
			$user_info = get_userdata($userid);
				
			if ( ( int )$user_info->aff_referal > 0 )
			{
				$total = $price * $user_info2 -> aff_commission_seller / 100;
				$sql = "insert into " . PVS_DB_PREFIX .
					"affiliates_signups (userid,types,types_id,rates,total,data,aff_referal,status) values (" .
					$userid . ",'subscription'," . $subscription_id . "," . $user_info2 -> aff_commission_seller .
					"," . $total . "," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
					date( "d" ), date( "Y" ) ) . "," . $user_info->aff_referal . ",1)";
				$db->execute( $sql );

				pvs_send_notification( "commission_to_affiliate", $userid, "S" . $subscription_id,
					"", $total );

			}
		}
		//End. Affiliate commission
	}
}






/**
 * The function approves a payout
 *
 * @param  int $id commission ID.
 * @param  string $type 'payout_seller' or 'payout_affiliate'.
 */
function pvs_payout_approve( $id, $type )
{
	global $db;
	if ( $type == "payout_seller" )
	{
		$sql = "update " . PVS_DB_PREFIX . "commission set status=1 where id=" . ( int )
			$id;
	}
	if ( $type == "payout_affiliate" )
	{
		$payout_mass = explode( "-", $id );
		$sql = "update " . PVS_DB_PREFIX . "affiliates_signups set status=1 where data=" . ( int )
			$payout_mass[1] . " and affiliates_signups=" . ( int )$payout_mass[2];
	}
	$db->execute( $sql );
}




/**
 * Affiliate Functions
 *
 */





/**
 * The function adds a new affiliate into the stats
 *
 * @param  int $aff_referal affiliate ID.
 * @param  int $userid user ID.
 * @param  string $type buyer, seller or common.
 */
function pvs_affiliate_add( $aff_referal, $userid, $type )
{
	global $db;
	$buyer = 0;
	$seller = 0;
	if ( $type == "seller" )
	{
		$seller = 1;
	}
	if ( $type == "buyer" )
	{
		$buyer = 1;
	}
	if ( $type == "common" )
	{
		$buyer = 1;
		$seller = 1;
	}
	if ( $type == "seller" or $type == "buyer" or $type == "common" )
	{
		$sql = "insert into " . PVS_DB_PREFIX .
			"affiliates_stats (userid,seller,buyer,data,ip,aff_referal) values (" . ( int )
			$userid . "," . $seller . "," . $buyer . "," . pvs_get_time( date( "H" ), date( "i" ),
			date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) . ",'" . pvs_result( $_SERVER["REMOTE_ADDR"] ) .
			"'," . ( int )$aff_referal . ")";
		$db->execute( $sql );
	}

}





/**
 * The function adds a new affiliates commission
 *
 * @param  int $id order ID.
 * @param  string $type subscription, credits or orders.
 */
function pvs_affiliate_add_commission( $id, $type )
{
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	if ( $pvs_global_settings["affiliates"] )
	{
		if ( $type == "subscription" )
		{
			$sql = "select user,subscription from " . PVS_DB_PREFIX .
				"subscription_list where id_parent=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$total = 0;
				$sql = "select price from " . PVS_DB_PREFIX . "subscription where id_parent=" .
					$dp->row["subscription"];
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$total = $dt->row["price"];
				}
								
				$user_info = get_userdata(pvs_user_login_to_id($dp->row["user"]));
				
				if ( ( int )$user_info->aff_referal > 0 )
				{
					$user_info2 = get_userdata($user_info->aff_referal);

					$total = $total * $user_info2->aff_commission_buyer / 100;
					$sql = "insert into " . PVS_DB_PREFIX .
						"affiliates_signups (userid,types,types_id,rates,total,data,aff_referal,status) values (" .
						$user_info->ID . ",'" . $type . "'," . $id . "," . $user_info2-> aff_commission_buyer .
						"," . $total . "," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
						date( "d" ), date( "Y" ) ) . "," . $user_info->aff_referal . ",1)";
					$db->execute( $sql );
					pvs_send_notification( "commission_to_affiliate", $user_info->ID, "S" . $id,
						"", $total );
				}
			}
		}

		if ( $type == "credits" )
		{
			$sql = "select user,credits from " . PVS_DB_PREFIX .
				"credits_list where id_parent=" . ( int )$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$total = 0;
				$sql = "select price from " . PVS_DB_PREFIX . "credits where id_parent=" . $dp->
					row["credits"];
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$total = $dt->row["price"];
				}
				
												
				$user_info = get_userdata(pvs_user_login_to_id($dp->row["user"]));
				
				if ( ( int )$user_info->aff_referal > 0 )
				{
					$user_info2 = get_userdata($user_info->aff_referal);

					$total = $total * $user_info2->aff_commission_buyer / 100;
					$sql = "insert into " . PVS_DB_PREFIX .
						"affiliates_signups (userid,types,types_id,rates,total,data,aff_referal,status) values (" .
						$user_info->ID . ",'" . $type . "'," . $id . "," . $user_info2-> aff_commission_buyer .
						"," . $total . "," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
						date( "d" ), date( "Y" ) ) . "," . $user_info->aff_referal . ",1)";
					$db->execute( $sql );
					pvs_send_notification( "commission_to_affiliate", $user_info->ID, "C" . $id,
						"", $total );
				}
			}
		}

		if ( $type == "orders")
		{
			$sql = "select user,total from " . PVS_DB_PREFIX . "orders where credits=0 and id=" . ( int )
				$id;
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$total = $dp->row["total"];
				
				$user_info = get_userdata($dp->row["user"]);
				
				if ( ( int )$user_info->aff_referal > 0 )
				{
					$user_info2 = get_userdata($user_info->aff_referal);

					$total = $total * $user_info2->aff_commission_buyer / 100;
					$sql = "insert into " . PVS_DB_PREFIX .
						"affiliates_signups (userid,types,types_id,rates,total,data,aff_referal,status) values (" .
						$user_info->ID . ",'" . $type . "'," . $id . "," . $user_info2-> aff_commission_buyer .
						"," . $total . "," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
						date( "d" ), date( "Y" ) ) . "," . $user_info->aff_referal . ",1)";
					$db->execute( $sql );
					pvs_send_notification( "commission_to_affiliate", $user_info->ID, "O" . $id,
						"", $total );
				}
			}
		}

	}
}






/**
 * The function deletes the affiliates commission
 *
 * @param  int $id order ID.
 * @param  string $type subscription, credits or orders.
 */
function pvs_affiliate_delete_commission( $id, $type )
{
	global $db;
	$sql = "delete from " . PVS_DB_PREFIX . "affiliates_signups where types_id=" . ( int )
		$id . " and types='" . pvs_result( $type ) . "'";
	$db->execute( $sql );
}




/**
 * Coupons Functions
 *
 */






/**
 * Add coupons
 *
 * @param  string $user user login.
 * @param  string $type New Order or New signup.
 */
function pvs_coupons_add( $user, $type = "New Order" )
{
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$coupon_code = md5( pvs_create_password() . pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) );

	$sql = "select id_parent,title,days,total,percentage,url,events,ulimit,bonus from " .
		PVS_DB_PREFIX . "coupons_types where events='" . pvs_result( $type ) . "'";
	$dp->open( $sql );
	while ( ! $dp->eof )
	{
		$sql = "select id_parent from " . PVS_DB_PREFIX . "coupons where user='" .
			pvs_result( $user ) . "' and used=0 and coupon_id=" . $dp->row["id_parent"];
		$dt->open( $sql );
		if ( $dt->eof )
		{
			$used = 0;
			if ( $dp->row["bonus"] != 0 and $pvs_global_settings["credits"] )
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"credits_list (title,data,user,quantity,approved,payment,expiration_date) values ('" .
					$dp->row["title"] . "'," . pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
					date( "m" ), date( "d" ), date( "Y" ) ) . ",'" . pvs_result( $user ) . "','" . $dp->
					row["bonus"] . "',1,0,0)";
				$db->execute( $sql );

				$used = 1;
			}

			if ( $used == 0 )
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"coupons (title,user,data2,total,percentage,url,used,data,ulimit,tlimit,coupon_code,coupon_id) values ('" .
					$dp->row["title"] . "','" . pvs_result( $user ) . "'," . pvs_get_time( date( "H" ),
					date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) . "," . $dp->
					row["total"] . "," . $dp->row["percentage"] . ",'" . $dp->row["url"] . "'," . $used .
					"," . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
					date( "Y" ) ) + $dp->row["days"] * 3600 * 24 ) . "," . $dp->row["ulimit"] .
					",0,'" . $coupon_code . "'," . $dp->row["id_parent"] . ")";
				$db->execute( $sql );
			}
		}

		$dp->movenext();
	}
}






/**
 * The function calculates an order's tax
 *
 * @param  string $coupon code.
 * @param  float $total order total.
 * @return array
 */
function pvs_order_discount_calculate( $coupon, $total, $flag_tax = false )
{
	global $discount_info;
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$sql = "select total,percentage from " . PVS_DB_PREFIX .
		"coupons where coupon_code='" . pvs_result( $coupon ) .
		"' and (total<>0 or percentage<>0) and used=0 and data>" . pvs_get_time( date( "H" ),
		date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) );
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		if ( $dp->row["total"] != 0 and !$flag_tax )
		{
			$discount_info["total"] = pvs_price_format( $dp->row["total"], 2 );
			$discount_info["text"] = "";
		}
		if ( $dp->row["percentage"] != 0 )
		{
			$discount_info["total"] = pvs_price_format( $total * $dp->row["percentage"] /
				100, 2 );
			$discount_info["text"] = " (" . $dp->row["percentage"] . "%)";
		}
	}
	return $discount_info["total"];
}






/**
 * The function removes a used coupon
 *
 * @param  string $coupon_code coupon code.
 */
function pvs_coupons_delete( $coupon_code )
{
	global $discount_info;
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$sql = "select used,tlimit,ulimit from " . PVS_DB_PREFIX .
		"coupons where coupon_code='" . pvs_result( $coupon_code ) . "'";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$used = 0;
		if ( $dp->row["tlimit"] + 1 == $dp->row["ulimit"] )
		{
			$used = 1;
		}
		$sql = "update " . PVS_DB_PREFIX . "coupons set used=" . $used .
			",tlimit=tlimit+1  where coupon_code='" . pvs_result( $coupon_code ) . "'";
		$db->execute( $sql );
	}

}





/**
 * Cart Functions
 *
 */





/**
 * The function gets a shopping cart ID
 *
 * @param  bool $flag_add add to cart or not.
 * @return int $cart_id cart id
 */
function pvs_shopping_cart_id( $flag_add = false )
{
	global $pvs_global_settings;
	global $db;
	global $rs;
	global $ds;
	global $_COOKIE;
	global $_SERVER;
	
	$cart_id = 0;

	if (@$_COOKIE["PHPSESSID"] != '') {
		$session_id = pvs_result(@$_COOKIE["PHPSESSID"]);
	} else {
		$session_id = md5($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"]);
	}

	//Remove old carts
	if ($flag_add) {
		$sql = "select id from " . PVS_DB_PREFIX . "carts where data<" . ( pvs_get_time() - 2 * 3600 ) . " and checked<>1";
		$rs->open( $sql );
		while ( ! $rs->eof )
		{
			$sql = "select id_parent from " . PVS_DB_PREFIX .
				"carts_content where id_parent=" . $rs->row["id"];
			$ds->open( $sql );
			if ( $ds->eof )
			{
				$sql = "delete from " . PVS_DB_PREFIX . "carts where id=" . $rs->row["id"];
				$db->execute( $sql );
			} else
			{
				$sql = "update " . PVS_DB_PREFIX . "carts set checked=1 where id=" . $rs->row["id"];
				$db->execute( $sql );
			}
	
			$rs->movenext();
		}
	}

	if ( is_user_logged_in() )
	{
		$sql = "select id from " . PVS_DB_PREFIX . "carts where (user_id=" . get_current_user_id() .
			" or session_id='" . $session_id . "') and order_id=0 order by id desc";
		$rs->open( $sql );
		if ( ! $rs->eof )
		{
			$cart_id = $rs->row["id"];

			$sql = "update " . PVS_DB_PREFIX . "carts set user_id=" . get_current_user_id() .
				" where id=" . $rs->row["id"];
			$db->execute( $sql );
		} else
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"carts (session_id,data,user_id,order_id,ip) values ('" . $session_id . "'," .
				pvs_get_time() . "," . get_current_user_id() . ",0,'" . pvs_result( $_SERVER["REMOTE_ADDR"] ) .
				"')";
			$db->execute( $sql );

			$sql = "select id from " . PVS_DB_PREFIX . "carts where user_id=" . get_current_user_id() .
				" and session_id='" . $session_id . "' and order_id=0 order by id desc";
			$ds->open( $sql );
			if ( ! $ds->eof )
			{
				$cart_id = $ds->row["id"];
			}
		}
	} else
	{
		$sql = "select id from " . PVS_DB_PREFIX . "carts where session_id='" .
			$session_id . "' and order_id=0 order by id desc";
		$rs->open( $sql );
		if ( ! $rs->eof )
		{
			$cart_id = $rs->row["id"];
		} else
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"carts (session_id,data,user_id,order_id,ip) values ('" . $session_id . "'," .
				pvs_get_time() . ",0,0,'" . pvs_result( $_SERVER["REMOTE_ADDR"] ) . "')";
			$db->execute( $sql );

			$sql = "select id from " . PVS_DB_PREFIX . "carts where session_id='" .
				$session_id . "' and order_id=0 order by id desc";
			$ds->open( $sql );
			if ( ! $ds->eof )
			{
				$cart_id = $ds->row["id"];
			}
		}
	}
	return $cart_id;
}






/**
 * The function adds an item to the shopping cart
 *
 * @param  array $params.
 * @return int $cart_id cart id
 */
function pvs_shopping_cart_add( $params ) {
	global $_SESSION;
	global $pvs_global_settings;
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	if ( ! isset( $params["printslab"] ) ) {
		$params["printslab"] = 0;
	}

	$cart_id = pvs_shopping_cart_id( true );

	if ( $cart_id != 0 ) {
		if ( (int)@$params["package"] == 0 ) {
			if ( (int)@$params["collection"] == 0 ) {
				if ( isset( $params["rights_managed"] ) ) {
					//Rights managed
					$rights_managed = "";
		
					if ( isset( $_SESSION["rights_managed_price" . $params["publication_id"]] ) )
					{
						foreach ( $_SESSION["rights_managed" . $params["publication_id"]] as $key => $value )
						{
							if ( isset( $_SESSION["rights_managed_value" . $params["publication_id"]][$key] ) )
							{
								$rights_managed .= "|" . ( int )$key . "-" . ( int )$_SESSION["rights_managed_value" .
									$params["publication_id"]][$key];
		
								unset( $_SESSION["rights_managed" . $params["publication_id"]][$key] );
								unset( $_SESSION["rights_managed_value" . $params["publication_id"]][$key] );
							}
						}
		
						$rights_managed = $_SESSION["rights_managed_price" . $params["publication_id"]] .
							$rights_managed;
		
						$sql = "insert into " . PVS_DB_PREFIX .
							"carts_content (id_parent,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,collection,package) values (" .
							$cart_id . "," . $params["item_id"] . "," . $params["prints_id"] . "," . $params["publication_id"] .
							"," . $params["quantity"] . "," . $params["option1_id"] . ",'" . $params["option1_value"] .
							"'," . $params["option2_id"] . ",'" . $params["option2_value"] . "'," . $params["option3_id"] .
							",'" . $params["option3_value"] . "'," . $params["option4_id"] . ",'" . $params["option4_value"] .
							"'," . $params["option5_id"] . ",'" . $params["option5_value"] . "'," . $params["option6_id"] .
							",'" . $params["option6_value"] . "'," . $params["option7_id"] . ",'" . $params["option7_value"] .
							"'," . $params["option8_id"] . ",'" . $params["option8_value"] . "'," . $params["option9_id"] .
							",'" . $params["option9_value"] . "'," . $params["option10_id"] . ",'" . $params["option10_value"] .
							"','" . $rights_managed . "'," . $params["printslab"] . ",0,0)";
						$db->execute( $sql );
		
						unset( $_SESSION["rights_managed_price" . $params["publication_id"]] );
					}
				} else {
					//Files
					if ( $params["item_id"] != 0 )
					{
						$sql = "select id_parent from " . PVS_DB_PREFIX .
							"carts_content where id_parent=" . $cart_id . " and item_id=" . $params["item_id"];
						$dp->open( $sql );
						if ( $dp->eof )
						{
							$sql = "insert into " . PVS_DB_PREFIX .
								"carts_content (id_parent,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,collection,package) values (" .
								$cart_id . "," . $params["item_id"] . "," . $params["prints_id"] . "," . $params["publication_id"] .
								"," . $params["quantity"] . "," . $params["option1_id"] . ",'" . $params["option1_value"] .
								"'," . $params["option2_id"] . ",'" . $params["option2_value"] . "'," . $params["option3_id"] .
								",'" . $params["option3_value"] . "'," . $params["option4_id"] . ",'" . $params["option4_value"] .
								"'," . $params["option5_id"] . ",'" . $params["option5_value"] . "'," . $params["option6_id"] .
								",'" . $params["option6_value"] . "'," . $params["option7_id"] . ",'" . $params["option7_value"] .
								"'," . $params["option8_id"] . ",'" . $params["option8_value"] . "'," . $params["option9_id"] .
								",'" . $params["option9_value"] . "'," . $params["option10_id"] . ",'" . $params["option10_value"] .
								"',''," . $params["printslab"] . ", 0,0)";
							$db->execute( $sql );
						}
					}
		
					//Prints
					if ( $params["prints_id"] != 0 )
					{
						$sql = "insert into " . PVS_DB_PREFIX .
							"carts_content (id_parent,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,stock,stock_type,stock_id,stock_url,stock_preview,stock_site_url,x1,y1,x2,y2,print_width,print_height,collection,package) values (" .
							$cart_id . "," . $params["item_id"] . "," . $params["prints_id"] . "," . $params["publication_id"] .
							"," . $params["quantity"] . "," . $params["option1_id"] . ",'" . $params["option1_value"] .
							"'," . $params["option2_id"] . ",'" . $params["option2_value"] . "'," . $params["option3_id"] .
							",'" . $params["option3_value"] . "'," . $params["option4_id"] . ",'" . $params["option4_value"] .
							"'," . $params["option5_id"] . ",'" . $params["option5_value"] . "'," . $params["option6_id"] .
							",'" . $params["option6_value"] . "'," . $params["option7_id"] . ",'" . $params["option7_value"] .
							"'," . $params["option8_id"] . ",'" . $params["option8_value"] . "'," . $params["option9_id"] .
							",'" . $params["option9_value"] . "'," . $params["option10_id"] . ",'" . $params["option10_value"] .
							"',''," . $params["printslab"] . "," . ( int )@$params["stock"] . ",'" . @$params["stock_type"] .
							"'," . ( int )@$params["stock_id"] . ",'" . @$params["stock_url"] . "','" . @$params["stock_preview"] .
							"','" . @$params["stock_site_url"] . "','" . @$params["x1"] . "','" . @$params["y1"] .
							"','" . @$params["x2"] . "','" . @$params["y2"] . "','" . @$params["print_width"] .
							"','" . @$params["print_height"] . "', 0, 0)";
						$db->execute( $sql );
					}
				}
			} else {
				//Collection
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"carts_content where id_parent=" . $cart_id . " and collection=" . (int)$params["collection"];
				$dp->open( $sql );
				if ( $dp->eof )
				{
					$sql = "insert into " . PVS_DB_PREFIX .
						"carts_content (id_parent,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,collection,package) values (" .
						$cart_id . "," . $params["item_id"] . "," . $params["prints_id"] . "," . $params["publication_id"] .
						"," . $params["quantity"] . "," . $params["option1_id"] . ",'" . $params["option1_value"] .
						"'," . $params["option2_id"] . ",'" . $params["option2_value"] . "'," . $params["option3_id"] .
						",'" . $params["option3_value"] . "'," . $params["option4_id"] . ",'" . $params["option4_value"] .
						"'," . $params["option5_id"] . ",'" . $params["option5_value"] . "'," . $params["option6_id"] .
						",'" . $params["option6_value"] . "'," . $params["option7_id"] . ",'" . $params["option7_value"] .
						"'," . $params["option8_id"] . ",'" . $params["option8_value"] . "'," . $params["option9_id"] .
						",'" . $params["option9_value"] . "'," . $params["option10_id"] . ",'" . $params["option10_value"] .
						"',''," . $params["printslab"] . ", " . (int)$params["collection"] . ", 0)";
					$db->execute( $sql );
				}		
			}
		} else {
			//Packages
			$sql = "insert into " . PVS_DB_PREFIX .
				"carts_content (id_parent,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,collection,package) values (" .
				$cart_id . "," . $params["item_id"] . "," . $params["prints_id"] . "," . $params["publication_id"] .
				"," . $params["quantity"] . "," . $params["option1_id"] . ",'" . $params["option1_value"] .
				"'," . $params["option2_id"] . ",'" . $params["option2_value"] . "'," . $params["option3_id"] .
				",'" . $params["option3_value"] . "'," . $params["option4_id"] . ",'" . $params["option4_value"] .
				"'," . $params["option5_id"] . ",'" . $params["option5_value"] . "'," . $params["option6_id"] .
				",'" . $params["option6_value"] . "'," . $params["option7_id"] . ",'" . $params["option7_value"] .
				"'," . $params["option8_id"] . ",'" . $params["option8_value"] . "'," . $params["option9_id"] .
				",'" . $params["option9_value"] . "'," . $params["option10_id"] . ",'" . $params["option10_value"] .
				"',''," . $params["printslab"] . ", 0, " . (int)$params["package"] . ")";
			$db->execute( $sql );	
			
			$sql = "select id from " . PVS_DB_PREFIX . "carts_content where package = " . (int)$params["package"] . " and id_parent = " . $cart_id . " order by id desc";
			$dp->open($sql);
			$cart_content_id = $dp->row["id"];
			
			$sql = "select id,file_type,print_id,quantity from " . PVS_DB_PREFIX . "packages_files where package_id=" . (int)$params["package"] . " and quantity > 0";
			$dt->open($sql);
			while( ! $dt->eof ) {
				for ($i=0; $i < $dt->row["quantity"]; $i++) {
					$sql = "select id,file_id,file_type,print_id from " . PVS_DB_PREFIX . "packages_list where package_files_id=" . $dt->row["id"] . " and cart_content_id=" . (int) $cart_content_id . " and file_number = " . $i;
					$dp->open($sql);
					if ( $dp->eof) {
						$sql="insert into " . PVS_DB_PREFIX . "packages_list (package_id,package_files_id,cart_content_id,order_content_id,file_type,file_id,file_number,print_id,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value) values (" . (int)$params["package"] . "," . $dt->row["id"] . "," . (int) $cart_content_id . ",0," . $dt->row["file_type"] . ",0," . $i . "," . $dt->row["print_id"].",0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'',0,'')";
						$db->execute($sql);
					}
				}			
				$dt->movenext();
			}
		}
	}

	return $cart_id;
}




/**
 * Lightbox functions
 *
 */




/**
 * The function adds a new lightbox
 *
 * @param  array $params.
 */
function pvs_lightbox_add( $params )
{
	global $pvs_global_settings;
	global $db;
	global $dn;
	global $dr;
	global $rs;

	if ( $params["user"] != 0 )
	{
		if ( $params["lightbox_name"] != "" )
		{
			//Create a new lightbox
			$sql = "select a.id,a.title,b.id_parent,b.user from " . PVS_DB_PREFIX .
				"lightboxes a," . PVS_DB_PREFIX .
				"lightboxes_admin b where a.id=b.id_parent and a.title='" . $params["lightbox_name"] .
				"' and b.user=" . $params["user"];
			$dn->open( $sql );
			if ( $dn->eof )
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"lightboxes (title,description) values ('" . $params["lightbox_name"] . "','')";
				$db->execute( $sql );

				$sql = "select id from " . PVS_DB_PREFIX . "lightboxes where title='" . $params["lightbox_name"] .
					"' order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$params["lightboxes"][] = $dr->row["id"];

					//Add a user to the lightbox
					$sql = "insert into " . PVS_DB_PREFIX .
						"lightboxes_admin (id_parent,user,user_owner) values (" . $dr->row["id"] . "," .
						$params["user"] . ",1)";
					$db->execute( $sql );
				}
			}
		}

		$sql = "select id_parent from " . PVS_DB_PREFIX . "lightboxes_admin where user=" .
			$params["user"];
		$rs->open( $sql );
		while ( ! $rs->eof )
		{
			//Remove files from lightbox
			$sql = "delete from " . PVS_DB_PREFIX . "lightboxes_files where item=" . $params["id"] .
				" and id_parent=" . $rs->row["id_parent"];
			$db->execute( $sql );

			$rs->movenext();
		}

		//Add files for lightbox
		foreach ( $params["lightboxes"] as $key => $value )
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"lightboxes_files (id_parent,item) values (" . $value . "," . $params["id"] .
				")";
			$db->execute( $sql );
		}
	}
}






/**
 * Show lightbox preview
 *
 * @param  int $id lightbox ID.
 * @return array
 */
function pvs_show_lightbox_preview($id) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	
	$category_result = array();
	
	$lightbox_result["photo"] = "";
	$lightbox_result["width"] = $pvs_global_settings["category_preview"];
	$lightbox_result["height"] = 0;

	if ( file_exists(pvs_upload_dir() . "/content/categories/lightbox_" . (int)$id . ".jpg") ) {
		$lightbox_result["photo"] = pvs_upload_dir('baseurl') . "/content/categories/lightbox_" . (int)$id . ".jpg";
		$size = getimagesize( pvs_upload_dir() . "/content/categories/lightbox_" . (int)$id . ".jpg");
		$lightbox_result["width"] = $size[0];
		$lightbox_result["height"] = $size[1];
	} else {
		$sql = "select item from " . PVS_DB_PREFIX . "lightboxes_files where id_parent=" . (int)$id;
		$dp->open( $sql );
		while(!$dp->eof) {
			$sql = "select media_id,server1,title from " . PVS_DB_PREFIX . "media where id=" . $dp->row["item"];
			$dt->open( $sql );
			if(!$dt->eof) {
				if (pvs_media_type ($dt->row["media_id"]) == 'photo') {
					$hoverbox_results = pvs_get_hoverbox( $dp->row["item"], "photo", $dt->row["server1"], "", "" );
					$lightbox_result["photo"] = $hoverbox_results["flow_image"];
					$lightbox_result["width"] = $hoverbox_results["flow_width"];
					$lightbox_result["height"] = $hoverbox_results["flow_height"];
				}
				if (pvs_media_type ($dt->row["media_id"]) == 'video') {
					$hoverbox_results = pvs_get_hoverbox( $dp->row["item"], "video", $dt->row["server1"], "", "" );
					$lightbox_result["photo"] = $hoverbox_results["flow_image"];
					$lightbox_result["width"] = $hoverbox_results["flow_width"];
					$lightbox_result["height"] = $hoverbox_results["flow_height"];
				}
				if (pvs_media_type ($dt->row["media_id"]) == 'audio') {
					$hoverbox_results = pvs_get_hoverbox( $dp->row["item"], "audio", $dt->row["server1"], "", "" );
					$lightbox_result["photo"] = $hoverbox_results["flow_image"];
					$lightbox_result["width"] = $hoverbox_results["flow_width"];
					$lightbox_result["height"] = $hoverbox_results["flow_height"];
				}
				if (pvs_media_type ($dt->row["media_id"]) == 'vector') {
					$hoverbox_results = pvs_get_hoverbox( $dp->row["item"], "vector", $dt->row["server1"], "", "" );
					$lightbox_result["photo"] = $hoverbox_results["flow_image"];
					$lightbox_result["width"] = $hoverbox_results["flow_width"];
					$lightbox_result["height"] = $hoverbox_results["flow_height"];
				}
			}
			if ($lightbox_result["photo"] != '') {
				break;
			}
			$dp->movenext();
		}
	}
	
	return $lightbox_result;
}





/**
 * Count files in lightbox
 *
 * @param  int $id lightbox ID.
 * @return int
 */
function pvs_count_files_in_lightbox($id) {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$count_id = 0;
		
	$sql = "select count(id_parent) as count_files from " . PVS_DB_PREFIX .
		"lightboxes_files where id_parent=" . (int) $id;
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		$count_id = $dp->row["count_files"];
	}
	
	return $count_id;
}





/**
 * Taxes Functions
 *
 */





/**
 * The function calculates an order's tax
 *
 * @param  float $total order total.
 * @param  bool $tax_zero if tax= 0.
 * @param  string $type order, credits, subscription or prints.
 * @return array
 */
function pvs_order_taxes_calculate( $total, $tax_zero = false, $type = "order" )
{
	global $taxes_info;
	global $db;
	global $pvs_global_settings;
	global $_SESSION;
	global $mcountry_eu;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$taxes = 0;
	$taxes_text = "";
	$taxes_id = 0;
	$taxes_rate1 = 0;
	$taxes_rate2 = 0;
	$taxes_info["included"] = 1;
	$flag_tax = false;

	//EU taxes
	//KMJ corrected EU Tax calculation bugs - Hey, I know, they made it that stupid, one cannot explain it to non EU people :-) Its made by politicans
	if ( $pvs_global_settings["eu_tax"] and is_user_logged_in() )
	{
		// KMJ START
		// first lets get things together:

		$seller_country = $pvs_global_settings["company_country"]; // we assume seller country is EU if EU Taxes are set
		// there are also non EU companies which has to tax VAT
		// but they need to set a base tax rate

		// lets find out what country is our buyer from

		$buyer_country = $pvs_global_settings["company_country"]; // per default we assume its a llocal private customer, taxed with local VAT

		$user_info = get_userdata(get_current_user_id());

		//  ok now lets choose
		$buyer_country = $user_info->country; // settings made by customer
		$buyer_business = $user_info->business; // settings made by customer
		
		if ( ! $pvs_global_settings["eu_tax_country"] ) {
			$user_info->country_checked = 1;
		}

		//If country was not checked the client is private from seller's country
		// removed 6 month check for privat customers. with valid vat country is ok anyway
		// people selling to privat customers wouldnt want the extra work to e.g. recheck 100s of customers
		// but if country is not checked by admin its a local sales, EVEN if they say NON-EU

		// WE SHOULD THROW AN ERROR ON THE PAGE LETTING PEOPLE KNOW WE CHANGE THEM!
		// or better deny the possibility of ordering

		if ( $user_info->country_checked !=1 )
		{
			$buyer_country = $pvs_global_settings["company_country"]; // change EU and NON-EU , private and biz
		}

		//If VAT number is not correct or not checked the client is private from seller's country
		// we do not check for country inside the EU because if valid VAT its without taxes in any way.
		// admin must check country too to be valid, then all is good
		// after having a long discussion with lawyer here, we remove the 6 month periode. to much work
		// for backoffice

		if ( $buyer_business and ( in_array( $buyer_country, $mcountry_eu ) ) and ( (
			$user_info->country_checked !=1 ) or ( $user_info->vat_checked !=1 ) ) )
		{
			// was set to non EU but not checked or vat invalid
			$buyer_business = 0;
			$buyer_country = $pvs_global_settings["company_country"];
		} elseif ( $buyer_business and ( ! in_array( $buyer_country, $mcountry_eu ) ) and
		( ( ! $user_info->country_checked ) ) )
		{
			// was set to non EU but not checked
			$buyer_business = 0;
			$buyer_country = $pvs_global_settings["company_country"];
		}

		if ( $pvs_global_settings["eu_tax_b2b"] ) // if B2B Only Biz
		{
			if ( ! $buyer_business )
			{
				// we never should come here, B2B doesnt allow Sales to privat!
				// to avoid justice fees we bill as private,local country
				// should throw an error on CHECKOUT page for:
				// unchecked VAT number and biz account
				// b2b and no biz account with valid VAT number / country

				$buyer_business = 0;
				$buyer_country = $pvs_global_settings["company_country"];

			}
		}

		// KMJ END

		//Search seller VAT
		$sql = "select id_parent from " . PVS_DB_PREFIX . "tax_regions where country='" .
			$seller_country . "'";
		$dt->open( $sql );
		while ( ! $dt->eof )
		{
			$sql = "select * from " . PVS_DB_PREFIX . "tax where enabled=1 and id=" . $dt->
				row["id_parent"];
			$dp->open( $sql );
			if ( ! $dp->eof )
			{
				$flag_calculate = false;

				if ( $type == "order" and $dp->row["files"] == 1 )
				{
					$flag_calculate = true;
				}

				if ( $type == "credits" and $dp->row["credits"] == 1 )
				{
					$flag_calculate = true;
				}

				if ( $type == "subscription" and $dp->row["subscription"] == 1 )
				{
					$flag_calculate = true;
				}

				if ( $type == "prints" and $dp->row["prints"] == 1 )
				{
					$flag_calculate = true;
				}

				if ( $flag_calculate )
				{
					$seller_taxes_id = $dp->row["id"];
					$seller_taxes_text = "";

					if ( $dp->row["price_include"] == 1 )
					{
						$seller_taxes_text .= pvs_word_lang( "included" ) . " ";
						$seller_taxes_included = 0;
					} else
					{
						$seller_taxes_included = 1;
					}
					$seller_taxes_text .= $dp->row["title"];

					if ( $dp->row["rate_all_type"] == 1 )
					{
						if ( $dp->row["price_include"] != 1 )
						{
							$seller_taxes = pvs_price_format( $total * $dp->row["rate_all"] / 100, 2 );
						} else
						{
							$seller_taxes = pvs_price_format( $total * $dp->row["rate_all"] / ( 100 + $dp->
								row["rate_all"] ), 2 );
						}
						$seller_taxes_text .= " " . $dp->row["rate_all"] . "%";
						$seller_taxes_rate1 = $dp->row["rate_all"];
					} else
					{
						$seller_taxes = pvs_price_format( $dp->row["rate_all"], 2 );
						$seller_taxes_text .= " " . pvs_currency( 1 ) . $dp->row["rate_all"] . " " .
							pvs_currency( 2 );
						$seller_taxes_rate2 = $dp->row["rate_all"];
					}
				}
			}

			$dt->movenext();
		}
		//End. Search seller VAT

		//Search buyer VAT
		if ( $buyer_country != $seller_country )
		{
			$sql = "select id_parent from " . PVS_DB_PREFIX . "tax_regions where country='" .
				$buyer_country . "'";
			$dt->open( $sql );
			while ( ! $dt->eof )
			{
				$sql = "select * from " . PVS_DB_PREFIX . "tax where enabled=1 and id=" . $dt->
					row["id_parent"];
				$dp->open( $sql );
				if ( ! $dp->eof )
				{
					$flag_calculate = false;

					if ( $type == "order" and $dp->row["files"] == 1 )
					{
						$flag_calculate = true;
					}

					if ( $type == "credits" and $dp->row["credits"] == 1 )
					{
						$flag_calculate = true;
					}

					if ( $type == "subscription" and $dp->row["subscription"] == 1 )
					{
						$flag_calculate = true;
					}

					if ( $type == "prints" and $dp->row["prints"] == 1 )
					{
						$flag_calculate = true;
					}

					if ( $flag_calculate )
					{
						$buyer_taxes_id = $dp->row["id"];
						$buyer_taxes_text = "";

						if ( $dp->row["price_include"] == 1 )
						{
							$buyer_taxes_text .= pvs_word_lang( "included" ) . " ";
							$buyer_taxes_included = 0;
						} else
						{
							$buyer_taxes_included = 1;
						}
						$buyer_taxes_text .= $dp->row["title"];

						if ( $dp->row["rate_all_type"] == 1 )
						{
							if ( $dp->row["price_include"] != 1 )
							{
								$buyer_taxes = pvs_price_format( $total * $dp->row["rate_all"] / 100, 2 );
							} else
							{
								$buyer_taxes = pvs_price_format( $total * $dp->row["rate_all"] / ( 100 + $dp->
									row["rate_all"] ), 2 );
							}
							$buyer_taxes_text .= " " . $dp->row["rate_all"] . "%";
							$buyer_taxes_rate1 = $dp->row["rate_all"];
						} else
						{
							$buyer_taxes = pvs_price_format( $dp->row["rate_all"], 2 );
							$buyer_taxes_text .= " " . pvs_currency( 1 ) . $dp->row["rate_all"] . " " .
								pvs_currency( 2 );
							$buyer_taxes_rate2 = $dp->row["rate_all"];
						}
					}
				}

				$dt->movenext();
			}
		}
		//End. Search buyer VAT

		//Business EU buyer
		if ( @$buyer_business )
		{
			//The same EU country
			if ( $buyer_country == $seller_country )
			{
				$taxes_id = @$seller_taxes_id;
				$taxes_info["included"] = @$seller_taxes_included;
				$taxes_text = @$seller_taxes_text;
				$taxes = @$seller_taxes;
			} else
			{
				//Other EU country
				if ( in_array( $buyer_country, $mcountry_eu ) )
				{
					$taxes_id = 0;
					$taxes_info["included"] = 1;
					$taxes_text = "0%";
					$taxes = 0;
				}
				//Non EU country
				else
				{
					$taxes_id = 0;
					$taxes_info["included"] = 1;
					$taxes_text = "0%";
					$taxes = 0;
				}
			}
		}
		//Private EU buyer
		else
		{
			//The same EU country
			if ( $buyer_country == $seller_country )
			{
				$taxes_id = $seller_taxes_id;
				$taxes_info["included"] = $seller_taxes_included;
				$taxes_text = $seller_taxes_text;
				$taxes = $seller_taxes;
			} else
			{
				//Other EU country
				if ( in_array( $buyer_country, $mcountry_eu ) )
				{
					if ( $type == "prints" )
					{
						$taxes_id = $seller_taxes_id;
						$taxes_info["included"] = $seller_taxes_included;
						$taxes_text = $seller_taxes_text;
						$taxes = $seller_taxes;
					} else
					{
						$taxes_id = $buyer_taxes_id;
						$taxes_info["included"] = $buyer_taxes_included;
						$taxes_text = $buyer_taxes_text;
						$taxes = $buyer_taxes;
					}
				}
				//Non EU country
				else
				{
					$taxes_id = 0;
					$taxes_info["included"] = 1;
					$taxes_text = "0%";
					$taxes = 0;
				}
			}
		}
	}
	//Non-EU taxes
	else
	{
		$sql = "select * from " . PVS_DB_PREFIX . "tax where enabled=1";
		$dp->open( $sql );
		while ( ! $dp->eof )
		{
			//Regions
			$flag_regions = false;
			if ( $dp->row["regions"] == 0 )
			{
				$flag_regions = true;
			} else
			{
				$country = "";
				$state = "";

				if ( $dp->row["rates_depend"] == 2 )
				{
					$country = pvs_result( @$_SESSION["billing_country"] );
					$state = pvs_result( @$_SESSION["billing_state"] );
				}

				if ( $dp->row["rates_depend"] == 1 )
				{
					$country = pvs_result( @$_SESSION["shipping_country"] );
					$state = pvs_result( @$_SESSION["shipping_state"] );
				}

				if ( $country != "" )
				{
					$sql = "select country,state from " . PVS_DB_PREFIX .
						"tax_regions where id_parent=" . $dp->row["id"] . " and country='" . $country .
						"'";
					$dt->open( $sql );
					while ( ! $dt->eof )
					{
						if ( $dt->row["state"] == "" )
						{
							$flag_regions = true;
						} else
						{
							if ( $dt->row["state"] == $state )
							{
								$flag_regions = true;
							}
						}
						$dt->movenext();
					}
				}
			}
			//End. Regions

			//Calculates
			$flag_calculate = false;

			if ( $type == "order" and $dp->row["files"] == 1 )
			{
				$flag_calculate = true;
			}

			if ( $type == "credits" and $dp->row["credits"] == 1 )
			{
				$flag_calculate = true;
			}

			if ( $type == "subscription" and $dp->row["subscription"] == 1 )
			{
				$flag_calculate = true;
			}
			
			if ( $type == "prints" and $dp->row["prints"] == 1 )
			{
				$flag_calculate = true;
			}
			//End. Calculates

			//Business
			$flag_business = false;
			
			$user_info = get_userdata(get_current_user_id());

			if ( @$user_info->business == 1 )
			{
				if ( $dp->row["customer"] == 1 or $dp->row["customer"] == 0 )
				{
					$flag_business = true;
				}
			} else
			{
				if ( $dp->row["customer"] == 2 or $dp->row["customer"] == 0 )
				{
					$flag_business = true;
				}
			}
			//End. Business

			if ( $flag_regions and $flag_calculate and $flag_business and ! $flag_tax )
			{
				$flag_tax = true;

				$taxes_id = $dp->row["id"];

				if ( $dp->row["price_include"] == 1 )
				{
					$taxes_text .= pvs_word_lang( "included" ) . " ";
					$taxes_info["included"] = 0;
				} else
				{
					$taxes_info["included"] = 1;
				}
				$taxes_text .= $dp->row["title"];

				if ( $dp->row["rate_all_type"] == 1 )
				{
					if ( $dp->row["price_include"] != 1 )
					{
						$taxes = pvs_price_format( $total * $dp->row["rate_all"] / 100, 2 );
					} else
					{
						$taxes = pvs_price_format( $total * $dp->row["rate_all"] / ( 100 + $dp->row["rate_all"] ),
							2 );
					}
					$taxes_text .= " " . $dp->row["rate_all"] . "%";
					$taxes_rate1 = $dp->row["rate_all"];
				} else
				{
					$taxes = pvs_price_format( $dp->row["rate_all"], 2 );
					$taxes_text .= " " . pvs_currency( 1 ) . $dp->row["rate_all"] . " " .
						pvs_currency( 2 );
					$taxes_rate2 = $dp->row["rate_all"];
				}
			}

			$dp->movenext();
		}
	}

	$taxes_info["id"] = $taxes_id;
	$taxes_info["total"] = $taxes;
	$taxes_info["text"] = $taxes_text;
	if ( $tax_zero )
	{
		return $taxes * $taxes_info["included"];
	} else
	{
		return $taxes;
	}
}



/**
 * VIES VAT number validation
 *	https://stackoverflow.com/questions/9158119/vies-vat-number-validation
 * @author Eugen Mihailescu
 *        
 * @param string $vat        
 * @param int $timeout          
 */
function pvs_check_vat($vat, $user_id, $timeout = 30) {	
	$vat = str_replace(array(' ', '.', '-', ',', ', '), '', trim($vat));
	$countryCode = substr($vat, 0, 2);
	$vatNumber = substr($vat, 2);

    $response = array ();
    $pattern = '/<(%s).*?>([\s\S]*)<\/\1/';	
     $keys = array (
            'countryCode',
            'vatNumber',
            'requestDate',
            'valid',
            'name',
            'address' 
    );
    $content = "<s11:Envelope xmlns:s11='http://schemas.xmlsoap.org/soap/envelope/'>
  <s11:Body>
    <tns1:checkVat xmlns:tns1='urn:ec.europa.eu:taxud:vies:services:checkVat:types'>
      <tns1:countryCode>%s</tns1:countryCode>
      <tns1:vatNumber>%s</tns1:vatNumber>
    </tns1:checkVat>
  </s11:Body>
</s11:Envelope>";

    $opts = array (
            'http' => array (
                    'method' => 'POST',
                    'header' => "Content-Type: text/xml; charset=utf-8; SOAPAction: checkVatService",
                    'content' => sprintf ( $content, $countryCode, $vatNumber ),
                    'timeout' => $timeout 
            ) 
    );
    $ctx = stream_context_create ( $opts );
    $result = file_get_contents ( 'http://ec.europa.eu/taxation_customs/vies/services/checkVatService', false, $ctx );

    if (preg_match ( sprintf ( $pattern, 'checkVatResponse' ), $result, $matches )) {
        foreach ( $keys as $key )
            preg_match ( sprintf ( $pattern, $key ), $matches [2], $value ) && $response [$key] = $value [2];
    }
    
    if ( @ $response[ 'valid' ] == "true") {
    	update_user_meta( $user_id, 'vat_checked', 1 );
		update_user_meta( $user_id, 'vat_checked_date', pvs_get_time() );
		return true;
    } else {
    	update_user_meta( $user_id, 'vat_checked', -1 );
		update_user_meta( $user_id, 'vat_checked_date', 0 );
		return false;
    }
}




/**
 * Mail Functions
 *
 */




/**
 * Send a notification to a user
 *
 * @param  string $evt event.
 * @param  string $p1 param1.
 * @param  string $p2 param2.
 * @param  string $p3 param3.
 * @param  string $p4 param4.
 * @param  bool $preview_test send email or not.
 * @return bool
 */
function pvs_send_notification( $evt, $p1 = "", $p2 = "", $p3 = "", $p4 = "", $preview_test = false ) {
	global $db;
	global $_POST;
	global $_SESSION;
	global $_REQUEST;
	global $mstocks;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dw = new TMySQLQuery;
	$dw->connection = $db;
	$dz = new TMySQLQuery;
	$dz->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	global $table_prefix;

	$sql = "select subject,message,html,events,title,message_html from " . PVS_DB_PREFIX .
		"notifications where events='" . $evt . "' and enabled=1";
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		$from_email = get_option( 'admin_email' );
		$to_email = get_option( 'admin_email' );
		$subject = $dp->row["subject"];
		
		if ( $dp->row["html"] == 1 ) {
			$textsend = $dp->row["message_html"];
		} else {
			$textsend = $dp->row["message"];
		}

		if ( $evt == "contacts_to_admin" ) {
			$textsend = str_replace( "{NAME}", $_POST["name"], $textsend );
			$textsend = str_replace( "{EMAIL}", $_POST["email"], $textsend );
			$textsend = str_replace( "{TELEPHONE}", $_POST["telephone"], $textsend );
			$textsend = str_replace( "{METHOD}", $_POST["method"], $textsend );
			$textsend = str_replace( "{QUESTION}", $_POST["question"], $textsend );
			$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );
		}

		if ( $evt == "contacts_to_user" ) {
			$to_email = pvs_result($_POST["email"]);
			$textsend = str_replace( "{NAME}", $_POST["name"], $textsend );
		}

		if ( $evt == "fraud_to_user" ) {
			$to_email = $p2;
			$textsend = str_replace( "{NEWPASSWORD}", $p1, $textsend );
			$textsend = str_replace( "{NAME}", $p3, $textsend );
		}

		if ( $evt == "neworder_to_user" or  $evt == "neworder_to_admin") {
			$subject = str_replace( "{ORDER_ID}", $p1, $subject );

			$sql = "select * from " . PVS_DB_PREFIX . "orders where id=" . ( int )$p1;
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$textsend = str_replace( "{ORDER}", strval( $dt->row["id"] ), $textsend );
				$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );
				$textsend = str_replace( "{SUBTOTAL}", pvs_currency( 1 ) . strval( pvs_price_format
					( $dt->row["subtotal"], 2 ) ) . " " . pvs_currency( 2 ), $textsend );
				$textsend = str_replace( "{DISCOUNT}", pvs_currency( 1 ) . strval( pvs_price_format
					( $dt->row["discount"], 2 ) ) . " " . pvs_currency( 2 ), $textsend );
				$textsend = str_replace( "{SHIPPING}", pvs_currency( 1 ) . strval( pvs_price_format
					( $dt->row["shipping"], 2 ) ) . " " . pvs_currency( 2 ), $textsend );
				$textsend = str_replace( "{TAXES}", pvs_currency( 1 ) . strval( pvs_price_format
					( $dt->row["tax"], 2 ) ) . " " . pvs_currency( 2 ), $textsend );
				$textsend = str_replace( "{TOTAL}", pvs_currency( 1 ) . strval( pvs_price_format
					( $dt->row["total"], 2 ) ) . " " . pvs_currency( 2 ), $textsend );

				$textsend = str_replace( "{BILLING_FIRSTNAME}", $dt->row["billing_firstname"], $textsend );
				$textsend = str_replace( "{BILLING_LASTNAME}", $dt->row["billing_lastname"], $textsend );
				$textsend = str_replace( "{BILLING_ADDRESS}", $dt->row["billing_address"], $textsend );
				$textsend = str_replace( "{BILLING_CITY}", $dt->row["billing_city"], $textsend );
				$textsend = str_replace( "{BILLING_ZIP}", $dt->row["billing_zip"], $textsend );
				$textsend = str_replace( "{BILLING_COUNTRY}", $dt->row["billing_country"], $textsend );

				$textsend = str_replace( "{SHIPPING_FIRSTNAME}", $dt->row["shipping_firstname"],
					$textsend );
				$textsend = str_replace( "{SHIPPING_LASTNAME}", $dt->row["shipping_lastname"], $textsend );
				$textsend = str_replace( "{SHIPPING_ADDRESS}", $dt->row["shipping_address"], $textsend );
				$textsend = str_replace( "{SHIPPING_CITY}", $dt->row["shipping_city"], $textsend );
				$textsend = str_replace( "{SHIPPING_ZIP}", $dt->row["shipping_zip"], $textsend );
				$textsend = str_replace( "{SHIPPING_COUNTRY}", $dt->row["shipping_country"], $textsend );
				
				$user_info = get_userdata($dt->row["user"]);

				$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
				$textsend = str_replace( "{CUSTOMERID}", @$user_info -> ID, $textsend );
				$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );
				if ( $evt == "neworder_to_user" ) {
					$to_email = @$user_info -> user_email;
				}
				if ( $dp->row["html"] == 1 )
				{
					$textsend = str_replace( "{EMAIL}", "<a href='mailto:" . @$user_info -> user_email .
						"'>" . @$user_info -> user_email . "</a>", $textsend );
				} else
				{
					$textsend = str_replace( "{EMAIL}", @$user_info -> user_email, $textsend );
				}
				$textsend = str_replace( "{TELEPHONE}", @$user_info -> telephone, $textsend );


				$item_list = "";
				$i = 1;
				$sql = "select * from " .
					PVS_DB_PREFIX . "orders_content where id_parent=" . ( int )$p1;
				;
				$dz->open( $sql );
				while ( ! $dz->eof )
				{
					if ( (int) $dz->row["package"] == 0 ) {
						if ( (int) $dz->row["collection"] == 0 ) {
							if ( ( int )$dz->row["stock"] == 0 ) {
								if ( $dz->row["prints"] != 1 )
								{
									//Digital file
									$sql = "select id,id_parent,name,shipped from " . PVS_DB_PREFIX .
										"items where id=" . $dz->row["item"];
									$dw->open( $sql );
									if ( ! $dw->eof )
									{
										$item_list .= $i . ". ID=" . $dw->row["id_parent"] . " - " . $dw->row["name"] .
											" - " . pvs_currency( 1 ) . pvs_price_format( $dz->row["price"], 2 ) . " " .
											pvs_currency( 2 ) . " - " . $dz->row["quantity"];
			
										if ( $dw->row["shipped"] != 1 )
										{
											$sql = "select link from " . PVS_DB_PREFIX . "downloads where id_parent=" . $dw->
												row["id"] . " and  order_id=" . ( int )$p1;
											$dx->open( $sql );
											if ( ! $dx->eof )
											{
												if ( $dp->row["html"] == 1 )
												{
													$item_list .= "<br><a href='" . site_url() . "/download/?f=" .
														$dx->row["link"] . "'>" . site_url() . "/download/?f=" . $dx->
														row["link"] . "</a>";
												} else
												{
													$item_list .= "\n" . site_url() . "/download/?f=" . $dx->row["link"];
												}
											}
										}
			
										if ( $dp->row["html"] == 1 )
										{
											$item_list .= "<br><br>";
										} else
										{
											$item_list .= "\n\n";
										}
			
									}
								} else
								{
									if ( $dz->row["printslab"] != 1 )
									{
										//Prints
										$sql = "select id_parent,price,title,itemid from " . PVS_DB_PREFIX .
											"prints_items where id_parent=" . $dz->row["item"];
										$dw->open( $sql );
										if ( ! $dw->eof )
										{
											$price = pvs_define_prints_price( $dz->row["price"], $dz->row["option1_id"],
											$dz->row["option1_value"], $dz->row["option2_id"], $dz->row["option2_value"], $dz->
											row["option3_id"], $dz->row["option3_value"], $dz->row["option4_id"], $dz->row["option4_value"],
											$dz->row["option5_id"], $dz->row["option5_value"], $dz->row["option6_id"], $dz->
											row["option6_value"], $dz->row["option7_id"], $dz->row["option7_value"], $dz->
											row["option8_id"], $dz->row["option8_value"], $dz->row["option9_id"], $dz->row["option9_value"],
											$dz->row["option10_id"], $dz->row["option10_value"] );
											
											$item_list .= $i . ". ID=" . $dw->row["itemid"] . " - " . $dw->row["title"] .
												" - " . pvs_currency( 1 ) . pvs_price_format( $price, 2 ) . " " .
												pvs_currency( 2 ) . " - " . $dz->row["quantity"] . "";
			
											if ( $dp->row["html"] == 1 )
											{
												$item_list .= "<br>";
											} else
											{
												$item_list .= "\n";
											}
			
											for ( $j = 1; $j < 11; $j++ )
											{
												if ( $dz->row["option" . $j . "_id"] != 0 and $dz->row["option" . $j . "_value"] !=
													"" )
												{
													$sql = "select title from " . PVS_DB_PREFIX . "products_options where id=" . $dz->
														row["option" . $j . "_id"];
													$dx->open( $sql );
													if ( ! $dx->eof )
													{
														$item_list .= $dx->row["title"] . ": " . $dz->row["option" . $j . "_value"] .
															". ";
													}
												}
											}
										}
			
										if ( $dp->row["html"] == 1 )
										{
											$item_list .= "<br><br>";
										} else
										{
											$item_list .= "\n\n";
										}
									} else
									{
										//Prints lab
										$sql = "select id_parent,price,title from " . PVS_DB_PREFIX .
											"prints where id_parent=" . $dz->row["item"];
										$dw->open( $sql );
										if ( ! $dw->eof )
										{
											$price = pvs_define_prints_price( $dz->row["price"], $dz->row["option1_id"],
											$dz->row["option1_value"], $dz->row["option2_id"], $dz->row["option2_value"], $dz->
											row["option3_id"], $dz->row["option3_value"], $dz->row["option4_id"], $dz->row["option4_value"],
											$dz->row["option5_id"], $dz->row["option5_value"], $dz->row["option6_id"], $dz->
											row["option6_value"], $dz->row["option7_id"], $dz->row["option7_value"], $dz->
											row["option8_id"], $dz->row["option8_value"], $dz->row["option9_id"], $dz->row["option9_value"],
											$dz->row["option10_id"], $dz->row["option10_value"] );
											
											$item_list .= $i . ". " . pvs_word_lang( "prints lab" ) . " ID=" . $dz->row["printslab_id"] .
												" - " . $dw->row["title"] . " - " . pvs_currency( 1 ) . pvs_price_format( $price, 2 ) . " " . pvs_currency( 2 ) . " - " . $dz->row["quantity"] . "";
			
											if ( $dp->row["html"] == 1 )
											{
												$item_list .= "<br>";
											} else
											{
												$item_list .= "\n";
											}
			
											for ( $j = 1; $j < 11; $j++ )
											{
												if ( $dz->row["option" . $j . "_id"] != 0 and $dz->row["option" . $j . "_value"] !=
													"" )
												{
													$sql = "select title from " . PVS_DB_PREFIX . "products_options where id=" . $dz->
														row["option" . $j . "_id"];
													$dx->open( $sql );
													if ( ! $dx->eof )
													{
														$item_list .= $dx->row["title"] . ": " . $dz->row["option" . $j . "_value"] .
															". ";
													}
												}
											}
										}
			
										if ( $dp->row["html"] == 1 )
										{
											$item_list .= "<br><br>";
										} else
										{
											$item_list .= "\n\n";
										}
									}
								}
							} else {
								//Stock print
								$sql = "select id_parent,price,title from " . PVS_DB_PREFIX .
									"prints where id_parent=" . $dz->row["item"];
								$dw->open( $sql );
								if ( ! $dw->eof )
								{
									$price = pvs_define_prints_price( $dz->row["price"], $dz->row["option1_id"],
									$dz->row["option1_value"], $dz->row["option2_id"], $dz->row["option2_value"], $dz->
									row["option3_id"], $dz->row["option3_value"], $dz->row["option4_id"], $dz->row["option4_value"],
									$dz->row["option5_id"], $dz->row["option5_value"], $dz->row["option6_id"], $dz->
									row["option6_value"], $dz->row["option7_id"], $dz->row["option7_value"], $dz->
									row["option8_id"], $dz->row["option8_value"], $dz->row["option9_id"], $dz->row["option9_value"],
									$dz->row["option10_id"], $dz->row["option10_value"] );
									
									$item_list .= $i . ". " . @$mstocks[$dz->row["stock_type"]] . " #" . $dz->row["stock_id"] . " - " . pvs_currency( 1 ) . pvs_price_format( $price, 2 ) . " " . pvs_currency( 2 ) . " - " . $dz->row["quantity"] . "";
	
									if ( $dp->row["html"] == 1 )
									{
										$item_list .= "<br>";
									} else
									{
										$item_list .= "\n";
									}
	
									for ( $j = 1; $j < 11; $j++ )
									{
										if ( $dz->row["option" . $j . "_id"] != 0 and $dz->row["option" . $j . "_value"] !=
											"" )
										{
											$sql = "select title from " . PVS_DB_PREFIX . "products_options where id=" . $dz->
												row["option" . $j . "_id"];
											$dx->open( $sql );
											if ( ! $dx->eof )
											{
												$item_list .= $dx->row["title"] . ": " . $dz->row["option" . $j . "_value"] .
													". ";
											}
										}
									}
								}	
								
								if ( $dp->row["html"] == 1 )
								{
									$item_list .= "<br><br>";
								} else
								{
									$item_list .= "\n\n";
								}
							}
						} else {
							//Collection
							$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . (int)$dz->row["collection"];
							$dw->open( $sql );
							if ( ! $dw->eof ) {
								$item_list .= $i . ". " . pvs_word_lang("Collection") . ": " .  $dw->row["title"] . " (" . pvs_count_files_in_collection($dw->row["id"]) . ")  - " . pvs_currency( 1 ) . pvs_price_format( $dw->row["price"], 2 ) . " " . pvs_currency( 2 ) . " - " . $dz->row["quantity"];
											
								$sql = "select link from " . PVS_DB_PREFIX . "downloads where collection_id=" . $dw->
									row["id"] . " and  order_id=" . ( int )$p1;
								$dx->open( $sql );
								if ( ! $dx->eof )
								{
									if ( $dp->row["html"] == 1 )
									{
										$item_list .= "<br><a href='" . site_url() . "/download/?f=" .
											$dx->row["link"] . "'>" . site_url() . "/download/?f=" . $dx->
											row["link"] . "</a>";
									} else
									{
										$item_list .= "\n" . site_url() . "/download/?f=" . $dx->row["link"];
									}
								}
								
								if ( $dp->row["html"] == 1 )
								{
									$item_list .= "<br><br>";
								} else
								{
									$item_list .= "\n\n";
								}
							}					
						}
					} else {
						//Package
						$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . (int)$dz->row["package"];
						$dw->open( $sql );
						if ( ! $dw->eof ) {
							$item_list .= $i . ". " . pvs_word_lang("Package") . ": " .  $dw->row["title"] . " - " . pvs_currency( 1 ) . pvs_price_format( $dw->row["price"], 2 ) . " " . pvs_currency( 2 ) . " - " . $dz->row["quantity"];
										
							$sql = "select link from " . PVS_DB_PREFIX . "downloads where id_parent = " . $dz->row["id"] . " and  package_id=" . $dw->
								row["id"] . " and  order_id=" . ( int )$p1;
							$dx->open( $sql );
							if ( ! $dx->eof )
							{
								if ( $dp->row["html"] == 1 )
								{
									$item_list .= "<br><a href='" . site_url() . "/download/?f=" .
										$dx->row["link"] . "'>" . site_url() . "/download/?f=" . $dx->
										row["link"] . "</a>";
								} else
								{
									$item_list .= "\n" . site_url() . "/download/?f=" . $dx->row["link"];
								}
							}
							
							if ( $dp->row["html"] == 1 )
							{
								$item_list .= "<br><br>";
							} else
							{
								$item_list .= "\n\n";
							}
						}						
					}
					$i++;
					$dz->movenext();
				}
				$textsend = str_replace( "{ITEM_LIST}", $item_list, $textsend );
			}
		}

		if ( $evt == "signup_to_admin" ) {
			$user_info = get_userdata(( int )$p1);
			
			$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );

			$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );
			$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
			if ( $dp->row["html"] == 1 )
			{
				$textsend = str_replace( "{EMAIL}", "<a href='mailto:" . @$user_info -> user_email .
					"'>" . @$user_info -> user_email . "</a>", $textsend );
			} else
			{
				$textsend = str_replace( "{EMAIL}", @$user_info -> user_email, $textsend );
			}
			$textsend = str_replace( "{TELEPHONE}", @$user_info -> telephone, $textsend );
			$textsend = str_replace( "{ADDRESS}", @$user_info -> address, $textsend );
			$textsend = str_replace( "{COUNTRY}",  @$user_info -> country, $textsend );
			$textsend = str_replace( "{CITY}", @$user_info -> city, $textsend );
		}

		if ( $evt == "signup_to_user" ) {
			$to_email = pvs_result($_POST["email"]);
			$textsend = str_replace( "{NAME}", pvs_result($_POST["name"]), $textsend );
		}

		if ( $evt == "signup_guest" ) {
			$to_email = pvs_result( $_POST["guest_email"] );
			$textsend = str_replace( "{LOGIN}", $p1, $textsend );
			$textsend = str_replace( "{PASSWORD}", $p2, $textsend );
		}

		if ( $evt == "forgot_password" ) {
			$sql = "select ID from " . $table_prefix . "users where user_email='" . pvs_result( $_POST["email"] ) . "'";
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$user_info = get_userdata($dt->row["ID"]);
				
				$newpassword = pvs_create_password();

				$to_email = $dt->row["email"];
				$textsend = str_replace( "{PASSWORD}", $newpassword, $textsend );
				$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
				$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );

				if ( $preview_test == false )
				{
					$sql = "update " . $table_prefix . "users set user_pass='" . md5( $newpassword ) .
						"' where user_email='" . pvs_result( $_POST["email"] ) . "'";
					$db->execute( $sql );
				}
			}
		}

		if ( $evt == "tell_a_friend" ) {
			$to_email = pvs_result($_REQUEST["email2"]);
			$textsend = str_replace( "{NAME2}", $_REQUEST["name2"], $textsend );
			$textsend = str_replace( "{NAME}", $_REQUEST["name"], $textsend );
			$textsend = str_replace( "{EMAIL}", $_REQUEST["email"], $textsend );
			if ( $dp->row["html"] == 1 )
			{
				$textsend = str_replace( "{URL}", "<a href='" . $p1 . "'>" . $p1 . "</a>", $textsend );
			} else
			{
				$textsend = str_replace( "{URL}", $p1, $textsend );
			}
		}

		if ( $evt == "subscription_to_admin" ) {
			$sql = "select user,data1,data2,title,subscription from " . PVS_DB_PREFIX .
				"subscription_list where id_parent=" . ( int )$p1;
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$details = $dt->row["title"];

				$sql = "select price from " . PVS_DB_PREFIX . "subscription where id_parent=" .
					$dt->row["subscription"];
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$details .= " (" . pvs_currency( 1, false ) . strval( pvs_price_format( $dw->
						row["price"], 2 ) ) . pvs_currency( 2, false ) . ")";
				}

				$subject = str_replace( "{SUBSCRIPTION}", strval( $p1 ), $subject );
				$textsend = str_replace( "{SUBSCRIPTION_DETAILS}", $details, $textsend );

				$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );

				$sql = "select ID from " . $table_prefix . "users where user_login='" . $dt->row["user"] . "'";
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$user_info = get_userdata($dw->row["ID"]);
					
					$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );
					$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
					if ( $dp->row["html"] == 1 )
					{
						$textsend = str_replace( "{EMAIL}", "<a href='mailto:" . @$user_info -> user_email .
							"'>" . @$user_info -> user_email . "</a>", $textsend );
					} else
					{
						$textsend = str_replace( "{EMAIL}", @$user_info -> user_email, $textsend );
					}
					$textsend = str_replace( "{TELEPHONE}", @$user_info -> telephone, $textsend );
					$textsend = str_replace( "{ADDRESS}", @ $user_info -> address, $textsend );
					$textsend = str_replace( "{COUNTRY}", @$user_info -> country, $textsend );
				}
			}
		}

		if ( $evt == "subscription_to_user" ) {
			$sql = "select user,data1,data2,title,subscription from " . PVS_DB_PREFIX .
				"subscription_list where id_parent=" . ( int )$p1;
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$details = $dt->row["title"];

				$sql = "select price from " . PVS_DB_PREFIX . "subscription where id_parent=" .
					$dt->row["subscription"];
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$details .= " (" . pvs_currency( 1, false ) . strval( pvs_price_format( $dw->
						row["price"], 2 ) ) . pvs_currency( 2, false ) . ")";
				}

				$subject = str_replace( "{SUBSCRIPTION}", strval( $p1 ), $subject );
				$textsend = str_replace( "{SUBSCRIPTION_DETAILS}", $details, $textsend );

				$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );

				$sql = "select ID from " . $table_prefix . "users where user_login='" . $dt->row["user"] . "'";
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$user_info = get_userdata($dw->row["ID"]);
					$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
					$to_email = @$user_info -> user_email;
				}
			}
		}

		if ( $evt == "credits_to_admin" ) {
			$sql = "select user,data,title,credits from " . PVS_DB_PREFIX .
				"credits_list where id_parent=" . ( int )$p1;
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$details = $dt->row["title"];

				$sql = "select price from " . PVS_DB_PREFIX . "credits where id_parent=" . $dt->
					row["credits"];
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$details .= " (" . pvs_currency( 1, false ) . strval( pvs_price_format( $dw->
						row["price"], 2 ) ) . pvs_currency( 2, false ) . ")";
				}

				$subject = str_replace( "{CREDITS}", strval( $p1 ), $subject );
				$textsend = str_replace( "{CREDITS_DETAILS}", $details, $textsend );

				$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );

				$sql = "select ID from " . $table_prefix . "users where user_login='" . $dt->row["user"] . "'";
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$user_info = get_userdata($dw->row["ID"]);
					
					$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );
					$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
					if ( $dp->row["html"] == 1 )
					{
						$textsend = str_replace( "{EMAIL}", "<a href='mailto:" . @$user_info -> user_email .
							"'>" . @$user_info -> user_email . "</a>", $textsend );
					} else
					{
						$textsend = str_replace( "{EMAIL}", @$user_info -> user_email, $textsend );
					}
					$textsend = str_replace( "{TELEPHONE}", @$user_info -> telephone, $textsend );
					$textsend = str_replace( "{ADDRESS}", @ $user_info -> address, $textsend );
					$textsend = str_replace( "{COUNTRY}", @$user_info -> country, $textsend );
				}
			}
		}

		if ( $evt == "credits_to_user" ) {
			$sql = "select user,data,title,credits from " . PVS_DB_PREFIX .
				"credits_list where id_parent=" . ( int )$p1;
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$details = $dt->row["title"];

				$sql = "select price from " . PVS_DB_PREFIX . "credits where id_parent=" . $dt->
					row["credits"];
				$dw->open( $sql );
				if ( ! $dp->eof )
				{
					$details .= " (" . pvs_currency( 1, false ) . strval( pvs_price_format( $dw->
						row["price"], 2 ) ) . pvs_currency( 2, false ) . ")";
				}

				$subject = str_replace( "{CREDITS}", strval( $p1 ), $subject );
				$textsend = str_replace( "{CREDITS_DETAILS}", $details, $textsend );

				$textsend = str_replace( "{DATE}", date( datetime_format ), $textsend );

				$sql = "select ID from " . $table_prefix . "users where user_login='" . $dt->row["user"] . "'";
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$user_info = get_userdata($dw->row["ID"]);
					$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
					$to_email = @$user_info -> user_email;
				}
			}
		}

		if ( $evt == "commission_to_affiliate" or $evt == "commission_to_seller" ) {
			$user_info = get_userdata(( int )$p1);
			$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
			$to_email = @$user_info -> user_email;

			if ( $p4 >= 0 )
			{
				$sql = "select title from " . PVS_DB_PREFIX . "media where id=" . ( int )$p3;
				$dw->open( $sql );
				if ( ! $dw->eof )
				{
					$textsend = str_replace( "{FILE}", "ID=" . $p3 . " - " . $dw->row["title"], $textsend );
				} else
				{
					$sql = "select title,itemid from " . PVS_DB_PREFIX .
						"prints_items where id_parent=" . ( int )$p3;
					$dt->open( $sql );
					if ( ! $dt->eof )
					{
						$textsend = str_replace( "{FILE}", "ID=" . $dt->row["itemid"] . " - " . $dt->
							row["title"], $textsend );
					}
				}
			} else
			{
				$sql = "select title,itemid from " . PVS_DB_PREFIX .
					"prints_items where id_parent=" . ( int )$p3;
				$dt->open( $sql );
				if ( ! $dt->eof )
				{
					$textsend = str_replace( "{FILE}", "ID=" . $dt->row["itemid"] . " - " . $dt->
						row["title"], $textsend );
				}
			}

			if ( $p4 < 0 )
			{
				$p4 *= -1;
			}

			$textsend = str_replace( "{ORDER_ID}", $p2, $textsend );

			if ( $pvs_global_settings["credits"] )
			{
				$textsend = str_replace( "{EARNING}", pvs_currency( 1, false ) .
					pvs_price_format( $pvs_global_settings["payout_price"] * $p4, 2 ) . " " .
					pvs_currency( 2, false ), $textsend );
			} else
			{
				$textsend = str_replace( "{EARNING}", pvs_currency( 1, false ) .
					pvs_price_format( $p4, 2 ) . " " . pvs_currency( 2, false ), $textsend );
			}
		}

		if ( $evt == "exam_to_admin" or $evt == "exam_to_seller" ) {
			$user_info = get_userdata(( int )$p1);
			$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
			$textsend = str_replace( "{LOGIN}", @$user_info -> user_login, $textsend );
			if ( $evt == "exam_to_seller" )
			{
				$to_email = @$user_info -> user_email;
			}

			$sql = "select id,user,data,status,comments from " . PVS_DB_PREFIX .
				"examinations where id=" . ( int )$p2;
			$dw->open( $sql );
			if ( ! $dw->eof )
			{
				$textsend = str_replace( "{ID}", $dw->row["id"], $textsend );
				$textsend = str_replace( "{DATE}", date( date_format, $dw->row["data"] ), $textsend );
				$textsend = str_replace( "{COMMENTS}", $dw->row["comments"], $textsend );
				if ( $dw->row["status"] == 0 )
				{
					$textsend = str_replace( "{RESULT}", pvs_word_lang( "pending" ), $textsend );
				}
				if ( $dw->row["status"] == 1 )
				{
					$textsend = str_replace( "{RESULT}", pvs_word_lang( "approved" ), $textsend );
				}
				if ( $dw->row["status"] == 2 )
				{
					$textsend = str_replace( "{RESULT}", pvs_word_lang( "declined" ), $textsend );
				}
			}
		}

		if ( $evt == "support_to_admin" or $evt == "support_to_user" ) {

			$sql = "select id,id_parent,admin_id,user_id,subject,message,data,viewed_admin,viewed_user,rating,closed from " .
				PVS_DB_PREFIX . "support_tickets where id=" . ( int )$p1;
			$dw->open( $sql );
			if ( ! $dw->eof )
			{
				if ( $dw->row["id_parent"] != 0 )
				{
					$sql = "select subject,user_id from " . PVS_DB_PREFIX .
						"support_tickets where id=" . $dw->row["id_parent"];
					$dt->open( $sql );
					if ( ! $dt->eof )
					{
						$subject = str_replace( "{SUBJECT}", $dt->row["subject"], $subject );

						$user_info = get_userdata($dt->row["user_id"]);
						$textsend = str_replace( "{NAME}", @$user_info -> first_name, $textsend );
						$to_email = @$user_info -> user_login;

						if ( $dw->row["user_id"] == 0 )
						{
							if ( $dp->row["html"] != 1 )
							{
								$textsend = str_replace( "{URL}", site_url() .
									"/support-content/?id=" . $dw->row["id_parent"], $textsend );
							} else
							{
								$textsend = str_replace( "{URL}", "<a href='" . site_url() .
									"/support-content/?id=" . $dw->row["id_parent"] . "'>" . site_url() . "/support-content/?id=" . $dw->row["id_parent"] . "</a>",
									$textsend );
							}
						}

						if ( $dw->row["admin_id"] == 0 )
						{
							if ( $dp->row["html"] != 1 )
							{
								$textsend = str_replace( "{URL}", pvs_plugins_admin_url('support/index.php') .
									"&action=content&id=" . $dw->row["id_parent"], $textsend );
							} else
							{
								$textsend = str_replace( "{URL}", "<a href='" . pvs_plugins_admin_url('support/index.php') .
									"&action=content&id=" . $dw->row["id_parent"] . "'>" . site_url() . "&action=content&id=" . $dw->row["id_parent"] . "</a>", $textsend );
							}
						}
					}
				} else
				{
					$subject = str_replace( "{SUBJECT}", $dw->row["subject"], $subject );
				}

				$subject = str_replace( "{ID}", $dw->row["id"], $subject );
				$textsend = str_replace( "{MESSAGE}", $dw->row["message"], $textsend );

				if ( $dw->row["admin_id"] == 0 and $dw->row["id_parent"] == 0 )
				{
					if ( $dp->row["html"] != 1 )
					{
						$textsend = str_replace( "{URL}", pvs_plugins_admin_url('support/index.php') .
							"&action=content&id=" . $dw->row["id"], $textsend );
					} else
					{
						$textsend = str_replace( "{URL}", "<a href='" . pvs_plugins_admin_url('support/index.php') .
							"&action=content&id=" . $dw->row["id"] . "'>" . pvs_plugins_admin_url('support/index.php') .
							"&action=content&id=" . $dw->row["id"] . "</a>", $textsend );
					}
				}

			}
		}

		if ( $preview_test == true and $dp->row["html"] != 1 ) {
			$textsend = "<div class='header_preview'>" . $dp->row["title"] . "</div>" . $textsend;
		}

		$subject = str_replace( "{SITE_NAME}", get_option( 'blogname' ), $subject );
		$textsend = str_replace( "{SITE_NAME}", get_option( 'blogname' ), $textsend );
		$textsend = str_replace( "{ADDRESS}", $pvs_global_settings["company_address"], $textsend );

		$textsend = pvs_translate_text( $textsend );

		if ( ! $preview_test ) {
			
			if ( $dp->row["html"] == 1 )
			{
				$headers = array(
					'content-type: text/html'
				);
			} else {
				$headers = array();
			}
		
			wp_mail( $to_email, $subject, $textsend, $headers);
		}

		return $textsend;
	}
}






/**
 * Download functions
 *
 */






/**
 * Create download links for approved order
 *
 * @param  int $pid order ID.
 */
function pvs_downloads_create( $pid ) {
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dz = new TMySQLQuery;
	$dz->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$sql = "select status,user from " . PVS_DB_PREFIX . "orders where status =1 and id=" . ( int ) $pid;
	$dz->open( $sql );
	if ( ! $dz->eof ) {
		$sql = "select id,item,collection,package from " . PVS_DB_PREFIX . "orders_content where id_parent=" . ( int ) $pid . " and (prints <> 1 or (collection = 1 and prints = 0) or (package = 1 and prints = 0)) order by id";
		$dp->open( $sql );
		while ( ! $dp->eof ) {
			if ( (int)$dp->row["package"] == 0 ) {
				if ( (int)$dp->row["collection"] == 0 ) {
					//Digital files
					$sql = "select id,name,price,id_parent,url,shipped from " . PVS_DB_PREFIX . "items where id=" . $dp->row["item"];
					$dt->open( $sql );
					if ( ! $dt->eof )
					{
						if ( $dt->row["shipped"] != 1 )
						{
							$sql = "select id_parent from " . PVS_DB_PREFIX . "downloads where id_parent=" .
								$dt->row["id"] . " and order_id=" . ( int )$pid;
							$dx->open( $sql );
							if ( $dx->eof )
							{
								$sql = "insert into " . PVS_DB_PREFIX .
									"downloads (id_parent,link,data,tlimit,ulimit,order_id,user_id,subscription_id,publication_id,collection_id,package_id) values (" .
									$dt->row["id"] . ",'" . md5( strval( pvs_get_time( date( "H" ), date( "i" ),
									date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) ) . pvs_create_password() . strval( $dt->row["id"] ) ) .
									"'," . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date
									( "d" ), date( "Y" ) ) + $pvs_global_settings["download_expiration"] * 3600 * 24 ) .
									",0," . $pvs_global_settings["download_limit"] . "," . ( int )$pid . "," . $dz->
									row["user"] . ",0," . $dt->row["id_parent"] . ",0,0)";
								$db->execute( $sql );
		
								$sql = "update " . PVS_DB_PREFIX .
									"media set downloaded=downloaded+1 where id=" . $dt->row["id_parent"];
								$db->execute( $sql );
							}
						}
					}
				} else {
					//Collections
					$sql = "select id_parent from " . PVS_DB_PREFIX . "downloads where collection_id=" . $dp->row["collection"] . " and order_id=" . ( int )$pid;
					$dx->open( $sql );
					if ( $dx->eof )
					{
						$sql = "insert into " . PVS_DB_PREFIX .
							"downloads (id_parent,link,data,tlimit,ulimit,order_id,user_id,subscription_id,publication_id,collection_id,package_id) values (0,'" . md5( strval( pvs_get_time( date( "H" ), date( "i" ),
							date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) ) . pvs_create_password() . strval( $dp->row["collection"] ) ) .
							"'," . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date
							( "d" ), date( "Y" ) ) + $pvs_global_settings["download_expiration"] * 3600 * 24 ) .
							",0," . $pvs_global_settings["download_limit"] . "," . ( int )$pid . "," . $dz->
							row["user"] . ",0,0, " . $dp->row["collection"] . ",0)";
						$db->execute( $sql );
					}
				}
			} else {
				//Packages
				$sql = "select id_parent from " . PVS_DB_PREFIX . "downloads where id_parent=" . $dp->row["id"] . " and package_id=" . $dp->row["package"] . " and order_id=" . ( int )$pid;
				$dx->open( $sql );
				if ( $dx->eof )
				{
					$sql = "insert into " . PVS_DB_PREFIX .
						"downloads (id_parent,link,data,tlimit,ulimit,order_id,user_id,subscription_id,publication_id,collection_id,package_id) values (" . $dp->row["id"] . ",'" . md5( strval( pvs_get_time( date( "H" ), date( "i" ),
						date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) ) . pvs_create_password() . strval( $dp->row["collection"] ) ) .
						"'," . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date
						( "d" ), date( "Y" ) ) + $pvs_global_settings["download_expiration"] * 3600 * 24 ) .
						",0," . $pvs_global_settings["download_limit"] . "," . ( int )$pid . "," . $dz->
						row["user"] . ",0,0,0, " . $dp->row["package"] . ")";
					$db->execute( $sql );
				}
			}
			$dp->movenext();
		}
	}
}






/**
 * Create download links for subscription
 *
 * @param  int $pid item ID.
 * @param  int $pid_parent publication ID.
 * @return bool $flag_bandwidth_add
 */
function pvs_downloads_create_subscription( $pid, $pid_parent )
{
	global $db;
	global $_SESSION;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$flag_bandwidth_add = false;

	$sql = "select id_parent,subscription from " . PVS_DB_PREFIX .
		"subscription_list where user='" . pvs_result( pvs_user_id_to_login( get_current_user_id()) ) .
		"' and data2>" . pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ),
		date( "d" ), date( "Y" ) ) .
		" and bandwidth<bandwidth_limit and approved=1 order by data2 desc";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "select link from " . PVS_DB_PREFIX . "downloads where user_id=" . get_current_user_id() . " and subscription_id=" . $dp->row["id_parent"] .
			" and publication_id=" . ( int )$pid_parent . " and tlimit<ulimit and data>" .
			pvs_get_time( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ),
			date( "Y" ) ) . " and id_parent=" . ( int )$pid;
		$dt->open( $sql );
		if ( $dt->eof )
		{
			$flag_bandwidth_add = true;

			$sql = "insert into " . PVS_DB_PREFIX .
				"downloads (id_parent,link,data,tlimit,ulimit,order_id,user_id,subscription_id,publication_id) values (" . ( int )
				$pid . ",'" . md5( strval( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
				date( "m" ), date( "d" ), date( "Y" ) ) ) . strval( $pid ) ) . "'," . ( pvs_get_time
				( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) +
				$pvs_global_settings["download_expiration"] * 3600 * 24 ) . ",0," . $pvs_global_settings["download_limit"] .
				",0," . get_current_user_id() . "," . $dp->row["id_parent"] . "," . ( int )
				$pid_parent . ")";
			$db->execute( $sql );
		} else
		{
			$sql = "update " . PVS_DB_PREFIX .
				"downloads set tlimit=tlimit+1 where user_id=" . get_current_user_id() .
				" and subscription_id=" . $dp->row["id_parent"] . " and publication_id=" . ( int )
				$pid_parent . " and id_parent=" . ( int )$pid;
			$db->execute( $sql );
		}
	}

	return $flag_bandwidth_add;
}





/**
 * Create download links for subscription
 *
 * @param  int $pid item ID.
 * @param  int $pid_parent publication ID.
 * @return bool $flag_download
 */
function pvs_create_free_downloads_link( $pid, $pid_parent )
{
	global $db;
	global $_SESSION;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$flag_download = false;
	
	$user_info = get_userdata(get_current_user_id());


	if ( $user_info->downloads_date != date( "j" ) )
	{
		update_user_meta( get_current_user_id(), 'downloads', 1);
		update_user_meta( get_current_user_id(), 'downloads_date', date( "j" ));
		
		$flag_download = true;
	} else
	{
		if ( $user_info->downloads <= $pvs_global_settings["daily_download_limit"] )
		{
			update_user_meta( get_current_user_id(), 'downloads', (int)@$user_info->downloads + 1);
			
			$flag_download = true;
		}
	}

	if ( $flag_download )
	{
		$sql = "select link from " . PVS_DB_PREFIX . "downloads where user_id=" . get_current_user_id() . " and subscription_id=0 and publication_id=" . ( int )
			$pid_parent . " and tlimit<ulimit and data>" . pvs_get_time( date( "H" ), date( "i" ),
			date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) . " and id_parent=" . ( int )
			$pid;
		$dt->open( $sql );
		if ( $dt->eof )
		{
			$sql = "insert into " . PVS_DB_PREFIX .
				"downloads (id_parent,link,data,tlimit,ulimit,order_id,user_id,subscription_id,publication_id) values (" . ( int )
				$pid . ",'" . md5( strval( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
				date( "m" ), date( "d" ), date( "Y" ) ) ) . strval( $pid ) ) . "'," . ( pvs_get_time
				( date( "H" ), date( "i" ), date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) +
				$pvs_global_settings["download_expiration"] * 3600 * 24 ) . ",0," . $pvs_global_settings["download_limit"] .
				",0," . get_current_user_id() . ",0," . ( int )$pid_parent . ")";
			$db->execute( $sql );
		} else
		{
			$sql = "update " . PVS_DB_PREFIX .
				"downloads set tlimit=tlimit+1 where user_id=" . get_current_user_id() .
				" and subscription_id=0 and publication_id=" . ( int )$pid_parent .
				" and id_parent=" . ( int )$pid;
			$db->execute( $sql );
		}
	}

	return $flag_download;
}






/**
 * The function reads a file by the portions
 *
 * @param  string $filename file path.
 * @return string file content
 */
function pvs_readfile_chunked( $filename )
{
	$chunksize = 1 * ( 1024 * 1024 ); // how many bytes per chunk
	$buffer = '';
	$handle = fopen( $filename, 'rb' );
	if ( $handle === false )
	{
		return false;
	}
	while ( ! feof( $handle ) )
	{
		$buffer = fread( $handle, $chunksize );
		print $buffer;
	}
	return fclose( $handle );
}






/**
 * Prints Functions
 *
 */





/**
 * Update prints quantity in stock
 *
 * @param  int $pid order ID.
 */
function pvs_update_prints_in_stock( $pid )
{
	global $db;
	global $pvs_global_settings;

	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$dt = new TMySQLQuery;
	$dt->connection = $db;

	if ( $pvs_global_settings["prints"] )
	{
		$sql = "select quantity,item from " . PVS_DB_PREFIX .
			"orders_content where id_parent=" . ( int )$pid . " and prints=1";
		$dp->open( $sql );
		while ( ! $dp->eof )
		{
			$sql = "select in_stock from " . PVS_DB_PREFIX . "prints_items where id_parent=" .
				$dp->row["item"];
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				if ( $dt->row["in_stock"] != -1 )
				{
					$quantity = $dt->row["in_stock"] - $dp->row["quantity"];
					if ( $quantity < 0 )
					{
						$quantity = 0;
					}

					$sql = "update " . PVS_DB_PREFIX . "prints_items set in_stock=" . $quantity .
						" where id_parent=" . $dp->row["item"];
					$db->execute( $sql );
				}
			}
			$dp->movenext();
		}
	}
}





/**
 * The function defines a prints price depening on the options
 *
 * @param  float $price print price.
 * @param  int $optionN_id property ID.
 * @param  string $optionN_value property value.
 * @return float
 */
function pvs_define_prints_price( $price, $option1_id, $option1_value, $option2_id,
	$option2_value, $option3_id, $option3_value, $option4_id, $option4_value, $option5_id,
	$option5_value, $option6_id, $option6_value, $option7_id, $option7_value, $option8_id,
	$option8_value, $option9_id, $option9_value, $option10_id, $option10_value )
{
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;

	for ( $i = 1; $i < 11; $i++ )
	{
		$option_id = "option" . $i . "_id";
		$option_value = "option" . $i . "_value";

		if ( $$option_id != 0 )
		{
			$sql = "select title,price,adjust from " . PVS_DB_PREFIX .
				"products_options_items where id_parent=" . $$option_id;
			$dp->open( $sql );
			while ( ! $dp->eof )
			{
				if ( $dp->row["title"] == $$option_value )
				{
					$price += $dp->row["price"] * $dp->row["adjust"];
				}
				$dp->movenext();
			}
		}
	}

	return $price;
}





/**
 * Print preview info
 *
 * @param  int $print_id print ID.
 * @return array
 */
function pvs_get_print_preview_info( $print_id )
{
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$print_info["flag"] = false;
	$print_info["preview"] = '';
	$print_info["title"] = '';

	$sql = "select preview,title from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )
		$print_id;
	$dp->open( $sql );
	if ( ! $dp->eof and $dp->row["preview"] > 0 )
	{
		$sql = "select preview from " . PVS_DB_PREFIX . "prints_previews where id=" . $dp->
			row["preview"];
		$dt->open( $sql );
		if ( ! $dt->eof )
		{
			$print_info["flag"] = true;
			$print_info["preview"] = $dt->row["preview"];
			$print_info["title"] = $dp->row["title"];
		}
	}

	return $print_info;
}





/**
 * Print preview info
 *
 * @param  int $id publication ID.
 * @param  int $print_id print ID.
 * @param  bool $show_print_title.
 * @return array
 */
function pvs_show_print_preview( $id, $print_id, $show_print_title = false )
{
	global $db;
	global $pvs_global_settings;
	global $pvs_theme_content;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$print_preview_content = "";
	$print_photo = "";
	$title = "";
	$hoverbox_results = array();

	$sql = "select title,server1 from " . PVS_DB_PREFIX . "media where id=" . ( int )
		$id;
	$dt->open( $sql );
	if ( ! $dt->eof )
	{
		$title = $dt->row["title"];
		$print_photo = pvs_show_preview( ( int )$id, "photo", 2, 1, $dt->row["server1"],
			( int )$id );
		$hoverbox_results = pvs_get_hoverbox( ( int )$id, "photo", $dt->row["server1"],
			$dt->row["title"], '' );
	}

	$sql = "select preview from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )
		$print_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "select preview from " . PVS_DB_PREFIX . "prints_previews where id=" . $dp->
			row["preview"];
		$dx->open( $sql );
		if ( ! $dx->eof )
		{
			if ( file_exists( PVS_PATH . "includes/prints/" . $dx->row["preview"] . "_small.php" ) )
			{
				$pvs_theme_content[ 'print_url' ] = pvs_print_url( $id, $print_id, $title, $dx->row["preview"], '' );
				$pvs_theme_content[ 'item_img2' ] = $print_photo;
				$pvs_theme_content[ 'width_prints' ] = $hoverbox_results["flow_width"];
				$pvs_theme_content[ 'height_prints' ] = $hoverbox_results["flow_height"];
				include(PVS_PATH . "includes/prints/" . $dx->row["preview"] . "_small.php");
				$print_preview_content = $pvs_theme_content[ 'print_content' ];
			}
		}
	}

	return $print_preview_content;
}






/**
 * Print preview info for stock
 *
 * @param  int $print_id print ID.
 * @param  string $title stock publication title.
 * @param  string $stock stock type.
 * @param  string $stock_id publication id on stock.
 * @param  string $stock_preview photo preview.
 * @param  bool $show_print_title.
 * @return array
 */
function pvs_show_print_preview_stock( $print_id, $title, $stock, $stock_id, $stock_preview, $show_print_title = false )
{
	global $db;
	global $pvs_global_settings;
	global $pvs_theme_content;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$print_preview_content = "";
	$hoverbox_results = array();

	$sz = @getimagesize( $stock_preview );
	$iframe_width = (int)@$sz[0];
	$iframe_height = (int)@$sz[1];

	$width_limit = $pvs_global_settings["width_flow"];
	if ( ( $iframe_width > $width_limit or $iframe_height > $width_limit ) and $iframe_width !=
		0 )
	{
		$iframe_height = round( $iframe_height * $width_limit / $iframe_width );
		$iframe_width = $width_limit;
	}

	$sql = "select preview from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )
		$print_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "select preview from " . PVS_DB_PREFIX . "prints_previews where id=" . $dp->
			row["preview"];
		$dx->open( $sql );
		if ( ! $dx->eof )
		{
			$pvs_theme_content[ 'print_url' ] = pvs_print_url( $stock_id, $print_id, $title, $dx->row["preview"], $stock );
			$pvs_theme_content[ 'item_img2' ] = $stock_preview;
			$pvs_theme_content[ 'width_prints' ] = $iframe_width;
			$pvs_theme_content[ 'height_prints' ] = $iframe_height;
			
			include (PVS_PATH . "includes/prints/" . $dx->row["preview"] . "_small.php");
			$print_preview_content = $pvs_theme_content[ 'print_content' ];
		}
	}

	return $print_preview_content;
}




/**
 * Print preview info for stock
 *
 * @param  int $print_id print ID.
 * @param  string $title photo title.
 * @param  string $print_url print URL.
 * @param  string $print_photo print photo.
 * @return array
 */
function pvs_show_print_preview_printslab( $print_id, $title, $print_url, $print_photo )
{
	global $db;
	global $pvs_global_settings;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	$dx = new TMySQLQuery;
	$dx->connection = $db;

	$print_preview_content = "";
	$hoverbox_results = array();

	$sz = getimagesize( pvs_upload_dir() . $print_photo );
	$iframe_width = $sz[0];
	$iframe_height = $sz[1];

	$width_limit = $pvs_global_settings["width_flow"];
	if ( ( $iframe_width > $width_limit or $iframe_height > $width_limit ) and $iframe_width !=
		0 )
	{
		$iframe_height = round( $iframe_height * $width_limit / $iframe_width );
		$iframe_width = $width_limit;
	}

	$sql = "select preview from " . PVS_DB_PREFIX . "prints where id_parent=" . ( int )
		$print_id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		$sql = "select preview from " . PVS_DB_PREFIX . "prints_previews where id=" . $dp->
			row["preview"];
		$dx->open( $sql );
		if ( ! $dx->eof )
		{
			if ( file_exists( PVS_PATH . "includes/prints/" . $dx->row["preview"] . "_small.php" ) )
			{
				$pvs_theme_content[ 'print_url' ] = $print_url;
				$pvs_theme_content[ 'item_img2' ] = pvs_upload_dir('baseurl') . $print_photo;
				$pvs_theme_content[ 'width_prints' ] = $iframe_width;
				$pvs_theme_content[ 'height_prints' ] = $iframe_height;
				include(PVS_PATH . "includes/prints/" . $dx->row["preview"] . "_small.php");
				$print_preview_content = $pvs_theme_content[ 'print_content' ];
			}
		}
	}

	return $print_preview_content;
}






/**
 * User functions
 *
 */





/**
 * Create a new user
 *
 * @param  array $params.
 * @return int user ID
 */
function pvs_add_user( $params )
{
	global $_COOKIE;
	global $pvs_global_settings;
	
	$role = 'buyer';
	if (@$params["utype"] == 'seller') {
		$role = 'seller';
	}
	if (@$params["utype"] == 'affiliate') {
		$role = 'affiliate';
	}
	if (@$params["utype"] == 'common') {
		$role = 'common';
	}
	
	$userdata = array(
		'user_login'  =>  @$params["login"],
		'user_pass'   =>  @$params["password"],
		'user_nicename' => @$params["login"],
		'nickname' => @$params["login"],
		'display_name' => @$params["login"],
		'user_email' => @$params["email"],
		'first_name' => @$params["name"],
		'last_name' => @$params["lastname"],
		'description' => @$params["description"],
		'user_url' => @$params["website"]
	);

	$id = wp_insert_user( $userdata ) ;
	
	if ( (int)$id > 0 ) {
		add_user_meta( $id, 'country', @$params["country"], true );
		add_user_meta( $id, 'telephone', @$params["telephone"], true );
		add_user_meta( $id, 'address', @$params["address"], true );
		add_user_meta( $id, 'ip', @$params["ip"], true );
		add_user_meta( $id, 'city', @$params["city"] , true );
		add_user_meta( $id, 'state', @$params["state"], true );
		add_user_meta( $id, 'zipcode', @$params["zipcode"], true );
		add_user_meta( $id, 'category', @$params["category"], true );
		add_user_meta( $id, 'company', @$params["company"], true );
		add_user_meta( $id, 'newsletter', @$params["newsletter"], true );
		add_user_meta( $id, 'examination', @$params["examination"], true );
		add_user_meta( $id, 'authorization', @$params["authorization"], true );
		add_user_meta( $id, 'aff_commission_buyer', @$params["aff_commission_buyer"], true );
		add_user_meta( $id, 'aff_commission_seller', @$params["aff_commission_seller"], true );
		add_user_meta( $id, 'aff_visits', @$params["aff_visits"], true );
		add_user_meta( $id, 'aff_signups', @$params["aff_signups"], true );
		add_user_meta( $id, 'aff_referal', @$params["aff_referal"], true );
		add_user_meta( $id, 'business', @$params["business"], true );
		add_user_meta( $id, 'vat', @$params["vat"], true );
		add_user_meta( $id, 'payout_limit', @$params["payout_limit"], true );
		add_user_meta( $id, 'downloads', @$params["downloads"], true );
		add_user_meta( $id, 'downloads_date', @$params["downloads_date"], true );
		add_user_meta( $id, 'country_checked', @$params["country_checked"], true );
		add_user_meta( $id, 'country_checked_date', @$params["country_checked_date"], true );
		add_user_meta( $id, 'vat_checked', @$params["vat_checked"], true );
		add_user_meta( $id, 'vat_checked_date', @$params["vat_checked_date"], true );
		add_user_meta( $id, 'rating', @$params["rating"], true );
		add_user_meta( $id, 'utype', $role, true );
		
		if (@$params["avatar"] != '') {
			add_user_meta( $id, 'avatar', @$params["avatar"], true );
		}
		
		if ( @$params["vat"] != '' and $pvs_global_settings["eu_tax"] and $pvs_global_settings["eu_tax_vat_validation"]) {
			pvs_check_vat(@$params["vat"], $id);
		}
	}

	if ( isset( $_COOKIE["aff"] ) and (int)$id > 0)
	{
		pvs_affiliate_add( $params["aff_referal"], $id, $params["utype"] );
	}

	return $id;
}






/**
 * The function authorizes a user
 *
 * @param  int $id user ID.
 */
function pvs_user_authorization( $id )
{
	$user = get_user_by('id', $id );
	
	if ( !is_wp_error( $user ) )
	{
		clean_user_cache($user->ID);
		wp_clear_auth_cookie();
		wp_set_current_user ( $user->ID );
		wp_set_auth_cookie  ( $user->ID );
		update_user_caches($user);
	}
}






/**
 * The function shows an user's URL
 *
 * @param  int $id user ID.
 * @return string user URL
 */
function pvs_user_url( $id )
{
	if ($id != 0) {
		$user_info = get_userdata($id);
		$res = site_url() . "/member/" . @$user_info -> user_login . '/';
	} else {
		$res = site_url() . "/";
	}

	return $res;
}





/**
 * Get user id by login
 *
 * @param  string $login.
 * @return int $id user ID
 */
function pvs_user_login_to_id( $login )
{
	global $_SESSION;
	global $db;
	global $table_prefix;
	
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$sql = "select ID, user_login from " . $table_prefix . "users where user_login='" . pvs_result( $login ) . "'";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		return $dp->row["ID"];
	} else
	{
		return 0;
	}
}






/**
 * Get user login by id
 *
 * @param  int $id user ID.
 * @return string $login
 */
function pvs_user_id_to_login( $id )
{
	global $_SESSION;
	global $db;
	global $table_prefix;
		
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$sql = "select ID, user_login from " . $table_prefix . "users where ID=" . ( int ) $id;
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		return $dp->row["user_login"];
	} else
	{
		return "";
	}
}






/**
 * The function shows an user's avatar
 *
 * @param  string $param user id or login.
 * @param  string $type 'id' or 'login'.
 * @return string
 */
function pvs_show_user_avatar( $param, $type )
{
	global $pvs_global_settings;

	$res = "";
	
	if ( $type == "login" )
	{
		$user_id = pvs_user_login_to_id( $param );
		$user_login = $param;
	}
	else
	{
		$user_id = $param;
		$user_login = pvs_user_id_to_login( $param );
	}
	
	$res = "<a href='" . pvs_user_url( $user_id ) . "' class='toleft'>" . get_avatar( $user_id, 30) . "</a>&nbsp;&nbsp;<a href='" . pvs_user_url( $user_id ) . "'>" .
			pvs_show_user_name( $user_login ) . "</a>";
	return $res;
}





/**
 * The function shows an user's name
 *
 * @param  string $login user login.
 * @return string
 */
function pvs_show_user_name( $login )
{
	global $pvs_global_settings;
	
	$user = get_user_by('login', $login);
	if ( isset($pvs_global_settings["show_users_type"]) and $pvs_global_settings["show_users_type"] == "name" ) {
		$user_info = get_userdata(@$user -> data -> ID);
		return @$user_info -> first_name . ' ' . @$user_info -> last_name;
	} else {
		return @$user -> data -> user_login;
	}
}






/**
 * If a user is admin
 *
 * @return bool
 */
function pvs_is_user_admin () {
	return current_user_can('manage_options');
}






/**
 * Get user type
 *
 * @param  int $user_id user ID.
 * @return string
 */
function pvs_get_user_type ($user_id = 0) {
	global $pvs_global_settings;

	if ($user_id == 0) {
		$user_info = get_userdata( get_current_user_id() );
	} else {
		$user_info = get_userdata( $user_id );
	}
	
	$role = @$user_info -> utype;
	
	if($role != 'buyer' and $role != 'seller' and $role != 'affiliate' and $role != 'common') {
		if ( $pvs_global_settings["common_account"] ) {
			$role = "common";
		} else {
			$role = "buyer";
		}
	}
	
	return $role;
}






/**
 * Get user category
 *
 * @return string
 */
function pvs_get_user_category () {
	global $pvs_global_settings;

	if (is_user_logged_in()) {
       $user_info  = get_userdata(get_current_user_id());
       
       $user_category = @$user_info -> category;
       
       if ($user_category == '') {
       		$user_category =	$pvs_global_settings["userstatus"];
       }
       
       return $user_category;
    }
}





/**
 * Get user examination
 *
 * @return bool
 */
function pvs_get_user_examination () {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$sql = "select id from " . PVS_DB_PREFIX . "examinations where status =1 and user=" . get_current_user_id();
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		return true;
	} else {
		return false;
	}
}





/**
 * Get user login
 *
 * @return string user login
 */
function pvs_get_user_login () {
	if (is_user_logged_in()) {
       $user_info  = get_userdata(get_current_user_id());
       return $user_info -> user_login;
    }
}






/**
 * Get user's avatar
 *
 * @param  string $avatar.
 * @param  string $id_or_email.
 * @param  int $size in pixels.
 * @param  string $default.
 * @param  string $alt.
 * @return string
 */
function pvs_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;

    if ( is_numeric( $id_or_email ) ) {

        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );   
    }

    if ( $user && is_object( $user ) ) {
    	$user_avatar = get_user_meta( $user->data->ID, 'avatar',false);
    
		if ( file_exists (pvs_upload_dir() . "/content/users/" . $user->data->user_login . ".jpg") ) {
			$avatar = pvs_upload_dir('baseurl') . "/content/users/" . $user->data->user_login . ".jpg";
		} else if (@$user_avatar[0] != '') {
			$avatar = @$user_avatar[0];
		} else {
			$avatar = get_avatar_url($user->data->ID);
		}
		$avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    }

    return $avatar;
}





/**
 * Notification for admin panel
 *
 * @param  string $login.
 */
function pvs_admin_notifications( $login ) {
	global $db;
	global $dr;
	global $ds;
	global $pvs_global_settings;
	global $table_prefix;
	
	$user_info = get_user_by('login', $login);
	
	$user_id = (int)@$user_info->ID;

	
	if (@$user_info->roles[0] == 'administrator') {
		//Last values
		$users_properties = array(
			"orders",
			"credits",
			"subscription",
			"commission",
			"downloads",
			"uploads",
			"exams",
			"comments",
			"lightboxes",
			"users",
			"support",
			"messages",
			"contacts",
			"testimonials",
			"documents",
			"payments",
			"invoices" );
	
		for ( $i = 0; $i < count( $users_properties ); $i++ ) {
	
			$sql = "select property,property_value from " . PVS_DB_PREFIX .
				"administrators_stats where administrator_id=" . $user_id .
				" and property='" . $users_properties[$i] . "'";
			$ds->open( $sql );
			if ( $ds->eof )
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"administrators_stats (property,property_value,administrator_id,property_value_old,property_value_count) values ('" . $users_properties[$i] .
					"',0," . $user_id . ",0,0)";
				$db->execute( $sql );
			}
		}
	
		$sql = "select property,property_value,property_value_old,property_value_count from " . PVS_DB_PREFIX .
			"administrators_stats where administrator_id=" . $user_id;
		$ds->open( $sql );
		while ( ! $ds->eof ) {
		
			$property_count = 0;
			$property_value = 0;
	
			//Calculate new orders
			if ( $ds->row["property"] == "orders" )
			{
				$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
					"orders where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from " . PVS_DB_PREFIX .
					"orders where status=1 order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new credits
			if ( $ds->row["property"] == "credits" and $pvs_global_settings["credits"] )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"credits_list where quantity>0 and id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"credits_list where approved=1 and quantity>0 order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new subscription
			if ( $ds->row["property"] == "subscription" and $pvs_global_settings["subscription"] )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"subscription_list where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"subscription_list where approved=1 order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new commission
			if ( $ds->row["property"] == "commission" and $pvs_global_settings["userupload"] )
			{
				$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
					"commission where total>0 and id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from " . PVS_DB_PREFIX .
					"commission where total>0 order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new downloads
			if ( $ds->row["property"] == "downloads" and ! $pvs_global_settings["printsonly"] )
			{
				$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
					"downloads where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from " . PVS_DB_PREFIX . "downloads order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new invoices
			if ( $ds->row["property"] == "invoices" )
			{
				$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
					"invoices where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from " . PVS_DB_PREFIX . "invoices order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new payments
			if ( $ds->row["property"] == "payments" )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"payments where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"payments order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new exam
			if ( $ds->row["property"] == "exams" and $pvs_global_settings["examination"] )
			{
				$sql = "select count(id) as count_param from  " . PVS_DB_PREFIX .
					"examinations where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from  " . PVS_DB_PREFIX . "examinations order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new comments
			if ( $ds->row["property"] == "comments" and $pvs_global_settings["reviews"] )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"reviews where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"reviews order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new lightboxes
			if ( $ds->row["property"] == "lightboxes" )
			{
				$sql = "select count(id) as count_param from  " . PVS_DB_PREFIX .
					"lightboxes where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from  " . PVS_DB_PREFIX . "lightboxes order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new users
			if ( $ds->row["property"] == "users" )
			{
				$sql = "select count(ID) as count_param from " . $table_prefix . "users where ID>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select ID from " . $table_prefix . "users order by ID desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["ID"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new documents
			if ( $ds->row["property"] == "documents" )
			{
				$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
					"documents where id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from " . PVS_DB_PREFIX . "documents order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new messages
			if ( $ds->row["property"] == "messages" and $pvs_global_settings["messages"] )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"messages where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"messages order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new contacts
			if ( $ds->row["property"] == "contacts" )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"support where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"support order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new testimonials
			if ( $ds->row["property"] == "testimonials" and $pvs_global_settings["testimonials"] )
			{
				$sql = "select count(id_parent) as count_param from " . PVS_DB_PREFIX .
					"testimonials where id_parent>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id_parent from " . PVS_DB_PREFIX .
					"testimonials order by id_parent desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id_parent"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id .
						" and property='" . $ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new support tickets
			if ( $ds->row["property"] == "support" and $pvs_global_settings["support"] )
			{
				$sql = "select count(id) as count_param from  " . PVS_DB_PREFIX .
					"support_tickets where user_id<>0 and id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					if ( $ds->row["property_value"] > 0 )
					{
						$property_count = $dr->row["count_param"];
						$property_value = $ds->row["property_value"];
					}
				}
	
				$sql = "select id from  " . PVS_DB_PREFIX . "support_tickets order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			//Calculate new uploads
			if ( $ds->row["property"] == "uploads" and $pvs_global_settings["userupload"] )
			{
				$count_uploads = 0;
	
				$sql = "select count(id) as count_param from  " . PVS_DB_PREFIX .
					"media where userid<>0 and id>" . $ds->row["property_value"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$count_uploads += $dr->row["count_param"];
				}

				if ( $ds->row["property_value"] > 0 )
				{
					$property_count = $dr->row["count_param"];
					$property_value = $ds->row["property_value"];
				}
	
				$sql = "select id from  " . PVS_DB_PREFIX .
					"media order by id desc";
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$sql = "update " . PVS_DB_PREFIX . "administrators_stats set property_value=" .
						$dr->row["id"] . ",property_value_old=" .
						$property_value . ",property_value_count=" .
						$property_count . " where administrator_id=" . $user_id . " and property='" .
						$ds->row["property"] . "'";
					$db->execute( $sql );
				}
			}
	
			$ds->movenext();
		}
	}
}





/**
 * Get notification value for admin panel
 *
 * @param string $property key.
 * @param string $field count or value.
 * @return string $property_value
 */
function pvs_get_admin_notifications( $property, $field ) {
	global $ds;

	$property_value = '';
	
	$sql = "select property_value_old,property_value_count from " . PVS_DB_PREFIX .
			"administrators_stats where administrator_id=" . get_current_user_id() . " and property='" . $property . "'";
	$ds->open( $sql );
	if ( ! $ds->eof ) {
		if ( $field == 'value') {
			$property_value = $ds->row["property_value_old"];
		}
		if ( $field == 'count') {
			$property_value = $ds->row["property_value_count"];
		}
	}
	
	return $property_value;
}





/**
 * Profile page
 *
 */
function pvs_admin_default_page() {
  return pvs_get_page_url('profile');
}





/**
 * Signup page
 *
 */
function pvs_signup_default_page() {
  return pvs_get_page_url('signup');
}





/**
 * User token function
 *
 * @param  int $id user ID.
 * @return string
 */
function pvs_get_user_token($id, $salt = '') {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	global $table_prefix;
	$token = '';
	
	$sql="select user_pass, user_registered from " . $table_prefix . "users where ID = " . (int)$id;
	$dp->open($sql);
	if(!$dp->eof) {
		$token = substr( md5( $dp->row[ 'user_pass' ] . $dp->row[ 'user_registered' ] . $salt ), 0, 10 );
	}
	
	return $token;
}





/**
 * Template Functions
 *
 */





/**
 * The function gets social networks logins
 *
 * @return string
 */
function pvs_get_social_networks()
{
	global $pvs_global_settings;
	$social_result = '<div class="btn-group" role="group">';

	$socials = array();
	$socials['facebook'] = '<a href="' . site_url() .
		'/check-facebook/" class="btn btn-primary" style="margin:0px">Facebook</a>';
	$socials['twitter'] = '<a href="' . site_url().
		'/check-twitter/" class="btn btn-info" style="margin:0px">Twitter</a>';
	$socials['vkontakte'] = '<a href="' . site_url() .
		'/check-vk/" class="btn btn-primary" style="margin:0px">VK</a>';
	$socials['instagram'] = '<a href="' . site_url() .
		'/check-instagram/" class="btn btn-success" style="margin:0px">Instagram</a>';
	$socials['google'] = '<a href="' . site_url() .
		'/check-google/" class="btn btn-danger" style="margin:0px">Google</a>';
	$socials['yandex'] = '<a href="' . site_url() .
		'/check-yandex/" class="btn btn-warning" style="margin:0px"	>Yandex</a>';

	foreach ( $socials as $key => $value )
	{
		if ( @$pvs_global_settings['auth_' . $key] )
		{
			$social_result .= $value;
		}
	}

	$social_result .= '</div>';

	return $social_result;
}






/**
 * The function translates text
 *
 * @param  string $text_content text to transalte.
 * @return string
 */
function pvs_translate_text( $text_content )
{
	global $db;
	global $lng;
	global $m_lang;
	global $lang_name;

	//Make {lang.} translation
	preg_match_all( "|\{lang\.(.*)}|Uis", $text_content, $find_lang );
	$mass_words = array();
	$mass_code = array();
	foreach ( $find_lang as $key1 => $value1 )
	{
		foreach ( $value1 as $key2 => $value2 )
		{
			if ( $key1 == 0 )
			{
				$mass_code[] = $value2;
			} else
			{
				$mass_words[] = $value2;
			}
		}
	}
	for ( $t = 0; $t < count( $mass_words ); $t++ )
	{
		if ( isset( $m_lang[strtolower( $mass_words[$t] )] ) )
		{
			$text_content = str_replace( $mass_code[$t], $m_lang[strtolower( $mass_words[$t] )],
				$text_content );
		} elseif ( isset( $m_lang[$mass_words[$t]] ) )
		{
			$text_content = str_replace( $mass_code[$t], $m_lang[$mass_words[$t]], $text_content );
		} else
		{
			$text_content = str_replace( $mass_code[$t], $mass_words[$t], $text_content );
		}
	}
	//End. Make {lang.} translation

	$page_content = stripslashes( $text_content );

	$lng_search = $lng;

	if ( ! preg_match( "|\{if " . strtolower( $lng ) . "\}(.*)\{/if\}|Uis", $page_content ) )
	{
		$lng_search = "English";
	}

	foreach ( $lang_name as $key => $value )
	{
		$alang = array();
		$search_pattern = "|\{if " . strtolower( $key ) . "\}(.*)\{/if\}|Uis";
		preg_match_all( $search_pattern, $page_content, $alang );
		if ( isset( $alang[1][0] ) and isset( $alang[0][0] ) )
		{
			if ( $lng_search == $key )
			{
				for ( $t = 0; $t < 10; $t++ )
				{
					if ( isset( $alang[1][$t] ) )
					{
						$page_content = str_replace( "{if " . strtolower( $key ) . "}" . $alang[1][$t] .
							"{/if}", $alang[1][$t], $page_content );
					}
				}
			}
		}
		$page_content = preg_replace( $search_pattern, "", $page_content );

		unset( $alang );
	}

	return $page_content;
}






/**
 * The function shows captcha
 *
 * @return string
 */
function pvs_show_captcha()
{
	global $pvs_global_settings;

	$captcha_text = "";

	if ( $pvs_global_settings["google_captcha"] and ! $pvs_global_settings["google_recaptcha"] )
	{
		$captcha_text = recaptcha_get_html( $pvs_global_settings["google_captcha_public"] );
	}

	if ( preg_match( "/error/i", $captcha_text ) or ! $pvs_global_settings["google_captcha"] )
	{
		$rr = rand( 0, 9 );
		$captcha_text = "<img src='" .
			pvs_plugins_url() . "/assets/images/c" . $rr .
			".gif' width='80' height='30'>&nbsp;&nbsp;&nbsp;<input name='rn1' id='rn1' type='text' value='' class='ibox form-control' style='width:100px'><input name='rn2' id='rn2' type='hidden' value='" .
			$rr . "'><div id='error_rn1' name='error_rn1'></div>";
	} else
	{
		if ( $pvs_global_settings["google_recaptcha"] )
		{
			$captcha_text = "<script src='https://www.google.com/recaptcha/api.js'></script><div class='g-recaptcha' data-sitekey='" .
				$pvs_global_settings["google_captcha_public"] . "'></div>" . $captcha_text;
		} else
		{
			$captcha_text = "<script type='text/javascript'>var RecaptchaOptions = {theme : 'white'};</script>" .
				$captcha_text;
		}
	}

	return $captcha_text;
}






/**
 * The function checks captcha
 *
 * @return bool
 */
function pvs_check_captcha()
{
	global $pvs_global_settings;
	global $_POST;
	global $_SERVER;
	$captcha_result = false;

	if ( isset( $_POST["rn1"] ) and isset( $_POST["rn2"] ) )
	{
		$rn = array(
			"d3w5",
			"26wy",
			"g3z9",
			"a4n8",
			"7fq2",
			"5n6s",
			"g6mz",
			"6ct9",
			"v8z2",
			"b43j" );
		if ( $rn[( int )$_POST["rn2"]] == strtolower( $_POST["rn1"] ) )
		{
			$captcha_result = true;
		}
	} else
	{
		if ( ! $pvs_global_settings["google_recaptcha"] )
		{
			$resp = recaptcha_check_answer( $pvs_global_settings["google_captcha_private"],
				$_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"] );
			if ( $resp->is_valid )
			{
				$captcha_result = true;
			}
		} else
		{
			$captcha_data = array( 'secret' => $pvs_global_settings["google_captcha_private"],
					'response' => $_POST["g-recaptcha-response"] );

			$params = array(
				'body' => $captcha_data,
				'sslverify' => false,
				'timeout' => 60,
				'httpversion' => '1.1',
				'compress' => false,
				'decompress' => false
			);

			$result = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', $params);
			
			if ( ! is_wp_error( $result ) ) {
				$captcha_response2 = json_decode( $result["body"] );

				if ( $captcha_response2->success == true )
				{
					$captcha_result = true;
				}
			}
		}
	}

	return $captcha_result;
}






/**
 * The function builds duration like 00:00:00
 *
 * @param  int $duration time in seconds.
 * @return string
 */
function pvs_duration_format( $duration )
{
	$form_hours = floor( $duration / 3600 );
	$form_minutes = floor( ( $duration - $form_hours * 3600 ) / 60 );
	$form_seconds = $duration - $form_hours * 3600 - $form_minutes * 60;
	if ( $form_minutes < 10 )
	{
		$form_minutes = "0" . $form_minutes;
	}
	if ( $form_hours < 10 )
	{
		$form_hours = "0" . $form_hours;
	}
	if ( $form_seconds < 10 )
	{
		$form_seconds = "0" . $form_seconds;
	}
	return $form_hours . ":" . $form_minutes . ":" . $form_seconds;
}







/**
 * The function gets meta tags for Facebook and Twitter Like buttons
 *
 * @param  string $type.
 * @return string
 */
function pvs_get_social_meta_tags( $type ) {
	global $pvs_meta_tags;
	global $pvs_meta_description;
	global $pvs_meta_keywords;
	global $pvs_meta_keywords;
	global $pvs_pagename;
	global $pvs_path;

	if ($type == 'meta_tags') {
		return $pvs_meta_tags;
	}
	if ($type == 'meta_description') {
		return $pvs_meta_description;
	}
	if ($type == 'meta_keywords') {
		return $pvs_meta_keywords;
	}
	if ($type == 'pagename') {
		return $pvs_pagename;
	}
	if ($type == 'path') {
		return $pvs_path;
	}
}



/**
 * Get <ul> link path on publication page
 *
 * @param  int $otkuda publication ID.
 * @param  int $kuda catalog root ID.
 * @param  string $t_table database table.
 * @param  string $t_column database column.
 * @param  string $t_var not used now.
 * @param  string $t_file page URL.
 * @param  bool $t_show show root link.
 * @return string
 */
function pvs_get_title_path( $otkuda, $kuda, $t_table, $t_column, $t_var, $t_file, $t_show = false )
{
	global $ds;
	global $dn;
	global $pvs_global_settings;
	$navig = '';
	$navig2 = '';
	$t_perem = $kuda;
	$k = 0;
	while ( $t_perem != $otkuda )
	{
		if ( $k < 10 )
		{
			$sql = 'select ' . $t_column . ',id,id_parent from ' .
				PVS_DB_PREFIX . $t_table . ' where id=' . $t_perem;
			$ds->open( $sql );
			$translate_results = pvs_translate_category( $t_perem, $ds->row[$t_column], "",
				"" );

			$navig .= $translate_results['title'] . ' - ';
			
			$sql = "select id from " . PVS_DB_PREFIX . "category where id_parent=" . $t_perem;
			$dn->open( $sql );
			if ( ! $dn->eof ) {
				$url= site_url() . "/categories/?id=" . $t_perem;
			} else {
				$url = pvs_category_url( $t_perem );
			}
			
			/*
			if ( $t_perem == $kuda )
			{
				$navig2 = '<li class="last">' . $translate_results['title'] . '</li>' . $navig2;
			} else
			{
			*/
				$navig2 = '<li><a href="' . $url . '">' . $translate_results['title'] .
					'</a></li>' . $navig2;
			//}

			$t_perem = $ds->row['id_parent'];
		} else
		{
			$t_perem = $otkuda;
			$navig = '';
			$navig2 = '';
		}
		$k++;
	}

	if ( $navig2 == '' )
	{
		$navig2 = '<li>' . pvs_word_lang( 'catalog' ) . '</li>' . $navig2;
	} else
	{
		$navig2 = '<li><a href="' . pvs_catalog_url() . '">' . pvs_word_lang( 'catalog' ) . '</a></li>' . $navig2;		
	}

	if ( ! $t_show )
	{
		return $navig;
	} else
	{
		return $navig2;
	}
}






/**
 * Paging
 *
 * @param  string $r_rows numbers of items.
 * @param  string $r_page current page.
 * @param  string $r_kolvo1 items on the page.
 * @param  string $r_kolvo2 numbers of visible paging links 1,2,3,4,5.
 * @param  string $r_file page URL.
 * @param  string $r_perem vars list.
 * @param  bool $show_qty.
 * @param  bool $show_last_page.
 * @return string
 */
function pvs_paging( $r_rows, $r_page, $r_kolvo1, $r_kolvo2, $r_file, $r_perem,
	$show_qty = true, $show_last_page = true )
{
	$paging_content = "";
	$result_content = "";
	
	if ( ! preg_match('/\?/', $r_file)) {
		$r_file .= '?xpaging=1';
	}

	if ( $r_rows > 0 )
	{
		if ( $show_qty )
		{
			$result_content = "<b>" . pvs_word_lang( "results" ) . ":</b> " . $r_rows;
		}

		$predel = round( $r_rows / $r_kolvo1 );

		if ( $predel * $r_kolvo1 < $r_rows )
		{
			$predel++;
		}

		if ( $predel > 1 )
		{

			if ( $r_page > $r_kolvo2 )
			{
				$paging_content .= "<li class='page-item'><a href='" . $r_file . "&str=1" . $r_perem .
					"' class='page-link'>1</a></li>";
			}

			if ( $predel >= $r_page )
			{
				$predel2 = round( $predel / $r_kolvo2 );

				if ( $predel2 < $predel * $r_kolvo2 )
				{
					$predel2++;
				}

				for ( $p = 1; $p < $predel2 + 1; $p++ )
				{
					if ( ( $p - 1 ) * $r_kolvo2 < $r_page and $p * $r_kolvo2 >= $r_page )
					{
						if ( $r_page > 1 )
						{
							$paging_content .= "<li class='page-item'><a href='" . $r_file . "&str=" . ( $r_page - 1 ) . $r_perem .
								"' class='page-link'>&#171; " . pvs_word_lang( "previous" ) . "</a></li>";
						}

						for ( $s = ( $p - 1 ) * $r_kolvo2 + 1; $s < $p * $r_kolvo2 + 1; $s++ )
						{
							if ( $s <= $predel )
							{
								if ( $r_page == $s )
								{
									$paging_content .= "<li class='page-item active'><a class='page-link'>" . $r_page . "</a></li>";
								} else
								{
									$paging_content .= "<li class='page-item'><a href='" . $r_file . "&str=" . $s . $r_perem . "' class='page-link'>" .
										$s . "</a></li>";
								}
							}
						}

						if ( $r_page + 1 <= $predel )
						{
							$paging_content .= "<li class='page-item'><a href='" . $r_file . "&str=" . ( $r_page + 1 ) . $r_perem .
								"' class='page-link'>" . pvs_word_lang( "next" ) . " &#187;</a></li>";
						}
					}
				}

				if ( $r_page < ( $predel - $r_kolvo2 ) and $show_last_page )
				{
					$paging_content .= "<li class='page-item'><a href='" . $r_file . "&str=" . $predel . $r_perem .
						"' class='page-link'>" . $predel . "</a><li>";
				}
			}
		}

		if ( $paging_content != '' )
		{
			$paging_content = '<nav><ul class="pagination">' . $paging_content .
				'</ul></nav>';
		}
		return $result_content . $paging_content;
	}
}







/**
 * Build <select> categories menu - admin panel
 *
 * @param  int $t_id category ID.
 * @param  int $t_select current category ID.
 * @param  int $otstup left padding for nested subcategories.
 * @param  int $iid exclude category ID.
 * @return string
 */
function pvs_build_menu_admin( $t_id, $t_select, $otstup, $iid )
{
	global $db;
	global $dr;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	global $itg;
	global $nlimit;

	$sql = "select id, id_parent, title, priority from " . PVS_DB_PREFIX .
		"category where id_parent=" . $t_id . " order by priority,title";
	$dp->open( $sql );
	while ( ! $dp->eof )
	{
		if ( $nlimit < 1000 )
		{
			$sel = "";
			if ( $t_select == $dp->row["id"] )
			{
				$sel = "selected";
			}

			$otp = "";
			for ( $i = 0; $i < $otstup; $i++ )
			{
				$otp .= "&nbsp;&nbsp;";
			}

			$translate_results = pvs_translate_category( $dp->row["id"], $dp->row["title"],
				"", "" );

			if ( $dp->row["id"] != $iid )
			{
				$itg .= "<option value='" . $dp->row["id"] . "' " . $sel . ">" . $otp . $translate_results["title"] .
					"</option>";
			}

			pvs_build_menu_admin( $dp->row["id"], $t_select, $otstup + 2, $iid );
		}
		$nlimit++;
		$dp->movenext();
	}
}






/**
 * Build <ul> categories tree menu
 *
 * @param  string $t_id category ID parent.
 * @param  string $regime admin or seller.
 * @param  string $category_prefix if there are different tree menus on the page.
 * @return string
 */
function pvs_build_menu_admin_tree( $t_id, $regime, $category_prefix = '' ) {
	global $db;
	global $itg;
	global $nlimit;
	global $category_ids;

	$dp = new TMySQLQuery;
	$dp->connection = $db;

	$dt = new TMySQLQuery;
	$dt->connection = $db;

	$nn = 0;
	if ( $regime == 'admin' ) {
		$sql = "select id, id_parent, title, priority, published, url, upload  from " . PVS_DB_PREFIX .
			"category where id_parent=" . $t_id .
			" and published=1 order by priority, title";
	} else {
		$sql = "select id, id_parent, title, priority, published, url, upload from " . PVS_DB_PREFIX .
			"category where id_parent=" . $t_id .
			" and published=1 and activation_date < " . pvs_get_time() .
			" and (expiration_date > " . pvs_get_time() .
			" or expiration_date = 0) order by priority,title";
	}
	$dp->open( $sql );
	if ( ! $dp->eof ) {
		while ( ! $dp->eof ) {
			$title = pvs_category_url( $dp->row["id"], $dp->row["url"] );

			$zp = false;
			if ( $regime == 'admin' )
			{
				$sql = "select id, id_parent, title, priority, published, url, upload from " . PVS_DB_PREFIX .
					"category where id_parent=" . $dp->row["id"] .
					" and published=1 order by priority, title";
			} else
			{
				$sql = "select id, id_parent, title, priority, published, url, upload from " . PVS_DB_PREFIX .
					"category where id_parent=" . $dp->row["id"] .
					" and published=1 and activation_date < " . pvs_get_time() .
					" and (expiration_date > " . pvs_get_time() .
					" or expiration_date = 0) order by priority, title";
			}
			$dt->open( $sql );
			if ( ! $dt->eof )
			{
				$zp = true;
			}

			if ( $nlimit < 10000 )
			{
				$translate_results = pvs_translate_category( $dp->row["id"], $dp->row["title"],
					"", "" );

				$ttl = addslashes( $translate_results["title"] );

				if ( $nn == 0 )
				{
					if ( $itg == '')
					{
						$itg .= "<ul id='categories_tree_menu' class='categories_tree_menu'>";
					} else
					{
						$itg .= "<ul>";
					}
				}

				$checked = '';
				if ( isset( $category_ids[$dp->row["id"]] ) )
				{
					$checked = 'checked';
				}

				$upload_readonly = '';
				if ( $dp->row["upload"] == 1 or $regime == 'admin' )
				{
					$upload_readonly = "<input type='checkbox' name='" . $category_prefix . "category" . $dp->row["id"] .
						"' value='1' " . $checked . ">";
				}

				$itg .= "<li><span>" . $upload_readonly . " " . $ttl . "</span>";
				if ( ! $zp )
				{
					$itg .= "</li>";
				}
				pvs_build_menu_admin_tree( $dp->row["id"], $regime, $category_prefix );
				if ( $zp )
				{
					$itg .= "</li>";
				}
			}
			$nlimit++;
			$nn++;
			$dp->movenext();
		}
		$itg .= "</ul>";
	}
}





/**
 * Build categories upload menu - /filemanager-categories/
 *
 * @param  int $t_id category ID.
 * @param  int $t_select current category ID.
 * @param  int $otstup left padding for nested subcategories.
 * @return string
 */
function pvs_build_menu_seller_upload( $t_id, $t_select, $otstup)
{
	global $db;
	global $dr;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	global $itg;
	global $nlimit;

	$sql = "select id, id_parent, title, upload from " . PVS_DB_PREFIX . "category where id_parent=" . $t_id . " order by priority, title";
	$dp->open( $sql );
	while ( ! $dp->eof )
	{
		if ( $nlimit < 1000 )
		{
			$sel = "";
			if ( $t_select == $dp->row["id"] )
			{
				$sel = "selected";
			}

			$otp = "";
			$fnt = 17;
			for ( $i = 0; $i < $otstup; $i++ )
			{
				$otp .= "&nbsp;&nbsp;";
				$fnt--;
			}

			$translate_results = pvs_translate_category( $dp->row["id"], $dp->row["title"],
				"", "" );

			$style = "style='font:" . $fnt . "px Arial'";
			$style = "";

			if ( $dp->row["upload"] == 1 )
			{
				$itg .= "<option class='upload_ok' value='" . $dp->row["id"] . "' " . $sel . " " .
					$style . ">" . $otp . $translate_results["title"] . "</option>";
			} else
			{
				$itg .= "<option class='upload_error' value='' " . $sel . " " . $style . ">" . $otp .
					$translate_results["title"] . "</option>";
			}

			pvs_build_menu_seller_upload( $dp->row["id"], $t_select, $otstup + 2);
		}
		$nlimit++;
		$dp->movenext();
	}
}





/**
 * Build <ul> categories menu
 *
 * @param  int $t_id category ID.
 * @return string
 */
function pvs_build_menu_categories( $t_id )
{
	global $db;
	global $dr;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	global $itg;
	global $nlimit;
	$nn = 0;
	$sql = "select  id id_parent, title, priority, published , url from " . PVS_DB_PREFIX .
		"category where id_parent=" . $t_id . " and published=1 order by priority, title";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		while ( ! $dp->eof )
		{
			$title = pvs_category_url( $dp->row["id"], $dp->row["url"] );

			$zp = false;
			$sql = "select  id id_parent, title, priority, published , url from " . PVS_DB_PREFIX . "category where id_parent=" . $dp->row["id"] . " and published=1 order by priority, title";
			$dr->open( $sql );
			if ( ! $dr->eof )
			{
				$zp = true;
			}
			/*
			$zpn=0;
			$sql="select count(id) as count_id from " . PVS_DB_PREFIX . "category where id_parent=".$dp->row["id"]." group by id_parent";
			$dr->open($sql);
			if(!$dr->eof)
			{
			$zpn=$dr->row["count_id"];
			}
			*/

			if ( $nlimit < 10000 )
			{
				$translate_results = pvs_translate_category( $dp->row["id"], $dp->row["title"],
					"", "" );

				$ttl = addslashes( $translate_results["title"] );
				//if($zpn!=0 and $zp){$ttl.=" (".$zpn.")";}

				if ( $nn == 0 )
				{
					$itg .= "<ul>\n";
				}
				//if($nn==0){$itg.="<ul class='dropdown-menu'>\n";}

				$class_dropdown = "";
				$class_dropdown2 = "";

				if ( $zp )
				{
					//$class_dropdown = ' class="dropdown"';
					//$class_dropdown2 = ' class="dropdown-toggle" data-toggle="dropdown"';
				}

				$itg .= "<li " . $class_dropdown . "><a href=\"" . pvs_category_url( $dp->row["id"],
					$dp->row["url"] ) . "\" title=\"" . $ttl . "\" " . $class_dropdown2 . ">" . $ttl .
					"</a>\n";
				if ( ! $zp )
				{
					$itg .= "</li>";
				}
				pvs_build_menu_categories( $dp->row["id"] );
				if ( $zp )
				{
					$itg .= "</li>";
				}
			}
			$nlimit++;
			$nn++;
			$dp->movenext();
		}
		$itg .= "</ul>\n";
	}
}




/**
 * Show home page photo set. DEPRECATED. It will be removed in the new versions.
 *
 * @param  int $component_id component ID.
 * @return string
 */
function pvs_show_homepage_component( $component_id ) {
	global $rs;
	global $ds;
	global $dn;
	global $pvs_theme_content;
	global $lng;
	global $pvs_global_settings;

	$component_body = "";
	$flag_category = false;
	$flag_print = false;


	$sql = "select id, title, content, quantity, types, category, user, template from " .
		PVS_DB_PREFIX . "components where id=" . ( int )$component_id;
	$rs->open( $sql );
	if ( ! $rs->eof ) {

		if ( ! $pvs_global_settings["elasticsearch"] or ! $pvs_global_settings["elasticsearch_home"] or preg_match( "/category/", $rs->row["content"] ) or pvs_get_password_protected() != '' ) {
			if ( preg_match( "/photo/", $rs->row["content"] ) or preg_match( "/print/", $rs->
				row["content"] ) )
			{
				$sql = "select id,title,description,author,server1,url,free,data,featured from " .
					PVS_DB_PREFIX . "media b where media_id = 1 and published=1";
			}
	
			if ( preg_match( "/video/", $rs->row["content"] ) )
			{
				$sql = "select id,title,description,author,server1,url,free,data,featured from " .
					PVS_DB_PREFIX . "media b where media_id = 2 and published=1";
			}
	
			if ( preg_match( "/audio/", $rs->row["content"] ) )
			{
				$sql = "select id,title,description,author,server1,url,free,data,featured from " .
					PVS_DB_PREFIX . "media b where media_id = 3 and published=1";
			}
	
			if ( preg_match( "/vector/", $rs->row["content"] ) )
			{
				$sql = "select id,title,description,author,server1,url,free,data,featured from " .
					PVS_DB_PREFIX . "media b where media_id = 4 and published=1";
			}
	
			if ( preg_match( "/category/", $rs->row["content"] ) )
			{
				$sql = "select id,id_parent,title,description,userid,url,featured,photo from " . PVS_DB_PREFIX .
					"category b where published=1 and password=''  and activation_date < " .
					pvs_get_time() . " and (expiration_date > " . pvs_get_time() .
					" or expiration_date = 0)";
	
				$flag_category = true;
			}
	
			$password_protected = pvs_get_password_protected();
	
			if ( $rs->row["category"] != 0 )
			{
				if ( $flag_category )
				{
					$sql .= " and id_parent=" . $rs->row["category"];
				} else
				{
					$itg = "";
					//$nlimit = 0;
					//pvs_build_subcategories_query( $rs->row["category"] );
					
					
					$sql .= " and id in (select publication_id from " . PVS_DB_PREFIX .
						"category_items where category_id=" . $rs->row["category"]  . $itg . ") ";
	
					if ( $password_protected != '' )
					{
						$sql .= " and id not in (select publication_id from " . PVS_DB_PREFIX .
							"category_items where " . $password_protected . ") ";
					}
				}
			} else
			{
				if ( ! $flag_category and $password_protected != '' )
				{
					$sql .= " and (id not in (select publication_id from " . PVS_DB_PREFIX .
						"category_items where " . $password_protected . ")) ";
				}
			}
	
			if ( $rs->row["user"] != "" )
			{
				if ( $flag_category )
				{
					$sql .= " and userid=" . pvs_user_login_to_id( $rs->row["user"] );
				} else
				{
					$sql .= " and author='" . $rs->row["user"] . "'";
				}
			}
	
			if ( $rs->row["types"] == "featured" )
			{
				$sql .= " and featured=1";
			}
	
			if ( $rs->row["types"] == "free" and ! $flag_category )
			{
				$sql .= " and free=1";
			}
	
			if ( ! $flag_category )
			{
				if ( $rs->row["types"] == "new" )
				{
					$sql .= " order by data desc";
				}
				if ( $rs->row["types"] == "popular" )
				{
					$sql .= " order by viewed desc";
				}
				if ( $rs->row["types"] == "downloaded" or $rs->row["types"] == "featured" or $rs->
					row["types"] == "free" )
				{
					$sql .= " order by downloaded desc";
				}
			} else
			{
				if ( $rs->row["types"] == "new" )
				{
					$sql .= " order by creation_date desc";
				} else
				{
					$sql .= " order by priority";
				}
			}
	
			$limit_random = "";
	
			if ( $rs->row["types"] == "random" and ! $flag_category )
			{
				$count_random = 0;
				$sql_random = "";
				if ( $password_protected != "" or $rs->row["category"] != 0 )
				{
					$sql_random = str_replace( "id,id_parent,title,description,author,server1,url,free",
						" count(*) as count_rows ", $sql );
				} else
				{
					$sql_random = str_replace( "id,title,description,author,server1,url,free",
						" count(*) as count_rows ", $sql );
				}
				$ds->open( $sql_random );
				if ( ! $ds->eof )
				{
					$count_random = $ds->row["count_rows"];
					$rnd = rand( 0, $count_random );
					if ( $count_random - $rnd < $rs->row["quantity"] )
					{
						$rnd = $count_random - $rs->row["quantity"];
						if ( $rnd < 0 )
						{
							$rnd = 0;
						}
					}
					$limit_random = " limit " . $rnd . "," . $rs->row["quantity"];
				}
			}
	
			if ( $limit_random != "" )
			{
				$sql .= $limit_random;
			} else
			{
				$sql .= " limit 0," . $rs->row["quantity"];
			}
			$ds->open( $sql );
			while ( ! $ds->eof )
			{
				if ( preg_match( "/photo/", $rs->row["content"] ) or preg_match( "/print/", $rs->
					row["content"] ) )
				{
					$ttt = 1;
					if ( preg_match( "/2/", $rs->row["content"] ) or preg_match( "/print/", $rs->
						row["content"] ) )
					{
						$ttt = 2;
					}
					$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "photo", $ttt, 1, $ds->row["server1"],
						$ds->row["id"] );
	
					$stype = "photo";
				} elseif ( preg_match( "/vector/", $rs->row["content"] ) )
				{
					$ttt = 1;
					if ( preg_match( "/2/", $rs->row["content"] ) )
					{
						$ttt = 2;
					}
					$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "vector", $ttt, 1, $ds->row["server1"],
						$ds->row["id"] );
	
					$stype = "vector";
				} elseif ( preg_match( "/video/", $rs->row["content"] ) )
				{
					$ttt = 1;
					if ( preg_match( "/2/", $rs->row["content"] ) )
					{
						$ttt = 3;
					}
					$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "video", $ttt, 1, $ds->row["server1"],
						$ds->row["id"] );
	
					$stype = "video";
				} elseif ( preg_match( "/audio/", $rs->row["content"] ) )
				{
					$ttt = 1;
					if ( preg_match( "/2/", $rs->row["content"] ) )
					{
						$ttt = 3;
					}
					$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "audio", $ttt, 1, $ds->row["server1"],
						$ds->row["id"] );
	
					$stype = "audio";
				} else
				{
					$stype = "category";
				}
	
				$translate_results = pvs_translate_publication( $ds->row["id"], $ds->row["title"], $ds->row["description"], "" );
				$pvs_theme_content[ 'home_title' ] = $translate_results[ 'title' ];
				$pvs_theme_content[ 'home_description' ] = $translate_results[ 'description' ];
				$pvs_theme_content[ 'home_id' ] = $ds->row["id"];
				$pvs_theme_content[ 'component_id' ] = $component_id;
	
				if ( ! $flag_category )
				{
					if ( $ds->row["data"] + 3600 * 24 * 7 > pvs_get_time( date( "H" ), date( "i" ),
						date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) )
					{
						$flag_new = true;
					} else
					{
						$flag_new = false;
					}
				} else
				{
					$flag_new = false;
				}
				$pvs_theme_content[ 'home_flag_new' ] = $flag_new;
				$pvs_theme_content[ 'home_flag_category' ] = $flag_category;
				
				$count_id = 0;
				$flag_sub = false;
	
				if ( ! $flag_category )
				{
					$hoverbox_results = pvs_get_hoverbox( $ds->row["id"], $stype, $ds->row["server1"],
						$ds->row["title"], pvs_show_user_name( $ds->row["author"] ) );
	
					if ( ! preg_match( "/print/", $rs->row["content"] ) )
					{
						$pvs_theme_content[ 'home_lightbox' ] = $hoverbox_results["hover"];
						$pvs_theme_content[ 'home_url' ] = pvs_item_url( $ds->row["id"], $ds->row["url"] );
						$pvs_theme_content[ 'home_width' ] = $hoverbox_results["flow_width"];
						$pvs_theme_content[ 'home_height' ] = $hoverbox_results["flow_height"];
					} else
					{
						$pvs_theme_content[ 'home_lightbox' ] = '';
						$print_id_component = str_replace( "print", "", $rs->row["content"] );
						$print = pvs_show_print_preview( $ds->row["id"], $print_id_component );
						$print_info = pvs_get_print_preview_info( ( int )$print_id_component );
						$pvs_theme_content[ 'home_url' ] = pvs_print_url( $ds->row["id"], $print_id_component, $ds->row["title"], $print_info["preview"], "" );
						$pvs_theme_content[ 'home_flag_print' ] = true;
					}
					
					$pvs_theme_content[ 'home_flag_free' ] = $ds->row["free"];
					$pvs_theme_content[ 'home_flag_featured' ] = $ds->row["featured"];
				} else
				{
					$count_id = pvs_count_files_in_category( $ds->row["id"] );
					
					$category_result = pvs_show_category_preview($ds->row["id"]);
					$pvs_theme_content[ 'home_photo' ] = $category_result["photo"];
					$pvs_theme_content[ 'home_width' ] = $category_result["width"];
					$pvs_theme_content[ 'home_height' ] = $category_result["height"];
					
					
					$pvs_theme_content[ 'home_lightbox' ] = '';
					$pvs_theme_content[ 'home_url' ] = site_url() . $ds->row["url"];
					
					$pvs_theme_content[ 'home_flag_free' ] = false;
					$pvs_theme_content[ 'home_flag_featured' ] = false;
					
					$translate_results = pvs_translate_category( $ds->row["id"], $ds->row["title"], $ds->row["description"], "" );
					$pvs_theme_content[ 'home_title' ] = $translate_results[ 'title' ];
					if($count_id != 0 ) {
						$pvs_theme_content[ 'home_title' ] .= ' (' . $count_id . ')';
					}
					
					$sql = "select id from " . PVS_DB_PREFIX . "category where id_parent=" . $ds->row["id"];
					$dn->open( $sql );
					if ( ! $dn->eof )
					{
						$flag_sub = true;
					}
				}
				
				
				$pvs_theme_content[ 'home_free_url' ] = '';
	
				if ( ! $flag_category )
				{
					if ( $ds->row["free"] == 1)
					{
						$sql = "select id from " . PVS_DB_PREFIX . "items where id_parent=" . $ds->row["id"] .
							" and shipped<>1 order by priority desc";
						$dn->open( $sql );
						if ( ! $dn->eof )
						{
							$pvs_theme_content[ 'home_free_url' ] = site_url() . "/count/?id=" . $dn->row["id"] . "&id_parent=" . $ds->row["id"] . "&type=" . $stype . "&server=" . $ds->row["server1"];
						}
					}
				}
	
				
				
				if ( file_exists ( get_stylesheet_directory(). '/item_home.php' ) ) {
					$box = get_template_directory() . "/item_home.php";
				} else {
					if ( file_exists ( PVS_PATH . 'templates/item_home.php' ) ) {
						$box = PVS_PATH . 'templates/item_home.php';
					}
				}
				
				if ( $rs->row["template"] == 2 and file_exists( PVS_PATH . "templates/item_home2.php"  ) )
				{
					$box = PVS_PATH . "templates/item_home2.php";
				}
	
				if ( $rs->row["template"] == 2 and file_exists( get_template_directory() . "/item_home2.php"  ) )
				{
					$box = get_template_directory() . "/item_home2.php";
				}
				
				if ( $rs->row["template"] == 3 and file_exists( PVS_PATH . "templates/item_home3.php"  ) )
				{
					$box = PVS_PATH . "templates/item_home3.php";
				}
		
				if ( $rs->row["template"] == 3 and file_exists( get_template_directory() . "/item_home3.php"  ) )
				{
					$box = get_template_directory() . "/item_home3.php";
				}
				
				if ( ! $flag_category or ($flag_category and !$flag_sub and $count_id>0) ) {
					include($box);
				}
	
				$ds->movenext();
			}
		} else {
			$params = array();
			
			$params["_source"] = false;
						
			$filters = array();
			
			if ( preg_match( "/photo/", $rs->row["content"] ) or preg_match( "/print/", $rs->
				row["content"] ) )
			{
				$filters[] = array("term" => array("media_id" => 1));
			}
	
			if ( preg_match( "/video/", $rs->row["content"] ) )
			{
				$filters[] = array("term" => array("media_id" => 2));
			}
	
			if ( preg_match( "/audio/", $rs->row["content"] ) )
			{
				$filters[] = array("term" => array("media_id" => 3));
			}
	
			if ( preg_match( "/vector/", $rs->row["content"] ) )
			{
				$filters[] = array("term" => array("media_id" => 4));
			}		
			
			if ( $rs->row["category"] != 0 )
			{
				$filters[] = array("term" => array("categories" => $rs->row["category"]));
			}
			
			if ( $rs->row["user"] != "" )
			{
				$filters[] = array("term" => array("author" => $rs->row["user"]));
			}
			
			if ( $rs->row["types"] == "featured" )
			{
				$filters[] = array("term" => array("featured" => 1));
			}
	
			if ( $rs->row["types"] == "free")
			{
				$filters[] = array("term" => array("free" => 1));
			}
	
			if ( $rs->row["types"] == "new" )
			{
				$params["sort"] = array("data" => "desc");
			}
			if ( $rs->row["types"] == "popular" )
			{
				$params["sort"] = array("viewed" => array("order" => "desc"));
			}
			if ( $rs->row["types"] == "downloaded" or $rs->row["types"] == "featured" or $rs->
				row["types"] == "free" )
			{
				$params["sort"] = array("downloaded" => "desc");
			}
			
			if ( $rs->row["types"] == "random")
			{
				//$params["sort"] = array("data" => "asc");


				
				$params["query"] = array("function_score" => array( "query" => array("match_all" =>array()),
																								"random_score" => array("seed" => 1376773391128418000)
																					)
												);
												

			}
			
			$params["query"] = array("bool" => array("must" => array(),
																   "filter" => $filters			
																   )
										);
			
			$params["size"] = $rs->row["quantity"];
			$params["from"] = 0;
			
			//Published
			$filters[] = array("term" => array("published" => 1));		
			
			$data_json = json_encode($params);



			$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"] . "/_doc/_search?pretty";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response  = json_decode(curl_exec($ch));
			curl_close($ch);

			if ( @$response->hits->total->value > 0) {
				foreach ( @$response->hits->hits as $key => $value ) {
					$sql = "select id,media_id,title,data,published,description,viewed,keywords,rating as arating,downloaded,free,author,server1,url,rights_managed,featured from " . PVS_DB_PREFIX . "media where id=" . @$value->_id;
					$ds->open( $sql );
					if ( ! $ds->eof )
					{
						if ( preg_match( "/photo/", $rs->row["content"] ) or preg_match( "/print/", $rs->
							row["content"] ) )
						{
							$ttt = 1;
							if ( preg_match( "/2/", $rs->row["content"] ) or preg_match( "/print/", $rs->
								row["content"] ) )
							{
								$ttt = 2;
							}
							$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "photo", $ttt, 1, $ds->row["server1"],
								$ds->row["id"] );
			
							$stype = "photo";
						} elseif ( preg_match( "/vector/", $rs->row["content"] ) )
						{
							$ttt = 1;
							if ( preg_match( "/2/", $rs->row["content"] ) )
							{
								$ttt = 2;
							}
							$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "vector", $ttt, 1, $ds->row["server1"],
								$ds->row["id"] );
			
							$stype = "vector";
						} elseif ( preg_match( "/video/", $rs->row["content"] ) )
						{
							$ttt = 1;
							if ( preg_match( "/2/", $rs->row["content"] ) )
							{
								$ttt = 3;
							}
							$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "video", $ttt, 1, $ds->row["server1"],
								$ds->row["id"] );
			
							$stype = "video";
						} elseif ( preg_match( "/audio/", $rs->row["content"] ) )
						{
							$ttt = 1;
							if ( preg_match( "/2/", $rs->row["content"] ) )
							{
								$ttt = 3;
							}
							$pvs_theme_content[ 'home_photo' ] = pvs_show_preview( $ds->row["id"], "audio", $ttt, 1, $ds->row["server1"],
								$ds->row["id"] );
			
							$stype = "audio";
						} else
						{
							$stype = "category";
						}
			
						$translate_results = pvs_translate_publication( $ds->row["id"], $ds->row["title"], $ds->row["description"], "" );
						$pvs_theme_content[ 'home_title' ] = $translate_results[ 'title' ];
						$pvs_theme_content[ 'home_description' ] = $translate_results[ 'description' ];
						$pvs_theme_content[ 'home_id' ] = $ds->row["id"];
						$pvs_theme_content[ 'component_id' ] = $component_id;
			
						if ( ! $flag_category )
						{
							if ( $ds->row["data"] + 3600 * 24 * 7 > pvs_get_time( date( "H" ), date( "i" ),
								date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) )
							{
								$flag_new = true;
							} else
							{
								$flag_new = false;
							}
						} else
						{
							$flag_new = false;
						}
						$pvs_theme_content[ 'home_flag_new' ] = $flag_new;
						$pvs_theme_content[ 'home_flag_category' ] = $flag_category;
			
						if ( ! $flag_category )
						{
							$hoverbox_results = pvs_get_hoverbox( $ds->row["id"], $stype, $ds->row["server1"],
								$ds->row["title"], pvs_show_user_name( $ds->row["author"] ) );
			
							if ( ! preg_match( "/print/", $rs->row["content"] ) )
							{
								$pvs_theme_content[ 'home_lightbox' ] = $hoverbox_results["hover"];
								$pvs_theme_content[ 'home_url' ] = pvs_item_url( $ds->row["id"], $ds->row["url"] );
								$pvs_theme_content[ 'home_width' ] = $hoverbox_results["flow_width"];
								$pvs_theme_content[ 'home_height' ] = $hoverbox_results["flow_height"];
							} else
							{
								$pvs_theme_content[ 'home_lightbox' ] = '';
								$print_id_component = str_replace( "print", "", $rs->row["content"] );
								$print = pvs_show_print_preview( $ds->row["id"], $print_id_component );
								$print_info = pvs_get_print_preview_info( ( int )$print_id_component );
								$pvs_theme_content[ 'home_url' ] = pvs_print_url( $ds->row["id"], $print_id_component, $ds->row["title"], $print_info["preview"], "" );
								$pvs_theme_content[ 'home_flag_print' ] = true;
							}
							
							$pvs_theme_content[ 'home_flag_free' ] = $ds->row["free"];
							$pvs_theme_content[ 'home_flag_featured' ] = $ds->row["featured"];
						} else
						{
							$pvs_theme_content[ 'home_photo' ] = pvs_plugins_url() . "/assets/images/e.gif";
							$pvs_theme_content[ 'home_width' ] = $pvs_global_settings["category_preview"];
							$pvs_theme_content[ 'home_height' ] = 0;
							if ( $ds->row["photo"] != "" )
							{
								$pvs_theme_content[ 'home_photo' ] = pvs_upload_dir('baseurl') . $ds->row["photo"];
								if ( file_exists ( pvs_upload_dir() . $ds->row["photo"] ) )
								{
									$size = getimagesize( pvs_upload_dir() . $ds->row["photo"] );
									$pvs_theme_content[ 'home_width' ] = $size[0];
									$pvs_theme_content[ 'home_height' ] = $size[1];
								}
							}
							$pvs_theme_content[ 'home_lightbox' ] = '';
							$pvs_theme_content[ 'home_url' ] = site_url() . $ds->row["url"];
							
							$pvs_theme_content[ 'home_flag_free' ] = false;
							$pvs_theme_content[ 'home_flag_featured' ] = false;
						}
						
						
						$pvs_theme_content[ 'home_free_url' ] = '';
			
						if ( ! $flag_category )
						{
							if ( $ds->row["free"] == 1)
							{
								$sql = "select id from " . PVS_DB_PREFIX . "items where id_parent=" . $ds->row["id"] .
									" and shipped<>1 order by priority desc";
								$dn->open( $sql );
								if ( ! $dn->eof )
								{
									$pvs_theme_content[ 'home_free_url' ] = site_url() . "/count/?id=" . $dn->row["id"] . "&id_parent=" . $ds->row["id"] . "&type=" . $stype . "&server=" . $ds->row["server1"];
								}
							}
						}
			
						
						
						if ( file_exists ( get_stylesheet_directory(). '/item_home.php' ) ) {
							$box = get_template_directory() . "/item_home.php";
						} else {
							if ( file_exists ( PVS_PATH . 'templates/item_home.php' ) ) {
								$box = PVS_PATH . 'templates/item_home.php';
							}
						}
						
						if ( $rs->row["template"] == 2 and file_exists( PVS_PATH . "templates/item_home2.php"  ) )
						{
							$box = PVS_PATH . "templates/item_home2.php";
						}
			
						if ( $rs->row["template"] == 2 and file_exists( get_template_directory() . "/item_home2.php"  ) )
						{
							$box = get_template_directory() . "/item_home2.php";
						}
						
						if ( $rs->row["template"] == 3 and file_exists( PVS_PATH . "templates/item_home3.php"  ) )
						{
							$box = PVS_PATH . "templates/item_home3.php";
						}
				
						if ( $rs->row["template"] == 3 and file_exists( get_template_directory() . "/item_home3.php"  ) )
						{
							$box = get_template_directory() . "/item_home3.php";
						}
						
						include($box);
					}
				}
			}
		}
	}

	if ( $flag_print ) {
		$component_body .= "<link href='" . pvs_plugins_url() .
			"/templates/prints/style.css' rel='stylesheet'>";
	}

	return $component_body;
}





/**
 * The function formats a date in '2 hours ago' style.
 *
 * @param  int $time_ago time in seconds.
 * @return string
 */
function pvs_show_time_ago( $time_ago )
{
	$cur_time = time();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed;
	$minutes = round( $time_elapsed / 60 );
	$hours = round( $time_elapsed / 3600 );
	$days = round( $time_elapsed / 86400 );
	$weeks = round( $time_elapsed / 604800 );
	$months = round( $time_elapsed / 2600640 );
	$years = round( $time_elapsed / 31207680 );
	// Seconds
	if ( $seconds <= 60 )
	{
		return "just now";
	}
	//Minutes
	else
		if ( $minutes <= 60 )
		{
			if ( $minutes == 1 )
			{
				return pvs_word_lang( "one minute ago" );
			} else
			{
				return $minutes . " " . pvs_word_lang( "minutes ago" );
			}
		}
	//Hours
		else
			if ( $hours <= 24 )
			{
				if ( $hours == 1 )
				{
					return pvs_word_lang( "an hour ago" );
				} else
				{
					return $hours . " " . pvs_word_lang( "hours ago" );
				}
			}
	//Days
			else
				if ( $days <= 7 )
				{
					if ( $days == 1 )
					{
						return pvs_word_lang( "yesterday" );
					} else
					{
						return $days . " " . pvs_word_lang( "days ago" );
					}
				}
	//Weeks
				else
					if ( $weeks <= 4.3 )
					{
						if ( $weeks == 1 )
						{
							return pvs_word_lang( "a week ago" );
						} else
						{
							return $weeks . " " . pvs_word_lang( "weeks ago" );
						}
					}
	//Months
					else
						if ( $months <= 12 )
						{
							if ( $months == 1 )
							{
								return pvs_word_lang( "a month ago" );
							} else
							{
								return $months . " " . pvs_word_lang( "months ago" );
							}
						}
	//Years
						else
						{
							if ( $years == 1 )
							{
								return pvs_word_lang( "one year ago" );
							} else
							{
								//return $years." ". pvs_word_lang("years ago");
								return ( date( date_format, $time_ago ) );
							}
						}
}







/**
 * Payment page
 *
 * @param  string $type header or footer.
 * @param  bool $full_page simple or full payment page.
 * @return string
 */
function pvs_show_payment_page($type, $full_page = false) {
	global $pvs_theme_header;
	global $pvs_theme_footer;

	if ($type == 'header') {
		if ($full_page) {
			get_header(); 
			echo( @$pvs_theme_header );
		} else {
		echo( "<html><head><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"/></head><body onLoad=\"document.process.submit()\" bgcolor='#525151'><div style='margin:250px auto 0px auto;width:100px;background-color:#373737;border: #4a4a4a 4px solid;padding:20px;font: 15pt Arial;color:#ffffff'>" .
				pvs_word_lang( "loading" ) . "...<div><center><img src='" . pvs_plugins_url() .
				"/assets/images/upload_loading.gif'></center></div></div>" );
		}
	} else {
		if ($full_page) {
			echo( $pvs_theme_footer );
			get_footer(); 
		} else {
			echo( '</body></html>' );
		}
	}
}



/**
 * Search Functions
 *
 */



/**
 * The function builds all current search variables list
 *
 * @param  string $var_default exclude the var from the vars list.
 * @param  string $var_default2 exclude the var from the vars list.
 * @param  bool $show_phpfile show php file for the paging link.
 * @param  string $var_default3 exclude the var from the vars list.
 * @param  bool $ajax vars list for URL or for ajax request.
 * @return sring
 */
function pvs_build_variables( $var_default, $var_default2, $show_phpfile = true,
	$var_default3 = '', $ajax = false ) {
	global $_REQUEST;
	global $scripts_variables;
	global $atts;
	global $pvs_global_settings;
	
	$result_vars = "";
	$ajax_vars = "";
	for ( $i = 0; $i < count( $scripts_variables ); $i++ ) {
		if ( $scripts_variables[$i] != $var_default and $scripts_variables[$i] != $var_default2 and
			$scripts_variables[$i] != $var_default3 and isset( $_REQUEST[$scripts_variables[$i]] ) ) {
			if ( $result_vars != "" )
			{
				$result_vars .= "&";
			}

			if ( $ajax_vars != "" )
			{
				$ajax_vars .= ",";
			}

			$result_vars .= $scripts_variables[$i] . "=" . pvs_result( $_REQUEST[$scripts_variables[$i]] );
			$ajax_vars .= $scripts_variables[$i] . ":'" . pvs_result( $_REQUEST[$scripts_variables[$i]] ) .
				"'";
		}
	}
	if ( $result_vars == "" ) {
		$result_vars = "search=";
	}
	if ( $ajax == false ) {
		if ( $show_phpfile ) {
			if ( isset ( $atts[ 'url' ] ) ) {
				$redirect_page = $atts[ 'url' ] . "?" . $result_vars;
			} else {
				$redirect_page = pvs_catalog_url(true) . "?" . $result_vars;
			}
			return $redirect_page;
		} else {
			return "&" . $result_vars;
		}
	} else {
		return $ajax_vars;
	}
}






/**
 * Remove unnecessary words from the search query
 *
 * @param  string $str_remove search query.
 * @return string
 */
function pvs_remove_words( $str_remove )
{
	$rem_words = array(
		'and',
		'the',
		'with',
		'in',
		'at',
		'of',
		'above',
		'or',
		'a',
		'an',
		'while',
		'most',
		'more',
		'all',
		'not',
		'nor',
		'either',
		'neither',
		'should',
		'could',
		'has',
		'he',
		'she',
		'be',
		'off',
		'can',
		'this',
		'that',
		'if',
		'at',
		'is',
		'why',
		'how',
		'what',
		'when',
		'any',
		'etc',
		'e.t.c',
		'ish',
		'as',
		'which',
		'on',
		'i',
		'o',
		'e',
		'u' );

	foreach ( $rem_words as $key => $value )
	{
		$str_remove = preg_replace( "/\s" . $value . "\s/Uis", " ", $str_remove );
		$str_remove = preg_replace( "/^" . $value . "\s/Uis", "", $str_remove );
		$str_remove = preg_replace( "/\s" . $value . "$/Uis", "", $str_remove );
		$str_remove = preg_replace( "/\|" . $value . "\s/Uis", "|", $str_remove );
		$str_remove = preg_replace( "/\s" . $value . "\|/Uis", "|", $str_remove );
	}

	return $str_remove;
}






/**
 * Build sql query for the included subcategories
 *
 * @param  int $t_id category ID.
 * @return string
 */
function pvs_build_subcategories_query( $t_id )
{
	global $db;
	global $dr;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	global $itg;
	global $nlimit;

	$sql = "select  id, id_parent from " . PVS_DB_PREFIX . "category where id_parent=" . $t_id . " and published=1 and activation_date < " . pvs_get_time() .
		" and (expiration_date > " . pvs_get_time() . " or expiration_date = 0) order by priority, title";
	$dp->open( $sql );
	if ( ! $dp->eof )
	{
		while ( ! $dp->eof )
		{
			if ( $nlimit < 1000 )
			{
				$itg .= " or category_id=" . $dp->row["id"] . " ";
				pvs_build_subcategories_query( $dp->row["id"] );
			}
			$nlimit++;
			$dp->movenext();
		}
	}
}


/**
 * Return catalog URL
 *
 * @param  bool $no_vars add ?search=''.
 * @return string
 */
function pvs_catalog_url( $no_vars = false )
{
	global $pvs_global_settings;
	
	if ( $pvs_global_settings[ 'catalog_url' ] == '' ) {
		if ( $no_vars ) {
			return site_url() . '/index.php';
		} else {
			return site_url() . '/index.php?search=';
		}
	} else {
		return site_url() . $pvs_global_settings[ 'catalog_url' ];		
	}	
}


/**
 * Packages Functions
 *
 */
 
 
 
 /**
 * Package url
 *
 * @param  int $id package id.
 * @return string package URL
 */
function pvs_package_url( $id, $cart_content_id ) {
	$url = site_url() . "/my-package/?id=" . $id . "&cart_content_id=" . $cart_content_id;

	return $url;
}





/**
 * Show package preview
 *
 * @param  int $id Package ID.
 * @return array
 */
function pvs_show_package_preview($id) {
	global $pvs_global_settings;
	
	$package_result = array();
	
	$package_result["photo"] = pvs_plugins_url() . '/assets/images/package.gif';
	$package_result["width"] = @$pvs_global_settings["category_preview"];
	$package_result["height"] = 120;

	if ( file_exists(pvs_upload_dir() . "/content/categories/package_" . (int) $id . ".jpg") ) {
		$package_result["photo"] = pvs_upload_dir('baseurl'). "/content/categories/package_" . (int) $id . ".jpg";
		$size = getimagesize( pvs_upload_dir() . "/content/categories/package_" . (int) $id . ".jpg" );
		$package_result["width"] = $size[0];
		$package_result["height"] = $size[1];
	}
	
	return $package_result;
}


/**
 * Check if a file can be attached to the package
 *
 * @param  int $file_id File ID.
 * @param  int $package_id Package ID.
 * @return bool
 */
function pvs_check_package_file($file_id, $package_id) {
	global $pvs_global_settings;
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$flag = false;
	
	$sql = "select  category_id from " . PVS_DB_PREFIX . "category_items where publication_id = " . (int) $file_id;
	$dp->open( $sql );
	while ( ! $dp->eof ) {
		$sql = "select  id from " . PVS_DB_PREFIX . "packages_categories where category_id = " . $dp->row["category_id"] . " and package_id = " . (int) $package_id;
		$dt->open( $sql );
		if ( ! $dt->eof ) {
			$flag = true;
		}
		$dp->movenext();
	}
	
	$sql = "select  id from " . PVS_DB_PREFIX . "packages_categories";
	$dt->open( $sql );
	if ( $dt->eof ) {
		$flag = true;
	}
	
	return $flag;
}	


/**
 * Count files in package
 *
 * @param  int $package_id Package ID.
 * @param  int $cart_content_id Cart content ID.
 * @return string
 */
function pvs_count_files_in_package($package_id, $cart_content_id) {
	global $db;
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$count_files = 0;
	$count_files_filled = 0;
	
	$sql = "select file_id from " . PVS_DB_PREFIX . "packages_list where cart_content_id=" . (int) $cart_content_id . " and package_id=" . (int) $package_id;
	$dp->open($sql);
	while ( ! $dp->eof ) {
		if ( $dp->row["file_id"] != 0) {
			$count_files_filled ++;
		}
		$count_files ++;
		$dp->movenext();
	}
	
	$count = $count_files_filled . ' ' . pvs_word_lang( 'of' ) . ' ' . $count_files;
	
	if ( $count_files == $count_files_filled) {
		return '<span class="label label-success">' . $count . '</span>';
	} else {
		return '<span class="label label-danger">' . $count . '</span>';
	}
}	




/**
 * ElasticSearch Functions
 *
 */
 
 
 /**
 * Add/update index in ElasticSearch
 *
 * @param  int $id publication ID.
 * @return bool
 */
function pvs_elastic_add($id) {
	global $db;
	global $pvs_global_settings;
	
	$dp = new TMySQLQuery;
	$dp->connection = $db;
	
	$dt = new TMySQLQuery;
	$dt->connection = $db;
	
	$dx = new TMySQLQuery;
	$dx->connection = $db;
	
	$flag = false;
	
	$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"] . "/_doc/" . (int)$id . "?pretty";

	$sql = "select id, media_id, title, data, published, description, featured, keywords, author,viewed, userid, content_type, free, orientation, downloaded, rating, editorial, adult, rights_managed, contacts, exclusive, holder, source, format, duration, ratio, rendering, frames from " .
	PVS_DB_PREFIX . "media where id=" . (int)$id;
	$dp->open( $sql );
	if ( ! $dp->eof ) {
	
		$params["title"] = $dp->row["title"];
		$params["description"] = $dp->row["description"];
		
		$keywords = explode( ",", str_replace( ";", ",", $dp->row["keywords"] ) );
		for ( $i = 0; $i < count( $keywords ); $i++ )
		{
			$keywords[$i] = trim( $keywords[$i] );
		}
		$params["keywords"] = $keywords;
		
		$params["media_id"] = $dp->row["media_id"];
		$params["data"] = $dp->row["data"];
		$params["published"] = $dp->row["published"];
		$params["featured"] = $dp->row["featured"];
		$params["author"] = $dp->row["author"];
		$params["viewed"] = $dp->row["viewed"];
		$params["userid"] = $dp->row["userid"];
		$params["content_type"] = $dp->row["content_type"];
		$params["free"] = $dp->row["free"];
		$params["orientation"] = $dp->row["orientation"];
		$params["downloaded"] = $dp->row["downloaded"];
		$params["rating"] = $dp->row["rating"];
		$params["editorial"] = $dp->row["editorial"];
		$params["adult"] = $dp->row["adult"];
		$params["rights_managed"] = $dp->row["rights_managed"];
		$params["contacts"] = $dp->row["contacts"];
		$params["exclusive"] = $dp->row["exclusive"];
		$params["holder"] = $dp->row["holder"];		
		$params["source"] = $dp->row["source"];
		$params["format"] = $dp->row["format"];
		$params["duration"] = $dp->row["duration"];
		$params["ratio"] = $dp->row["ratio"];
		$params["rendering"] = $dp->row["rendering"];
		$params["frames"] = $dp->row["frames"];		
		
		$categories = array();
		$sql = "select category_id from " . PVS_DB_PREFIX . "category_items where publication_id=" . (int)$id;
		$dt->open( $sql );
		while (!$dt->eof) {
			$categories[] = $dt->row["category_id"];
			$dt->movenext();
		}
		$params["categories"] = $categories;	
		
		
		$colors = array();
		$sql = "select color from " . PVS_DB_PREFIX . "colors where publication_id=" . (int)$id;
		$dt->open( $sql );
		while (!$dt->eof) {
			$colors[] = $dt->row["color"];
			$dt->movenext();
		}
		$params["colors"] = $colors;	
		
		
		//var_dump($params);
	
		$data_json = json_encode($params);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = json_decode(curl_exec($ch));
		//var_dump($response);
		curl_close($ch);
		
		if ( @$response->result == 'created' ) {
			$sql = "insert into " . PVS_DB_PREFIX . "elasticsearch (publication_id,data,update_delete) values (" . (int)$id . "," . pvs_get_time() . ",0)";
			$db->execute($sql);
			
			$flag = true;
		}
		
		if ( @$response->result == 'updated' ) {
			$sql = "update " . PVS_DB_PREFIX . "elasticsearch set data=" . pvs_get_time() . ",update_delete=0 where publication_id = " . (int)$id;
			$db->execute($sql);
			
			$flag = true;
		}
	}
	
	return $flag;
}



 /**
 * Remove index from ElasticSearch
 *
 * @param  int $id publication ID.
 * @return bool
 */
function pvs_elastic_delete($id) {
	global $db;
	global $pvs_global_settings;
	
	$flag = false;
	
	$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"] . "/_doc/" . (int)$id;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response  = json_decode(curl_exec($ch));
	curl_close($ch);
	
	if ( @$response->result == 'deleted' ) {
		$sql = "delete from " . PVS_DB_PREFIX . "elasticsearch where publication_id=" . (int)$id;
		$db->execute($sql);
		
		$flag = true;
	}
	
	return $flag;
}


 /**
 * Update publication indexed in ElasticSearch
 *
 * @param  int $id publication ID.
 */
function pvs_elastic_update($id) {
	global $pvs_global_settings;
	global $db;
	
	if ( $pvs_global_settings["elasticsearch"]) {
		if ( $pvs_global_settings["elasticsearch_automatic"] ) {
			pvs_elastic_add($id);
		} else {
			$sql = "delete from " . PVS_DB_PREFIX . "elasticsearch where publication_id=" . (int)$id;
			$db->execute($sql);
		}
	}
}



 /**
 * Create index in ElasticSearch
 *
 * @return bool
 */
function pvs_elastic_create_index() {
	global $pvs_global_settings;
	global $db;
	
	$flag = false;
	
	if ( $pvs_global_settings["elasticsearch"]) {
		$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"];
		
		$data_json = '{
							   "settings": {
   								 "analysis": {
   									 "normalizer": {
										"custom_sort_normalizer": {
											"type": "custom",
											"char_filter": [],
											"filter": [
												"lowercase",
												"asciifolding"
											]
										}
									}
								  }
								},
							   "mappings": {
									   "properties": {
											"title": {
											   "type": "text"
											 },
											 "description": {
											   "type": "text"
											 },
											 "keywords": {
											   "type": "keyword",
    										   "normalizer": "custom_sort_normalizer"
											 },
											"media_id": {
											   "type": "integer"
											 },
											"data": {
											   "type": "integer",
											   "index":true
											 },
											"published": {
											   "type": "integer"
											 },
											 "featured": {
											   "type": "integer"
											 },
											 "author": {
											   "type": "keyword"
											 },		
											 "viewed": {
											   "type": "integer",
											   "index":true
											 },	
											 "userid": {
											   "type": "integer"
											 },		
											 "content_type": {
											   "type": "keyword"
											 },	
											 "free": {
											   "type": "integer"
											 },		
											 "orientation": {
											   "type": "integer"
											 },	
											 "downloaded": {
											   "type": "integer",
											   "index":true
											 },	
											 "rating": {
											   "type": "float",
											   "index":true
											 },	
											 "editorial": {
											   "type": "integer"
											 },	
											 "adult": {
											   "type": "integer"
											 },		
											 "rights_managed": {
											   "type": "integer"
											 },	
											 "contacts": {
											   "type": "integer"
											 },		
											 "exclusive": {
											   "type": "integer"
											 },									 
											 "holder": {
											   "type": "text"
											 },
											 "source": {
											   "type": "text"
											 },
											 "format": {
											   "type": "text"
											 },
											 "duration": {
											   "type": "integer"
											 },		
											 "ratio": {
											   "type": "text"
											 },
											 "rendering": {
											   "type": "text"
											 },	
											 "frames": {
											   "type": "text"
											 },
											 "categories": {
												"type" : "integer"
											},	
											  "colors": {
											 	"type" : "keyword"
											  }
										   }
									   }
							 }';
		//echo($data_json);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = json_decode(curl_exec($ch));
		//var_dump($response);
		
		if ( @$response->acknowledged ) {
			$flag = true;
		}
		curl_close($ch);
	}
	
	return $flag;
}



 /**
 * Remove all indexes from ElasticSearch
 *
 * @return bool
 */
function pvs_elastic_remove_all() {
	global $db;
	global $pvs_global_settings;
	
	$flag = false;
	
	$url = $pvs_global_settings["elasticsearch_url"] . "/" . $pvs_global_settings["elasticsearch_index"];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response  = json_decode(curl_exec($ch));
	curl_close($ch);
	
	if (@$response->acknowledged) {
		$sql = "delete from " . PVS_DB_PREFIX . "elasticsearch";
		$db->execute($sql);
		
		$flag = true;
	}
	
	return $flag;
}
?>