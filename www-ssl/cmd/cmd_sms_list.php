<?php

// body

if ( !isset($_GET['limit']) ) { $limit=200; } else { $limit=$_GET['limit']; }

if ( isset($_GET['id']) ) { // if id
$temp22=1;
$id_client=$_GET['id'];
$res=mysql_query("
SELECT
`list`.`login`,
`sms_log`.`id`, `sms_log`.`date`, `sms_log`.`admin`, `sms_log`.`admin_ip`, `sms_log`.`id_client`, `sms_log`.`locator`, `sms_log`.`req_status`, `sms_log`.`requestId`, `sms_log`.`st_date`, `sms_log`.`status`
FROM
`d_cl_list` AS `list`,
`d_sms_log` AS `sms_log`
WHERE
`list`.`id`=`sms_log`.`id_client`
AND `sms_log`.`id_client`='$id_client'
ORDER BY `sms_log`.`id` DESC
");
} else { // else id
$temp22=0;

$res=mysql_query("
SELECT
`list`.`login`,
`sms_log`.`id`, `sms_log`.`date`, `sms_log`.`admin`, `sms_log`.`admin_ip`, `sms_log`.`id_client`, `sms_log`.`locator`, `sms_log`.`req_status`, `sms_log`.`requestId`, `sms_log`.`st_date`, `sms_log`.`status`
FROM
`d_cl_list` AS `list`,
`d_sms_log` AS `sms_log`
WHERE
`list`.`id`=`sms_log`.`id_client`
ORDER BY `sms_log`.`id` DESC
LIMIT 0,$limit
");
} // end id

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }
$not_st=0;

if ($temp22==0) { print "<a href=\"?cmd=sms_status\">Проверка статусов сообщений</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href=\"?cmd=sms_st_clear\">Очистка статусов (PENDING, NO_MONEY)</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href=\"?cmd=sms_balans\">Проверка баланса</a><br><br>\n"; }
if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"sms_list\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }
print "<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Дата-время отправки</td><td align=\"center\">User - IP</td><td align=\"center\">id_client</td><td align=\"center\">login</td><td align=\"center\">locator</td><td align=\"center\">status</td><td align=\"center\">requestId</td><td align=\"center\">Дата-время проверки</td><td align=\"center\">Статус</td></tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $id_client=$tmp['id_client'];
 $login=$tmp['login'];
 $locator=$tmp['locator'];
 $req_status=$tmp['req_status'];
 $requestId=$tmp['requestId'];
 $st_date=$tmp['st_date'];
 $status=$tmp['status'];
 if ( $status == 'DELIVERED' ) { $st_color='#00AA00'; } else { $st_color='#FF0000'; }
 print "<tr><td>$id</td><td>$date</td><td>$admin - $admin_ip</td><td>$id_client</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td><td>$locator</td><td>$req_status</td><td>$requestId</td><td>$st_date</td><td><font color=\"$st_color\">$status</font></td></tr>\n";
 if ( empty($st_date) ) { $not_st++; }
}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong> - Не обработано: $not_st<br>\n";

?>