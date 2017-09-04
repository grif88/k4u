<?php

// input

$id=$_GET['id'];

// if exist before

$res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `id`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id2=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_podkl` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id3=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_otkl` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id4=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_balans_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id5=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_data` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id6=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_tarif_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id7=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_remont` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id8=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_stat_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id9=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_todo_list` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id10=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_uplink` WHERE `type`='abon' AND `id_cl`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id11=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_cl_view_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id12=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_cl_balans` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id13=$tmp['id'];
}

if ( isset($id2) ) { print "d_cl_list - <strong>OK</strong><br>\n"; } else { print "d_cl_list - <strong>Fail</strong><br>\n"; }
if ( isset($id3) ) { print "d_cl_podkl - <strong>OK</strong><br>\n"; } else { print "d_cl_podkl - <strong>Fail</strong><br>\n"; }
if ( isset($id4) ) { print "d_cl_otkl - <strong>OK</strong><br>\n"; } else { print "d_cl_otkl - <strong>Fail</strong><br>\n"; }
if ( isset($id5) ) { print "d_cl_balans_log - <strong>OK</strong><br>\n"; } else { print "d_cl_balans_log - <strong>Fail</strong><br>\n"; }
if ( isset($id6) ) { print "d_cl_data - <strong>OK</strong><br>\n"; } else { print "d_cl_data - <strong>Fail</strong><br>\n"; }
if ( isset($id7) ) { print "d_cl_tarif_log - <strong>OK</strong><br>\n"; } else { print "d_cl_tarif_log - <strong>Fail</strong><br>\n"; }
if ( isset($id8) ) { print "d_cl_remont - <strong>OK</strong><br>\n"; } else { print "d_cl_remont - <strong>Fail</strong><br>\n"; }
if ( isset($id9) ) { print "d_cl_stat_log - <strong>OK</strong><br>\n"; } else { print "d_cl_stat_log - <strong>Fail</strong><br>\n"; }
if ( isset($id10) ) { print "d_todo_list - <strong>OK</strong><br>\n"; } else { print "d_todo_list - <strong>Fail</strong><br>\n"; }
if ( isset($id11) ) { print "d_uplink - <strong>OK</strong><br>\n"; } else { print "d_uplink - <strong>Fail</strong><br>\n"; }
if ( isset($id12) ) { print "d_cl_view_log - <strong>OK</strong><br>\n"; } else { print "d_cl_view_log - <strong>Fail</strong><br>\n"; }
if ( isset($id13) ) { print "d_cl_balans - <strong>OK</strong><br>\n"; } else { print "d_cl_balans - <strong>Fail</strong><br>\n"; }


print "<hr>\n";

// deleting

print "Removing - id = $id<br>
<hr>\n";

mysql_query("DELETE FROM `d_cl_list` WHERE `id`='$id'");
mysql_query("DELETE FROM `d_cl_podkl` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_otkl` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_balans_log` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_data` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_tarif_log` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_remont` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_stat_log` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_todo_list` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_uplink` WHERE `type`='abon' AND `id_cl`='$id'");
mysql_query("DELETE FROM `d_cl_view_log` WHERE `id_client`='$id'");
mysql_query("DELETE FROM `d_cl_balans` WHERE `id_client`='$id'");

// if exist after

$res=mysql_query("SELECT `id` FROM `d_cl_list` WHERE `id`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id21=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_podkl` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id31=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_otkl` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id41=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_balans_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id51=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_data` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id61=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_tarif_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id71=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_remont` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id81=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_cl_stat_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id91=$tmp['id'];
}
$res=mysql_query("SELECT `id` FROM `d_todo_list` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id101=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_uplink` WHERE `type`='abon' AND `id_cl`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id111=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_cl_view_log` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id121=$tmp['id'];
}

$res=mysql_query("SELECT `id` FROM `d_cl_balans` WHERE `id_client`='$id'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $id131=$tmp['id'];
}

if ( isset($id21) ) { print "d_cl_list - <strong>OK</strong><br>\n"; } else { print "d_cl_list - <strong>Fail</strong><br>\n"; }
if ( isset($id31) ) { print "d_cl_podkl - <strong>OK</strong><br>\n"; } else { print "d_cl_podkl - <strong>Fail</strong><br>\n"; }
if ( isset($id41) ) { print "d_cl_otkl - <strong>OK</strong><br>\n"; } else { print "d_cl_otkl - <strong>Fail</strong><br>\n"; }
if ( isset($id51) ) { print "d_cl_balans_log - <strong>OK</strong><br>\n"; } else { print "d_cl_balans_log - <strong>Fail</strong><br>\n"; }
if ( isset($id61) ) { print "d_cl_data - <strong>OK</strong><br>\n"; } else { print "d_cl_data - <strong>Fail</strong><br>\n"; }
if ( isset($id71) ) { print "d_cl_tarif_log - <strong>OK</strong><br>\n"; } else { print "d_cl_tarif_log - <strong>Fail</strong><br>\n"; }
if ( isset($id81) ) { print "d_cl_remont - <strong>OK</strong><br>\n"; } else { print "d_cl_remont - <strong>Fail</strong><br>\n"; }
if ( isset($id91) ) { print "d_cl_stat_log - <strong>OK</strong><br>\n"; } else { print "d_cl_stat_log - <strong>Fail</strong><br>\n"; }
if ( isset($id101) ) { print "d_todo_list - <strong>OK</strong><br>\n"; } else { print "d_todo_list - <strong>Fail</strong><br>\n"; }
if ( isset($id111) ) { print "d_uplink - <strong>OK</strong><br>\n"; } else { print "d_uplink - <strong>Fail</strong><br>\n"; }
if ( isset($id121) ) { print "d_cl_view_log - <strong>OK</strong><br>\n"; } else { print "d_cl_view_log - <strong>Fail</strong><br>\n"; }
if ( isset($id131) ) { print "d_cl_balans - <strong>OK</strong><br>\n"; } else { print "d_cl_balans - <strong>Fail</strong><br>\n"; }

?>