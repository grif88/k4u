<?php

$id_podkl=$_GET['id'];
$date_add=$_GET['date_add'];
$date_finish=$_GET['date_finish'];
$cab_less=$_GET['cab_less'];
$id_cab_type=$_GET['id_cab_type'];
$comment=$_GET['comment'];

$id_people='';
$res=mysql_query("SELECT `id` FROM `t_people` ORDER BY `id`");
while ( $tmp=mysql_fetch_assoc($res) ) {
  $id=$tmp['id'];
  if( !isset($id_people) or empty($id_people) ){
   if(isset($_GET["people$id"])){
    $id_people=$_GET["people$id"];
   }
  }else{
   if(isset($_GET["people$id"])){
    $id_people=$id_people.','.$_GET["people$id"];
   }
  }
}

// insert

mysql_query("UPDATE `d_cl_podkl` SET `date`='$php_date',`admin`='$php_user',`admin_ip`='$php_user_ip',`date_add`='$date_add',`date_finish`='$date_finish',`cab_less`='$cab_less',`id_cab_type`='$id_cab_type',`id_people`='$id_people',`comment`='$comment' WHERE `id`='$id_podkl'");

save_close();

?>