<?php

if ( isset($_GET['ip']) && !empty($_GET['ip']) ) { $cl_ip=$_GET['ip']; // if ip begin

print "<center><strong>$cl_ip</strong></center>\n";
	$st_mkt1=ssh_query("/ip firewall connection print | grep '$cl_ip:'",1);
	$st_mkt2=ssh_query("/ip firewall connection print | grep '$cl_ip:'",2);
	$col1=count($st_mkt1);
	$col2=count($st_mkt2);
	print "<strong>MKT1 ($col1)</strong>\n<pre>\n";
	$i=0;
	while ( $i < $col1 ) {
		print $st_mkt1[$i]."\n";
		$i++;
	}
	print "</pre><hr><strong>MKT2 ($col2)</strong>\n<pre>\n";
	$i=0;
	while ( $i < $col2 ) {
		print $st_mkt2[$i]."\n";
		$i++;
	}
	print "</pre>\n";
} // if ip end
else { print "<br><center>IP не выбран<center>\n"; }
?>