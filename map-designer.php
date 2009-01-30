<div class='wrap'>
<?php 

if ($_POST) {
$_POST[height]=ereg_replace("[^0-9]", "", $_POST[height]);
$_POST[width]=ereg_replace("[^0-9]", "", $_POST[width]);
update_option('sl_map_height', $_POST[height]);
update_option('sl_map_width', $_POST[width]);
update_option('sl_map_radii', $_POST[radii]);
update_option('sl_map_height_units', $_POST[height_units]);
update_option('sl_map_width_units', $_POST[width_units]);
update_option('sl_map_home_icon', $_POST[icon]);
update_option('sl_map_end_icon', $_POST[icon2]);
update_option('sl_map_theme', $_POST[theme]);
update_option('sl_search_label', $_POST[search_label]);
update_option('sl_zoom_level', $_POST[zoom_level]);

print "<div class='highlight'>".__("Successful Update", $text_domain)." $view_link</div> <!--meta http-equiv='refresh' content='0'-->";
}
print "<h2>".__("Map Designer", $text_domain)."</h2><br><form method='post' name='mapDesigner'><table class='widefat'><thead><tr><td>".__("Option", $text_domain)."</td><td>".__("Value", $text_domain)."</td></tr></thead>";
initialize_variables();

$icon_dir=opendir($sl_path."/icons/");
 
while (false !== ($an_icon=readdir($icon_dir))) {
if (!ereg("^\.{1,2}$", $an_icon) && !ereg("shadow", $an_icon)) {

$icon_str.="<img style='cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='$sl_base/icons/$an_icon' onclick='document.forms[\"mapDesigner\"].icon.value=this.src;document.getElementById(\"prev\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
}
}

$icon_dir=opendir($sl_path."/icons/");
while (false !== ($an_icon=readdir($icon_dir))) {

if (!ereg("^\.{1,2}$", $an_icon) && !ereg("shadow", $an_icon)) {

$icon2_str.="<img style='cursor:hand; cursor:pointer; border:solid white 2px; padding:2px' src='$sl_base/icons/$an_icon' onclick='document.forms[\"mapDesigner\"].icon2.value=this.src;document.getElementById(\"prev2\").src=this.src;' onmouseover='style.borderColor=\"red\";' onmouseout='style.borderColor=\"white\";'>";
}
}

$theme_dir=opendir($sl_path."/themes/"); 

while (false !== ($a_theme=readdir($theme_dir))) {
if (!ereg("^\.{1,2}$", $a_theme) && !ereg("\.(php|txt|htm(l)?)", $a_theme)) {

$selected=($a_theme==get_option('sl_map_theme'))? " selected " : "";

$theme_str.="<option value='$a_theme' $selected>$a_theme</option>\n";
}
}
$zl[]=0;$zl[]=1;$zl[]=2;$zl[]=3;$zl[]=4;$zl[]=5;$zl[]=6;$zl[]=7;$zl[]=8;
$zl[]=9;$zl[]=10;$zl[]=11;$zl[]=12;$zl[]=13;$zl[]=14;$zl[]=15;$zl[]=16;
$zl[]=17;$zl[]=18;$zl[]=19;

$zoom="<select name='zoom_level'>";
foreach ($zl as $value) {
	$zoom.="<option value='$value' ";
	if (get_option('sl_zoom_level')==$value){ $zoom.=" selected ";}
	$zoom.=">$value</option>";
}
$zoom.="</select>";


print "
<tr><td>".__("Address Input Label", $text_domain).":</td>
<td><input name='search_label' value='$search_label'></td></tr>
<tr><td>".__("Default Map Zoom Level", $text_domain).":</td>
<td>$zoom</td></tr>
<tr><td>".__("Map Height", $text_domain).":</td>
<td><input name='height' value='$height'>&nbsp;".choose_units($height_units, "height_units")."</td></tr>
<tr><td>".__("Map Width", $text_domain).": </td>
<td><input name='width' value='$width'>&nbsp;".choose_units($width_units, "width_units")."</td></tr>
<tr><td>".__("Map Radii Options (in miles)", $text_domain).":<br>(1 mile ~ 1.61 kilometers) </td>
<td><input  name='radii' value='$radii' size='70'><br><br>".__("Note: Seperate each number with a comma ',' , and put paratheseses '( )' around the default radius you would like to show", $text_domain)."</td></tr>
<tr><td valign='top'>".__("Choose Theme", $text_domain)."</td><td valign='top'> <select name='theme' onchange=\"\"><option value=''>".__("No Theme Selected", $text_domain)."</option>$theme_str</select> <br><br></td></tr>
<tr><td valign='top'>".__("Home Icon", $text_domain).":</td>
<td valign='top'> <input name='icon' size='70' value='$icon' onchange=\"document.getElementById('prev').src=this.value\">&nbsp;&nbsp;<img id='prev' src='$icon'> <br><div style=''>$icon_str</div><br></td></tr>
<tr><td valign='top'>".__("Destination Icon", $text_domain).":</td>
<td valign='top'> <input name='icon2' size='70' value='$icon2' onchange=\"document.getElementById('prev2').src=this.value\">&nbsp;&nbsp;<img id='prev2' src='$icon2'> <br><div style=''>$icon2_str</div><br></td></tr>
<tr><td colspan='2'><div class=''><b>".__("Looking to create or find a unique icon? For ideas, visit", $text_domain)." <a href='http://mapki.com/index.php?title=Icon_Image_Sets' target='_blank'>http://mapki.com/index.php?title=Icon_Image_Sets</a></b></div></td></tr>
<tr><td colspan='2'><input type='submit' value='".__("Update", $text_domain)."' class='button'></td></tr></table></form>";

?>
</div>