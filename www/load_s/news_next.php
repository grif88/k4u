<?php
if ( isset($_GET['n']) and !empty($_GET['n']) ) { $n=addslashes($_GET['n']); } else { $n=1; }
if ( isset($_GET['count']) and !empty($_GET['count']) ) { $count=addslashes($_GET['count']); } else { $count=5; }
include '../admin/include/admin.php';
$lim=$count*$n;
$n++;
$outer='';
$res=mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT $lim,$count");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$news[$tmp['id']]['name']=$tmp['name'];
	$news[$tmp['id']]['date']=$tmp['date'];
	$news[$tmp['id']]['text']=$tmp['text'];
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
	$n_name=$val1['name'];
	$n_date=$val1['date'];
	$n_text=$val1['text'];
	$n_clicks=$val1['clicks'];
	if ( !isset($c_count[$id]) or empty($c_count[$id]) ) { $count1=0; } else { $count1=$c_count[$id]; }
	$outer.="<tr><td colspan=\"2\"><span class=\"tema1\">$n_name</span><br><span class=\"date1\">$n_date</span><br><br>$n_text<br></td></tr>";
	$outer.="<tr id=\"tr_$id\" align=\"center\"><td colspan=\"2\" id=\"td_$id\"></td></tr>";
	$outer.="<tr><td colspan=\"2\" align=\"right\"><span id=\"sp_$id\" class=\"copyr1\"><a href=\"javascript:return false;\" onClick=\"javascript:loadScript(\'/load_s/comm_next.php?news_id=$id&count=$count\'); document.getElementById(\'td_$id\').innerHTML=\'<br>Загрузка...\'; document.getElementById(\'sp_$id\').innerHTML=\'Комментариев: $count1\';\">Комментариев: $count1</a></span> - <span class=\"copyr1\">Просмотров: $n_clicks</span></td></tr>";
	$outer.="<tr><td colspan=\"2\"><hr></td></tr>";
}
if ( mysql_num_rows($res) == $count ) {
	$outer.="<tr id=\"tr_next\" align=\"center\"><td id=\"td_next\" colspan=\"2\"><input onClick=\"javascript:loadScript(\'/load_s/news_next.php?count=$count&n=$n\'); document.getElementById(\'td_next\').innerHTML=\'Загрузка...\';\" type=\"button\" value=\"Следующие $count\"></td></tr>";
}
$outer=str_replace("\n", '', $outer);
$outer=str_replace("\r", '', $outer);
print "document.getElementById('tr_next').outerHTML='$outer';";
?>