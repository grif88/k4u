<?php
$dir='/var/log/graph/';
if ( isset($_GET['file']) and !empty($_GET['file']) ) { // GLOBAL
$file=$dir.$_GET['file'];
if ( isset($_GET['title']) and !empty($_GET['title']) ) { $title=$_GET['title']; } else { $title='title'; }
if ( isset($_GET['units']) and !empty($_GET['units']) ) { $units=$_GET['units']; } else { $units='un'; }
if ( isset($_GET['round']) and !empty($_GET['round']) ) { $round=$_GET['round']; } else { $round=0; }
if ( isset($_GET['color']) and !empty($_GET['color']) ) { $color=$_GET['color']; } else { $color='0,0,0'; }
if ( isset($_GET['color2']) and !empty($_GET['color2']) ) { $color2=$_GET['color2']; } else { $color2='0,0,0'; }
$col_arr=explode(',', $color);
$col2_arr=explode(',', $color2);

$hour=date('G');
$minute=date('i');

header ('Content-Type: image/png');

if ( isset($file2)) { unset($file2); }
if ( isset($file3)) { unset($file3); }
exec('tail -n 501 '.$file.' 2> /dev/null | cut -d "/" -f 1 2> /dev/null', $file2);
exec('tail -n 501 '.$file.' 2> /dev/null | cut -d "/" -f 2 2> /dev/null', $file3);
$img1 = imagecreatetruecolor(600, 200); // picture
$bgcol1 = imagecolorallocate($img1, 255, 255, 255); // white
$linecol1 = imagecolorallocate($img1, 0, 0, 0); // black
$linecol2 = imagecolorallocate($img1, 180, 180, 180); // grey
$linecol3 = imagecolorallocate($img1, $col_arr[0], $col_arr[1], $col_arr[2]); // color
$linecol4 = imagecolorallocate($img1, $col2_arr[0], $col2_arr[1], $col2_arr[2]); // color2
$txtcol1 = imagecolorallocate($img1, 0, 0, 0); // black
$txtcol2 = imagecolorallocate($img1, 255, 0, 0); // red
$txtcol3 = imagecolorallocate($img1, 0, 150, 0); // green
$txtcol4 = imagecolorallocate($img1, 255, 140, 0); // orange

// print
imagefill($img1, 0, 0, $bgcol1); // fill

if ( !empty($file2) and !empty($file3) ) { // normal graphing

// graphing
$min_z=round(min($file2),$round);
$max_z=round(max($file2),$round);
$min_z3=round(min($file3),$round);
$max_z3=round(max($file3),$round);
if ( $max_z > $max_z3 ) { $max_z2=round($max_z*1.05,$round); } else { $max_z2=round($max_z3*1.05,$round); }
if ( $max_z2 < 1 ) { $max_z2=1; }
$j=count($file2)-1;
$j3=count($file3)-1;
$j31=$j3;
$kol_el=count($file2);
$kol_el3=count($file3);
$cur_z=round($file2[$j],$round);
$cur_z3=round($file3[$j3],$round);
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
$ave_z=round($tmp_ave/$kol_el,$round);
$ave_z3=round($tmp_ave3/$kol_el3,$round);
$level1_z=round($max_z2/4,$round);
$level2_z=round($max_z2/4*2,$round);
$level3_z=round($max_z2/4*3,$round);

} else { // error graphing
$min_z='err';
$min_z3='err';
$cur_z='err';
$cur_z3='err';
$ave_z='err';
$ave_z3='err';
$max_z='err';
$max_z3='err';
$max_z2='err';
$level1_z='err';
$level2_z='err';
$level3_z='err';
} // end graphing

// after graphing
imagedashedline($img1, 90, 48, 590, 48, $linecol2); // center line 1
imagedashedline($img1, 90, 85, 590, 85, $linecol2); // center line 2
imagedashedline($img1, 90, 122, 590, 122, $linecol2); // center line 3
imagerectangle($img1, 89, 9, 591, 161, $linecol1); // border
imagestring($img1, 2, 40, 3, $max_z2, $txtcol1); // max
imagestring($img1, 2, 40, 41, $level3_z, $txtcol1); // level 3
imagestring($img1, 2, 40, 78, $level2_z, $txtcol1); // level 2
imagestring($img1, 2, 40, 115, $level1_z, $txtcol1); // level 1
imagestring($img1, 2, 40, 153, 'zero', $txtcol1); // zero

// vertical lines
$temp1=explode('.', $minute/5);
$kolpix=$temp1[0]+1;
$tmp_hour=$hour;
for ($i=591-$kolpix; $i>=90; $i-=24){
    if ( $tmp_hour <=9 ) { $xpos=$i-2; } else { $xpos=$i-5; } // move X poss number of hour
    imagedashedline($img1, $i, 10, $i, 160, $linecol2); // vertical line
    imagestring($img1, 2, $xpos, 161, $tmp_hour, $txtcol1); // number of hour
    #print "$i\n";
    if ( $tmp_hour == 0 ) { $tmp_hour = 22; }
    else if ( $tmp_hour == 1 ) { $tmp_hour = 23; }
    else { $tmp_hour-=2; }
}

// comment
imagestring($img1, 3, 30, 172, "max = $max_z $units", $txtcol2); // max
imagestring($img1, 3, 175, 172, "min = $min_z $units", $txtcol3); // min
imagestring($img1, 3, 320, 172, "ave = $ave_z $units", $txtcol4); // ave
imagestring($img1, 3, 465, 172, "cur = $cur_z $units", $txtcol1); // cur
imagestring($img1, 3, 8, 172, 'Rx', $linecol3); // info
imagestring($img1, 3, 30, 184, "max = $max_z3 $units", $txtcol2); // max 3
imagestring($img1, 3, 175, 184, "min = $min_z3 $units", $txtcol3); // min 3
imagestring($img1, 3, 320, 184, "ave = $ave_z3 $units", $txtcol4); // ave 3
imagestring($img1, 3, 465, 184, "cur = $cur_z3 $units", $txtcol1); // cur 3
imagestring($img1, 3, 8, 184, 'Tx', $linecol4); // info 3
imagestringup($img1, 4, 12, 140, $title, $txtcol1); // title
$tmp_time=date('Y-m-d H:i:s');
imagestringup($img1, 4, 0, 160, $tmp_time, $txtcol1); // title

// show and destroy image
imagepng($img1);
imagedestroy($img1);
} // GLOBAL
?>