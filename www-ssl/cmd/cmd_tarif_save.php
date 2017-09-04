<?php

$id=$_GET['id'];
$poss=$_GET['poss'];
$name=$_GET['name'];
$cost=$_GET['cost'];
$cost_down=$_GET['cost_down'];
$s_upload=$_GET['s_upload'];
$s_download=$_GET['s_download'];
$up_speed=$_GET['up_speed'];
$open=$_GET['open'];
$next_id=$_GET['next_id'];

mysql_query("UPDATE `t_tarifs` SET `poss`='$poss',`name`='$name',`cost`='$cost',`cost_down`='$cost_down',`s_upload`='$s_upload',`s_download`='$s_download',`up_speed`='$up_speed',`open`='$open',`next_id`='$next_id' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";

?>