<?php
if ( isset($_GET['news_id']) and !empty($_GET['news_id']) ) {
	$news_id=addslashes($_GET['news_id']);
	print "document.getElementById('tr_add_$news_id').outerHTML='<tr id=\"tr_add_$news_id\" valign=\"top\"><td width=\"100\">&nbsp;<br><hr width=\"80%\"></td><form onSubmit=\"javascript:return false;\"><td>&nbsp;<br>������� ��� (���) <input id=\"name_$news_id\" required title=\"������� ���� ���\" placeholder=\"���\" type=\"text\" maxlength=\"30\" size=\"32\" />&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"��������\" onClick=\"javascript:loadScript(\'/load_s/comm_add.php?news_id=$news_id&name=\'+document.getElementById(\'name_$news_id\').value+\'&text=\'+str_brs(document.getElementById(\'text_$news_id\').value));\" /><br>������� �����:<br><textarea id=\"text_$news_id\" required placeholder=\"������� ����� ���������\" title=\"������� ����� ���������\" cols=\"100\" rows=\"5\"></textarea></td></form></tr>';";
} else {
	print "alert('������');";
}
?>