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
exec("tail -n 501 $file 2> /dev/null", $file2);
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