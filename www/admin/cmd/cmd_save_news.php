<?php

$id=$_POST['id'];
$name=$_POST['name'];
$date=$_POST['date'];
$text=$_POST['text'];
$glav=$_POST['glav'];
$name=str_replace('\'', '&prime;', $name);
$text=str_replace('\'', '&prime;', $text);
$name=str_replace('\\', '', $name);
$text=str_replace('\\', '', $text);

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("UPDATE `news` SET `name`='$name',`date`='$date',`text`='$text',`glav`='$glav' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>