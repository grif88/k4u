<?php

$id=$_GET['id'];
$view=0;

mysql_query("UPDATE `t_tarifs` SET `view`='$view' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$php_refer\");</script>\n";

?>