<?php
if ( isset($_GET['res']) && !empty($_GET['res']) ) {
	$res=$_GET['res'];
	if ( isset($_GET['ip']) && !empty($_GET['ip']) && isset($_GET['p']) && !empty($_GET['p']) ) {
		$ip=$_GET['ip'];
		$p=$_GET['p']+4; // +4 adjust for huawei
		$answ=exec("snmpset -v 2c -Oqv -c pri321vat123 $ip .1.3.6.1.4.1.2011.5.25.31.1.1.7.1.4.$p i 1 2> /dev/null");
		if ( $answ == 1 ) {
			$stat=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.2011.5.25.31.1.1.7.1.2.$p");
			$less=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.2011.5.25.31.1.1.7.1.3.$p");
			$last=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.2011.5.25.31.1.1.7.1.5.$p");
			$stat_arr=array(1=>'ok','open','short','crosstalk','unknown','uncheked');
			$result=$less.'ì-'.$stat_arr[$stat].'-'.$last.'ñ<br>';
		} else {
			$result='Fail(no answer)';
		}
	} else {
		$result='Fail(no data)';
	}
	print "var res = document.getElementById('$res'); res.innerHTML = '$result';";
} else {
	print "alert('Fail(no res)');";
}
?>