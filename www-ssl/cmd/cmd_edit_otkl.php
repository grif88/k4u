<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`,
`otkl`.`id` AS `id_otkl`, `otkl`.`date` AS `date_otkl`, `otkl`.`admin` AS `admin_otkl`, `otkl`.`admin_ip` AS `admin_ip_otkl`, `otkl`.`reason`, `otkl`.`date_add`, `otkl`.`date_finish`, `otkl`.`id_people`, `otkl`.`comment`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`
WHERE
`otkl`.`id`='$id'
AND `list`.`id`=`otkl`.`id_client`
");
while ( $tmp=mysql_fetch_assoc($res) ){
  $id_list=$tmp['id_list'];
  $id_otkl=$tmp['id_otkl'];
  $date_otkl=$tmp['date_otkl'];
  $admin_otkl=$tmp['admin_otkl'];
  $admin_ip_otkl=$tmp['admin_ip_otkl'];
  $login=$tmp['login'];
  $reason=$tmp['reason'];
  $date_add=$tmp['date_add'];
  $date_finish=$tmp['date_finish'];
  $id_people=$tmp['id_people'];
  $comment=$tmp['comment'];
}

print "<center>id=$id_list <strong>$login</strong> "; res_info($id_otkl,$date_otkl,$admin_otkl,$admin_ip_otkl); print "</center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"save_otkl\">
<input type=\"hidden\" name=\"id\" value=\"$id_otkl\">
<tr>
<td align=\"right\">Дата подачи</td><td><input type=\"text\" maxlength=\"10\" size=\"15\" name=\"date_add\" value=\"$date_add\" class=\"tcal\"></td>
<td rowspan=\"4\" valign=\"top\">"; people_cb($id_people); print "</td>
</tr>
<tr><td align=\"right\">Дата выполнения</td><td><input type=\"text\" maxlength=\"10\" size=\"15\" name=\"date_finish\" value=\"$date_finish\" class=\"tcal\"></td></tr>
<tr>
<td colspan=\"2\">Причина<br><textarea class=\"textar1\" name=\"reason\" tabindex=\"1\" rows=\"5\">$reason</textarea></td>
</tr>
<tr>
<td colspan=\"2\">Примечание<br><textarea class=\"textar1\" name=\"comment\" tabindex=\"2\" rows=\"5\">$comment</textarea></td>
</tr>
<tr>
<td align=\"center\"><input tabindex=\"20\" type=\"submit\" value=\"Сохранить\"></td></form>
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"del_otkl\">
<input type=\"hidden\" name=\"id\" value=\"$id_otkl\">
<td align=\"center\"><input tabindex=\"21\" type=\"submit\" value=\"Удалить\"></td></form>
<td align=\"center\"><input tabindex=\"22\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\"></td>
</tr>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>