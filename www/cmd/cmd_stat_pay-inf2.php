<?php
print "Абонентская плата за интернет с 1.06.2011 принимаеться в офисе по адресу ул. Мусоргского д. 13. Здание бывшего магазина &quot;Колос&quot;, офис находиться между кафе &quot;Згадай минуле&quot; и &quot;Секонд Хенд&quot;. Синяя вывеска &quot;Рейнфорд Электроникс&quot;, сервисный центр Рейнфорд.<br>
<br>
<span class=\"kont1\">Время работы:</span> С Понедельника по Пятницу 9:00 - 18:00. Суббота, Воскресенье - выходной.<br>
<br>
К разделу <a href=\"?cmd=kont\" target=\"_self\">Контакты</a>.<br>
<br><hr><br>
<center><span class=\"title2\">Оплата OnLine</span></center><br>\n";

$id_client=$_SESSION['cl_id'];
$res33=mysql_query("
SELECT
`no_cash`.`id`, `no_cash`.`pay_date`, `no_cash`.`payer`, `no_cash`.`pay_comment`, `no_cash`.`pay_summa`
FROM
`d_no_cash` AS `no_cash`
WHERE
`no_cash`.`id_client`='$id_client'
AND (`no_cash`.`date2` IS NULL OR `no_cash`.`date2`='')
ORDER BY `no_cash`.`id` DESC
LIMIT 0,1
");

$res_num1=0;
$res_num1=mysql_num_rows($res33);

if ( $res_num1 == 0 ) { // begin if

if ( !isset($_GET['click']) or $_GET['click'] != 1 ) { // if click begin
print "Для оплаты Онлайн Вам нужно, совершить перевод денежных средств в нужном количестве на карту Приват Банка, без комиссии. После чего, заполнить форму заявки и нажать кнопку отправить. Платежи обрабатываются в течении 3 (трех) рабочих дней. В обработке, одновременно, может находиться только одна заявка. В случае, если Вы, отправили неверную заявку, Вы можете её отменить, нажав кнопку \"Отменить заявку\".<br>
<font color=\"#FF0000\">Уважаемые абоненты, обратите внимание на повышение стоимости <a href=\"?cmd=tarifs\">тарифов</a>.</font><br><br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>
<td>№ карты: <span class=\"greentext\">5168 7572 3666 0975</span><br>
Получатель: Гражданинов В. В.</td>
<td width=\"100\" align=\"center\">&nbsp;</td>
<td><a href=\"https://privat24.ua/\" target=\"_blank\"><img src=\"img2/privat_logo.png\" border=\"0\"></a></td>
</tr></table>
<br>
<form method=\"get\">
<input type=\"hidden\" name=\"click\" value=\"1\">
<input type=\"hidden\" name=\"cmd\" value=\"stat\">
<input type=\"hidden\" name=\"opt\" value=\"pay-inf2\">
<table cellspacing=\"2\" cellpadding=\"2\" border=\"0\">
<tr>
<td>Точные дата-время платежа:</td>
<td><input type=\"text\" required maxlength=\"20\" size=\"21\" name=\"pay_date\"> Пример: 20.12.13 18:22:03</td>
</tr>
<tr>
<td>Ф.И.О. плательщика:</td>
<td><input type=\"text\" required maxlength=\"200\" size=\"100\" name=\"payer\"></td>
</tr>
<tr>
<td>Назначение платежа:</td>
<td><input type=\"text\" required maxlength=\"200\" size=\"100\" name=\"pay_comment\"></td>
</tr>
<tr>
<td>Сумма платежа (грн):</td>
<td><input type=\"text\" required maxlength=\"10\" size=\"11\" name=\"pay_summa\" value=\"0\"></td>
</tr>
<tr>
<td colspan=\"2\"><input type=\"submit\" value=\"Отправить\"></td>
</tr>
</table>
</form>\n";
} else { // if click else
$php_date=date('d.m.Y-H:i:s');
$php_user=$id_client;
$php_user_ip=$_SERVER['REMOTE_ADDR'];
$php_refer=$_SERVER['HTTP_REFERER'];
$pay_date=$_GET['pay_date'];
$payer=$_GET['payer'];
$pay_comment=$_GET['pay_comment'];
$pay_summa=$_GET['pay_summa'];
mysql_query("INSERT INTO `d_no_cash` (`date`,`admin`,`admin_ip`,`id_client`,`pay_date`,`payer`,`pay_comment`,`pay_summa`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$pay_date','$payer','$pay_comment','$pay_summa')");
print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";
} // if click end
} else { // else if
while ( $tmp33=mysql_fetch_assoc($res33) ){
 $pay_id=$tmp33["id"];
 $pay_date=$tmp33["pay_date"];
 $payer=$tmp33["payer"];
 $pay_comment=$tmp33["pay_comment"];
 $pay_summa=$tmp33["pay_summa"];
}
print "<span class=\"redtext\">Ваша заявка находится в обработке</span><br>
Точные дата-время платежа: $pay_date<br>
Ф.И.О. плательщика: $payer<br>
Назначение платежа: $pay_comment<br>
Сумма платежа: $pay_summa грн<br><br>
<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"stat\">
<input type=\"hidden\" name=\"opt\" value=\"pay_cancel\">
<input type=\"hidden\" name=\"pay_id\" value=\"$pay_id\">
<input type=\"submit\" value=\"Отменить заявку\">
</form>\n";
} // end if
?>