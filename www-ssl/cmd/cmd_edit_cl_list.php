<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`date` AS `date_list`, `list`.`admin` AS `admin_list`, `list`.`admin_ip` AS `admin_ip_list`, `list`.`login`, `list`.`passwd`, `list`.`cl_ip`, `list`.`cl_mac`, `list`.`id_type`
FROM
`d_cl_list` AS `list`
WHERE
`list`.`id`='$id'
");
while ( $tmp=mysql_fetch_assoc($res) ){
  $id_list=$tmp['id_list'];
  $date_list=$tmp['date_list'];
  $admin_list=$tmp['admin_list'];
  $admin_ip_list=$tmp['admin_ip_list'];
  $login=$tmp['login'];
  $passwd=$tmp['passwd'];
  $cl_ip=$tmp['cl_ip'];
  $cl_mac=$tmp['cl_mac'];
  $id_type=$tmp['id_type'];
}

print "<center>id=$id_list <strong>$login</strong> "; res_info($id_list,$date_list,$admin_list,$admin_ip_list); print "</center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"save_cl_list\">
<input type=\"hidden\" name=\"id\" value=\"$id_list\">
<input type=\"hidden\" name=\"login_old\" value=\"$login\">
<tr><td align=\"right\">login</td><td><input tabindex=\"1\" type=\"text\" maxlength=\"40\" size=\"32\" name=\"login\" value=\"$login\"></td></tr>
<tr><td align=\"right\">passwd</td><td><input tabindex=\"2\" type=\"text\" maxlength=\"40\" size=\"32\" name=\"passwd\" value=\"$passwd\"></td></tr>
<tr><td align=\"right\">cl_ip</td><td><input tabindex=\"3\" type=\"text\" maxlength=\"15\" size=\"17\" name=\"cl_ip\" value=\"$cl_ip\">&nbsp;
<img src=\"img/key.png\" border=\"0\" title=\"Add secret\" onclick=\"loadScript('load_s/secret_add.php?id=$id');\" />&nbsp;
<img src=\"img/erase.png\" border=\"0\" title=\"Rem secret\" onclick=\"loadScript('load_s/secret_rem.php?id=$id');\" />&nbsp;
<img src=\"img/drop_ses.png\" border=\"0\" title=\"Drop session\" onclick=\"loadScript('load_s/drop_session.php?id=$id');\" /></td></tr>
<tr><td align=\"right\">cl_mac</td><td><input id=\"f_mac\" tabindex=\"4\" type=\"text\" maxlength=\"17\" size=\"19\" name=\"cl_mac\" value=\"$cl_mac\">&nbsp;<img src=\"img/unlock.png\" border=\"0\" title=\"Unlock MAC\" onclick=\"loadScript('load_s/unlock_mac.php?id=$id');\" /></td></tr>
<tr><td align=\"right\">cl_type (zero)</td><td>"; cl_types(5,$id_type); print "&nbsp;<span id=\"result\"></span></td></tr>
<tr><td align=\"right\"><input type=\"checkbox\" name=\"upload\" value=\"1\"></td><td>Выгрузить на сервер</td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input tabindex=\"20\" type=\"submit\" value=\"Сохранить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"21\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.opener.location.reload(); window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>