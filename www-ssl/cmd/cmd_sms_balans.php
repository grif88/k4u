<?php

// body

$cmd="curl \-X GET https://esputnik.com.ua/api/v1/balance \-H\"Accept: application/json\" \-H\"Content-Type: application/json; charset=KOI8-R\" \-u grif-88@yandex.ru:88gothland91";
#print $cmd."<br><br>\n";

$answer2=exec($cmd);
print $answer2."<br><br>\n";

$answ_arr1=json_decode($answer2, true, 10);
#var_dump($answ_arr1);

print '������: <strong>'.$answ_arr1['currentBalance'].' '.$answ_arr1['currency'].'</strong><br>
������: '.$answ_arr1['creditLimit'].' '.$answ_arr1['currency'].'<br>
����� e-mail: '.$answ_arr1['bonusEmails'].' ��<br>
����� SMS: '.$answ_arr1['bonusSmses']." ��<br>\n";

?>