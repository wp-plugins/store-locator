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
print "if (document.getElementById('map')){window.onunload = GUnload;}
		var add_base='".$sl_base."';		
		var sl_map_home_icon='".get_option('sl_map_home_icon')."';
		var sl_map_end_icon='".get_option('sl_map_end_icon')."';
		var sl_google_map_country='".get_option('sl_google_map_country')."';
		var sl_zoom_level=$zl;";
$home_size=getimagesize(get_option('sl_map_home_icon'));
print "var sl_map_home_icon_width=$home_size[0];";
print "var sl_map_home_icon_height=$home_size[1];";

$end_size=getimagesize(get_option('sl_map_end_icon'));
print "var sl_map_end_icon_width=$end_size[0];";
print "var sl_map_end_icon_height=$end_size[1];";

?>