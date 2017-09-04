<?php

$id_client=$_GET['id'];
$reason=$_GET['reason'];

// insert

mysql_query("INSERT INTO `d_cl_remont` (`date`,`admin`,`admin_ip`,`id_client`,`reason`,`date_add`) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$reason','$php_date_s')");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>