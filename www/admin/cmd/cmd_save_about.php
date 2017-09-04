<?php

$text1=$_POST['text1'];
$refer=$_SERVER['HTTP_REFERER'];

mysql_query("UPDATE `about` SET `text`='$text1' WHERE `id`='1'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>