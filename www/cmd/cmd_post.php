<?php
if ( !empty($_POST['name']) and $_POST['name'] != 'Администрация' and $_POST['name'] != 'admin' and $_POST['name'] != 'Админ'
and !empty($_POST['text']) and !empty($_POST['mail']) ) {
	$name=addslashes($_POST['name']);
	$monthes=array(1=>'Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');
	$date=date('j ').$monthes[date('n')].date(' Y \- H:i:s');
	$mail=addslashes($_POST['mail']);
	$text=addslashes($_POST['text']);
	$text=str_replace("\r", '<br>', $text);
	$name=str_replace('\'', '&prime;', $name);
	$mail=str_replace('\'', '&prime;', $mail);
	$text=str_replace('\'', '&prime;', $text);
	$name=str_replace('\\', '', $name);
	$mail=str_replace('\\', '', $mail);
	$text=str_replace('\\', '', $text);

	$ip=$_SERVER['REMOTE_ADDR'];

	mysql_query("INSERT INTO `forum` (`name`,`date`,`mail`,`ip`,`text`) VALUES ('$name','$date','$mail','$ip','$text')");

	print "<script type=\"text/javascript\">location.replace(\"?cmd=forum\");</script>"; 
} else {
	print "<center>Не верно введенные данные.</center>\n";
}
?>