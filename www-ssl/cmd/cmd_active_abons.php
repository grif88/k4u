<?php

// get

if ( !empty($_GET['id_region']) ) { $id_region=$_GET["id_region"]; } else { $id_region=0; }
if ( !empty($_GET['month']) ) { $php_date_m=$_GET["month"]; }
if ( !empty($_GET['year']) ) { $php_date_y=$_GET["year"]; }

// body

if ( $php_date_m == '01' ) {
 $prev_y=$php_date_y-1;
 $prev_m='12';
} else {
 $prev_y=$php_date_y;
 $prev_m_t=$php_date_m-1;
 if ( $prev_m_t <= 9 ) { $prev_m='0'.$prev_m_t; } else { $prev_m=$prev_m_t; }
}

if ( $php_date_m == '12' ) {
 $next_y=$php_date_y+1;
 $next_m='01';
} else {
 $next_y=$php_date_y;
 $next_m_t=$php_date_m+1;
 if ( $next_m_t <= 9 ) { $next_m='0'.$next_m_t; } else { $next_m=$next_m_t; }
}

print "<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"active_abons\">район:&nbsp;"; region_kassa($id_region); print "&nbsp;год:&nbsp;<input maxlength=\"4\" size=\"5\" name=\"year\" type=\"text\" value=\"$php_date_y\">&nbsp;месяц:&nbsp;<input maxlength=\"2\" size=\"3\" name=\"month\" type=\"text\" value=\"$php_date_m\">&nbsp;<input type=\"submit\" value=\"OK\"></form>\n";
print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr valign=\"top\" align=\"center\">
<td>
<strong>Активные абоненты</strong><br>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">login</td><td align=\"center\">$prev_m.$prev_y</td><td align=\"center\">$php_date_m.$php_date_y</td><td align=\"center\">$next_m.$next_y</td><td align=\"center\">SMS</td></tr>\n";

if ( $id_region != 0 ) { $sel_add = "AND `list`.`id_region`='$id_region'"; } else { $sel_add = ''; }
$res33=mysql_query("
SELECT
`list`.`id` AS `id_list`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`
WHERE
(`otkl`.`date_finish` IS NOT NULL AND `otkl`.`date_finish`!='')
AND `list`.`id`=`otkl`.`id_client`
$sel_add
ORDER BY `list`.`id`
");
$otkl_list=0;
if ( $res33 ) {
 while ( $tmp33=mysql_fetch_assoc($res33) ) {
  $id_list33=$tmp33["id_list"];
  if ( !empty($otkl_list) ) { $otkl_list=$otkl_list.','.$id_list33; } else { $otkl_list=$id_list33; }
 }
}

$kol_active=0;
$kol_no_active=0;
$kol_active2=0;
$kol_no_active2=0;
$kol_active3=0;
$kol_no_active3=0;
$res=mysql_query("
SELECT
`list`.`id`, `list`.`login`, `data`.`sms_phone`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`
WHERE
`podkl`.`id_client`=`list`.`id`
AND `data`.`id_client`=`list`.`id`
AND (`podkl`.`date_finish` IS NOT NULL AND `podkl`.`date_finish`!='')
$sel_add
AND `list`.`id` NOT IN ($otkl_list)	
ORDER BY `list`.`login`
");
if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id_list=$tmp["id"];
 $login=$tmp["login"];
 $sms_phone=$tmp["sms_phone"];
 $prev_tarif=tarif_check($id_list,$prev_y,$prev_m);
 if ( $prev_tarif['active'] == 0 ) {
  $class_clr2="class=\"clr_back_red\"";
  $kol_no_active2++; 
 } else {
  $kol_active2++;
  if ( !isset($tarif_kol2[$prev_tarif['tarif_id']]) ) { $tarif_kol2[$prev_tarif['tarif_id']]=0; }
  $tarif_kol2[$prev_tarif['tarif_id']]++;
  $class_clr2="class=\"clr_back_green\"";
 }
 $now_tarif=tarif_check($id_list,$php_date_y,$php_date_m);
 if ( $now_tarif['active'] == 0 ) {
  $class_clr="class=\"clr_back_red\"";
  $kol_no_active++; 
 } else {
  $kol_active++;
  if ( !isset($tarif_kol[$now_tarif['tarif_id']]) ) { $tarif_kol[$now_tarif['tarif_id']]=0; }
  $tarif_kol[$now_tarif['tarif_id']]++;
  $class_clr="class=\"clr_back_green\"";
 }
 $next_tarif=tarif_check($id_list,$next_y,$next_m);
 if ( $next_tarif['active'] == 0 ) {
  $class_clr3="class=\"clr_back_red\"";
  $kol_no_active3++; 
 } else {
  $kol_active3++;
  if ( !isset($tarif_kol3[$next_tarif['tarif_id']]) ) { $tarif_kol3[$next_tarif['tarif_id']]=0; }
  $tarif_kol3[$next_tarif['tarif_id']]++;
  $class_clr3="class=\"clr_back_green\"";
 }
 print "<tr><td $class_clr><a href=\"?cmd=view_abon&id=$id_list\"><strong>$login</strong></a>&nbsp;"; popup_queue("cmd=view_queue&login=$login",'view_queue','Активность',550,600); print "&nbsp;"; popup_log("cmd=mkt_log&login=$login",'mkt_log','Log MikroTik',1200,500); print "</td><td $class_clr2>".$prev_tarif["tarif"]."</td><td $class_clr>".$now_tarif["tarif"]."</td><td $class_clr3>".$next_tarif["tarif"]."</td><td>$sms_phone</td></tr>\n";
}
} // if
$kol_all=$kol_active+$kol_no_active;
$kol_all2=$kol_active2+$kol_no_active2;
$kol_all3=$kol_active3+$kol_no_active3;

$cost_prev=0;
$cost_now=0;
$cost_next=0;
print "</table>
</td>
<td width=\"20\">&nbsp;</td>
<td>
<strong>Статистика</strong><br>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td>&nbsp;</td><td>$prev_m.$prev_y</td><td>$php_date_m.$php_date_y</td><td>$next_m.$next_y</td></tr>
<tr><td class=\"clr_back_grey\">активные</td><td>$kol_active2</td><td>$kol_active</td><td>$kol_active3</td></tr>
<tr><td class=\"clr_back_grey\">не активные</td><td>$kol_no_active2</td><td>$kol_no_active</td><td>$kol_no_active3</td></tr>
<tr><td class=\"clr_back_grey\">всего</td><td>$kol_all2</td><td>$kol_all</td><td>$kol_all3</td></tr>
</table>
</td>
<td width=\"20\">&nbsp;</td>
<td>
<strong>Тарифы</strong><br>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\" class=\"clr_back_grey\"><td>тариф</td><td>$prev_m.$prev_y</td><td>$php_date_m.$php_date_y</td><td>$next_m.$next_y</td></tr>\n";
$res2=mysql_query("SELECT `id`,`name`,`cost` FROM `t_tarifs` WHERE `view`='1' ORDER BY `poss`");
if ( $res2 ) { // if
while ( $tmp2=mysql_fetch_assoc($res2) ){
 $id_tarif=$tmp2["id"];
 $name_tarif=$tmp2["name"];
 $cost_tarif=$tmp2["cost"];
 print "<tr><td>$name_tarif</td><td>";
 if ( !empty($tarif_kol2[$id_tarif]) ) { echo $tarif_kol2["$id_tarif"]; $cost_prev=$cost_prev+($tarif_kol2[$id_tarif]*$cost_tarif); } else { echo '0'; }
 print "</td><td>";
 if ( !empty($tarif_kol[$id_tarif]) ) { echo $tarif_kol["$id_tarif"]; $cost_now=$cost_now+($tarif_kol[$id_tarif]*$cost_tarif); } else { echo '0'; }
 print "</td><td>";
 if ( !empty($tarif_kol3[$id_tarif]) ) { echo $tarif_kol3["$id_tarif"]; $cost_next=$cost_next+($tarif_kol3[$id_tarif]*$cost_tarif); } else { echo '0'; }
 print "</td></tr>\n";
}

$cost2_now=$cost_now-$cost_prev;
$cost2_next=$cost_next-$cost_now;
if ( $cost2_now <= 0 ) { $cost2_prev='<img src="img/fall.png" border="0" title="Падает">'; } else { $cost2_prev='<img src="img/raise.png" border="0" title="Растёт">'; }

print "<tr align=\"center\" class=\"clr_back_grey\"><td>Оборот (грн)</td><td>$cost_prev</td><td>$cost_now</td><td>$cost_next</td></tr>
<tr align=\"center\" class=\"clr_back_grey\"><td>Разница (грн)</td><td><strong>$cost2_prev</strong></td><td>$cost2_now</td><td>$cost2_next</td></tr>\n";
} // if

print "</table>
</td>
</tr></table>\n";
?>