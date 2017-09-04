<?php

$id_client=$_GET['id'];
$reason=$_GET['reason'];

// cheking

$rows_res2 = 0;
$res2=mysql_query("SELECT `id` FROM `d_cl_otkl` WHERE `id_client`='$id_client'");
$rows_res2=mysql_num_rows($res2);
if ( $rows_res2 == 0 ) { 

// insert

mysql_query("INSERT INTO `d_cl_otkl` (`date`,`admin`,`admin_ip`,`id_client`,`reason`,`date_add`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$reason','$php_date_s')");

save_close();

} else {
 print "<script type=\"text/javascript\">window.opener.location.reload();</script>
Заявка уже подана<br>\n";
}
?>