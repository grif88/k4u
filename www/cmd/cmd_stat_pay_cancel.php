<?php
$php_date=date('d.m.Y-H:i:s');
$php_user_ip=$_SERVER['REMOTE_ADDR'];
$refer=$_SERVER['HTTP_REFERER'];
$pay_id=$_GET['pay_id'];
$cl_id=$_SESSION['cl_id'];
$cl_login=$_SESSION['cl_login'];
$req1=mysql_query("UPDATE `d_no_cash` SET `pay_date`='$php_date',`date2`='$php_date',`admin2`='$cl_login',`admin_ip2`='$php_user_ip',`summa`='0',`fail`='2' WHERE `id`='$pay_id' AND (`date2` IS NULL OR `date2`='') AND `id_client`='$cl_id'");
print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";
?>