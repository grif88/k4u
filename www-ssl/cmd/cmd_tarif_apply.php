<?php
if ( isset($_GET['id']) and !empty($_GET['id']) ) {
$id=$_GET['id'];

$res55=mysql_query("SELECT `tarifs`.`s_upload`, `tarifs`.`s_download` FROM `t_tarifs` AS `tarifs` WHERE `tarifs`.`id`='$id'");
$res_rows55=mysql_num_rows($res55);
if ( $res_rows55 == 1 ) {
	while ( $tmp55=mysql_fetch_assoc($res55) ){
		$s_upload=$tmp55['s_upload'];
		$s_download=$tmp55['s_download'];
	}
$s_upload=$s_upload*1000000;
$s_download=$s_download*1000000;
$temp_speed=$s_upload.'/'.$s_download;

$res=mysql_query("
SELECT
`cl_list`.`id`, `cl_list`.`login`
FROM
`d_cl_list` AS `cl_list`,
`d_cl_tarif_log` AS `tarif_log`
WHERE
`tarif_log`.`id_tarif`='$id'
AND `tarif_log`.`year`='$php_date_y'
AND `tarif_log`.`month`='$php_date_m'
AND `cl_list`.`id`=`tarif_log`.`id_client`
ORDER BY `cl_list`.`id`
");
$res_rows=mysql_num_rows($res);
if ( $res_rows > 0 ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id_list=$tmp['id'];
 $login=$tmp['login'];
 ins_active($php_date,$php_user,$php_user_ip,$id_list,$login,'1',$temp_speed);
 print "$php_date, $php_user, $php_user_ip, $id_list, $login, '1', $temp_speed<br>\n";
} // while
} // if
print "В обработку было принято $res_rows строк<br>\n";

} else { print "<center>Тариф не найден</center>\n"; }

} else {
	print "<center>Тариф не выбран</center>\n";
}
?>