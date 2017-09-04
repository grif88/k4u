<?php

// access
$res2=mysql_query("SELECT `view_log-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['view_log-adm'];
 }
}

if ( !isset($_GET['limit']) ) { $limit=200; } else { $limit=$_GET['limit']; }

if ( isset($_GET['id']) ) { // id
$temp22=1;
$id_client=$_GET['id'];

if ( $access2 == 1 ) { // access
$res=mysql_query("
SELECT
`list`.`login`,
`view_log`.`id`, `view_log`.`date`, `view_log`.`admin`, `view_log`.`admin_ip`, `view_log`.`id_client`, `view_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_view_log` AS `view_log`
WHERE
`list`.`id`=`view_log`.`id_client`
AND `view_log`.`id_client`='$id_client'
ORDER BY `view_log`.`id` DESC
");
} else { // access
$res=mysql_query("
SELECT
`list`.`login`,
`view_log`.`id`, `view_log`.`date`, `view_log`.`admin`, `view_log`.`admin_ip`, `view_log`.`id_client`, `view_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_view_log` AS `view_log`
WHERE
`list`.`id`=`view_log`.`id_client`
AND `view_log`.`id_client`='$id_client'
AND `view_log`.`admin`='$php_user'
ORDER BY `view_log`.`id` DESC
");
} // access
} else { // id
$temp22=0;
if ( $access2 == 1 ) { // access
$res=mysql_query("
SELECT
`list`.`login`,
`view_log`.`id`, `view_log`.`date`, `view_log`.`admin`, `view_log`.`admin_ip`, `view_log`.`id_client`, `view_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_view_log` AS `view_log`
WHERE
`list`.`id`=`view_log`.`id_client`
ORDER BY `view_log`.`id` DESC
LIMIT 0,$limit
");
} else { // access
$res=mysql_query("
SELECT
`list`.`login`,
`view_log`.`id`, `view_log`.`date`, `view_log`.`admin`, `view_log`.`admin_ip`, `view_log`.`id_client`, `view_log`.`browser`
FROM
`d_cl_list` AS `list`,
`d_cl_view_log` AS `view_log`
WHERE
`list`.`id`=`view_log`.`id_client`
AND `view_log`.`admin`='$php_user'
ORDER BY `view_log`.`id` DESC
LIMIT 0,$limit
");
} // access
} // id

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"view_log\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }
print "<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Дата-время</td><td align=\"center\">Админ</td><td align=\"center\">IP админа</td><td align=\"center\">id_client</td><td align=\"center\">login</td><td align=\"center\">Браузер</td></tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $id_client=$tmp['id_client'];
 $browser=$tmp['browser'];
 $login=$tmp['login'];
 print "<tr><td>$id</td><td>$date</td><td>$admin</td><td>$admin_ip</td><td>$id_client</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td><td>$browser</td></tr>\n";

}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong><br>\n";

?>