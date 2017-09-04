function win_open(cmd,name,left,top,width,height) {
	url="?win&"+cmd;
	params="left="+left+",top="+top+",width="+width+",height="+height+",location=0,status=0,menubar=0,scrollbars=0,resizable=0,toolbar=0,directories=0,titlebar=0";
	name_w = window.open(url,name,params);
	name_w.focus();
}

function win_open_sbar(cmd,name,left,top,width,height) {
	url="?win&"+cmd;
	params="left="+left+",top="+top+",width="+width+",height="+height+",location=0,status=0,menubar=0,scrollbars=1,resizable=0,toolbar=0,directories=0,titlebar=0";
	name_w = window.open(url,name,params);
	name_w.focus();
}

function win_open_prn(cmd,name,left,top,width,height) {
	url=cmd;
	params="left="+left+",top="+top+",width="+width+",height="+height+",location=0,status=0,menubar=1,scrollbars=1,resizable=0,toolbar=0,directories=0,titlebar=0";
	name_w = window.open(url,name,params);
	name_w.focus();
}

function loadScript(url)
{
    var e = document.createElement("script");
    e.src = url;
    e.type="text/javascript";
    document.getElementsByTagName("head")[0].appendChild(e); 
}

function toggle(num) {
	var ele = document.getElementById("toggleText_"+num);
	var text = document.getElementById("displayText_"+num);
	if(ele.style.display == "block") {
		ele.style.display = "none";
		text.innerHTML = 'показать';
	} else {
		ele.style.display = "block";
		text.innerHTML = "скрыть";
	}
}

function toggle_find(num) {
	var ele = document.getElementById("toggleText_"+num);
	var text = document.getElementById("displayText_"+num);
	if(ele.style.display == "block") {
		ele.style.display = "none";
		text.innerHTML = 'расширенный поиск';
	} else {
		ele.style.display = "block";
		text.innerHTML = "скрыть";
	}
}