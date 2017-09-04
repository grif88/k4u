<?php
error_reporting('~E_NOTICE');
if ( isset($_GET['streets']) ) {
	print "<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr align=\"center\" class=\"clr_back_grey\"><td>id</td><td>poss</td><td>ip_pool</td><td>counter</td><td>code</td><td>street</td></tr>\n";
	$res=mysql_query("SELECT `id`,`poss`,`ip_pool`,`counter`,`code`,`street` FROM `t_streets` ORDER BY `ip_pool`");
	while ( $tmp=mysql_fetch_assoc($res) ) {
		$id=$tmp['id'];
		$poss=$tmp['poss'];
		$ip_pool=$tmp['ip_pool'];
		$counter=$tmp['counter'];
		$code=$tmp['code'];
		$street=$tmp['street'];
		print "<tr><td>$id</td><td>$poss</td><td>$ip_pool</td><td>$counter</td><td>$code</td><td>$street</td></tr>\n";
	}
	print "</table>\n";
} else if ( isset($_GET['mac']) ) {
	exec("cat ./load_s/vendors | grep \"(base 16)\"",$vends);
	#print_r($vends);
	#$tmparr1=explode("\t",$vends[2226]);
	#print_r($tmparr1);
	#$tmparr1=explode(" ",$tmparr1[0]);
	#print_r($tmparr1);
	foreach ( $vends as $str1 ) {
		$tmparr1=explode("\t",$str1);
		$tm=$tmparr1[2];
		$tmparr1=explode(" ",$tmparr1[0]);
		$mac_base16=$tmparr1[2];
		$vendors[$mac_base16]=$tm;
	}
	#print_r($vendors);
	$res=mysql_query("SELECT `cl_mac` FROM `d_cl_list` WHERE `cl_mac` IS NOT NULL AND `cl_mac` != ''");
	$finsumm=0;
	while ( $tmp=mysql_fetch_assoc($res) ) {
		$tmpmac=$tmp['cl_mac'];
		$tmpmac=$tmpmac[0].$tmpmac[1].$tmpmac[2].$tmpmac[3].$tmpmac[4].$tmpmac[5].$tmpmac[6].$tmpmac[7];
		$vendor=$tmpmac[0].$tmpmac[1].$tmpmac[3].$tmpmac[4].$tmpmac[6].$tmpmac[7];
		$tm=$vendors[$vendor];
		if ( isset($arr1[$tm]) and !empty($arr1[$tm]) ) { $arr1[$tm]++; } else { $arr1[$tm]=1; }
		$finsumm++;
	}
	#print_r($arr1);
	print "<table class=\"table_st-none\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\">
<tr align=\"center\" class=\"clr_back_grey\"><td>№</td><td>TM</td><td>Количество</td><td>%</td></tr>\n";
	arsort($arr1);
	$finperc=0;
	$pp=1;
	foreach ( $arr1 as $tm => $summ ) {
		$perc=$summ/$finsumm*100;
		#$vendor=exec("cat ./load_s/vendors | grep $vendor");
		if ( strlen($vendor) == 0 ) { $vendor='not found'; }
		print "<tr><td>$pp</td><td>$tm</td><td>$summ</td><td>".round($perc,3)."</td></tr>\n";
		#$finsumm+=$summ;
		$finperc+=$perc;
		$pp++;
	}
	print "<tr><td colspan=\"2\">Всего</td><td>$finsumm</td><td>$finperc</td></tr>\n";
	print "</table><br>\n";
	#print 'Всего: '.$finsumm."\n";
	#print_r($arr1);
} else {
	print "<a href=\"img/maps/mapSheva1.png\" target=\"Map\">&lt;Шевченко&gt;</a><br>
<br>
<a href=\"img/maps/main.gif\" target=\"Shem1\">[main]</a>&nbsp;
<a href=\"img/maps/mir8_shem.gif\" target=\"Shem1\">[mir8_shem]</a>&nbsp;
<a href=\"img/maps/optic_kul.gif\" target=\"Shem1\">[optic_kul]</a>&nbsp;
<a href=\"img/maps/optic_sheva.gif\" target=\"Shem1\">[optic_sheva]</a>&nbsp;
<a href=\"img/maps/boz_shem.gif\" target=\"Shem1\">[boz_shem]</a><br>
<br>
<a href=\"img/maps/shemKylik.gif\" target=\"Shem2\">[shemKylik]</a>&nbsp;|
<a href=\"img/maps/shemShevaAll.gif\" target=\"Shem2\">[shemShevaAll]</a>&nbsp;
<a href=\"img/maps/shemShevaL.gif\" target=\"Shem2\">[shemShevaL]</a>&nbsp;
<a href=\"img/maps/shemShevaR.gif\" target=\"Shem2\">[shemShevaR]</a>&nbsp;|
<a href=\"img/maps/shemBoz1.gif\" target=\"Shem2\">[shemBoz1]</a>&nbsp;
<a href=\"img/maps/shemBoz2.gif\" target=\"Shem2\">[shemBoz2]</a>&nbsp;
<a href=\"img/maps/shemBoz3.gif\" target=\"Shem2\">[shemBoz3]</a><br>
<br>
<a href=\"img/maps/vlans.txt\" target=\"txt\">[vlans.txt]</a>&nbsp;
<a href=\"img/maps/dns.txt\" target=\"txt\">[dns.txt]</a>&nbsp;
<a href=\"img/maps/dhcp1.txt\" target=\"txt\">[dhcp1.txt]</a>&nbsp;
<a href=\"img/maps/dhcp2.txt\" target=\"txt\">[dhcp2.txt]</a>&nbsp;
<a href=\"img/maps/ppp.txt\" target=\"txt\">[ppp.txt]</a>&nbsp;
<a href=\"img/maps/nat.txt\" target=\"txt\">[nat.txt]</a>&nbsp;
<a href=\"?cmd=view_map&mac\" target=\"_self\">[mac]</a>&nbsp;
<a href=\"?cmd=view_map&streets\" target=\"_self\">[streets]</a><br>
<br>
<a href=\"img/maps/comps.txt\" target=\"txt\">[железо]</a><br>
<br>
<a href=\"files/\" target=\"files1\">Files on server</a><br>\n";
}
?>