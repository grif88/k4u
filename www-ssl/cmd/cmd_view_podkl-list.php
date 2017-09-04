<?php

// input

if ( isset($_GET['finish']) ) { $finish=$_GET['finish']; } else { $finish=0; }
if ( isset($_GET['sort']) ) { $sort=$_GET['sort']; } else { $sort='date'; }
if ( $sort == 'date' ) { $order1="`podkl`.`id`"; } else if ( $sort == 'addr' ) { $order1="`streets`.`poss`"; }
// head

print "<a href=\"?cmd=view_podkl-list\">&lt;открытые&gt;</a>&nbsp;
<a href=\"?cmd=view_podkl-list&finish=1\">&lt;закрытые&gt;</a>&nbsp;
<a href=\"?cmd=view_podkl-list&finish=2\">&lt;все&gt;</a><br>
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
`podkl`.`id` AS `id_podkl`, `podkl`.`date`, `podkl`.`admin`, `podkl`.`admin_ip`, `podkl`.`date_add`, `podkl`.`date_finish`, `podkl`.`cab_less`, `podkl`.`id_cab_type`, `podkl`.`id_people`, `podkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`podkl`.`id_client`
AND `data`.`id_client`=`podkl`.`id_client`
AND (`podkl`.`date_finish` IS NULL OR `podkl`.`date_finish`='')
ORDER BY $order1
");
}
if ( $finish == 1 ) {
$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`, `list`.`house`, `list`.`room`,
`podkl`.`id` AS `id_podkl`, `podkl`.`date`, `podkl`.`admin`, `podkl`.`admin_ip`, `podkl`.`date_add`, `podkl`.`date_finish`, `podkl`.`cab_less`, `podkl`.`id_cab_type`, `podkl`.`id_people`, `podkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`podkl`.`id_client`
AND `data`.`id_client`=`podkl`.`id_client`
AND (`podkl`.`date_finish` IS NOT NULL AND `podkl`.`date_finish`!='')
ORDER BY $order1
");
}
if ( $finish == 2 ) {
$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`, `list`.`house`, `list`.`room`,
`podkl`.`id` AS `id_podkl`, `podkl`.`date`, `podkl`.`admin`, `podkl`.`admin_ip`, `podkl`.`date_add`, `podkl`.`date_finish`, `podkl`.`cab_less`, `podkl`.`id_cab_type`, `podkl`.`id_people`, `podkl`.`comment`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id_region`='$id_region'
AND `streets`.`id`=`list`.`id_street`
AND `list`.`id`=`podkl`.`id_client`
AND `data`.`id_client`=`podkl`.`id_client`
ORDER BY $order1
");
}
 if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }
 print "<strong>$region (Всего: $res_rows)</strong><br>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">i</td><td align=\"center\"><a href=\"?cmd=view_podkl-list&finish=$finish&sort=date\">Дата подачи</a></td><td align=\"center\"><a href=\"?cmd=view_podkl-list&finish=$finish&sort=addr\">Адрес</a></td><td align=\"center\">login</td><td align=\"center\">Ф.И.О. (тел)</td><td align=\"center\">Дата<br>подключения</td><td align=\"center\">Кабель&nbsp;(тип)</td><td align=\"center\">Выполнили</td><td align=\"center\">Примечание</td></tr>\n";
if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id_podkl=$tmp['id_podkl'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $date_add=$tmp['date_add'];
 $date_finish=$tmp['date_finish'];
 $cab_less=$tmp['cab_less'];
 $id_cab_type=$tmp['id_cab_type'];
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
 print '<tr><td>'; res_info($id_podkl,$date,$admin,$admin_ip); print "</td><td>$date_add&nbsp;"; popup_win("cmd=edit_podkl&id=$id_podkl",'edit_podkl','Редактировать',450,345); print "</td><td>ул. $street<br>д. $house кв. $room</td><td><a href=\"?cmd=view_abon&id=$id_list\">$login</a></td><td>$surname $name $secname<br>($phone)</td><td>$date_finish</td><td>"; if((!empty($cab_less) or $cab_less==0) and !empty($date_finish)){print"$cab_less&nbsp;м&nbsp;("; cab_types_view($id_cab_type); print ")";} print "</td><td>"; people($id_people); print "</td><td>$comment</td></tr>\n";
}
} // if
 print "</table>\n";
} // regions end

?>