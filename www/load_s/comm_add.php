<?php
if ( isset($_GET['news_id']) and !empty($_GET['news_id']) and isset($_GET['name']) and !empty($_GET['name']) and isset($_GET['text']) and !empty($_GET['text']) ) {
	$news_id=addslashes($_GET['news_id']);
	include '../admin/include/admin.php';
	$name=addslashes($_GET['name']);
	$text=addslashes($_GET['text']);
	$monthes=array(1=>'Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');
	$date=date('j ').$monthes[date('n')].date(' Y \- H:i:s');
	$name=str_replace('\'', '&prime;', $name);
	$text=str_replace('\'', '&prime;', $text);
	$name=str_replace('\\', '', $name);
	$text=str_replace('\\', '', $text);
	$ip=$_SERVER['REMOTE_ADDR'];
	$res1=mysql_query("INSERT INTO `comments` (`table`,`id_table`,`name`,`date`,`ip`,`text`) VALUES ('news','$news_id','$name','$date','$ip','$text')");
	$last_id=mysql_insert_id();
	$outer='';
	if ( !empty($last_id) ) {
		$outer.="<tr valign=\"top\"><td width=\"100\">&nbsp;<br><hr width=\"80%\"></td><td>&nbsp;<br><span class=\"tema2\">$name</span><br><span class=\"date1\">$date</span><br><br>$text<br></td></tr>";
	} else {
		$outer.="<tr valign=\"top\"><td width=\"100\">&nbsp;<br><hr width=\"80%\"></td><td>&nbsp;<br>Ошибка<br></td></tr>";
	}
	$outer=str_replace("\n", '', $outer);
	$outer=str_replace("\r", '', $outer);
	print "document.getElementById('tr_add_$news_id').outerHTML='$outer';";
} else {
	print "alert('Поля не заполнены');";
}
?>