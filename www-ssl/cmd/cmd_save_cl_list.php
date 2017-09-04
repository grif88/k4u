<?php

$id_list=$_GET['id'];
$login_old=$_GET['login_old'];
$login=$_GET['login'];
$passwd=$_GET['passwd'];
$cl_ip=$_GET['cl_ip'];
$cl_mac=$_GET['cl_mac'];
$id_type=$_GET['id_cl_type'];
if ( isset($_GET['upload']) and !empty($_GET['upload']) ) { $upload=$_GET['upload']; } else { $upload=0; }

// insert

if ( $upload == 1 ) { // if upload

$access2=0;
$res2=mysql_query("SELECT `secret_edit` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
 while ( $tmp2=mysql_fetch_assoc($res2) ){
  $access2=$tmp2['secret_edit']; }
} // if $res2 end
if ( $access2 != 1 ) { butt_back('У Вас нет прав доступа.'); } // global if
else { // global else

$name=$login_old.'>'.$login;
ins_ch_secret($php_date,$php_user,$php_user_ip,$id_list,$name,$passwd,$cl_ip,$cl_mac);

mysql_query("UPDATE `d_cl_list` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`login`='$login',`passwd`='$passwd',`cl_ip`='$cl_ip',`cl_mac`='$cl_mac',`id_type`='$id_type' WHERE `id`='$id_list'");

save_close();

} // end global else

} else { // else upload

mysql_query("UPDATE `d_cl_list` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`login`='$login',`passwd`='$passwd',`cl_ip`='$cl_ip',`cl_mac`='$cl_mac',`id_type`='$id_type' WHERE `id`='$id_list'");

save_close();

} // end upload

?>