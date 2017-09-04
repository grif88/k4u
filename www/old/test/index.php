<?php
$link = mysql_connect("localhost", "test1","test1") or die("Could not connect");
mysql_select_db('pretcher');

print "<html>
<head>
<title>statistic</title>
<link rel=\"stylesheet\" href=\"tcal.css\" type=\"text/css\" />
<script type=\"text/JavaScript\" src=\"tcal.js\"></script>
</head>
<body>";
if ( !empty($_GET['d_start']) ) { $d_start=$_GET['d_start']; } else { $d_start=date("Y-m-d"); }
if ( !empty($_GET['d_end']) ) { $d_end=$_GET['d_end']; } else { $d_end=date("Y-m-d"); }
$d_end2=$d_end.' 23:59:59';
print "<form method=\"get\">
<input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_start\" value=\"$d_start\" class=\"tcal\"> - 
<input type=\"text\" maxlength=\"10\" size=\"15\" name=\"d_end\" value=\"$d_end\" class=\"tcal\"> 
<input type=\"submit\" value=\"OK\"></form>
<table>\n";
$res3=mysql_query("SELECT `id` FROM `cl_reklama_2` WHERE `time` BETWEEN '$d_start' AND '$d_end2'");
$num3=mysql_num_rows($res3);
$point=$num3/100;
$res1=mysql_query("SELECT * FROM `cl_reklama_1`");
while ( $tmp1=mysql_fetch_assoc($res1) ) {
	$id=$tmp1["id"];
	$name_source=$tmp1["name_source"];
	$res2=mysql_query("SELECT `id` FROM `cl_reklama_2` WHERE `reklID`='$id' AND `time` BETWEEN '$d_start' AND '$d_end2'");
	$num2=mysql_num_rows($res2);
	$point_id=round($num2/$point,2);
	print "<tr><td>$name_source ($num2 רע / $point_id %)</td><td><font size=\"-1\">";
	for ($i=1;$i<=$num2;$i++) {
		print '|';
	}
	print "</font></td></tr>\n";
}
print "</table>
<br>
<strong>Âסודמ: $num3 רע</strong>
</body>
</html>";
?>