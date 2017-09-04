<?php

// functions

function gen_ip($id_str) {
 $res=mysql_query("SELECT `ip_pool`,`counter` FROM `t_streets` WHERE `id`='$id_str'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $ip_pool=$tmp['ip_pool'];
  $counter=$tmp['counter'];
 }
 $new_ip_s=$counter+1;
 $new_ip=$ip_pool.$new_ip_s;
 mysql_query("UPDATE `t_streets` SET `counter`='$new_ip_s' WHERE `id`='$id_str'");
 return $new_ip;
}

function gen_login($id_str,$house1,$room1) {
 $res=mysql_query("SELECT `code` FROM `t_streets` WHERE `id`='$id_str'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $code=$tmp['code'];
 }
 $new_login=$code.$house1.'k'.$room1;
 return $new_login;
}

// input

$surname=$_GET['surname'];
$name=$_GET['name'];
$secname=$_GET['secname'];
$phone=$_GET['phone'];
$id_region=$_GET['id_region'];
$id_street=$_GET['id_street'];
$house=$_GET['house'];
$room=$_GET['room'];
$comment=$_GET['comment'];
$res=mysql_query("SELECT `region` FROM `t_regions` WHERE `id`='$id_region'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $region=$tmp['region'];
}
$res=mysql_query("SELECT `street` FROM `t_streets` WHERE `id`='$id_street'");
while ( $tmp=mysql_fetch_assoc($res) ){
 $street=$tmp['street'];
}
print "$surname $name $secname ($phone)<br>
р. $region - ул. $street д. $house кв. $room<br>
$comment<br>
<hr>\n";

if ( !empty($id_region) && !empty($id_street) && !empty($house) && !empty($room) ) { // if empty begin

// if exist

$res3=mysql_query("SELECT `id`,`login` FROM `d_cl_list` WHERE `id_street`='$id_street' AND `house`='$house' AND `room`='$room'");
$rows_res3=mysql_num_rows($res3);
while ( $tmp3=mysql_fetch_assoc($res3) ){ // begin select exist
 $id_res=$tmp3['id'];
 $login_res=$tmp3['login'];
 
if ( $id_res ) { // if d_cl_list
 print "Такой абонент уже существует (id = $id_res). <a href=\"?cmd=view_abon&id=$id_res\">$login_res</a><br>\n";
 $res=mysql_query("SELECT `date_finish` FROM `d_cl_podkl` WHERE `id_client`='$id_res'");
 while ( $tmp=mysql_fetch_assoc($res) ){
  $date_finish=$tmp['date_finish'];
 }
 if ( !empty($date_finish) ) { // if d_cl_podkl
  print "Абонент подключен ($date_finish).<br>\n";
  $res2=mysql_query("SELECT `date_finish` FROM `d_cl_otkl` WHERE `id_client`='$id_res'");
  while ( $tmp2=mysql_fetch_assoc($res2) ){
   $date_finish2=$tmp2['date_finish'];
  }
  $rows_res2=0;
  $rows_res2=mysql_num_rows($res2);
  if ( $rows_res2 != 0 ) { // if d_cl_otkl
   if ( !empty($date_finish2) ) { // if d_cl_otkl 2
    print "Абонент был отключен ($date_finish2).<br>\n";
	$rows_res3--;
   } else { // else d_cl_otkl 2
    print "Стоит в очереди на отключение.<br>\n";
   } // end d_cl_otkl 2
  } else { // else d_cl_otkl
   print "Абонент активен.<br>\n";
  } // end d_cl_otkl
 } else { // else d_cl_podkl
  print "Стоит в очереди на подключение.<br>\n";
 } // end d_cl_podkl
} else { // else d_cl_list
 $rows_res3--;
} // end d_cl_list
 print "<br>\n";
} // end select exist

// adding

if ( $rows_res3 == 0 ) {
 $new_ip1=gen_ip($id_street);
 $id_type=1;
 $login=gen_login($id_street,$house,$room);
 $passwd=mt_rand(11111111,99999999);
 $doc='Паспорт';
 
 mysql_query("INSERT INTO `d_cl_list` (date,admin,admin_ip,login,passwd,cl_ip,id_type,id_region,id_street,house,room) VALUES ('$php_date','$php_user','$php_user_ip','$login','$passwd','$new_ip1','$id_type','$id_region','$id_street','$house','$room')");
 $id_client=mysql_insert_id();
 mysql_query("INSERT INTO `d_cl_data` (date,admin,admin_ip,id_client,surname,name,secname,phone,doc) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$surname','$name','$secname','$phone','$doc')");
 mysql_query("INSERT INTO `d_cl_podkl` (date,admin,admin_ip,id_client,date_add,comment) VALUES ('$php_date','$php_user','$php_user_ip','$id_client','$php_date_s','$comment')");
 print "Добавлен. id=$id_client <a href=\"?cmd=view_abon&id=$id_client\">$login</a><br>\n";
 
} else { print "Не добавлен.<br>\n"; }

} else { print "Данные не введены.<br>\n"; } // if empty end

?>