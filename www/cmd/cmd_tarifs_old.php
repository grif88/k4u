<?php

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тарифные планы</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>Тарифный план</strong></td>
<td><strong>Абонплата<br>(грн)</strong></td>
<td><strong>Скорость доступа<br>к интернету</strong></td>
<td><strong>Скорость доступа<br>к локальным ресурсам</strong></td>
<td><strong>Срок действия</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `tarifs` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
 $name=$tmp["name"];
 $abon=$tmp["abon"];
 $speed=$tmp["speed"];
 $local=$tmp["local"];
 $srok=$tmp["srok"];
 $akcia=$tmp["akcia"];
 
 if($akcia==1){print "<tr align=\"center\"><td><span class=\"akcia1\">$name</span></td><td><span class=\"akcia1\">$abon</span></td><td><span class=\"akcia1\">$speed</span></td><td><span class=\"akcia1\">$local</span></td><td><span class=\"akcia1\">$srok</span></td></tr>\n";}else{print "<tr align=\"center\"><td>$name</td><td>$abon</td><td>$speed</td><td>$local</td><td>$srok</td></tr>\n";}
 
 }

print "</table>\n";

print "<p class=\"justify1\"><font size=\"2\" color=\"#909090\">* Указанные скорости доступа в безлимитных тарифных планах соответствуют скорости доставки информации к абоненту (download). Заявленные значения скоростей доступа относятся к техническим параметрам предоставления услуги конечным пользователям и максимально возможными. Фактическая скорость доступа к интернет-ресурсам может отличаться и зависит от возможных ограничений конечных ресурсов, маршрутизации данных и возможностей оборудования абонента.</font><br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Цена именения тарифного плана с дорогого на более дешевый составляет - 20 грн.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Цена именения тарифного плана с дешевого на более дорогой составляет - 0 грн.<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Все цены указанны без НДС и действительны с 13 марта 2015г.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Авансовая форма оплаты, производиться до 1 числа следующего месяца. Только после поступления денег на счет услуги предоставляются. Отсутствие платежа по состоянию на 1 число нового месяца - является долгом.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;В случае неуплаты, производится отключение абонента. Задолженность за 3 и более месяцев, является основанием для полного прекращения предоставления услуг и демонтажа точки подключения, в одностороннем порядке, без предупреждения абонента и без возможности восстановления.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Повторное подлючение для абонентов, ранее подключенных посредством кабеля, равно стоимости нового подключения.</p>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дополнительные услуги</strong><br><br>
<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
<tr align=\"center\"><td><strong>Наименование услуги</strong></td><td><strong>Стоимость</strong></td></tr>\n";

$res=mysql_query("SELECT * FROM `uslugi` ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ) {
 $usluga=$tmp["usluga"];
 $cost=$tmp["cost"];
 
 print "<tr><td>$usluga</td><td>$cost</td></tr>\n";
 
 }

print "</table><br>\n";

print "<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Договор абонента ISP k4u.Net</strong>&nbsp;&nbsp;<input type=\"button\" value=\"Скачать\" onclick=\"javascript:location.replace('files/Dogovor_k4uNet.pdf');\" />\n";

?>