<?php

$id=$_GET['id'];
$id_client=$_GET['id_client'];
$summa=$_GET['summa'];
if ( !isset($_GET['fail']) or $_GET['fail'] == '' ) { $fail=0; } else { $fail=$_GET['fail']; }

// insert

mysql_query("UPDATE `d_no_cash` SET `pay_date`='$php_date',`date2`='$php_date',`admin2`='$php_user',`admin_ip2`='$php_user_ip',`summa`='$summa',`fail`='$fail' WHERE `id`='$id'");

if ( $fail == 0 ) {
mysql_query("INSERT INTO `d_cl_balans_log` (`date`,`admin`,`admin_ip`,`id_client`,`summa`,`id_kassa`,`cash`,`comment`,`kassa_date`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$summa','6','1','пополнение через Приват CARD','$php_kassa_date')");
ch_balans($id_client,$summa);
}

/*if ( $fail == '1' ) { $stat1="<span class=\"clr_red\">отклонен</span>"; }
else { $stat1="<span class=\"clr_green\">проведен</span>"; }
print "Операция проведена<br>
Сумма: $summa грн<br>
Состояние: $stat1<br>
<input type=\"button\" value=\"К списку\" onclick=\"javascript:location.replace(\"$php_refer\");\"><br>\n";*/

/*print "<script type=\"text/javascript\">window.opener.location.reload();</script>\n";*/
print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";

?>