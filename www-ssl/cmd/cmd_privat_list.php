<?php

// body

if ( isset($_GET['id']) ) { // if id
$temp22=1;
$id_client=$_GET['id'];
$res=mysql_query("
SELECT
`list`.`login`,
`no_cash`.`id`, `no_cash`.`date`, `no_cash`.`admin`, `no_cash`.`admin_ip`, `no_cash`.`id_client`, `no_cash`.`pay_date`, `no_cash`.`payer`, `no_cash`.`pay_comment`, `no_cash`.`pay_summa`, `no_cash`.`date2`, `no_cash`.`admin2`, `no_cash`.`admin_ip2`, `no_cash`.`summa`, `no_cash`.`fail`
FROM
`d_cl_list` AS `list`,
`d_no_cash` AS `no_cash`
WHERE
`no_cash`.`id_client`='$id_client'
AND `list`.`id`=`no_cash`.`id_client`
ORDER BY `no_cash`.`id` DESC
");
} else { // else id
$temp22=0;

// input

if ( !isset($_GET['limit']) ) { $limit=100; } else { $limit=$_GET['limit']; }
if ( isset($_GET['finish']) ) { $finish=$_GET['finish']; } else { $finish=0; }

// head

print "<a href=\"?cmd=privat_list&limit=$limit\">&lt;открытые&gt;</a>&nbsp;
<a href=\"?cmd=privat_list&finish=1&limit=$limit\">&lt;закрытые&gt;</a>&nbsp;
<a href=\"?cmd=privat_list&finish=2&limit=$limit\">&lt;все&gt;</a><br>
<br>\n";

if ( $finish == 0 ) { $temp_sel_2="AND (`no_cash`.`date2` IS NULL OR `no_cash`.`date2`='')"; }
if ( $finish == 1 ) { $temp_sel_2="AND (`no_cash`.`date2` IS NOT NULL AND `no_cash`.`date2`!='')"; }
if ( $finish == 2 ) { $temp_sel_2=""; }

$res=mysql_query("
SELECT
`list`.`login`,
`no_cash`.`id`, `no_cash`.`date`, `no_cash`.`admin`, `no_cash`.`admin_ip`, `no_cash`.`id_client`, `no_cash`.`pay_date`, `no_cash`.`payer`, `no_cash`.`pay_comment`, `no_cash`.`pay_summa`, `no_cash`.`date2`, `no_cash`.`admin2`, `no_cash`.`admin_ip2`, `no_cash`.`summa`, `no_cash`.`fail`
FROM
`d_cl_list` AS `list`,
`d_no_cash` AS `no_cash`
WHERE
`list`.`id`=`no_cash`.`id_client`
$temp_sel_2
ORDER BY `no_cash`.`id` DESC
LIMIT 0,$limit
");
} // end id

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"privat_list\">
<input type=\"hidden\" name=\"finish\" value=\"$finish\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }

if ( $temp22 == 1 ) { print "<center><input type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.opener.location.reload(); window.close();\"></center>\n"; }
print "<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Дата-время<br>добавления</td><td align=\"center\">id_client</td><td align=\"center\">login</td><td align=\"center\">Дата-время<br>платежа</td><td align=\"center\">Плательщик</td><td align=\"center\">Назначение платежа</td><td align=\"center\">Сумма<br>в заявке</td><td align=\"center\">Дата-время<br>обработки (банк)</td><td align=\"center\">Сумма<br>обработки</td><td align=\"center\">Состояние</td><td align=\"center\">Действия</td></tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $id_client=$tmp['id_client'];
 $login=$tmp['login'];
 $pay_date=$tmp['pay_date'];
 $payer=$tmp['payer'];
 $pay_comment=$tmp['pay_comment'];
 $pay_summa=$tmp['pay_summa'];
 $date2=$tmp['date2'];
 $admin2=$tmp['admin2'];
 $admin_ip2=$tmp['admin_ip2'];
 $summa=$tmp['summa'];
 $fail=$tmp['fail'];
 print "<tr><form method=\"get\"><td>$id</td><td>$date "; res_info($id,$date,$admin,$admin_ip); print "</td><td>$id_client</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td><td>$pay_date</td><td>$payer</td><td>";
 if ( $fail == '2' or $fail == NULL ) { print "<img style=\"cursor:pointer;\" onclick=\"javascript:loadScript('load_s/ishop_pstatus.php?res=$id&order=$id'); var res = document.getElementById('result$id'); res.innerHTML='wait...';\" src=\"img/sync.png\" border=\"0\" title=\"Проверить\" />&nbsp;<span id=\"result$id\">$pay_comment</span>"; } else { print $pay_comment; }
 print "</td><td>$pay_summa</td><td>";
 if ( strlen($date2) > 0 ) { print "$date2 "; res_info($id,$date2,$admin2,$admin_ip2); }
 print '</td><td>';
 if ( $date2 == '' ) { print "<input type=\"text\" maxlength=\"10\" size=\"11\" name=\"summa\" value=\"$pay_summa\">"; }
 else { print $summa; }
 print '</td><td>';
 if ( $date2 == '' ) { print 'в процессе'; }
 else if ( $fail == '2' ) { print "<span class=\"clr_orange\">отменен</span>"; }
 else if ( $fail == '1' ) { print "<span class=\"clr_red\">отклонен</span>"; }
 else { print "<span class=\"clr_green\">проведен</span>"; }
 print '</td><td>';
 if ( $date2 == '' ) {
 	print "<input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"hidden\" name=\"id_client\" value=\"$id_client\"><input type=\"hidden\" name=\"cmd\" value=\"privat_add\"><input type=\"checkbox\" checked name=\"fail\" value=\"1\">отклонить<br><input type=\"submit\" value=\"обработать\">";
 }
 print "</td></form></tr>\n";
}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong><br>\n";

?>