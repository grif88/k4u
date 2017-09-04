<?php

$id_type=$_GET['id_type'];
$name=$_GET['name'];
$sup_id_street=$_GET['id_street'];
$sup_house=$_GET['house'];
$sup_room=$_GET['room'];
$sup_id_type=$_GET['sup_id_type'];
$comment=$_GET['comment'];

// insert

mysql_query("INSERT INTO `d_sw_list` (`date`,`admin`,`admin_ip`,`id_type`,`name`,`sup_id_street`,`sup_house`,`sup_room`,`sup_id_type`,`comment`) VALUES ('$php_date','$php_user','$php_user_ip','$id_type','$name','$sup_id_street','$sup_house','$sup_room','$sup_id_type','$comment')");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>