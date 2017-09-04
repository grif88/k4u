<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res=mysql_query("
SELECT
`list`.`id` AS `id_list`, `list`.`login`,
`data`.`id` AS `id_data`, `data`.`date` AS `date_data`, `data`.`admin` AS `admin_data`, `data`.`admin_ip` AS `admin_ip_data`, `data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`, `data`.`doc`, `data`.`doc_seriya`, `data`.`doc_number`, `data`.`doc_when`, `data`.`doc_bywho`, `data`.`date_dog`, `data`.`comment`, `data`.`sms_phone`
FROM
`d_cl_list` AS `list`,
`d_cl_data` AS `data`
WHERE
`data`.`id`='$id'
AND `list`.`id`=`data`.`id_client`
");
while ( $tmp=mysql_fetch_assoc($res) ){
  $id_list=$tmp['id_list'];
  $id_data=$tmp['id_data'];
  $date_data=$tmp['date_data'];
  $admin_data=$tmp['admin_data'];
  $admin_ip_data=$tmp['admin_ip_data'];
  $login=$tmp['login'];
  $surname=$tmp['surname'];
  $name=$tmp['name'];
  $secname=$tmp['secname'];
  $phone=$tmp['phone'];
  $doc=$tmp['doc'];
  $doc_seriya=$tmp['doc_seriya'];
  $doc_number=$tmp['doc_number'];
  $doc_when=$tmp['doc_when'];
  $doc_bywho=$tmp['doc_bywho'];
  $date_dog=$tmp['date_dog'];
  $comment=$tmp['comment'];
  $sms_phone=$tmp['sms_phone'];
  $dog_num='';
  while ( strlen($dog_num) != 6 ) { if ( !empty($dog_num) ) { $dog_num='0'.$dog_num; } else { $dog_num=$id_list; } }
}

print "<center>id=$id_list <strong>$login</strong> "; res_info($id_data,$date_data,$admin_data,$admin_ip_data); print "</center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"save_data\">
<input type=\"hidden\" name=\"id\" value=\"$id_data\">
<tr><td align=\"right\">Фамилия</td><td><input tabindex=\"1\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"surname\" value=\"$surname\"></td></tr>
<tr><td align=\"right\">Имя</td><td><input tabindex=\"2\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"name\" value=\"$name\"></td></tr>
<tr><td align=\"right\">Отчество</td><td><input tabindex=\"3\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"secname\" value=\"$secname\"></td></tr>
<tr><td align=\"right\">Телефон</td><td><input tabindex=\"4\" type=\"text\" maxlength=\"50\" size=\"32\" name=\"phone\" value=\"$phone\"></td></tr>
<tr><td align=\"right\">Комментарий</td><td><input tabindex=\"5\" type=\"text\" maxlength=\"200\" size=\"32\" name=\"comment\" value=\"$comment\"></td></tr>
<tr><td align=\"right\">Телефон для SMS</td><td><input tabindex=\"6\" type=\"text\" maxlength=\"12\" size=\"32\" pattern=\"380[0-9]{9}\" name=\"sms_phone\" value=\"$sms_phone\" title=\"формат: 380XXXXXXXXX\"></td></tr>
<tr><td align=\"right\">&nbsp;</td><td>&nbsp;</td></tr>
<tr><td align=\"right\">Документ</td><td><input tabindex=\"7\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"doc\" value=\"$doc\"></td></tr>
<tr><td align=\"right\">Серия</td><td><input tabindex=\"8\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"doc_seriya\" value=\"$doc_seriya\"></td></tr>
<tr><td align=\"right\">Номер</td><td><input tabindex=\"9\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"doc_number\" value=\"$doc_number\"></td></tr>
<tr><td align=\"right\">Когда выдан</td><td><input tabindex=\"10\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"doc_when\" value=\"$doc_when\" class=\"tcal\"></td></tr>
<tr><td align=\"right\">Кем выдан</td><td><input tabindex=\"11\" type=\"text\" maxlength=\"200\" size=\"32\" name=\"doc_bywho\" value=\"$doc_bywho\"></td></tr>
<tr><td align=\"right\">&nbsp;</td><td>&nbsp;</td></tr>
<tr><td align=\"right\">Договор №</td><td><input readonly type=\"text\" size=\"15\" value=\"$dog_num\"></td></tr>
<tr><td align=\"right\">Дата подписания</td><td><input tabindex=\"12\" type=\"text\" maxlength=\"10\" size=\"15\" name=\"date_dog\" value=\"$date_dog\" class=\"tcal\"></td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input tabindex=\"20\" type=\"submit\" value=\"Сохранить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"21\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>