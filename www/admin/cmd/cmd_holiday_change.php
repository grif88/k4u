<?php

$id=$_POST['id'];
$day=$_POST['day'];
$month=$_POST['month'];
$title=$_POST['title'];
$source=$_POST['source'];

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'].'/img2/holiday/';

$res=mysql_query("SELECT `img` FROM `d_holiday` WHERE `id`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$img=$tmp['img'];
}
$path=$work_dir.$img;

$tmp_name=$_FILES['img1']['tmp_name'];
$img_name2=$_FILES['img1']['name'];
if ( !empty($tmp_name) ) {
	unlink($path);
	$name2_arr=explode('.', $img_name2);
	$temp3=date("Y-m-d H:i:s");
	$temp2=hash('crc32', "$temp3");
	$img_name=$temp2.'.'.$name2_arr[1];
	$p_img1=$work_dir.$img_name;
	move_uploaded_file($tmp_name, $p_img1);
	$img=$img_name;
	exec("chmod 0640 $p_img1");
}

mysql_query("UPDATE `d_holiday` SET `day`='$day',`month`='$month',`title`='$title',`img`='$img',`source`='$source' WHERE `id`='$id'");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>