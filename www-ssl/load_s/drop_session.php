<?php
include '../include/admin.php';
include '../include/global.php';
include '../include/func_list.php';

$id=$_GET['id'];

$access2=0;
$res2=mysql_query("SELECT `secret_edit` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
if ( $res2 ) { // if $res2 begin
	while ( $tmp2=mysql_fetch_assoc($res2) ){
		$access2=$tmp2['secret_edit'];
	}
} // if $res2 end
if ( $access2 != 1 ) { // global if
	$result='Deny';
} else { // global else
	$res=mysql_query("SELECT `list`.`login` FROM `d_cl_list` AS `list` WHERE `list`.`id`='$id'");
	$res_rows=mysql_num_rows($res);
	if ( $res_rows == 1 ) { // if
		while ( $tmp=mysql_fetch_assoc($res) ){
			$login=$tmp['login'];
			ins_drop($php_date,$php_user,$php_user_ip,$id,$login);
			$result='OK';
		} // while
	} else { $result='Fail'; } // if
} // global end
print "var res = document.getElementById('result'); res.innerHTML = 'Drop - $result';";
?>