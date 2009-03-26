<?php


$theUri=$_SERVER[REQUEST_URI];

$cachefile = $sl_path.'/cache/data.xml';
$cachetime = 5 * 60;
//if ($_GET[u]!="") { $cachetime = 120 * 60; }
// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    //include($cachefile);
	readgzfile($cachefile);
   // echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
    exit;
}
else {
	//added 11:33a 7/3/08 -- need to delete old cached file in since new file will be written to end of file if it already exists
	unlink($cachefile);
}
?>