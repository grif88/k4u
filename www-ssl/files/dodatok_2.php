<?php
include '../include/admin.php';
$cl_brows=$_SERVER['HTTP_USER_AGENT'];
if ( strpos($cl_brows, 'Opera') !== false ) { $font_s='13'; $font_b='20'; } else { $font_s='10'; $font_b='16'; }
if ( isset($_GET['id']) ) {
	$id=$_GET['id'];
	$dog_num='';
	while ( strlen($dog_num) != 6 ) { if ( !empty($dog_num) ) { $dog_num='0'.$dog_num; } else { $dog_num=$id; } }
	$res=mysql_query("SELECT `login`, `passwd` FROM `d_cl_list` WHERE `id`='$id'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$login='<span class="big_f">'.$tmp["login"].'</span>';
		$passwd='<span class="big_f">'.$tmp["passwd"].'</span>';
	}
} else {
	$dog_num='_________________';
	$login='_____________________________';
	$passwd='____________________________';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>������� 2</title>
<style>
<!--
body {
	margin:10px;
	background-color:#FFFFFF;
	font-family:"Times New Roman";
	font-size:<?php print $font_s; ?>pt;
	color:#000000;
	line-height:1.5;
	}
table {
	background-color:#FFFFFF;
	font-family:"Times New Roman";
	font-size:<?php print $font_s; ?>pt;
	color:#000000;
	line-height:1.5;
	}
.underl {
	text-decoration:underline;
	}
.big_f {
	font-size:<?php print $font_b; ?>pt;
	}
-->
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
<td align="left">��� ���������� �.�.<br>
�. ������ г�, ���. ������������, 13</td>
<td align="right">www.k4u.net.ua<br>
���. 068-411-411-5, 098-648-80-06</td>
</tr>
<tr valign="top">
<td width="65%">&nbsp;</td>
<td width="35%"><br>
������� �2<br>
�� �������� � <?php print $dog_num; ?><br>
�� �_____� ____________ 20____ �.<br></td>
</tr>
<tr valign="top">
<td colspan="2" align="center"><br>
��� ��� ������������ ���������� �� ����� ��������<br>
<br></td>
</tr>
<tr valign="middle">
<td colspan="2" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����: <?php print $login; ?><br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������: <?php print $passwd; ?><br>
<br></td>
</tr>
<tr valign="top">
<td colspan="2" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� �� ����� �������� ����������� ����� �������� ���o�, �������� �� ������ ��������� ������ �������� � ���� ���� ������� �����������. ������������ ��������� ���������� ������� ����������� ��������� ���������. ���������� ������������ PPPoE ������� ������ ������������ ���������� �������, ��� ����� ������ �� web-���� ������������� ���������� �������. ��������� �����'������� ��������� �������� �� 10 ����������� ��� �� ������� ���� ����� �����������. ������������ ��� ������ �� ����� ��������, �� ���� �� ����� ������, ������� ���� ������ �� web-���� ���������� <span class="underl">www.k4u.net.ua</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������� ����� ������ �� ����� ����� ������ ��� ��� ������ � ������� �����, ���������� ��� �� �������� �� ������� ���� ��� ���.<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="underl">������� ������������ PPPoE ��� Windows XP (���):</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� > ������ ���������� > ������� ����������� > ���� > ����� ����������� > (������ �����) > ���������� � ��������� (������ �����) > ����� ���������������� �����������, ������������� ��� ������������ � ������ (������ �����) > ��� ���������� �����: ����� (������ �����) > ������ ��� ������������ � ������ (������ �����) > �������� ����� �� ������� ���� (������ ������).<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="underl">������� ������������ PPPoE ��� Windows 7 (���):</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� > ������ ���������� > ���� � �������� > ����� ���������� ������ � ����� �������� > ��������� ������ ����������� ��� ���� > ����������� � ��������� (������ �����) > ��� ����� ������� ����� ����������� > ���������������� (� PPPoE) > ������ ��� ������������ � ������ > ��������� ���� ������ (������ ����������).<br>
<br>
<br></td>
</tr>
<tr valign="top">
<td align="center">
<table cellpadding="0" cellspacing="0" border="0">
<tr valign="top">
<td align="center">_____________________________<br>
(�����)<br>
�.�.<br></td>
<td align="left">&nbsp;���������� �.�.<br></td>
</tr>
</table>
</td>
<td align="center" width="35%">___________________________<br>
(����� ��������)<br></td>
</tr>
</table>
</body>
</html>