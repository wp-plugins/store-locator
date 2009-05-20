<table width=100% class='' cellpadding='3px'><tr><td valign=bottom width='33%' style='padding-left:0px'>
<?php
if ($referer!="") {
	print "<a class='' href='$referer' rel='nofollow'><img src='/images/spacer.gif' height=1 width=75 alt='' border=0><br>
Back</a>";
}
elseif($rfr!="") {
	print "<a class='' href='$rfr' rel='nofollow'><img src='/images/spacer.gif' height=1 width=75 alt='' border=0><br>
Back</a>";
}
else {
	print "<a class='' href='..' rel='nofollow'><img src='/images/spacer.gif' height=1 width=75 alt='' border=0><br>
Back</a>";

}


//back();
$pos=0;
if ($start<0 || $start=="" || !isset($start) || empty($start)) {$start=0;}
if ($num_per_page<0 || $num_per_page=="") {$num_per_page=10;}
$prev=$start-$num_per_page;
$next=$start+$num_per_page;
if (ereg("&start=$start",$_SERVER[QUERY_STRING])) {
	$prev_page=str_replace("&start=$start","&start=$prev",$_SERVER[QUERY_STRING]);
	$next_page=str_replace("&start=$start","&start=$next",$_SERVER[QUERY_STRING]); //echo($next_page);
}
else {
	$prev_page=$_SERVER[QUERY_STRING]."&start=$prev";
	$next_page=$_SERVER[QUERY_STRING]."&start=$next";
}
if ($numMembers2>$num_per_page) {
	print "  | ";

if ((($start/$num_per_page)+1)-5<1) {
	$beginning_link=1;
}
else {
	$beginning_link=(($start/$num_per_page)+1)-5;
}
if ((($start/$num_per_page)+1)+5>(($numMembers2/$num_per_page)+1)) {
	$end_link=(($numMembers2/$num_per_page)+1);
}
else {
	$end_link=(($start/$num_per_page)+1)+5;
}
$pos=($beginning_link-1)*$num_per_page;
	for ($k=$beginning_link; $k<$end_link; $k++) {
		if (ereg("&start=$start",$_SERVER[QUERY_STRING])) {
			$curr_page=str_replace("&start=$start","&start=$pos",$_SERVER[QUERY_STRING]);
		}
		else {
			$curr_page=$_SERVER[QUERY_STRING]."&start=$pos";
		}
		if (($start-($k-1)*$num_per_page)<0 || ($start-($k-1)*$num_per_page)>=$num_per_page) {
			print "<a class='' href=\".?$curr_page\" rel='nofollow'>";
		}
		print $k;
		if (($start-($k-1)*$num_per_page)<0 || ($start-($k-1)*$num_per_page)>=$num_per_page) {
			print "</a>";
		}
		$pos=$pos+$num_per_page;
		print "&nbsp;&nbsp;";
	}
}

$extra_text=($_GET[text])? " for your search of <strong>\"$_GET[text]\"</strong>" : "" ;
?>
</td>
<td align='center' valign='bottom' width='33%'><div class='' style='padding:5px; font-weight:normal'>
<?php 

	$end_num=($numMembers2<($start+$num_per_page))? $numMembers2 : ($start+$num_per_page) ;
	print "<nobr>Results <strong>".($start+1)." - ".$end_num."</strong>"; 
	if (!ereg("doSearch", $_GET[u])) {
		print " ({$numMembers2} total)".$extra_text; 
	}
	print "</nobr>";

?>
</div>
</td>
<td align=right valign=bottom width='33%' style='padding-right:0px'>
<table><tr><td width=75><img src='/images/spacer.gif' height=1 width=75 alt='' border=0>
<?php 
if (($start-$num_per_page)>=0) { ?>
<a class='' href=".?<?= $prev_page ?>" rel='nofollow'>Previous&nbsp;<?= $num_per_page ?></a>&nbsp;&nbsp;|
<?php } ?>
</td>
<td width=45 valign=bottom><img src='/images/spacer.gif' height=1 width=45 alt='' border=0>
<?php 
if (($start+$num_per_page)<$numMembers2) { ?>
&nbsp;<a class='' href=".?<?= $next_page ?>" rel='nofollow'>Next&nbsp;<?= $num_per_page ?></a><br>
<?php } ?>
</td></tr></table>
</td>
</tr>
</table>
<!--div style='margin:0px auto; position:relative; left:50px'><center><?php// if ($current_dir!="articles" && $current_dir!="groups") {include("$root/google/google_ads_728_90_2.php");} ?></center></div><br-->