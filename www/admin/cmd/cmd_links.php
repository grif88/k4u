<?php
print "<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>id</strong></td><td><strong>ссылка</strong></td><td><strong>коментарий</strong></td><td><strong>img</strong></td><td><strong>poss</strong></td><td><strong>Save</strong></td><td><strong>Delete</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `links` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$link=$tmp['link'];
	$comment=$tmp['comment'];
	$poss=$tmp['poss'];

	print "<tr><form enctype=\"multipart/form-data\" method=\"post\"><input type=\"hidden\" name=\"cmd\" value=\"change_link\"><td align=\"center\"><input type=\"hidden\" name=\"id\" value=\"$id\">$id</td><td><input required type=\"text\" size=\"30\" name=\"link\" value=\"$link\"></td><td><input required type=\"text\" size=\"40\" name=\"comment\" value=\"$comment\"></td><td><input name=\"img1\" type=\"file\" size=\"20\"></td><td><input required type=\"text\" size=\"4\" name=\"poss\" value=\"$poss\"></td><td><input type=\"submit\" value=\"save\"></td></form><form onSubmit=\"javascript:if(confirm('Удалить ссылку id=$id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"del_link\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"delete\"></td></form></tr>\n";
}

print "<tr><form enctype=\"multipart/form-data\" method=\"post\"><input type=\"hidden\" name=\"cmd\" value=\"add_link\"><td>auto</td><td><input required type=\"text\" size=\"30\" name=\"link\"></td><td><input required type=\"text\" size=\"40\" name=\"comment\"></td><td><input required name=\"img1\" type=\"file\" size=\"20\"><td><input required type=\"text\" size=\"4\" name=\"poss\"></td></td><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"add\"></td></form></tr>\n";

print "</table>\n";
?>