<?php include './include/admin.php'; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="favicon.png" />
<title>k4u.Net: admin page</title>
<style type="text/css">
<!--
body {
	margin:0px;
	background-color:#000000;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#FFFFFF;
}
a:link { text-decoration:none; color:#FFFFFF; }
a:visited { text-decoration:none; color:#FFFFFF; }
a:hover { text-decoration:underline; color:#0000FF; }
a:active { text-decoration:none; color:#FFFFFF; }
.main_t1 {
	border-top-style:none;
	border-right-style:none;
	border-bottom-style:none;
	border-left-style:none;
}
.table1 { font-size:12px; }
.tema1 { color:#FF0000; font-size:20px; font-weight:bold; }
.func1 { font-size:20px; font-weight:bold; color:#FFFFFF; }
.func3 { font-size:20px; font-weight:bold; color:#000000; background-color:#FFFFFF; }
.date1 { font-style:italic; font-weight:bold; font-size:13px; }
.copyr1 { color:#666666; font-size:12px; }
-->
</style>
</head>
<body>
<?php

print "<table class=\"main_t1\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\" border=\"3\">
<tr valign=\"top\">
<td width=\"200\">
<table height=\"100%\" width=\"200\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr valign=\"top\"><td align=\"left\">
<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";

// get & post

if ( isset($_GET['cmd']) ) { $cmd=addslashes($_GET['cmd']); }
if ( isset($_POST['cmd']) ) { $cmd=addslashes($_POST['cmd']); }

// menu

$res=mysql_query("SELECT `title`,`cmd` FROM `a_menu` WHERE `view`='1' ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ){
	$title=$tmp['title'];
	$cmd2=$tmp['cmd'];
  
	if ( isset($cmd) and $cmd == $cmd2 ) {
		print "<tr><td width=\"55\">&nbsp;</td><td width=\"55\" class=\"func3\">$title</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
	} else {
		print "<tr><td width=\"55\">&nbsp;</td><td width=\"55\" onmouseover=\"javascript:this.style.backgroundColor='#FFFFFF'; this.style.color='#000000';\" onmouseout=\"javascript:this.style.backgroundColor=document.body.style.backgroundColor; this.style.color=document.body.style.color;\" onclick=\"javascript:location.replace('?cmd=$cmd2');\" class=\"func1\"><a href=\"?cmd=$cmd2\">$title</a></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
	}
}

print "</table>
</td></tr><tr valign=\"bottom\"><td align=\"center\" class=\"copyr1\">Copyright &copy; GriF<br>2009 - ".date("Y")."</td></tr></table>
</td>
<td>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td width=\"15\" height=\"15\">&nbsp;</td><td>&nbsp;</td><td width=\"15\">&nbsp;</td></tr><tr><td>&nbsp;</td><td>
<!-- body begin -->\n";

// soure include

if ( isset($cmd) ) {
	$res=mysql_query("SELECT `src` FROM `a_menu` WHERE `cmd`='$cmd'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$src=$tmp['src'];
		include "./cmd/$src";
	}
}

print "<!-- body end -->
</td><td>&nbsp;</td></tr><tr><td height=\"15\">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
</td>
</tr>
</table>\n";

?>
</body>
</html>