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
<input type=\"hidden\" name=\"cmd\" value=\"ins_otkl\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<tr><td>Причина<br><textarea class=\"textar2\" name=\"reason\" tabindex=\"1\" rows=\"5\"></textarea></td></tr>
<tr>
<td align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Добавить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>