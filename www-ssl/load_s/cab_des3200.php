<?php
if ( isset($_GET['res']) && !empty($_GET['res']) ) {
	$res=$_GET['res'];
	if ( isset($_GET['ip']) && !empty($_GET['ip']) && isset($_GET['p']) && !empty($_GET['p']) ) {
		$ip=$_GET['ip'];
		$p=$_GET['p'];
		$answ=exec("snmpset -v 2c -Oqv -c pri321vat123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.12.$p i 1 2> /dev/null");
		if ( $answ == 1 ) {
			$link_st=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.3.$p");
			#$stat1=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.4.$p");
			$stat2=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.5.$p");
			$stat3=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.6.$p");
			#$stat4=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.7.$p");
			#$less1=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.8.$p");
			$less2=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.9.$p");
			$less3=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.10.$p");
			#$less4=exec("snmpget -v 2c -Oqv -c pub321lic123 $ip .1.3.6.1.4.1.171.12.58.1.1.1.11.$p");
			$link_st_arr=array(0=>'link-down','link-up','other');
			$stat_arr=array(0=>'ok','open','short','open-short','crosstalk','unknown','count','no-cable','other');
			$result=$link_st_arr[$link_st].'<br>'.$less2.'ì-'.$less3.'ì<br>'.$stat_arr[$stat2].'-'.$stat_arr[$stat3].'<br>';
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