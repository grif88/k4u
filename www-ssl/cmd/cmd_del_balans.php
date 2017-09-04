<?php

// body

print "<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"remove_balans\">
<tr><td align=\"center\"><input type=\"text\" name=\"id\" maxlength=\"11\" size=\"20\"></td></tr>
<tr>
<td align=\"center\">
<input tabindex=\"10\" type=\"submit\" value=\"Удалить\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

?>