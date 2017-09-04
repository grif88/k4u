<?php

if ( isset($_GET['id_street']) and !empty($_GET['id_street']) ) { // if street
	$id_street=$_GET['id_street'];
} else { $id_street=0; }

print "<form method=\"get\"><center>
<input type=\"hidden\" name=\"cmd\" value=\"view_mrtg\">
<input type=\"hidden\" name=\"mkt\" value=\"graphs\">\n";
street_list_f(1,$id_street);
print "&nbsp;<input type=\"submit\" value=\"OK\">
</center></form>\n";

if ( $id_street != 0 ) { // if street

$res33=mysql_query("
SELECT
`list`.`id` AS `id_list`
FROM
`d_cl_list` AS `list`,
`d_cl_otkl` AS `otkl`
WHERE
(`otkl`.`date_finish` IS NOT NULL AND `otkl`.`date_finish`!='')
AND `list`.`id`=`otkl`.`id_client`
ORDER BY `list`.`id`
");
$otkl_list=0;
if ( $res33 ) {
 while ( $tmp33=mysql_fetch_assoc($res33) ) {
  $id_list33=$tmp33['id_list'];
  if ( !empty($otkl_list) ) { $otkl_list=$otkl_list.','.$id_list33; } else { $otkl_list=$id_list33; }
 }
}

$res=mysql_query("
SELECT
`list`.`login`
FROM
`d_cl_list` AS `list`,
`d_cl_podkl` AS `podkl`,
`d_cl_data` AS `data`
WHERE
`podkl`.`id_client`=`list`.`id`
AND `data`.`id_client`=`list`.`id`
AND (`podkl`.`date_finish` IS NOT NULL AND `podkl`.`date_finish`!='')
AND `list`.`id` NOT IN ($otkl_list)
AND `list`.`id_street`='$id_street'
ORDER BY `list`.`login`
");
if ( $res ) { // if
$rnum=mysql_num_rows($res);
print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
while ( $tmp=mysql_fetch_assoc($res) ){
 $login=$tmp['login'];
 #print "$login\n";
 print "<tr><td><a href=\"?cmd=view_abon&login=$login\">$login</a> - daily - mkt1<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=1&name=$login&kind=daily\"></td><td>&nbsp;&nbsp;</td><td><a href=\"?cmd=view_abon&login=$login\">$login</a> - daily - mkt2<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=2&name=$login&kind=daily\"></td></tr>\n";
 }
 print "</table>\n";
}

} // end if street
?>