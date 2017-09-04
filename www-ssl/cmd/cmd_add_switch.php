<?php

// body

print "<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"ins_switch\">
<tr><td align=\"right\">Модель</td><td>"; sw_types(1,0); print "</td></tr>
<tr><td align=\"right\">Имя</td><td><input tabindex=\"2\" type=\"text\" maxlength=\"30\" size=\"32\" name=\"name\"></td></tr>
<tr><td colspan=\"2\" align=\"center\">Запитка</td></tr>
<tr><td align=\"right\">Улица</td><td>"; street_list_f(3,0); print "</td></tr>
<tr><td align=\"right\">Дом</td><td><input tabindex=\"4\" type=\"text\" maxlength=\"10\" size=\"12\" name=\"house\"></td></tr>
<tr><td align=\"right\">Квартира</td><td><input tabindex=\"5\" type=\"text\" maxlength=\"10\" size=\"12\" name=\"room\"></td></tr>
<tr><td align=\"right\">Тип</td><td>"; sup_types(6,0); print "</td></tr>
<tr><td align=\"right\">Комментарий</td><td><input tabindex=\"7\" type=\"text\" maxlength=\"200\" size=\"35\" name=\"comment\"></td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Добавить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

?>