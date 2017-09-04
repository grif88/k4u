<?php
$php_date=date('d.m.Y-H:i:s');
$s_id=session_id();
$cl_id=$_SESSION['cl_id'];
mysql_query("UPDATE `d_cl_stat_log` SET `date_end`='$php_date' WHERE `id_session`='$s_id' AND `id_client`='$cl_id'");
unset($_SESSION['cl_id'],$_SESSION['cl_login']);
print "<script type=\"text/javascript\">location.replace(\"?cmd=stat\");</script>\n";
?>