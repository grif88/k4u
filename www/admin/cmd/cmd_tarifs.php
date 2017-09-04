<?php

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тарифные планы</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>id</strong></td>
<td><strong>Тарифный план</strong></td>
<td><strong>Абонплата<br>(грн)</strong></td>
<td><strong>Скорость доступа<br>к интернету</strong></td>
<td><strong>Скорость доступа<br>к локальным ресурсам</strong></td>
<td><strong>Срок действия</strong></td>
<td><strong>Акция</strong></td>
<td><strong>poss</strong></td>
<td><strong>Save</strong></td>
<td><strong>Delete</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `tarifs` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$name=$tmp['name'];
	$abon=$tmp['abon'];
	$speed=$tmp['speed'];
	$local=$tmp['local'];
	$srok=$tmp['srok'];
	$akcia=$tmp['akcia'];
	$poss=$tmp['poss'];
 
	print "<tr align=\"center\"><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"change_tarif\"><td><input type=\"hidden\" name=\"id\" value=\"$id\">$id</td><td><input required type=\"text\" size=\"15\" name=\"name\" value=\"$name\"></td><td><input required type=\"text\" size=\"15\" name=\"abon\" value=\"$abon\"></td><td><input required type=\"text\" size=\"15\" name=\"speed\" value=\"$speed\"></td><td><input required type=\"text\" size=\"15\" name=\"local\" value=\"$local\"></td><td><input required type=\"text\" size=\"15\" name=\"srok\" value=\"$srok\"></td><td><input required type=\"text\" size=\"3\" name=\"akcia\" value=\"$akcia\"></td><td><input required type=\"text\" size=\"4\" name=\"poss\" value=\"$poss\"></td><td><input type=\"submit\" value=\"save\"></td></form><form onSubmit=\"javascript:if(confirm('Удалить тариф id=$id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"del_tarif\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"delete\"></td></form></tr>\n";
}

print "<tr align=\"center\"><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"add_tarif\"><td>auto</td><td><input required type=\"text\" size=\"15\" name=\"name\"></td><td><input required type=\"text\" size=\"15\" name=\"abon\"></td><td><input required type=\"text\" size=\"15\" name=\"speed\"></td><td><input required type=\"text\" size=\"15\" name=\"local\"></td><td><input required type=\"text\" size=\"15\" name=\"srok\"></td><td><input required type=\"text\" size=\"3\" name=\"akcia\"></td><td><input required type=\"text\" size=\"4\" name=\"poss\"></td><td colspan=\"2\"><input type=\"submit\" value=\"add\"></td></form></tr>\n";

print "</table><br>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дополнительные услуги</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>id</strong></td>
<td><strong>Наименование услуги</strong></td>
<td><strong>Стоимость</strong></td>
<td><strong>poss</strong></td>
<td><strong>Save</strong></td>
<td><strong>Delete</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `uslugi` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
	$usluga=$tmp['usluga'];
	$cost=$tmp['cost'];
	$poss=$tmp['poss'];
 
	print "<tr><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"change_usluga\"><td align=\"center\"><input type=\"hidden\" name=\"id\" value=\"$id\">$id</td><td><input required type=\"text\" size=\"70\" name=\"usluga\" value=\"$usluga\"></td><td><input required type=\"text\" size=\"20\" name=\"cost\" value=\"$cost\"></td><td><input required type=\"text\" size=\"4\" name=\"poss\" value=\"$poss\"></td><td><input type=\"submit\" value=\"save\"></td></form><form onSubmit=\"javascript:if(confirm('Удалить услугу id=$id?')){return true;}else{return false;}\" method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"del_usluga\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"delete\"></td></form></tr>\n";
}

print "<tr><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"add_usluga\"><td>auto</td><td><input required type=\"text\" size=\"70\" name=\"usluga\"></td><td><input required type=\"text\" size=\"20\" name=\"cost\"></td><td><input required type=\"text\" size=\"4\" name=\"poss\"></td><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"add\"></td></form></tr>\n";

print "</table><br>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Договор</strong><br><br>
<form enctype=\"multipart/form-data\" method=\"post\">
<input type=\"hidden\" name=\"cmd\" value=\"upload_file_d\">
<input required name=\"file_d\" type=\"file\" size=\"70\">
<input type=\"submit\" value=\"upload\">
</form>\n";

?>