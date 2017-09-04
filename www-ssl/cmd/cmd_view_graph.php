<?php
if ( isset($_GET['src']) and isset($_GET['iface']) ) {
	$graphs1[0]['ip']=$_GET['src'];
	$graphs1[0]['iface']=$_GET['iface'];
	#------------
	$get1='title=Kbits per sec&units=Kb/s&color=0,255,0&color2=0,0,255';
	$get2='title=packets per sec&units=p/s&color=255,200,0&color2=100,0,200';
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
	$i=0;
	while ( $i <= count($graphs1)-1 ) {
		$ip1=$graphs1[$i]['ip'];
		$iface1=$graphs1[$i]['iface'];
		$file1='trafic_'.$ip1.'_'.$iface1.'.log';
		$file2='packs_'.$ip1.'_'.$iface1.'.log';
		print "<tr><td>day - trafic - $ip1 - $iface1</td><td>week - trafic - $ip1 - $iface1</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file1&$get1\">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2-w.php?file=$file1&$get1\"></td>
</tr>
<tr><td>day - packets - $ip1 - $iface1</td><td>week - packets - $ip1 - $iface1</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2.php?file=$file2&$get2\">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get2-w.php?file=$file2&$get2\"></td>
</tr>\n";
		$i++;
	}
	if ( !isset($_GET['crc']) ) {
		print '<tr><td colspan="2" align="center"><a href="?win&cmd=view_graph&src='.$graphs1[0]['ip'].'&iface='.$graphs1[0]['iface'].'&crc">CRC</a></td></tr>'."\n";
	} else {
		$get3='title=CRC per sec&units=crc/s&color=255,0,0&round=4';
		$file3='crc_'.$graphs1[0]['ip'].'_'.$graphs1[0]['iface'].'.log';
		print "<tr><td>day - CRC - $ip1 - $iface1</td><td>week - CRC - $ip1 - $iface1</td></tr>
<tr>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get.php?file=$file3&$get3\">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=\"center\"><img border=\"0\" src=\"img/graphs/gd2graph-get-w.php?file=$file3&$get3\"></td>
</tr>\n";
	}
	print "</table>\n";
} else {
	print '<center>no src or iface</center>'."\n";
}
?>