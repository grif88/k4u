<?php
print "<center><span class=\"tema1\">В этом разделе, Вы можете излагать Ваши жалобы и предложения.</span><br>
<span><font size=\"2\" color=\"#909090\">Отзывы содержащие нецензурные выражения или оскорбления в чью либо сторону будут удаляться. Убедительная просьба, грамотно и конструктивно строить предложения.</font></span></center><br>\n";
print "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">\n";
print "<tr id=\"tr_add\" align=\"center\"><td id=\"td_add\" colspan=\"2\"><input onClick=\"javascript:loadScript('/load_s/post_form.php'); document.getElementById('td_add').innerHTML='Загрузка...';\" type=\"button\" value=\"Добавить отзыв\"><hr></td></tr>\n";
$count=5;
$res=mysql_query("SELECT `f`.`id` AS `f_id`,`f`.`name` AS `f_name`, `f`.`date` AS `f_date`, `f`.`text` AS `f_text`, `c`.`name` AS `c_name`, `c`.`date` AS `c_date`, `c`.`text` AS `c_text`
FROM `forum` AS `f`
LEFT JOIN `comments` AS `c` ON `c`.`id_table`=`f`.`id` AND `c`.`table`='forum'
ORDER BY `f`.`id` DESC
LIMIT 0,$count");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$f_id=$tmp['f_id'];
	$f_name=$tmp['f_name'];
	$f_date=$tmp['f_date'];
	$f_text=$tmp['f_text'];
	print "<tr><td colspan=\"2\"><span class=\"tema2\">$f_name</span><br><span class=\"date1\">$f_date</span><br><br>$f_text<br></td></tr>\n";
	if ( !empty($tmp['c_name']) and !empty($tmp['c_date']) and !empty($tmp['c_text']) ) {
		$c_name=$tmp['c_name'];
		$c_date=$tmp['c_date'];
		$c_text=$tmp['c_text'];
		print "<tr><td width=\"100\">&nbsp;</td><td><br><span class=\"tema2\">$c_name</span><br><span class=\"date1\">$c_date</span><br><br>$c_text<br></td></tr>\n";
	}
	print "<tr><td colspan=\"2\"><hr></td></tr>\n";
}
print "<tr id=\"tr_next\" align=\"center\"><td id=\"td_next\" colspan=\"2\"><input onClick=\"javascript:loadScript('/load_s/forum_next.php?count=$count'); document.getElementById('td_next').innerHTML='Загрузка...';\" type=\"button\" value=\"Следующие $count\"></td></tr>\n";
print "</table>\n";
?>