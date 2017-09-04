<?php
include '../admin/include/admin.php';

if ( isset($_GET['id']) ) {
	$id2=$_GET['id'];
	$res2=mysql_query("SELECT `count` FROM `d_holiday` WHERE `id`='$id2'");
	while ( $tmp2=mysql_fetch_assoc($res2) ) { $count=$tmp2['count']; }
	$count++;
	mysql_query("UPDATE `d_holiday` SET `count`='$count' WHERE `id`='$id2'");
}
?>