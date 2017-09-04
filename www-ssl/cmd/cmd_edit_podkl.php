<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`,
`podkl`.`id` AS `id_podkl`, `podkl`.`date` AS `date_podkl`, `podkl`.`admin` AS `admin_podkl`, `podkl`.`admin_ip` AS `admin_ip_podkl`, `podkl`.`date_add`, `podkl`.`date_finish`, `podkl`.`cab_less`, `podkl`.`id_cab_type`, `podkl`.`id_people`, `podkl`.`comment`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`
WHERE
`podkl`.`id`='$id'
AND `list`.`id`=`podkl`.`id_client`
");
while ( $tmp=mysql_fetch_assoc($res) ){
  $id_list=$tmp['id_list'];
  $id_podkl=$tmp['id_podkl'];
  $date_podkl=$tmp['date_podkl'];
  $admin_podkl=$tmp['admin_podkl'];
  $admin_ip_podkl=$tmp['admin_ip_podkl'];
  $login=$tmp['login'];
  $date_add=$tmp['date_add'];
  $date_finish=$tmp['date_finish'];
  $cab_less=$tmp['cab_less'];
  $id_cab_type=$tmp['id_cab_type'];
  $id_people=$tmp['id_people'];
  $comment=$tmp['comment'];
}

print "<center>id=$id_list <strong>$login</strong> "; res_info($id_podkl,$date_podkl,$admin_podkl,$admin_ip_podkl); print "</center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"save_podkl\">
<input type=\"hidden\" name=\"id\" value=\"$id_podkl\">
<tr>
<td align=\"right\">Дата подачи</td><td><input type=\"text\" maxlength=\"10\" size=\"15\" name=\"date_add\" value=\"$date_add\" class=\"tcal\"></td>
<td rowspan=\"5\" valign=\"top\">"; people_cb($id_people); print "</td>
</tr>
<tr><td align=\"right\">Дата выполнения</td><td><input type=\"text\" maxlength=\"10\" size=\"15\" name=\"date_finish\" value=\"$date_finish\" class=\"tcal\"></td></tr>
<tr><td align=\"right\">Длина кабеля</td><td><input tabindex=\"1\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"cab_less\" value=\"$cab_less\"></td></tr>
<tr><td align=\"right\">Тип кабеля</td><td>"; cab_types(2,$id_cab_type); print "</td></tr>
<tr>
<td colspan=\"2\">Примечание<br><textarea class=\"textar1\" name=\"comment\" tabindex=\"3\" rows=\"5\">$comment</textarea></td>
</tr>
<tr>
<td colspan=\"3\" align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Сохранить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>