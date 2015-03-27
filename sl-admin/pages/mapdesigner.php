<?php
//include("variables.sl.php");
include_once(SL_INCLUDES_PATH."/top-nav.php");
?>
<div class='wrap'>
<?php 

if (empty($_POST)) {sl_move_upload_directories();}
if (!empty($_POST['sl_map_type'])) { //shouldn't just be "$_POST"; use an index that should always have a value - 12/9/14
    //$sl_vars=sl_data('sl_vars');
    function sl_md_save($data) {
	global $sl_vars;
	
	//MapDesigner header inputs & Geolocate true/false (based on Auto-locate value)
	$sl_vars['map_language']=$_POST['sl_map_language'];
	
	$sl_map_region_arr=explode(":", $_POST['map_region']);
	$sl_vars['google_map_country']=$sl_map_region_arr[0];
	$sl_vars['google_map_domain']=$sl_map_region_arr[1];
	$sl_vars['map_region']=$sl_map_region_arr[2];
	$sl_vars['api_key']=$_POST['sl_api_key'];
	
	$sl_vars['sensor']=(empty($_POST['sl_geolocate']))? "false" : "true";
	//end

	foreach ($data as $value) {
	    
	    if (!empty($value['field_name'])) {
		$fname = $value['field_name'];
	
		if (!empty($value['field_type']) && $value['field_type'] == "checkbox") {
			//checkbox submissions need to save unchecked (empty) $_POST values as zero
			if (is_array($fname)) {
				foreach ($fname as $the_field) {
					$sl_vars[$the_field] = (empty($_POST["sl_".$the_field]))? 0 : $_POST["sl_".$the_field] ;
				}
			} else {
				$sl_vars[$fname] = (empty($_POST["sl_".$fname]))? 0 : $_POST["sl_".$fname] ;
			}
		} else {
			if (is_array($fname)) {
				$fctr = 0;
				foreach ($fname as $the_field) {
					$post_data = (isset($_POST["sl_".$the_field]))? $_POST["sl_".$the_field] : $_POST[$the_field] ;
					$post_data = (!empty($value['stripslashes'][$fctr]) && $value['stripslashes'][$fctr] == 1)? stripslashes($post_data) : $post_data;
					$post_data = (!empty($value['numbers_only'][$fctr]) && $value['numbers_only'][$fctr] == 1)? preg_replace("@[^0-9]@", "", $post_data) : $post_data;
					$sl_vars[$the_field] = $post_data;
					$fctr++;
				}
			} else {
				$post_data = (isset($_POST["sl_".$fname]))? $_POST["sl_".$fname] : $_POST[$fname] ;
				$post_data = (!empty($value['stripslashes']) && $value['stripslashes'] == 1)? stripslashes($post_data) : $post_data;
				$post_data = (!empty($value['numbers_only']) && $value['numbers_only'] == 1)? preg_replace("@[^0-9]@", "", $post_data) : $post_data;
				$sl_vars[$fname] = $post_data;
			}
		}
	    }
	    
	}

	sl_data('sl_vars', 'update', $sl_vars);
	
    }
    
    include(SL_INCLUDES_PATH."/mapdesigner-options.php");
    sl_md_save($sl_mdo);
    unset($sl_mdo);  //needs to be unset here in order for the latest updated values to show up when md options are included a 2nd time below for display
 

	print "<div class='sl_admin_success' >".__("Successful Update", SL_TEXT_DOMAIN)." $view_link</div> <!--meta http-equiv='refresh' content='0'-->";
}

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


function sl_md_display($data, $input_zone, $template, $additional_classes = "") {
    print "<table class='map_designer_section {$additional_classes}'>";
    
    $labels_ctr = 0;
    foreach ($data as $key => $value) {
      
      if ($value['input_zone'] == $input_zone) {
    
    	if ($template == 1) {
		//foreach ($data as $key => $value) {
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
		//}
    	} elseif ($template == 2) {
		
		//foreach ($data as $key => $value) {
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
	//}
    	}
    	
      }
    	
    }
    
    print "</table>";
}

include(SL_INCLUDES_PATH."/mapdesigner-options.php");

print "<tr><td colspan='1' width='45%' class='left_side' style='vertical-align:top'><h2>".__("Defaults", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo, 'defaults', 1);

print "</td>";
print "<!--tr--><td colspan='1' width='50%' style='vertical-align:top'><h2>".__("Labels", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo, 'labels', 2, "right_side");

print "</td></tr>
<tr><td colspan='1' class='left_side' style='vertical-align:top; border-bottom:0px'><h2>".__("Dimensions", SL_TEXT_DOMAIN)."</h2>";

sl_md_display($sl_mdo, 'dimensions', 1);

print "</td><!--/tr>
<tr--><td colspan='1' style='vertical-align:top; border-bottom:0px'><h2>".__("Design", SL_TEXT_DOMAIN)."</h2>
$icon_notification_msg";

sl_md_display($sl_mdo, 'design', 1, "right_side");

print "</td></tr>
<tr><td colspan='2'>$update_button</td></tr></table></form>";

?>
</div>
<?php include(SL_INCLUDES_PATH."/sl-footer.php"); ?>