<?php
if (file_exists("./wp-config.php")){include("./wp-config.php");}
elseif (file_exists("../wp-config.php")){include("../wp-config.php");}
elseif (file_exists("../../wp-config.php")){include("../../wp-config.php");}
elseif (file_exists("../../../wp-config.php")){include("../../../wp-config.php");}
elseif (file_exists("../../../../wp-config.php")){include("../../../../wp-config.php");}
elseif (file_exists("../../../../../wp-config.php")){include("../../../../../wp-config.php");}
elseif (file_exists("../../../../../../wp-config.php")){include("../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../wp-config.php")){include("../../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../../wp-config.php")){include("../../../../../../../../wp-config.php");}
include("../variables.sl.php");
$zl=(trim(get_option('sl_zoom_level'))!="")? get_option('sl_zoom_level') : 4;
$mt=(trim(get_option('sl_map_type'))!="")? get_option('sl_map_type') : "G_NORMAL_MAP";
$wl=(trim(get_option('sl_website_label'))!="")? get_option('sl_website_label') : "Website";
$du=(trim(get_option('sl_distance_unit'))!="")? get_option('sl_distance_unit') : "miles";
$oc=(trim(get_option('sl_map_overview_control'))!="")? get_option('sl_map_overview_control') : 0;
print "if (document.getElementById('map')){window.onunload = GUnload;}
var add_base='".$sl_base."';\r\n		
var sl_map_home_icon='".get_option('sl_map_home_icon')."';\r\n
var sl_map_end_icon='".get_option('sl_map_end_icon')."';\r\n
var sl_google_map_country='".get_option('sl_google_map_country')."';\r\n
var sl_google_map_domain='".get_option('sl_google_map_domain')."';\r\n
var sl_zoom_level=$zl;\r\n
var sl_map_type=$mt;\r\n
var sl_website_label='$wl';\r\n
var sl_load_locations_default='".get_option('sl_load_locations_default')."';\r\n
var sl_distance_unit='$du';\r\n
var sl_map_overview_control=$oc;\r\n";

$home_icon_path=ereg_replace($sl_base, $sl_path, get_option('sl_map_home_icon'));
$home_size=(function_exists(getimagesize) && file_exists($home_icon_path))? getimagesize($home_icon_path) : array(0 => 20, 1 => 34);
//$home_size=($home_size[0]=="")? array(0 => 20, 1 => 34) : $home_size;
print "var sl_map_home_icon_width=$home_size[0];\r\n";
print "var sl_map_home_icon_height=$home_size[1];\r\n";

$end_icon_path=ereg_replace($sl_base, $sl_path, get_option('sl_map_end_icon'));
$end_size=(function_exists(getimagesize) && file_exists($end_icon_path))? getimagesize($end_icon_path) : array(0 => 20, 1 => 34);
//$end_size=($end_size[0]=="")? array(0 => 20, 1 => 34) : $end_size;
print "var sl_map_end_icon_width=$end_size[0];\r\n";
print "var sl_map_end_icon_height=$end_size[1];\r\n";
?>