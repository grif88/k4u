<?php

if ( isset($_GET['login']) ) { $login=$_GET['login']; // if login begin

if ( isset($_GET['time']) ) {
 $time=$_GET['time'];
 $title=$time." [$login]";
 exec("cd /var/log/mkt; ls -v -r | xargs cat | grep '$time'",$arr1);
} else if ( isset($_GET['mac']) and !empty($_GET['mac']) ) {
 $mac=$_GET['mac'];
 $title=$login.' - '.$mac;
 exec("cd /var/log/mkt; ls -v -r | xargs cat | grep \"$login\|$mac\" | tail -n 20000",$arr1);
} else {
 $title=$login;
 exec("cd /var/log/mkt; ls -v -r | xargs cat | grep \"$login\" | tail -n 20000",$arr1);
}

print "<center><strong>$title</strong></center>\n";

$col1=count($arr1);
#var_dump($arr1);
print '<pre>';
$spoiler=0;
$el_col=0;
$i=$col1-1;
while ( $i >= 0 ) {
	$pos11 = strpos($arr1[$i],'terminating...');
	$j=$i-1;
	if ( $j >= 0 ) { $pos22 = strpos($arr1[$j],'terminating...'); } else { $pos22 = 0; }
	$ch1 = array('<','>');
    $rs1 = array('&lt;','&gt;');
    $temp1 = str_replace($ch1,$rs1,$arr1[$i]);
	if ( $pos11 == $pos22 && $spoiler == 0 && $pos11 > 0 ) {
		$spoiler=1;
		$el_col=1;
		print "\n$temp1 <a href=\"javascript:toggle('$i');\" id=\"displayText_$i\">показать</a><div id=\"toggleText_$i\" style=\"display:none;\"><hr>";
	}
	$spos1=strpos($temp1,'logged in,');
	$spos2=strpos($temp1,'logged out,');
	$spos3=strpos($temp1,'PPPoE connection');
	if ( $spos1 > 0 ) { $temp_col='#0000FF'; }
	else if ( $spos2 > 0 ) { $temp_col='#FF0000'; }
	else if ( $spos3 > 0 ) { $temp_col='#B043B5'; }
	else { $temp_col='#A0A0A0'; }
	$str_time=substr($temp1,0,12);
	$str_data=substr($temp1,12);
    print "<font color=$temp_col><a href=\"?win&cmd=mkt_log&login=$login&time=$str_time\">$str_time</a>".$str_data."</font>";
	if ( $spos2 > 0 ) {
	 $temp2=explode(' ', substr($temp1,16));
	 $tmp_min=explode('.', $temp2[4]/60);
	 $ses_r=round($temp2[6]/1024/1024, 3);
	 $ses_t=round($temp2[5]/1024/1024, 3);
	 $ses_time=$tmp_min[0];
	 print " <span style=\"text-decoration:underline;\">Время: $ses_time мин</span> | Rx: $ses_r MB | Tx: $ses_t MB";
	}
	print "\n";
    $i--;
	if ( $pos11 != $pos22 && $spoiler == 1 && $pos11 > 0 ) { print "<hr></div><strong> $el_col шт</strong><br>\n"; $spoiler = 0; } else { $el_col++; }
}
print "</pre>\n";

} // if login end
else { print "<br><center>login не выбран<center>\n"; }
?>