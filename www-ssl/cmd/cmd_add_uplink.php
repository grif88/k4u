<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin
$type=$_GET['type'];

// body

print "<center>id=$id</center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"ins_uplink\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<input type=\"hidden\" name=\"type\" value=\"$type\">
<tr><td align=\"center\">"; sw_list(1); print "</td></tr>
<tr>
<td align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Добавить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "<br><center>ID не выбран</center>\n"; }
?>