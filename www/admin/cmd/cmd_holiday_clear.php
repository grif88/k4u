<?php

$id=$_GET['id'];

$refer=$_SERVER['HTTP_REFERER'];

mysql_query("UPDATE `d_holiday` SET `shows`='0',`count`='0' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>