<?php

$id=$_GET['id'];

// insert

mysql_query("DELETE FROM `d_sw_list` WHERE `id`='$id'");
mysql_query("DELETE FROM `d_uplink` WHERE `id_term`='$id'");
mysql_query("DELETE FROM `d_uplink` WHERE `type`='dev' AND `id_cl`='$id'");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>