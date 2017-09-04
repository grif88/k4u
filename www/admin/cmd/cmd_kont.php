<?php

$res=mysql_query("SELECT `text` FROM `kont` WHERE `id`='1'");
while ( $tmp=mysql_fetch_assoc($res) ){
  $text=$tmp['text'];
}

print "<form method=\"post\">
<textarea rows=\"30\" cols=\"100\" name=\"text1\">$text</textarea>
<br><br>
<input type=\"hidden\" value=\"save_kont\" name=\"cmd\">
<input type=\"submit\" value=\"save\">
</form>\n";

?>