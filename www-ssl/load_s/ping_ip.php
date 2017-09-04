<?php
if ( isset($_GET['ip']) && !empty($_GET['ip']) ) {
	$ip=$_GET['ip'];
	exec("ping -n -c 2 -W 1 -i 0.2 $ip &> /dev/null");
	exec("ping -n -c 4 -W 1 -i 0.2 $ip | tail -n 1 | cut -d '/' -f5",$res1);
	if ( $res1[0] > 0 ) {
		$result='OK - '.$res1[0].'ms';
	} else {
		$result='Fail';
	}
} else {
	$result='Error';
}
print "var res = document.getElementById('result'); res.innerHTML = '$result';";
?>