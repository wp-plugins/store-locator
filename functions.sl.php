<?php

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

/*-----------------*/

function initialize_variables() {

global $height, $width, $width_units, $height_units, $radii;
global $icon, $icon2, $google_map_domain, $google_map_country, $theme, $sl_base, $location_table_view;
global $search_label, $zoom_level, $sl_use_city_search, $sl_use_name_search, $sl_default_map;
global $sl_radius_label, $sl_website_label;


$sl_website_label=get_option('sl_website_label');
if (empty($sl_website_label)) {
	$sl_website_label="Website";
	add_option('sl_website_label', $sl_website_label);
	}
$sl_radius_label=get_option('sl_radius_label');
if (empty($sl_radius_label)) {
	$sl_radius_label="Radius";
	add_option('sl_radius_label', $sl_radius_label);
	}
$sl_map_type=get_option('sl_map_type');
if (empty($sl_map_type)) {
	$sl_map_type=G_DEFAULT_MAP;
	add_option('sl_map_type', $sl_map_type);
	}
$sl_remove_credits=get_option('sl_remove_credits');
if (empty($sl_remove_credits)) {
	$sl_remove_credits="0";
	add_option('sl_remove_credits', $sl_remove_credits);
	}
$sl_use_name_search=get_option('sl_use_name_search');
if (empty($sl_use_name_search)) {
	$sl_use_name_search="0";
	add_option('sl_use_name_search', $sl_use_name_search);
	}
$sl_use_city_search=get_option('sl_use_city_search');
if (empty($sl_use_city_search)) {
	$sl_use_city_search="1";
	add_option('sl_use_city_search', $sl_use_city_search);
	}
$zoom_level=get_option('sl_zoom_level');
if (empty($zoom_level)) {
	$zoom_level="4";
	add_option('sl_zoom_level', $zoom_level);
	}
$search_label=get_option('sl_search_label');
if (empty($search_label)) {
	$search_label="Address";
	add_option('sl_search_label', $search_label);
	}
$location_table_view=get_option('sl_location_table_view');
if (empty($location_table_view)) {
	$location_table_view="Normal";
	add_option('sl_location_table_view', $location_table_view);
	}
$theme=get_option('sl_map_theme');
if (empty($theme)) {
	$theme="";
	add_option('sl_map_theme', $theme);
	}
$google_map_country=get_option('sl_google_map_country');
if (empty($google_map_country)) {
	$google_map_country="United States";
	add_option('sl_google_map_country', $google_map_country);
}
$google_map_domain=get_option('sl_google_map_domain');
if (empty($google_map_domain)) {
	$google_map_domain="maps.google.com";
	add_option('sl_google_map_domain', $google_map_domain);
}
$icon2=get_option('sl_map_end_icon');
if (empty($icon2)) {
	add_option('sl_map_end_icon', $sl_base.'/icons/marker.png');
	$icon2=get_option('sl_map_end_icon');
}
$icon=get_option('sl_map_home_icon');
if (empty($icon)) {
	add_option('sl_map_home_icon', $sl_base.'/icons/arrow.png');
	$icon=get_option('sl_map_home_icon');
}
$height=get_option('sl_map_height');
if (empty($height)) {
	add_option('sl_map_height', '350');
	$height=get_option('sl_map_height');
	}

$height_units=get_option('sl_map_height_units');
if (empty($height_units)) {
	add_option('sl_map_height_units', "px");
	$height_units=get_option('sl_map_height_units');
	}	

$width=get_option('sl_map_width');
if (empty($width)) {
	add_option('sl_map_width', "100");
	$width=get_option('sl_map_width');
	}

$width_units=get_option('sl_map_width_units');
if (empty($width_units)) {
	add_option('sl_map_width_units', "%");
	$width_units=get_option('sl_map_width_units');
	}	

$radii=get_option('sl_map_radii');
if (empty($radii)) {
	add_option('sl_map_radii', "1,5,10,25,(50),100,200,500");
	$radii=get_option('sl_map_radii');
	}
}
/*--------------------------*/
function choose_units($unit, $input_name) {
	$unit_arr[]="%";$unit_arr[]="px";$unit_arr[]="em";$unit_arr[]="pt";
	$select_field.="<select name='$input_name'>";
	
	//global $height_units, $width_units;
	
	foreach ($unit_arr as $value) {
		$selected=($value=="$unit")? " selected " : "" ;
		if (!($input_name=="height_units" && $unit=="%")) {
			$select_field.="\n<option value='$value' $selected>$value</option>";
		}
	}
	$select_field.="</select>";
	return $select_field;
}
/*----------------------------*/
function do_geocoding($address,$sl_id="") {

global $wpdb, $text_domain;
define("MAPS_HOST", get_option('sl_google_map_domain'));
$api_key=get_option('store_locator_api_key');
define("KEY", "$api_key");

// Initialize delay in geocode speed
$delay = 0;
$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv&key=" . KEY;

// Iterate through the rows, geocoding each address
    $request_url = $base_url . "&q=" . urlencode($address);
    $csv = file_get_contents($request_url) or die("url not loading");

    $csvSplit = split(",", $csv);
    $status = $csvSplit[0];
    $lat = $csvSplit[2];
    $lng = $csvSplit[3];
    if (strcmp($status, "200") == 0) {
      // successful geocode
      $geocode_pending = false;
      $lat = $csvSplit[2];
      $lng = $csvSplit[3];

	if ($sl_id=="") {
		$query = sprintf("UPDATE " . $wpdb->prefix ."store_locator SET sl_latitude = '%s', sl_longitude = '%s' WHERE sl_id = ".mysql_insert_id()." LIMIT 1;", mysql_real_escape_string($lat), mysql_real_escape_string($lng));
	}
	else {
		$query = sprintf("UPDATE " . $wpdb->prefix ."store_locator SET sl_latitude = '%s', sl_longitude = '%s' WHERE sl_id = $sl_id LIMIT 1;", mysql_real_escape_string($lat), mysql_real_escape_string($lng));
	}
      $update_result = mysql_query($query);
      if (!$update_result) {
        die("Invalid query: " . mysql_error());
      }
    } else if (strcmp($status, "620") == 0) {
      // sent geocodes too fast
      $delay += 100000;
    } else {
      // failure to geocode
      $geocode_pending = false;
      echo __("Address " . $address . " failed to geocode. ", $text_domain);
      echo __("Received status " . $status , $text_domain)."\n";
    }
    usleep($delay);
}
/*-------------------------------*/
function install_table() {
	global $wpdb;
	global $sl_db_version;

	$table_name = $wpdb->prefix . "store_locator";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

		$sql = "CREATE TABLE " . $table_name . " (
			sl_id mediumint(8) unsigned NOT NULL auto_increment,
			sl_store varchar(255) NOT NULL,
			sl_address varchar(255) NOT NULL,
			sl_address2 varchar(255) NOT NULL,
			sl_city varchar(255) NOT NULL,
			sl_state varchar(255) NOT NULL,
			sl_zip varchar(255) NOT NULL,
			sl_latitude varchar(255) NOT NULL,
			sl_longitude varchar(255) NOT NULL,
			sl_tags mediumtext NOT NULL,
			sl_description varchar(255) NOT NULL,
			sl_url varchar(255) NOT NULL,
			sl_hours varchar(255) NOT NULL,
			sl_phone varchar(255) NOT NULL,
			sl_image varchar(255) NOT NULL,
			sl_private varchar(1) NOT NULL,
			sl_neat_title varchar(255) NOT NULL,
			PRIMARY KEY  (sl_id)
			) ENGINE=innoDB ;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		add_option("sl_db_version", $sl_db_version);
	}
}
/*-------------------------------*/
function head_scripts() {
	global $sl_dir, $sl_base;
	$api_key=get_option('store_locator_api_key');
	$google_map_domain=(get_option('sl_google_map_domain')!="")? get_option('sl_google_map_domain') : "maps.google.com";
	
	print "<script src='http://$google_map_domain/maps?file=api&amp;v=2&amp;key=$api_key' type='text/javascript'></script>";
	print "<link rel='stylesheet' type='text/css' href='".$sl_base."/base.css' />\n";
	print "<link rel='stylesheet' type='text/css' href='".$sl_base."/store-locator.css'>\n";
	$theme=get_option('sl_map_theme');
	if ($theme!="") {print "\n<link rel='stylesheet' type='text/css' href='".$sl_base."/themes/$theme/style.css' />";}
		$zl=(trim(get_option('sl_zoom_level'))!="")? get_option('sl_zoom_level') : 4;
		print "
		<script src='".$sl_base."/js/store-locator-js.php' type='text/javascript'></script>
		<script src='".$sl_base."/js/store-locator.js' type='text/javascript'></script>
		<script src='".$sl_base."/js/functions.js' type='text/javascript'></script>";
		//print "<style></style>";
}
/*-------------------------------*/
function foot_scripts() {
	//print "<script type='text/javascript'>if (document.getElementById('map')){load();}</script>";
}
/*-------------------------------*/
function ajax_map($content) {

	global $sl_dir, $sl_base, $sl_path, $text_domain, $wpdb;
	if(! preg_match('|\[STORE-LOCATOR|', $content)) {
		return $content;
	}
	else {
		$height=(get_option('sl_map_height'))? get_option('sl_map_height') : "500" ;
		$width=(get_option('sl_map_width'))? get_option('sl_map_width') : "100" ;
		$radii=(get_option('sl_map_radii'))? get_option('sl_map_radii') : "1,5,10,(25),50,100,200,500" ;
		$height_units=(get_option('sl_map_height_units'))? get_option('sl_map_height_units') : "px";
		$width_units=(get_option('sl_map_width_units'))? get_option('sl_map_width_units') : "%";
	
		$r_array=explode(",", $radii);
		$search_label=(get_option('sl_search_label'))? get_option('sl_search_label') : "Address" ;
		
		foreach ($r_array as $value) {
			$s=(ereg("\(.*\)", $value))? " selected " : "" ;
			$value=ereg_replace("[^0-9]", "", $value);
			$r_options.="<option value='$value' $s>$value mi. (".round($value*1.609344,1)." km)</option>
			";
		}
		
		if (get_option('sl_use_city_search')==1) {
			$cs_array=$wpdb->get_results("SELECT CONCAT(sl_city, ', ', sl_state) as city_state FROM ".$wpdb->prefix."store_locator WHERE sl_city<>'' AND sl_state<>'' GROUP BY city_state ORDER BY city_state ASC", ARRAY_A);
			//var_dump($cs_array); die();
			if ($cs_array) {
				foreach($cs_array as $value) {
					$cs_options.="<option value='$value[city_state]'>$value[city_state]</option>";
				}
			}
		}
		/*if (get_option('sl_use_name_search')==1) {
			$name_array=$wpdb->get_results("SELECT sl_store FROM ".$wpdb->prefix."store_locator WHERE sl_store<>'' ORDER BY sl_store ASC", ARRAY_A);
			//var_dump($cs_array); die();
			if ($name_array) {
				foreach($name_array as $value) {
					$name_options.="<option value='".comma($value[sl_store])."'>".comma($value[sl_store])."</option>";
				}
			}
		}*/
	$theme_base=$sl_base."/themes/".get_option('sl_map_theme');
	$theme_path=$sl_path."/themes/".get_option('sl_map_theme');
	if (get_option('sl_map_theme')=="") {
		$theme_base=$sl_base."/images/";
		$theme_path=$sl_path."/images/";
	}
	$sub_img=$theme_base."/search_button.png";
	$mousedown=(file_exists($theme_path."/search_button_down.png"))? "onmousedown=\"this.src='$theme_base/search_button_down.png'\" onmouseup=\"this.src='$theme_base/search_button.png'\"" : "";
	$mouseover=(file_exists($theme_path."/search_button_over.png"))? "onmouseover=\"this.src='$theme_base/search_button_over.png'\" onmouseout=\"this.src='$theme_base/search_button.png'\"" : "";
	$button_style=(file_exists($theme_path."/search_button.png"))? "type='image' src='$sub_img' $mousedown $mouseover" : "type='submit'";
	//print "$sub_img | ".$sl_path."/themes/".get_option('sl_map_theme')."/search_button.png";
	$hide=(get_option('sl_remove_credits')==1)? "style='display:none;'" : "";
	
$form="
<div id='sl_div'>
  <form onsubmit='searchLocations(); return false;' name='searchForm'>
    <table border=0 cellpadding='3px'><tr>
	<td valign=top><nobr>$search_label&nbsp;</nobr></td>
	<td ";
	
	if (get_option('sl_use_city_search')!=1) {$form.=" colspan='2' ";}
	
	$form.=" valign='top'><input type='text' id='addressInput' size=25/></td>
	";
	
	if ($cs_array && get_option('sl_use_city_search')==1) {
		$form.="<td valign='top'><nobr>&nbsp;<!--b>OR</b-->&nbsp;</nobr></td>";
	}
	
	if ($cs_array && get_option('sl_use_city_search')==1) {
	$form.="
	<td valign='top'>";
	$form.="<select id='addressInput2' onchange='aI=document.forms[\"searchForm\"].addressInput;if(this.value!=\"\"){oldvalue=aI.value;aI.value=this.value;}else{aI.value=oldvalue;}'>
	<option value=''>--Search By City--</option>
	$cs_options
    </select></td>";
	}
	
	/*if ($name_array && get_option('sl_use_name_search')==1) {
		$form.="<td valign='top'><nobr>&nbsp;<b>OR</b>&nbsp;</nobr></td>";
	}
	
	if ($name_array && get_option('sl_use_name_search')==1) {
	$form.="
	<td valign='top'>";
	$form.="<select id='addressInput3' onchange='aI=document.forms[\"searchForm\"].addressInput;if(this.value!=\"\"){oldvalue=aI.value;aI.value=this.value;}else{aI.value=oldvalue;}'>
	<option value=''>--Search By Name--</option>
	$name_options
    </select>";
	
	//$form.="<input name='addressInput3'><input type='hidden' value='1' name='name_search'></td>";
	}*/
	
	$sl_radius_label=get_option('sl_radius_label');
	$form.="
	</tr><tr>
	 <td valign=top>".__("$sl_radius_label", $text_domain)."</td>
	 <td width='33%' valign='top' ";
	
	if (get_option('sl_use_city_search')==1) {$form.="colspan='2'";}
	 
	$form.="><select id='radiusSelect'>
	$r_options
    </select>
	</td>
	<td valign='top' ";
	
	if (get_option('sl_use_city_search')!=1) {$form.="colspan='2'";}
	
	$form.=" ><input $button_style value='Search Locations' id='addressSubmit'/> </td>
	</tr></table>
<table width=100% cellspacing='0px' cellpadding='0px' style='/*border:solid silver 1px*/'> 
     <tr>
        <td width='100%' valign='top'> <div id='map' style='width:$width$width_units; height:$height$height_units'></div><table cellpadding='0px' class='sl_footer' width='100%' $hide><tr><td><a href='http://www.viadat.com/store-locator' target='_blank'>Lots of Locales</a></td><td align='right' style='padding-right:5px'> <a href='http://www.viadat.com' target='_blank' title='by Viadat Creations'>by Viadat</a></td></tr></table>
		</td>
      </tr>
	  <tr id='cm_mapTR'>
        <td width='' valign='top' style='/*display:hidden; border-right:solid silver*/ 1px' id='map_sidebar_td'> <div id='map_sidebar' style='overflow: auto;width:$width$width_units; height:250px;/* $height$height_units; */font-size: 11px; color: #000;'> <div style='font-family:Arial; padding:20px; font-size:18px; text-align:justified'>".__("Enter Your Address or Zip Code Above", $text_domain).".</div></div>
        </td></tr>
    </tbody>
  </table>
  <script type=\"text/javascript\">if (document.getElementById(\"map\")){setTimeout(\"load()\",1000);}</script>
</form>
</div>";
	
	return eregi_replace("\[STORE-LOCATOR(.*)?\]", $form, $content);
	}
}
/*-----------------------------------*/
function sl_add_options_page() {
	
	global $sl_dir, $sl_base, $text_domain;
	$api=get_option('store_locator_api_key');
	//add_menu_page('Edit Locations', 'View Locations', 9, '$sl_dir/options-store-locator.php');
	add_menu_page(__("Store Locator", $text_domain), __("Store Locator", $text_domain), 9, $sl_dir.'/news-upgrades.php');
	if (trim($api)!=""){
		add_submenu_page($sl_dir.'/news-upgrades.php', __("News & Upgrades", $text_domain), __("News & Upgrades", $text_domain), 9, $sl_dir.'/news-upgrades.php');
		add_submenu_page($sl_dir.'/news-upgrades.php', __("Manage Locations", $text_domain), __("Manage Locations", $text_domain), 9, $sl_dir.'/view-locations.php');
		add_submenu_page($sl_dir.'/news-upgrades.php', __("Add Locations", $text_domain), __("Add Locations", $text_domain), 9, $sl_dir.'/add-locations.php');
		add_submenu_page($sl_dir.'/news-upgrades.php', __("Map Designer", $text_domain), __("Map Designer", $text_domain), 9, $sl_dir.'/map-designer.php');
	}
	add_submenu_page($sl_dir.'/news-upgrades.php', __("Localization", $text_domain)." &amp; ".__("Google API Key", $text_domain),  __("Localization", $text_domain)." &amp; ".__("Google API Key", $text_domain), 9, $sl_dir.'/api-key.php');
	if (trim($api)!=""){
		
		add_submenu_page($sl_dir.'/news-upgrades.php', __("ReadMe", $text_domain), __("ReadMe", $text_domain), 9, $sl_dir.'/readme.php');
		//add_submenu_page($sl_dir.'/news-upgrades.php', 'Export Locations', 'Generate CSV Import File [+]', 9, $sl_dir.'/export-locations.php');
		//add_submenu_page($sl_dir.'/news-upgrades.php', 'Statistics', 'Statistics [+]', 9, $sl_dir.'/statistics.php');
	}
	print "<script src='".$sl_base."/js/functions.js'></script>\n
	<script type='text/javascript'>
	var sl_dir='".$sl_dir."';
	var sl_google_map_country='".get_option('sl_google_map_country')."';
	</script>\n";
	print "<link rel='stylesheet' type='text/css' href='".$sl_base."/admin.css'>\n";
	if (ereg("add-locations", $_GET[page])) {
		$google_map_domain=(get_option('sl_google_map_domain')!="")? get_option('sl_google_map_domain') : "maps.google.com";
		print "<script src='http://$google_map_domain/maps?file=api&v=2&key=$api' type='text/javascript'></script>\n";
		print "<script src='".$sl_base."/js/point-click-add.js'></script>\n";
	}
}
/*---------------------------------*/
function set_query_defaults() {
	global $where, $o, $d;
	
	$where=($_GET[q]!="")? " WHERE sl_store LIKE '%$_GET[q]%' OR sl_address LIKE '%$_GET[q]%' OR sl_city LIKE '%$_GET[q]%' OR sl_state LIKE '%$_GET[q]%' OR sl_zip LIKE '%$_GET[q]%' OR sl_tags LIKE '%$_GET[q]%'" : "" ;
	$o=($_GET[o])? $_GET[o] : "sl_store";
	$d=($_GET[d])? $_GET[d] : "ASC";
}
/*----------------------------------*/
function match_imported_data($the_array) {
	global $text_domain;
	print "<h3>".__("Choose Heading That Matches Columns You Want to Import", $text_domain).":</h3>(".__("Leave headings for undesired columns unchanged", $text_domain).")<br><br>
<form method='post'>
<input type='button' value='".__("Cancel", $text_domain)."' class='button' onclick='history.go(-1)'>&nbsp;<input type='submit' value='".__("Import Locations", $text_domain)."' class='button'>
<table class='widefat'><thead><tr style='/*background-color:black*/'>";

$array_to_be_counted=(is_array($the_array[0]))? $the_array[0] : $the_array[1] ; //needed for the csv import (where first line is usually skipped)  vs the point-click-add import (where there's only the first line)
for ($ctr=1; $ctr<=count($array_to_be_counted); $ctr++) {
	print "<td><select name='field_map[]'>";
	print "<option value=''>".__("Choose")."</option>
			<option value='sl_store'>".__("Name", $text_domain)."</option>
				<option value='sl_address'>".__("Street(Line1)", $text_domain)."</option>
				<option value='sl_address2'>".__("Street(Line2)", $text_domain)."</option>
				<option value='sl_city'>".__("City", $text_domain)."</option>
				<option value='sl_state'>".__("State", $text_domain)."</option>
				<option value='sl_zip'>".__("Zip", $text_domain)."</option>
				<option value='sl_tags'>".__("Tags", $text_domain)."</option>
				<option value='sl_description'>".__("Description", $text_domain)."</option>
				<option value='sl_hours'>".__("Hours", $text_domain)."</option>
				<option value='sl_url'>".__("URL", $text_domain)."</option>
				<option value='sl_phone'>".__("Phone", $text_domain)."</option>
				<option value='sl_image'>".__("Image", $text_domain)."</option>
				<option value='sl_private'>".__("Is Private?", $text_domain)."</option>";
	print "</select></td>";
}
print "</tr></thead>";

foreach ($the_array as $key=>$value) {
	print "<tr style='border-bottom:solid silver 1px'>";
	$bgcolor="#ddd";
	$ctr2=0;
	foreach ($value as $key2=>$value2) {
		//if (ereg("^[0-9]", $key2)) {
			$bgcolor=($bgcolor=="#fff" || empty($bgcolor))? "#ddd" : "#fff";
			print "<td style='background-color:$bgcolor'>$value2<input type='hidden' value='$value2' name='column{$ctr2}[]'></td>\n";
			$ctr2++;
		//}
	}
	print "</tr>\n";
}
print "</table><input type='hidden' name='finish_import' value='1'>
<input type='hidden' name='total_entries' value='".(count($the_array))."'>
<input type='button' value='".__("Cancel", $text_domain)."' class='button' onclick='history.go(-1)'>&nbsp;<input type='submit' value='".__("Import Locations", $text_domain)."' class='button'></form>";
}
/*--------------------------------------------------------------*/

function do_hyperlink(&$text, $target="'_blank'")
{
   // match protocol://address/path/
   $text = ereg_replace("[a-zA-Z]+://([.]?[a-zA-Z0-9_/?&amp;%20,=-\+-])*", "<a href=\"\\0\" target=$target>\\0</a>", $text);

   // match www.something
   $text = ereg_replace("(^| )(www([.]?[a-zA-Z0-9_/=-\+-])*)", "\\1<a href=\"http://\\2\" target=$target>\\2</a>", $text);

return $text;
}
/*--------------------------------------------------------------*/
function find_wp_config() {
if (file_exists("./wp-config.php")){include("./wp-config.php");}
elseif (file_exists("../wp-config.php")){include("../wp-config.php");}
elseif (file_exists("../../wp-config.php")){include("../../wp-config.php");}
elseif (file_exists("../../../wp-config.php")){include("../../../wp-config.php");}
elseif (file_exists("../../../../wp-config.php")){include("../../../../wp-config.php");}
elseif (file_exists("../../../../../wp-config.php")){include("../../../../../wp-config.php");}
elseif (file_exists("../../../../../../wp-config.php")){include("../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../wp-config.php")){include("../../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../../wp-config.php")){include("../../../../../../../../wp-config.php");}
}
/*--------------------------------------------------------------*/
function insert_matched_data() {
	global $wpdb;
	$ctr=0;
	foreach ($_POST[field_map] as $value) {
		if($value!="") {
			$selected_fields.="$value,";
			$column_number[]=$ctr;
		}
		$ctr++;
	}
	$selected_fields=substr($selected_fields,0, strlen($selected_fields)-1);

	for ($entry_number=0; $entry_number<$_POST[total_entries]; $entry_number++) {
		for ($ctr2=0; $ctr2<count($column_number); $ctr2++) {
			//print "'".$_POST["column{$column_number[$ctr2]}"][$entry_number]."',";
			//die();
			$value_string.="'".trim($_POST["column{$column_number[$ctr2]}"][$entry_number])."',";
			//die($value_string);
		}
		$value_string=substr($value_string,0, strlen($value_string)-1);
		//print "INSERT INTO ".$wpdb->prefix."store_locator ($selected_fields) VALUES ($value_string) <br>"; die();
		$wpdb->query("INSERT INTO ".$wpdb->prefix."store_locator ($selected_fields) VALUES ($value_string)");
		$for_geo=$wpdb->get_results("SELECT CONCAT(sl_address, ', ', sl_city, ', ', sl_state, ' ', sl_zip) as the_address FROM ".$wpdb->prefix."store_locator WHERE sl_id='".mysql_insert_id()."'", ARRAY_A);
		//var_dump($for_geo);  
		//exit();
		do_geocoding($for_geo[0][the_address]);
		$value_string="";
	}
}
/*-------------------------------------------------------------*/
function comma($a) {
	$a=ereg_replace('"', "&quot;", $a);
	$a=ereg_replace("'", "&#39;", $a);
	$a=ereg_replace(">", "&gt;", $a);
	$a=ereg_replace("<", "&lt;", $a);
	$a=ereg_replace(" & ", " &amp; ", $a);
	return ereg_replace("," ,"&#44;" ,$a);
	
}
/*------------------------------------------------------------*/
function addon_activation_message($url_of_upgrade="") {
	global $sl_dir, $text_domain;
	print "<div style='background-color:#eee; border:solid silver 1px; padding:7px; color:black'>".__("You haven't activated this upgrade yet", $text_domain).". <a href='".get_option('siteurl')."/wp-admin/admin.php?page=$sl_dir/news-upgrades.php'>".__("Activate", $text_domain)."</a></div><br>";
}
?>