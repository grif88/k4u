<?php
include '../include/admin.php';
$cl_brows=$_SERVER['HTTP_USER_AGENT'];
if ( strpos($cl_brows, 'Opera') !== false ) { $font_s='13'; $font_b='20'; } else { $font_s='10'; $font_b='16'; }
if ( isset($_GET['id']) ) {
	$id=$_GET['id'];
	$dog_num='';
	while ( strlen($dog_num) != 6 ) { if ( !empty($dog_num) ) { $dog_num='0'.$dog_num; } else { $dog_num=$id; } }
	$res=mysql_query("SELECT `login`, `passwd` FROM `d_cl_list` WHERE `id`='$id'");
	while ( $tmp=mysql_fetch_assoc($res) ){
		$login='<span class="big_f">'.$tmp["login"].'</span>';
		$passwd='<span class="big_f">'.$tmp["passwd"].'</span>';
	}
} else {
	$dog_num='_________________';
	$login='_____________________________';
	$passwd='____________________________';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Додаток 2</title>
<style>
<!--
body {
	margin:10px;
	background-color:#FFFFFF;
	font-family:"Times New Roman";
	font-size:<?php print $font_s; ?>pt;
	color:#000000;
	line-height:1.5;
	}
table {
	background-color:#FFFFFF;
	font-family:"Times New Roman";
	font-size:<?php print $font_s; ?>pt;
	color:#000000;
	line-height:1.5;
	}
.underl {
	text-decoration:underline;
	}
.big_f {
	font-size:<?php print $font_b; ?>pt;
	}
-->
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
<td align="left">ФОП Подлеський Р.Л.<br>
м. Кривий Ріг, вул. Мусоргського, 13</td>
<td align="right">www.k4u.net.ua<br>
тел. 068-411-411-5, 098-648-80-06</td>
</tr>
<tr valign="top">
<td width="65%">&nbsp;</td>
<td width="35%"><br>
Додаток №2<br>
до Договору № <?php print $dog_num; ?><br>
від «_____» ____________ 20____ р.<br></td>
</tr>
<tr valign="top">
<td colspan="2" align="center"><br>
Дані для налаштування підключення до мережі Інтернет<br>
<br></td>
</tr>
<tr valign="middle">
<td colspan="2" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Логін: <?php print $login; ?><br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пароль: <?php print $passwd; ?><br>
<br></td>
</tr>
<tr valign="top">
<td colspan="2" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Вихід до мережі Інтернет здійснюється через протокол РРРoЕ, існуючий на момент підписання даного договору і може бути змінений Провайдером. Налаштування конкретної операційної системи здійснюється самостійно абонентом. Інструкцію налаштування PPPoE повинен видати постачальник операційної системи, або можна знайти на web-сайті постачальника операційної системи. Провайдер зобов'язується повідомити Абонента за 10 календарних днів до набуття сили нових налаштувань. Налаштування для виходу до мережі Інтернет, що діють на даний момент, Абонент може знайти на web-сайті Провайдера <span class="underl">www.k4u.net.ua</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Провайдер також залишає за собою право змінити дані для роботи в домашній мережі, сповістивши про це Абонента та видавши йому нові дані.<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="underl">Приклад налаштування PPPoE для Windows XP (рус):</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пуск > Панель управления > Сетевые подключения > Файл > Новое подключение > (кнопка Далее) > Подключить к Интернету (кнопка Далее) > Через высокоскоростное подключение, запрашиваемое имя пользователя и пароль (кнопка Далее) > Имя поставщика услуг: пусто (кнопка Далее) > Ввести имя пользователя и пароль (кнопка Далее) > Добавить ярлык на рабочий стол (кнопка Готово).<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="underl">Приклад налаштування PPPoE для Windows 7 (рус):</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пуск > Панель управления > Сеть и Интернет > Центр управления сетями и общим доступом > Настройка нового подключения или сети > Подключение к Интернету (кнопка Далее) > Все равно создать новое подключение > Высокоскоростное (с PPPoE) > Ввести имя пользователя и пароль > Запомнить этот пароль (кнопка Подключить).<br>
<br>
<br></td>
</tr>
<tr valign="top">
<td align="center">
<table cellpadding="0" cellspacing="0" border="0">
<tr valign="top">
<td align="center">_____________________________<br>
(підпис)<br>
М.П.<br></td>
<td align="left">&nbsp;Подлеський Р.Л.<br></td>
</tr>
</table>
</td>
<td align="center" width="35%">___________________________<br>
(підпис абонента)<br></td>
</tr>
</table>
</body>
</html>