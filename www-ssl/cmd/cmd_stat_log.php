<?php

if ( !isset($_GET['limit']) ) { $limit=100; } else { $limit=$_GET['limit']; }

if ( isset($_GET['id']) ) {
$temp22=1;
$id_client=$_GET['id'];
$res=mysql_query("
SELECT
`list`.`login`,
`stat_log`.`id`, `stat_log`.`id_session`, `stat_log`.`date_start`, `stat_log`.`date_end`, `stat_log`.`client_ip`, `stat_log`.`id_client`, `stat_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_stat_log` AS `stat_log`
WHERE
`list`.`id`=`stat_log`.`id_client`
AND `stat_log`.`id_client`='$id_client'
ORDER BY `stat_log`.`id` DESC
");
} else {
$temp22=0;
$res=mysql_query("
SELECT
`list`.`login`,
`stat_log`.`id`, `stat_log`.`id_session`, `stat_log`.`date_start`, `stat_log`.`date_end`, `stat_log`.`client_ip`, `stat_log`.`id_client`, `stat_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_stat_log` AS `stat_log`
WHERE
`list`.`id`=`stat_log`.`id_client`
ORDER BY `stat_log`.`id` DESC
LIMIT 0,$limit
");
}

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"stat_log\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }
print "<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">id сессии</td><td align=\"center\">Дата-время начала</td><td align=\"center\">Дата-время окончания</td><td align=\"center\">IP клиента</td><td align=\"center\">Браузер</td><td align=\"center\">id_client</td><td align=\"center\">login</td></tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $id_session=$tmp['id_session'];
 $date_start=$tmp['date_start'];
 $date_end=$tmp['date_end'];
 $client_ip=$tmp['client_ip'];
 $id_client=$tmp['id_client'];
 $browser=$tmp['browser'];
 $login=$tmp['login'];
 print "<tr><td>$id</td><td>$id_session</td><td>$date_start</td><td>$date_end</td><td>$client_ip</td><td>$browser</td><td>$id_client</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td></tr>\n";
}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong><br>\n";

?>