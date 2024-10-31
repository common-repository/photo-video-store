            
	<h1><?php echo($pvs_theme_content[ 'title' ]);?></h1>
	<ul class="path_corlate">
		<?php echo(pvs_get_social_meta_tags('path'));?>
	</ul>
	<div class="clearfix"></div>
    <div class="row">
    <div class="col-lg-6 col-md-6 panel_left2" style="min-width:500px">
        	<?php echo($pvs_theme_content[ 'preview' ]);?> 
        	<div class="file_links row">
        		<div class="col-lg-9 col-md-9 toleft">
        			<?php if ( $pvs_global_settings[ 'lightboxes' ]) {?>
						<button onClick="<?php echo($pvs_theme_content[ 'add_to_favorite_link2' ]);?>" class="btn btn-success btn-sm"><i class="fa fa-heart"> </i> <?php echo(pvs_word_lang("add to favorite"));?></button> 
					<?php }?>
					<?php if ($pvs_theme_content[ 'flag_downloadsample' ] ) {?>
						<button onClick="location.href='<?php echo($pvs_theme_content[ 'downloadsample' ]);?>'" class="btn btn-danger btn-sm"><i class="fa fa-download"> </i>  <?php echo(pvs_word_lang("Download Sample"));?></button>
					<?php }?>
				</div>
				<div class="col-lg-3 col-md-3 next_previous toleft">
					<?php if ($pvs_theme_content[ 'flag_previous' ] ) {?>
						<a href="<?php echo($pvs_theme_content[ 'previous_link' ]);?>" title="<?php echo(pvs_word_lang("Previous"));?>"><i class="fa fa-arrow-circle-left"></i></a>&nbsp;&nbsp;&nbsp;
					<?php }?>
					<?php if ($pvs_theme_content[ 'flag_next' ] ) {?>
						<a href="<?php echo($pvs_theme_content[ 'next_link' ]);?>" title="<?php echo(pvs_word_lang("Next"));?>"><i class="fa fa-arrow-circle-right"></i></a>
					<?php }?>
				</div>
			</div>
			<div class="clearfix"></div>	
			
			<div class='file_details'>
			<h3><?php echo(pvs_word_lang("Keywords"));?></h3>
			<?php echo($pvs_theme_content[ 'keywords_lite' ]);?>

			<br><br>
			<h3><?php echo(pvs_word_lang("File details"));?></h3>
			<span><b><?php echo(pvs_word_lang("Published"));?>:</b> <?php echo($pvs_theme_content[ 'published' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Rating"));?>:</b> <?php echo($pvs_theme_content[ 'item_rating_new' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Category"));?>:</b> <?php echo($pvs_theme_content[ 'category' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Viewed"));?>:</b> <?php echo($pvs_theme_content[ 'viewed' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Downloads"));?>:</b> <?php echo($pvs_theme_content[ 'downloads' ]);?></span>	
			<?php if ($pvs_theme_content[ 'flag_duration' ] ) {?>
				<span><b><?php echo(pvs_word_lang("Duration"));?>:</b> <?php echo($pvs_theme_content[ 'duration' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_format' ] ) {?>
				<span><b><?php echo(pvs_word_lang("clip format"));?>:</b> <?php echo($pvs_theme_content[ 'format' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_ratio' ] ) {?>
				<span><b><?php echo(pvs_word_lang("aspect ratio"));?>:</b> <?php echo($pvs_theme_content[ 'ratio' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_rendering' ] ) {?>
				<span><b><?php echo(pvs_word_lang("field rendering"));?>:</b> <?php echo($pvs_theme_content[ 'rendering' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_frames' ] ) {?>
				<span><b><?php echo(pvs_word_lang("frames per second"));?>:</b> <?php echo($pvs_theme_content[ 'frames' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_holder' ] ) {?>
				<span><b><?php echo(pvs_word_lang("Copyright holder"));?>:</b> <?php echo($pvs_theme_content[ 'holder' ]);?></span>
			<?php }?>
			<?php if ($pvs_theme_content[ 'flag_model' ] ) {?>
				<?php echo($pvs_theme_content[ 'model' ]);?>
			<?php }?>

		<br>	
		<h3><?php echo(pvs_word_lang("Share"));?></h3>
        <button onClick="location.href='http://www.facebook.com/sharer/sharer.php?s=100&p[title]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[summary]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[url]=<?php echo($pvs_theme_content[ 'share_url' ]);?>&&p[images][0]=<?php echo($pvs_theme_content[ 'share_image' ]);?>'" target="_blank" class="btn btn-md btn-default">&nbsp;<i  class="fa fa-facebook"></i></button>
        <button onClick="location.href='http://twitter.com/home?status=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>'" target="_blank" class="btn btn-md btn-primary">&nbsp;<i  class="fa fa-twitter"></i></button> 
        <button onClick="location.href='http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>'" target="_blank" class="btn btn-md btn-warning">&nbsp;<i  class="fa fa-google-plus"></i></button>
        <button onClick="location.href='http://pinterest.com/pin/create/button/?url=<?php echo($pvs_theme_content[ 'share_url' ]);?>&media=<?php echo($pvs_theme_content[ 'share_image' ]);?>&description=<?php echo($pvs_theme_content[ 'share_title' ]);?>'" target="_blank" class="btn btn-md btn-danger">&nbsp;<i  class="fa fa-pinterest"></i></button>
				
		</div>
    </div>   

    <div class="col-lg-6 col-md-6  panel_right2">
		<div class="row">
      	<div class="col-lg-4 col-md-4 col-sm-4 toleft"><?php echo($pvs_theme_content[ 'author' ]);?> </div>
       	<div class="col-lg-2 col-md-2 col-sm-2 toleft"><b>ID : <?php echo($pvs_theme_content[ 'id' ]);?></b></div>
       	<div class="col-lg-6 col-md-6 col-sm-6 toleft">
       		<div id="vote_dislike" class="dislike-btn dislike-h"><?php echo(pvs_word_lang("Dislike"));?> <?php echo($pvs_theme_content[ 'dislike' ]);?></div>
			<div id="vote_like" class="like-btn like-h"><?php echo(pvs_word_lang("Like"));?> <?php echo($pvs_theme_content[ 'like' ]);?></div>
       	</div>
       </div>
       <div class="clearfix"><br></div>
       <hr />
      	<?php if ($pvs_theme_content[ 'flag_editorial' ] ) {?>
			<div class="editorial"><?php echo(pvs_word_lang("files for editorial use only"));?></div>
		<?php }?>
		<?php if ($pvs_theme_content[ 'flag_exclusive' ] ) {?>
			<div class="editorial"><?php echo(pvs_word_lang("Exclusive price. The file will be removed from the stock after the purchase"));?></div>
		<?php }?>
		<div class="cart-actions">
			<div class="addto">
				<?php echo($pvs_theme_content[ 'sizes' ]);?>
			</div>
			
			<div style="clear:both"></div><br><br>
		</div>
   


      
        <ul  class="tabs" data-persist="true">
          <li class="active"><a href="#details"><?php echo(pvs_word_lang("Description"));?></a></li>
          <li><a href="#comments_content" onclick="reviews_show(<?php echo($pvs_theme_content[ 'id' ]);?>);"><?php echo(pvs_word_lang("Comments"));?></a></li>
          <li><a href="#tell_content"   onclick="tell_show(<?php echo($pvs_theme_content[ 'id' ]);?>);"><?php echo(pvs_word_lang("Tell a friend"));?></a></li>
          <li><a href="#reviewscontent"   onclick="map_show(<?php echo($pvs_theme_content[ 'google_x' ]);?>,<?php echo($pvs_theme_content[ 'google_y' ]);?>);"><?php echo(pvs_word_lang("Map"));?></a></li>
        </ul>

		<div class="tabcontents">
          <div id="details"><?php echo($pvs_theme_content[ 'description' ]);?></div>  
          <div id="comments_content"></div>
          <div id="tell_content"></div>
          <div id="reviewscontent"></div>          
		</div>

    
    </div>
    
  </div>
<?php if ($pvs_theme_content[ 'flag_related' ]) {?> 
	<h2><?php echo(pvs_word_lang("Related items"));?></h2>
	<hr />
	<div class="container-fluid ">
		<div class="row">
		<?php pvs_show_related_items( get_query_var('pvs_id'), "show" );?>
	</div> 
	</div>
	<br>
	<br>
<?php }?> 
