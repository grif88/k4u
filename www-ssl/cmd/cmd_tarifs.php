<?php

print "<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr align=\"center\" class=\"clr_back_grey\"><td>id</td><td>Тарифный план</td><td>Цена</td><td>Цена<br>понижения</td><td>s_upload<br>(Mbit/sec)</td><td>s_download<br>(Mbit/sec)</td><td>up_speed<br>(Mbit/sec)</td><td>open</td><td>next_id</td><td>poss</td><td colspan=\"3\">cmd</td></tr>\n";

$res=mysql_query("SELECT `id`,`poss`,`name`,`cost`,`cost_down`,`s_upload`,`s_download`,`up_speed`,`open`,`next_id`,`view` FROM `t_tarifs` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
 $id=$tmp['id'];
 $poss=$tmp['poss'];
 $name=$tmp['name'];
 $cost=$tmp['cost'];
 $cost_down=$tmp['cost_down'];
 $s_upload=$tmp['s_upload'];
 $s_download=$tmp['s_download'];
 $up_speed=$tmp['up_speed'];
 $open=$tmp['open'];
 $next_id=$tmp['next_id'];
 $view=$tmp['view'];
 if ( $view == 0 ) { $class='class="clr_back_red"'; } else { $class=''; }
 
print "<tr $class align=\"center\"><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"tarif_save\"><td><input type=\"hidden\" name=\"id\" value=\"$id\">$id</td><td><input type=\"text\" maxlength=\"30\" size=\"32\" name=\"name\" value=\"$name\"></td><td><input type=\"text\" maxlength=\"15\" size=\"17\" name=\"cost\" value=\"$cost\"></td><td><input type=\"text\" maxlength=\"3\" size=\"5\" name=\"cost_down\" value=\"$cost_down\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"s_upload\" value=\"$s_upload\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"s_download\" value=\"$s_download\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"up_speed\" value=\"$up_speed\"></td><td><input type=\"text\" maxlength=\"1\" size=\"3\" name=\"open\" value=\"$open\"></td><td><input type=\"text\" maxlength=\"11\" size=\"7\" name=\"next_id\" value=\"$next_id\"></td><td><input type=\"text\" maxlength=\"5\" size=\"7\" name=\"poss\" value=\"$poss\"></td><td><input type=\"submit\" value=\"save\"></td></form><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"tarif_del\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"del\"></td></form><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"tarif_apply\"><input type=\"hidden\" name=\"id\" value=\"$id\"><td><input type=\"submit\" value=\"apply\"></td></form></tr>\n";
 
}

print "<tr align=\"center\"><form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"tarif_add\"><td>auto</td><td><input type=\"text\" maxlength=\"30\" size=\"32\" name=\"name\"></td><td><input type=\"text\" maxlength=\"15\" size=\"17\" name=\"cost\"></td><td><input type=\"text\" maxlength=\"3\" size=\"5\" name=\"cost_down\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"s_upload\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"s_download\"></td><td><input type=\"text\" maxlength=\"10\" size=\"12\" name=\"up_speed\"></td><td><input type=\"text\" maxlength=\"1\" size=\"3\" name=\"open\"></td><td><input type=\"text\" maxlength=\"11\" size=\"7\" name=\"next_id\" value=\"0\"></td><td><input type=\"text\" maxlength=\"5\" size=\"7\" name=\"poss\"></td><td colspan=\"3\"><input type=\"submit\" value=\"add\"></td></form></tr>\n";

print "</table>\n";

?>