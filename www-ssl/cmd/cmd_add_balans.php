<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res2=mysql_query("SELECT `login` FROM `d_cl_list` WHERE `id`='$id'");
while ( $tmp2=mysql_fetch_assoc($res2) ){
 $login=$tmp2['login'];
}

print "<center>id=$id <strong>$login</strong></center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"ins_balans\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<tr><td align=\"right\">Сумма</td><td><input autofocus tabindex=\"1\" type=\"text\" maxlength=\"10\" size=\"20\" name=\"summa\" /></td></tr>
<tr><td align=\"right\">Примечание</td><td><input tabindex=\"2\" type=\"text\" maxlength=\"200\" size=\"30\" name=\"comment\" value=\"пополнение счета\" /></td></tr>
<tr><td colspan=\"2\" align=\"center\">Провести по кассе&nbsp;<input tabindex=\"3\" checked type=\"checkbox\" name=\"cash\" value=\"1\" /></td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Пополнить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>