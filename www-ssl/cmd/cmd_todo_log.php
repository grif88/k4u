<?php

// body

if ( isset($_GET['id']) ) { // if id
$temp22=1;
$id_client=$_GET['id'];
$res=mysql_query("
SELECT
`list`.`login`,
`todo_list`.`id`, `todo_list`.`date`, `todo_list`.`admin`, `todo_list`.`admin_ip`, `todo_list`.`id_client`, `todo_list`.`action`, `todo_list`.`name`, `todo_list`.`active`, `todo_list`.`speed`, `todo_list`.`passwd`, `todo_list`.`cl_ip`, `todo_list`.`cl_mac`, `todo_list`.`done`, `todo_list`.`done_date`
FROM
`d_cl_list` AS `list`,
`d_todo_list` AS `todo_list`
WHERE
`list`.`id`=`todo_list`.`id_client`
AND `todo_list`.`id_client`='$id_client'
ORDER BY `todo_list`.`id` DESC
");
} else { // else id
$temp22=0;

// input

if ( !isset($_GET['limit']) ) { $limit=500; } else { $limit=$_GET['limit']; }
if ( isset($_GET['finish']) ) { $finish=$_GET['finish']; } else { $finish=0; }

// head

print "<a href=\"?cmd=todo_log&limit=$limit\">&lt;открытые&gt;</a>&nbsp;
<a href=\"?cmd=todo_log&finish=1&limit=$limit\">&lt;закрытые&gt;</a>&nbsp;
<a href=\"?cmd=todo_log&finish=2&limit=$limit\">&lt;все&gt;</a><br>
<br>\n";

if ( $finish == 0 ) { $temp_sel_2="AND `todo_list`.`done`='0'"; }
if ( $finish == 1 ) { $temp_sel_2="AND `todo_list`.`done`='1'"; }
if ( $finish == 2 ) { $temp_sel_2=""; }

$res=mysql_query("
SELECT
`list`.`login`,
`todo_list`.`id`, `todo_list`.`date`, `todo_list`.`admin`, `todo_list`.`admin_ip`, `todo_list`.`id_client`, `todo_list`.`action`, `todo_list`.`name`, `todo_list`.`active`, `todo_list`.`speed`, `todo_list`.`passwd`, `todo_list`.`cl_ip`, `todo_list`.`cl_mac`, `todo_list`.`done`, `todo_list`.`done_date`
FROM
`d_cl_list` AS `list`,
`d_todo_list` AS `todo_list`
WHERE
`list`.`id`=`todo_list`.`id_client`
$temp_sel_2
ORDER BY `todo_list`.`id` DESC
LIMIT 0,$limit
");
} // end id

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

if ($temp22==0) { print "<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"todo_log\">
<input type=\"hidden\" name=\"finish\" value=\"$finish\">
LIMIT:&nbsp;<input type=\"text\" maxlength=\"4\" size=\"6\" name=\"limit\" value=\"$limit\">&nbsp;
<input type=\"submit\" value=\"OK\"></form>\n"; }
print "<table class=\"table2-lit\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">id</td><td align=\"center\">Дата-время добавления</td><td align=\"center\">User - IP</td><td align=\"center\">id_client</td><td align=\"center\">login</td><td align=\"center\">Действие</td><td align=\"center\">Имя записи</td><td align=\"center\">active</td><td align=\"center\">speed (Tx/Rx)</td><td align=\"center\">passwd</td><td align=\"center\">cl_ip</td><td align=\"center\">cl_mac</td><td align=\"center\">Выполнено</td><td align=\"center\">Дата-время выполнения</td></tr>\n";

if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $id_client=$tmp['id_client'];
 $login=$tmp['login'];
 $action=$tmp['action'];
 $name=$tmp['name'];
 $active=$tmp['active'];
 $speed=$tmp['speed'];
 $passwd=$tmp['passwd'];
 $cl_ip=$tmp['cl_ip'];
 $cl_mac=$tmp['cl_mac'];
 $done=$tmp['done'];
 $done_date=$tmp['done_date'];
 print "<tr><td>$id</td><td>$date</td><td>$admin - $admin_ip</td><td>$id_client</td><td>";
 if ($temp22==0) { print "<a href=\"?cmd=view_abon&id=$id_client\">$login</a>"; } else { print "<strong>$login</strong>"; }
 print "</td><td>$action</td><td>$name</td><td>$active</td><td>$speed</td><td>$passwd</td><td>$cl_ip</td><td>$cl_mac</td><td>$done</td><td>$done_date</td></tr>\n";
}
} // if

print "</table><br>
<strong>Всего: $res_rows</strong><br>\n";

?>