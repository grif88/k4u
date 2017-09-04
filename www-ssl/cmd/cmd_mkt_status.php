<?php

if ( isset($_GET['login']) ) { $login=$_GET['login']; // if login begin

print "<center><strong>$login</strong></center>\n";

	$st_mkt1=ssh_query("/ppp active print where name=$login\; /ppp secret print detail where name=$login\; /queue simple print where name=$login",1);
	$st_mkt2=ssh_query("/ppp active print where name=$login\; /ppp secret print detail where name=$login\; /queue simple print where name=$login",2);
	$col1=count($st_mkt1)-1;
	$col2=count($st_mkt2)-1;
	print "<pre>\n";
	$i=0;
	while ( $i < $col1 ) {
		if ( $i == 2 && !empty($st_mkt1[$i]) ) {
			if ( strpos($st_mkt1[$i], '10.11.') == 44 ) {
				print '<font color="#FF0000">'.$st_mkt1[$i].'</font>';
			} else {
				print '<font color="#0000FF">'.$st_mkt1[$i].'</font>';
			}
			print '&nbsp;';
			popup_iface("cmd=iface_graph&mkt=1&login=$login",'iface_win','iface graph',620,520);
			print "\n";
		} else {
			print $st_mkt1[$i]."\n";
		}
		#print $st_mkt1[$i]."\n";
		$i++;
	}
	print "</pre><hr><pre>\n";
	$i=0;
	while ( $i < $col2 ) {
		if ( $i == 2 && !empty($st_mkt2[$i]) ) {
			if ( strpos($st_mkt2[$i], '10.11.') == 44 ) {
				print '<font color="#FF0000">'.$st_mkt2[$i].'</font>';
			} else {
				print '<font color="#0000FF">'.$st_mkt2[$i].'</font>';
			}
			print '&nbsp;';
			popup_iface("cmd=iface_graph&mkt=2&login=$login",'iface_win','iface graph',620,520);
			print "\n";
		} else {
			print $st_mkt2[$i]."\n";
		}
		#print $st_mkt2[$i]."\n";
		$i++;
	}
	print "</pre>\n";

} // if login end
else { print "<br><center>login не выбран<center>\n"; }
?>