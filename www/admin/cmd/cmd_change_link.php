<?php

$id=$_POST['id'];
$link=$_POST['link'];
$comment=$_POST['comment'];
$poss=$_POST['poss'];

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'];

mysql_query("UPDATE `links` SET `link`='$link',`comment`='$comment',`poss`='$poss' WHERE `id`='$id'");

$tmp_name=$_FILES['img1']['tmp_name'];
if ( !empty($tmp_name) ) {
	$p_img1=$work_dir.'/img2/'.$id.'.png';
	move_uploaded_file($_FILES['img1']['tmp_name'], $p_img1);
	exec("chmod 0640 $p_img1");
}

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>