<?php
// functions

function active_check($id) {
	$php_date_y=date('Y');
	$php_date_m=date('m');
	$res2=mysql_query("SELECT `cl_types`.`zero` FROM `t_cl_types` AS `cl_types`, `d_cl_list` AS `list` WHERE `list`.`id`='$id' AND `cl_types`.`id`=`list`.`id_type`");
	while ( $tmp2=mysql_fetch_assoc($res2) ){
		$cl_zero=$tmp2['zero'];
	}
	if ( $cl_zero == 1 ) { // if cl_zero == 1 begin
		$res55=mysql_query("SELECT `tarifs`.`name`,`tarifs`.`cost`,`tarifs`.`s_upload`,`tarifs`.`s_download` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`id` DESC LIMIT 0,1");
	} else { // if cl_zero == 1 else
		$res55=mysql_query("SELECT `tarifs`.`name`,`tarifs`.`cost`,`tarifs`.`s_upload`,`tarifs`.`s_download` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id' AND `tarif_log`.`year`='$php_date_y' AND `tarif_log`.`month`='$php_date_m' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`id` DESC LIMIT 0,1");
	} // if cl_zero == 1 end
	$res_rows=mysql_num_rows($res55);
	if ( $res_rows == 1 ) {
		while ( $tmp55=mysql_fetch_assoc($res55) ){
			$cl_info['tarif']=$tmp55['name'];
			$cl_info['cost']=$tmp55['cost'];
			$cl_info['s_upload']=$tmp55['s_upload'];
			$cl_info['s_download']=$tmp55['s_download'];
		}
		$cl_info['active']=1;
	} else {
		$cl_info['tarif']='нет';
		$cl_info['cost']=0;
		$cl_info['s_upload']=0;
		$cl_info['s_download']=0;
		$cl_info['active']=0;
	}
	return $cl_info;
}

// body

$cl_id=$_SESSION['cl_id'];
$stat_res=mysql_query("SELECT
`list`.`login`, `list`.`passwd`, `list`.`cl_mac`, `list`.`house`, `list`.`room`,
`data`.`surname`, `data`.`name`, `data`.`secname`, `data`.`phone`,
`streets`.`street`
FROM
`d_cl_list` AS `list`,
`d_cl_data` AS `data`,
`t_streets` AS `streets`
WHERE
`list`.`id`='$cl_id'
AND `data`.`id_client`=`list`.`id`
AND `streets`.`id`=`list`.`id_street`");
while ( $stat_tmp=mysql_fetch_assoc($stat_res) ) {
	$login=$stat_tmp["login"];
	$passwd=$stat_tmp["passwd"];
	$cl_mac=$stat_tmp["cl_mac"];
	$street=$stat_tmp["street"];
	$house=$stat_tmp["house"];
	$room=$stat_tmp["room"];
	$surname=$stat_tmp["surname"];
	$name=$stat_tmp["name"];
	$secname=$stat_tmp["secname"];
	$phone=$stat_tmp["phone"];
}

$dog_num='';
while ( strlen($dog_num) != 6 ) { if ( !empty($dog_num) ) { $dog_num='0'.$dog_num; } else { $dog_num=$cl_id; } }
if ( strlen($cl_mac) == 0 ) { $cl_mac='не привязан'; }

$cl_info=active_check($cl_id);
if ( $cl_info['active'] == 1 ) {
	$cl_status2="<span class=\"cl_active\">активен</span>";
} else {
	$cl_status2="<span class=\"cl_block\">заблокирован</span>";
}
$tarif_name_now2=$cl_info["tarif"].'&nbsp;('.$cl_info["cost"].'грн)';
$tarif_speed=$cl_info["s_download"].' МБит/сек / '.$cl_info["s_upload"].' МБит/сек';

$balans=0;
$res3=mysql_query("SELECT `balans` FROM `d_cl_balans` WHERE `id_client`='$cl_id'");
if ( mysql_num_rows($res3) == 1 ) {
	while ( $tmp3=mysql_fetch_assoc($res3) ){
		$balans=$tmp3['balans'];
	}
}
if ( $balans == 0 ) { $bal_print='<span>'.$balans.' грн</span>'; }
if ( $balans > 0 ) { $bal_print='<span class="bal_norm">'.$balans.' грн</span>'; }
if ( $balans < 0 ) { $bal_print='<span class="bal_minus">'.$balans.' грн</span>'; }

print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr valign=\"top\">
<td>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr><td>Ф.И.О.</td><td>$surname $name $secname</td></tr>
<tr><td>№ договора</td><td>$dog_num</td></tr>
<tr><td>Адрес</td><td>ул. $street д. $house кв. $room</td></tr>
<tr><td>Телефон</td><td>$phone</td></tr>
<tr><td>Тариф (стоимость)</td><td>$tarif_name_now2</td></tr>
<tr><td>Скорость (прием/отдача)</td><td>$tarif_speed</td></tr>
<tr><td>Баланс</td><td>$bal_print</td></tr>
</table>
</td>
<td width=\"40\">&nbsp;</td>
<td>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr><td>Логин</td><td>$login</td></tr>
<tr><td>Пароль</td><td>$passwd</td></tr>
<tr><td>MAC адрес</td><td>$cl_mac</td></tr>
<tr><td>Состояние</td><td>$cl_status2</td></tr>
</table>
</td>
</tr></table>\n";
?>