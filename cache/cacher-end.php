<?php

// Cache the output to a file

ob_end_flush(); // Send the output to the browser
$fp_cache = gzopen($cachefile, 'a');
gzwrite($fp_cache, $total_xml);
gzclose($fp_cache);


/*
if ($_SESSION[mem_id]==1) {
print("<br><br>Cached:<br><br>".$total_html);
}
*/
?>