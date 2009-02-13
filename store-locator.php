<?php
/*
Plugin Name: Store Locator
Plugin URI: http://www.viadat.com/store-locator
Description: A store locator / location finder plugin focused on providing mapping tools for web designers & developers who create sites in Wordpress & web site owners needing to show important stores or any other type of location.
Version: 1.2.14
Author: Viadat Creations
Author URI: http://www.viadat.com
*/

$sl_db_version=1.2;
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