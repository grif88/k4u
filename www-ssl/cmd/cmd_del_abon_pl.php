<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

print "<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"remove_abon_pl\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<tr><td align=\"center\">Вы точно хотите удалить запись № $id</td></tr>
<tr>
<td align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Да\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Нет\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>