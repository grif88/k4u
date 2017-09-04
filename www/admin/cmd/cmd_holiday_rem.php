<?php

$id=$_GET['id'];

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'];

$res=mysql_query("SELECT `img` FROM `d_holiday` WHERE `id`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$img=$tmp['img'];
}

mysql_query("DELETE FROM `d_holiday` WHERE `id`='$id'");

$path=$work_dir.'/img2/holiday/'.$img;
unlink($path);

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>