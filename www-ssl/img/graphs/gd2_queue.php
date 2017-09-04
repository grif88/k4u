<?php
include '../../include/global.php';
$mkt=$_GET['mkt'];
$name='/'.$_GET['name'];
$kind='/'.$_GET['kind'];

$cre_from='http://'.$mkt_ip[$mkt].'/graphs/queue'.$name.$kind.'.gif';

$img1 = imagecreatefromgif($cre_from);
header('Content-Type: image/gif');
imagepng($img1);
imagedestroy($img1);
?>