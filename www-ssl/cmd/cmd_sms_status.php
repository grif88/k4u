<?php

// body

$res=mysql_query("
SELECT
`sms_log`.`id`, `sms_log`.`requestId`
FROM
`d_sms_log` AS `sms_log`
WHERE
(`sms_log`.`st_date` is NULL OR `sms_log`.`st_date`='')
AND (`sms_log`.`status` is NULL OR `sms_log`.`status`='')
");

if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }

print "Всего к обработке: $res_rows шт.<br><br>\n";

if ( $res_rows > 0 ) { // if begin

while ( $tmp=mysql_fetch_assoc($res) ){
 $id=$tmp['id'];
 $requestId=$tmp['requestId'];
 $ids[$id]=$requestId;
}
#var_dump($ids);

foreach ($ids as $i => $val2) {
 if ( !isset($id_req) or empty($id_req) ) {
  $id_req=$val2;
 } else {
  $id_req.=",$val2";
 }
}
#print $id_req;

$cmd="curl \-X GET https://esputnik.com.ua/api/v1/message/sms/status?ids=$id_req \-H\"Accept: application/json\" \-H\"Content-Type: application/json; charset=KOI8-R\" \-u grif-88@yandex.ru:88gothland91";
#print $cmd;

$answer2=exec($cmd);
print $answer2."<br><br>\n";

$answ_arr1=json_decode($answer2, true, 10);

if ( isset($answ_arr1['results'][0]) ) {
	foreach ($answ_arr1['results'] as $j => $arr2) {
		$status2=$arr2['status'];
		$requestId=$arr2['requestId'];
		$status[$requestId]=$status2;
	}
} else {
	$status2=$answ_arr1['results']['status'];
	$requestId=$answ_arr1['results']['requestId'];
	$status[$requestId]=$status2;
}

foreach ($ids as $z => $val4) {
 $st22=$status[$val4];
 if ( empty($st22) ) { $st22='FAIL'; }
 mysql_query("UPDATE `d_sms_log` SET `st_date`='$php_date', `status`='$st22' WHERE `id`='$z'");
 $tmp_aff_rows=mysql_affected_rows();
 if ( $tmp_aff_rows == 1 ) { $tmp_sql_st='OK'; } else { $tmp_sql_st='Fail'; }
 print "$z - $val4 - $st22 - $tmp_sql_st<br>\n";
 unset($tmp_aff_rows);
}

} // if end
?>