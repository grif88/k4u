<?php
mysql_select_db('db_k4u_billing');
// ------------------------------------------------
if ( isset($_POST['auth']) && $_POST['auth'] == 1 ) {
	$login=addslashes($_POST['login']);
	$passwd=addslashes($_POST['passwd']);
	#print "$login - $passwd<br>";
	$stat_res=mysql_query("SELECT `id`,`login` FROM `d_cl_list` WHERE `login`='$login' AND `passwd`='$passwd'");
	$stat_res_num=mysql_num_rows($stat_res);
	if ( $stat_res_num == 1 ) {
		while ( $stat_tmp=mysql_fetch_assoc($stat_res) ) {
			$cl_id=$stat_tmp['id'];
			$cl_login=$stat_tmp['login'];
		}
		$stat_res_otkl=mysql_query("SELECT `id` FROM `d_cl_otkl` WHERE `id_client`='$cl_id'");
		$stat_res_otkl_num=mysql_num_rows($stat_res_otkl);
		if ( $stat_res_otkl_num == 1 ) {
			print "<center>Абонент отключен!<br><br></center>\n";
		} else {
			$_SESSION['cl_id']=$cl_id;
			$_SESSION['cl_login']=$cl_login;
			$s_id=session_id();
			$php_date=date('d.m.Y-H:i:s');
			$php_user_ip=$_SERVER['REMOTE_ADDR'];
			$php_user_client=$_SERVER['HTTP_USER_AGENT'];
			$ses_res_num=0;
			$ses_res=mysql_query("SELECT `id` FROM `d_cl_stat_log` WHERE `id_session`='$s_id' AND `id_client`='$cl_id'");
			$ses_res_num=mysql_num_rows($ses_res);
			if ( $ses_res_num == 0 ) {
				mysql_query("INSERT INTO `d_cl_stat_log` (`id_session`,`date_start`,`client_ip`,`id_client`,`browser`) VALUES ('$s_id','$php_date','$php_user_ip','$cl_id','$php_user_client')");
			}
		}
	} else {
		print "<center>Логин или пароль введен не верно!<br><br></center>\n";
	}
}
// ------------------------------------------------
if ( empty($_SESSION['cl_id']) ) {
	include './cmd/cmd_stat_auth.php';
} else {
	if ( isset($_POST['opt']) ) { $opt=$_POST['opt']; }
	if ( isset($_GET['opt']) ) { $opt=$_GET['opt']; } else { $opt='show'; }
	print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr>\n";
	print "<td width=\"20\" align=\"center\">|</td>\n";

	$res=mysql_query("SELECT `title`,`cmd` FROM `opt_menu` WHERE `view`='1' ORDER BY `poss`");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$title=$tmp['title'];
		$cmd2=$tmp['cmd'];
  
		if ( $opt == $cmd2 ) {
			print "<td class=\"func5\">$title</td>\n";
		} else {
			print "<td onmouseover=\"javascript:this.style.backgroundColor='#FFFFFF';\" onmouseout=\"javascript:this.style.backgroundColor=document.body.style.backgroundColor;\" class=\"func4\"><a href=\"?cmd=stat&opt=$cmd2\">$title</a></td>\n";
		}
		print "<td width=\"20\" align=\"center\">|</td>\n";
	} // while
	print "</tr></table>\n<br>\n";
	// soucre include
	$res=mysql_query("SELECT `src` FROM `opt_menu` WHERE `cmd`='$opt'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$src=$tmp['src'];
		include "./cmd/$src";
	}
}
?>