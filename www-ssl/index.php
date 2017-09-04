<?php
$microtime_start=microtime('get_as_float');
include './include/admin.php';
include './include/func_list.php';
include './include/global.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<?php
if ( isset($_GET['cmd']) && !empty($_GET['cmd']) ) { $cmd=$_GET['cmd']; }
else if ( isset($_POST['cmd']) && !empty($_POST['cmd']) ) { $cmd=$_POST['cmd']; }
else { $cmd=''; }

if ( !empty($cmd) ) { // start if isset($cmd)
	$res=mysql_query("SELECT `title` FROM `m_menu` WHERE `cmd`='$cmd'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$m_title=$tmp['title'];
	}
}
if ( !empty($m_title) ) { print "<title>Billing: $m_title</title>\n"; } else { print "<title>Billing</title>\n"; }
?>
<link rel="shortcut icon" type="image/png" href="img/favicon.png" />
<link rel="icon" type="image/png" href="img/favicon.png" />
<link rel="stylesheet" href="css/ind.css" type="text/css" />
<link rel="stylesheet" href="css/tcal.css" type="text/css" />
<?php if ( !isset($_GET['win']) ) { print "<script async type=\"text/JavaScript\" src=\"js/clock.js\"></script>\n"; } ?>
<script async type="text/JavaScript" src="js/tcal.js"></script>
<script async type="text/JavaScript" src="js/func_m.js"></script>
</head>
<?php if ( !isset($_GET['win']) ) { print "<body onLoad=\"clock_start();\">\n"; } else { print "<body>\n"; } ?>
<?php

// head

if ( !isset($_GET['win']) ) { // if win begin

	print "<div style=\"left:0px;top:0px;position:fixed;background:#CCFFCC;width:100%;\">
<table cellspacing=\"1\" cellpadding=\"1\" width=\"100%\" border=\"0\"><tr>
<td class=\"tab1\" width=\"180\">Admin: $php_user</td>
<td class=\"tab1\" width=\"180\">Your IP: $php_user_ip</td>
<td class=\"tab1\" align=\"center\">k4u.Net: Billing page</td>
<td class=\"tab1\" align=\"center\" width=\"300\">".date('l d.m.Y')." - <span id=\"span_hh\">".date('H')."</span>:<span id=\"span_mm\">".date('i')."</span>:<span id=\"span_ss\">".date('s')."</span></td>
</tr></table>\n";

// menu

	print "<!-- menu begin -->
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"1\"><tr height=\"32\">\n";

	$res=mysql_query("SELECT `title`,`cmd`,`img` FROM `m_menu` WHERE `view`='1' ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$title=$tmp['title'];
		$cmd2=$tmp['cmd'];
		$img_src=$tmp['img'];
  
		if ( $cmd == $cmd2 ) { print "<td align=\"center\" class=\"tab_m2\"><a href=\"?cmd=$cmd2\"><img src=\"$img_src\" border=\"0\" title=\"$title\" /></a></td>\n"; }
		else { print "<td align=\"center\" class=\"tab_m\" onmouseover=\"javascript:this.style.backgroundColor='#000000';\" onmouseout=\"javascript:this.style.backgroundColor='#FFFFFF';\"><a href=\"?cmd=$cmd2\"><img src=\"$img_src\" border=\"0\" title=\"$title\" /></a></td>\n"; }
	}
	print "<td width=\"99%\" class=\"tab_m\"></td></tr></table>
</div><div style=\"height:55px;\"></div>
<!-- menu end -->
<br>\n";

} // if win end

print "<!-- body begin -->\n";

// sourse include
if ( !empty($cmd) ) { // start if isset($cmd)
	$access2=0;
	$res=mysql_query("SELECT `src`,`access` FROM `m_menu` WHERE `cmd`='$cmd'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$src=$tmp['src'];
		$access=$tmp['access'];
	}
	$res2=mysql_query("SELECT `$access` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
	if ( $res2 ) { // if $res2 begin
		while ( $tmp2=mysql_fetch_assoc($res2) ){
			$access2=$tmp2["$access"];
		}
	} // if $res2 end
	if ( $access2 == 1 ) { include "./cmd/$src"; }
	else { print "<center><span class=\"deny1\">Доступ запрещён</span></center>\n"; }
} // end if isset($cmd)

print "<!-- body end -->
<br>\n";

// bottom
$microtime_end=microtime('get_as_float');
$microtime_show=$microtime_end-$microtime_start;
print "<center><span class=\"copyr\">Page generated in $microtime_show sec. Script usage ".(function_exists("memory_get_usage")?memory_get_usage():"n/a")." bytes of memory<br>
Copyright &copy; GriF 2011 - ".date("Y")."</span></center>\n";
// test of generate speed
#$cmd_bash1='echo "'.date("Y-m-d H:i:s")." - $php_user - $microtime_show - ".(function_exists("memory_get_usage")?memory_get_usage():"n/a").' - '.$_SERVER['REQUEST_URI'].'" >> /home/www-data/php-gen.log';
#exec($cmd_bash1);
// test end
?>
<br>
</body>
</html>