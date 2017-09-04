<?php

$name=$_GET['name'];
$abon=$_GET['abon'];
$speed=$_GET['speed'];
$local=$_GET['local'];
$srok=$_GET['srok'];
$akcia=$_GET['akcia'];
$poss=$_GET['poss'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("INSERT INTO `tarifs` (`name`,`abon`,`speed`,`local`,`srok`,`akcia`,`poss`) VALUES ('$name','$abon','$speed','$local','$srok','$akcia','$poss')");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>