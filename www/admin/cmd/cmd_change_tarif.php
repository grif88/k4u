<?php

$id=$_GET['id'];
$name=$_GET['name'];
$abon=$_GET['abon'];
$speed=$_GET['speed'];
$local=$_GET['local'];
$srok=$_GET['srok'];
$akcia=$_GET['akcia'];
$poss=$_GET['poss'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("UPDATE `tarifs` SET `name`='$name',`abon`='$abon',`speed`='$speed',`local`='$local',`srok`='$srok',`akcia`='$akcia',`poss`='$poss' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>