<?php

// body
mysql_query("UPDATE `d_sms_log` SET `st_date`=NULL, `status`=NULL WHERE (`status`='PENDING' OR `status`='NO_MONEY' OR `status`='' OR `status` IS NULL)");

$aff_rows=mysql_affected_rows();

print "Всего обработано: $aff_rows шт.<br>\n";

?>