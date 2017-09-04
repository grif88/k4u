<?php

$id=$_GET['id'];
$usluga=$_GET['usluga'];
$cost=$_GET['cost'];
$poss=$_GET['poss'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("UPDATE `uslugi` SET `usluga`='$usluga',`cost`='$cost',`poss`='$poss' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>