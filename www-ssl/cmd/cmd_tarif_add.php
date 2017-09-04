<?php

$poss=$_GET['poss'];
$name=$_GET['name'];
$cost=$_GET['cost'];
$cost_down=$_GET['cost_down'];
$s_upload=$_GET['s_upload'];
$s_download=$_GET['s_download'];
$up_speed=$_GET['up_speed'];
$open=$_GET['open'];
$next_id=$_GET['next_id'];
$view=1;

mysql_query("INSERT INTO `t_tarifs` (poss,name,cost,cost_down,s_upload,s_download,up_speed,open,next_id,view) VALUES ('$poss','$name','$cost','$cost_down','$s_upload','$s_download','$up_speed','$open','$next_id','$view')");

print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";

?>