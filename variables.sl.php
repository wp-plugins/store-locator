<?php

global $sl_dir, $sl_base;
$sl_dir=dirname(plugin_basename(__FILE__)); //plugin absolute server directory name
$sl_base=get_option('siteurl')."/wp-content/plugins/".$sl_dir; //URL to plugin directory
$sl_path=ABSPATH."wp-content/plugins/".$sl_dir; //absolute server pather to plugin directory
$view_link="| <a href='".get_option('siteurl')."/wp-admin/admin.php?page=$sl_dir/view-locations.php'>".__("View All Locations")."</a>";
$web_domain=$_SERVER[HTTP_HOST];
//print "$sl_dir, $sl_base";

?>