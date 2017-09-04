<?php
print "<script type=\"text/javascript\">
function enable_submit() {
 var inp_house=document.getElementById('inp_house').value;
 var inp_room=document.getElementById('inp_room').value;
 if ( inp_house != '' ) { document.getElementById('sp_house').innerText=''; } else { document.getElementById('sp_house').innerText='!!!'; }
 if ( inp_room != '' ) { document.getElementById('sp_room').innerText=''; } else { document.getElementById('sp_room').innerText='!!!'; }
 if ( inp_house != '' && inp_room != '' ) {
  document.getElementById('inp_submit').disabled=false;
 } else {
  document.getElementById('inp_submit').disabled=true;
 }
}
</script>\n";

print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"ins_abon\">
<tr height=\"30\">
<td align=\"right\">Фамилия</td>
<td align=\"left\"><input tabindex=\"1\" class=\"text_r\" type=\"text\" maxlength=\"30\" size=\"30\" name=\"surname\"></td>
<td rowspan=\"4\" width=\"20\">&nbsp;</td>
<td align=\"right\">Регион</td>
<td align=\"left\">"; region_list(5); print "</td>
<td rowspan=\"4\" width=\"20\">&nbsp;</td>
<td rowspan=\"3\">Комментарий<br><textarea tabindex=\"9\" rows=\"3\" cols=\"40\" name=\"comment\"></textarea></td>
</tr>
<tr height=\"30\">
<td align=\"right\">Имя</td>
<td align=\"left\"><input tabindex=\"2\" class=\"text_r\" type=\"text\" maxlength=\"30\" size=\"30\" name=\"name\"></td>
<td align=\"right\">Улица</td>
<td align=\"left\">"; street_list(6); print "</td>
</tr>
<tr height=\"30\">
<td align=\"right\">Отчество</td>
<td align=\"left\"><input tabindex=\"3\" class=\"text_r\" type=\"text\" maxlength=\"30\" size=\"30\" name=\"secname\"></td>
<td align=\"right\">Дом</td>
<td align=\"left\"><input id=\"inp_house\" onchange=\"enable_submit();\" tabindex=\"7\" class=\"text_r\" type=\"text\" maxlength=\"10\" size=\"10\" name=\"house\"><span id=\"sp_house\" class=\"clr_red\"></span></td>
</tr>
<tr height=\"30\">
<td align=\"right\">Телефон</td>
<td align=\"left\"><input tabindex=\"4\" class=\"text_r\" type=\"text\" maxlength=\"50\" size=\"30\" name=\"phone\"></td>
<td align=\"right\">Квартира</td>
<td align=\"left\"><input id=\"inp_room\" onchange=\"enable_submit();\" tabindex=\"8\" class=\"text_r\" type=\"text\" maxlength=\"10\" size=\"10\" name=\"room\"><span id=\"sp_room\" class=\"clr_red\"></span></td>
<td align=\"left\"><input id=\"inp_submit\" tabindex=\"10\" type=\"submit\" value=\"Добавить\"></td>
</tr>
</form>
</table>
<script type=\"text/javascript\">enable_submit();</script>\n";
?>