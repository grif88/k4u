<?php

$id=$_GET['id'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("DELETE FROM `tarifs` WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>