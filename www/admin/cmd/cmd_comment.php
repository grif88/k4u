<?php
$id=$_GET['id_news'];
$res=mysql_query("SELECT `c`.`id` AS `c_id`, `c`.`name` AS `c_name`, `c`.`date` AS `c_date`, `c`.`ip` AS `c_ip`, `c`.`text` AS `c_text`
FROM `comments` AS `c`
WHERE `c`.`id_table`='$id' AND `c`.`table`='news'
ORDER BY `c`.`id` DESC");
$count=mysql_num_rows($res);
print '<strong><center>- Всего '.$count.' комментариев -</center></strong><br>';
print "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">\n";
while ( $tmp=mysql_fetch_assoc($res) ) {
	$c_id=$tmp['c_id'];
	$c_name=$tmp['c_name'];
	$c_date=$tmp['c_date'];
	$c_ip=$tmp['c_ip'];
	$c_text=$tmp['c_text'];
	print "<tr><td><form onSubmit=\"javascript:if(confirm('Удалить комментарий id=$c_id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" value=\"del_comment\" name=\"cmd\"><input type=\"hidden\" value=\"$c_id\" name=\"id\"><span class=\"tema1\">$c_name</span><br><span class=\"date1\">$c_date</span><br><span class=\"date1\">IP: </span>$c_ip<br><br>$c_text<br><br>id = $c_id <input type=\"submit\" value=\"delete\"></form></td></tr>\n";
	print "<tr><td><hr></td></tr>\n";
}
print "</table>\n";
?>