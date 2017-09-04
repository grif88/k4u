<?php
include '../../include/global.php';
$login=$_GET['login'];

// 1
$src='http://'.$mkt_ip[1].'/graphs/iface/'."<pppoe-$login>".'/daily.gif';
$img1 = imagecreatefromgif($src);
$y1 = imagesy($img1);
imagedestroy($img1);
// 2
$src2='http://'.$mkt_ip[2].'/graphs/iface/'."<pppoe-$login>".'/daily.gif';
$img2 = imagecreatefromgif($src2);
$y2 = imagesy($img2);
imagedestroy($img2);

if ( $y1 > 17 && $y2 > 17 ) {
	$state = imagecreatefrompng('st_alarm.png');
	# $black = imagecolorallocate($state, 0, 0, 0);
	# imagestring($state, 5, 4, 0, "X", $black);
} else if ( $y1 > 17 ) {
	$state = imagecreatefrompng('st_online.png');
	$black = imagecolorallocate($state, 0, 0, 0);
	imagestring($state, 5, 4, 0, "1", $black);
} else if ( $y2 > 17 ) {
	$state = imagecreatefrompng('st_online.png');
	$black = imagecolorallocate($state, 0, 0, 0);
	imagestring($state, 5, 4, 0, "2", $black);
} else {
	$state = imagecreatefrompng('st_offline.png');
}

$state2 = imagecreatetruecolor(16, 16);
$color1 = imagecolorallocate($state2, 204, 255, 204);
imagefill($state2, 0, 0, $color1);
imagecopy($state2, $state, 0, 0, 0, 0, 16, 16);

header('Content-Type: image/png');
imagepng($state2); 
imagedestroy($state);
imagedestroy($state2);
?>