<?php

$id=$_SESSION['cl_id'];

print "<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>Дата-Время</strong></td>
<td><strong>Касса(адрес)</strong></td>
<td><strong>Период</strong></td>
<td><strong>Тариф</strong></td>
<td><strong>Пополнено<br>Списано</strong></td>
<td><strong>Баланс</strong></td>
<td><strong>Примечание</strong></td></tr>\n";

$balans=0;
$res3=mysql_query("
SELECT
`balans_log`.`id`,`balans_log`.`date`,`balans_log`.`summa`,`balans_log`.`comment`, 
`kassa`.`name` AS `kassa_name`
FROM
`d_cl_balans_log` AS `balans_log`,
`t_kassa` AS `kassa`
WHERE
`balans_log`.`id_client`='$id'
AND `kassa`.`id`=`balans_log`.`id_kassa`
ORDER BY `balans_log`.`id`");
while ( $tmp3=mysql_fetch_assoc($res3) ){ // while 1
	$id_bal_log=$tmp3['id'];
	$date_bal_log=$tmp3['date'];
	$summa_bal_log=$tmp3['summa'];
	$kassa=$tmp3['kassa_name'];
	$comment_bal_log=$tmp3['comment'];
	if ($summa_bal_log > 0) { $summa='+'.$summa_bal_log; $class_tr='bal_in'; } else { $summa=$summa_bal_log; $class_tr='bal_out'; }
	$balans=$balans+$summa_bal_log;

	$num_res2=0;
	$res2=mysql_query("SELECT `tarif_log`.`month`,`tarif_log`.`year`, `tarifs`.`name` AS `tarif_name`
FROM `d_cl_tarif_log` AS `tarif_log`,
`t_tarifs` AS `tarifs`
WHERE
`tarif_log`.`id_balans`='$id_bal_log'
AND `tarifs`.`id`=`tarif_log`.`id_tarif`");
	$num_res2=mysql_num_rows($res2);
	if ( $num_res2 == 1 ) { // if 1
		while ( $tmp2=mysql_fetch_assoc($res2) ){ // while 2
			$month=$tmp2['month'];
			$year=$tmp2['year'];
			$tarif_name=$tmp2['tarif_name'];
		} // while 2
		$period=$month.'/'.$year;
	} else { // if 1
		$period='-';
		$tarif_name='-';
	}// if 1
	print "<tr><td class=\"$class_tr\">$date_bal_log</td><td class=\"$class_tr\">$kassa</td><td class=\"$class_tr\">$period</td><td class=\"$class_tr\">$tarif_name</td><td class=\"$class_tr\">$summa</td><td class=\"$class_tr\">$balans</td><td class=\"$class_tr\">$comment_bal_log</td></tr>\n";
} // while 1
print "</table>\n";
?>