<?php

if ( isset($_GET['mac']) && !empty($_GET['mac']) ) { $mac=$_GET['mac']; // if mac begin

print "<center><strong>$mac</strong></center>\n";
	$st_mkt1=ssh_query("/ip dhcp-server lease print value-list where mac-address='$mac'",1);
	$col1=count($st_mkt1)-1;
	print "<pre>\n";
	$i=0;
	while ( $i < $col1 ) {
		if ( $i == 0 ) {
			$ip_arr=explode(':',$st_mkt1[$i]);
			$temp_ip=trim($ip_arr[1]);
			print $st_mkt1[$i]; print "&nbsp;<a href=\"javascript:void(0);\" onclick=\"javascript:loadScript('load_s/ping_ip.php?ip=$temp_ip'); var res = document.getElementById('result'); res.innerHTML='wait...';\"><img src=\"img/sync.png\" border=\"0\" title=\"Ping\" /></a>&nbsp;<span id=\"result\"></span>\n";
		} else {
			print $st_mkt1[$i]."\n";
		}
		$i++;
	}
	print "</pre>\n";
	$arr_ven=explode(':',$mac);
	$vendor=$arr_ven[0].$arr_ven[1].$arr_ven[2];
	$vendor=exec("cat ./load_s/vendors | grep $vendor");
	if ( strlen($vendor) == 0 ) { $vendor='not found'; }
	#$vendor='111111 wegfnhbvcsvfd';
	print "Vendor local: $vendor<br><br>\n";
	// api begin
	$url = "http://api.macvendors.com/" . urlencode($mac);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	if(!$response) {
		$response='not found';
	}
	print "Vendor api: $response<br>\n";
	// api end
} // if mac end
else { print "<br><center>MAC не выбран<center>\n"; }
?>