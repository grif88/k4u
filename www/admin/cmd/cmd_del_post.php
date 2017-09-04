<?php
$id=$_GET['id'];
$table=$_GET['table'];
$refer=$_SERVER['HTTP_REFERER'];

mysql_query("DELETE FROM `forum` WHERE `id`='$id'");
mysql_query("DELETE FROM `comments` WHERE `table`='$table' AND `id_table`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";
?>