<?php

$id=$_GET['id'];

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'];

mysql_query("DELETE FROM `links` WHERE `id`='$id'");

$path=$work_dir.'/img2/'.$id.'.png';
unlink($path);

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>