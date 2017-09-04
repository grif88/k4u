<?php

// input

if ( isset($_GET['finish']) ) { $finish=$_GET['finish']; } else { $finish=0; }

// head

print "<a href=\"?cmd=view_otkl\">&lt;открытые&gt;</a>&nbsp;
<a href=\"?cmd=view_otkl&finish=1\">&lt;закрытые&gt;</a>&nbsp;
<a href=\"?cmd=view_otkl&finish=2\">&lt;все&gt;</a><br>
<br>\n";

// body

$res2=mysql_query("SELECT `id`,`region` FROM `t_regions` ORDER BY `poss`");
while ( $tmp2=mysql_fetch_assoc($res2) ){ // regions begin
 $id_region=$tmp2['id'];
 $region=$tmp2['region'];
 
if ( $finish == 0 ) {
$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`, `list`.`house`, `list`.`room`,
`otkl`.`id` AS `id_otkl`, `otkl`.`date`, `otkl`.`admin`, `otkl`.`admin_ip`, `otkl`.`reason`, `otkl`.`date_add`, `otkl`.`date_finish`, `otkl`.`id_people`, `otkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`otkl`.`id_client`
AND `data`.`id_client`=`otkl`.`id_client`
AND (`otkl`.`date_finish` IS NULL OR `otkl`.`date_finish`='')
ORDER BY `otkl`.`id`
");
}
if ( $finish == 1 ) {
$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`, `list`.`house`, `list`.`room`,
`otkl`.`id` AS `id_otkl`, `otkl`.`date`, `otkl`.`admin`, `otkl`.`admin_ip`, `otkl`.`reason`, `otkl`.`date_add`, `otkl`.`date_finish`, `otkl`.`id_people`, `otkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`otkl`.`id_client`
AND `data`.`id_client`=`otkl`.`id_client`
AND (`otkl`.`date_finish` IS NOT NULL AND `otkl`.`date_finish`!='')
ORDER BY `otkl`.`id`
");
}
if ( $finish == 2 ) {
$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`, `list`.`house`, `list`.`room`,
`otkl`.`id` AS `id_otkl`, `otkl`.`date`, `otkl`.`admin`, `otkl`.`admin_ip`, `otkl`.`reason`, `otkl`.`date_add`, `otkl`.`date_finish`, `otkl`.`id_people`, `otkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`otkl`.`id_client`
AND `data`.`id_client`=`otkl`.`id_client`
ORDER BY `otkl`.`id`
");
}
 if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }
print "<strong>$region (Всего: $res_rows)</strong><br>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">i</td><td align=\"center\">Дата подачи</td><td align=\"center\">Адрес</td><td align=\"center\">login</td><td align=\"center\">Ф.И.О. (тел)</td><td align=\"center\">Причина</td><td align=\"center\">Дата<br>отключения</td><td align=\"center\">Выполнили</td><td align=\"center\">Примечание</td></tr>\n";
if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id_otkl=$tmp['id_otkl'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $reason=$tmp['reason'];
 $date_add=$tmp['date_add'];
 $date_finish=$tmp['date_finish'];
 $id_people=$tmp['id_people'];
 $comment=$tmp['comment'];
 $id_list=$tmp['id_list'];
 $login=$tmp['login'];
 $street=$tmp['street'];
 $house=$tmp['house'];
 $room=$tmp['room'];
 $surname=$tmp['surname'];
 $name=$tmp['name'];
 $secname=$tmp['secname'];
 $phone=$tmp['phone'];
 print "<tr><td>"; res_info($id_otkl,$date,$admin,$admin_ip); print "</td><td>$date_add&nbsp;"; popup_win("cmd=edit_otkl&id=$id_otkl",'edit_otkl','Редактировать',400,400); print "</td><td>ул. $street<br>д. $house кв. $room</td><td><a href=\"?cmd=view_abon&id=$id_list\">$login</a></td><td>$surname $name $secname<br>($phone)</td><td>$reason</td><td>$date_finish</td><td>"; people($id_people); print "</td><td>$comment</td></tr>\n";
}
} // if
 print "</table>\n";
} // regions end

?>