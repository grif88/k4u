<?php
$res=mysql_query("SELECT `text` FROM `kont` WHERE `id`='1'");
while ( $tmp=mysql_fetch_assoc($res) ){
	$text=$tmp['text'];
}
print "<div align=\"justify\">$text</div>\n";
?>