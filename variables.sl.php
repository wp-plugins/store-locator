<?php

global $sl_dir, $sl_base;
$text_domain="lol";
$sl_dir=dirname(plugin_basename(__FILE__)); //plugin absolute server directory name
$sl_base=get_option('siteurl')."/wp-content/plugins/".$sl_dir; //URL to plugin directory
$sl_path=ABSPATH."wp-content/plugins/".$sl_dir; //absolute server pather to plugin directory
//$prev=$wpdb->get_results("select ID, guid from ".$wpdb->prefix."posts where post_content like '%[STORE-LOCATOR%' AND post_type<>'revision' LIMIT 1", ARRAY_A);
$view_link="| <a href='".get_option('siteurl')."/wp-admin/admin.php?page=$sl_dir/view-locations.php'>".__("View All Locations", $text_domain)."</a>";// | <a href='{$prev[0][guid]}' target='_blank'>".__("Preview User Interface", $text_domain)."</a>";
$web_domain=$_SERVER[HTTP_HOST];
?>