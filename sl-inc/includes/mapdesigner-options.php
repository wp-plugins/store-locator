<?php
//MapDesigner Options

###Defaults###
$sl_mdo['defaults'][] = array("label" => "Default Map Type", "input_template" => <<<EOQ
<select name='sl_map_type'>\n$map_type_options</select>
EOQ
);
$sl_mdo['defaults'][] = array("label" => "Locations in Results", "input_template" => <<<EOQ
<input name='sl_num_initial_displayed' value='$sl_vars[num_initial_displayed]'>
EOQ
);
$sl_mdo['defaults'][] = array("label" => "JS & CSS Loading", "input_template" => "<input name='sl_scripts_load' value='selective' type='radio' $checked_selective>Selective&nbsp;Loading&nbsp;&nbsp;<input name='sl_scripts_load' value='all' type='radio' $checked_all>All&nbsp;Pages", "more_info" => "<h2 style='margin-top:0px'>JavaScript & Cascading Style Sheets Loading</h2><b>Selective Loading:</b><br>Attempts to detect where Store Locator JS & CSS scripts are needed and only loads them on those necessary pages. <br><br><b>All Pages:</b><br>Loads JS & CSS scripts on every page of your website.<br><br><div class='sl_code code'><b>Note:</b>&nbsp;\"Selective Loading\" will work for 99% of sites, however, if you experience map loading issues or missing CSS styling on your Store Locator or addon-generated pages, choose the \"All Pages\" option.</div>", "more_info_label" => "info_js_css_load");

$sl_mdo['defaults'][] = array("label" => "", "input_template" => __("Also Load On", SL_TEXT_DOMAIN)." .. <input name='sl_scripts_load_home' value='1' type='checkbox' {$checked_home}>&nbsp;".__("Home", SL_TEXT_DOMAIN)."&nbsp;&nbsp;<input name='sl_scripts_load_archives_404' value='1' type='checkbox' {$checked_archives_404}>&nbsp;".__("Archives", SL_TEXT_DOMAIN)." / 404", "row_id" => "scripts_load_selective_tr");

$sl_mdo['defaults'][] = array("label" => "<input name='sl_use_city_search' value='1' type='checkbox' $checked>&nbsp;".__("Search By City", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_map_overview_control' value='1' type='checkbox' $checked5>&nbsp;".__("Show Map Inset Box", SL_TEXT_DOMAIN));

$sl_mdo['defaults'][] = array("label" => "<input name='sl_geolocate' value='1' type='checkbox' $checked6>&nbsp;".__("Auto-Locate User", SL_TEXT_DOMAIN), "input_template" => "<input name='sl_load_locations_default' value='1' type='checkbox' $checked4>&nbsp;".__("Auto-Load Locations", SL_TEXT_DOMAIN)."&nbsp;&nbsp;(<input name='sl_load_results_with_locations_default' value='1' type='checkbox' $checked7>&nbsp;&amp;&nbsp;".__("Listing", SL_TEXT_DOMAIN)."&nbsp;(<a href='#info_load_results_default' rel='sl_pop'>?</a>)<div style='display:none;' id='info_load_results_default'>".__("<h2 style='margin-top:0px'>Search Results Listing By Default</h2>Determine whether or not both the map icons and the results listing show when loading locations by default. <br><Br>No results listings are shown even if this is checked, but 'Auto-Load Locations' is unchecked", SL_TEXT_DOMAIN).".</div>)");
###End Defaults###

###Labels###
$sl_mdo['labels'][] = array("label" => "Address Input", "input_template" => "<input name='search_label' value=\"$sl_search_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => "Radius Dropdown", "input_template" => "<input name='sl_radius_label' value=\"$sl_radius_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => "Website URL", "input_template" => "<input name='sl_website_label' value=\"$sl_website_label\" size='14'>");

$sl_mdo['labels'][] = array("label" => "Directions URL", "input_template" => "<input name='sl_directions_label' value=\"$sl_directions_label\" size='14'>");
$sl_mdo['labels'][] = array("label" => "Instruction to Users", "input_template" => "<input name='sl_instruction_message' value=\"".$sl_instruction_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => "City Dropdown", "input_template" => "<input name='sl_city_dropdown_label' value=\"".$sl_city_dropdown_label."\" size='14'>");

$sl_mdo['labels'][] = array("label" => "Location Doesn't Exist", "input_template" => "<input name='sl_location_not_found_message' value=\"".$sl_location_not_found_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => "No Results Are Found", "input_template" => "<input name='sl_no_results_found_message' value=\"".$sl_no_results_found_message."\" size='14'>");
$sl_mdo['labels'][] = array("label" => "Hours", "input_template" => "<input name='sl_hours_label' value=\"".$sl_hours_label."\" size='14'>");

$sl_mdo['labels'][] = array("label" => "Phone", "input_template" => "<input name='sl_phone_label' value=\"".$sl_phone_label."\" size='14'>", "more_info"=>"Yea, yea", "more_info_label"=>"z_phone");
$sl_mdo['labels'][] = array("label" => "Fax", "input_template" => "<input name='sl_fax_label' value=\"".$sl_fax_label."\" size='14'>");
$sl_mdo['labels'][] = array("label" => "Email", "input_template" => "<input name='sl_email_label' value=\"".$sl_email_label."\" size='14'>");
###End Labels###

/*
$sl_mdo['defaults'][] = array("label" => "Locations in Results", "input_template" => <<<EOQ
<input name='sl_num_initial_displayed' value='\$sl_vars[num_initial_displayed]'>
EOQ
);*/


?>