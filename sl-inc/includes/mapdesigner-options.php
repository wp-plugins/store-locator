<?php
//MapDesigner Options

###Defaults###
$sl_mdo['defaults'][] = array("label" => __("Default Map Type", SL_TEXT_DOMAIN), "input_template" => <<<EOQ
<select name='sl_map_type'>\n$map_type_options</select>
EOQ
);
$sl_mdo['defaults'][] = array("label" =>  __("Locations in Results", SL_TEXT_DOMAIN), "input_template" => <<<EOQ
<input name='sl_num_initial_displayed' value='$sl_vars[num_initial_displayed]'>
EOQ
);
$sl_mdo['defaults'][] = array("label" => __("JS & CSS Loading", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_scripts_load' value='selective' type='radio' $checked_selective>Selective&nbsp;Loading&nbsp;&nbsp;<input name='sl_scripts_load' value='all' type='radio' $checked_all>All&nbsp;Pages", "more_info" => __("<h2 style='margin-top:0px'>JavaScript & Cascading Style Sheets Loading</h2><b>Selective Loading:</b><br>Attempts to detect where Store Locator JS & CSS scripts are needed and only loads them on those necessary pages. <br><br><b>All Pages:</b><br>Loads JS & CSS scripts on every page of your website.<br><br><div class='sl_code code'><b>Note:</b>&nbsp;\"Selective Loading\" will work for 99% of sites, however, if you experience map loading issues or missing CSS styling on your Store Locator or addon-generated pages, choose the \"All Pages\" option.</div>", SL_TEXT_DOMAIN), "more_info_label" => "info_js_css_load");

$sl_mdo['defaults'][] = array("label" => "", "input_template" => __("Also Load On", SL_TEXT_DOMAIN)." .. <input name='sl_scripts_load_home' value='1' type='checkbox' {$checked_home}>&nbsp;".__("Home", SL_TEXT_DOMAIN)."&nbsp;&nbsp;<input name='sl_scripts_load_archives_404' value='1' type='checkbox' {$checked_archives_404}>&nbsp;".__("Archives", SL_TEXT_DOMAIN)." / 404", "row_id" => "scripts_load_selective_tr", "hide_row" => ($sl_vars['scripts_load'] == "all") );

$sl_mdo['defaults'][] = array("label" => "<input name='sl_use_city_search' value='1' type='checkbox' $checked>&nbsp;".__("Search By City", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_map_overview_control' value='1' type='checkbox' $checked5>&nbsp;".__("Show Map Inset Box", SL_TEXT_DOMAIN));

$sl_mdo['defaults'][] = array("label" => "<input name='sl_geolocate' value='1' type='checkbox' $checked6>&nbsp;".__("Auto-Locate User", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_load_locations_default' value='1' type='checkbox' $checked4>&nbsp;".__("Auto-Load Locations", SL_TEXT_DOMAIN)."&nbsp;&nbsp;(<input name='sl_load_results_with_locations_default' value='1' type='checkbox' $checked7>&nbsp;&amp;&nbsp;".__("Listing", SL_TEXT_DOMAIN)."&nbsp;(<a href='#info_load_results_default' rel='sl_pop'>?</a>)<div style='display:none;' id='info_load_results_default'>".__("<h2 style='margin-top:0px'>Search Results Listing By Default</h2>Determine whether or not both the map icons and the results listing show when loading locations by default. <br><Br>No results listings are shown even if this is checked, but 'Auto-Load Locations' is unchecked", SL_TEXT_DOMAIN).".</div>)");

/*<!--tr><td>".__("Allow User Search By Name of Location?", SL_TEXT_DOMAIN).":</td>
<td><input name='sl_use_name_search' value='1' type='checkbox' $checked2></td></tr-->
<!--/table-->*/
###End Defaults###

###Labels###
$sl_mdo['labels'][] = array("label" => __("Address Input", SL_TEXT_DOMAIN), "input_template" => "<input name='search_label' value=\"$sl_search_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Radius Dropdown", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_radius_label' value=\"$sl_radius_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Website URL", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_website_label' value=\"$sl_website_label\" size='14'>");

$sl_mdo['labels'][] = array("label" => __("Directions URL", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_directions_label' value=\"$sl_directions_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Instruction to Users", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_instruction_message' value=\"".$sl_instruction_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("City Dropdown", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_city_dropdown_label' value=\"".$sl_city_dropdown_label."\" size='14'>");

$sl_mdo['labels'][] = array("label" => __("Location Doesn't Exist", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_location_not_found_message' value=\"".$sl_location_not_found_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("No Results Are Found", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_no_results_found_message' value=\"".$sl_no_results_found_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Hours", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_hours_label' value=\"".$sl_hours_label."\" size='14'>");

$sl_mdo['labels'][] = array("label" => __("Phone", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_phone_label' value=\"".$sl_phone_label."\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Fax", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_fax_label' value=\"".$sl_fax_label."\" size='14'>");
$sl_mdo['labels'][] = array("label" => __("Email", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_email_label' value=\"".$sl_email_label."\" size='14'>");
###End Labels###

###Dimensions###
$sl_mdo['dimensions'][] = array("label" => "<nobr>".__("Zoom Level", SL_TEXT_DOMAIN)."</nobr>", "input_template" => $zoom);
$sl_mdo['dimensions'][] = array("label" => "<nobr>".__("Map Dimensions (H x W)", SL_TEXT_DOMAIN)."</nobr>", "input_template" => "<input name='height' value='$sl_height' size='3'>&nbsp;".sl_choose_units($sl_height_units, "height_units")." <span style='font-size:1.2em; vertical-align:middle'>X</span> <input name='width' value='$sl_width' size='3'>&nbsp;".sl_choose_units($sl_width_units, "width_units")
);

$the_distance_unit["".__("Km", SL_TEXT_DOMAIN).""]="km";
$the_distance_unit["".__("Miles", SL_TEXT_DOMAIN).""]="miles";
$radii_select = "";
foreach ($the_distance_unit as $key=>$value) {
	$selected = ($sl_vars['distance_unit']==$value)?" selected " : "";
	$radii_select .= "<option value='$value' $selected>$key</option>\n";
}
$sl_mdo['dimensions'][] = array("label" => "<nobr>".__("Radii Options", SL_TEXT_DOMAIN)." (".__("in", SL_TEXT_DOMAIN)." <select name='sl_distance_unit'>$radii_select</select>) </nobr>", "input_template" => "<input  name='radii' value='$sl_vars[radii]' size='25'><br><span style='font-size:80%'>(".__("Parentheses '( )' are for the default radius</span>", SL_TEXT_DOMAIN).")");
###End Dimensions###

###Design###
$sl_mdo['design'][] = array("label" => __("Choose Theme", SL_TEXT_DOMAIN), "input_template" => "<select name='theme' onchange=\"\"><option value=''>".__("No Theme Selected", SL_TEXT_DOMAIN)."</option>$theme_str</select>&nbsp;&nbsp;&nbsp;<a href='http://www.viadat.com/products-page/store-locator-themes/' target='_blank'>".__("Get&nbsp;Themes", SL_TEXT_DOMAIN)." &raquo;</a>");
$sl_mdo['design'][] = array("label" => __("Remove Credits", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_remove_credits' value='1' type='checkbox' $checked3>");
$sl_mdo['design'][] = array("label" => "<input name='icon' size='20' value='$sl_vars[icon]' onchange=\"document.getElementById('prev').src=this.value\"><img id='prev' src='$sl_vars[icon]' align='top' rel='sl_pop' href='#home_icon' style='cursor:pointer;cursor:hand;height:60%;'> <br><a rel='sl_pop' href='#home_icon'><span style='font-size:80%'>".__("Choose", SL_TEXT_DOMAIN)." ".__("Home Icon", SL_TEXT_DOMAIN)."</span></a><div id='home_icon' style='display:none;'><h2 style='margin-top:0px'>".__("Choose", SL_TEXT_DOMAIN)." ".__("Home Icon", SL_TEXT_DOMAIN)."</h2>$icon_str</div>", "input_template" => "<input name='icon2' size='20' value='$sl_vars[icon2]' onchange=\"document.getElementById('prev2').src=this.value\"><img id='prev2' src='$sl_vars[icon2]' align='top' rel='sl_pop' href='#end_icon' style='cursor:pointer;cursor:hand;height:60%;'> <br><div id='end_icon' style='display:none;'><h2 style='margin-top:0px'>".__("Choose", SL_TEXT_DOMAIN)." ".__("Destination Icon", SL_TEXT_DOMAIN)."</h2>$icon2_str</div><a rel='sl_pop' href='#end_icon'><span style='font-size:80%'>".__("Choose", SL_TEXT_DOMAIN)." ".__("Destination Icon", SL_TEXT_DOMAIN)." </span></a>");
$sl_mdo['design'][] = array("label" => "<div class=''><b>".__("For more unique icons, visit", SL_TEXT_DOMAIN)." <a href='https://www.geocoderpro.com/en/resources/map-icons-marker-pins/' target='_blank'>GeoCoder Pro</a> & <a href='http://code.google.com/p/google-maps-icons/' target='_blank'>Map Icons Collection</a></b></div>", "input_template" => "", "colspan" => 2);
###End Design###

/*
$sl_mdo['defaults'][] = array("label" => "Locations in Results", "input_template" => <<<EOQ
<input name='sl_num_initial_displayed' value='$sl_vars[num_initial_displayed]'>
EOQ
);*/

?>