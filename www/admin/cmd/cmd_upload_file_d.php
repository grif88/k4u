<?php

$refer=$_SERVER['HTTP_REFERER'];
$work_dir=$_SERVER['DOCUMENT_ROOT'];

$p_file_d=$work_dir.'/files/Dogovor_k4uNet.pdf';
move_uploaded_file($_FILES['file_d']['tmp_name'], $p_file_d);
exec("chmod 0640 $p_file_d");

print "<script type=\"text/javascript\">location.replace(\"$refer\");</script>\n";

?>