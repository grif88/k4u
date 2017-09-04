<?php
print "Выполняет один раз комманду в bash и выводит ответ (время цикла 35сек):
<form method=\"get\"><input type=\"hidden\" name=\"cmd\" value=\"cli\" />
<input required type=\"text\" name=\"val\" maxlength=\"80\" size=\"82\" />&nbsp;
<input type=\"submit\" value=\"bash\" /></form>\n";
if ( isset($_GET['val']) && !empty($_GET['val']) ) {
	$val=$_GET['val'];
	$filename2='/tmp/cli.cmd';
	$file2=@fopen($filename2,'r');
	if ( $file2 ) {
		fclose($file2);
		print 'Ошибка: выполняется предыдущая комманда'."\n";
	} else {
		print 'ОК: принято на выполнение'."\n";
		exec('echo "'.$val.'" 1> /tmp/cli.cmd',$check);
	}
}
print '<hr>'."\n";
// ----------------
print '<pre>Комманда: ';
exec('if [ -f /tmp/cli.cmd ]; then cat /tmp/cli.cmd; fi',$arr1);
exec('if [ -f /tmp/cli.cmd ]; then ls -l /tmp/cli.cmd; fi',$arr2);
if ( count($arr1) > 0 ) {
	print $arr2[0]."\n\n";
	foreach ( $arr1 as $str1 ) {
		print $str1;
	}
} else {
	print "\n".'нет комманды на выполнение'."\n";
}
unset($arr1,$arr2);
print '</pre>'."\n".'<hr><pre>Ответ: ';
$filename='/tmp/cli.ans';
$file1=@fopen($filename,'r');
if ( $file1 ) {
	exec('if [ -f '.$filename.' ]; then ls -l '.$filename.'; fi',$arr2);
	if ( filesize($filename) > 0 ) {
		$str2 = fread($file1, filesize($filename));
		$str2=str_replace('<', '&lt;', $str2);
		$str2=str_replace('>', '&gt;', $str2);
		fclose($file1);
		print $arr2[0]."\n\n".$str2;
	} else {
		print $arr2[0]."\n".'ответ пустой'."\n";
	}
} else {
	print "\n".'нет ответа'."\n";
}
print '</pre>'."\n";
print '<hr>'."\n";
exec('if [ -f /var/log/cli.log ]; then cat /var/log/cli.log; fi',$str3);
print '<pre>'."\n";
if ( count($str3) > 0 ) {
	for ( $i=count($str3)-1; $i>=0; $i-- ) {
		print $str3[$i]."\n";
	}
} else {
	print 'нет лог файла'."\n";
}
print '</pre>'."\n";
?>