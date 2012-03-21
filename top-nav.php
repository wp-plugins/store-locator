<style>
.tablist {
    list-style:none; 
    height:2.5em;
    padding:0; 
    margin:0; 
    border-bottom: solid #5589AA 1px;
}
.tablist li {
    float:left; 
    margin-right:0.13em; 
}
.tablist li a {
    display:block;
    padding:0 1em;
    text-decoration:none;
    border: 1px solid gray;
    border-bottom:0;
    font:bold 1.1em/2.2em arial,geneva,helvetica,sans-serif;
    color:#000;
    background-color:#fff;

    /* CSS 3 elements */
    webkit-border-top-right-radius:0.50em;
    -webkit-border-top-left-radius:0.50em;
    -moz-border-radius-topright:0.50em;
    -moz-border-radius-topleft:0.50em;
    border-top-right-radius:0.50em;
    border-top-left-radius:0.50em;
}

.tablist li a:hover {
    background:white; 
    color:maroon;
    text-decoration:none;
}
.tablist li#current a {
    background-color: #5589AA;
    background-image: -moz-linear-gradient(center bottom , #5589AA, #619BBB);
	text-shadow:0 -1px 0 #333333;
    color: #fff;
	border-bottom:none;
	/*font-weight:bold;*/
}
.tablist li#current a:hover {
	background-color: #5589AA;
    background-image: -moz-linear-gradient(center bottom , #5589AA, #619BBB);
}
</style>
<br>
<?php

$root=$_SERVER[DOCUMENT_ROOT];
$subdir=substr(dirname($_SERVER["PHP_SELF"]),1);
$folders=split("/",$subdir);
$num_folders=count($folders);
$current_dir=$folders[$num_folders-1];


$links[$top_nav_base.'/news-upgrades.php']=__("News & Upgrades", $text_domain);
$links[$top_nav_base.'/view-locations.php']=__("Manage Locations", $text_domain);
$links[$top_nav_base.'/add-locations.php']=__("Add Locations", $text_domain);
$links[$top_nav_base.'/map-designer.php']=__("Map Designer", $text_domain);
$links[$top_nav_base.'/api-key.php']=__("Localization", $text_domain)." &amp; ".__("Google API Key", $text_domain);
$links[$top_nav_base.'/readme.php']=__("ReadMe", $text_domain);

$hash[]='news-upgrades';
$hash[]='view-locations';
$hash[]='add-locations'; 
$hash[]='map-designer'; 
$hash[]='api-key';
$hash[]='readme';

/*
$links[$top_nav_base.'/navigator.php#news-upgrades']=__("News & Upgrades", $text_domain);
$links[$top_nav_base.'/navigator.php#view-locations']=__("Manage Locations", $text_domain);
$links[$top_nav_base.'/navigator.php#add-locations']=__("Add Locations", $text_domain);
$links[$top_nav_base.'/navigator.php#api-key']=__("Localization", $text_domain)." &amp; ".__("Google API Key", $text_domain);
$links[$top_nav_base.'/navigator.php#readme']=__("ReadMe", $text_domain);
*/
print <<<EOQ
<ul class="tablist"><!--div id="navlist"-->
EOQ;
$ctr=0;
foreach ($links as $key=>$value) {

$var=(ereg($_GET["page"],$key))?"current":"";

//$var="current"; // 7/18/08 -- forcing every link to have this ID for the time being
/*if (ereg("http://", $key)) {
	$link="$key";
}
elseif ($key!="home") {
	$link="/$key";
}
else {
	$link="/";
}*/

/*	print <<<EOQ
      <li><a href="$link" id="$var">$value</a></li>
EOQ;*/

//$class_label=($key=="contact") ? " class='smcf-link' " : "" ;
//$wp_query=new WP_Query;
//$current=((ereg($_SERVER[REQUEST_URI],$key) && $_SERVER[REQUEST_URI]!="/") || ($link=="http://www.viadat.com/" && $_SERVER[REQUEST_URI]=="/"))? "current_page_item" : "" ;
//$current.=($link=="http://www.viadat.com/store-locator/" /*&& $_SERVER[REQUEST_URI]!="/store-locator/"*/)? " special" : "" ;
print <<<EOQ
      <li class="top_nav_li $hash[$ctr]" id='$var'><a href="$key"  id='__$hash[$ctr]' class='top_nav_a' style=''>$value</a></li>  
EOQ;
$ctr++;
}
print "</ul> <!--script>alert('$_SERVER[QUERY_STRING]');</script--> <!--/div-->";

?>
<br>
<?php
if (trim(get_option('store_locator_api_key'))=="") {
print "<div class='sl_admin_warning'>
<strong>".__("Update Your Google API Key", $text_domain)." <a href='$top_nav_base/api-key.php'>here</a> </strong><br><br>
<div class=''><strong><a href='https://developers.google.com/maps/documentation/javascript/v2/introduction#Obtaining_Key' target='_blank'>".__("Get your Google API Key", $text_domain)."</a></strong>&nbsp;(".__("link updated as of Store Locator v1.4",$text_domain).")<br>(".__("You'll need to log in with your Google account on the page that opens up. If you don't have an account", $text_domain).", <a href='https://www.google.com/accounts/' target='_blank'>".__("sign up here", $text_domain)."</a>.)</div>
</div><br>";
}
?>