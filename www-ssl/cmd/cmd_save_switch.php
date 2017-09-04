<?php

$id=$_GET['id'];
$id_type=$_GET['id_type'];
$name=$_GET['name'];
$sup_id_street=$_GET['id_street'];
$sup_house=$_GET['house'];
$sup_room=$_GET['room'];
$sup_id_type=$_GET['sup_id_type'];
$comment=$_GET['comment'];

// insert

mysql_query("UPDATE `d_sw_list` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`id_type`='$id_type',`name`='$name',`sup_id_street`='$sup_id_street',`sup_house`='$sup_house',`sup_room`='$sup_room',`sup_id_type`='$sup_id_type',`comment`='$comment' WHERE `id`='$id'");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>