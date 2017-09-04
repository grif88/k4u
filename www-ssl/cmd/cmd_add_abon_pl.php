<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res2=mysql_query("SELECT `login` FROM `d_cl_list` WHERE `id`='$id'");
while ( $tmp2=mysql_fetch_assoc($res2) ){
 $login=$tmp2['login'];
}

$res7=mysql_query("SELECT `id_tarif`,`year`,`month` FROM `d_cl_tarif_log` WHERE `id_client`='$id' ORDER BY `year` DESC,`month` DESC LIMIT 0,1");
$num_rows7=mysql_num_rows($res7);
if ( $num_rows7 != 0 ) {
while ( $tmp7=mysql_fetch_assoc($res7) ){
 $id_tarif_last=$tmp7['id_tarif'];
 $year_last=$tmp7['year'];
 $month_last=$tmp7['month'];
 if ( $month_last == '12' ) { $month_next='01'; $year_next=$year_last+1; } else {
  $month_next2=$month_last+1;
  $year_next=$year_last;
  if ( $month_next2 <= 9 ) { $month_next='0'.$month_next2; } else { $month_next=$month_next2; }
 }
}
} else {
 $id_tarif_last=0;
 $year_next=$php_date_y;
 $month_next=$php_date_m;
}

print "<center>id=$id <strong>$login</strong></center>
<table cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" border=\"0\">
<form method=\"get\">
<input type=\"hidden\" name=\"win\" value=\"\">
<input type=\"hidden\" name=\"cmd\" value=\"ins_abon_pl\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<tr><td align=\"right\">Тариф</td><td><input type=\"hidden\" name=\"id_tarif_old\" value=\"$id_tarif_last\">"; tarifs_sel($id_tarif_last); print "</td></tr>
<tr><td align=\"right\">Дата</td><td>"; year_sel($year_next); month_sel($month_next); print "</td></tr>
<tr><td>&nbsp;</td><td><br><input id=\"except\" type=\"checkbox\" name=\"exception\" value=\"1\" />&nbsp;<span style=\"color:#0000FF;cursor:pointer;\" onClick=\"javascript:if(document.getElementById('except').checked){document.getElementById('except').checked=false;}else{document.getElementById('except').checked=true;}\">Исключение</span></td></tr>
<tr id=\"summ1\"><td align=\"right\">Сумма</td><td><input type=\"text\" maxlength=\"10\" size=\"20\" name=\"summa\" /></td></tr>
<tr id=\"comm1\"><td align=\"right\">Комментарий</td><td><input type=\"text\" maxlength=\"200\" size=\"30\" name=\"comment\" /></td></tr>
<tr>
<td colspan=\"2\" align=\"center\">
<input autofocus tabindex=\"1\" type=\"submit\" value=\"Активировать\">&nbsp;&nbsp;&nbsp;
<input tabindex=\"11\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</td>
</tr>
</form>
</table>\n";

} // if id end
else { print "ID не выбран<br>\n"; }
?>