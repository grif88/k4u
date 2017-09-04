<?php
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
`cl_bal`.`id`, `cl_bal`.`date`, `cl_bal`.`admin`, `cl_bal`.`admin_ip`, `cl_bal`.`id_client`, `cl_bal`.`balans`, `cl_list`.`login`
FROM `d_cl_balans` AS `cl_bal`,
`d_cl_list` AS `cl_list`
WHERE `cl_bal`.`balans` !=  '0'
AND `cl_list`.`id` = `cl_bal`.`id_client`
AND `cl_list`.`id` NOT IN ($otkl_list)
ORDER BY (`cl_bal`.`balans`+0)");
if ( mysql_num_rows($res) > 0 ) {
	print "<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" border=\"1\">
<tr class=\"clr_back_grey\" align=\"center\"><td>i</td><td>login</td><td>Баланс</td></tr>\n";
	while ( $tmp=mysql_fetch_assoc($res) ) {
		$id=$tmp['id'];
		$date=$tmp['date'];
		$admin=$tmp['admin'];
		$admin_ip=$tmp['admin_ip'];
		$id_cl=$tmp['id_client'];
		$login=$tmp['login'];
		$balans=$tmp['balans'];
		print "<tr><td>"; res_info($id,$date,$admin,$admin_ip); print "</td><td><a href=\"?cmd=view_abon&id=$id_cl\">$login</a></td><td>$balans</td></tr>\n";
		#print "id = $id_cl | bal = $balans<br>\n";
	}
	print "</table>\n";
} else {
	print "Остатки по счетам отсутсвуют.<br>\n";
}
?>