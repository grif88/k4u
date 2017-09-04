<?php
include '../../include/global.php';
$mkt=$_GET['mkt'];
if ( !empty($_GET['source']) ) { $source='/'.$_GET['source']; } else { $source=''; }
$name='/'.$_GET['name'];
$kind='/'.$_GET['kind'];

$cre_from='http://'.$mkt_ip[$mkt].'/graphs'.$source.$name.$kind.'.gif';

$img1 = imagecreatefromgif($cre_from);
header('Content-Type: image/gif');
imagepng($img1);
imagedestroy($img1);
?>
