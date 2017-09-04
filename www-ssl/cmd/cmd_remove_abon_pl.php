<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

$res22=mysql_query("SELECT
`cl_balans_log`.`id_client`, `cl_list`.`login`
FROM
`d_cl_balans_log` AS `cl_balans_log`,
`d_cl_list` AS `cl_list`
WHERE
`cl_balans_log`.`id`='$id'
AND `cl_list`.`id`=`cl_balans_log`.`id_client`");
while ( $tmp22=mysql_fetch_assoc($res22) ){ $id_client=$tmp22['id_client']; $login=$tmp22['login']; }

// access
$res2=mysql_query("SELECT `del_abon_pl-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['del_abon_pl-adm'];
 }
}

$res1=mysql_query("SELECT `id`,`id_client`,`summa` FROM `d_cl_balans_log` WHERE `id`='$id'");
while ( $tmp1=mysql_fetch_assoc($res1) ){ $id_client2=$tmp1['id_client']; $summa=$tmp1['summa']; }
$summa2=$summa*(-1);

if ( $access2 == 1 ) { // if access begin
 ch_balans($id_client2,$summa2);
 mysql_query("DELETE FROM `d_cl_balans_log` WHERE `id`='$id'");
 mysql_query("DELETE FROM `d_cl_tarif_log` WHERE `id_balans`='$id'");
 $cl_info=active_check($id_client);
 $speed=($cl_info['s_upload']*1000000).'/'.($cl_info['s_download']*1000000);
 if ( $cl_info['active'] == 1 ) {
  ins_active($php_date,$php_user,$php_user_ip,$id_client,$login,$cl_info['active'],$speed);
 } else {
  ins_block($php_date,$php_user,$php_user_ip,$id_client,$login,'1');
 }
 #ins_ch_status($php_date,$php_user,$php_user_ip,$id_client,$login,$cl_info['active'],$speed);
 save_close();
} else { // if access else
$res4=mysql_query("SELECT `admin` FROM `d_cl_balans_log` WHERE `id`='$id'");
if ( $res4 ) { // if $res4 begin
 while ( $tmp4=mysql_fetch_assoc($res4) ){
  $admin_name=$tmp4['admin'];
 }
} // if $res4 end
if ($php_user == $admin_name ) {
 ch_balans($id_client2,$summa2);
 mysql_query("DELETE FROM `d_cl_balans_log` WHERE `id`='$id'");
 mysql_query("DELETE FROM `d_cl_tarif_log` WHERE `id_balans`='$id'");
 $cl_info=active_check($id_client);
 $speed=($cl_info['s_upload']*1000000).'/'.($cl_info['s_download']*1000000);
 if ( $cl_info['active'] == 1 ) {
  ins_active($php_date,$php_user,$php_user_ip,$id_client,$login,$cl_info['active'],$speed);
 } else {
  ins_block($php_date,$php_user,$php_user_ip,$id_client,$login,'1');
 }
 #ins_ch_status($php_date,$php_user,$php_user_ip,$id_client,$login,$cl_info['active'],$speed);
 save_close();
} else {
 butt_close('¬ы не имеете права удал€ть чужие записи.');
}
} // if access end

} // if id end
else { print "ID не выбран<br>\n"; }
?>