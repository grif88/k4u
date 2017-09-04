<?php

print "<table cellspacing=\"0\" cellpadding=\"1\" border=\"1\">
<tr align=\"center\"><td><strong>id</strong></td>
<td><strong>День</strong></td>
<td><strong>Месяц</strong></td>
<td><strong>Название</strong></td>
<td><strong>Картинка</strong></td>
<td><strong>Ссылка</strong></td>
<td><strong>Показы</strong></td>
<td><strong>Клики</strong></td>
<td colspan=\"3\"><strong>cmd</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `d_holiday` ORDER BY `month`, `day`");
$rows1=mysql_num_rows($res);
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$day=$tmp['day'];
	$month=$tmp['month'];
	$title=$tmp['title'];
	$img=$tmp['img'];
	$source=$tmp['source'];
	$shows=$tmp['shows'];
	$count=$tmp['count'];
 
	print "<tr class=\"table1\"><form enctype=\"multipart/form-data\" method=\"post\"><input type=\"hidden\" name=\"cmd\" value=\"holiday_change\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><a href=\"/?show=holiday&id=$id\" target=\"_blank\">$id</a></td><td align=\"center\"><input required type=\"text\" size=\"2\" maxlength=\"2\" name=\"day\" value=\"$day\"></td><td align=\"center\"><input required type=\"text\" size=\"2\" maxlength=\"2\" name=\"month\" value=\"$month\"></td><td><input required type=\"text\" size=\"50\" maxlength=\"100\" name=\"title\" value=\"$title\"></td><td><input required name=\"img1\" type=\"file\" size=\"20\" title=\"формат: 400x400, размер: 500KB\"><br><a href=\"/img2/holiday/$img\" target=\"_blank\">$img</a></td><td><input required type=\"text\" size=\"70\" maxlength=\"250\" name=\"source\" value=\"$source\"><br><a href=\"$source\" target=\"_blank\">перейти</a></td><td>$shows</td><td>$count</td><td><input type=\"submit\" value=\"сохранить\"></td></form><form onSubmit=\"javascript:if(confirm('Удалить праздник id=$id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"holiday_rem\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"удалить\"></td></form><form onSubmit=\"javascript:if(confirm('Обнулить показатели id=$id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"holiday_clear\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"обнулить\"></td></form></tr>\n";
}

print "<tr class=\"table1\"><form enctype=\"multipart/form-data\" method=\"post\"><input type=\"hidden\" name=\"cmd\" value=\"holiday_add\"><td>auto</td><td align=\"center\"><input required type=\"text\" size=\"2\" maxlength=\"2\" name=\"day\" value=\"00\"></td><td align=\"center\"><input required type=\"text\" size=\"2\" maxlength=\"2\" name=\"month\" value=\"00\"></td><td><input required type=\"text\" size=\"50\" maxlength=\"100\" name=\"title\"></td><td><input required name=\"img1\" type=\"file\" size=\"20\" title=\"формат: 400x400, размер: 500KB\"></td><td><input required type=\"text\" size=\"70\" maxlength=\"250\" name=\"source\"></td><td>0</td><td>0</td><td colspan=\"3\" align=\"center\"><input type=\"submit\" value=\"добавить\"></td></form></tr>\n";

print "</table><br>
Всего: $rows1\n";
?>