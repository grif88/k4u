<?php
$dir='/var/log/graph/';
if ( isset($_GET['file']) and !empty($_GET['file']) ) { // GLOBAL
$file=$dir.$_GET['file'];
if ( isset($_GET['title']) and !empty($_GET['title']) ) { $title=$_GET['title']; } else { $title='title'; }
if ( isset($_GET['units']) and !empty($_GET['units']) ) { $units=$_GET['units']; } else { $units='un'; }
if ( isset($_GET['round']) and !empty($_GET['round']) ) { $round=$_GET['round']; } else { $round=1; }
if ( isset($_GET['color']) and !empty($_GET['color']) ) { $color=$_GET['color']; } else { $color='0,0,0'; }
if ( isset($_GET['color2']) and !empty($_GET['color2']) ) { $color2=$_GET['color2']; } else { $color2='0,0,0'; }
$col_arr=explode(',', $color);
$col2_arr=explode(',', $color2);

$hour=date('G');
$minute=date('i');

header ('Content-Type: image/png');

if ( isset($file2)) { unset($file2); }
$kol_str=501*6;
exec("tail -n $kol_str $file 2> /dev/null", $file3);
$kk=0;
$cikl=1;
$tmp_value=0;
while ( $kk < count($file3) ) {
    $tmp_value+=$file3[$kk];
    if ( $cikl == 6 ) {
		$file2[]=$tmp_value/6;
		$tmp_value=0;
		$cikl=1;
	} else { $cikl++; }
    $kk++;
}
if ( isset($file3)) { unset($file3); }
$img1 = imagecreatetruecolor(600, 200); // picture
$bgcol1 = imagecolorallocate($img1, 255, 255, 255); // white
$linecol1 = imagecolorallocate($img1, 0, 0, 0); // black
$linecol2 = imagecolorallocate($img1, 180, 180, 180); // grey
$linecol3 = imagecolorallocate($img1, $col_arr[0], $col_arr[1], $col_arr[2]); // lime
$linecol4 = imagecolorallocate($img1, $col2_arr[0], $col2_arr[1], $col2_arr[2]); // blue
$txtcol1 = imagecolorallocate($img1, 0, 0, 0); // black
$txtcol2 = imagecolorallocate($img1, 255, 0, 0); // red
$txtcol3 = imagecolorallocate($img1, 0, 150, 0); // green
$txtcol4 = imagecolorallocate($img1, 255, 140, 0); // orange

// print
imagefill($img1, 0, 0, $bgcol1); // fill

if ( !empty($file2) ) { // normal graphing

// graphing
$min_z=round(min($file2),$round);
$max_z=round(max($file2),$round);
$max_z2_abs=array(abs($min_z),abs($max_z));
$max_z2=round(max($max_z2_abs)*1.05,$round);
#if ( $max_z2 < 1 ) { $max_z2=1; }
if ( isset($_GET['max']) and !empty($_GET['max']) ) { $max_z2=$_GET['max']; }
$j=count($file2)-1;
$kol_el=count($file2);
$cur_z=round($file2[$j],$round);
$tmp_ave=0;
$cost_d=150/$max_z2;
$start_pos_x=590;
$fix_pos_y=160;
while ( $j >= 0 ) {
    $tmp_ave+=$file2[$j];
    $pos_up_y=$fix_pos_y-round($cost_d*abs($file2[$j]),0);
    if ( $file2[$j] >= 0 ) { $tmpcolor = $linecol3; } else { $tmpcolor = $linecol4; }
    imageline($img1, $start_pos_x, $fix_pos_y, $start_pos_x, $pos_up_y, $tmpcolor);
    #print $pos_up_y."\n";
    $start_pos_x--;
    #print $file2[$j]."\n";
    $j--;
}
$ave_z=round($tmp_ave/$kol_el,$round);
$level1_z=round($max_z2/4,$round);
$level2_z=round($max_z2/4*2,$round);
$level3_z=round($max_z2/4*3,$round);

} else { // error graphing
$min_z='err';
$cur_z='err';
$ave_z='err';
$max_z='err';
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
$temp1=explode('.', $minute/30);
$kolpix=($hour*2)+$temp1[0]+1;
$tit_day=array(1=>'Mon','Tue','Wed','Thu','Fri','Sat','Sun');
$tmp_day=date('N');
$jj=0;
for ($i=591-$kolpix; $i>=90; $i-=48){
    imagedashedline($img1, $i, 10, $i, 160, $linecol2); // vertical line
    $xpos=$i+15;
    if ( $jj == 0 && $hour <= 12 ) {
	$jj=1;
    } else {
	imagestring($img1, 2, $xpos, 161, $tit_day[$tmp_day], $txtcol1); // day name
	$jj=1;
    }
    if ( $tmp_day == 1 ) { $tmp_day=7; } else { $tmp_day--; }
}

// comment
imagestring($img1, 4, 30, 178, "max = $max_z $units", $txtcol2); // max
imagestring($img1, 4, 175, 178, "min = $min_z $units", $txtcol3); // min
imagestring($img1, 4, 320, 178, "ave = $ave_z $units", $txtcol4); // ave
imagestring($img1, 4, 465, 178, "cur = $cur_z $units", $txtcol1); // cur
imagestringup($img1, 4, 12, 140, $title, $txtcol1); // title
$tmp_time=date('Y-m-d H:i:s');
imagestringup($img1, 4, 0, 160, $tmp_time, $txtcol1); // title

// show and destroy image
imagepng($img1);
imagedestroy($img1);
} // GLOBAL
?>