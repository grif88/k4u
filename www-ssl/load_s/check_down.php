<?php
if ( isset($_GET['res']) && !empty($_GET['res']) ) {
	$res=$_GET['res'];
	if ( isset($_GET['login']) && !empty($_GET['login']) ) {
		$login=$_GET['login'];
		exec("cd /var/log/mkt; ls -v -r | xargs cat | grep '$login' | grep 'pppoe-' | tail -n 1",$arr1);
		if ( isset($arr1[0]) ) {
			$result=$arr1[0];
		} else {
			$result='Fail';
		}
	} else {
		$result='Error';
	}
	print "var res = document.getElementById('result$res'); res.innerHTML = '<pre>$result</pre>';";
} else {
	print "alert('Fail(no res)');";
}
?>