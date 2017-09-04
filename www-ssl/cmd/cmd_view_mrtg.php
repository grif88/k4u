<?php
if ( isset($_GET['mkt']) ) { $serv=$_GET['mkt']; } else { $serv=''; }

print "<center>\n";
if ( $serv == '1' ) { print '&lt;1&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=1\">&lt;1&gt;</a>"; } print "&nbsp;\n";
if ( $serv == '2' ) { print '&lt;2&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=2\">&lt;2&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'stat' ) { print '&lt;Status&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=stat\">&lt;Status&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'packs_mkts' ) { print '&lt;Packets MKTs&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=packs_mkts\">&lt;Packets MKTs&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'switches' ) { print '&lt;SWs&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=switches\">&lt;SWs&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'ping' ) { print '&lt;Ping&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=ping\">&lt;Ping&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'temp' ) { print '&lt;Temp-Volt&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=temp\">&lt;Temp-Volt&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'localhost' ) { print '&lt;localhost&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=localhost\">&lt;localhost&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'graphs' ) { print '&lt;Graphs_queue&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=graphs\">&lt;Graphs_queue&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'online' ) { print '&lt;OnLine&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=online\">&lt;OnLine&gt;</a>"; } print "&nbsp;\n";
if ( $serv == 'errors' ) { print '&lt;errors&gt;'; } else { print "<a href=\"?cmd=view_mrtg&mkt=errors\">&lt;errors&gt;</a>"; } print "\n";
print "</center>\n";

if ( $serv == 1 or $serv == 2 ) {
print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr><td colspan=\"4\"><strong>CPU</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=cpu&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=cpu&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=cpu&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=cpu&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>\n";
if ( $serv ) {
print "<tr><td colspan=\"4\"><strong>eth0</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth0&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth0&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth0&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth0&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>\n";
}
if ( $serv ) {
print "<tr><td colspan=\"4\"><strong>eth1</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth1&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth1&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth1&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=eth1&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>\n";
}
print "<tr><td colspan=\"4\"><strong>vlan95 (канал: 280 Mb/sec)</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan95&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan95&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan95&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan95&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>vlan50</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan50&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan50&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan50&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan50&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>vlan51</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan51&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan51&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan51&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan51&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>vlan52 (канал: 200 Mb/sec)</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan52&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan52&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan52&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan52&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>vlan10 (шейпер: 90 Mb/sec)</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan10&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan10&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan10&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan10&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>vlan100 (шейпер: 5 Mb/sec)</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan100&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan100&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan100&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&source=iface&name=vlan100&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>RAM</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=ram&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=ram&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=ram&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=ram&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"4\">&nbsp;</td></tr>
<tr><td colspan=\"4\"><strong>HDD</strong></td></tr>
<tr>
<td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=hdd&kind=daily\">&nbsp;&nbsp;</td>
<td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=hdd&kind=weekly\">&nbsp;&nbsp;</td>
<td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=hdd&kind=monthly\">&nbsp;&nbsp;</td>
<td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=$serv&name=hdd&kind=yearly\">&nbsp;&nbsp;</td>
</tr>
</table>\n";
} else if ( $serv == 'packs_mkts' ) {
$j=0;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='eth0';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='eth0';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='eth1';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='eth1';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='vlan95';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='vlan95';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='vlan50';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='vlan50';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='vlan51';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='vlan51';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['iface']='vlan52';
$graphs2[$j]['ip']='10.22.0.2';
$graphs2[$j]['iface']='vlan52';
#------------
$get1='title=packets per sec&units=p/s&color=255,200,0&color2=100,0,200';
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
$i=0;
while ( $i <= count($graphs1)-1 ) {
	$ip1=$graphs1[$i]['ip'];
	$iface1=$graphs1[$i]['iface'];
	$file1='packs_'.$ip1.'_'.$iface1.'.log';
	print "<tr><td>$ip1 - $iface1</td>";
	if ( isset($graphs2[$i]['ip']) and isset($graphs2[$i]['iface']) ) {
		$ip2=$graphs2[$i]['ip'];
		$iface2=$graphs2[$i]['iface'];
		print "<td>$ip2 - $iface2</td>";
	}
	print "</tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file1&$get1\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	if ( isset($graphs2[$i]['ip']) and isset($graphs2[$i]['iface']) ) {
		$file2='packs_'.$ip2.'_'.$iface2.'.log';
		print "<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file2&$get1\"></td>";
	}
	print "</tr>
<tr><td>&nbsp;</td></tr>\n";
	$i++;
}
print "</table>\n";
} else if ( $serv == 'switches' ) {
$j=0;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='1';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='2';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='3';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='4';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='5';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='6';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='7';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='9';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='10';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='11';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='25';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='26';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='27';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['iface']='28';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='1';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='2';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='3';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='4';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='5';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='6';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='7';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='8';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='9';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='10';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='11';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='12';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['iface']='28';
$j++;
$graphs1[$j]['ip']='10.22.0.8';
$graphs1[$j]['iface']='15';
$j++;
$graphs1[$j]['ip']='10.22.0.8';
$graphs1[$j]['iface']='16';
$j++;
$graphs1[$j]['ip']='10.22.0.8';
$graphs1[$j]['iface']='17';
$j++;
$graphs1[$j]['ip']='10.22.0.8';
$graphs1[$j]['iface']='18';
$j++;
$graphs1[$j]['ip']='10.22.0.9';
$graphs1[$j]['iface']='16';
$j++;
$graphs1[$j]['ip']='10.22.0.9';
$graphs1[$j]['iface']='17';
$j++;
$graphs1[$j]['ip']='10.22.0.9';
$graphs1[$j]['iface']='18';
$j++;
$graphs1[$j]['ip']='10.22.0.3';
$graphs1[$j]['iface']='5';
$j++;
$graphs1[$j]['ip']='10.22.0.3';
$graphs1[$j]['iface']='26';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='22';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='24';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='25';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='26';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='27';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['iface']='28';
#------------
$get1='title=Kbits per sec&units=Kb/s&color=0,255,0&color2=0,0,255';
$get2='title=packets per sec&units=p/s&color=255,200,0&color2=100,0,200';
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
$i=0;
while ( $i <= count($graphs1)-1 ) {
	$ip1=$graphs1[$i]['ip'];
	$iface1=$graphs1[$i]['iface'];
	$file1='trafic_'.$ip1.'_'.$iface1.'.log';
	$file2='packs_'.$ip1.'_'.$iface1.'.log';
	print "<tr><td>trafic - $ip1 - $iface1</td><td>packets - $ip1 - $iface1</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file1&$get1\">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file2&$get2\"></td>
</tr>
<tr><td>&nbsp;</td></tr>\n";
	$i++;
}
print "</table>\n";
} else if ( $serv == 'ping' ) {
$j=0;
$graphs1[$j]['ip']='93.158.134.3';
$graphs1[$j]['name']='yandex 1 ('.$graphs1[$j]['ip'].') via MKT1';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='93.158.134.25';
$graphs1[$j]['name']='yandex 2 ('.$graphs1[$j]['ip'].') via MKT2';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='93.158.134.1';
$graphs1[$j]['name']='yandex 3 ('.$graphs1[$j]['ip'].') via PR';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='93.158.134.203';
$graphs1[$j]['name']='yandex 4 ('.$graphs1[$j]['ip'].') via MKT1 PR(pppoe-kul3k2)';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='173.194.113.192';
$graphs1[$j]['name']='youtube.com ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='193.187.76.216';
$graphs1[$j]['name']='megogo.net ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='87.240.191.99';
$graphs1[$j]['name']='vk.com ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='91.196.80.49';
$graphs1[$j]['name']='gw ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='91.196.80.2';
$graphs1[$j]['name']='mail.pretcher.dp.ua ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='46.164.136.21';
$graphs1[$j]['name']='pretcher2.10g-kiev-vlan2504.datagroup.ua [World] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='77.88.200.237';
$graphs1[$j]['name']='pretcher2.10g-kiev-vlan2634.top.net.ua [World] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='80.91.177.253';
$graphs1[$j]['name']='pretcher.10g-kiev-vlan2506.datagroup.ua [UA-IX] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='88.81.242.149';
$graphs1[$j]['name']='pretcher3.10g-kiev-vlan2629.top.net.ua [UA-IX] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='193.151.12.35';
$graphs1[$j]['name']='dkm.ua [BackUp] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='10.22.0.5';
$graphs1[$j]['name']='switch-main ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['name']='switch-mir8 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='10.22.0.6';
$graphs1[$j]['name']='switch-kyl3 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['name']='MKT-1 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
$j++;
$graphs1[$j]['ip']='10.22.0.2';
$graphs1[$j]['name']='MKT-2 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='time';
#loss
$j++;
$graphs1[$j]['ip']='93.158.134.3';
$graphs1[$j]['name']='yandex 1 ('.$graphs1[$j]['ip'].') via MKT1';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='93.158.134.25';
$graphs1[$j]['name']='yandex 2 ('.$graphs1[$j]['ip'].') via MKT2';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='93.158.134.1';
$graphs1[$j]['name']='yandex 3 ('.$graphs1[$j]['ip'].') via PR';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='93.158.134.203';
$graphs1[$j]['name']='yandex 4 ('.$graphs1[$j]['ip'].') via MKT1 PR(pppoe-kul3k2)';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='193.187.76.216';
$graphs1[$j]['name']='megogo.net ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='87.240.191.99';
$graphs1[$j]['name']='vk.com ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='91.196.80.49';
$graphs1[$j]['name']='gw ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='91.196.80.2';
$graphs1[$j]['name']='mail.pretcher.dp.ua ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='46.164.136.21';
$graphs1[$j]['name']='pretcher2.10g-kiev-vlan2504.datagroup.ua [World] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='77.88.200.237';
$graphs1[$j]['name']='pretcher2.10g-kiev-vlan2634.top.net.ua [World] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='80.91.177.253';
$graphs1[$j]['name']='pretcher.10g-kiev-vlan2506.datagroup.ua [UA-IX] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='88.81.242.149';
$graphs1[$j]['name']='pretcher3.10g-kiev-vlan2629.top.net.ua [UA-IX] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='193.151.12.35';
$graphs1[$j]['name']='dkm.ua [BackUp] ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='10.22.0.1';
$graphs1[$j]['name']='MKT-1 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='10.22.0.2';
$graphs1[$j]['name']='MKT-2 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
$j++;
$graphs1[$j]['ip']='172.16.0.3';
$graphs1[$j]['name']='switch-mir8 ('.$graphs1[$j]['ip'].')';
$graphs1[$j]['type']='loss';
#------------
$get1='title=ping time&units=ms&color=0,180,0&round=2';
$get2='title=packets lost&units=pkts&color=255,0,0&color2=0,0,255&round=2';
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
foreach ($graphs1 as $tmp_arr) {
	$ip1=$tmp_arr['ip'];
	$name1=$tmp_arr['name'];
	if($tmp_arr['type']=='time'){$type1='ping_'; $temp_get=$get1;}
	if($tmp_arr['type']=='loss'){$type1='loss_'; $temp_get=$get2;}
	print "<tr><td colspan=\"2\">$name1</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=$type1$ip1.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=$type1$ip1.log&$temp_get\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>\n";
}
print "</table>\n";
} else if ( $serv == 'temp' ) {
$temp_get='title=temperature&units=*C&color=0,180,0&color2=0,0,255';
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr><td colspan=\"3\">28.6677E4040000 (серверная) [вентилятор: 22, -2] [кондиционер: 25, -3]</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_28.6677E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_28.6677E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_28.6677E4040000.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">28.EB67E4040000 (улица)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_28.EB67E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_28.EB67E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_28.EB67E4040000.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">28.F447E4040000 (дом)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_28.F447E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_28.F447E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_28.F447E4040000.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">28.5F02E4040000 (2-ой этаж)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_28.5F02E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_28.5F02E4040000.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_28.5F02E4040000.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">switch-main (10.22.0.5)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_10.22.0.5.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_10.22.0.5.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_10.22.0.5.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">switch-mir8 (172.16.0.3)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_172.16.0.3.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_172.16.0.3.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_172.16.0.3.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">switch-univ58 (10.22.0.8)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_10.22.0.8.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_10.22.0.8.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_10.22.0.8.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">switch-pra57 (10.22.0.9)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=temp_10.22.0.9.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=temp_10.22.0.9.log&$temp_get\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=temp_10.22.0.9.log&$temp_get\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">1B.34764B000000 (аккумулятор 12В) [min=11.1 max=13.7]</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=volt_1B.34764B000000.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=volt_1B.34764B000000.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=volt_1B.34764B000000.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">BATTV (аккумулятор 12В) [min=10.9 max=13.8]</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=volt_batt.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=volt_batt.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=volt_batt.log&title=battery voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr><td colspan=\"3\">LINEV (вход  AC)</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=volt_acin.log&title=AC in voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=volt_acin.log&title=AC in voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-y.php?file=volt_acin.log&title=AC in voltage&units=V&color=255,100,0&round=2\">&nbsp;&nbsp;</td>
</tr>
</table>\n";
} else if ( $serv == 'localhost' ) {
$temp_trafic='title=Kbits per sec&units=Kb/s&color=0,255,0&color2=0,0,255';
$temp_inter='title=interrupts / sec&units=ir/s&color=255,0,255';
$temp_packs='title=packets per sec&units=p/s&color=255,200,0&color2=100,0,200';
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr><td>localhost - eth0 - trafic</td><td>localhost - eth0 - interrupts</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=trafic_localhost_eth0.log&$temp_trafic\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_eth0.log&$temp_inter\"></td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>
<tr><td>localhost - eth0 - packets</td><td>localhost - LOC - interrupts</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_localhost_eth0.log&$temp_packs\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_loc.log&$temp_inter\"></td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>
<tr><td>localhost - eth0.10 - packets</td><td>localhost - ide - interrupts</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_localhost_eth0.10.log&$temp_packs\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_ide.log&$temp_inter\"></td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>
<tr><td>localhost - eth0.95 - packets</td><td>localhost - sata - interrupts</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_localhost_eth0.95.log&$temp_packs\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_sata.log&$temp_inter\"></td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>
<tr><td>localhost - eth0.100 - packets</td><td>localhost - usb1 - interrupts</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_localhost_eth0.100.log&$temp_packs\">&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_usb1.log&$temp_inter\"></td>
</tr>
<tr><td colspan=\"2\">&nbsp;</td></tr>
<tr><td>-</td><td>localhost - serial - interrupts</td></tr>
<tr>
<td align=\"center\">&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=inter_localhost_serial.log&$temp_inter\"></td>
</tr>
</table>\n";
} else if ( $serv == 'graphs' ) {
print "<br>\n";
include './cmd/cmd_show_graphs.php';
#print "<br>\n";
} else if ( $serv == 'stat' ) {
$arr_t1=ssh_query('/ppp active print',1);
$arr_t2=ssh_query('/ppp active print',2);
$arr_r1=ssh_query("/system resource print | grep 'uptime\|cpu-load'",1);
$arr_r2=ssh_query("/system resource print | grep 'uptime\|cpu-load'",2);
$arr_m1=ssh_query("/interface monitor-traffic eth0 once\; /interface monitor-traffic eth1 once",1);
$arr_m2=ssh_query("/interface monitor-traffic vlan95 once\; /interface monitor-traffic eth1 once",2);
$col1=count($arr_t1)-1;
$col2=count($arr_t2)-1;
$col3=count($arr_r1);
$col4=count($arr_r2);
$col5=count($arr_m1)-1;
$col6=count($arr_m2)-1;
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr valign=\"top\"><td><center><strong>MKT 1</strong></center><pre>\n";
$i=0;
while ( $i < $col3 ) {
	print $arr_r1[$i]."\n";
	$i++;
}
print "<br></pre></td><td width=\"40\">&nbsp;</td>
<td><center><strong>MKT 2</strong></center><pre>\n";
$i=0;
while ( $i < $col4 ) {
	print $arr_r2[$i]."\n";
	$i++;
}
print "<br></pre>\n</td></tr>
<tr valign=\"top\"><td><pre>\n";
$i=0;
while ( $i < $col5 ) {
	print $arr_m1[$i]."\n";
	$i++;
}
print "<br></pre></td><td width=\"40\">&nbsp;</td>
<td><pre>\n";
$i=0;
while ( $i < $col6 ) {
	print $arr_m2[$i]."\n";
	$i++;
}
$tmp30=rand(10,99);
$temp_get='title=session on MKT&units=ses&color=0,180,0';
$temp_get2='title=CPU load&units=%&color=255,0,0&max=100';
$temp_get3='title=packets per sec&units=p/s&color=255,200,0&color2=100,0,200';
print "<br></pre>
</td></tr>
<tr valign=\"top\" align=\"right\">
<td><strong>eth0</strong>&nbsp;<img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=1&source=iface&name=eth0&kind=daily\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_10.22.0.1_eth0.log&$temp_get3\"><br><br>
<strong>eth1</strong>&nbsp;<img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=1&source=iface&name=eth1&kind=daily\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_10.22.0.1_eth1.log&$temp_get3\"><br><br>
</td>
<td width=\"40\">&nbsp;</td>
<td><strong>vlan95</strong>&nbsp;<img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=2&source=iface&name=vlan95&kind=daily\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_10.22.0.2_vlan95.log&$temp_get3\"><br><br>
<strong>eth1</strong>&nbsp;<img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=2&source=iface&name=eth1&kind=daily\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=packs_10.22.0.2_eth1.log&$temp_get3\"><br><br>
</td>
</tr>
<tr valign=\"top\" align=\"right\">
<td><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=1&name=cpu&kind=daily\"><br><br>
</td>
<td width=\"40\">&nbsp;</td>
<td><img border=\"0\" src=\"img/graphs/gd2_mrtg.php?mkt=2&name=cpu&kind=daily\"><br><br>
</td>
</tr>
<tr valign=\"top\" align=\"right\">
<td><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=load_mkt1_1.log&$temp_get2\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=load_mkt1_2.log&$temp_get2\"><br><br>
</td>
<td width=\"40\">&nbsp;</td>
<td><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=load_mkt2_1.log&$temp_get2\"><br><br>
<img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=load_mkt2_2.log&$temp_get2\"><br><br>
</td>
</tr>
<tr valign=\"top\" align=\"right\">
<td><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=ses_mkt1.log&$temp_get\"><br><br>
<!-- <img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=ses_mkt1.log&$temp_get\"><br><br> -->
</td>
<td width=\"40\">&nbsp;</td>
<td><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=ses_mkt2.log&$temp_get\"><br><br>
<!-- <img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=ses_mkt2.log&$temp_get\"><br><br> -->
</td>
</tr>
<tr valign=\"top\"><td>
<pre>\n";
$i=0;
while ( $i < $col1 ) {
	if ( $i > 1 ) {
		$tmp_arr1=explode(" ", trim($arr_t1[$i]));
		$tmp_arr1[3]='<a href="?cmd=view_abon&login='.$tmp_arr1[3].'">'.$tmp_arr1[3].'</a>';
		if ( $tmp_arr1[0] < 10 ) { print ' '; }
		for ( $j=0; $j < count($tmp_arr1); $j++ ) {
			print $tmp_arr1[$j].' ';
		}
		print "\n";
	} else {
		print $arr_t1[$i]."\n";
	}
	$i++;
}
print "</pre></td><td width=\"40\">&nbsp;</td><td><pre>\n";
$i=0;
while ( $i < $col2 ) {
	if ( $i > 1 ) {
		$tmp_arr1=explode(" ", trim($arr_t2[$i]));
		$tmp_arr1[3]='<a href="?cmd=view_abon&login='.$tmp_arr1[3].'">'.$tmp_arr1[3].'</a>';
		if ( $tmp_arr1[0] < 10 ) { print ' '; }
		for ( $j=0; $j < count($tmp_arr1); $j++ ) {
			print $tmp_arr1[$j].' ';
		}
		print "\n";
	} else {
		print $arr_t2[$i]."\n";
	}
	$i++;
}
print "</pre></td></tr>
</table>\n";
} else if ( $serv == 'online' ) {
mysql_query("DELETE FROM `t_temp_load` WHERE `user`='$php_user'");
#sleep(1);
$iface='vlan95';
$mib1=exec('snmpwalk -v 2c -r 3 -t 1 -On -c pub321lic123 '.$mkt_ip[1]." .1.3.6.1.2.1.2.2.1.2 2> /dev/null | grep $iface | cut -d \"=\" -f 1 | grep -oE \"[^.]+$\"");
$mib2=exec('snmpwalk -v 2c -r 3 -t 1 -On -c pub321lic123 '.$mkt_ip[2]." .1.3.6.1.2.1.2.2.1.2 2> /dev/null | grep $iface | cut -d \"=\" -f 1 | grep -oE \"[^.]+$\"");
print "<br><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr align=\"center\"><td><strong>mkt1</strong></td><td width=\"20\">&nbsp;</td><td><strong>mkt2</strong></td></tr>
<tr>
<td align=\"center\">cpu load<br><img id=\"img11\" border=\"0\" src=\"img/graphs/cpu_load.php?mkt=1\"></td>
<td width=\"20\">&nbsp;</td>
<td align=\"center\">$iface load<br><img id=\"img12\" border=\"0\" src=\"img/graphs/cpu_load.php?mkt=2\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<tr>
<td align=\"center\">$iface trafic load<br><img id=\"img21\" border=\"0\" src=\"img/graphs/iface_load.php?mkt=1&mib=$mib1\"></td>
<td width=\"20\">&nbsp;</td>
<td align=\"center\">$iface trafic load<br><img id=\"img22\" border=\"0\" src=\"img/graphs/iface_load.php?mkt=2&mib=$mib2\"></td>
</tr>
<tr><td colspan=\"3\">&nbsp;</td></tr>
<td align=\"center\">$iface packets load<br><img id=\"img31\" border=\"0\" src=\"img/graphs/iface_loadp.php?mkt=1&mib=$mib1\"></td>
<td width=\"20\">&nbsp;</td>
<td align=\"center\">$iface packets load<br><img id=\"img32\" border=\"0\" src=\"img/graphs/iface_loadp.php?mkt=2&mib=$mib2\"></td>

</table>
<script type=\"text/JavaScript\">
i=0;
function while_start() {
 while_tmp = window.setTimeout(while_repeat, 2000);
}

function while_repeat() {
 var imgp11 = document.getElementById('img11');
 var imgp12 = document.getElementById('img12');
 var imgp21 = document.getElementById('img21');
 var imgp22 = document.getElementById('img22');
 var imgp31 = document.getElementById('img31');
 var imgp32 = document.getElementById('img32');

 i=i+1;
 imgp11.src=\"img/graphs/cpu_load.php?mkt=1&\"+i;
 imgp12.src=\"img/graphs/cpu_load.php?mkt=2&\"+i;
 imgp21.src=\"img/graphs/iface_load.php?mkt=1&mib=$mib1&\"+i;
 imgp22.src=\"img/graphs/iface_load.php?mkt=2&mib=$mib2&\"+i;
 imgp31.src=\"img/graphs/iface_loadp.php?mkt=1&mib=$mib1&\"+i;
 imgp32.src=\"img/graphs/iface_loadp.php?mkt=2&mib=$mib2&\"+i;
 while_start();
}
while_start();
</script>\n";
} else if ( $serv == 'errors' ) {
print "<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr valign=\"top\"><td>\n";
$sw_ip='10.22.0.5';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
$arr_link[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
$arr_crc[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.3",$arr_crc);
$arr_over[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.13",$arr_over);
$arr_frag[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.16.1.1.1.11",$arr_frag);
$arr_drop[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.16.1.1.1.3",$arr_drop);
$arr_sym[0]=0;
exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.18",$arr_sym);
print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>main ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>CRC</td><td>Oversize</td><td>Fragment</td><td>Drop</td><td>Symbol</td></tr>\n";
for ($i=1;$i<=28;$i++) {
 if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
 print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$i,'graph'); print "</strong></td><td>".$arr_crc[$i]."</td><td>".$arr_over[$i]."</td><td>".$arr_frag[$i]."</td><td>".$arr_drop[$i]."</td><td>".$arr_sym[$i]."</td></tr>\n";
}
print "</table>
</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='172.16.0.3';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	$arr_link[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	$arr_crc[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.3",$arr_crc);
	$arr_over[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.13",$arr_over);
	$arr_frag[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.16.1.1.1.11",$arr_frag);
	$arr_drop[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.16.1.1.1.3",$arr_drop);
	$arr_sym[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.18",$arr_sym);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>mir8 ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>CRC</td><td>Oversize</td><td>Fragment</td><td>Drop</td><td>Symbol</td></tr>\n";
	for ($i=1;$i<=28;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
		print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$i,'graph'); print "</strong></td><td>".$arr_crc[$i]."</td><td>".$arr_over[$i]."</td><td>".$arr_frag[$i]."</td><td>".$arr_drop[$i]."</td><td>".$arr_sym[$i]."</td></tr>\n";
	}
	print "</table>\n";
} else {
	print "$sw_ip - offline";
}
print "</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='10.22.0.6';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	$arr_link[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	$arr_crc[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.3",$arr_crc);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>kyl3_l2 ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>CRC</td></tr>\n";
	for ($i=1;$i<=28;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
		print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$i,'graph'); print "</strong></td><td>".$arr_crc[$i]."</td></tr>\n";
	}
	print "</table>\n";
} else {
	print "$sw_ip - offline";
}
print "</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='10.22.0.8';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	$arr_link[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	$arr_crc[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.3",$arr_crc);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>univ58 ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>CRC</td><td>Cable</td></tr>\n";
	for ($i=1;$i<=18;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
		print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$i,'graph'); print "</strong></td><td>".$arr_crc[$i]."</td><td><span id=\"res1_$i\"></span><a href=\"javascript:void(0);\" onclick=\"loadScript('load_s/cab_des3200.php?res=res1_$i&ip=$sw_ip&p=$i'); var res = document.getElementById('res1_$i'); res.innerHTML = 'wait...<br>';\">check</td></tr>\n";
	}
	print "</table>\n";
} else {
	print "$sw_ip - offline";
}
print "</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='10.22.0.9';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	$arr_link[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	$arr_crc[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.10.7.2.1.3",$arr_crc);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>pra57 ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>CRC</td><td>Cable</td></tr>\n";
	for ($i=1;$i<=18;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
		print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$i,'graph'); print "</strong></td><td>".$arr_crc[$i]."</td><td><span id=\"res3_$i\"></span><a href=\"javascript:void(0);\" onclick=\"loadScript('load_s/cab_des3200.php?res=res3_$i&ip=$sw_ip&p=$i'); var res = document.getElementById('res3_$i'); res.innerHTML = 'wait...<br>';\">check</td></tr>\n";
	}
	print "</table>\n";
} else {
	print "$sw_ip - offline";
}
print "</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='10.22.0.3';
exec("snmpget -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	#$arr_link[0]=0;
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	exec("snmpwalk -v 2c -Oqv -c pub321lic123 $sw_ip .1.3.6.1.2.1.2.2.1.14",$arr_err);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>kyl6 ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td><strong>Port</strong></td><td>Errors</td><td>Cable</td></tr>\n";
	$pp1=1;
	for ($i=2;$i<=27;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
		print "<tr><td bgcolor=\"$bgcol1\"><strong>"; popup_graph($sw_ip,$pp1,'graph'); print "</strong></td><td>".$arr_err[$i]."</td><td><span id=\"res2_$pp1\"></span><a href=\"javascript:void(0);\" onclick=\"loadScript('load_s/cab_s2326.php?res=res2_$pp1&ip=$sw_ip&p=$pp1'); var res = document.getElementById('res2_$pp1'); res.innerHTML = 'wait...<br>';\">check</td></tr>\n";
		$pp1++;
	}
	print "</table>\n";
} else {
	print "$sw_ip - offline";
}
print "</td><td width=\"20\">&nbsp;</td><td>\n";
unset($arr_time,$arr_link,$arr_crc,$arr_over,$arr_frag,$arr_drop,$arr_sym);
$sw_ip='172.16.0.2';
exec("snmpget -v 3 -Oqv -u ualarm -a MD5 -A eke3e3dfjk34f -l authNoPriv $sw_ip .1.3.6.1.2.1.1.3.0",$arr_time);
if ( isset($arr_time[0]) and !empty($arr_time[0]) ) {
	$arr_link[0]=0;
	exec("snmpwalk -v 3 -Oqv -u ualarm -a MD5 -A eke3e3dfjk34f -l authNoPriv $sw_ip .1.3.6.1.2.1.2.2.1.8",$arr_link);
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\">
<tr align=\"center\"><td colspan=\"6\"><strong>mir8(pr) ($sw_ip)</strong> [".$arr_time[0]."]</td></tr>
<tr><td align=\"center\"><strong>Port</strong></td></tr>\n";
	for ($i=1;$i<=28;$i++) {
		if ( $arr_link[$i] == 1 ) { $bgcol1='#00FF00'; } else { $bgcol1='#FF4500'; }
 		print "<tr><td bgcolor=\"$bgcol1\"><strong>$i</strong></td></tr>\n";
	}
	print "</table>\n";
} else {

	print "$sw_ip - offline";
}
print "</td></tr></table>\n";
}
?>