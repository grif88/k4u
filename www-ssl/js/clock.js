function clock_start() {
 clock_tmp = window.setTimeout(clock_repeat, 1000);
}

function clock_repeat() {
 var sp_hh = document.getElementById('span_hh');
 var sp_mm = document.getElementById('span_mm');
 var sp_ss = document.getElementById('span_ss');
 hh = parseFloat(sp_hh.innerHTML);
 mm = parseFloat(sp_mm.innerHTML);
 ss = parseFloat(sp_ss.innerHTML);
 
 if ( ss < 59 ) {
  ss += 1;
 } else {
  if ( mm < 59 ) {
   ss = 0;
   mm += 1;
  } else {
   ss = 0;
   mm = 0;
   if ( hh < 23 ) { hh += 1; } else { hh = 0; }
  }
 }
 
 if ( hh < 10 ) { hh = '0' + hh; }
 if ( mm < 10 ) { mm = '0' + mm; }
 if ( ss < 10 ) { ss = '0' + ss; }
 sp_hh.innerHTML = hh;
 sp_mm.innerHTML = mm;
 sp_ss.innerHTML = ss;
 
 clock_start();
}