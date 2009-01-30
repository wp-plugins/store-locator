<?php
/*
Plugin Name: Store Locator
Plugin URI: http://www.viadat.com/store-locator
Description: Lots of Locales - A Store Locator / Location Finder plugin focused on providing robust mapping tools for Web Designers & Developers who create sites in Wordpress.
Version: 1.1
Author: Viadat Creations
Author URI: http://www.viadat.com
*/

$sl_db_version=1.1;
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