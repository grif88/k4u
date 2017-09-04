<?php
include 'variable.php';
$php_user=$_SERVER['PHP_AUTH_USER'];
$php_user_ip=$_SERVER['REMOTE_ADDR'];
if ( isset($_SERVER['HTTP_REFERER']) ) { $php_refer=$_SERVER['HTTP_REFERER']; }
?>