<?php
/*
Plugin Name: Store Locator
Plugin URI: http://www.viadat.com/store-locator
Description: A store locator / location finder plugin focused on providing mapping tools for web designers & developers who create sites in Wordpress & web site owners needing to show important stores or any other type of location.
Version: 1.2.28.1
Author: Viadat Creations
Author URI: http://www.viadat.com
*/

$sl_version="1.2.28.1";
$sl_db_version=1.2;
include_once("variables.sl.php");
include_once("functions.sl.php");
include_once("via-latest.php");

register_activation_hook( __FILE__, 'install_table');

//add_action('wp_head', 'install_table');

add_action('wp_head', 'head_scripts');
//add_action('wp_footer', 'foot_scripts');

add_filter('the_content', 'ajax_map', 7);

add_action('admin_menu', 'sl_add_options_page');

load_plugin_textdomain($text_domain, "/wp-content/plugins/$sl_dir/languages/");

add_filter('option_update_plugins', 'plugin_prevent_upgrade');
add_filter('transient_update_plugins', 'plugin_prevent_upgrade');
function plugin_prevent_upgrade($opt) {
$plugin = plugin_basename(__FILE__);
if ( $opt && isset($opt->response[$plugin]) ) {
//Theres an update. Remove automatic upgrade:
$opt->response[$plugin]->package = '';
//Now we've prevented the upgrade taking place, It might be worth to give users a note that theres an update available:
add_action("after_plugin_row_$plugin", 'plugin_update_disabled_notice');
}
return $opt;
}
function plugin_update_disabled_notice() {
global $sl_dir;
echo '<tr><td class="plugin-update" colspan="5" style="text-align:center">Use the <a href="./admin.php?page='.$sl_dir.'/news-upgrades.php"><b>Quick Updater</b></a> or <a href="http://www.viadat.com/vdl/store-locator.zip">Download the latest version</a></td></tr>';
}
?>