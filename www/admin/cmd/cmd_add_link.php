<?php

$link=$_POST['link'];
$comment=$_POST['comment'];
$poss=$_POST['poss'];

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'];

mysql_query("INSERT INTO `links` (`link`,`comment`,`poss`) VALUES ('$link','$comment','$poss')");

$res=mysql_query("SELECT `id` FROM `links` ORDER BY `id` DESC LIMIT 0, 1");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$id=$tmp['id'];
}

$tmp_name=$_FILES['img1']['tmp_name'];
if ( !empty($tmp_name) ) {
	$p_img1=$work_dir.'/img2/'.$id.'.png';
	move_uploaded_file($_FILES['img1']['tmp_name'], $p_img1);
	exec("chmod 0640 $p_img1");
}

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>