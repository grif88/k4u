<?php

$id_data=$_GET['id'];
$surname=$_GET['surname'];
$name=$_GET['name'];
$secname=$_GET['secname'];
$phone=$_GET['phone'];
$doc=$_GET['doc'];
$doc_seriya=$_GET['doc_seriya'];
$doc_number=$_GET['doc_number'];
$doc_when=$_GET['doc_when'];
$doc_bywho=$_GET['doc_bywho'];
$date_dog=$_GET['date_dog'];
$comment=$_GET['comment'];
$sms_phone=$_GET['sms_phone'];

// check

if ( strlen($sms_phone) > 0 and strlen($sms_phone) < 12 ) {
 butt_back('Неверный телефон для SMS');
} else {

// insert

mysql_query("UPDATE `d_cl_data` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`surname`='$surname',`name`='$name',`secname`='$secname',`phone`='$phone',`doc`='$doc',`doc_seriya`='$doc_seriya',`doc_number`='$doc_number',`doc_when`='$doc_when',`doc_bywho`='$doc_bywho',`date_dog`='$date_dog',`comment`='$comment',`sms_phone`='$sms_phone' WHERE `id`='$id_data'");

save_close();
}

?>