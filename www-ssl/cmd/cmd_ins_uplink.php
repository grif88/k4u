<?php

$id_cl=$_GET['id'];
$type=$_GET['type'];
$id_term=$_GET['id_switch'];

// insert

mysql_query("INSERT INTO `d_uplink` (`date`,`admin`,`admin_ip`,`type`,`id_cl`,`id_term`) VALUES ('$php_date','$php_user','$php_user_ip','$type','$id_cl','$id_term')");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>