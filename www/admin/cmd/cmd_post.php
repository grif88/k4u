<?php
$table=addslashes($_POST['table']);
$id_table=addslashes($_POST['id_table']);
$name=addslashes($_POST['name']);
$monthes=array(1=>'Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');
$date=date('j ').$monthes[date('n')].date(' Y \- H:i:s');
$text=addslashes($_POST['text']);
$text=str_replace("\r", '<br>', $text);
$name=str_replace('\'', '&prime;', $name);
$text=str_replace('\'', '&prime;', $text);
$name=str_replace('\\', '', $name);
$text=str_replace('\\', '', $text);
$ip=$_SERVER['REMOTE_ADDR'];
$refer=$_SERVER['HTTP_REFERER'];

mysql_query("INSERT INTO `comments` (`table`,`id_table`,`name`,`date`,`ip`,`text`) VALUES ('$table','$id_table','$name','$date','$ip','$text')");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";
?>