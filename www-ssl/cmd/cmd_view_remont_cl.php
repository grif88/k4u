<?php

// input

if ( isset($_GET['id']) ) { $id=$_GET['id']; // if id begin

// body

$res2=mysql_query("SELECT `login` FROM `d_cl_list` WHERE `id`='$id'");
while ( $tmp2=mysql_fetch_assoc($res2) ){
 $login=$tmp2['login'];
}

$res=mysql_query("
SELECT
`remont`.`id` AS `id_remont`, `remont`.`date`, `remont`.`admin`, `remont`.`admin_ip`, `remont`.`reason`, `remont`.`date_add`, `remont`.`date_finish`, `remont`.`id_people`, `remont`.`comment`
FROM
`d_cl_remont` AS `remont`
WHERE
`remont`.`id_client`='$id'
ORDER BY `remont`.`id` DESC
");
 if ( $res ) { $res_rows=mysql_num_rows($res); } else { $res_rows=0; }
 
print "<center>id=$id <strong>$login</strong> (Всего повреждений: $res_rows)&nbsp;
<input type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.opener.location.reload(); window.close();\"></center>
<table class=\"table_st-none\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\" border=\"1\">
<tr class=\"clr_back_grey\"><td align=\"center\">i</td><td align=\"center\">Дата подачи</td><td align=\"center\">Причина</td><td align=\"center\">Дата устранения</td><td align=\"center\">Выполнил</td><td align=\"center\">Примечание</td></tr>\n";
if ( $res ) { // if
while ( $tmp=mysql_fetch_assoc($res) ){
 $id_remont=$tmp['id_remont'];
 $date=$tmp['date'];
 $admin=$tmp['admin'];
 $admin_ip=$tmp['admin_ip'];
 $reason=$tmp['reason'];
 $date_add=$tmp['date_add'];
 $date_finish=$tmp['date_finish'];
 $id_people=$tmp['id_people'];
 $comment=$tmp['comment'];
 print '<tr><td>'; res_info($id_remont,$date,$admin,$admin_ip); print "</td><td>$date_add "; popup_win("cmd=edit_remont&id=$id_remont",'edit_rem','Редактировать',400,400); print "</td><td>$reason</td><td>$date_finish</td><td>"; people($id_people); print "</td><td>$comment</td></tr>\n";
}
} // if
print "</table>\n";

} // if id end
else { print "<br><center>ID не выбран</center>\n"; }
?>