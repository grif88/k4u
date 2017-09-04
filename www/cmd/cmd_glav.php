<?php
$res=mysql_query("SELECT * FROM `news` WHERE `glav`='1' ORDER BY `id` DESC");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$name=$tmp['name'];
	$date=$tmp['date'];
	$text=$tmp['text'];
	print "<span class=\"tema1\">$name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?cmd=news&id=$id\">Подробнее...</a><br><span class=\"date1\">$date</span><br><hr><br>\n";
}

print "<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
<tr align=\"center\" valign=\"middle\" height=\"150\">\n";
$i0=0;
$res=mysql_query("SELECT * FROM `links` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$link=$tmp['link'];
	$img='img2/'.$id.'.png';
	$comment=$tmp['comment'];
	if ( $i0 == 3 ) { print "</tr>\n<tr align=\"center\" valign=\"middle\" height=\"150\">\n"; $i0=0; }
	$i0++;
	print "<td class=\"bg-links1\" width=\"33%\" onmouseover=\"javascript:this.className='bg-links2';\" onmouseout=\"javascript:this.className='bg-links1';\"><span class=\"comment1\">$comment</span><br><a href=\"$link\" target=\"_blank\"><img src=\"$img\" border=\"0\"><br>$link</a></td>\n";
}
if ( $i0 != 0 ) { print "</tr>\n"; }
print "</table>\n";
?>