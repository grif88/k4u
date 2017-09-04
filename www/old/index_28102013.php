<?php include 'admin/include/admin.php';
session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta name="description" content="Безлимитный проводной интернет для частных секторов. Кривой Рог. Жовтневый, Терновской районы." />
<meta name="keywords" content="провайдер, кривой рог, жовтневый, 20-ый квартал, интернет, безлимитный, высокоскоростной, wi-fi, 3g, проводной, частный сектор, частный дом, internet" />
<link rel="shortcut icon" href="favicon.ico" />
<title>k4u.Net</title>
<link rel="stylesheet" href="css/ind.css" type="text/css" />
<script type="text/JavaScript" src="js/main.js"></script>
</head>
<body>

<?php

$day=date('d');
$month=date('m');
#$day=99;
#$month=99;

// head

print "<table class=\"main_t1\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\" border=\"0\">
<tr valign=\"middle\">
<td width=\"200\" height=\"150\"><a href=\"/\"><img width=\"200\" height=\"150\" src=\"/img2/bg/logo.png\" border=\"0\"></a></td>
<td height=\"150\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" height=\"100%\" border=\"0\"><tr align=\"center\" valign=\"middle\">
<td class=\"bg-head\"><span class=\"head3\">Интернет&nbsp;&nbsp;@</span><span class=\"head1\">&nbsp;k4u.Net&nbsp;</span><span class=\"head3\">@&nbsp;&nbsp;Провайдер</span><br><br>
<span class=\"head2\">Высокоскоростной безлимитный интернет для Вас.<br>Быстро. Надежно. Доступно.</span></td>\n";

// holiday
$res41=mysql_query("SELECT `id`,`title`,`img`,`source`,`shows`,`count` FROM `d_holiday` WHERE `day`='$day' AND `month`='$month' ORDER BY `shows` LIMIT 0,1");
$num_r_res41=mysql_num_rows($res41);

if ( $num_r_res41 == 1 ) {
 if ( $_SESSION['anim'] == 1 ) {
  while ( $tmp41=mysql_fetch_assoc($res41) ) {
   $h_id=$tmp41["id"];
   $h_title=$tmp41["title"];
   $h_img='img2/holiday/'.$tmp41["img"];
   $h_source=$tmp41["source"];
   $h_shows=$tmp41["shows"];
   $h_count=$tmp41["count"];
   print "<td class=\"bg-head\" width=\"200\" align=\"right\"><a href=\"$h_source\" target=\"_blank\"><img onclick=\"javascript:loadScript('js/counter.php?id=$h_id');\" height=\"150\" src=\"$h_img\" border=\"0\" title=\"$h_title ($h_shows-$h_count)\" /></a></td>\n";
  }
 } else {
  print "<td class=\"bg-head\" width=\"200\" id=\"anim_td\" align=\"right\"></td>\n";
 }
}

print "</tr></table>
</td>
</tr>
<tr valign=\"top\">
<td class=\"bg-side\">
<table height=\"100%\" width=\"200\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr valign=\"top\" height=\"99%\"><td align=\"left\">
<br>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";

// get

if ( isset($_GET['cmd']) ) { $cmd=$_GET["cmd"]; } else { $cmd="glav"; }

// menu

$res=mysql_query("SELECT `title`,`cmd` FROM `m_menu` WHERE `view`='1' ORDER BY `poss`");
while ( $tmp=mysql_fetch_assoc($res) ){
  $title=$tmp["title"];
  $cmd2=$tmp["cmd"];
  
  if ( $cmd == $cmd2 ) { print "<tr><td width=\"55\">&nbsp;</td><td class=\"func3\">$title</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n"; }
  else { print "<tr><td width=\"55\">&nbsp;</td><td onmouseover=\"javascript:this.style.backgroundColor='#FFFFFF';\" onmouseout=\"javascript:this.style.backgroundColor=document.body.style.backgroundColor;\" class=\"func1\"><a href=\"?cmd=$cmd2\">$title</a></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n"; }
}

print "<tr><td width=\"55\">&nbsp;</td><td onmouseover=\"javascript:this.style.backgroundColor='#00FF00'; this.style.color='#000000';\" onmouseout=\"javascript:this.style.backgroundColor=document.body.style.backgroundColor; this.style.color=document.body.style.color;\" onclick=\"javascript:location.replace('http://dload.k4u.net.ua/');\" class=\"func2\">Загрузки</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width=\"55\">&nbsp;</td><td onmouseover=\"javascript:this.style.backgroundColor='#00FF00'; this.style.color='#000000';\" onmouseout=\"javascript:this.style.backgroundColor=document.body.style.backgroundColor; this.style.color=document.body.style.color;\" onclick=\"javascript:location.replace('http://91.196.80.1:81/1/test.avi.bz2');\" class=\"func2\">Тестовая<br>закачка</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width=\"55\">&nbsp;</td><td align=\"center\"><a href=\"http://dload.k4u.net.ua/TeamViewerQS_ru-ckq.exe\"><img width=\"50\" src=\"img2/tw_logo.png\" border=\"0\" title=\"Удаленный помощник\" /></a>
<a href=\"http://dload.k4u.net.ua/drweb_CureIt.exe\"><img width=\"50\" src=\"img2/drweb_logo.png\" border=\"0\" title=\"Антивирус\" /></a></td></tr>
</table>
<br>
</td></tr>
<tr valign=\"bottom\"><td align=\"center\">\n"; ?>
<!--LiveInternet counter-->
<script type="text/javascript">document.write("<a href='http://www.liveinternet.ru/click' target=_blank><img src='//counter.yadro.ru/hit?t21.14;r" + escape(document.referrer) + ((typeof(screen)=="undefined")?"":";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?screen.colorDepth:screen.pixelDepth)) + ";u" + escape(document.URL) + ";" + Math.random() + "' border=0 width=88 height=31 alt='' title='LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня'><\/a>")</script>
<!--/LiveInternet-->
<br><br>
<!-- Yandex.Metrika informer -->
<a href="http://metrika.yandex.ru/stat/?id=12192598&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/12192598/3_1_2BFA71FF_0BDA51FF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onClick="try{Ya.Metrika.informer({i:this,id:12192598,type:0,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter12192598 = new Ya.Metrika({id:12192598, enableAll: true, webvisor:true});
        }
        catch(e) { }
    });
})(window, "yandex_metrika_callbacks");
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/12192598" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php
$rm_addr=$_SERVER['REMOTE_ADDR'];
print "<br><br>
</td></tr>
<tr valign=\"bottom\"><td align=\"center\" class=\"copyr1\">Ваш IP: $rm_addr<br><br>Copyright &copy; GriF<br>2009 - ".date("Y")."</td></tr></table>
</td>
<td class=\"bg-body\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td width=\"15\" height=\"15\">&nbsp;</td><td>&nbsp;</td><td width=\"15\">&nbsp;</td></tr><tr><td>&nbsp;</td><td>
<!-- body begin -->\n";

// soure include

$res=mysql_query("SELECT `src` FROM `m_menu` WHERE `cmd`='$cmd'");
while ( $tmp=mysql_fetch_assoc($res) ){
  $src=$tmp["src"];
  include "cmd/$src";
}

print "<!-- body end -->
</td><td>&nbsp;</td></tr><tr><td height=\"15\">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
</td>
</tr>
</table>\n";

// anim

if ( $num_r_res41 == 1 ) { // num_r_res41 begin
if ( $_SESSION['anim'] != 1 ) { // sesion animation
 while ( $tmp41=mysql_fetch_assoc($res41) ) {
  $h_id=$tmp41["id"];
  $h_title=$tmp41["title"];
  $h_img='img2/holiday/'.$tmp41["img"];
  $h_source=$tmp41["source"];
  $h_shows=$tmp41["shows"];
  $h_count=$tmp41["count"];
 }

print "
<!-- div22 -->
<div id=\"div22\" style=\"position:fixed; left:0px; top:0px;\"><a href=\"$h_source\" target=\"_blank\"><img id=\"img22\" onclick=\"javascript:loadScript('js/counter.php?id=$h_id');\" height=\"400\" src=\"$h_img\" border=\"0\" title=\"$h_title ($h_shows-$h_count)\" /></a></div>

<script language=\"javascript\">

function count22() {
 loadScript('js/counter.php?id=$h_id');
}

function clock_start(time22) {
 wid_img = parseInt(document.getElementById('img22').height);
 if ( wid_img > 0 ) {
  clock_tmp = window.setTimeout(clock_repeat, time22);
 }
}

function clock_repeat() {
 wait_time = 15;
 wid_win = window.innerWidth;
 top_div = parseInt(document.getElementById('div22').style.top);
 left_div = parseInt(document.getElementById('div22').style.left);
 hei_img2 = parseInt(document.getElementById('img22').height);
 
 if ( hei_img2 > 150 ) {
  hei_img2 = hei_img2 - 2;
  document.getElementById('img22').height = hei_img2;
 }
 
 if ( top_div > 0 ) {
  top_div = top_div - 1;
  document.getElementById('div22').style.top = top_div + 'px';
 }
 
 wid_img = parseInt(document.getElementById('img22').width);
 wid_temp = wid_win - wid_img - 19;
 if ( left_div < wid_temp ) {
  left_div = left_div + 6;
  document.getElementById('div22').style.left = left_div + 'px';
  clock_start(wait_time);
 } else {
  anim_td.innerHTML = '<a href=\"$h_source\" target=\"_blank\"><img onclick=\"javascript:count22();\" height=\"150\" src=\"$h_img\" border=\"0\" title=\"$h_title ($h_shows-$h_count)\" /></a>';
  document.getElementById('img22').height = '0';
  document.getElementById('img22').width = '0';
 }

}

/* ------------- start position begin ------------- */
hei_win = window.innerHeight;
wid_win = window.innerWidth;
hei_img = parseInt(document.getElementById('img22').height);
wid_img = parseInt(document.getElementById('img22').width);
if ( wid_img == 0 ) { wid_img = 400; }
st_pos_top_img = (hei_win - hei_img) / 2;
st_pos_left_img = (wid_win - wid_img) / 2;
document.getElementById('div22').style.top = st_pos_top_img+'px';
document.getElementById('div22').style.left = st_pos_left_img+'px';
/* ------------- start position end ------------- */

clock_start('2000');
</script>
<!-- div22 -->\n";

// count shows
 $res22=mysql_query("SELECT `shows` FROM `d_holiday` WHERE `id`='$h_id'");
 while ( $tmp22=mysql_fetch_assoc($res22) ) { $shows=$tmp22["shows"]; }
 $shows++;
 mysql_query("UPDATE `d_holiday` SET `shows`='$shows' WHERE `id`='$h_id'");
// ------------

$_SESSION['anim']=1;
} // sesion animation
} // num_r_res41 end

?>

</body>
</html>