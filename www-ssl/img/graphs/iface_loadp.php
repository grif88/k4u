<?php
include '../../include/admin.php';
include '../../include/global.php';

header ('Content-Type: image/png');

if ( isset($_GET['mkt']) && !empty($_GET['mkt']) && isset($_GET['mib']) && !empty($_GET['mib']) ) {
	$mkt=$_GET['mkt'];
	$mib1=$_GET['mib'];
	#$r=exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.31.1.1.1.7.'.$mib1); // Rx packets
	#$t=exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.31.1.1.1.11.'.$mib1);// Tx packets
	exec('snmpget -v 2c -r 3 -t 1 -Oqv -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.31.1.1.1.7.'.$mib1.' .1.3.6.1.2.1.31.1.1.1.11.'.$mib1.' .1.3.6.1.2.1.1.3.0',$snmpans); // full answer
	$r=$snmpans[0];
	$t=$snmpans[1];
	$uptimeA=explode(':',$snmpans[2]);
	$uptime=$uptimeA[0]*86400+$uptimeA[1]*3600+$uptimeA[2]*60+$uptimeA[3];
	$timeint=1;
	$res=mysql_query("SELECT `uptime`,`prevval` FROM `t_temp_load` WHERE `mkt`='$mkt' AND `type`='rp' AND `user`='$php_user' ORDER BY `id` DESC LIMIT 0,1");
	if ( mysql_num_rows($res) == 1 ) {
		while ( $tmp=mysql_fetch_assoc($res) ){
			$rprev=$tmp['prevval'];
			$prevuptime=$tmp['uptime'];
			$timeint=$uptime-$prevuptime;
			if ( $timeint == 0 ) { continue; }
			$r2=(($r)-$rprev)/$timeint;
			$r2=abs(round($r2,3));
		}
	} else {
		$r2=0;
	}
	$rprev=$r;
	$res=mysql_query("SELECT `uptime`,`prevval` FROM `t_temp_load` WHERE `mkt`='$mkt' AND `type`='tp' AND `user`='$php_user' ORDER BY `id` DESC LIMIT 0,1");
	if ( mysql_num_rows($res) == 1 ) {
		while ( $tmp=mysql_fetch_assoc($res) ){
			$tprev=$tmp['prevval'];
			$prevuptime=$tmp['uptime'];
			$timeint=$uptime-$prevuptime;
			if ( $timeint == 0 ) { continue; }
			$t2=(($t)-$tprev)/$timeint;
			$t2=abs(round($t2,3));
		}
	} else {
		$t2=0;
	}
	$tprev=$t;
	if ( $timeint != 0 ) {
		mysql_query("INSERT INTO `t_temp_load` (`uptime`,`prevval`,`val`,`mkt`,`type`,`user`) VALUES ('$uptime','$rprev','$r2','$mkt','rp','$php_user')");
		mysql_query("INSERT INTO `t_temp_load` (`uptime`,`prevval`,`val`,`mkt`,`type`,`user`) VALUES ('$uptime','$tprev','$t2','$mkt','tp','$php_user')");
	}
	//----------------------------------------------
// picture
$img1 = imagecreatetruecolor(600, 200); // picture
$bgcol1 = imagecolorallocate($img1, 255, 255, 255); // white
$linecol1 = imagecolorallocate($img1, 0, 0, 0); // black
$linecol2 = imagecolorallocate($img1, 180, 180, 180); // grey
$linecol3 = imagecolorallocate($img1, 255, 200, 0); // r line
$linecol4 = imagecolorallocate($img1, 100, 0, 200); // t line
$txtcol1 = imagecolorallocate($img1, 0, 0, 0); // black
$txtcol2 = imagecolorallocate($img1, 255, 0, 0); // red
$txtcol3 = imagecolorallocate($img1, 0, 150, 0); // green
$txtcol4 = imagecolorallocate($img1, 255, 140, 0); // orange

// print
imagefill($img1, 0, 0, $bgcol1); // fill

// select r
	$res2=mysql_query("SELECT `val` FROM `t_temp_load` WHERE `mkt`='$mkt' AND `type`='rp' AND `user`='$php_user' ORDER BY `id` DESC LIMIT 0,501");
	$res_kol2=mysql_num_rows($res2)-1;
	while ( $tmp2=mysql_fetch_assoc($res2) ){
		$file2[$res_kol2]=$tmp2['val'];
		$res_kol2--;
	}
// select t
	$res3=mysql_query("SELECT `val` FROM `t_temp_load` WHERE `mkt`='$mkt' AND `type`='tp' AND `user`='$php_user' ORDER BY `id` DESC LIMIT 0,501");
	$res_kol3=mysql_num_rows($res3)-1;
	while ( $tmp3=mysql_fetch_assoc($res3) ){
		$file3[$res_kol3]=$tmp3['val'];
		$res_kol3--;
	}

// graphing
$min_z=round(min($file2),1);
$max_z=round(max($file2),1);
$min_z3=round(min($file3),1);
$max_z3=round(max($file3),1);
if ( $max_z > $max_z3 ) { $max_z2=round($max_z*1.05,1); } else { $max_z2=round($max_z3*1.05,1); }
#$max_z2=round($max_z*1.1,1);
if ( $max_z2 < 1 ) { $max_z2=1; }
#$max_z2=100;
$j=count($file2)-1;
$j3=count($file3)-1;
$j31=$j3;
$kol_el=count($file2);
$kol_el3=count($file3);
$cur_z=round($file2[$j],1);
$cur_z3=round($file3[$j3],1);
$tmp_ave=0;
$tmp_ave3=0;
$cost_d=150/$max_z2;
$start_pos_x=590;
$fix_pos_y=160;
while ( $j >= 0 ) {
    $tmp_ave+=$file2[$j];
    $pos_up_y=$fix_pos_y-round($cost_d*$file2[$j],0);
    imageline($img1, $start_pos_x, $fix_pos_y, $start_pos_x, $pos_up_y, $linecol3);
    #print $pos_up_y."\n";
    $start_pos_x--;
    #print $file2[$j]."\n";
    $j--;
}
$start_pos_x=590;
while ( $j3 >= 0 ) {
    $tmp_ave3+=$file3[$j3];
	if ( $j3 == $j31 ) { $first_pos_x=$start_pos_x; $first_pos_y=$fix_pos_y-round($cost_d*$file3[$j3],0); }
	else {
    	$pos_up_y3=$fix_pos_y-round($cost_d*$file3[$j3],0);
    	imageline($img1, $first_pos_x, $first_pos_y, $start_pos_x, $pos_up_y3, $linecol4);
		$first_pos_x=$start_pos_x;
		$first_pos_y=$pos_up_y3;
	}
    $start_pos_x--;
    $j3--;
}
$ave_z=round($tmp_ave/$kol_el,1);
$ave_z3=round($tmp_ave3/$kol_el3,1);
$level1_z=round($max_z2/4,1);
$level2_z=round($max_z2/4*2,1);
$level3_z=round($max_z2/4*3,1);

// after graphing
imagedashedline($img1, 90, 48, 590, 48, $linecol2); // line 1
imagedashedline($img1, 90, 85, 590, 85, $linecol2); // line 2
imagedashedline($img1, 90, 122, 590, 122, $linecol2); // line 3
imagerectangle($img1, 89, 9, 591, 161, $linecol1); // ramka
imagestring($img1, 2, 40, 3, $max_z2, $txtcol1); // max
imagestring($img1, 2, 40, 41, $level3_z, $txtcol1); // level 3
imagestring($img1, 2, 40, 78, $level2_z, $txtcol1); // level 2
imagestring($img1, 2, 40, 115, $level1_z, $txtcol1); // level 1
imagestring($img1, 2, 40, 153, 'zero', $txtcol1); // zero

// comment
imagestring($img1, 3, 30, 168, "max = $max_z p/s", $txtcol2); // max
imagestring($img1, 3, 175, 168, "min = $min_z p/s", $txtcol3); // min
imagestring($img1, 3, 320, 168, "ave = $ave_z p/s", $txtcol4); // ave
imagestring($img1, 3, 465, 168, "cur = $cur_z p/s", $txtcol1); // cur
imagestring($img1, 3, 8, 168, 'Rx', $linecol3); // info
imagestring($img1, 3, 30, 180, "max = $max_z3 p/s", $txtcol2); // max 3
imagestring($img1, 3, 175, 180, "min = $min_z3 p/s", $txtcol3); // min 3
imagestring($img1, 3, 320, 180, "ave = $ave_z3 p/s", $txtcol4); // ave 3
imagestring($img1, 3, 465, 180, "cur = $cur_z3 p/s", $txtcol1); // cur 3
imagestring($img1, 3, 8, 180, 'Tx', $linecol4); // info 3
imagestringup($img1, 4, 12, 150, 'packets per 2 sec', $txtcol1); // title
$tmp_time=date('Y-m-d H:i:s');
imagestringup($img1, 4, 0, 160, $tmp_time, $txtcol1); // title

// save and destroy image
imagepng($img1);
imagedestroy($img1);
}
?>