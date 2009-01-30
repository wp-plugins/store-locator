<div class='wrap'>
<Table class='widefat' cellpadding='0px' cellspacing='0px'><thead><tr>
<th width='50%'>
Latest News
</th>
<th width='50%'>
Addons & Themes
</th>
</tr>
</thead>
<tr>
<td><div style='overflow:scroll; height:350px; padding:7px;'>
<script src="http://feeds.feedburner.com/Viadat?format=sigpro" type="text/javascript" ></script><noscript><p>Subscribe to RSS headline updates from: <a href="http://feeds.feedburner.com/Viadat"></a><br/>Powered by FeedBurner</p> </noscript>
</td>
<td><div style='overflow:scroll; height:350px; padding:7px;'>
<?php
// include lastRSS library
include_once ("lastRSS.php");
// create lastRSS object
$rss = new lastRSS; 
// setup transparent cache
$rss->cache_dir = './cache'; 
$rss->cache_time = 3600; // one hour
// load some RSS file
if ($rs = $rss->get('http://www.viadat.com/index.php?rss=true&action=product_list')) {
	//var_dump($rs);
$c=1;
	foreach ($rs[items] as $value) {

if ($c<=10) {
	print "<!--li class='sl_product_rss'--><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:12px'>$value[title]</a><br><span class='home_rss'> ".str_replace("]]>","",str_replace("</p>", "", html_entity_decode($value[description])))."</span><!--/li--><br><br>";
}
else {
	print "<!--ul-->";
	if ($c<=4)
	print "<li style='font-size:10px; color:black; position:relative; left:10px'><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:11px'>$value[title]</a></li>";
	print "<!--/ul-->";
}
$c++;
	}	
}

?>
</div>
</td>
</tr>
<thead><tr>
<th width='100%' colspan='2'>
License Keys
</th>
</tr></thead>
<tr>
<td colspan='2'><div style='overflow:scroll; height:500px; padding:7px;'>
<?php

if ($_POST) {
	include("updateLicenses.php");
}

$ao_dir=opendir($sl_path."/addons/"); 
while (false !== ($a_lic=readdir($ao_dir))) {
	if (!ereg("^\.{1,2}$", $a_lic)) {

		if (get_option('sl_activation_'.$a_lic)!="") {
			$a_lic_arr["sl_activation_".$a_lic]=get_option('sl_activation_'.$a_lic);
		}
		if (get_option('sl_license_'.$a_lic)!="") {
			$a_lic_arr["sl_license_".$a_lic]=get_option('sl_license_'.$a_lic);
		}
	$lic_str.="<b>".ucwords(ereg_replace("-", " ", $a_lic))."</b>
<table>
<tr>
<td>License Key:</td>
<td><input name='sl_license_".$a_lic."' value='".$a_lic_arr["sl_license_".$a_lic]."'></td></tr>
<tr><td>Activation Code:</td>
<td><input name='sl_activation_".$a_lic."' value='".$a_lic_arr["sl_activation_".$a_lic]."' readonly><br>
(auto-populates when proper license is entered)</td></tr>
</table>
<br><br>";
	}
}

print "<form method='post' name='licenseForm'>$lic_str<br><input type='submit' value='Update All' class='button'></form>";
?>
</div>
</td>
</tr>
</table>

</div>