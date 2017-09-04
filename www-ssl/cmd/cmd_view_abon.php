<?php

// functions

function show_abon2($id) {
include './include/month.php';
include './include/global.php';

$php_user_client=$_SERVER['HTTP_USER_AGENT'];
mysql_query("INSERT INTO `d_cl_view_log` (`date`,`admin`,`admin_ip`,`id_client`,`browser`) VALUES ('$php_date','$php_user','$php_user_ip','$id','$php_user_client')");

$res=mysql_query("
SELECT
`list`.`id`, `list`.`date`, `list`.`admin`, `list`.`admin_ip`, `list`.`login`, `list`.`passwd`, `list`.`cl_ip`, `list`.`cl_mac`, `list`.`house`, `list`.`room`,
`podkl`.`id` AS `id_podkl`, `podkl`.`date` AS `date_podkl`, `podkl`.`admin` AS `admin_podkl`, `podkl`.`admin_ip` AS `admin_ip_podkl`, `podkl`.`date_finish` AS `date_finish2`,
`data`.`id` AS `id4`, `data`.`date` AS `date4`, `data`.`admin` AS `admin4`, `data`.`admin_ip` AS `admin_ip4`, `data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`, `data`.`doc`, `data`.`doc_seriya`, `data`.`doc_number`, `data`.`doc_when`, `data`.`doc_bywho`, `data`.`date_dog`, `data`.`comment`, `data`.`sms_phone`,
`regions`.`region`,
`streets`.`street`,
`cl_types`.`type` AS `cl_type`, `cl_types`.`zero` AS `cl_zero`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`,
`t_regions` AS `regions`,
`t_streets` AS `streets`,
`t_cl_types` AS `cl_types`
WHERE
`list`.`id`='$id'
AND `podkl`.`id_client`=`list`.`id`
AND `data`.`id_client`=`list`.`id`
AND `regions`.`id`=`list`.`id_region`
AND `streets`.`id`=`list`.`id_street`
AND `cl_types`.`id`=`list`.`id_type`
");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id=$tmp['id'];
  $date=$tmp['date'];
  $admin=$tmp['admin'];
  $admin_ip=$tmp['admin_ip'];
  $login=$tmp['login'];
  $passwd=$tmp['passwd'];
  $cl_ip=$tmp['cl_ip'];
  $cl_mac=$tmp['cl_mac'];
  $house=$tmp['house'];
  $room=$tmp['room'];
  $id_podkl=$tmp['id_podkl'];
  $date_podkl=$tmp['date_podkl'];
  $admin_podkl=$tmp['admin_podkl'];
  $admin_ip_podkl=$tmp['admin_ip_podkl'];
  $date_finish2=$tmp['date_finish2'];
  $podkl_int=0;
  if ( !empty($date_finish2) ) { $podkl_date=$date_finish2; $podkl_int=1; } else { $podkl_date='стоит в очереди'; }
  $id4=$tmp['id4'];
  $date4=$tmp['date4'];
  $admin4=$tmp['admin4'];
  $admin_ip4=$tmp['admin_ip4'];
  $surname=$tmp['surname'];
  $name=$tmp['name'];
  $secname=$tmp['secname'];
  $phone=$tmp['phone'];
  $doc=$tmp['doc'];
  $doc_seriya=$tmp['doc_seriya'];
  $doc_number=$tmp['doc_number'];
  $doc_when=$tmp['doc_when'];
  $doc_bywho=$tmp['doc_bywho'];
  $date_dog=$tmp['date_dog'];
  if ( empty($date_dog) ) { $date_dog="<span class=\"clr_red\">договор не подписан</span>"; }
  $comment=$tmp['comment'];
  $sms_phone=$tmp['sms_phone'];
  if ( strlen($sms_phone) < 12 ) { $sms_phone="<span class=\"clr_red\"><strong>нет рассылки SMS</strong></span>"; }
  $dog_num='';
  while ( strlen($dog_num) != 6 ) { if ( !empty($dog_num) ) { $dog_num='0'.$dog_num; } else { $dog_num=$id; } }
  $region=$tmp['region'];
  $street=$tmp['street'];
  $cl_type=$tmp['cl_type'];
  $cl_zero=$tmp['cl_zero'];
 }
 $res2=mysql_query("SELECT `id`,`date`,`admin`,`admin_ip`,`date_finish` FROM `d_cl_otkl` WHERE `id_client`='$id'");
 $rows_res2=mysql_num_rows($res2);
 if ( $rows_res2 == 1 ) { 
  while ( $tmp2=mysql_fetch_assoc($res2) ){
   $id3=$tmp2['id'];
   $date3=$tmp2['date'];
   $admin3=$tmp2['admin'];
   $admin_ip3=$tmp2['admin_ip'];
   $date_finish3=$tmp2['date_finish'];
   $otkl_int=1;
   if ( !empty($date_finish3) ) { $otkl_date=$date_finish3; } else { $otkl_date='стоит в очереди'; }
  }
 } else { $otkl_date='нет'; $otkl_int=0; }
 $res4=mysql_query("SELECT `id` FROM `d_cl_remont` WHERE `id_client`='$id' AND (`date_finish` IS NULL OR `date_finish`='')");
 $rows_res4=mysql_num_rows($res4);
 if ( $rows_res4 != 0 ) { $remont_kol='<span class="clr_red"><strong>'.$rows_res4.' шт</strong></span>'; } else { $remont_kol='нет'; }
 $todo_anim=0;
 $res_tdlog=mysql_query("SELECT `id` FROM `d_todo_list` WHERE `id_client`='$id' AND `done`!='1'");
 $todo_anim=mysql_num_rows($res_tdlog);
  $res_bal=mysql_query("SELECT `id`,`date`,`admin`,`admin_ip`,`balans` FROM `d_cl_balans` WHERE `id_client`='$id'");
  $rows_res_bal=mysql_num_rows($res_bal);
  if ( $rows_res_bal == 1 ) {
    while ( $tmp_res_bal=mysql_fetch_assoc($res_bal) ){
	  $id_bal=$tmp_res_bal['id'];
	  $date_bal=$tmp_res_bal['date'];
	  $admin_bal=$tmp_res_bal['admin'];
	  $admin_ip_bal=$tmp_res_bal['admin_ip'];
	  $balans_bal=$tmp_res_bal['balans'];
	}
  } else {
    $id_bal=0;
	$date_bal=0;
	$admin_bal=0;
	$admin_ip_bal=0;
	$balans_bal=0;
  }
  if ( $balans_bal == 0 ) { $bal_print2='<span>'.$balans_bal.' грн</span>'; }
  if ( $balans_bal > 0 ) { $bal_print2='<span class="bal_norm">'.$balans_bal.' грн</span>'; }
  if ( $balans_bal < 0 ) { $bal_print2='<span class="bal_minus">'.$balans_bal.' грн</span>'; }
 
print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td valign=\"top\">
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr><td width=\"100\" class=\"clr_back_grey\">id&nbsp;"; res_info($id,$date,$admin,$admin_ip); print '&nbsp;'; popup_view("cmd=view_log&id=$id",'view_log','Log открытия абонента',1100,500); print "</td><td width=\"150\">$id&nbsp;"; popup_win("cmd=edit_cl_list&id=$id",'edit_cl_list','Редактировать',400,300); print "</td></tr>
<tr><td class=\"clr_back_grey\">login&nbsp;"; popup_todo("cmd=todo_log&id=$id",'todo_log',"Log действий ($todo_anim)",$todo_anim,1300,500); print '&nbsp;'; popup_stat("cmd=stat_log&id=$id",'stat_log','Log статистики',1100,500); print '&nbsp;'; popup_log("cmd=mkt_log&login=$login&mac=$cl_mac",'mkt_log','Log MikroTik',1200,500); print "</td><td>$login&nbsp;"; mkt_stat("cmd=mkt_status",$login,'mkt_status','mkt статус',650,640); print '&nbsp;'; popup_queue("cmd=view_queue&login=$login",'view_queue','Активность',550,600); print "</td></tr>
<tr><td class=\"clr_back_grey\">password</td><td>$passwd</td></tr>
<tr><td class=\"clr_back_grey\">IP</td><td>$cl_ip&nbsp;"; conn_list("cmd=conn_list&ip=$cl_ip",'dhcp_stat','Список соединений',700,550); print "</td></tr>
<tr><td class=\"clr_back_grey\">MAC&nbsp;"; popup_log1("cmd=ping_log&id=$id",'ping_log','Pinger Log',870,500); print "</td><td>$cl_mac"; if (!empty($cl_mac)){ print '&nbsp;'; dhcp_stat("cmd=dhcp_stat&mac=$cl_mac",'dhcp_stat','DHCP статус',500,400); } print "</td></tr>
<tr><td class=\"clr_back_grey\">type (zero)</td><td>$cl_type ($cl_zero)</td></tr>
<tr><td class=\"clr_back_grey\">район</td><td align=\"right\">$region</td></tr>
<tr><td class=\"clr_back_grey\">улица</td><td align=\"right\">$street</td></tr>
<tr><td class=\"clr_back_grey\">дом</td><td align=\"right\">$house</td></tr>
<tr><td class=\"clr_back_grey\">квартира</td><td align=\"right\">$room</td></tr>
</table>
</td><td width=\"20\">&nbsp;</td>
<td valign=\"top\">
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr><td width=\"100\" class=\"clr_back_grey\">подключен "; res_info($id_podkl,$date_podkl,$admin_podkl,$admin_ip_podkl); print "</td><td width=\"150\">$podkl_date "; popup_win("cmd=edit_podkl&id=$id_podkl",'edit_podkl','Редактировать',450,345); print "</td></tr>\n";
// switch begin
$res88=mysql_query("SELECT
`sw_list`.`id` AS `sw_list_id`, `sw_list`.`name`,
`d_uplink`.`id`, `d_uplink`.`date`, `d_uplink`.`admin`, `d_uplink`.`admin_ip`
FROM
`d_uplink`,
`d_sw_list` AS `sw_list`
WHERE
`d_uplink`.`id_cl`='$id'
AND `d_uplink`.`type`='abon'
AND `sw_list`.`id`=`d_uplink`.`id_term`");
if ( $res88 ) { $res_rows88=mysql_num_rows($res88); } else { $res_rows88=0; }
if ( $res_rows88 == 1 ) {
 while ( $tmp88=mysql_fetch_assoc($res88) ) {
  $sw_name=$tmp88['name'];
  $sw_list_id=$tmp88['sw_list_id'];
  $uplink_id=$tmp88['id'];
  $uplink_date=$tmp88['date'];
  $uplink_admin=$tmp88['admin'];
  $uplink_admin_ip=$tmp88['admin_ip'];
 }
 print "<tr><td class=\"clr_back_grey\">switch&nbsp;"; res_info($uplink_id,$uplink_date,$uplink_admin,$uplink_admin_ip);
 print "</td><td><a href=\"?cmd=switches&id=$sw_list_id\">$sw_name</a></td></tr>\n";
} else {
 print "<tr><td class=\"clr_back_grey\">switch</td><td>none&nbsp;"; popup_add("cmd=add_uplink&id=$id&type=abon",'add_uplink','Привязать',400,150); print "</td></tr>\n";
}
// switch end
print "<tr><td class=\"clr_back_grey\">отключен ";
if ( $otkl_int == 1 ) { res_info($id3,$date3,$admin3,$admin_ip3); }
print "</td><td>$otkl_date ";
if ( $otkl_int == 1 ) { popup_win("cmd=edit_otkl&id=$id3",'edit_otkl','Редактировать',400,400); }
else { popup_add("cmd=add_otkl&id=$id",'add_otkl','Добавить',400,230); }
print "</td></tr>
<tr><td class=\"clr_back_grey\">повреждений</td><td>$remont_kol "; popup_win2("cmd=view_remont_cl&id=$id",'view_rem_list','Список повреждений',800,500); print '&nbsp;'; popup_add("cmd=add_remont&id=$id",'add_rem','Добавить',400,230); print "</td></tr>
</table>
<p align=\"center\">"; popup_prn('files/dogovor.pdf','dog',1000,600,'договор'); print '&nbsp;';
popup_prn('files/dodatok_1.pdf','dod1',1000,600,'додаток 1'); print '&nbsp;';
popup_prn("files/dodatok_2.php?id=$id",'dod2',1000,600,'додаток 2'); print "<br>
<br>
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr><td width=\"70\" class=\"clr_back_grey\">баланс&nbsp;"; popup_privat("cmd=privat_list&id=$id",'privat_list','Приват CARD заявки',1250,500); print "</td><td width=\"180\">$bal_print2&nbsp;"; res_info($id_bal,$date_bal,$admin_bal,$admin_ip_bal); print '&nbsp;'; popup_add("cmd=add_balans&id=$id",'add_bal','Пополнить баланс',400,270); print "</td></tr>\n";

$cl_info=active_check($id);
if ( $cl_info['active'] == 1 ) {
 $cl_status2="<span class=\"cl_active\">активен</span>";
} else {
 $cl_status2="<span class=\"cl_block\">заблокирован</span>";
}
$tarif_name_now2=$cl_info['tarif'].'&nbsp;('.$cl_info['cost'].'грн)';
$tarif_speed_now2=$cl_info['s_upload'].'M/'.$cl_info['s_download'].'M';

print "<tr><td class=\"clr_back_grey\">тариф</td><td title=\"$tarif_speed_now2\"><strong>$tarif_name_now2</strong></td></tr>
<tr><td colspan=\"2\" align=\"center\">$cl_status2</td></tr>\n";

print "</table>
</td><td width=\"20\">&nbsp;</td>
<td valign=\"top\">
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr><td width=\"130\" class=\"clr_back_grey\">Ф.И.О. "; res_info($id4,$date4,$admin4,$admin_ip4); print "</td><td width=\"280\">$surname $name $secname "; popup_win("cmd=edit_data&id=$id4",'edit_data','Редактировать',420,540); print "</td></tr>
<tr><td class=\"clr_back_grey\">телефон</td><td>$phone</td></tr>
<tr><td class=\"clr_back_grey\">комментарий</td><td><span class=\"clr_red\">$comment</span></td></tr>
<tr><td class=\"clr_back_grey\">SMS телефон&nbsp;"; popup_sms("cmd=sms_list&id=$id",'sms_list','Log отправки SMS',1050,500); print "</td><td>$sms_phone</td></tr>
<tr><td class=\"clr_back_grey\">документ</td><td>$doc</td></tr>
<tr><td class=\"clr_back_grey\">серия</td><td>$doc_seriya</td></tr>
<tr><td class=\"clr_back_grey\">номер</td><td>$doc_number</td></tr>
<tr><td class=\"clr_back_grey\">когда выдан</td><td>$doc_when</td></tr>
<tr><td class=\"clr_back_grey\">кем выдан</td><td>$doc_bywho</td></tr>
<tr><td class=\"clr_back_grey\">договор №</td><td>$dog_num</td></tr>
<tr><td class=\"clr_back_grey\">договор подписан</td><td>$date_dog</td></tr>
</table>
</td>
</tr></table>
<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr><td align=\"center\">";

// log tarifov
$access53=0; // view access
$res53=mysql_query("SELECT `view_abon-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res53 ) { // if $res53 begin
 while ( $tmp53=mysql_fetch_assoc($res53) ){
  $access53=$tmp53['view_abon-adm']; }
} // if $res53 end

popup_add_abon_pl("cmd=add_abon_pl&id=$id",'add_abon_pl',400,270,$podkl_int,$otkl_int); print "&nbsp;<strong>Тарифы (история)</strong></td></tr>
<tr><td><textarea class=\"textar_bal\" readonly=\"readonly\" rows=\"6\" cols=\"100\">\n";
$res7=mysql_query("
SELECT
`tarif_log`.`id`,`tarif_log`.`date`,`tarif_log`.`admin`,`tarif_log`.`admin_ip`,`tarif_log`.`month`,`tarif_log`.`year`,`tarif_log`.`id_balans`,
`tarifs`.`name` AS `tarif_name`
FROM
`d_cl_tarif_log` AS `tarif_log`,
`t_tarifs` AS `tarifs`
WHERE
`tarif_log`.`id_client`='$id'
AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `id` DESC");
while ( $tmp7=mysql_fetch_assoc($res7) ){
 $id_tarif_log=$tmp7['id'];
 $date_tarif_log=$tmp7['date'];
 $admin_tarif_log=$tmp7['admin'];
 $admin_ip_tarif_log=$tmp7['admin_ip'];
 $month_tarif_log=$tmp7['month'];
 $year_tarif_log=$tmp7['year'];
 $id_balans_tarif_log=$tmp7['id_balans'];
 $name_tarif_log=$tmp7['tarif_name'];
 print $year_tarif_log.'.'.$mon_name[$month_tarif_log]." - $name_tarif_log - $date_tarif_log | $admin_tarif_log | $admin_ip_tarif_log | id=$id_tarif_log | id_balans=$id_balans_tarif_log\n";
}
print "</textarea></td></tr>
<tr><td align=\"center\">"; popup_add_balans("cmd=add_balans&id=$id",'add_bal',400,270); print "&nbsp;<strong>Баланс (история) [<span id=\"balans\"></span>]</strong>";
if ( $access53 == 1 ) {
 print '&nbsp;';
 popup_del('cmd=del_balans','del_balans','Удалить запись',400,150);
}
print "</td></tr>
<tr><td><textarea class=\"textar_bal\" readonly=\"readonly\" rows=\"8\" cols=\"100\">\n";
$balans=0;
$res3=mysql_query("
SELECT
`balans_log`.`id`,`balans_log`.`date`,`balans_log`.`admin`,`balans_log`.`admin_ip`,`balans_log`.`summa`,`balans_log`.`cash`,`balans_log`.`comment`,
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`t_kassa` AS `kassa`
WHERE
`balans_log`.`id_client`='$id'
AND `kassa`.`id`=`balans_log`.`id_kassa`
ORDER BY `id` DESC");
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $id_bal_log=$tmp3['id'];
 $date_bal_log=$tmp3['date'];
 $admin_bal_log=$tmp3['admin'];
 $admin_ip_bal_log=$tmp3['admin_ip'];
 $summa_bal_log=$tmp3['summa'];
 $kassa=$tmp3['kassa_name'];
 $cash_bal_log=$tmp3['cash'];
 $comment_bal_log=$tmp3['comment'];
 print "$summa_bal_log грн - $comment_bal_log - $date_bal_log | $kassa | $admin_bal_log | $admin_ip_bal_log | cash=$cash_bal_log | id=$id_bal_log\n";
 $balans=$balans+$summa_bal_log;
}
if ( $balans == 0 ) { $bal_print='<span>'.$balans.' грн</span>'; }
if ( $balans > 0 ) { $bal_print='<span class="bal_norm">'.$balans.' грн</span>'; }
if ( $balans < 0 ) { $bal_print='<span class="bal_minus">'.$balans.' грн</span>'; }
print "</textarea></td></tr>
<script type=\"text/javascript\">document.getElementById('balans').innerHTML = '$bal_print'; if($balans!=$balans_bal)alert('Несовпадение балансов!');</script>
</table>\n";

}

function show_abon_list($id_list) {
 print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">i</td><td align=\"center\">Адрес</td><td align=\"center\">login</td><td align=\"center\">Ф.И.О. (тел)</td><td align=\"center\">Состояние</td></tr>\n";
 $res=mysql_query("SELECT `id`,`date`,`admin`,`admin_ip`,`login`,`id_street`,`house`,`room` FROM `d_cl_list` WHERE `id` IN ($id_list) ORDER BY (`house`+0),(`room`+0)");
 $rows_res=mysql_num_rows($res);
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id=$tmp['id'];
  $date=$tmp['date'];
  $admin=$tmp['admin'];
  $admin_ip=$tmp['admin_ip'];
  $login=$tmp['login'];
  $id_street=$tmp['id_street'];
  $house=$tmp['house'];
  $room=$tmp['room'];
  $res2=mysql_query("SELECT `street` FROM `t_streets` WHERE `id`='$id_street'");
  while ( $tmp2=mysql_fetch_assoc($res2) ){
   $street=$tmp2['street'];
  }
  $res2=mysql_query("SELECT `surname`,`name`,`secname`,`phone` FROM `d_cl_data` WHERE `id_client`='$id'");
  while ( $tmp2=mysql_fetch_assoc($res2) ){
   $surname=$tmp2['surname'];
   $name=$tmp2['name'];
   $secname=$tmp2['secname'];
   $phone=$tmp2['phone'];
  }
  $res2=mysql_query("SELECT `date_finish` FROM `d_cl_podkl` WHERE `id_client`='$id'");
  while ( $tmp2=mysql_fetch_assoc($res2) ){
   $date_finish2=$tmp2['date_finish'];
  }
  if ( !empty($date_finish2) ) {
   $status="<span class=\"clr_green\">Подключен ($date_finish2)</span>";
  } else {
   $status="<span class=\"clr_green\">стоит в очереди</span>";
  }
  $res3=mysql_query("SELECT `date_finish` FROM `d_cl_otkl` WHERE `id_client`='$id'");
  $rows_res3=0;
  $rows_res3=mysql_num_rows($res3);
  if ( $rows_res3 == 1 ) {
   while ( $tmp3=mysql_fetch_assoc($res3) ){ $date_finish=$tmp3['date_finish']; }
   if ( !empty($date_finish) ) {
    $status="<span class=\"clr_red\">Отключен ($date_finish)</span>";
   } else {
    $status="<span class=\"clr_red\">стоит в очереди</span>";
   }
  }

  print '<tr><td>'; res_info($id,$date,$admin,$admin_ip); print "</td><td>ул. $street д. $house кв. $room</td><td><a href=\"?cmd=view_abon&id=$id\">$login</a>&nbsp;"; mkt_stat('cmd=mkt_status',$login,'mkt_status','mkt статус',900,600); print '&nbsp;'; popup_queue("cmd=view_queue&login=$login",'view_queue','Активность',550,600); print '&nbsp;'; popup_log("cmd=mkt_log&login=$login",'mkt_log','Log MikroTik',1200,500); print "</td><td>$surname $name $secname<br>($phone)</td><td>$status</td></tr>\n";
 }
 print "</table><br>\n";
 print "<strong>Всего: $rows_res</strong><br>\n";
}

// input

if ( isset($_GET['id']) && !empty($_GET['id']) ) { $id=$_GET['id']; } else { $id=''; }
if ( isset($_GET['login']) && !empty($_GET['login']) ) { $login=$_GET['login']; } else { $login=''; }
if ( isset($_GET['id_street']) && !empty($_GET['id_street']) ) { $id_street=$_GET['id_street']; } else { $id_street=''; }
if ( isset($_GET['house']) && !empty($_GET['house']) ) { $house=$_GET['house']; } else { $house=''; }
if ( isset($_GET['room']) && !empty($_GET['room']) ) { $room=$_GET['room']; } else { $room=''; }
if ( isset($_GET['sp']) && $_GET['sp'] == 1 ) {
 $div_st = 'block';
 $div_tit='скрыть';
 if ( isset($_GET['cl_mac']) ) { $cl_mac=$_GET['cl_mac']; } else { $cl_mac=''; }
 if ( isset($_GET['cl_ip']) ) { $cl_ip=$_GET['cl_ip']; } else { $cl_ip=''; }
 if ( isset($_GET['cl_surname']) ) { $cl_surname=$_GET['cl_surname']; } else { $cl_surname=''; }
 if ( isset($_GET['cl_name']) ) { $cl_name=$_GET['cl_name']; } else { $cl_name=''; }
 if ( isset($_GET['cl_secname']) ) { $cl_secname=$_GET['cl_secname']; } else { $cl_secname=''; }
 if ( isset($_GET['cl_phone']) ) { $cl_phone=$_GET['cl_phone']; } else { $cl_phone=''; }
} else {
 $div_st = 'none';
 $div_tit='расширенный поиск';
 $cl_mac='';
 $cl_ip='';
 $cl_surname='';
 $cl_name='';
 $cl_secname='';
 $cl_phone='';
}

// what show

$show=0;

// street search
if ( !empty($id_street) && empty($house) && empty($room)) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `id_street`='$id_street'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// street - house search
if ( !empty($id_street) && !empty($house) && empty($room)) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `id_street`='$id_street' AND `house`='$house'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// street - house - room search
if ( !empty($id_street) && !empty($house) && !empty($room)) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `id_street`='$id_street' AND `house`='$house' AND `room`='$room'");
 $rows_res=mysql_num_rows($res);
 if ( $rows_res == 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){ $id=$tmp['id']; }
  $show=1;
 }
 if ( $rows_res > 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){
   $id2=$tmp['id'];
   $res2=mysql_query("SELECT `date_finish` FROM `d_cl_otkl` WHERE `id_client`='$id2'");
   $rows_res2=0;
   $rows_res2=mysql_num_rows($res2);
   if ( $rows_res2 > 0 ) {
    while ( $tmp2=mysql_fetch_assoc($res2) ){ $date_finish=$tmp2['date_finish']; }
	if ( empty($date_finish) ) {
	 $id=$id2;
	 $show=1;
	}
   } else {
   $id=$id2;
   $show=1;
   }   
  }
 }
}

// login search
if ( !empty($login) ) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `login`='$login'");
 $rows_res=mysql_num_rows($res);
 if ( $rows_res == 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){ $id=$tmp['id']; }
  $show=1;
 }
 if ( $rows_res > 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){
   $id2=$tmp['id'];
   $res2=mysql_query("SELECT `date_finish` FROM `d_cl_otkl` WHERE `id_client`='$id2'");
   $rows_res2=0;
   $rows_res2=mysql_num_rows($res2);
   if ( $rows_res2 > 0 ) {
    while ( $tmp2=mysql_fetch_assoc($res2) ){ $date_finish=$tmp2['date_finish']; }
	if ( empty($date_finish) ) {
	 $id=$id2;
	 $show=1;
	}
   } else {
   $id=$id2;
   $show=1;
   }   
  }
 }
}

// mac search
if ( !empty($cl_mac) ) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `d_cl_list`.`cl_mac`='$cl_mac'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// ip search
if ( !empty($cl_ip) ) {
 $res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `d_cl_list`.`cl_ip`='$cl_ip'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// surname search
if ( !empty($cl_surname) ) {
 $res=mysql_query("SELECT `d_cl_list`.`id` FROM `d_cl_list`,`d_cl_data` WHERE `d_cl_list`.`id`=`d_cl_data`.`id_client` AND `surname` LIKE BINARY '$cl_surname%'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// name search
if ( !empty($cl_name) ) {
 $res=mysql_query("SELECT `d_cl_list`.`id` FROM `d_cl_list`,`d_cl_data` WHERE `d_cl_list`.`id`=`d_cl_data`.`id_client` AND `name` LIKE BINARY '$cl_name%'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// secname search
if ( !empty($cl_secname) ) {
 $res=mysql_query("SELECT `d_cl_list`.`id` FROM `d_cl_list`,`d_cl_data` WHERE `d_cl_list`.`id`=`d_cl_data`.`id_client` AND `secname` LIKE BINARY '$cl_secname%'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// phone search
if ( !empty($cl_phone) ) {
 $res=mysql_query("SELECT `d_cl_list`.`id` FROM `d_cl_list`,`d_cl_data` WHERE `d_cl_list`.`id`=`d_cl_data`.`id_client` AND `phone` LIKE '%$cl_phone%'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $id2=$tmp['id'];
  if ( !empty($id_list) ) { $id_list=$id_list.','.$id2; } else { $id_list=$id2; }
  $show=2;
 }
}

// id search
if ( !empty($id) ) {
 $res=mysql_query("SELECT `login`,`id_street`,`house`,`room` FROM `d_cl_list` WHERE `id`='$id'");
 $rows_res=mysql_num_rows($res);
 if ( $rows_res == 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){
   $login=$tmp['login'];
   $id_street=$tmp['id_street'];
   $house=$tmp['house'];
   $room=$tmp['room'];
  }
  $show=1;
 }
}

// search body

print "<!-- search begin -->
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><td>
id <input tabindex=\"1\" class=\"text_r\" type=\"text\" maxlength=\"11\" size=\"11\" name=\"id\" value=\"$id\">
<input class=\"inp_small\" tabindex=\"2\" type=\"submit\" value=\"Найти\">
</td></form>
<td width=\"30\">&nbsp;</td>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><td>
login <input tabindex=\"3\" class=\"text_r\" type=\"text\" maxlength=\"40\" size=\"20\" name=\"login\" value=\"$login\">
<input class=\"inp_small\" tabindex=\"4\" type=\"submit\" value=\"Найти\">
</td></form>
<td width=\"30\">&nbsp;</td>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><td>
<a href=\"?cmd=view_abon&id_street=$id_street\" title=\"Отобразить улицу\">ул.</a>&nbsp;"; street_list_f(5,$id_street);
print "&nbsp;
д. <input tabindex=\"6\" class=\"text_r\" type=\"text\" maxlength=\"10\" size=\"10\" name=\"house\" value=\"$house\">&nbsp;
кв. <input tabindex=\"7\" class=\"text_r\" type=\"text\" maxlength=\"10\" size=\"10\" name=\"room\" value=\"$room\">
<input class=\"inp_small\" tabindex=\"8\" type=\"submit\" value=\"Найти\">
</td></form>
<td width=\"30\">&nbsp;</td>
<td><a href=\"javascript:toggle_find('find');\" id=\"displayText_find\">$div_tit</a></td>
</tr><tr>
<td colspan=\"7\"><div id=\"toggleText_find\" style=\"display:$div_st;\"><br>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><input type=\"hidden\" name=\"sp\" value=\"1\">
MAC <input tabindex=\"9\" type=\"text\" maxlength=\"17\" size=\"19\" name=\"cl_mac\" value=\"$cl_mac\">&nbsp;&nbsp;
IP <input tabindex=\"11\" type=\"text\" maxlength=\"12\" size=\"14\" name=\"cl_ip\" value=\"$cl_ip\">&nbsp;&nbsp;
<input class=\"inp_small\" tabindex=\"12\" type=\"submit\" value=\"Найти\"></form>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><input type=\"hidden\" name=\"sp\" value=\"1\">
Фамилия <input tabindex=\"13\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"cl_surname\" value=\"$cl_surname\">&nbsp;&nbsp;
Имя <input tabindex=\"14\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"cl_name\" value=\"$cl_name\">&nbsp;&nbsp;
Отчество <input tabindex=\"14\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"cl_secname\" value=\"$cl_secname\">&nbsp;&nbsp;
<input class=\"inp_small\" tabindex=\"16\" type=\"submit\" value=\"Найти\"></form>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_abon\"><input type=\"hidden\" name=\"sp\" value=\"1\">
Телефон <input tabindex=\"17\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"cl_phone\" value=\"$cl_phone\">&nbsp;&nbsp;
<input class=\"inp_small\" tabindex=\"18\" type=\"submit\" value=\"Найти\"></form>
</div>
</td>
</tr></table>
<!-- search end -->
<hr>\n";

// body

if ( $show == 0 ) { print "Не найдено ни одного совпадения.<br>\n"; }
if ( $show == 1 ) { show_abon2($id); }
if ( $show == 2 ) { show_abon_list($id_list); }

// MAC info begin
if ( isset($_GET['cl_mac']) && !empty($_GET['cl_mac']) ) {
$mac=$_GET['cl_mac'];
print "<hr>
MAC info: <strong>$mac</strong>\n";
	$st_mkt1=ssh_query("/ip dhcp-server lease print value-list where mac-address='$mac'",1);
	$col1=count($st_mkt1)-1;
	print "<pre>\n";
	$i=0;
	while ( $i < $col1 ) {
		if ( $i == 0 ) {
			$ip_arr=explode(':',$st_mkt1[$i]);
			$temp_ip=trim($ip_arr[1]);
			print $st_mkt1[$i]; print "&nbsp;<a href=\"#\" onclick=\"javascript:loadScript('load_s/ping_ip.php?ip=$temp_ip'); var res = document.getElementById('result'); res.innerHTML='wait...';\"><img src=\"img/sync.png\" border=\"0\" title=\"Ping\" /></a>&nbsp;<span id=\"result\"></span>\n";
		} else {
			print $st_mkt1[$i]."\n";
		}
		$i++;
	}
	print "</pre>\n";
	$arr_ven=explode(':',$mac);
	$vendor=$arr_ven[0].$arr_ven[1].$arr_ven[2];
	$vendor=exec("cat ./load_s/vendors | grep $vendor");
	if ( strlen($vendor) == 0 ) { $vendor='not found'; }
	#$vendor='111111 wegfnhbvcsvfd';
	print "Vendor local: $vendor<br><br>\n";
	// api begin
	$url = "http://api.macvendors.com/" . urlencode($mac);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	if(!$response) {
		$response='not found';
	}
	print "Vendor api: $response<br>\n";
	// api end
}
// MAC info end

?>