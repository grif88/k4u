<?php

$name=$_POST['name'];
$date=$_POST['date'];
$text=$_POST['text'];
$glav=$_POST['glav'];
$name=str_replace('\'', '&prime;', $name);
$text=str_replace('\'', '&prime;', $text);
$name=str_replace('\\', '', $name);
$text=str_replace('\\', '', $text);

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("INSERT INTO `news` (`name`,`date`,`text`,`glav`) VALUES ('$name','$date','$text','$glav')");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>