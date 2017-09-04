<?php

if ( isset($_GET['id']) ) { // if id begin
$id=$_GET['id'];

$res44=mysql_query("
SELECT
`sw_list`.`id`, `sw_list`.`date`, `sw_list`.`admin`, `sw_list`.`admin_ip`, `sw_list`.`name`, `sw_list`.`sup_house`, `sw_list`.`sup_room`, `sw_list`.`comment`,
`dev_type`.`model`, `dev_type`.`ports`,
`streets`.`street` AS `sup_street`,
`supply`.`name` AS `sup_type`
FROM
`d_sw_list` AS `sw_list`,
`t_dev_type` AS `dev_type`,
`t_streets` AS `streets`,
`t_supply` AS `supply`
WHERE
`dev_type`.`id`=`sw_list`.`id_type`
AND `streets`.`id`=`sw_list`.`sup_id_street`
AND `supply`.`id`=`sw_list`.`sup_id_type`
AND `sw_list`.`id`='$id'
");

print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">i</td><td align=\"center\">Модель</td><td align=\"center\">Порты</td><td align=\"center\">Имя</td><td align=\"center\">Питание</td><td align=\"center\">Тип питания</td><td align=\"center\">Комментарий</td><td align=\"center\">cmd</td></tr>\n";

if ( $res44 ) { // if res44
while ( $tmp=mysql_fetch_assoc($res44) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $name=$tmp['name'];
 $model=$tmp['model'];
 $ports=$tmp['ports'];
 $sup_street=$tmp['sup_street'];
 $sup_house=$tmp['sup_house'];
 $sup_room=$tmp['sup_room'];
 $sup_type=$tmp['sup_type'];
 $comment=$tmp['comment'];
 
 $res22=mysql_query("SELECT `id` FROM `d_uplink` WHERE `id_term`='$id' OR (`id_cl`='$id' AND `type`='dev')");
 if ( $res22 ) { $res_rows22=mysql_num_rows($res22); } else { $res_rows22=0; }
 $res_rows22_tmp=$res_rows22+1;
 if ( $res_rows22_tmp == $ports ) { $ports2="<strong>$res_rows22/$ports</strong>"; }
 else if ( $res_rows22 >= $ports ) { $ports2="<font color=\"#FF0000\"><strong>$res_rows22/$ports</strong></font>"; }
 else { $ports2="$res_rows22/$ports"; }
 
 print '<tr><td>'; res_info($id,$date,$admin,$admin_ip); print "<td>$model</td><td>$ports2</td><td><a href=\"?cmd=switches&id=$id\">$name</a></td><td>ул. $sup_street д. $sup_house кв. $sup_room</td><td>$sup_type</td><td>$comment</td><td>"; popup_win("cmd=edit_switch&id=$id",'edit_switch','Изменить параметры',400,350); print "&nbsp;<a href=\"javascript:void(0);\" onclick=\"javascript:check_all();\"><img src=\"img/sync.png\" border=\"0\" title=\"Check disconnects\" /></a></td></tr>\n";
 }
} // if res44 end
print "</table><br>\n";

// up links

print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">\n";
$res11=mysql_query("
SELECT
`d_uplink`.`id`, `d_uplink`.`date`, `d_uplink`.`admin`, `d_uplink`.`admin_ip`, `d_uplink`.`id_term`,
`sw_list`.`name`
FROM
`d_uplink`,
`d_sw_list` AS `sw_list`
WHERE
`d_uplink`.`id_cl`='$id'
AND `d_uplink`.`type`='dev'
AND `sw_list`.`id`=`d_uplink`.`id_term`
");
if ( $res11 ) { $res_rows11=mysql_num_rows($res11); } else { $res_rows11=0; }
if ( $res_rows11 > 0 ) {
 $i=1;
 while ( $tmp11=mysql_fetch_assoc($res11) ){
  $id_uplink=$tmp11['id'];
  $date_uplink=$tmp11['date'];
  $admin_uplink=$tmp11['admin'];
  $admin_ip_uplink=$tmp11['admin_ip'];
  $id_term=$tmp11['id_term'];
  $sw_name=$tmp11['name'];
  print "<tr><td class=\"clr_back_grey\">UpLink $i&nbsp;"; res_info($id_uplink,$date_uplink,$admin_uplink,$admin_ip_uplink); print "</td><td><a href=\"?cmd=switches&id=$id_term\">$sw_name</a></td><td><a href=\"javascript:void(0);\" onclick=\"javascript:check_all();\"><img src=\"img/sync.png\" border=\"0\" title=\"Check disconnects\" /></a></td></tr>\n";
  $i++;
 }
} else {
 print "<tr><td class=\"clr_back_grey\">UpLink</td><td>none&nbsp;"; popup_add("cmd=add_uplink&id=$id&type=dev",'add_uplink','Привязать',400,150); print "</td></tr>\n";
}
print "</table><br>\n";

// down links

print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">\n";
$res33=mysql_query("
SELECT
`d_uplink`.`id`, `d_uplink`.`date`, `d_uplink`.`admin`, `d_uplink`.`admin_ip`, `d_uplink`.`type`, `d_uplink`.`id_cl`
FROM
`d_uplink`
WHERE
`d_uplink`.`id_term`='$id'
ORDER BY `d_uplink`.`type` DESC
");
if ( $res33 ) { $res_rows33=mysql_num_rows($res33); } else { $res_rows33=0; }
if ( $res_rows33 > 0 ) {
 $j=1;
 $b=0;
 while ( $tmp33=mysql_fetch_assoc($res33) ){
  $id_uplink=$tmp33['id'];
  $date_uplink=$tmp33['date'];
  $admin_uplink=$tmp33['admin'];
  $admin_ip_uplink=$tmp33['admin_ip'];
  $link_type=$tmp33['type'];
  $id_cl=$tmp33['id_cl'];
  print "<tr><td class=\"clr_back_grey\">Out $j&nbsp;"; res_info($id_uplink,$date_uplink,$admin_uplink,$admin_ip_uplink);
  print "</td><td>"; popup_del("cmd=del_uplink&id=$id_uplink",'del_uplink','Удалить привязку',400,150); print "&nbsp;$link_type</td>";
  if ( $link_type == 'dev' ) {
   $res55=mysql_query("SELECT `name` FROM `d_sw_list` WHERE `id`='$id_cl'");
   while ( $tmp55=mysql_fetch_assoc($res55) ){ $sw_name=$tmp55['name']; }
   print "<td colspan=\"2\"><a href=\"?cmd=switches&id=$id_cl\">$sw_name</a></td>";
  } else if ( $link_type == 'abon' ) {
   $res55=mysql_query("SELECT `login`,`cl_mac` FROM `d_cl_list` WHERE `id`='$id_cl'");
   while ( $tmp55=mysql_fetch_assoc($res55) ){ $login=$tmp55['login']; $mac=$tmp55['cl_mac']; }
   $check_arr[$id_cl]=$login;
   $tmp_st=active_check($id_cl);
   if ( $tmp_st['active'] == 1 ) { $tmp_st2='<span class="clr_green">А<span>'; }
   if ( $tmp_st['active'] == 0 ) { $tmp_st2='<span class="clr_red">З<span>'; }
   unset($tmp_st);
   print "<td><strong>$tmp_st2</strong></td><td><a href=\"?cmd=view_abon&id=$id_cl\" title=\"MAC: $mac\">$login</a>&nbsp;"; mkt_stat('cmd=mkt_status',$login,'mkt_status','mkt статус',900,600); print '&nbsp;'; popup_queue("cmd=view_queue&login=$login",'view_queue','Активность',550,600); print '&nbsp;'; popup_log("cmd=mkt_log&login=$login&mac=$mac",'mkt_log','Log MikroTik',1200,500); print '&nbsp;'; popup_log1("cmd=ping_log&id=$id_cl",'ping_log','Pinger Log',870,500);
   print "</td><td><span id=\"result$id_cl\"></span></td>";
  }
  print "</tr>\n";
  $j++;
 }
} else {
 print "<tr><td class=\"clr_back_grey\">Out</td><td>none</td></tr>\n";
}
print "</table>\n";
print "<script type=\"text/JavaScript\">
function check_all() {\n";
if ( isset($check_arr) ) {
foreach ($check_arr as $key1 => $value1) {
print "loadScript('load_s/check_down.php?res=$key1&login=$value1');
var res$key1 = document.getElementById('result$key1');
res$key1.innerHTML='wait...';\n";
}
}
print "}
</script>\n";
#var_dump($check_arr);

} else { // if id else

$res44=mysql_query("
SELECT
`sw_list`.`id`, `sw_list`.`date`, `sw_list`.`admin`, `sw_list`.`admin_ip`, `sw_list`.`name`, `sw_list`.`sup_house`, `sw_list`.`sup_room`, `sw_list`.`comment`,
`dev_type`.`id` AS `switch_id`, `dev_type`.`model`, `dev_type`.`ports`,
`streets`.`street` AS `sup_street`,
`supply`.`name` AS `sup_type`
FROM
`d_sw_list` AS `sw_list`,
`t_dev_type` AS `dev_type`,
`t_streets` AS `streets`,
`t_supply` AS `supply`
WHERE
`dev_type`.`id`=`sw_list`.`id_type`
AND `streets`.`id`=`sw_list`.`sup_id_street`
AND `supply`.`id`=`sw_list`.`sup_id_type`
ORDER BY `sw_list`.`name`
");

if ( $res44 ) { $res_rows44=mysql_num_rows($res44); } else { $res_rows44=0; }

print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">"; popup_add("cmd=add_switch",'add_switch','Добавить свитч',400,350); print "</td><td align=\"center\">Модель</td><td align=\"center\">Порты</td><td align=\"center\">Имя</td><td align=\"center\">Питание</td><td align=\"center\">Тип питания</td><td align=\"center\">Комментарий</td><td align=\"center\">cmd</td></tr>\n";

if ( $res44 ) { // if res44
while ( $tmp=mysql_fetch_assoc($res44) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $name=$tmp['name'];
 $model=$tmp['model'];
 $ports=$tmp['ports'];
 $sup_street=$tmp['sup_street'];
 $sup_house=$tmp['sup_house'];
 $sup_room=$tmp['sup_room'];
 $sup_type=$tmp['sup_type'];
 $comment=$tmp['comment'];
 
 $switch_id=$tmp['switch_id'];
 if ( !isset($switch_col[$switch_id]) ) { $switch_col[$switch_id]=0; }
 $switch_col[$switch_id]++;
 
 $res22=mysql_query("SELECT `id` FROM `d_uplink` WHERE `id_term`='$id' OR (`id_cl`='$id' AND `type`='dev')");
 if ( $res22 ) { $res_rows22=mysql_num_rows($res22); } else { $res_rows22=0; }
 $res_rows22_tmp=$res_rows22+1;
 if ( $res_rows22_tmp == $ports ) { $ports2="<strong>$res_rows22/$ports</strong>"; }
 else if ( $res_rows22 >= $ports ) { $ports2="<font color=\"#FF0000\"><strong>$res_rows22/$ports</strong></font>"; }
 else { $ports2="$res_rows22/$ports"; }
 
 print "<tr><td>"; res_info($id,$date,$admin,$admin_ip); print "<td>$model</td><td>$ports2</td><td><a href=\"?cmd=switches&id=$id\">$name</a></td><td>ул. $sup_street д. $sup_house кв. $sup_room</td><td>$sup_type</td><td>$comment</td><td>"; popup_win("cmd=edit_switch&id=$id",'edit_switch','Изменить параметры',400,350); print "&nbsp;"; popup_del("cmd=del_switch&id=$id",'del_switch','Удалить свитч',400,150); print "</td></tr>\n";
 }
} // if res44 end

print "</table><br>\n";

print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Модель</td><td align=\"center\">Количество</td></tr>\n";

$res222=mysql_query("SELECT `id`,`model` FROM `t_dev_type` ORDER BY `poss`");
if ( $res222 ) {
 while ( $tmp222=mysql_fetch_assoc($res222) ){
  $sw_id=$tmp222['id'];
  $sw_model=$tmp222['model'];
  if ( empty($switch_col[$sw_id]) ) { $switch_col[$sw_id]=0; }
  print "<tr><td>$sw_id</td><td>$sw_model</td><td align=\"right\">".$switch_col[$sw_id]."</td><tr>\n";
 }
}
print "<tr><td colspan=\"2\"><strong>Всего</strong></td><td align=\"right\"><strong>$res_rows44</strong></td><tr>
</table>\n";

} // if id end
?>