<?php

//$qv=$wp_query->query_vars;
//var_dump($wp_query); die();
function getRewriteRules() {
    global $wp_rewrite; // Global WP_Rewrite class object
    return $wp_rewrite->rewrite_rules(); 
}

print_r(getRewriteRules());

?>