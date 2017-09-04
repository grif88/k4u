<?php
if ( isset($_GET['val']) && !empty($_GET['val']) ) { $val=$_GET['val']; } else { $val=''; }
print "<a href=\"?cmd=dev_log&t=mkt\">mkt</a>(last:20K)&nbsp;
<a href=\"?cmd=dev_log&t=dses\">doble-ses</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=mkt_mac\">NO-mac-lock</a>&nbsp;
<a href=\"?cmd=dev_log&t=sms_alert\">SMS-alert</a>&nbsp;|
<a href=\"?cmd=dev_log&t=sh_top\">TOP</a>&nbsp;
<a href=\"?cmd=dev_log&t=sh_status\">status</a>&nbsp;
<a href=\"?cmd=dev_log&t=mkt_down\">mkt_down</a>&nbsp;|
<a href=\"?cmd=dev_log&t=sensors\">sensors</a>&nbsp;
<a href=\"?cmd=dev_log&t=apc\">apc-st</a><br><br>
<!-- <a href=\"?cmd=dev_log&t=tracer\">tracer</a>&nbsp; -->
<a href=\"?cmd=dev_log&t=switch&val=10.22.0.5\">sw-main</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=switch&val=172.16.0.3\">sw-mir8</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=switch&val=10.22.0.8\">sw-univ58</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=switch&val=10.22.0.9\">sw-pra57</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=switch&val=10.22.0.3\">sw-kyl6</a>(last:10K)&nbsp;
<a href=\"?cmd=dev_log&t=switch&val=10.22.0.6\">sw-kyl3</a>(last:10K)<br>
<br>
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"dev_log\" />
<input required type=\"text\" name=\"val\" maxlength=\"50\" size=\"52\" value=\"$val\" />&nbsp;
<input type=\"submit\" name=\"t\" value=\"ping\" />&nbsp;
<input type=\"submit\" name=\"t\" value=\"trace\" />&nbsp;
<input type=\"submit\" name=\"t\" value=\"host\" /></form>\n";

// ----------------

if ( isset($_GET['t']) ) {
	$t=$_GET['t'];
	if ( isset($_GET['val']) && !empty($_GET['val']) ) { $val=$_GET['val']; } else { $val=''; }
	print "<hr>\n";
	$invert=0;
	if ( $t == 'ping' ) { exec("ping -c 10 -D -W 1 -i 0.2 $val 2> /dev/null",$arr1); }
	if ( $t == 'trace' ) { exec("traceroute $val 2> /dev/null",$arr1); }
	if ( $t == 'host' ) { exec("host $val 2> /dev/null",$arr1); }
	if ( $t == 'switch' ) { exec("cat /var/log/switch.log.1 /var/log/switch.log | grep $val | tail -n 10000",$arr1); $invert=1; }
	if ( $t == 'mkt' ) { exec("tail -n 20000 /var/log/mkt/mkt.log",$arr1); $invert=1; }
	if ( $t == 'dses' ) { exec("tail -n 10000 /var/log/doble_ses.log",$arr1); $invert=1; }
	if ( $t == 'sh_top' ) { exec("top -b | head -150",$arr1); }
	if ( $t == 'sh_status' ) { exec("cat /tmp/server.status",$arr1); }
	if ( $t == 'tracer' ) { exec("ls -1 /var/log/tracer/",$arr1); }
	if ( $t == 'mkt_mac' ) { $arr11=ssh_query('/ppp secret print where caller-id=\"\"',1); $arr22=ssh_query('/ppp secret print where caller-id=\"\"',2); $arr1=array_merge($arr11,$arr22); }
	if ( $t == 'sms_alert' ) { exec("tail -n 10000 /var/log/sms/alert.log",$arr1); $invert=1; }
	if ( $t == 'mkt_down' ) { exec("tail -n 10000 /var/log/mkt_down.log",$arr1); $invert=1; }
	if ( $t == 'apc' ) { exec("cat /tmp/apcupsd.status; echo ''; tail -n 200 /var/log/apcupsd.events | sort -r",$arr1); }
	if ( $t == 'sensors' ) { exec("sensors",$arr1); }
	if ( isset($arr1) ) { $col1=count($arr1); }
	#var_dump($arr1);
	print "<pre>";
	if ( $t == 'tracer' ) {
		if ( empty($_GET['file']) ) {
			$i=0;
			while ( $i < $col1 ) {
				print '<a href="?cmd=dev_log&t=tracer&file='.$arr1[$i].'">'.$arr1[$i]."</a>\n";
				$i++;
			}
		} else {
			$file1=$_GET['file'];
			exec("cat /var/log/tracer/$file1",$arr2);
			$col2=count($arr2);
			$i=0;
			while ( $i < $col2 ) {
				print $arr2[$i]."\n";
				$i++;
			}
			#print "123";
		}
	} else if ( $invert == 0 ) {
		$i=0;
		while ( $i < $col1 ) {
			print $arr1[$i]."\n";
			$i++;
		}
	} else {
		$i=$col1-1;
		while ( $i >= 0 ) {
			if ( $t == 'mkt' ) {
				$ch1 = array('<','>');
				$rs1 = array('&lt;','&gt;');
				$temp1 = str_replace($ch1,$rs1,$arr1[$i]);
				$spos1=strpos($temp1,'logged in,');
				$spos2=strpos($temp1,'logged out,');
				$spos3=strpos($temp1,'PPPoE connection');
				if ( $spos1 > 0 ) { $temp_col='#0000FF'; }
				else if ( $spos2 > 0 ) { $temp_col='#FF0000'; }
				else if ( $spos3 > 0 ) { $temp_col='#B043B5'; }
				else { $temp_col='#A0A0A0'; }
				print "<font color=$temp_col>".$temp1."</font>";
            	if ( $spos2 > 0 ) {
            	 $temp2=explode(' ', substr($temp1,16));
            	 $tmp_min=explode('.', $temp2[4]/60);
            	 $ses_r=round($temp2[6]/1024/1024, 3);
            	 $ses_t=round($temp2[5]/1024/1024, 3);
            	 $ses_time=$tmp_min[0];
            	 print " <span style=\"text-decoration:underline;\">Время: $ses_time мин</span> | Rx: $ses_r MB | Tx: $ses_t MB";
            	}
            	print "\n";
			} else if ( $t == 'dses' ) {
				$tmp_arr1=explode(" ", trim($arr1[$i]));
				$tmp_arr1[2]='<a href="?cmd=view_abon&login='.$tmp_arr1[2].'">'.$tmp_arr1[2].'</a>';
				for ( $j=0; $j < count($tmp_arr1); $j++ ) {
					print $tmp_arr1[$j].' ';
				}
				print "\n";
			} else if ( $t == 'switch' ) {
				$strps11=stripos($arr1[$i],' up, ');
				$strps12=stripos($arr1[$i],' up ');
				$strps13=stripos($arr1[$i],'-up:');
				$strps21=stripos($arr1[$i],' down');
				$strps22=stripos($arr1[$i],'-down:');
				$strps3=stripos($arr1[$i],'DHCP server');
				if ($strps11 !== false or $strps12 !== false or $strps13 !== false) { $temp_col='#0000FF'; }
				else if ($strps21 !== false or $strps22 !== false) { $temp_col='#FF0000'; }
				else if ($strps3 !== false) { $temp_col='#CC6600'; }
				else { $temp_col='#A0A0A0'; }
				unset($strps1,$strps2);
				print "<font color=\"$temp_col\">".$arr1[$i]."</font>\n";
			} else {
				print $arr1[$i]."\n";
			}
			$i--;
		}
	}
	print "</pre>\n";
}

?>