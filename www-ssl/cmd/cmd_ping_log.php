<?php

if ( !isset($_GET['limit']) ) { $limit=400; } else { $limit=$_GET['limit']; }

if ( isset($_GET['id']) ) {
$temp22=1;
$id_client=$_GET['id'];
$res=mysql_query("
SELECT
`list`.`login`, `ping`.*
FROM
`d_cl_list` AS `list`,
`d_ping_loss` AS `ping`
WHERE
`list`.`id`=`ping`.`id_client`
AND `ping`.`id_client`='$id_client'
ORDER BY `ping`.`id` DESC
");
} else {
$temp22=0;
$res=mysql_query("
SELECT
`list`.`login`, `ping`.*
FROM
`d_cl_list` AS `list`,
`d_ping_loss` AS `ping`
WHERE
`list`.`id`=`ping`.`id_client`
ORDER BY `ping`.`id` DESC
LIMIT 0,$limit
");
}

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"ping_log\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }
print "1 - (ping -c 1000 -q -f -s 1400)<br>
2 - (ping -c 500 -q -f -s 50000)<br>
<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Дата</td><td align=\"center\">login</td><td align=\"center\">count</td><td align=\"center\">MAC</td><td align=\"center\">Статус</td><td align=\"center\">IP</td><td align=\"center\">Потеря 1 (%)</td><td align=\"center\">Потеря 2 (%)</td><td align=\"center\">Время 1 (мс)</td><td align=\"center\">Время 2 (мс)</td>".($temp22==0?'<td>?</td>':'')."</tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $id_client=$tmp['id_client'];
 $date=$tmp['date'];
 $login=$tmp['login'];
 $count=$tmp['count'];
 $mac=$tmp['mac'];
 $state=$tmp['state'];
 $ip=$tmp['ip'];
 $loss1=$tmp['loss1'];
 $loss2=$tmp['loss2'];
 $time1=$tmp['time1'];
 $time2=$tmp['time2'];
 if ( $loss1 > 0 ) { $tmpclass11='clr_red'; } else { $tmpclass11='clr_black'; }
 if ( $loss2 > 0 ) { $tmpclass12='clr_red'; } else { $tmpclass12='clr_black'; }
 if ( $state != 'on-line' ) { $loss1=''; $loss2=''; $time1=''; $time2=''; }
 if ( $state == 'on-line' ) { $tmpclass1='clr_green'; }
 if ( $state == 'off-line' ) { $tmpclass1='clr_red'; }
 if ( $state == 'no IP' ) { $tmpclass1='clr_orange'; }
 print "<tr><td>$id</td><td>$date</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td><td>$count</td><td>$mac</td><td><span class=\"$tmpclass1\">$state</span></td><td>$ip</td><td><span class=\"$tmpclass11\">$loss1</span></td><td><span class=\"$tmpclass12\">$loss2</span></td><td>$time1</td><td>$time2</td>";
 if ( $temp22 == 0 ) {
  print '<td>';
  popup_log1("cmd=ping_log&id=$id_client",'ping_log','Pinger Log',870,500);
  print '</td>';
 }
print "</tr>\n";
}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong><br>\n";

?>