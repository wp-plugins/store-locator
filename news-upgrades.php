<?php

print "
<div class='wrap'>
<Table class='widefat' cellpadding='0px' cellspacing='0px'>
<tr><td valign='top' width='50%'>

<table width='100%'><thead><tr>
<th>".
__("Latest News", $text_domain).
"</th>
</tr>
</thead>
<tr>
<td width='50%'><div style='overflow:scroll; height:350px; padding:7px;'>
<script src='http://feeds.feedburner.com/Viadat?format=sigpro' type='text/javascript' ></script><noscript><p>Subscribe to RSS headline updates from: <a href='http://feeds.feedburner.com/Viadat'></a><br/>Powered by FeedBurner</p> </noscript>";
/*
// include lastRSS library
include_once ("lastRSS.php");
// create lastRSS object
$rss = new lastRSS; 
// setup transparent cache
$rss->cache_dir = './cache'; 
$rss->cache_time = 3600; // one hour
// load some RSS file
if ($rs = $rss->get('http://feeds.feedburner.com/Viadat')) {
	print_r($rs);
$c=1;
foreach ($rs[items] as $value) {

if ($c<=100) {
	print "<li><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:12px'>
	<b>$value[title]</b></a></li>
	<br>
	<span class='home_rss'> ".
	str_replace("]]>","",str_replace("</p>", "", html_entity_decode(nl2br($value[description])))).
	"</span><br><br>";
}
else {
	if ($c<=4)
	print "<li style='font-size:10px; color:black; position:relative; left:10px'><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:11px'>$value[title]</a></li>";
	}
$c++;
	}	
}
*/

print "</td>
</tr></table>

<table width='100%'>
<thead><tr>
<th colspan='1'>".
__("Activation Keys", $text_domain).
"</th>
</tr></thead>
<tr>
<td colspan='1'><div style='overflow:scroll; height:300px; padding:7px;'>";

if ($_POST) {
	include("updateLicenses.php");
}

$ao_dir=opendir($sl_path."/addons/");
print "<table width='100%' border='0'><tr>"; 
while (false !== ($a_lic=readdir($ao_dir))) {
	if (!ereg("^\.{1,2}$", $a_lic) && !ereg("\.(php|txt|htm(l)?)", $a_lic)) {

			$style="style='border:red; background-color:salmon'";
		if (get_option('sl_activation_'.$a_lic)!="") {
			$a_lic_arr["sl_activation_".$a_lic]=get_option('sl_activation_'.$a_lic);
			$style="style='border:green; background-color:LightGreen'";
		}
		if (get_option('sl_license_'.$a_lic)!="") {
			$a_lic_arr["sl_license_".$a_lic]=get_option('sl_license_'.$a_lic);
			
		}
$lic_str.="<td><div class='highlight' $style><b>".ucwords(ereg_replace("-", " ", $a_lic))."</b></div>
<table style='border:none'>
<tr>
<td>".__("Key", $text_domain).":</td></tr>
<tr><td><input name='sl_license_".$a_lic."' value='".$a_lic_arr["sl_license_".$a_lic]."' size=25>
<input name='sl_activation_".$a_lic."' value='".$a_lic_arr["sl_activation_".$a_lic]."' type='hidden'></td></tr>
</table>
</td>";

if ($ctr%2==1) {$lic_str.="</tr><tr>";}
$ctr++;
	}
}
print "</table>";
print "<form method='post' name='licenseForm'><table style='border:none'><tr>$lic_str</tr></table>
<br><input type='submit' value='".__("Update All", $text_domain)."' class='button'>
<br>".__("Looking for more upgrades & themes", $text_domain)."? <a href='http://www.viadat.com/products-page'>".__("It's all right here", $text_domain)."</a>
</form>

</div>
</td></tr></table>

</td>
<td rowspan='2' valign='top'>

<table width='100%'><thead><tr>
<th width=''>".
__("Addons & Themes", $text_domain).
"</th></tr></thead>
<tr>
<td><div style='overflow:scroll; height:715px; padding:7px;'>";
?>
<?php

// include lastRSS library
include_once ("lastRSS.php");
// create lastRSS object
$rss = new lastRSS; 
// setup transparent cache
$rss->cache_dir = './cache'; 
$rss->cache_time = 3600; // one hour

// load some RSS file
if ($rs = $rss->get('http://www.viadat.com/index.php?rss=true&action=product_list&category_id=7')) {
	//var_dump($rs);
$c=1;
foreach ($rs[items] as $value) {

if ($c<=100) {
	print "<li><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:12px'>
	<b>$value[title]</b></a></li>
	<br>
	<span class='home_rss'> ".
	str_replace("]]>","",str_replace("</p>", "", html_entity_decode(nl2br($value[description])))).
	"</span><br><br>";
}
else {
	if ($c<=4)
	print "<li style='font-size:10px; color:black; position:relative; left:10px'><A href=\"$value[link]\" target='_blank' class='home_rss' style='font-size:11px'>$value[title]</a></li>";
	}
$c++;
	}	
}

print "
</div>
</td>
</tr>
</table>

</td>
</tr>
</table>

</div>";
?>