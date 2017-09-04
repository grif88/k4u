<?php

$usluga=$_GET['usluga'];
$cost=$_GET['cost'];
$poss=$_GET['poss'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("INSERT INTO `uslugi` (`usluga`,`cost`,`poss`) VALUES ('$usluga','$cost','$poss')");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>