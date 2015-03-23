<?php
//include("variables.sl.php");
include_once(SL_INCLUDES_PATH."/top-nav.php");
?>
<div class='wrap'>
<?php 

if (empty($_POST)) {sl_move_upload_directories();}
if (!empty($_POST['sl_map_type'])) { //shouldn't just be "$_POST"; use an index that should always have a value - 12/9/14
	//$sl_vars=sl_data('sl_vars');
	$_POST['height']=preg_replace("@[^0-9]@", "", $_POST['height']);
	$_POST['width']=preg_replace("@[^0-9]@", "", $_POST['width']);
	$sl_vars['height']=$_POST['height'];
	$sl_vars['width']=$_POST['width'];
	$sl_vars['radii']=$_POST['radii'];
	$sl_vars['height_units']=$_POST['height_units'];
	$sl_vars['width_units']=$_POST['width_units'];
	$sl_vars['icon']=$_POST['icon'];
	$sl_vars['icon2']=$_POST['icon2'];
	$sl_vars['theme']=$_POST['theme'];
	$sl_vars['search_label']=$_POST['search_label'];
	$sl_vars['radius_label']=$_POST['sl_radius_label'];
	$sl_vars['website_label']=$_POST['sl_website_label'];
	$sl_vars['directions_label']=$_POST['sl_directions_label'];
	$sl_vars['instruction_message']=stripslashes($_POST['sl_instruction_message']);
	$sl_vars['city_dropdown_label']=stripslashes($_POST['sl_city_dropdown_label']);
	$sl_vars['location_not_found_message']=stripslashes($_POST['sl_location_not_found_message']);
	$sl_vars['no_results_found_message']=stripslashes($_POST['sl_no_results_found_message']);
	$sl_vars['zoom_level']=$_POST['zoom_level'];
	$sl_vars['use_city_search']=(empty($_POST['sl_use_city_search']))? 0 : $_POST['sl_use_city_search'];
	//$sl_vars['use_name_search']=($_POST['sl_use_name_search']==="")? 0 : $_POST['sl_use_name_search'];
	$sl_vars['remove_credits']=(empty($_POST['sl_remove_credits']))? 0 : $_POST['sl_remove_credits'];
	$sl_vars['load_locations_default']=(empty($_POST['sl_load_locations_default']))? 0 : $_POST['sl_load_locations_default'];
	$sl_vars['load_results_with_locations_default']=(empty($_POST['sl_load_results_with_locations_default']))? 0 : $_POST['sl_load_results_with_locations_default'];
	$sl_vars['map_type']=$_POST['sl_map_type'];
	$sl_vars['num_initial_displayed']=$_POST['sl_num_initial_displayed'];
	$sl_vars['map_overview_control']=(empty($_POST['sl_map_overview_control']))? 0 : $_POST['sl_map_overview_control'];
	$sl_vars['geolocate']=(empty($_POST['sl_geolocate']))? 0 : $_POST['sl_geolocate'];
		$sl_vars['sensor']=(empty($_POST['sl_geolocate']))? "false" : "true";
	$sl_vars['distance_unit']=$_POST['sl_distance_unit'];
	$sl_vars['map_language']=$_POST['sl_map_language'];
	$sl_map_region_arr=explode(":", $_POST['map_region']);
	$sl_vars['google_map_country']=$sl_map_region_arr[0];
	$sl_vars['google_map_domain']=$sl_map_region_arr[1];
	$sl_vars['map_region']=$sl_map_region_arr[2];
	$sl_vars['api_key']=$_POST['sl_api_key'];
	$sl_vars['scripts_load']=$_POST['sl_scripts_load'];
	$sl_vars['scripts_load_home']=(empty($_POST['sl_scripts_load_home']))? 0 : $_POST['sl_scripts_load_home'];
	$sl_vars['scripts_load_archives_404']=(empty($_POST['sl_scripts_load_archives_404']))? 0 : $_POST['sl_scripts_load_archives_404'];
	$sl_vars['hours_label']=$_POST['sl_hours_label'];
	$sl_vars['phone_label']=$_POST['sl_phone_label'];
	$sl_vars['fax_label']=$_POST['sl_fax_label'];
	$sl_vars['email_label']=$_POST['sl_email_label'];
	sl_data('sl_vars', 'update', $sl_vars);
	

	print "<div class='sl_admin_success' >".__("Successful Update", SL_TEXT_DOMAIN)." $view_link</div> <!--meta http-equiv='refresh' content='0'-->";
}
/*print "<h2>".__("MapDesigner&trade;", SL_TEXT_DOMAIN)."</h2><br>";*/

$api_key_field=(empty($sl_vars['api_key']))? "<input name='sl_api_key' size='30' style='font-size:10px'>" : "<input name='sl_api_key' value='$sl_vars[api_key]' size='60' style='font-size:10px'>";
include(SL_INCLUDES_PATH."/countries-languages.php");
$your_location_select="<!--tr><td--><select name='map_region' style='font-size:11px'><optgroup label='".__("Select Your Location", SL_TEXT_DOMAIN)."'><!--/td><td-->";
foreach ($tld as $key=>$value) {
	$selected=($sl_vars['map_region']==$value)?" selected " : "";
	$your_location_select.="<option value='$key:{$the_domain[$key]}:$value' $selected>$key</option>\n";
}
$your_location_select.="</optgroup></select><!--/td></tr-->";
$map_lang_select="<!--tr><td--><select name='sl_map_language' style='font-size:11px'><optgroup label='".__("Select Map Language", SL_TEXT_DOMAIN)."'><!--/td><td-->";

ksort($map_lang);
foreach ($map_lang as $key=>$value) {
	$selected=($sl_vars['map_language']==$value)? " selected='selected'" : "";
	$map_lang_select.= "<option value='$value' $selected>".ucwords(strtolower($key))."</option>\n";
}
$map_lang_select.= "</optgroup></select><!--/td></tr-->";
$update_button="<input type='submit' value='".__("Update", SL_TEXT_DOMAIN)."' class='button-primary'>";

print "<form method='post' name='mapDesigner'><table class='widefat' id='mapDesigner_table'><thead><tr><th colspan='2'>".__("MapDesigner", SL_TEXT_DOMAIN)." <div style='float:right'><small>".__("API Key", SL_TEXT_DOMAIN)." (<a rel='sl_pop' href='#api-key-info'>?</a>): </small>
<div id='api-key-info' style='display:none'><h3 style='margin-top:0px'>".__("Google Maps", SL_TEXT_DOMAIN)." ".__("API Key", SL_TEXT_DOMAIN)."</h3>".__("Google Maps API V3 actually doesn't require an API Key, however, if needed (it appears that high usage requires a key)", SL_TEXT_DOMAIN).", <a target='_blank' href='https://developers.google.com/maps/documentation/javascript/tutorial#api_key'>".__("get your key here", SL_TEXT_DOMAIN)."</a></div> {$api_key_field}&nbsp;{$your_location_select}&nbsp;{$map_lang_select}&nbsp;&nbsp;<input type='submit' value='".__("Update", SL_TEXT_DOMAIN)."' class='button-primary' style=''><div></th><!--td><".__("Designer", SL_TEXT_DOMAIN)."--></td--></tr></thead>";
sl_initialize_variables();
$icon_str="";$icon2_str="";

$icon_dir=opendir(SL_ICONS_PATH."/"); 
while (false !== ($an_icon=readdir($icon_dir))) {
	if (!preg_match("@^\.{1,2}.*$@", $an_icon) && !preg_match("@shadow@", $an_icon) && !preg_match("@\.db@", $an_icon)) {

		$icon_str.="<img style='height:25px; cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='".SL_ICONS_BASE."/$an_icon' onclick='document.forms[\"mapDesigner\"].icon.value=this.src;document.getElementById(\"prev\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
	}
}
if (is_dir(SL_CUSTOM_ICONS_PATH)) {
	$icon_upload_dir=opendir(SL_CUSTOM_ICONS_PATH);
	while (false !== ($an_icon=readdir($icon_upload_dir))) {
		if (!preg_match("@^\.{1,2}.*$@", $an_icon) && !preg_match("@shadow@", $an_icon) && !preg_match("@\.db@", $an_icon)) {

			$icon_str.="<img style='height:25px; cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='".SL_CUSTOM_ICONS_BASE."/$an_icon' onclick='document.forms[\"mapDesigner\"].icon.value=this.src;document.getElementById(\"prev\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
		}
	}
}

$icon_dir=opendir(SL_ICONS_PATH."/");
while (false !== ($an_icon=readdir($icon_dir))) {
	if (!preg_match("@^\.{1,2}.*$@", $an_icon) && !preg_match("@shadow@", $an_icon) && !preg_match("@\.db@", $an_icon)) {

		$icon2_str.="<img style='height:25px; cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='".SL_ICONS_BASE."/$an_icon' onclick='document.forms[\"mapDesigner\"].icon2.value=this.src;document.getElementById(\"prev2\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
	}
}
if (is_dir(SL_CUSTOM_ICONS_PATH)) {
	$icon_upload_dir=opendir(SL_CUSTOM_ICONS_PATH);
	while (false !== ($an_icon=readdir($icon_upload_dir))) {
		if (!preg_match("@^\.{1,2}.*$@", $an_icon) && !preg_match("@shadow@", $an_icon) && !preg_match("@\.db@", $an_icon)) {

			$icon2_str.="<img style='height:25px; cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='".SL_CUSTOM_ICONS_BASE."/$an_icon' onclick='document.forms[\"mapDesigner\"].icon2.value=this.src;document.getElementById(\"prev2\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
		}
	}
}

if (is_dir(SL_THEMES_PATH)) {
	$theme_dir=opendir(SL_THEMES_PATH); 
	$theme_str="";
	while (false !== ($a_theme=readdir($theme_dir))) {
		if (!preg_match("@^\.{1,2}.*$@", $a_theme) && !preg_match("@\.(php|txt|htm(l)?)@", $a_theme)) {

			$selected=($a_theme==$sl_vars['theme'])? " selected " : "";
			$theme_str.="<option value='$a_theme' $selected>$a_theme</option>\n";
		}
	}
}

for ($i=0; $i<=19; $i++) {
	$zl[]=$i;
}

$zoom="<select name='zoom_level'>";
foreach ($zl as $value) {
	$zoom.="<option value='$value' ";
	if ($sl_vars['zoom_level']==$value){ $zoom.=" selected ";}
	$zoom.=">$value</option>";
}
$zoom.="</select>";

$checked=($sl_vars['use_city_search']==1)? " checked " : "";
$checked2="";
//$checked2=($sl_vars['use_name_search']==1)? " checked " : "";
$checked3=($sl_vars['remove_credits']==1)? " checked " : "";
$checked4=($sl_vars['load_locations_default']==1)? " checked " : "";
$checked5=($sl_vars['map_overview_control']==1)? " checked " : "";
$checked6=($sl_vars['geolocate']==1)? " checked " : "";
$checked7=($sl_vars['load_results_with_locations_default']==1)? " checked " : "";

if ($sl_vars['scripts_load']=='all'){
	$checked_all=" checked='checked' onclick='jQuery(\"#scripts_load_selective_tr\").fadeOut()' ";
	$checked_selective="onclick='jQuery(\"#scripts_load_selective_tr\").fadeIn()'";
	$hidden_selective_tr="style='display:none;'";
} else {
	$checked_all=" onclick='jQuery(\"#scripts_load_selective_tr\").fadeOut()' "; 
	$checked_selective=" checked='checked' onclick='jQuery(\"#scripts_load_selective_tr\").fadeIn()' ";
	$hidden_selective_tr="";
}
$checked_home=($sl_vars['scripts_load_home']==1)? " checked " : "";
$checked_archives_404=($sl_vars['scripts_load_archives_404']==1)? " checked " : "";

$map_type["".__("Normal", SL_TEXT_DOMAIN).""]="google.maps.MapTypeId.ROADMAP";
$map_type["".__("Normal + Terrain (Physical)", SL_TEXT_DOMAIN).""]="google.maps.MapTypeId.TERRAIN";
$map_type["".__("Satellite", SL_TEXT_DOMAIN).""]="google.maps.MapTypeId.SATELLITE";
$map_type["".__("Satellite + Labels (Hybrid)", SL_TEXT_DOMAIN).""]="google.maps.MapTypeId.HYBRID";
$map_type_options="";

foreach($map_type as $key=>$value) {
	$selected2=($sl_vars['map_type']==$value)? " selected " : "";
	$map_type_options.="<option value='$value' $selected2>$key</option>\n";
}
$icon_notification_msg=((preg_match("@wordpress-store-locator-location-finder@", $sl_vars['icon']) && preg_match("@^store-locator@", $sl_dir)) || (preg_match("@wordpress-store-locator-location-finder@",$sl_vars['icon2']) && preg_match("@^store-locator@", $sl_dir)))? "<div class='sl_admin_success' style='background-color:LightYellow;color:red'><span style='color:red'>".__("You have switched from <strong>'wordpress-store-locator-location-finder'</strong> to <strong>'store-locator'</strong> --- great!<br>Now, please re-select your <b>'Home Icon'</b> and <b>'Destination Icon'</b> below, so that they show up properly on your store locator map.", SL_TEXT_DOMAIN)."</span></div>" : "" ;

function sl_md_display($data, $template, $additional_classes = "") {
    print "<table class='map_designer_section {$additional_classes}'>";
	
    if ($template == 1) {
	foreach ($data as $key => $value) {
		$the_row_id = (!empty($value["row_id"]))? " id = '$value[row_id]' " : "";
		$hide_row = (!empty($value['hide_row']) && $value['hide_row'] == true)? "style='display:none' " : "" ;
		$colspan = (!empty($value['colspan']) && $value['colspan'] > 1)? "colspan = '$value[colspan]'" : "" ;
		
		print "<tr {$the_row_id} {$hide_row}>
			<td {$colspan}>".$value['label'];
		if (!empty($value['more_info_label'])) {
			print "&nbsp;(<a href='#$value[more_info_label]' rel='sl_pop'>?</a>)&nbsp;";
		}
		print "</td>";
	   if (empty($value['colspan']) || $value['colspan'] < 2) {
		print "<td>".$value['input_template'];
		if (!empty($value['more_info'])) {
			print "<div style='display:none;' id='$value[more_info_label]'>";
			print $value['more_info'];
			print "</div>";
		}
		print "</td>";
	    }
	    print "</tr>";
	}
    } elseif ($template == 2) {
	$labels_ctr = 0;
	foreach ($data as $key => $value) {
		if ($labels_ctr % 3 == 0) {
			$the_row_id = (!empty($value["row_id"]))? " id = '$value[row_id]' " : "";
			print "<tr {$the_row_id}>";
		}	
		$the_more_info_label = (!empty($value['more_info_label']))? "&nbsp;(<a href='#$value[more_info_label]' rel='sl_pop'>?</a>)&nbsp;" : "" ;
		
		print "<td>".$value['input_template']."<br><span style='font-size:80%'>".$value['label']."{$the_more_info_label}</span>";
	
		if (!empty($value['more_info'])) {
			print "<div style='display:none;' id='$value[more_info_label]'>";
			print $value['more_info'];
			print "</div>";
		}
		print "</td>";
		if (($labels_ctr+1) % 3 == 0) {
			print "</tr>";
		}
		$labels_ctr++;
	}


    }
    
    print "</table>";
}

include_once(SL_INCLUDES_PATH."/mapdesigner-options.php");

print "<tr><td colspan='1' width='45%' class='left_side' style='vertical-align:top'><h2>".__("Defaults", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo['defaults'], 1);

print "</td>";
print "<!--tr--><td colspan='1' width='50%' style='vertical-align:top'><h2>".__("Labels", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo['labels'], 2, "right_side");

print "</td></tr>
<tr><td colspan='1' class='left_side' style='vertical-align:top; border-bottom:0px'><h2>".__("Dimensions", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo['dimensions'], 1);

print "</td><!--/tr>
<tr--><td colspan='1' style='vertical-align:top; border-bottom:0px'><h2>".__("Design", SL_TEXT_DOMAIN)."</h2>
$icon_notification_msg";

sl_md_display($sl_mdo['design'], 1, "right_side");

print "</td></tr>
<tr><td colspan='2'>$update_button</td></tr></table></form>";

?>
</div>
<?php include(SL_INCLUDES_PATH."/sl-footer.php"); ?>