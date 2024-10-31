<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>

<form id='listing_form' method="get" action="<?php echo $redirect_page?>" style="margin:0px">

<div class="search_left_top"></div>
<div class="search_left_body">
	<div class="search_title"><?php echo pvs_word_lang( "search" )?></div>
	<div class="search_text">
	<?php
if ( ( int )@$_REQUEST["print_id"] > 0 and $pvs_global_settings["adobe_prints"] ) {
?>
		<div class="search_title2"><b><?php echo pvs_word_lang( "prints and products" )?>:</b></div>
		<div class="search_text2">
		<select name="print_id" class='ibox form-control' style="width:175px" >
		<option value="0"></option>
		<?php
	$prints_mass = array();

	$sql_prints = "select id from " . PVS_DB_PREFIX .
		"prints_categories where active=1 order by priority";
	$dr->open( $sql_prints );
	while ( ! $dr->eof ) {
		$prints_mass[] = $dr->row["id"];
		$dr->movenext();
	}
	$prints_mass[] = 0;

	foreach ( $prints_mass as $key => $value ) {
		$sql_prints = "select id_parent,title from " . PVS_DB_PREFIX .
			"prints where category=" . $value . " order by priority";
		$dd->open( $sql_prints );
		while ( ! $dd->eof ) {
			$chk = "";
			if ( @$_REQUEST["print_id"] == $dd->row["id_parent"] )
			{
				$chk = "selected";
			}
?>
		<option value="<?php
			echo $dd->row["id_parent"] ?>" <?php
			echo $chk
?>><?php
			echo pvs_word_lang( $dd->row["title"] )?></option>
	<?php
			$dd->movenext();
		}
	}
?>
		</select>
		</div>
	<?php
}
?>
	
		<div class="search_title2"><b><?php echo pvs_word_lang( "keywords" )?>:</b></div>
		<div class="search_text2">
			<input type='text' name='search' style="width:175px" class='ibox form-control' value='<?php echo pvs_result( @$_REQUEST["search"] )?>'>
		</div>
		
		<?php
if ( $pvs_global_settings["adobe_contributor"] == "" ) {
?>
		<div class="search_title2"><b><?php echo pvs_word_lang( "Creator" )?> ID:</b></div>
		<div class="search_text2">
			<input type='text' name='author' style="width:175px" class='ibox form-control' value='<?php
	if ( isset( $_REQUEST["author"] ) ) {
		echo ( pvs_result( $_REQUEST["author"] ) );
	}
?>'>
		</div>
		<?php
}
?>
	
		<div class="search_title2"><b><?php echo pvs_word_lang( "type" )?>:</b></div>
		<div class="search_text2">
			<select name="stock_type" style="width:175px" class='ibox form-control' onChange='change_stock_type(this.value)'>
			<?php
$list_stocktypes = array(
	"",
	"photo",
	"illustration",
	"vector",
	"video",
	"template",
	"3d");
foreach ( $list_stocktypes as $key => $value ) {
	$sel = "";
	if ( $value == @$_REQUEST["stock_type"] ) {
		$sel = "selected";
	}
?>
	<option value='<?php echo $value
?>' <?php echo $sel
?>><?php echo pvs_word_lang( $value )?></option>
	<?php
}
?>
			</select>
		</div>	
		
		<div class="search_title2"><b><?php echo pvs_word_lang( "categories" )?>:</b></div>
		<div class="search_text2">
		<?php
		$adobe_categories[1] = "Animals";
		$adobe_categories[96] = "Buildings and Architecture";
		$adobe_categories[167] = "Business";
		$adobe_categories[214] = "Drinks";
		$adobe_categories[240] = "The Environment";
		$adobe_categories[261] = "States of Mind";
		$adobe_categories[289] = "Food";
		$adobe_categories[444] = "Graphic Resources";
		$adobe_categories[498] = "Hobbies and Leisure";
		$adobe_categories[568] = "Industry";
		$adobe_categories[596] = "Landscapes";
		$adobe_categories[643] = "Lifestyle";
		$adobe_categories[695] = "People";
		$adobe_categories[782] = "Plants and Flowers";
		$adobe_categories[832] = "Culture and Religion";
		$adobe_categories[851] = "Science";
		$adobe_categories[888] = "Social Issues";
		$adobe_categories[922] = "Sports";
		$adobe_categories[981] = "Technology";
		$adobe_categories[1013] = "Transport";
		$adobe_categories[1043] = "Travel";
		$adobe_categories[1157] = "News";
		$adobe_categories[1155] = "Entertainment";
		$adobe_categories[1156] = "Sport News";
		?>
			<select name="category" style="width:175px" class='ibox form-control'>
	<option value='-1'></option>
	<?php
	foreach ( $adobe_categories as $key => $value ) {
		$sel = "";
		if (  isset( $_REQUEST["category"] ) and $_REQUEST["category"] == $key ) {
			$sel = "selected";
		}
	?>
			<option value="<?php echo $key ?>" <?php echo $sel
	?>><?php echo $value ?></option>
			<?php
	}
	?>
			</select>
		</div>	
		

		

		
		<div class="search_title2 field_language"><b><?php echo pvs_word_lang( "languages" )?>:</b></div>
		<div class="search_text2 field_language">
			<select name="language" style="width:200px" class='ibox form-control'>
			<?php

$list_language["pt_BR"] = "Brazilan Portuguese - Brazil";
$list_language["ca_EN"] = "English - Canada";
$list_language["fr_CA"] = "	French - Canada";
$list_language["es_MX"] = "Spanish - Mexico";
$list_language["en_US"] = "English - United States";
$list_language["be_EN"] = "English - Belgium";
$list_language["fr_BE	"] = "French - Belgium";
$list_language["nl_BE"] = "Dutch - Belgium";
$list_language["cs_CZ"] = "Czech - Czech Republic";
$list_language["cy_EN"] = "English - Cyprus";
$list_language["da_DK"] = "Danish - Danmark";
$list_language["de_DE"] = "German - Germany";
$list_language["en_EE"] = "English - Estonia";
$list_language["es_ES"] = "Spanish - Spain";
$list_language["fr_FR	"] = "French - France";
$list_language["fr_MA"] = "French - Marocco";
$list_language["gr_EN"] = "English - Greece";
$list_language["en_IE"] = "English - Ireland";
$list_language["it_IT"] = "Italian - Italia";
$list_language["en_LV"] = "English - Latvia";
$list_language["en_LT"] = "English - Lithuania";
$list_language["de_LU"] = "German - Luxembourg";
$list_language["lu_EN"] = "English - Luxembourg";
$list_language["fr_LU"] = "	French - Luxembourg";
$list_language["en_HU"] = "English - Hungary";
$list_language["en_MT"] = "English - Malta";
$list_language["nl_NL"] = "Dutch - Nederlands";
$list_language["nb_NO"] = "Bokmal Norwegian - Norway";
$list_language["de_AT"] = "German - Austria";
$list_language["pl_PL	"] = "Polish - Poland";
$list_language["pt_PT"] = "Portuguese - Portugal";
$list_language["en_RO"] = "English - Romania";
$list_language["de_CH"] = "German - Switzerland";
$list_language["en_SI"] = "English - Slovenia";
$list_language["en_SK"] = "Slovakian - Slovakia";
$list_language["fr_CH"] = "French - Switzerland";
$list_language["en_FI"] = "English - Finland";
$list_language["sv_SE"] = "Swedish- Sweden";
$list_language["it_CH	"] = "Italian - Switzerland";
$list_language["en_UK"] = "English - United Kingdom";
$list_language["en_BG"] = "English - Bulgaria";
$list_language["en_AU"] = "English - Australia";
$list_language["ja_JP	"] = "Japanese - Japan";
$list_language["ko_KR"] = "Korean - South Korea";
$list_language["en_NZ"] = "English - New Zealand";
$list_language["ru_RU"] = "Russian - Russia";
$list_language["en_UA"] = "English - Ukrain";
$list_language["en_TH"] = "English - Thailand";

foreach ( $list_language as $key => $value ) {
	$sel = "";
	if ( $key == "en_US" and ! isset( $_REQUEST["language"] ) ) {
		$sel = "selected";
	}

	if ( $key == @$_REQUEST["language"] ) {
		$sel = "selected";
	}
?>
	<option value='<?php echo $key
?>' <?php echo $sel
?>><?php
	echo($value);
?></option>
	<?php
}
?>
			</select>
		</div>	
		
		<div class="search_title2 field_orientation"><b><?php echo pvs_word_lang( "orientation" )?>:</b></div>
		<div class="search_text2 field_orientation">
			<select name="orientation" style="width:175px" class='ibox form-control'>
			<?php
$list_orientation = array(
	"all",
	"horizontal",
	"vertical",
	"square");
foreach ( $list_orientation as $key => $value ) {
	$sel = "";
	if ( $value == @$_REQUEST["orientation"] ) {
		$sel = "selected";
	}
?>
	<option value='<?php echo $value
?>'  <?php echo $sel
?>><?php echo pvs_word_lang( $value )?></option>
	<?php
}
?>
			</select>
		</div>	
		
		<div class="search_title2 field_color"><b><?php echo pvs_word_lang( "color" )?>:</b></div>
		<div class="search_text2 field_color">
		<?php
if ( ! isset( $_REQUEST["color"] ) ) {
	$color = "FFFFFF";
} else {
	$color = pvs_result($_REQUEST["color"]);
}
?>
		<input type='hidden' id='color' name='color' value='<?php echo $color ?>' />
		<div id="customWidget" style="margin-left:-4px">
		<div id="colorSelector2"><div style="background-color: #<?php echo $color ?>"></div></div>
	                <div id="colorpickerHolder2">
	                </div>
	</div>
	
	<script>$('#colorSelector2').ColorPicker({
	color: '#<?php echo $color ?>',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr,hex) {
		$(colpkr).fadeOut(500);
		return false;		
	},
	onChange: function (hsb, hex, rgb) {
		$('#colorSelector2 div').css('backgroundColor', '#' + hex);
		$('#color').val(hex);
	}
});</script>
		</div>	
		
		<div class="search_title2 field_model"><b><?php echo pvs_word_lang( "model property release" )?>:</b></div>
			
		<div class="search_text2 field_model">
			<select name="model" style="width:175px" class='ibox form-control'>
			<?php
$list_release["all"] = pvs_word_lang( "all" );
$list_release["true"] = pvs_word_lang( "yes" );
$list_release["false"] = pvs_word_lang( "no" );

foreach ( $list_release as $key => $value ) {
	$sel = "";
	if ( $key == @$_REQUEST["model"] ) {
		$sel = "selected";
	}
?>
	<option value='<?php echo $key
?>'  <?php echo $sel
?>><?php echo pvs_word_lang( $value )?></option>
	<?php
}
?>
			</select>
		</div>	
		
		

		
		<div class="search_title2 field_duration"><b><?php echo pvs_word_lang( "duration" )?> <?php echo pvs_word_lang( "video" )?>:</b></div>
		<div class="search_text2 field_duration">
			<select name="duration_video" style="width:200px" class='ibox form-control'>
			<?php
$list_duration["all"] = pvs_word_lang("All");
$list_duration["10"] = "Up to 10 seconds";
$list_duration["20"] = "Up to 20 seconds";
$list_duration["30"] = "Up to 30 seconds";
$list_duration["30"] = "Longer than 30 seconds";


foreach ( $list_duration as $key => $value ) {
	$sel = "";
	if ( $key == @$_REQUEST["duration"] ) {
		$sel = "selected";
	}
?>
	<option value='<?php echo $key
?>'  <?php echo $sel
?>><?php echo pvs_word_lang( $value )?></option>
	<?php
}
?>
			</select>
		</div>
		
		

			
			

		

		

		

	</div>
	
	<div class="search_text"><input type="submit" value="<?php echo pvs_word_lang( "search" )?>" class="isubmit"></div>
</div>
<div class="search_left_bottom"></div>
</form>

<?php
if ( @$_REQUEST["stock_type"] != "" ) {
?><script>change_stock_type('<?php echo pvs_result( @$_REQUEST["stock_type"] )?>')</script><?php
} else
{
?><script>change_stock_type('photo')</script><?php
}
?>