<?php

$id_client=$_GET['id'];
$summa=$_GET['summa'];
if ( !empty($_GET['cash']) ) { $cash=$_GET['cash']; } else { $cash=0; }
$comment=$_GET['comment'];

$res5=mysql_query("SELECT `id` FROM `t_kassa` WHERE `ip`='$php_user_ip' ORDER BY `id`");
$res_rows5=mysql_num_rows($res5);
if ( $res_rows5 == 1 ) {
 while ( $tmp5=mysql_fetch_assoc($res5) ){
  $id_kassa=$tmp5['id'];
 }
} else { $id_kassa=1; }

// cheking

if ( !empty($summa) and $summa != 0 ) { // if summa exist begin

if ( $cash == 1 ) { // if cash == 1 begin

$balans=0;
$res3=mysql_query("SELECT `balans` FROM `d_cl_balans` WHERE `id_client`='$id_client'");
if ( mysql_num_rows($res3) == 1 ) {
	while ( $tmp3=mysql_fetch_assoc($res3) ){
		$balans=$tmp3['balans'];
	}
}
/*$res3=mysql_query("SELECT `summa` FROM `d_cl_balans_log` WHERE `id_client`='$id_client' ORDER BY `id` DESC");
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $summa2=$tmp3['summa'];
 $balans=$balans+$summa2;
}*/
$bal_after=$balans+$summa;
if ( $bal_after >= 0 or $bal_after > $balans ) {
mysql_query("INSERT INTO `d_cl_balans_log` (`date`,`admin`,`admin_ip`,`id_client`,`summa`,`id_kassa`,`cash`,`comment`,`kassa_date`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$summa','$id_kassa','$cash','$comment','$php_kassa_date')");

$cost=0;
$res551=mysql_query("SELECT `tarifs`.`cost` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id_client' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`year` DESC, `tarif_log`.`month` DESC LIMIT 0,1");
ch_balans($id_client,$summa);
$res_rows551=mysql_num_rows($res551);
if ( $res_rows551 == 1 ) {
	while ( $tmp551=mysql_fetch_assoc($res551) ){
		$cost=$tmp551['cost'];
	}
}

$res552=mysql_query("SELECT `date_finish` FROM `d_cl_podkl` WHERE `id_client`='$id_client'");
while ( $tmp552=mysql_fetch_assoc($res552) ){
	$date_finish2=$tmp552['date_finish'];
}

$res_rows553=0;
$res553=mysql_query("SELECT `id` FROM `d_cl_otkl` WHERE `id_client`='$id_client'");
$res_rows553=mysql_num_rows($res553);

if ( $bal_after >= $cost and !empty($date_finish2) and $res_rows553 <= 0 ) {
	save_close_bal($id_client);
} else {
	save_close();
}

} else {
butt_back('После пополнения будет отрицательный баланс.');
}

} else { // if cash == 1 else

$res2=mysql_query("SELECT `add_balans-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['add_balans-adm'];
 }
} // if $res2 end
if ( $access2 == 1 ) {
mysql_query("INSERT INTO `d_cl_balans_log` (`date`,`admin`,`admin_ip`,`id_client`,`summa`,`id_kassa`,`cash`,`comment`,`kassa_date`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$summa','$id_kassa','$cash','$comment','$php_kassa_date')");
ch_balans($id_client,$summa);
save_close();
} else {
butt_back('Вы не имеете право не проводить по кассе.');
}

} // if cash == 1 end

} else { // if summa exist else
butt_back('Не верное значение суммы.');
} // if summa exist end
?>