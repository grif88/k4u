<?php

function ins_abon_pl($id_client,$summa_t,$comment_t,$year,$month,$id_tarif) {
include './include/global.php';

$res5=mysql_query("SELECT `id` FROM `t_kassa` WHERE `ip`='$php_user_ip' ORDER BY `id`");
$res_rows5=mysql_num_rows($res5);
if ( $res_rows5 == 1 ) {
 while ( $tmp5=mysql_fetch_assoc($res5) ){
  $id_kassa=$tmp5['id'];
 }
} else { $id_kassa=1; }

$cash=0;
$summa=$summa_t*(-1);
$comment = $comment_t." ($month.$year)";
mysql_query("INSERT INTO `d_cl_balans_log` (`date`,`admin`,`admin_ip`,`id_client`,`summa`,`id_kassa`,`cash`,`comment`,`kassa_date`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$summa','$id_kassa','$cash','$comment','$php_kassa_date')");
$id_balans=mysql_insert_id();
ch_balans($id_client,$summa);
mysql_query("INSERT INTO `d_cl_tarif_log` (`date`,`admin`,`admin_ip`,`id_client`,`month`,`year`,`id_tarif`,`id_balans`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$month','$year','$id_tarif','$id_balans')");

if ( $year == $php_date_y && $month == $php_date_m ) {
$res3=mysql_query("SELECT
`tarifs`.`s_upload`, `tarifs`.`s_download`,
`cl_list`.`login`
FROM
`d_cl_list` AS `cl_list`,
`t_tarifs` AS `tarifs`
WHERE
`tarifs`.`id`='$id_tarif'
AND `cl_list`.`id`='$id_client'");
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $login=$tmp3['login'];
 $s_upload=$tmp3['s_upload']*1000000;
 $s_download=$tmp3['s_download']*1000000;
}
$speed=$s_upload.'/'.$s_download;
#ins_ch_status($php_date,$php_user,$php_user_ip,$id_client,$login,'1',$speed);
ins_active($php_date,$php_user,$php_user_ip,$id_client,$login,'1',$speed);
ins_drop($php_date,$php_user,$php_user_ip,$id_client,$login);
}

save_close();
}

//------------------------------------------------

$id_client=$_GET['id'];
$id_tarif_old=$_GET['id_tarif_old'];
$id_tarif=$_GET['id_tarif'];
$month=$_GET['month'];
$year=$_GET['year'];
if ( !empty($_GET['exception']) ) { $exception=$_GET['exception']; } else { $exception=0; }
$summa=$_GET['summa'];
$comment=$_GET['comment'];

$balans=0;
$res3=mysql_query("SELECT `balans` FROM `d_cl_balans` WHERE `id_client`='$id_client'");
if ( mysql_num_rows($res3) == 1 ) {
	while ( $tmp3=mysql_fetch_assoc($res3) ){
		$balans=$tmp3['balans'];
	}
}
/*$res3=mysql_query("SELECT `summa` FROM `d_cl_balans_log` WHERE `id_client`='$id_client' ORDER BY `id` DESC");
while ( $tmp3=mysql_fetch_assoc($res3) ){
 $summa_bal_log=$tmp3['summa'];
 $balans=$balans+$summa_bal_log;
}*/

$res2=mysql_query("SELECT `add_abon_pl-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['add_abon_pl-adm'];
 }
} // if $res2 end

// cheking

if ( $exception == 1 ) { // if exception begin
 if ( strlen($summa) > 0 and $summa >= 0 and !empty($comment) ) { // if summa exist begin
  if ( $access2 == 1 ) {
   ins_abon_pl($id_client,$summa,$comment,$year,$month,$id_tarif);
  } else {
   $bal_after=$balans-$summa;
   if ( $bal_after < 0 ) {
    butt_back('После активацыи будет отрицательный баланс.');
   }
   else { ins_abon_pl($id_client,$summa,$comment,$year,$month,$id_tarif); }
  }
 } else { // if summa exist else
 butt_back('Не верное значение суммы или коментарий пуст.');
 } // if summa exist end
} else { // if exception else
 $res22=mysql_query("SELECT `cost`,`cost_down` FROM `t_tarifs` WHERE `id`='$id_tarif'");
 while ( $tmp22=mysql_fetch_assoc($res22) ){ $cost=$tmp22['cost']; $cost_down=$tmp22['cost_down']; }
 if ( $id_tarif_old != 0 ) {
  if ( $id_tarif == $id_tarif_old ) {
   $comment3='активация тарифа';
   $cost_new=$cost;
  } else {
   $res441=mysql_query("SELECT `cost`,`next_id` FROM `t_tarifs` WHERE `id`='$id_tarif_old'");
   while ( $tmp441=mysql_fetch_assoc($res441) ){ $cost_old=$tmp441['cost']; $next_id=$tmp441['next_id']; }
   if ( $next_id != 0 ) {
   	$res44=mysql_query("SELECT `cost` FROM `t_tarifs` WHERE `id`='$next_id'");
	while ( $tmp44=mysql_fetch_assoc($res44) ){ $cost_old=$tmp44['cost']; }
   }
   if ( $cost_old > $cost ) {
    if ( $cost_down != 0 ) {
	 $cost_new=$cost+$cost_down;
	 $comment3='активация тарифа с понижением';
	} else {
	 $comment3='активация тарифа';
	 $cost_new=$cost;
	}
   } else {
    $comment3='активация тарифа';
    $cost_new=$cost;
   }
  }
  if ( $access2 == 1 ) {
   ins_abon_pl($id_client,$cost_new,$comment3,$year,$month,$id_tarif);
  } else {
   $bal_after3=$balans-$cost_new;
   if ( $bal_after3 < 0 ) {
    butt_back('После активацыи будет отрицательный баланс.');
   } else {
    ins_abon_pl($id_client,$cost_new,$comment3,$year,$month,$id_tarif);
   }
  }
 } else {
  $comment2='активация первого тарифа';
  if ( $access2 == 1 ) {
   ins_abon_pl($id_client,$cost,$comment2,$year,$month,$id_tarif);
  } else {
   $bal_after2=$balans-$cost;
   if ( $bal_after2 < 0 ) {
    butt_back('После активацыи будет отрицательный баланс.');
   }
   else { ins_abon_pl($id_client,$cost,$comment2,$year,$month,$id_tarif); }
  }
 }
} // if exception end
?>