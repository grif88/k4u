<?php

// input

if ( isset($_GET['mkt']) ) { $serv=$_GET['mkt']; } else { $serv='1'; }
if ( isset($_GET['login']) ) { $login=$_GET['login']; // if id begin

print "<center>
<strong>$login</strong><br>\n";

if ( $serv == '1' ) { print '&lt;1&gt;'; } else { print "<a href=\"?win&cmd=view_queue&login=$login&mkt=1\">&lt;1&gt;</a>"; } print "&nbsp;\n";
if ( $serv == '2' ) { print '&lt;2&gt;'; } else { print "<a href=\"?win&cmd=view_queue&login=$login&mkt=2\">&lt;2&gt;</a>"; } print "\n";

print "</center>
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
<tr><td align=\"center\">daily<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=$serv&name=$login&kind=daily\"></td></tr>
<tr><td align=\"center\">weekly<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=$serv&name=$login&kind=weekly\"></td></tr>
<tr><td align=\"center\">monthly<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=$serv&name=$login&kind=monthly\"></td></tr>
<tr><td align=\"center\">yearly<br><img border=\"0\" src=\"img/graphs/gd2_queue.php?mkt=$serv&name=$login&kind=yearly\"></td></tr>
</table>\n";

} // if id end
else { print "<br><center>login не выбран<center>\n"; }
?>