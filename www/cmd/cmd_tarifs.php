<?php
print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������� �����</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td rowspan=\"2\"><strong>�������� ����</strong></td>
<td rowspan=\"2\"><strong>���������<br>(���)</strong></td>
<td colspan=\"2\"><strong>�������� �������<br>� ���������</strong></td>
<td rowspan=\"2\"><strong>�������� �������<br>� ��������� ��������</strong></td>
<td rowspan=\"2\"><strong>���� ��������</strong></td></tr>
<tr align=\"center\">
<td><strong>� 16:00 �� 01:00</strong></td>
<td><strong>� 01:00 �� 16:00</strong></td>
</tr>\n";
$res=mysql_query("SELECT * FROM `tarifs` ORDER BY `poss`");
$span1=mysql_num_rows($res)-2;
$i=0;
$speed22='�� 100 ����/���';
while ( $tmp=mysql_fetch_assoc($res) ) {
	$name=$tmp['name'];
	$abon=$tmp['abon'];
	$speed=$tmp['speed'];
	$local=$tmp['local'];
	$srok=$tmp['srok'];
	$akcia=$tmp['akcia'];
	$speed2=$tmp['speed2'];

	if($akcia==1){
		#print "<tr align=\"center\"><td><span class=\"akcia1\">$name</span></td><td><span class=\"akcia1\">$abon</span></td><td><span class=\"akcia1\">$speed</span></td><td><span class=\"akcia1\">$speed2</span></td><td><span class=\"akcia1\">$local</span></td><td><span class=\"akcia1\">$srok</span></td></tr>\n";
		print "<tr align=\"center\"><td class=\"akcia1\">$name</td><td class=\"akcia1\">$abon</td>"; if($i!=0 and $speed2==0) {print "<td colspan=\"2\">$speed</td>";} else {print "<td class=\"akcia1\">$speed</td>";} if($i==0 and $speed2==1){print "<td rowspan=\"$span1\" class=\"akcia1\">$speed22</td>"; $i=1;} print "<td class=\"akcia1\">$local</td><td class=\"akcia1\">$srok</td></tr>\n";
	} else {
		print "<tr align=\"center\"><td>$name</td><td>$abon</td>"; if($i!=0 and $speed2==0) {print "<td colspan=\"2\">$speed</td>";} else {print "<td>$speed</td>";} if($i==0 and $speed2==1){print "<td rowspan=\"$span1\" class=\"akcia1\">$speed22</td>"; $i=1;} print "<td>$local</td><td>$srok</td></tr>\n";
	}
}
print "</table>\n";

print "<p class=\"justify1\"><font size=\"2\" color=\"#909090\">* ��������� �������� ������� � ����������� �������� ������ ������������� �������� �������� ���������� � �������� (download). ���������� �������� ��������� ������� ��������� � ����������� ���������� �������������� ������ �������� ������������� � ����������� ����������. ����������� �������� ������� � ��������-�������� ����� ���������� � ������� �� ��������� ����������� �������� ��������, ������������� ������ � ������������ ������������ ��������.</font><br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �������� ��������� ����� � �������� �� ����� ������� ���������� - 20 ���.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �������� ��������� ����� � �������� �� ����� ������� ���������� - 0 ���.<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��� ���� �������� ��� ��� � ������������� � 1 �������� 2016�.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������� ����� ������, ������������� �� 1 ����� ���������� ������. ������ ����� ����������� ����� �� ���� ������ ���������������. ���������� ������� �� ��������� �� 1 ����� ������ ������ - �������� ������.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;� ������ ��������, ������������ ���������� ��������. ������������� �� 3 � ����� �������, �������� ���������� ��� ������� ����������� �������������� ����� � ��������� ����� �����������, � ������������� �������, ��� �������������� �������� � ��� ����������� ��������������.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������� ���������� ��� ���������, ����� ������������ ����������� ������, ����� ��������� ������ �����������.</p>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������������� ������</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>������������ ������</strong></td><td><strong>���������</strong></td></tr>\n";
$res=mysql_query("SELECT * FROM `uslugi` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
	$usluga=$tmp['usluga'];
	$cost=$tmp['cost'];
	print "<tr><td>$usluga</td><td>$cost</td></tr>\n";
}
print "</table><br>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �������� ISP k4u.Net</strong>&nbsp;&nbsp;<input type=\"button\" value=\"�������\" onclick=\"javascript:location.replace('files/Dogovor_k4uNet.pdf');\" />\n";
?>