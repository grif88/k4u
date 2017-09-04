<?php
function active_check($id) {
	$php_date_y=date('Y');
	$php_date_m=date('m');
	$res2=mysql_query("SELECT `cl_types`.`zero` FROM `t_cl_types` AS `cl_types`, `d_cl_list` AS `list` WHERE `list`.`id`='$id' AND `cl_types`.`id`=`list`.`id_type`");
	while ( $tmp2=mysql_fetch_assoc($res2) ){
		$cl_zero=$tmp2['zero'];
	}
	if ( $cl_zero == 1 ) { // if cl_zero == 1 begin
		$res55=mysql_query("SELECT `tarifs`.`name`,`tarifs`.`cost`, `tarifs`.`s_upload`, `tarifs`.`s_download` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`id` DESC LIMIT 0,1");
	} else { // if cl_zero == 1 else
		$res55=mysql_query("SELECT `tarifs`.`name`,`tarifs`.`cost`, `tarifs`.`s_upload`, `tarifs`.`s_download` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
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
		$cl_info['active']=0;
		$cl_info['s_upload']='0.000001';
		$cl_info['s_download']='0.000001';
	}
	return $cl_info;
}

function tarif_check($id,$year,$month) {
	$res2=mysql_query("SELECT `cl_types`.`zero` FROM `t_cl_types` AS `cl_types`, `d_cl_list` AS `list` WHERE `list`.`id`='$id' AND `cl_types`.`id`=`list`.`id_type`");
	while ( $tmp2=mysql_fetch_assoc($res2) ){
		$cl_zero=$tmp2['zero'];
	}
	if ( $cl_zero == 1 ) { // if cl_zero == 1 begin
		$res55=mysql_query("SELECT `tarifs`.`id`, `tarifs`.`name` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`id` DESC LIMIT 0,1");
	} else { // if cl_zero == 1 else
		$res55=mysql_query("SELECT `tarifs`.`id`, `tarifs`.`name` FROM `d_cl_tarif_log` AS `tarif_log`, `t_tarifs` AS `tarifs`
WHERE `tarif_log`.`id_client`='$id' AND `tarif_log`.`year`='$year' AND `tarif_log`.`month`='$month' AND `tarifs`.`id`=`tarif_log`.`id_tarif`
ORDER BY `tarif_log`.`id` DESC LIMIT 0,1");
	} // if cl_zero == 1 end
	$res_rows=mysql_num_rows($res55);
	if ( $res_rows == 1 ) {
		while ( $tmp55=mysql_fetch_assoc($res55) ){
			$cl_info['tarif']=$tmp55['name'];
			$cl_info['tarif_id']=$tmp55['id'];
		}
		$cl_info['active']=1;
	} else {
		$cl_info['tarif']='нет';
		$cl_info['tarif_id']=0;
		$cl_info['active']=0;
	}
	return $cl_info;
}

function people($id_people) {
	if ( empty($id_people) ) { $id_people=0; }
	$res=mysql_query("SELECT `surname` FROM `t_people` WHERE `id` IN ($id_people) ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$surname=$tmp['surname'];
		print "$surname<br>";
	}
}

function people_cb($id_people) {
	if ( empty($id_people) ) { $id_people=0; }
	print 'Выполнили:<br>';
	$res=mysql_query("SELECT `id`,`surname` FROM `t_people` WHERE `id` IN ($id_people) ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$surname=$tmp['surname'];
		print "<input checked type=\"checkbox\" name=\"people$id\" value=\"$id\" />$surname<br>";
	}
	$res=mysql_query("SELECT `id`,`surname` FROM `t_people` WHERE `id` NOT IN ($id_people) AND `view`='1' ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$surname=$tmp['surname'];
		print "<input type=\"checkbox\" name=\"people$id\" value=\"$id\" />$surname<br>";
	}
}

function res_info($id,$date,$admin,$admin_ip) {
	print "<img onclick=\"javascript:alert('$id | $date | $admin | $admin_ip');\" src=\"img/info_pic.png\" border=\"0\" title=\"$id | $date | $admin | $admin_ip\" />";
}

function region_list($tab_ind) {
	print "<select tabindex=\"$tab_ind\" name=\"id_region\">";
	$res=mysql_query("SELECT `id`,`region` FROM `t_regions` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$region=$tmp['region'];
		print "<option value=\"$id\">$region</option>";
	}
	print '</select>';
}

function region_kassa($sel) {
	if(empty($sel)){$sel=0;}
	print '<select name="id_region">';
	$id=0;
	$region='ВСЕ РАЙОНЫ';
	print '<option '; if($sel==$id){print'selected ';} print "value=\"$id\">$region</option>";
	$res=mysql_query("SELECT `id`,`region` FROM `t_regions` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$region=$tmp['region'];
		print "<option "; if($sel==$id){print"selected ";} print "value=\"$id\">$region</option>";
	}
	print '</select>';
}

function street_list($tab_ind) {
	print "<select tabindex=\"$tab_ind\" name=\"id_street\">";
	$res=mysql_query("SELECT `id`,`street` FROM `t_streets` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$street=$tmp['street'];
		print "<option value=\"$id\">$street</option>";
	}
	print '</select>';
}

function street_list_f($tab_ind,$sel) {
	print "<select tabindex=\"$tab_ind\" name=\"id_street\">";
	$res=mysql_query("SELECT `id`,`street` FROM `t_streets` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$street=$tmp['street'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$street</option>";
	}
print '</select>';
}

function cab_types($tab_ind,$sel) {
	if ( empty($sel) ) { $sel=0; }
	print "<select tabindex=\"$tab_ind\" name=\"id_cab_type\">";
	print '<option '; if ( $sel == 0 ) { print 'selected '; } print 'value="0">!!!</option>';
	$res=mysql_query("SELECT `id`,`type` FROM `t_cab_type` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$type=$tmp['type'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$type</option>";
	}
	print '</select>';
}

function cab_types_view($sel) {
	if ( $sel == 0 ) { print '!!!'; } else { // if begin
		$res=mysql_query("SELECT `type` FROM `t_cab_type` WHERE `id`='$sel'");
		while ( $tmp=mysql_fetch_assoc($res) ){
			$type=$tmp['type'];
			print $type;
		}
	} // if end
}

function cl_types($tab_ind,$sel) {
	print "<select tabindex=\"$tab_ind\" name=\"id_cl_type\">";
	$res=mysql_query("SELECT `id`,`type`,`zero` FROM `t_cl_types` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$type=$tmp['type'];
		$zero=$tmp['zero'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$type ($zero)</option>";
	}
	print '</select>';
}

function t_kassa_s($sel) {
	print '<select name="id_kassa">';
	$res=mysql_query("SELECT `id`,`name`,`ip` FROM `t_kassa` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$name=$tmp['name'];
		$ip=$tmp['ip'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$name ($ip)</option>";
	}
	print '</select>';
}

//---------------------------------------------------------
function tarifs_sel($sel) {
	$php_user=$_SERVER['PHP_AUTH_USER'];
	print '<select name="id_tarif">';

	$res2=mysql_query("SELECT `add_abon_pl-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
	if ( $res2 ) { // if $res2 begin
		while ( $tmp2=mysql_fetch_assoc($res2) ){
			$access2=$tmp2['add_abon_pl-adm'];
		}
	} // if $res2 end

	if ( $sel == 0 ) { // if $sel = 0 begin

		/*$res2=mysql_query("SELECT `add_abon_pl-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
		if ( $res2 ) { // if $res2 begin
		 while ( $tmp2=mysql_fetch_assoc($res2) ){
		  $access2=$tmp2["add_abon_pl-adm"];
		 }
		} // if $res2 end*/

		if ( $access2 == 1 ) {
			$res=mysql_query("SELECT `id`,`name`,`cost` FROM `t_tarifs` WHERE `view`='1' ORDER BY `poss`");
		} else {
			$res=mysql_query("SELECT `id`,`name`,`cost` FROM `t_tarifs` WHERE `view`='1' AND `open`='1' ORDER BY `poss`");
		}
		while ( $tmp=mysql_fetch_assoc($res) ){
			$id=$tmp['id'];
			$name=$tmp['name'];
			$cost=$tmp['cost'];
			print "<option value=\"$id\">$name ($cost грн)</option>";
		}

	} else { // if $sel = 0 else

		/*$res2=mysql_query("SELECT `add_abon_pl-adm` FROM `t_access` WHERE `name`='$php_user' AND `deleted`='0'");
		if ( $res2 ) { // if $res2 begin
		 while ( $tmp2=mysql_fetch_assoc($res2) ){
		  $access2=$tmp2["add_abon_pl-adm"];
		 }
		} // if $res2 end*/

		$res33=mysql_query("SELECT `next_id` FROM `t_tarifs` WHERE `id`='$sel'");
		while ( $tmp33=mysql_fetch_assoc($res33) ){
			$next_id33=$tmp33['next_id'];
		}
		if ( !empty($next_id33) and $next_id33 != 0 ) { $sel=$next_id33; }
		$res44=mysql_query("SELECT `open`,`cost` FROM `t_tarifs` WHERE `id`='$sel'");
		while ( $tmp44=mysql_fetch_assoc($res44) ){
			$open33=$tmp44['open'];
			$cost_old=$tmp44['cost'];
		}

		if ( $access2 == 1 ) {
			$res=mysql_query("SELECT `id`,`name`,`cost`,`cost_down` FROM `t_tarifs` WHERE `view`='1' ORDER BY `poss`");
		} else {
			/* $res33=mysql_query("SELECT `next_id` FROM `t_tarifs` WHERE `id`='$sel'");
			 while ( $tmp33=mysql_fetch_assoc($res33) ){
			  $next_id33=$tmp33["next_id"];
			 }
			 if ( !empty($next_id33) and $next_id33 != 0 ) { $sel=$next_id33; }
			 $res44=mysql_query("SELECT `open`,`cost` FROM `t_tarifs` WHERE `id`='$sel'");
			 while ( $tmp44=mysql_fetch_assoc($res44) ){
			  $open33=$tmp44["open"];
			  $cost_old=$tmp44["cost"];
			 }*/
			if ( $open33 == 0 ) { $res=mysql_query("SELECT `id`,`name`,`cost`,`cost_down` FROM `t_tarifs` WHERE `id`='$sel'"); }
			else { $res=mysql_query("SELECT `id`,`name`,`cost`,`cost_down` FROM `t_tarifs` WHERE `view`='1' AND `open`='1' ORDER BY `poss`"); }
		}
		while ( $tmp=mysql_fetch_assoc($res) ){
			$id=$tmp['id'];
			$name=$tmp['name'];
			$cost=$tmp['cost'];
			$cost_down=$tmp['cost_down'];
			if ( $id == $sel ) { $cost_new=$cost; $tmp1=''; } else {
				if ( $cost_old > $cost ) {
					if ( $cost_down != 0 ) {
						$cost_new=$cost+$cost_down;
						$tmp1=' понижение';
					} else {
						$cost_new=$cost;
						$tmp1='';
					}
				} else {
					$cost_new=$cost;
					$tmp1='';
				}
			}
			print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$name ($cost_new грн)$tmp1</option>";
		}
	} // if $sel = 0 end
	print '</select>';
}
//-----------------------------------------------------------------

function year_sel($sel) {
	$year_prev=$sel-1;
	print '<select name="year">';
	print "<option value=\"$year_prev\">$year_prev</option>";
	print "<option selected value=\"$sel\">$sel</option>";
	$year_next=$sel;
	for ($i=0; $i!=4; $i++) {
		$year_next=$year_next+1;
		print "<option value=\"$year_next\">$year_next</option>";
	}
	print '</select>';
}

function month_sel($sel) {
	include './include/month.php';
	print '<select name="month">';
	for ($i=1; $i<=12; $i++) {
		if ( $i <= 9 ) { $month='0'.$i; } else { $month=$i; }
		print '<option '; if ( $month == $sel ) { print 'selected '; } print "value=\"$month\">".$mon_name["$month"].'</option>';
	}
	print '</select>';
}

function save_close() {
	print "<script type=\"text/javascript\">window.opener.location.reload(); window.close();</script>\n";
}

function save_close_bal($id) {
	print "<script type=\"text/javascript\">window.opener.location.reload(); document.location=\"?win&cmd=add_abon_pl&id=$id\";</script>\n";
}

function butt_back($mess) {
	print "<center>
$mess<br><br>
<span class=\"clr_red\">Операция не выполнена!</span><br><br>
<input tabindex=\"99\" type=\"button\" value=\"Повторить операцию\" onclick=\"javascript:history.back();\">
</center>\n";
}

function butt_close($mess) {
	print "<center>
$mess<br><br>
<span class=\"clr_red\">Операция не выполнена!</span><br><br>
<input tabindex=\"99\" type=\"button\" value=\"Закрыть\" onclick=\"javascript:window.close();\">
</center>\n";
}

function popup_win($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\"><img src=\"img/edit_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_win2($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\"><img src=\"img/view_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_add($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\"><img src=\"img/add_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_del($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\"><img src=\"img/del_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_add_abon_pl($cmd,$name,$width,$height,$podkl,$otkl) {
	if ( $podkl == 1 && $otkl == 0 ) { $butt_st=''; } else { $butt_st='disabled '; }
	print '<input '.$butt_st."type=\"button\" onclick=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\" value=\"Внести тариф\" />";
}

function popup_add_balans($cmd,$name,$width,$height) {
	print "<input type=\"button\" onclick=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\" value=\"Пополнить счет\" />";
}

function popup_prn($cmd,$name,$width,$height,$value) {
	print "<input type=\"button\" class=\"inp_small\" onclick=\"javascript:win_open_prn('$cmd','$name','50','0','$width','$height');\" value=\"$value\" />";
}

function popup_queue($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','200','0','$width','$height');\"><img src=\"img/queue_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_stat($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','50','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/stat_log.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_view($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','50','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/view_log.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_log($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','0','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/bash.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_log1($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','0','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/pinger.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_graph($src,$iface,$name) {
	print "<a href=\"javascript:win_open('cmd=view_graph&src=$src&iface=$iface','$name','0','50','1250','500');\" title=\"Graph\">$iface</a>";
}

function popup_todo($cmd,$name,$title,$anim,$width,$height) {
	if ( $anim != 0 ) { $src2='img/todo_log_a.gif'; } else { $src2='img/todo_log.png'; }
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','0','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"$src2\" border=\"0\" title=\"$title\"></a>";
}

function mkt_stat($cmd,$login,$name,$title,$width,$height) {
	$cmd.="&login=$login";
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','200','0','$width','$height');\"><img src=\"img/graphs/gd2_conn2.php?login=$login\" border=\"0\" title=\"$title\"></a>";
}

function dhcp_stat($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','50','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/find.png\" border=\"0\" title=\"$title\"></a>";
}

function conn_list($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','50','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/conn_list.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_iface($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open('$cmd','$name','200','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/queue_pic.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_sms($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','50','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/phone.png\" border=\"0\" title=\"$title\"></a>";
}

function popup_privat($cmd,$name,$title,$width,$height) {
	print "<a href=\"javascript:win_open_sbar('$cmd','$name','20','0','$width','$height');\"><img width=\"16\" height=\"16\" src=\"img/privat.png\" border=\"0\" title=\"$title\"></a>";
}

function ins_ch_status($date,$admin,$admin_ip,$id_client,$name,$active,$speed) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`active`,`speed`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','ch_status','$name','$active','$speed','0')");
}

function ins_drop($date,$admin,$admin_ip,$id_client,$name) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','drop','$name','0')");
}

function ins_unlock($date,$admin,$admin_ip,$id_client,$name) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','unlock_mac','$name','0')");
}

function ins_active($date,$admin,$admin_ip,$id_client,$name,$active,$speed) {
	$res=mysql_query("SELECT `cl_ip` FROM `d_cl_list` WHERE `id`='$id_client'");
	while ( $tmp=mysql_fetch_assoc($res) ) { $cl_ip=$tmp['cl_ip']; }
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`active`,`speed`,`cl_ip`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','active','$name','$active','$speed','$cl_ip','0')");
}

function ins_block($date,$admin,$admin_ip,$id_client,$name,$active) {
	$res=mysql_query("SELECT `cl_ip` FROM `d_cl_list` WHERE `id`='$id_client'");
	while ( $tmp=mysql_fetch_assoc($res) ) { $arr_ip=explode('.',$tmp['cl_ip']); }
	$cl_ip='10.11.'.$arr_ip[2].'.'.$arr_ip[3];
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`active`,`cl_ip`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','block','$name','$active','$cl_ip','0')");
}

function ins_add_secret($date,$admin,$admin_ip,$id_client,$name,$active,$speed,$passwd,$cl_ip,$cl_mac) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`active`,`speed`,`passwd`,`cl_ip`,`cl_mac`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','add_secret','$name','$active','$speed','$passwd','$cl_ip','$cl_mac','0')");
}

function ins_rem_secret($date,$admin,$admin_ip,$id_client,$name) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','rem_secret','$name','0')");
}

function ins_ch_secret($date,$admin,$admin_ip,$id_client,$name,$passwd,$cl_ip,$cl_mac) {
	mysql_query("INSERT INTO `d_todo_list` (`date`,`admin`,`admin_ip`,`id_client`,`action`,`name`,`passwd`,`cl_ip`,`cl_mac`,`done`) VALUES ('$date','$admin','$admin_ip','$id_client','ch_secret','$name','$passwd','$cl_ip','$cl_mac','0')");
}

function sw_list($tab_ind) {
	print "<select tabindex=\"$tab_ind\" name=\"id_switch\">";
	$res=mysql_query("SELECT `id`,`name`,`comment` FROM `d_sw_list` ORDER BY `name`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$name=$tmp['name'];
		$comment=$tmp['comment'];
		print "<option value=\"$id\">$name ($comment)</option>";
	}
	print '</select>';
}

function sw_types($tab_ind,$sel) {
	print "<select tabindex=\"$tab_ind\" name=\"id_type\">";
	$res=mysql_query("SELECT `id`,`model`,`ports` FROM `t_dev_type` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$model=$tmp['model'];
		$ports=$tmp['ports'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$model ($ports)</option>";
	}
	print '</select>';
}

function sup_types($tab_ind,$sel) {
	print "<select tabindex=\"$tab_ind\" name=\"sup_id_type\">";
	$res=mysql_query("SELECT `id`,`name` FROM `t_supply` ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$id=$tmp['id'];
		$name=$tmp['name'];
		print '<option '; if ( $id == $sel ) { print 'selected '; } print "value=\"$id\">$name</option>";
	}
	print '</select>';
}

function ssh_query($cmd4,$mkt) {
	include './include/global.php';
	exec("sshpass -p 'hellowoll2-debbi' ssh debbi@".$mkt_ip[$mkt]." $cmd4",$arr1);
	return $arr1;
}

function ch_balans($id,$summa) {
	include './include/global.php';
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
?>