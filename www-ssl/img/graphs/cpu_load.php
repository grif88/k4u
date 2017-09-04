<?php
include '../../include/admin.php';
include '../../include/global.php';

header ('Content-Type: image/png');

if ( isset($_GET['mkt']) && !empty($_GET['mkt']) ) {
	$mkt=$_GET['mkt'];
	#$arr1[1]=exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.25.3.3.1.2.1 2> /dev/null');
	#$arr1[2]=exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.25.3.3.1.2.2 2> /dev/null');
	exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.25.3.3.1.2.1 .1.3.6.1.2.1.25.3.3.1.2.2 2> /dev/null',$arr1);
	$load2=($arr1[0]+$arr1[1])/2;
	mysql_query("INSERT INTO `t_temp_load` (`val`,`mkt`,`type`,`user`) VALUES ('$load2','$mkt','l','$php_user')");
	$res=mysql_query("SELECT `val` FROM `t_temp_load` WHERE `mkt`='$mkt' AND `type`='l' AND `user`='$php_user' ORDER BY `id` DESC LIMIT 0,501");
	$res_kol=mysql_num_rows($res)-1;
	while ( $tmp=mysql_fetch_assoc($res) ){
		$file2[$res_kol]=$tmp['val'];
		$res_kol--;
	}
// picture
$img1 = imagecreatetruecolor(600, 200); // picture
$bgcol1 = imagecolorallocate($img1, 255, 255, 255); // white
$linecol1 = imagecolorallocate($img1, 0, 0, 0); // black
$linecol2 = imagecolorallocate($img1, 180, 180, 180); // grey
$linecol3 = imagecolorallocate($img1, 0, 180, 0); // lime
$linecol4 = imagecolorallocate($img1, 255, 0, 0); // red
$txtcol1 = imagecolorallocate($img1, 0, 0, 0); // black
$txtcol2 = imagecolorallocate($img1, 255, 0, 0); // red
$txtcol3 = imagecolorallocate($img1, 0, 150, 0); // green
$txtcol4 = imagecolorallocate($img1, 255, 140, 0); // orange

// print
imagefill($img1, 0, 0, $bgcol1); // fill

// graphing
$min_z=round(min($file2),1);
$max_z=round(max($file2),1);
#$max_z2=round($max_z*1.1,1);
#if ( $max_z2 < 1 ) { $max_z2=1; }
$max_z2=100;
$j=count($file2)-1;
$kol_el=count($file2);
$cur_z=round($file2[$j],1);
$tmp_ave=0;
$cost_d=150/$max_z2;
$start_pos_x=590;
$fix_pos_y=160;
while ( $j >= 0 ) {
    $tmp_ave+=$file2[$j];
    $pos_up_y=$fix_pos_y-round($cost_d*$file2[$j],0);
    imageline($img1, $start_pos_x, $fix_pos_y, $start_pos_x, $pos_up_y, $linecol4);
    #print $pos_up_y."\n";
    $start_pos_x--;
    #print $file2[$j]."\n";
    $j--;
}
$ave_z=round($tmp_ave/$kol_el,1);
$level1_z=round($max_z2/4,1);
$level2_z=round($max_z2/4*2,1);
$level3_z=round($max_z2/4*3,1);

// after graphing
imagedashedline($img1, 90, 48, 590, 48, $linecol2); // line 1
imagedashedline($img1, 90, 85, 590, 85, $linecol2); // line 2
imagedashedline($img1, 90, 122, 590, 122, $linecol2); // line 3
imagerectangle($img1, 89, 9, 591, 161, $linecol1); // ramka
imagestring($img1, 2, 55, 3, $max_z2, $txtcol1); // max
imagestring($img1, 2, 55, 41, $level3_z, $txtcol1); // level 3
imagestring($img1, 2, 55, 78, $level2_z, $txtcol1); // level 2
imagestring($img1, 2, 55, 115, $level1_z, $txtcol1); // level 1
imagestring($img1, 2, 55, 153, 'zero', $txtcol1); // zero

// comment
imagestring($img1, 4, 30, 178, "max = $max_z %", $txtcol2); // max
imagestring($img1, 4, 175, 178, "min = $min_z %", $txtcol3); // min
imagestring($img1, 4, 320, 178, "ave = $ave_z %", $txtcol4); // ave
imagestring($img1, 4, 465, 178, "cur = $cur_z %", $txtcol1); // cur
imagestringup($img1, 4, 12, 140, 'load per 2 sec', $txtcol1); // title
$tmp_time=date('Y-m-d H:i:s');
imagestringup($img1, 4, 0, 160, $tmp_time, $txtcol1); // title

// save and destroy image
imagepng($img1);
imagedestroy($img1);
}
?>