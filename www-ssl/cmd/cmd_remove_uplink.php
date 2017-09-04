<?php

$id=$_GET['id'];

// insert

mysql_query("DELETE FROM `d_uplink` WHERE `id`='$id'");

print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";

?>