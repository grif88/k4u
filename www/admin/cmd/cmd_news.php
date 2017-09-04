<?php
$count=50;
print '<strong><center>- Последние '.$count.' новостей -</center></strong><br>';
print "<form method=\"post\"><input type=\"hidden\" value=\"add_news\" name=\"cmd\">auto&nbsp;<input type=\"text\" size=\"90\" name=\"name\"><br><input type=\"text\" size=\"20\" name=\"date\">&nbsp;&nbsp;&nbsp;&nbsp;glav&nbsp;<input type=\"text\" size=\"3\" name=\"glav\"><br><br><textarea rows=\"10\" cols=\"100\" name=\"text\"></textarea><br><br><input type=\"submit\" value=\"add\"></form><hr>\n";

$res=mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 0,$count");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$news[$tmp['id']]['name']=$tmp['name'];
	$news[$tmp['id']]['date']=$tmp['date'];
	$news[$tmp['id']]['text']=$tmp['text'];
	$news[$tmp['id']]['glav']=$tmp['glav'];
	$news[$tmp['id']]['clicks']=0;
	$news[$tmp['id']]['clicks']=$tmp['clicks'];
	if ( !isset($ids1) or empty($ids1) ) { $ids1=$tmp['id']; } else { $ids1.=','.$tmp['id']; }
}
$res3=mysql_query("SELECT `c`.`id_table`
FROM `comments` AS `c`
WHERE `c`.`id_table` IN ($ids1) AND `c`.`table`='news'");
if ( mysql_num_rows($res3) > 0 ) {
	while ( $tmp3=mysql_fetch_assoc($res3) ) {
		if ( isset($c_count[$tmp3['id_table']]) ) { $c_count[$tmp3['id_table']]++; } else { $c_count[$tmp3['id_table']]=1; }
	}
}
foreach ( $news as $key1 => $val1 ){
	$id=$key1;
	$name=$val1['name'];
	$date=$val1['date'];
	$text=$val1['text'];
	$glav=$val1['glav'];
	$clicks=$val1['clicks'];
	if ( !isset($c_count[$id]) or empty($c_count[$id]) ) { $count1=0; } else { $count1=$c_count[$id]; }
	print "<form method=\"post\"><input type=\"hidden\" value=\"save_news\" name=\"cmd\"><input type=\"hidden\" value=\"$id\" name=\"id\">$id&nbsp;<input type=\"text\" size=\"90\" name=\"name\" value=\"$name\"><br><input type=\"text\" size=\"20\" name=\"date\" value=\"$date\">&nbsp;&nbsp;&nbsp;&nbsp;glav&nbsp;<input type=\"text\" size=\"3\" name=\"glav\" value=\"$glav\">&nbsp;&nbsp;&nbsp;&nbsp;$clicks&nbsp;кликов&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?cmd=comment&id_news=$id\">$count1&nbsp;комментариев</a><br><br><textarea rows=\"10\" cols=\"100\" name=\"text\">$text</textarea><br><br><input type=\"submit\" value=\"save\"></form><form onSubmit=\"javascript:if(confirm('Удалить новость id=$id и все отзывы?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" value=\"del_news\" name=\"cmd\"><input type=\"hidden\" value=\"$id\" name=\"id\"><input type=\"submit\" value=\"delete\"></form><hr>\n"; 
}
?>