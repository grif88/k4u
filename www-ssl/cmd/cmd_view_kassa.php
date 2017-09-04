<?php

include './include/month.php';

// functions

function re_date($date) {
 $arr_date=explode('.',$date);
 $new_date=$arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
 return $new_date;
}

// access
$res2=mysql_query("SELECT `view_kassa-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['view_kassa-adm'];
 }
}
// date
$d_begin=$php_date_s;
$d_end=$php_date_s;

//kassa
$res5=mysql_query("SELECT `id` FROM `t_kassa` WHERE `ip`='$php_user_ip' ORDER BY `id`");
$res_rows5=mysql_num_rows($res5);
if ( $res_rows5 == 1 ) {
 while ( $tmp5=mysql_fetch_assoc($res5) ){
  $id_kassa2=$tmp5['id'];
 }
} else { $id_kassa2=1; }

if ( $access2 == 1 ) { // if access begin
 if ( !empty($_GET['d_begin']) ) { $d_begin=$_GET['d_begin']; }
 if ( !empty($_GET['d_end']) ) { $d_end=$_GET['d_end']; }
 if ( !empty($_GET['id_kassa']) ) { $id_kassa_temp=$_GET['id_kassa']; }
 #  $id_kassa_temp=$_GET['id_kassa'];
 if ( !empty($id_kassa_temp) ) { $id_kassa=$id_kassa_temp; } else { $id_kassa=$id_kassa2; }
 if ( !empty($_GET['id_region']) ) { $id_region=$_GET['id_region']; } else { $id_region=0; }
 print "<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_kassa\">c <input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_begin\" value=\"$d_begin\" class=\"tcal\"> по <input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_end\" value=\"$d_end\" class=\"tcal\"> касса "; t_kassa_s($id_kassa); print " район "; region_kassa($id_region); print " <input type=\"submit\" value=\"OK\"></form>\n";
} else { // if access else
 if ( !empty($_GET['d_begin']) ) { $d_begin=$_GET['d_begin']; }
 if ( !empty($_GET['d_end']) ) { $d_end=$_GET['d_end']; }
 $id_kassa=$id_kassa2;
 print "<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"view_kassa\">c <input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_begin\" value=\"$d_begin\" class=\"tcal\"> по <input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_end\" value=\"$d_end\" class=\"tcal\"> <input type=\"submit\" value=\"OK\"></form>\n";
} // if access end

// body

// kassa2
$res6=mysql_query("SELECT `name` FROM `t_kassa` WHERE `id`='$id_kassa'");
 while ( $tmp6=mysql_fetch_assoc($res6) ){
  $kassa=$tmp6['name'];
 }	
// date 2
$date_begin=re_date($d_begin);
$date_end=re_date($d_end);

print "<strong>$kassa (в кассе: <span id=\"money\"></span> грн) (операций: <span id=\"operations\"></span> шт)</strong><br>
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">login</td><td align=\"center\">Сумма (грн)</td><td align=\"center\">Комментарий</td><td align=\"center\">Дата-Время</td><td align=\"center\">User - IP</td><td align=\"center\">Касса</td><td align=\"center\">id</td></tr>\n";
$money=0;
$kol_op=0;
if ( !isset($id_region) ) { $id_region=0; }
if ( $id_region != 0 ) { $sel_add = "AND `list`.`id_region`='$id_region'"; } else { $sel_add = ''; }
if ( $id_kassa == 999 ) {
$res3=mysql_query("
SELECT
`balans_log`.`id`,`balans_log`.`date`,`balans_log`.`admin`,`balans_log`.`admin_ip`,`balans_log`.`summa`,`balans_log`.`comment`,
`list`.`id` AS `id_list`,`list`.`login`,
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`d_cl_list` AS `list`,
`t_kassa` AS `kassa`
WHERE
`list`.`id`=`balans_log`.`id_client`
$sel_add
AND `balans_log`.`cash`='1'
AND `kassa`.`id`=`balans_log`.`id_kassa`
AND `balans_log`.`kassa_date` BETWEEN '$date_begin' AND '$date_end'
ORDER BY `balans_log`.`id` DESC");
} else {
$res3=mysql_query("
SELECT
`balans_log`.`id`,`balans_log`.`date`,`balans_log`.`admin`,`balans_log`.`admin_ip`,`balans_log`.`summa`,`balans_log`.`comment`,
`list`.`id` AS `id_list`,`list`.`login`,
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`d_cl_list` AS `list`,
`t_kassa` AS `kassa`
WHERE
`balans_log`.`id_kassa`='$id_kassa'
$sel_add
AND `list`.`id`=`balans_log`.`id_client`
AND `balans_log`.`cash`='1'
AND `kassa`.`id`=`balans_log`.`id_kassa`
AND `balans_log`.`kassa_date` BETWEEN '$date_begin' AND '$date_end'
ORDER BY `balans_log`.`id` DESC");
}
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $id_list=$tmp3['id_list'];
 $login=$tmp3['login'];
 $id_bal_log=$tmp3['id'];
 $date_bal_log=$tmp3['date'];
 $admin_bal_log=$tmp3['admin'];
 $admin_ip_bal_log=$tmp3['admin_ip'];
 $summa_bal_log=$tmp3['summa'];
 $comment_bal_log=$tmp3['comment'];
 $kassa_name=$tmp3['kassa_name'];
 print "<tr><td><a href=\"?cmd=view_abon&id=$id_list\">$login</a></td><td>$summa_bal_log</td><td>$comment_bal_log</td><td>$date_bal_log</td><td>$admin_bal_log - $admin_ip_bal_log</td><td>$kassa_name</td><td>$id_bal_log</td></tr>\n";
 $money=$money+$summa_bal_log;
 $kol_op++;
}
print "</table>
<script type=\"text/javascript\">
document.getElementById('money').innerHTML = '$money';
document.getElementById('operations').innerHTML = '$kol_op';
</script>\n";

// abon_pl

print "<strong>Активированные тарифы (операций: <span id=\"operations2\"></span> шт)</strong><br>
<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">login</td><td align=\"center\">Тариф</td><td align=\"center\">Месяц</td><td align=\"center\">Сумма (грн)</td><td align=\"center\">Комментарий</td><td align=\"center\">Дата-Время</td><td align=\"center\">User - IP</td><td align=\"center\">Касса</td><td align=\"center\">id</td><td align=\"center\">id_balans</td></tr>\n";
$kol_op2=0;
if ( $id_kassa == 999 ) {
$res3=mysql_query("
SELECT
`tarif_log`.`id`, `tarif_log`.`date`, `tarif_log`.`admin`, `tarif_log`.`admin_ip`, `tarif_log`.`month`, `tarif_log`.`year`,
`balans_log`.`summa`,`balans_log`.`comment`,
`list`.`id` AS `id_list`,`list`.`login`,
`tarifs`.`name` AS `tarif_name`,
`balans_log`.`id` AS `id_balans`,
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`d_cl_tarif_log` AS `tarif_log`,
`d_cl_list` AS `list`,
`t_tarifs` AS `tarifs`,
`t_kassa` AS `kassa`
WHERE
`list`.`id`=`tarif_log`.`id_client`
$sel_add
AND `tarifs`.`id`=`tarif_log`.`id_tarif`
AND `kassa`.`id`=`balans_log`.`id_kassa`
AND `balans_log`.`id`=`tarif_log`.`id_balans`
AND `balans_log`.`kassa_date` BETWEEN '$date_begin' AND '$date_end'
ORDER BY `tarif_log`.`id` DESC");
} else {
$res3=mysql_query("
SELECT
`tarif_log`.`id`, `tarif_log`.`date`, `tarif_log`.`admin`, `tarif_log`.`admin_ip`, `tarif_log`.`month`, `tarif_log`.`year`,
`balans_log`.`summa`,`balans_log`.`comment`,
`list`.`id` AS `id_list`,`list`.`login`,
`tarifs`.`name` AS `tarif_name`,
`balans_log`.`id` AS `id_balans`,
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`d_cl_tarif_log` AS `tarif_log`,
`d_cl_list` AS `list`,
`t_tarifs` AS `tarifs`,
`t_kassa` AS `kassa`
WHERE
`balans_log`.`id_kassa`='$id_kassa'
$sel_add
AND `list`.`id`=`tarif_log`.`id_client`
AND `tarifs`.`id`=`tarif_log`.`id_tarif`
AND `kassa`.`id`=`balans_log`.`id_kassa`
AND `balans_log`.`id`=`tarif_log`.`id_balans`
AND `balans_log`.`kassa_date` BETWEEN '$date_begin' AND '$date_end'
ORDER BY `tarif_log`.`id` DESC");
}
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $id_list=$tmp3['id_list'];
 $login=$tmp3['login'];
 $id_tar_log=$tmp3['id'];
 $date_tar_log=$tmp3['date'];
 $admin_tar_log=$tmp3['admin'];
 $admin_ip_tar_log=$tmp3['admin_ip'];
 $month_tar_log=$tmp3['month'];
 $year_ip_tar_log=$tmp3['year'];
 $summa_bal_log=$tmp3['summa'];
 $comment_bal_log=$tmp3['comment'];
 $tarif_name=$tmp3['tarif_name'];
 $id_balans=$tmp3['id_balans'];
 $kassa_name=$tmp3['kassa_name'];
 print "<tr><td><a href=\"?cmd=view_abon&id=$id_list\">$login</a></td><td>$tarif_name</td><td>$year_ip_tar_log.".$mon_name["$month_tar_log"]."</td><td>$summa_bal_log</td><td>$comment_bal_log</td><td>$date_tar_log</td><td>$admin_tar_log - $admin_ip_tar_log</td><td>$kassa_name</td><td>$id_tar_log</td><td>$id_balans "; popup_del("cmd=del_abon_pl&id=$id_balans",'del_abon_pl','Удалить',400,150); print "</td></tr>\n";
 $kol_op2++;
}
print "</table>
<script type=\"text/javascript\">
document.getElementById('operations2').innerHTML = '$kol_op2';
</script>\n";

?>