<?php

if ( isset($_POST["cmd"]) and $_POST["cmd"] == "post_click" ) {

	if ( !empty($_POST["name"]) and $_POST["name"] != '�������������' and !empty($_POST["text"]) and !empty($_POST["mail"]) ) { $n=1; } else { $n=0; }
	if ( !empty($_POST["text"]) ) { $t=1; } else { $t=0; }
	if ( !empty($_POST["mail"]) ) { $m=1; } else { $m=0; }

	if ( $n == 1 and $t == 1 and $m == 1 ) {

		if ( $_POST["name"] != 'hellowoll2' ) { $name=$_POST["name"]; } else { $name='�������������'; }
		$d1=date("j ");
		$d2=date("m");
		if ( $d2 == "01" ) { $d2="������"; }
		if ( $d2 == "02" ) { $d2="�������"; }
		if ( $d2 == "03" ) { $d2="�����"; }
		if ( $d2 == "04" ) { $d2="������"; }
		if ( $d2 == "05" ) { $d2="���"; }
		if ( $d2 == "06" ) { $d2="����"; }
		if ( $d2 == "07" ) { $d2="����"; }
		if ( $d2 == "08" ) { $d2="�������"; }
		if ( $d2 == "09" ) { $d2="��������"; }
		if ( $d2 == "10" ) { $d2="�������"; }
		if ( $d2 == "11" ) { $d2="������"; }
		if ( $d2 == "12" ) { $d2="�������"; }
		$d3=date(" Y \- H:i:s");
		$date=$d1.$d2.$d3;
		$mail=$_POST["mail"];
		$text2=$_POST["text"];
		$end=chr(13);
		$br="<br>";
		$text=str_replace($end, $br, $text2);
		$ip=$_SERVER['REMOTE_ADDR'];

		mysql_query("INSERT INTO `forum` (name,date,mail,ip,text) VALUES ('$name','$date','$mail','$ip','$text')");

		print "<script type=\"text/javascript\">location.replace(\"?cmd=forum\");</script>"; 
	} else {
		$name=$_POST["name"];
		$text=$_POST["text"];
		$mail=$_POST["mail"];

		print "<form method=\"post\">
������� ��� (���) <input type=\"text\" value=\"$name\" name=\"name\" maxlength=\"30\" size=\"32\" />"; 
		if ( $n == 0 ) { print "<span class=\"fail1\"> �� �� ����� ��� (���)</span>"; }
		print "<br><br>
������� ���� e-mail <input type=\"text\" value=\"$mail\" name=\"mail\" maxlength=\"50\" size=\"52\" />";
		if ( $m == 0 ) { print "<span class=\"fail1\"> �� �� ����� e-mail</span>"; }
		print "<br><br>
������� �����:"; 
		if ( $t == 0 ) { print "<span class=\"fail1\"> �� �� ����� ����� ���������</span>"; }
		print "<br>
<textarea name=\"text\" cols=\"100\" rows=\"10\">$text</textarea><br><br>
<input type=\"hidden\" value=\"post_click\" name=\"cmd\" />
<input type=\"submit\" value=\"��������\" />
</form>\n";
	}
} else {
	print "<form method=\"post\">
������� ��� (���) <input required title=\"������� ���� ���\" placeholder=\"���\" type=\"text\" name=\"name\" maxlength=\"30\" size=\"32\" /><br><br>
������� ���� e-mail <input required title=\"������: qwerty@domain.ua\" placeholder=\"qwe@dom.ua\" type=\"text\" name=\"mail\" maxlength=\"50\" size=\"52\" /><br><br>
������� �����:<br>
<textarea required placeholder=\"������� ����� ���������\" title=\"������� ����� ���������\" name=\"text\" cols=\"100\" rows=\"10\"></textarea><br><br>
<input type=\"hidden\" value=\"post_click\" name=\"cmd\" />
<input type=\"submit\" value=\"��������\" />
</form>\n";
}
?>