<?php
if ( isset($_GET['news_id']) and !empty($_GET['news_id']) ) {
	$news_id=addslashes($_GET['news_id']);
	include '../admin/include/admin.php';
	if ( isset($_GET['n']) and !empty($_GET['n']) ) { $n=addslashes($_GET['n']); } else { $n=0; }
	if ( isset($_GET['count']) and !empty($_GET['count']) ) { $count=addslashes($_GET['count']); } else { $count=5; }
	if ( $n == 0 ) {
		$outer="<tr id=\"tr_add_$news_id\" align=\"center\"><td colspan=\"2\" id=\"td_add_$news_id\"><br><input onClick=\"javascript:loadScript(\'/load_s/post_comm.php?news_id=$news_id\'); document.getElementById(\'td_add_$news_id\').innerHTML=\'<br>Загрузка...\';\" type=\"button\" value=\"Добавить комментарий\"></td></tr>";
	} else { $outer=''; }
	$lim=$count*$n;
	$n++;
	$res=mysql_query("SELECT `c`.`name` AS `c_name`, `c`.`date` AS `c_date`, `c`.`text` AS `c_text`
FROM `comments` AS `c`
WHERE `c`.`id_table`='$news_id' AND `c`.`table`='news'
ORDER BY `c`.`id` DESC
LIMIT $lim,$count");
	if ( mysql_num_rows($res) > 0 ) {
		while ( $tmp=mysql_fetch_assoc($res) ) {
			if ( !empty($tmp['c_name']) and !empty($tmp['c_date']) and !empty($tmp['c_text']) ) {
				$c_name=$tmp['c_name'];
				$c_date=$tmp['c_date'];
				$c_text=$tmp['c_text'];
				$outer.="<tr valign=\"top\"><td width=\"100\">&nbsp;<br><hr width=\"80%\"></td><td>&nbsp;<br><span class=\"tema2\">$c_name</span><br><span class=\"date1\">$c_date</span><br><br>$c_text<br></td></tr>";
			}
		}
		if ( mysql_num_rows($res) == $count ) {
			$outer.="<tr id=\"tr_$news_id\" align=\"center\"><td id=\"td_$news_id\" colspan=\"2\"><br><input onClick=\"javascript:loadScript(\'/load_s/comm_next.php?news_id=$news_id&count=$count&n=$n\'); document.getElementById(\'td_$news_id\').innerHTML=\'<br>Загрузка...\';\" type=\"button\" value=\"Следующие $count\"></td></tr>";
		}
	}
	$outer=str_replace("\n", '', $outer);
	$outer=str_replace("\r", '', $outer);
	print "document.getElementById('tr_$news_id').outerHTML='$outer';";
} else {
	print "alert('Ошибка');";
}
?>