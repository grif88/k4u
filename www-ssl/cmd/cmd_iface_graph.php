<?php

if ( isset($_GET['mkt']) and !empty($_GET['mkt']) and isset($_GET['login']) and !empty($_GET['login']) ) { // if GET begin
	$mkt=$_GET['mkt'];
	$iface='<pppoe-'.$_GET['login'].'>';
	$iface2='&lt;pppoe-'.$_GET['login'].'&gt;';
	$mib1=exec('snmpwalk -v 2c -r 3 -t 1 -On -c pub321lic123 '.$mkt_ip[$mkt].' .1.3.6.1.2.1.2.2.1.2 2> /dev/null | grep "'.$iface.'" | cut -d "=" -f 1 | grep -oE "[^.]+$"');

print "<center><strong>mkt$mkt - $iface2 - $mib1</strong></center><br>\n";

mysql_query("DELETE FROM `t_temp_load` WHERE `user`='$php_user'");
print "<img id=\"img12\" border=\"0\" src=\"img/graphs/iface_load.php?mkt=$mkt&mib=$mib1\"><br><br>
<img id=\"img22\" border=\"0\" src=\"img/graphs/iface_loadp.php?mkt=$mkt&mib=$mib1\"><br>
<script type=\"text/JavaScript\">
i=0;
function while_start() {
 while_tmp = window.setTimeout(while_repeat, 2000);
}

function while_repeat() {
 var img1 = document.getElementById('img12');
 var img2 = document.getElementById('img22');
 i=i+1;
 img1.src=\"img/graphs/iface_load.php?mkt=$mkt&mib=$mib1&\"+i;
 img2.src=\"img/graphs/iface_loadp.php?mkt=$mkt&mib=$mib1&\"+i;
 while_start();
}
while_start();
</script>\n";

} // if GET end
else { print "<br><center>interface не выбран<center>\n"; }
?>