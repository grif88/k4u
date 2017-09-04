<?php
print "Абонентская плата за интернет с 1.06.2011 принимаеться в офисе по адресу ул. Мусоргского д. 13. Здание бывшего магазина &quot;Колос&quot;, офис находиться между кафе &quot;Згадай минуле&quot; и &quot;Секонд Хенд&quot;. Синяя вывеска &quot;Рейнфорд Электроникс&quot;, сервисный центр Рейнфорд.<br>
<br>
<span class=\"kont1\">Время работы:</span> С Понедельника по Пятницу 9:00 - 18:00. Суббота, Воскресенье - выходной.<br>
<br>
К разделу <a href=\"?cmd=kont\" target=\"_self\">Контакты</a>.<br>
<br><hr><br>
<center><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr valign=\"middle\" align=\"center\">
<td><span class=\"title2\">Оплата OnLine</span></td>
<td width=\"200\"><img src=\"img2/privat_logo.png\" border=\"0\"></td>
</tr></table></center><br>\n";

#$_POST['payment']='amt=22.25&ccy=UAH&details=книга Будь здоров!&ext_details=1000BDN01&pay_way=privat24&order=113&merchant= 75482&state=ok&date=060814080113&ref=aBESQ2509023364513&payCountry=UA';
#$_POST['signature']=1;

include '/var/www-ssl/include/p24merch.php';

if ( isset($_POST['payment']) and !empty($_POST['payment']) and isset($_POST['signature']) and !empty($_POST['signature']) ) { // if post global 1
	$payment=$_POST['payment'];
	$signature=$_POST['signature'];
	#$pass='zcr71LurqaH0ic1L7a75buVO0kSYLPph';
	$signature2=sha1(md5($payment.$pass));
	if ( $signature == $signature2 ) { // if signature
		$arr1=explode('&',$payment);
		#var_dump($arr1);
		foreach ( $arr1 as $value1 ) {
			#print "$value1<br>";
			$arr2=explode('=',$value1);
			$temp2=$arr2[0];
			$arr3[$temp2]=$arr2[1];
		}
		#$pay_summa=$arr3['amt'];
		$pay_summa2=$arr3['amt'];
		$pay_summa=round($pay_summa2-(($pay_summa2/(100+$komis))*$komis), 2);
		#$pay_summa=round($pay_summa2-($pay_summa2/100*$komis), 2);
		$nocash_id=$arr3['order'];
		$state=$arr3['state'];
		if ( $state == 'ok' ) { $state2='<font color="#00FF00">проведен</font>'; }
		else if ( $state == 'fail' ) { $state2='<font color="#FF0000">отклонен</font>'; }
		else if ( $state == 'wait' ) { $state2='<font color="#FF8C00">в обработке</font>'; }
		else { $state2='?'; }
		$date=$arr3['date'];
		$pay_date2=$date[0].$date[1].'.'.$date[2].$date[3].'.'.$date[4].$date[5].'-'.$date[6].$date[7].':'.$date[8].$date[9].':'.$date[10].$date[11];
		$php_date=date('d.m.Y-H:i:s');
		$res11=mysql_query("SELECT `pay_date` FROM `d_no_cash` WHERE `id`='$nocash_id'");
		if ( mysql_num_rows($res11) > 0 ) {
			while ( $tmp11=mysql_fetch_assoc($res11) ){
				$pay_date=$tmp11['pay_date'];
			}
		} else { $pay_date='?'; }
		print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td>№ заявки</td><td>Дата подачи</td><td>Дата выполнения</td><td>Дата выполнения(банк)</td><td>Сумма (грн)</td><td>Статус</td></tr>
<tr align=\"center\"><td>$nocash_id</td><td>$pay_date</td><td>$php_date</td><td>$pay_date2</td><td>$pay_summa</td><td>$state2</td></tr>
</table>\n";
	}// end signature
} else { // else post global 1
	$id_client=$_SESSION['cl_id'];
	$res33=mysql_query("SELECT `no_cash`.`id`, `no_cash`.`pay_date`, `no_cash`.`pay_summa`
FROM `d_no_cash` AS `no_cash`
WHERE `no_cash`.`id_client`='$id_client'
AND (`no_cash`.`date2` IS NULL OR `no_cash`.`date2`='')
ORDER BY `no_cash`.`id` DESC
LIMIT 0,1");
	$res_num1=0;
	$res_num1=mysql_num_rows($res33);
	if ( $res_num1 == 0 ) { // if no exist
		if ( !isset($_GET['click']) or $_GET['click'] != 1 ) { // if click
			$res44=mysql_query("SELECT `tar`.`cost`
FROM `t_tarifs` AS `tar`,
`d_cl_tarif_log` AS `log`
WHERE `tar`.`id`=`log`.`id_tarif`
AND `log`.`id_client`='$id_client'
ORDER BY `log`.`id` DESC
LIMIT 0,1");
			if ( mysql_num_rows($res44) == 1 ) {
				while ( $tmp44=mysql_fetch_assoc($res44) ){
					$cost_val=$tmp44["cost"].'.00';
				}
			} else { $cost_val='0.00'; }
			print "Для оплаты Онлайн, Вам нужно указать сумму платежа. Нажать кнопку &quot;Оплатить&quot; и следовать дальнейшим инструкциям. Средства на счет зачисляются мгновенно.<br>
<font color=\"#FF0000\">Комиссия составляет $komis% и взымается автоматически.</font><br>
<br>
<form method=\"get\">
<input type=\"hidden\" name=\"click\" value=\"1\">
<input type=\"hidden\" name=\"cmd\" value=\"stat\">
<input type=\"hidden\" name=\"opt\" value=\"pay-inf3\">
<table cellspacing=\"2\" cellpadding=\"2\" border=\"0\">
<tr>
<td>Сумма платежа (грн):</td>
<td><input type=\"text\" required maxlength=\"10\" size=\"11\" name=\"pay_summa\" value=\"$cost_val\"></td>
</tr>
<tr>
<td colspan=\"2\"><input type=\"submit\" value=\"Оплатить\"></td>
</tr>
</table>
</form>\n";
		} else { // else click
			$pay_summa=str_replace(',','.',$_GET['pay_summa']);
			$pay_summa2=round($pay_summa*1, 2);
			#print "$pay_summa - $pay_summa2 - ";
			if ( $pay_summa > 0 ) {
				if ( $pay_summa == "$pay_summa2" ) {
					//base insert begin
					$php_date=date('d.m.Y-H:i:s');
					$php_user=$_SESSION['cl_login'];
					$php_user_ip=$_SERVER['REMOTE_ADDR'];
					$php_refer=$_SERVER['HTTP_REFERER'];
					$pay_date=$php_date;
					$payer='privat24';
					$pay_comment='-';
					mysql_query("INSERT INTO `d_no_cash` (`date`,`admin`,`admin_ip`,`id_client`,`pay_date`,`payer`,`pay_comment`,`pay_summa`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$pay_date','$payer','$pay_comment','$pay_summa')");
					//base insert end
					print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";
				} else { print "Неверный формат суммы.<br><br>\n<input type=\"button\" value=\"Назад\" onclick=\"javascript:history.back();\">\n";	}
			} else { print "Сумма должна быть больше 0(нуля).<br><br>\n<input type=\"button\" value=\"Назад\" onclick=\"javascript:history.back();\">\n"; }
		} // end click
	} else { // else no exist
		while ( $tmp33=mysql_fetch_assoc($res33) ){
			$pay_id=$tmp33['id'];
			$pay_date=$tmp33['pay_date'];
			$pay_summa2=$tmp33['pay_summa'];
		}
		#$merchant='107298';
		#$order=106;
		$order=$pay_id;
		$details='services, '.$id_client;
		$ext_details='null';
		$komis_grn=round($pay_summa2/100*$komis, 2);
		$pay_summa=round($pay_summa2+$komis_grn, 2);
		#$pay_summa=$pay_summa2;
		$payment="amt=$pay_summa&ccy=UAH&details=$details&ext_details=$ext_details&pay_way=privat24&order=$order&merchant=$merchant";
		#$pass='zcr71LurqaH0ic1L7a75buVO0kSYLPph';
		$signature=sha1(md5($payment.$pass));
		print "Вы, собираетесь совершить оплату за интернет. Для продолжения, сверьте данные об оплате и нажмите кнопку &quot;Подтвердить оплату&quot;. В случае неверных данных в таблице, нажмите кнопку &quot;Отменить оплату&quot;. И повторите заявку.<br><br>
	<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td>№ заявки</td><td>Дата подачи</td><td>Сумма (грн)</td><td>Комиссия (грн)</td><td>Итого (грн)</td></tr>
<tr align=\"center\"><td>$order</td><td>$pay_date</td><td>$pay_summa2</td><td>$komis_grn</td><td>$pay_summa</td></tr>
</table><br>\n";
		#print "$pay_date<br>\nВы собираетесь совершить оплату за интернет на сумму $pay_summa грн.<br><br>\n";
		print "<form method=\"POST\" action=\"https://api.privatbank.ua/p24api/ishop\" accept-charset=\"UTF-8\">
<input type=\"hidden\" name=\"amt\" value=\"$pay_summa\" />
<input type=\"hidden\" name=\"ccy\" value=\"UAH\" />
<input type=\"hidden\" name=\"merchant\" value=\"$merchant\" />
<input type=\"hidden\" name=\"order\" value=\"$order\" />
<input type=\"hidden\" name=\"details\" value=\"$details\" />
<input type=\"hidden\" name=\"ext_details\" value=\"$ext_details\" />
<input type=\"hidden\" name=\"pay_way\" value=\"privat24\" />
<input type=\"hidden\" name=\"return_url\" value=\"http://www.k4u.net.ua/?cmd=stat&opt=pay-inf3\" />
<input type=\"hidden\" name=\"server_url\" value=\"https://debbi.k4u.net.ua/p24pay.php\" />
<input type=\"hidden\" name=\"signature\" value=\"$signature\" />
<input type=\"submit\" value=\"Подтвердить оплату\">
</form>
<form method=\"get\">
<input type=\"hidden\" name=\"cmd\" value=\"stat\">
<input type=\"hidden\" name=\"opt\" value=\"pay_cancel\">
<input type=\"hidden\" name=\"pay_id\" value=\"$pay_id\">
<input type=\"submit\" value=\"Отменить оплату\">
</form>\n";
	} // end no exist
} // end post global 1
?>