<?php

// input

if ( !empty($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res1=mysql_query("SELECT `id`,`id_client`,`summa` FROM `d_cl_balans_log` WHERE `id`='$id'");
$res1_rows=mysql_num_rows($res1);
if ( $res1_rows == 1 ) {
 $res2=mysql_query("SELECT `id` FROM `d_cl_tarif_log` WHERE `id_balans`='$id'");
 $res2_rows=mysql_num_rows($res2);
 if ( $res2_rows == 1 ) {
  $res22=mysql_query("SELECT
`cl_balans_log`.`id_client`, `cl_list`.`login`
FROM
`d_cl_balans_log` AS `cl_balans_log`,
`d_cl_list` AS `cl_list`
WHERE
`cl_balans_log`.`id`='$id'
AND `cl_list`.`id`=`cl_balans_log`.`id_client`");
  while ( $tmp22=mysql_fetch_assoc($res22) ){ $id_client=$tmp22['id_client']; $login=$tmp22['login']; }
   mysql_query("DELETE FROM `d_cl_tarif_log` WHERE `id_balans`='$id'");
   $cl_info=active_check($id_client);
   $speed=($cl_info['s_upload']*1000000).'/'.($cl_info['s_download']*1000000);
   if ( $cl_info['active'] == 1 ) {
    ins_active($php_date,$php_user,$php_user_ip,$id_client,$login,$cl_info['active'],$speed);
   } else {
    ins_block($php_date,$php_user,$php_user_ip,$id_client,$login,'1');
   }
 }
 while ( $tmp1=mysql_fetch_assoc($res1) ){ $id_client=$tmp1['id_client']; $summa=$tmp1['summa']; }
 $summa2=$summa*(-1);
 ch_balans($id_client,$summa2);
 mysql_query("DELETE FROM `d_cl_balans_log` WHERE `id`='$id'");
 save_close();
} else {
 print "<center>ID не существует<br></center>\n";
}

} // if id end
else { print "<center>ID не выбран<br></center>\n"; }
?>