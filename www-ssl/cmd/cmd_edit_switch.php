<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res44=mysql_query("
SELECT
`sw_list`.`id_type`, `sw_list`.`name`, `sw_list`.`sup_id_street`, `sw_list`.`sup_house`, `sw_list`.`sup_room`, `sw_list`.`sup_id_type`, `sw_list`.`comment`
FROM
`d_sw_list` AS `sw_list`
WHERE
`sw_list`.`id`='$id'
");
while ( $tmp=mysql_fetch_assoc($res44) ){
 $id_type=$tmp['id_type'];
 $name=$tmp['name'];
 $sup_id_street=$tmp['sup_id_street'];
 $sup_house=$tmp['sup_house'];
 $sup_room=$tmp['sup_room'];
 $sup_id_type=$tmp['sup_id_type'];
 $comment=$tmp['comment'];
}

print "<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"save_switch\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<tr><td align=\"right\">Модель</td><td>"; sw_types(1,$id_type); print "</td></tr>
<tr><td align=\"right\">Имя</td><td><input tabindex=\"2\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"name\" value=\"$name\"></td></tr>
<tr><td colspan=\"2\" align=\"center\">Запитка</td></tr>
<tr><td align=\"right\">Улица</td><td>"; street_list_f(3,$sup_id_street); print "</td></tr>
<tr><td align=\"right\">Дом</td><td><input tabindex=\"4\" type=\"text\" maxlength=\"10\" size=\"12\" name=\"house\" value=\"$sup_house\"></td></tr>
<tr><td align=\"right\">Квартира</td><td><input tabindex=\"5\" type=\"text\" maxlength=\"10\" size=\"12\" name=\"room\" value=\"$sup_room\"></td></tr>
<tr><td align=\"right\">Тип</td><td>"; sup_types(6,$sup_id_type); print "</td></tr>
<tr><td align=\"right\">Комментарий</td><td><input tabindex=\"7\" type=\"text\" maxlength=\"200\" size=\"35\" name=\"comment\" value=\"$comment\"></td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Сохранить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "<br><center>ID не выбран</center>\n"; }
?>