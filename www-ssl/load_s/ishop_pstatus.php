<?php
if ( isset($_GET['res']) && !empty($_GET['res']) ) { // global 1
	$res=$_GET['res'];
	if ( isset($_GET['order']) && !empty($_GET['order']) ) { // global 2
		$order=$_GET['order'];
		
		include '../include/p24merch.php';
		
		#$optional_headers = null;
		#$order='165';
		
		$url='https://api.privatbank.ua/p24api/ishop_pstatus';
		#$url='http://www.k4u.net.ua';

		$data="<oper>cmt</oper>
<wait>0</wait>
<test>0</test>
<payment>
  <prop name=\"order\" value=\"$order\" />
</payment>";
		$sign=sha1(md5($data.$pass));
		$data2="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<request version=\"1.0\">
  <merchant>
    <id>$merchant</id>
    <signature>$sign</signature>
  </merchant>
  <data>
    $data
  </data>
</request>";
		$opt = array('http' => array('method' => 'POST', 'content' => $data2));
		/*  if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		  }*/
		$ctx = stream_context_create($opt);
		$fp = @fopen($url, 'rb', false, $ctx);
		$fr=fread($fp,1024);
		fclose($fp);
		#print "$fr";
		$xml = simplexml_load_string($fr);
		$ans_merch=$xml->merchant->id;
		$ans_sign=$xml->merchant->signature;
		#$ans_order=$xml->data->payment['order'];
		#$ans_state=$xml->data->payment['state'];
		#$ans_amt=$xml->data->payment['amt'];
		#$ans_date=$xml->data->payment['date'];
		#print_r($xml);
		$ans_data='<payment ';
		foreach ( $xml->data->payment->attributes() as $key1 => $val1 ) {
			$ans_data.="$key1=\"$val1\" ";
			$ans_payment["$key1"]=$val1;
			#print "$key1=$val1";
		}
		$ans_data.='/>';
		#print "$ans_data";

		$gen_sign=sha1(md5($ans_data.$pass));

		if ( $ans_sign == $gen_sign ) {
			if ( !isset($ans_payment['date']) ) { $ans_payment['date']='null'; }
			if ( !isset($ans_payment['amt']) ) { $ans_payment['amt']='null'; }
			#print "$ans_date - $ans_order - $ans_state - $ans_amt grn";
			$result=$ans_payment['date'].' - '.$ans_payment['order'].' - '.$ans_payment['state'].' - '.$ans_payment['amt'];
			#$result="$ans_date - $ans_order - $ans_state - $ans_amt grn";
		}
	} else { // global 2
		$result='Нет данных для обработки';
	} // global 2
	print "var res = document.getElementById('result$res'); res.innerHTML = '$result';";
} // global 1
?>