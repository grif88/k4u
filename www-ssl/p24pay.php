<?php
if ( isset($_POST['payment']) and !empty($_POST['payment']) ) { // global 1
$payment=$_POST['payment'];
if ( isset($_POST['signature']) and !empty($_POST['signature']) ) { // global 2
$signature=$_POST['signature'];

include './include/admin.php';
include './include/p24merch.php';

// function begin
function ch_balans($id,$summa) {
$php_user='privat24';
$php_user_ip=$_SERVER['REMOTE_ADDR'];
$php_date=date('d.m.Y-H:i:s');
$res=mysql_query("SELECT `id`,`balans` FROM `d_cl_balans` WHERE `id_client`='$id'");
$num_res=mysql_num_rows($res);
if ( $num_res == 1 ) {
  while ( $tmp=mysql_fetch_assoc($res) ){
    $id1=$tmp['id'];
    $balans1=$tmp['balans'];
  }
  $balans=$balans1+$summa;
  mysql_query("UPDATE `d_cl_balans` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`balans`='$balans' WHERE `id`='$id1'");
} else {
  $balans=$summa;
  mysql_query("INSERT INTO `d_cl_balans` (`date`,`admin`,`admin_ip`,`id_client`,`balans`) VALUES ('$php_date','$php_user','$php_user_ip','$id','$balans')");
}
}
// function end

#$payment='amt=22.25&ccy=UAH&details=книга Будь здоров!&ext_details=1000BDN01&pay_way=privat24&order=105&merchant= 75482&state=fail&date=060814080113&ref=aBESQ2509023364513&payCountry=UA';
#$signature=sha1(md5($payment.$pass));

$signature2=sha1(md5($payment.$pass));

if ( $signature == $signature2 ) { // if signature
	$arr1=explode('&',$payment);
	#var_dump($arr1);
	foreach ( $arr1 as $value1 ) {
		#print "$value1<br>";
		$arr2=explode('=',$value1);
		$temp2=$arr2[0];
		$arr3[$temp2]=$arr2[1];
	}
	#var_dump($arr3);
	#$summa=$arr3['amt'];
	$summa2=$arr3['amt'];
	#$summa=round($summa2-($summa2/100*$komis), 2);
	$summa=round($summa2-(($summa2/(100+$komis))*$komis), 2);
	$nocash_id=$arr3['order'];
	$state=$arr3['state'];
	$date=$arr3['date'];
	$date2=$date[0].$date[1].'.'.$date[2].$date[3].'.'.$date[4].$date[5].'-'.$date[6].$date[7].':'.$date[8].$date[9].':'.$date[10].$date[11];
	$ref2=$arr3['ref'];
	$ref=iconv("UTF-8", "Windows-1251", $ref2)." ($summa2)";
	$rem_ip=$_SERVER['REMOTE_ADDR'];
	#print $date2;
	$res11=mysql_query("SELECT `id_client` FROM `d_no_cash` WHERE `id`='$nocash_id' AND (`fail` IS NULL OR `fail`!='0')");
	if ( mysql_num_rows($res11) > 0 ) { // if res11
		while ( $tmp11=mysql_fetch_assoc($res11) ){
			$id_client=$tmp11['id_client'];
		}
		
		$php_date=date('d.m.Y-H:i:s');
		if ( $state == 'ok' ) {
			$fail=0;
			mysql_query("UPDATE `d_no_cash` SET `pay_date`='$php_date',`pay_comment`='$ref',`date2`='$date2',`admin2`='privat24',`admin_ip2`='$rem_ip',`summa`='$summa',`fail`='$fail' WHERE `id`='$nocash_id'");
			$php_kassa_date=date('Y-m-d');
			mysql_query("INSERT INTO `d_cl_balans_log` (`date`,`admin`,`admin_ip`,`id_client`,`summa`,`id_kassa`,`cash`,`comment`,`kassa_date`) VALUES ('$php_date','privat24','$rem_ip','$id_client','$summa','6','1','пополнение через Приват24','$php_kassa_date')");
			ch_balans($id_client,$summa);
		}
		
		if ( $state == 'fail' ) {
			$fail=1;
			mysql_query("UPDATE `d_no_cash` SET `pay_date`='$php_date',`pay_comment`='$ref',`date2`='$date2',`admin2`='privat24',`admin_ip2`='$rem_ip',`summa`='$summa',`fail`='$fail' WHERE `id`='$nocash_id'");
		}
	} // end res11
} // end signature
} // global 1
} // global 2
?>