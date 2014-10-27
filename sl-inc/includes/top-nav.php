<?php
$sl_top_nav_hash[]='information';
$sl_top_nav_links[SL_INFORMATION_PAGE]=__("News & Upgrades", SL_TEXT_DOMAIN);

$sl_top_nav_hash[]='locations';
$sl_top_nav_links[SL_MANAGE_LOCATIONS_PAGE]=__("Locations", SL_TEXT_DOMAIN);
	$sl_top_nav_sub_links['locations'][__("Manage", SL_TEXT_DOMAIN)] = SL_MANAGE_LOCATIONS_PAGE;
	$sl_top_nav_sub_links['locations'][__("Add", SL_TEXT_DOMAIN)] = SL_ADD_LOCATIONS_PAGE;

$sl_top_nav_hash[]='mapdesigner'; 
$sl_top_nav_links[SL_MAP_DESIGNER_PAGE]=__("MapDesigner", SL_TEXT_DOMAIN);

if (function_exists("do_sl_hook")){
	do_sl_hook("sl_top_nav_links", "", array(&$sl_top_nav_hash, &$sl_top_nav_links, &$sl_top_nav_sub_links));
}
//do_sl_top_nav();
//function do_sl_top_nav(){
//	global $sl_top_nav_links, $sl_top_nav_sub_links, $sl_top_nav_hash, $sl_version;
	
print "<br>";
$style_var = "";
if (!empty($_POST['sl_thanks'])) {$sl_vars['thanks'] = $_POST['sl_thanks']; unset($_POST);}
$sl_thanks = (!empty($sl_vars['thanks']))? $sl_vars['thanks'] : "";
print <<<EOQ
<ul class="tablist">\n
EOQ;
$ctr=0; $tsn_links_js="<script>\nvar tsn_link_arr = [];"; $tsn_links_output="";
$tm_st = ((time() - strtotime($sl_vars["start"]))/60/60/24>=30);
foreach ($sl_top_nav_links as $key=>$value) {
	$current_var=(preg_match("@$_GET[page]@",$key))? "current_top_link" : "" ;
	if (preg_match("@$_GET[page]@",$key)){
		//$style_var .= "sl_top_nav_init(tsn_link_arr);\n";
	}
print "<li class=\"top_nav_li $sl_top_nav_hash[$ctr]\" id=\"$current_var\"><a href=\"$key\"  id='__$sl_top_nav_hash[$ctr]' class='top_nav_a' style=''>$value</a></li>\n";

	$tsn_links_js.="tsn_link_arr['$sl_top_nav_hash[$ctr]']='';";

	if (!empty($sl_top_nav_sub_links[$sl_top_nav_hash[$ctr]])) {
		$cur = "";
		foreach ($sl_top_nav_sub_links[$sl_top_nav_hash[$ctr]] as $key2=>$value2) {
			if (preg_match("@$sl_top_nav_hash[$ctr]@", $_SERVER['REQUEST_URI'])) {
				if (empty($_GET['pg']) && !preg_match("@&pg@", $value2)) {
					$cur = "current_sub_link";
				} elseif (!empty($_GET['pg']) && preg_match("@$_GET[pg]@", $value2)) {
					$cur = "current_sub_link";
				}  else {
					$cur = "";
				}
				$tsn_links_output.="<a href='$value2' id='$cur'>$key2</a>";
			}
			$tsn_links_js.="tsn_link_arr['$sl_top_nav_hash[$ctr]']+=\"<a href='$value2' id='$cur'>$key2</a>\";";
		}
	}
	$ctr++;
}

$thnks_ct = (!empty($sl_vars['thanks_count']))? $sl_vars['thanks_count'] : 0 ;
if (empty($thnks_ct) || $thnks_ct<=20){
	if (!empty($thnks_ct)){ $sl_vars['thanks_count'] = ($thnks_ct+1); } else { $sl_vars['thanks_count'] = 1; }
} elseif ($thnks_ct>=21 && $sl_thanks!="false" && $sl_thanks!="true") {
	$sl_vars['thanks_count'] = ($thnks_ct+1);
	$style_var .= ($tm_st && $sl_thanks!="false" && $sl_thanks!="true")? "jQuery('#thanks_button').click();\njQuery('.pp_close').css('visibility', 'hidden');\n" : "" ;
}
$tsn_links_js.="jQuery(document).ready(function(){ {$style_var} });\n";
$tsn_links_js.="</script>";

//update plugin link creation
$sl_vars['sl_latest_version_check_time'] = (empty($sl_vars['sl_latest_version_check_time']))? date("Y-m-d H:i:s") : $sl_vars['sl_latest_version_check_time'];
if (empty($sl_vars['sl_latest_version']) || (time() - strtotime($sl_vars['sl_latest_version_check_time']))/60>=(60*12)){ //12-hr db caching of version info
	$plugin_install_url = ABSPATH."wp-admin/includes/plugin-install.php"; //die($plugin_install_url);
	include_once($plugin_install_url);
	$sl_api = plugins_api('plugin_information', array('slug' => 'store-locator', 'fields' => array('sections' => false) ) ); 
	/*need 'true' if trying to include changelog info in future*/
	//var_dump($sl_api); die();
	$sl_latest_version = $sl_api->version; //$sl_version="2.6";
	//$sl_latest_changelog = $sl_api->sections['changelog']; //var_dump($sl_latest_changelog); die();
	//preg_match_all("@<ul>(.*)</ul>@", $sl_latest_changelog, $sl_version_matches); var_dump($sl_version_matches); die();
	
	$sl_vars['sl_latest_version_check_time'] = date("Y-m-d H:i:s");
	$sl_vars['sl_latest_version'] = $sl_latest_version;
} else {
	$sl_latest_version = $sl_vars['sl_latest_version'];
}

if (strnatcmp($sl_latest_version, $sl_version) > 0) { 
	$sl_plugin = SL_DIR . "/store-locator.php";
	$sl_update_link = admin_url('update.php?action=upgrade-plugin&plugin=' . $sl_plugin);
	$sl_update_link_nonce = wp_nonce_url($sl_update_link, 'upgrade-plugin_' . $sl_plugin);
	$sl_update_msg = "&nbsp;|&nbsp;<a href='$sl_update_link_nonce' style='color:#900; font-weight:bold;' onclick='confirmClick(\"You will now be updating to Store Locator v$sl_latest_version, click OK or Confirm to continue.\", this.href); return false;'>Update to $sl_latest_version</a>";
} else {
	$sl_update_msg = "";
}


print "<span style='padding-left:10px; color:gray; position:relative; top:10px; font-size:11px'>Version $sl_version{$sl_update_msg}</span></ul>\n";
//if (preg_match("@addon-settings@", $_GET['page'])){
	print "<div class='top_sub_nav' id='top_sub_nav'><div id='inner_div' style='display:inline; height:inherit;'>$tsn_links_js{$tsn_links_output}</div>";
	if (function_exists("do_sl_hook")) { do_sl_hook("sl_nav_buttons_right"); }
	if ($sl_thanks!="false" && $sl_thanks!="true") {
		//&& $tm_st
		print "<input rel='sl_pop' type='button' class='button-primary' onclick='return false;' id='thanks_button' href='".SL_INCLUDES_BASE."/thank-you.php?ajax=true' style='margin-right:10px; font-weight:bold; margin:5px; background:green; float:right;' value='My Views'/>";
	}
	print "</div>";
//}

/*<li style="margin-left:15px; margin-bottom:0px;"><strong>Introducing: </strong><a href="#" onclick="window.parent.open('http://'+'www.viadat.com/products-page/early-access/');return false;">Early Access Stage 1 - Individual Addons</a> -- Limited access; first come, first serve</li>*/

# v3.0 -- What's New
if (!empty($_GET['sl_a_s_v3']) && $_GET['sl_a_s_v3'] == 1){sl_data('sl_a_s_check_v3', 'add', 'hide'); }
if (sl_data('sl_a_s_check_v3')!='hide') {
print "<br><div class='sl_admin_success' style='line-height: 22px; width:97%'>
<div style='background-color:lightYellow; border-top:solid gold 1px; border-bottom:solid gold 1px; padding:5px; /*background-image:url(".SL_IMAGES_BASE_ORIGINAL."/logo.small.png); background-repeat:no-repeat; padding-left:45px; background-position-y:10px;*/'><img src='".SL_IMAGES_BASE_ORIGINAL."/logo.small.png' style='vertical-align:middle'>&nbsp;<b>Welcome to LotsOfLocales&trade; -- WordPress Store Locator, <span style='color:#900; font-size:16px;'>v{$sl_version}</span>. What's New?: </b></div>
<div style='padding:7px'><strong style='font-size:1.0em'>A.</strong>&nbsp;<b>Introducing:</b> <a href='http://www.viadat.com/products-page/early-access-entry/' target='_blank'>Early Access</a>: Individual addons + benefits to you, our users -- earliest joiners reap the highest upcoming benefits</div> 
<div style='background-color:lightYellow; /*border-top:solid gold 1px; border-bottom:solid gold 1px; */padding:7px'><strong style='font-size:1.0em'>B.</strong>&nbsp;<b><a href='http://docs.viadat.com/Addons_Platform_Lite' target='_blank'>Addons Platform Lite</a>:</b> Power of the full Addons Platform, minus the Addons Marketplace.  Now you have the flexibility to buy addons as you need.</div>
<div style='padding:7px'><strong style='font-size:1.0em'>C.</strong>&nbsp;<b><a href='http://docs.viadat.com/Super_Geocoder' target='_blank'>Super Geocoder</a> addon:</b>&nbsp;Tackles problematic geocoding quotas for users -- install, activate, and watch it perform on those tough locations that the Store Locator's default geocoder doesn't catch.</div>
<div style='padding:7px'><strong style='font-size:1.0em'>D.</strong>&nbsp;<b>New Icons & Back to 3D w/Shadowing:</b> refreshed icons that provide some depth to your map's interface.</div>
<div style='background-color:lightYellow; border-top:solid gold 1px; border-bottom:solid gold 1px; padding:7px;'><b>Note:</b> To display the Store Locator, type <strong style='font-size:1.0em'>[STORE-LOCATOR]</strong> into a <a href='".admin_url("edit.php?post_type=page")."'>Page</a> or <a href='".admin_url("edit.php")."'>Post</a> <br>or use the code <b>&lt;?php if (function_exists('sl_template')) {print sl_template('[STORE-LOCATOR]');} ?&gt;</b> in a page template.</div> 
<br>
(<a href='".$_SERVER['REQUEST_URI']."&sl_a_s_v3=1'>Hide Message</a>)
</div>

 <div id='las-info' style='display:none; line-height:20px;'>
 <b style='font-size:1.3em'><br>LotsOfLocales&trade; Addons Platform</b>
<ol style='line-height:20px'>
 <li>Provides you with an addons management page for updating settings and activating each of your addons</li>
 <li>Allows you to conveniently browse and install addons directly from this admin area from the Addons Marketplace to enhance your Store Locator's abilities</li>
<li>Create multiple Store locators on different Pages or Posts on your website using the format: <div class='code sl_code'>[STORE-LOCATOR {tag_name}={tag_value}, ...] (One of the many addon features available)</div> </li>
<li>Backwards-compatible with addons purchased before version 2.0, including the CSV Importer, DB Importer, & Multiple Field Updater</li>
<li>Learn more about G2 Addons that come with the purchase of the LotsOfLocales&trade; Addons Platform from the 'ReadMe Instructions' in the pull-out Dashboard</li>
</ol>
</div>";
}

# Notice about having cURL off
if (!extension_loaded("curl")) {
	if (!empty($_GET['curl_msg']) && $_GET['curl_msg'] == 1){sl_data('curl_msg', 'add', 'hide'); }
	if (sl_data('curl_msg')!='hide') {
		print "<br><div class='sl_admin_warning' style='line-height: 22px; width:97%'>
		It appears that you do not have <a href='http://us3.php.net/manual/en/book.curl.php' target='_blank'>cURL</a> actively running on this website.  cURL or <a href='http://us3.php.net/manual/en/function.file-get-contents.php' target='_blank'>file_get_contents()</a> needs to be active in order to receive coordinates for locations, validate addons, and other important actions performed by Store Locator.
		<br>
(<a href='".$_SERVER['REQUEST_URI']."&curl_msg=1'>Hide Message</a>)
		</div>";
			
	}
}

if (!empty($_POST) && function_exists("do_sl_hook")){ do_sl_hook("sl_admin_form_post"); /*print "<br>";*/ }
if (function_exists("do_sl_hook")) { do_sl_hook("sl_admin_data"); } 
?>
<div id="slideout">
	<div id="clickme"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style='font-family:georgia; position:relative; top:-10px;'><?php print __("Dashboard", SL_TEXT_DOMAIN); ?></b>
	</div>
	<div id="slidecontent">
	   <div id='slidecontainer'>
		<div style='width:50%; float:left'><?php sl_module("thanks", __("My Views", SL_TEXT_DOMAIN)."", "240px");  ?></div>
		<div style='width:50%; float:right'><?php sl_module("readme", __("Information & ReadMe Instructions", SL_TEXT_DOMAIN), "240px");  ?></div>
		<div style='width:50%; float:left'><?php sl_module("news", __("Latest News", SL_TEXT_DOMAIN), "270px"); ?></div>
		<div style='width:50%; float:left'><?php sl_module("keys", __("Activation Keys", SL_TEXT_DOMAIN)."<img style='float:right; opacity:0; height:20px;' id='module-keys' src='".SL_IMAGES_BASE_ORIGINAL."/loading.gif'>", "270px"); ?></div>
	   </div>
	</div>
</div>
<div id='validation_status' style='display:none;'><h3 style='margin-top:0px'>Validation Status</h3><div style='width:90%'></div></div>
<?php  sl_data('sl_vars', 'update', $sl_vars); ?>