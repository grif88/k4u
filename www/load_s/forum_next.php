<?php
if ( isset($_GET['n']) and !empty($_GET['n']) ) { $n=addslashes($_GET['n']); } else { $n=1; }
if ( isset($_GET['count']) and !empty($_GET['count']) ) { $count=addslashes($_GET['count']); } else { $count=5; }
include '../admin/include/admin.php';
$lim=$count*$n;
$n++;
$outer='';
$res=mysql_query("SELECT `f`.`id` AS `f_id`,`f`.`name` AS `f_name`, `f`.`date` AS `f_date`, `f`.`text` AS `f_text`, `c`.`name` AS `c_name`, `c`.`date` AS `c_date`, `c`.`text` AS `c_text`
FROM `forum` AS `f`
LEFT JOIN `comments` AS `c` ON `c`.`id_table`=`f`.`id` AND `c`.`table`='forum'
ORDER BY `f`.`id` DESC
LIMIT $lim,$count");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$f_id=$tmp['f_id'];
	$f_name=$tmp['f_name'];
	$f_date=$tmp['f_date'];
	$f_text=$tmp['f_text'];
	$outer.="<tr><td colspan=\"2\"><span class=\"tema2\">$f_name</span><br><span class=\"date1\">$f_date</span><br><br>$f_text<br></td></tr>";
	if ( !empty($tmp['c_name']) and !empty($tmp['c_date']) and !empty($tmp['c_text']) ) {
		$c_name=$tmp['c_name'];
		$c_date=$tmp['c_date'];
		$c_text=$tmp['c_text'];
		$outer.="<tr><td width=\"100\">&nbsp;</td><td><br><span class=\"tema2\">$c_name</span><br><span class=\"date1\">$c_date</span><br><br>$c_text<br></td></tr>";
	}
	$outer.="<tr><td colspan=\"2\"><hr></td></tr>";
}
if ( mysql_num_rows($res) == $count ) {
	$outer.="<tr id=\"tr_next\" align=\"center\"><td id=\"td_next\" colspan=\"2\"><input onClick=\"javascript:loadScript(\'/load_s/forum_next.php?count=$count&n=$n\'); document.getElementById(\'td_next\').innerHTML=\'Загрузка...\';\" type=\"button\" value=\"Следующие $count\"></td></tr>";
}
$outer=str_replace("\n", '', $outer);
$outer=str_replace("\r", '', $outer);
print "document.getElementById('tr_next').outerHTML='$outer';";
?>