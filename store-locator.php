<?php
/*
Plugin Name: Store Locator
Plugin URI: http://www.viadat.com/category/store-locator
Description: Wordpress Store locator plugin for individuals & businesses who want to show the locations of their stores or products.
Version: 1.0
Author: Viadat Creations
Author URI: http://www.viadat.com
*/

$db_version=1.0;
include_once("variables.sl.php");
include_once("functions.sl.php");

register_activation_hook( __FILE__, 'install_table');

//add_action('wp_head', 'install_table');

add_action('wp_head', 'head_scripts');
//add_action('wp_footer', 'foot_scripts');

add_filter('the_content', 'ajax_map', 7);

add_action('admin_head', 'sl_add_options_page');

load_plugin_textdomain($text_domain, "/wp-content/plugins/$sl_dir/languages/");

?>