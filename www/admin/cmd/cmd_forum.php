<?php
$count=50;
print '<strong><center>- Последние '.$count.' отзывов -</center></strong>';
print "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">\n";
$res=mysql_query("SELECT `f`.`id` AS `f_id`, `f`.`name` AS `f_name`, `f`.`date` AS `f_date`, `f`.`mail` AS `f_mail`, `f`.`ip` AS `f_ip`, `f`.`text` AS `f_text`, `c`.`id` AS `c_id`, `c`.`name` AS `c_name`, `c`.`date` AS `c_date`, `c`.`ip` AS `c_ip`, `c`.`text` AS `c_text`
FROM `forum` AS `f`
LEFT JOIN `comments` AS `c` ON `c`.`id_table`=`f`.`id` AND `c`.`table`='forum'
ORDER BY `f`.`id` DESC
LIMIT 0,$count");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$f_id=$tmp['f_id'];
	$f_name=$tmp['f_name'];
	$f_date=$tmp['f_date'];
	$f_mail=$tmp['f_mail'];
	$f_ip=$tmp['f_ip'];
	$f_text=$tmp['f_text'];
	print "<tr><td colspan=\"2\"><form onSubmit=\"javascript:if(confirm('Удалить отзыв id=$f_id и ответ?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" value=\"del_post\" name=\"cmd\"><input type=\"hidden\" value=\"forum\" name=\"table\"><input type=\"hidden\" value=\"$f_id\" name=\"id\"><span class=\"tema1\">$f_name</span><br><span class=\"date1\">$f_date</span><br><span class=\"date1\">e-mail: </span>$f_mail<br><span class=\"date1\">IP: </span>$f_ip<br><br>$f_text<br><br>id = $f_id <input type=\"submit\" value=\"delete\"></form></td></tr>\n";
	if ( !empty($tmp['c_id']) ) {
		$c_id=$tmp['c_id'];
		$c_name=$tmp['c_name'];
		$c_date=$tmp['c_date'];
		$c_ip=$tmp['c_ip'];
		$c_text=$tmp['c_text'];
		print "<tr><td width=\"100\">&nbsp;</td><td><form onSubmit=\"javascript:if(confirm('Удалить ответ id=$c_id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" value=\"del_comment\" name=\"cmd\"><input type=\"hidden\" value=\"$c_id\" name=\"id\"><span class=\"tema1\">$c_name</span><br><span class=\"date1\">$c_date</span><br><span class=\"date1\">IP: </span>$c_ip<br><br>$c_text<br><br>id = $c_id <input type=\"submit\" value=\"delete\"></form></td></tr>\n";
	} else {
		print "<tr><td width=\"100\">&nbsp;</td><td><form method=\"post\"><input type=\"hidden\" value=\"post\" name=\"cmd\"><input type=\"hidden\" value=\"forum\" name=\"table\"><input type=\"hidden\" value=\"$f_id\" name=\"id_table\">Введите Ник (Имя) <input required title=\"Введите Ваше имя\" placeholder=\"Имя\" type=\"text\" name=\"name\" maxlength=\"30\" size=\"32\" /><br><textarea required placeholder=\"Введите текст ответа\" title=\"Введите текст сообщения\" name=\"text\" cols=\"100\" rows=\"5\"></textarea><br><input type=\"submit\" value=\"Ответить\" /></form></td></tr>\n";
	}
	print "<tr><td colspan=\"2\"><hr></td></tr>\n";
}
print "</table>\n";
?>